@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-10">
            <h1 class="text-4xl font-bold">{{ $ride->departure_city }} → {{ $ride->arrival_city }}</h1>
            <p class="text-xl mt-2">{{ $ride->departure_datetime->format('l d F Y à H:i') }}</p>
        </div>

        <div class="p-10">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Infos trajet -->
                <div>
                    <h2 class="text-2xl font-semibold mb-6 text-emerald-700">Détails du trajet</h2>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-2xl">🚗</div>
                            <div>
                                <p class="font-medium">{{ $ride->vehicle->brand ?? 'Véhicule'}} {{ $ride->vehicle->model ?? '' }}</p>
                                <p class="text-sm text-gray-500">{{ $ride->vehicle->plate ?? '' }} • {{ $ride->vehicle->energy ?? '' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="font-medium">Conducteur</p>
                            <p class="text-lg">{{ $ride->driver->pseudo }}</p>
                        </div>

                        <div class="bg-emerald-50 p-6 rounded-2xl">
                            <p class="text-4xl font-bold text-emerald-600">{{ $ride->price }} €</p>
                            <p class="text-sm text-emerald-700">par passager</p>
                        </div>
                    </div>
                </div>

                <!-- Action -->
                <div>
                    @if(!$isDriver && !$isPassenger)
                        <form action="{{ route('rides.reserve', $ride) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-6 rounded-3xl text-xl font-semibold transition">
                                Réserver ce trajet ({{ $ride->price }} €)
                            </button>
                        </form>
                    @elseif($isPassenger)
                        <div class="bg-teal-100 text-teal-800 p-8 rounded-3xl text-center text-xl font-medium">
                            ✅ Vous avez réservé ce trajet
                        </div>
                    @endif

                    <p class="text-center text-sm text-gray-500 mt-6">
                        {{ $ride->seats_available }} places restantes
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection