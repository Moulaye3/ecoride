@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12">
    <div class="bg-white rounded-3xl shadow-xl p-10">
        <h1 class="text-3xl font-bold text-emerald-700 mb-8">Publier un nouveau trajet</h1>

        <form method="POST" action="{{ route('rides.store') }}">
            @csrf

            <!-- Choix véhicule -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Votre véhicule</label>
                <select name="vehicle_id" required class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                    <option value="">-- Choisir un véhicule --</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->plate }}) - {{ $vehicle->seats }} places
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label>Départ</label>
                    <input type="text" name="departure_city" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
                <div>
                    <label>Arrivée</label>
                    <input type="text" name="arrival_city" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-6">
                <div>
                    <label>Date & Heure de départ</label>
                    <input type="datetime-local" name="departure_datetime" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
                <div>
                    <label>Date & Heure d'arrivée</label>
                    <input type="datetime-local" name="arrival_datetime" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-6">
                <div>
                    <label>Prix par passager (€)</label>
                    <input type="number" name="price" step="0.01" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
                <div>
                    <label>Places disponibles</label>
                    <input type="number" name="seats_available" min="1" max="8" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
            </div>

            <button type="submit" 
                    class="mt-10 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-5 rounded-3xl text-lg transition">
                Publier le trajet 🌍
            </button>
        </form>
    </div>
</div>
@endsection