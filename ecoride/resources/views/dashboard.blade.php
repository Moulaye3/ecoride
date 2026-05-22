@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="bg-gradient-to-r from-emerald-700 to-teal-600 text-white rounded-3xl p-12 mb-10">
        <h1 class="text-5xl font-bold mb-3">Bonjour {{ auth()->user()->pseudo }} 🌱</h1>
        <p class="text-xl opacity-90">Bienvenue sur EcoRide</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Crédits -->
        <div class="bg-white rounded-3xl p-8 shadow hover:shadow-xl transition">
            <div class="text-emerald-600 text-sm font-medium">Crédits disponibles</div>
            <div class="text-6xl font-bold text-emerald-700 mt-4">{{ auth()->user()->credits }}</div>
            <a href="#" class="text-sm text-emerald-600 hover:underline mt-6 inline-block">Recharger mes crédits →</a>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white rounded-3xl p-8 shadow hover:shadow-xl transition">
            <h3 class="font-semibold text-xl mb-6">Actions rapides</h3>
            <div class="space-y-4">
                <a href="{{ route('vehicles.create') }}" 
                   class="block w-full text-center bg-white border-2 border-emerald-600 text-emerald-700 py-4 rounded-2xl font-medium hover:bg-emerald-50">
                    ➕ Ajouter un véhicule
                </a>
                <a href="{{ route('rides.create') }}" 
                   class="block w-full text-center bg-emerald-600 text-white py-4 rounded-2xl font-medium hover:bg-emerald-700">
                    📢 Publier un trajet
                </a>
            </div>
        </div>

        <!-- Stats perso -->
        <div class="bg-white rounded-3xl p-8 shadow hover:shadow-xl transition">
            <h3 class="font-semibold text-xl mb-6">Mes statistiques</h3>
            <div class="space-y-6">
                <div class="flex justify-between">
                    <span>Trajets publiés</span>
                    <span class="font-bold">{{ auth()->user()->ridesAsDriver()->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Trajets réservés</span>
                    <span class="font-bold">{{ auth()->user()->ridesAsPassenger()->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 text-center">
        <a href="{{ route('rides.search') }}" 
           class="inline-block bg-emerald-600 text-white text-xl px-12 py-6 rounded-3xl font-semibold hover:bg-emerald-700 transition">
            🔎 Rechercher un trajet maintenant
        </a>
    </div>
</div>
@endsection