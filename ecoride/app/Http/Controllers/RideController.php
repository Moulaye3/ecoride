<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function index()
    {
        $rides = Ride::with(['driver', 'vehicle'])
            ->where('status', 'pending')
            ->where('departure_datetime', '>', now())
            ->orderBy('departure_datetime')
            ->paginate(12);

        return view('rides.index', compact('rides'));
    }

    public function search(Request $request)
    {
        $query = Ride::with(['driver', 'vehicle'])
            ->where('status', 'pending')
            ->where('departure_datetime', '>', now());

        if ($request->filled('departure_city')) {
            $query->where('departure_city', 'LIKE', '%' . $request->departure_city . '%');
        }

        if ($request->filled('arrival_city')) {
            $query->where('arrival_city', 'LIKE', '%' . $request->arrival_city . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('departure_datetime', $request->date);
        }

        $rides = $query->orderBy('departure_datetime')->paginate(12);

        return view('rides.index', compact('rides'));
    }

    public function create()
    {
        $vehicles = auth()->user()->vehicles()->get();

        if ($vehicles->isEmpty()) {
            return redirect()->route('vehicles.create')
                ->with('info', 'Vous devez ajouter un véhicule avant de publier un trajet.');
        }

        return view('rides.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'departure_city' => 'required|string|max:100',
            'arrival_city' => 'required|string|max:100',
            'departure_address' => 'nullable|string',
            'arrival_address' => 'nullable|string',
            'departure_datetime' => 'required|date|after:now',
            'arrival_datetime' => 'required|date|after:departure_datetime',
            'price' => 'required|numeric|min:1',
            'seats_available' => 'required|integer|min:1|max:8',
        ]);

        $ride = Ride::create([
            'driver_id' => auth()->id(),
            'vehicle_id' => $validated['vehicle_id'],
            'departure_city' => $validated['departure_city'],
            'arrival_city' => $validated['arrival_city'],
            'departure_address' => $validated['departure_address'],
            'arrival_address' => $validated['arrival_address'],
            'departure_datetime' => $validated['departure_datetime'],
            'arrival_datetime' => $validated['arrival_datetime'],
            'price' => $validated['price'],
            'seats_available' => $validated['seats_available'],
            'status' => 'pending',
        ]);

        return redirect()->route('rides.index')
            ->with('success', 'Trajet publié avec succès ! 🌱');
    }
    public function show(Ride $ride)
    {
        $ride->load('driver', 'vehicle', 'passengers', 'reviews');

        $isDriver = $ride->driver_id === auth()->id();
        $isPassenger = $ride->passengers->contains(auth()->id());
        return view('rides.show', compact('ride', 'isDriver', 'isPassenger'));
    }

    public function reserve(Ride $ride)
    {
        $user = auth()->user();

        if ($ride->driver_id === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas réserver votre propre trajet.');
        }

        if ($ride->seats_available <= 0) {
            return back()->with('error', 'Plus de places disponibles.');
        }

        if ($user->credits < $ride->price) {
            return back()->with('error', 'Crédits insuffisants.');
        }

        // Vérifier si déjà réservé
        if ($ride->passengers->contains($user->id)) {
            return back()->with('info', 'Vous avez déjà réservé ce trajet.');
        }

        $ride->passengers()->attach($user->id, [
            'status' => 'confirmed'
        ]);

        // Débit crédits
        $user->decrement('credits', (float) $ride->price);

        // Incrémenter sièges occupés (optionnel : tu peux ajouter un champ seats_taken)
        $ride->decrement('seats_available');

        return redirect()->route('rides.show', $ride)
            ->with('success', 'Réservation confirmée ! Bonne route 🌱');
    }
}