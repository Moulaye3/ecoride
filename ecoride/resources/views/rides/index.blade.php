@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-emerald-800 mb-8">Covoiturages disponibles 🌱</h1>

        <!-- Formulaire de recherche amélioré -->
        <form action="{{ route('rides.search') }}" method="GET" class="bg-white rounded-3xl shadow-xl p-8 mb-10">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- Départ -->
                <div>
                    <label class="block text-sm font-medium mb-2">Ville de départ</label>
                    <input type="text" name="departure_city" value="{{ request('departure_city') }}" list="citiesList"
                        placeholder="Ex: Paris"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                </div>

                <!-- Arrivée -->
                <div>
                    <label class="block text-sm font-medium mb-2">Ville d'arrivée</label>
                    <input type="text" name="arrival_city" value="{{ request('arrival_city') }}" list="citiesList"
                        placeholder="Ex: Lyon"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-medium mb-2">Date de départ</label>
                    <input type="date" name="date" value="{{ request('date') }}" min="{{ now()->format('Y-m-d') }}"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                </div>

                <!-- Bouton -->
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-4 rounded-2xl transition text-lg shadow-md hover:shadow-lg">
                        🔎 Rechercher
                    </button>
                </div>
            </div>
        </form>

        <!-- Liste des trajets -->
        @if($rides->isEmpty())
            <p class="text-center text-gray-500 py-20 text-xl">Aucun trajet disponible pour le moment.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rides as $ride)
                    <div class="bg-white border border-emerald-100 rounded-3xl p-8 hover:shadow-2xl transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-2xl font-bold text-emerald-700">
                                    {{ $ride->departure_city }} → {{ $ride->arrival_city }}
                                </p>
                                <p class="text-emerald-600 mt-1">
                                    {{ $ride->departure_datetime->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-emerald-600">{{ $ride->price }} €</p>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3 text-sm">
                            <p><strong>Conducteur :</strong> {{ $ride->driver->pseudo ?? 'Inconnu' }}</p>
                            <p><strong>Véhicule :</strong> {{ $ride->vehicle->brand ?? '' }} {{ $ride->vehicle->model ?? '' }}</p>
                            <p><strong>Places restantes :</strong> <span
                                    class="font-semibold text-emerald-600">{{ $ride->seats_available }}</span></p>
                        </div>

                        <a href="{{ route('rides.show', $ride) }}"
                            class="mt-8 block text-center bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-semibold transition">
                            Voir le trajet →
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                {{ $rides->links() }}
            </div>
        @endif
    </div>
@endsection