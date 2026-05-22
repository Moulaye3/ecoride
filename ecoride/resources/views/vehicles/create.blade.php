@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12">
    <div class="bg-white rounded-3xl shadow-xl p-10">
        <h1 class="text-3xl font-bold text-emerald-700 mb-8">Ajouter un véhicule</h1>

        <form method="POST" action="{{ route('vehicles.store') }}">
            @csrf
            <!-- Champs : brand, model, color, energy (select), plate, first_registration_date, seats -->
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label>Marque</label>
                    <input type="text" name="brand" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
                <div>
                    <label>Modèle</label>
                    <input type="text" name="model" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
            </div>

            <div class="mt-6">
                <label>Immatriculation</label>
                <input type="text" name="plate" required class="w-full border rounded-2xl px-5 py-4 mt-1">
            </div>

            <div class="grid grid-cols-2 gap-6 mt-6">
                <div>
                    <label>Énergie</label>
                    <select name="energy" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                        <option value="electric">Électrique</option>
                        <option value="hybrid">Hybride</option>
                        <option value="thermal">Thermique</option>
                    </select>
                </div>
                <div>
                    <label>Places</label>
                    <input type="number" name="seats" min="2" max="9" required class="w-full border rounded-2xl px-5 py-4 mt-1">
                </div>
            </div>

            <button type="submit" class="mt-10 w-full bg-emerald-600 text-white py-5 rounded-3xl text-lg font-semibold">
                Enregistrer le véhicule
            </button>
        </form>
    </div>
</div>
@endsection