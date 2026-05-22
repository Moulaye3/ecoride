@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12">
    <div class="bg-white rounded-3xl shadow-xl p-10">
        
        <h1 class="text-3xl font-bold text-emerald-700 mb-8">
            Modifier le véhicule
        </h1>

        <form method="POST" action="{{ route('vehicles.update', $vehicle) }}">
            @csrf
            @method('PUT')

            <!-- Marque + Modèle -->
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Marque</label>
                    <input type="text" 
                           name="brand" 
                           value="{{ old('brand', $vehicle->brand) }}" 
                           required 
                           class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Modèle</label>
                    <input type="text" 
                           name="model" 
                           value="{{ old('model', $vehicle->model) }}" 
                           required 
                           class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                </div>
            </div>

            <!-- Immatriculation -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Immatriculation</label>
                <input type="text" 
                       name="plate" 
                       value="{{ old('plate', $vehicle->plate) }}" 
                       required 
                       class="w-full border border-gray-300 rounded-2xl px-5 py-4">
            </div>

            <!-- Énergie + Places -->
            <div class="grid grid-cols-2 gap-6 mt-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Énergie</label>
                    <select name="energy" required class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                        <option value="electric" {{ old('energy', $vehicle->energy) == 'electric' ? 'selected' : '' }}>Électrique</option>
                        <option value="hybrid" {{ old('energy', $vehicle->energy) == 'hybrid' ? 'selected' : '' }}>Hybride</option>
                        <option value="thermal" {{ old('energy', $vehicle->energy) == 'thermal' ? 'selected' : '' }}>Thermique</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de places</label>
                    <input type="number" 
                           name="seats" 
                           value="{{ old('seats', $vehicle->seats) }}" 
                           min="2" 
                           max="9" 
                           required 
                           class="w-full border border-gray-300 rounded-2xl px-5 py-4">
                </div>
            </div>

            <!-- Couleur (optionnel) -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Couleur</label>
                <input type="text" 
                       name="color" 
                       value="{{ old('color', $vehicle->color) }}" 
                       class="w-full border border-gray-300 rounded-2xl px-5 py-4">
            </div>

            <div class="flex gap-4 mt-10">
                <button type="submit" 
                        class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-5 rounded-3xl text-lg">
                    Enregistrer les modifications
                </button>
                
                <a href="{{ route('vehicles.index') }}" 
                   class="flex-1 text-center border border-gray-400 hover:bg-gray-100 font-semibold py-5 rounded-3xl text-lg">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection