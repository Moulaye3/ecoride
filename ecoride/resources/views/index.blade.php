@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-emerald-800 mb-8">Covoiturages disponibles</h1>

    <form action="{{ route('rides.search') }}" method="GET" class="mb-10 grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="text" name="departure_city" placeholder="Départ" class="border rounded-xl px-5 py-4">
        <input type="text" name="arrival_city" placeholder="Arrivée" class="border rounded-xl px-5 py-4">
        <input type="date" name="date" class="border rounded-xl px-5 py-4">
        <button type="submit" class="bg-emerald-600 text-white rounded-xl font-medium">Rechercher</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rides as $ride)
            <div class="bg-white border border-emerald-100 rounded-3xl p-6 hover:shadow-xl transition">
                <div class="flex justify-between">
                    <div>
                        <p class="text-emerald-700 font-bold">{{ $ride->departure_city }} → {{ $ride->arrival_city }}</p>
                        <p class="text-sm text-gray-500">{{ $ride->departure_datetime->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-emerald-600">{{ $ride->price }} €</p>
                    </div>
                </div>
                <p class="mt-4 text-sm">Conducteur : <strong>{{ $ride->driver->pseudo }}</strong></p>
                <p class="text-sm">Places : {{ $ride->seats_available }}</p>
                
                <a href="#" class="mt-6 block text-center bg-emerald-600 text-white py-4 rounded-2xl font-medium hover:bg-emerald-700">
                    Réserver
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection