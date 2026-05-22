@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-50">

        <!-- Hero Section -->
        <section class="pt-24 pb-16 text-center">
            <h1 class="text-6xl font-bold text-emerald-800 mb-6">
                Voyagez mieux, <span class="text-emerald-600">voyagez éco</span> 
            </h1>
            <p class="text-2xl text-gray-600 max-w-2xl mx-auto">
                Rejoignez la communauté de covoiturage écologique
            </p>

            <!-- Boutons principaux -->
            <div class="mt-10 flex justify-center gap-6">
                <a href="{{ route('rides.search') }}"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-xl px-10 py-5 rounded-3xl font-semibold transition">
                    Rechercher un trajet
                </a>

                <a href="{{ route('register') }}"
                    class="border-2 border-emerald-700 text-emerald-700 hover:bg-emerald-50 text-xl px-10 py-5 rounded-3xl font-semibold transition">
                    Devenir membre
                </a>
            </div>
        </section>

        <!-- Barre de recherche rapide -->
        <div class="max-w-5xl mx-auto px-6 -mt-8">
            <form action="{{ route('rides.search') }}" method="GET" class="bg-white shadow-2xl rounded-3xl p-8">
                <!-- inputs pour ville départ, arrivée, date -->
            </form>
        </div>
    </div>
@endsection