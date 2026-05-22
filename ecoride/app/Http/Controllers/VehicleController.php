<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = auth()->user()->vehicles;
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'                  => 'required|string|max:50',
            'model'                  => 'required|string|max:50',
            'color'                  => 'nullable|string',
            'energy'                 => 'required|in:electric,hybrid,thermal',
            'plate'                  => 'required|string|unique:vehicles,plate',
            'first_registration_date'=> 'nullable|date',
            'seats'                  => 'required|integer|between:2,9',
        ]);

        $validated['user_id'] = auth()->id();

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')
                        ->with('success', 'Véhicule ajouté avec succès !');
    }

    public function show(Vehicle $vehicle)
    {
        if ($vehicle->user_id !== auth()->id()) {
            abort(403);
        }
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        if ($vehicle->user_id !== auth()->id()) {
            abort(403);
        }
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'color' => 'nullable|string',
            'energy' => 'required|in:electric,hybrid,thermal',
            'seats' => 'required|integer|between:2,9',
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')
                        ->with('success', 'Véhicule mis à jour !');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->user_id !== auth()->id()) {
            abort(403);
        }

        // Empêcher la suppression si le véhicule est utilisé dans un trajet actif
        if ($vehicle->rides()->whereIn('status', ['pending', 'ongoing'])->exists()) {
            return back()->with('error', 'Impossible de supprimer : véhicule utilisé dans un trajet actif.');
        }

        $vehicle->delete();
        return redirect()->route('vehicles.index')
                        ->with('success', 'Véhicule supprimé.');
    }
}