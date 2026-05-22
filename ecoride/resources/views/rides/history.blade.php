@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-emerald-700 mb-10">Mes Trajets</h1>

    <!-- En tant que conducteur -->
    <h2 class="text-2xl font-semibold mb-6 text-emerald-600">🚗 Trajets publiés</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
        @foreach($asDriver as $ride)
            <div class="bg-white border border-emerald-100 rounded-3xl p-8">
                <div class="flex justify-between">
                    <div>
                        <p class="font-bold text-xl">{{ $ride->departure_city }} → {{ $ride->arrival_city }}</p>
                        <p class="text-emerald-600">{{ $ride->departure_datetime->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="px-4 py-2 rounded-2xl text-sm font-medium
                            @if($ride->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($ride->status == 'completed') bg-emerald-100 text-emerald-700 @endif">
                            {{ ucfirst($ride->status) }}
                        </span>
                    </div>
                </div>
                <p class="mt-4">Places restantes : <strong>{{ $ride->seats_available }}</strong></p>
                <a href="{{ route('rides.show', $ride) }}" class="mt-6 inline-block text-emerald-600 font-medium">Voir détails →</a>
            </div>
        @endforeach
    </div>

    <!-- En tant que passager -->
    <h2 class="text-2xl font-semibold mb-6 text-teal-600">🧳 Trajets réservés</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($asPassenger as $ride)
            <div class="bg-white border border-teal-100 rounded-3xl p-8">
                <p class="font-bold text-xl">{{ $ride->departure_city }} → {{ $ride->arrival_city }}</p>
                <p class="text-teal-600">{{ $ride->departure_datetime->format('d/m/Y H:i') }}</p>
                <p class="mt-2">Conducteur : <strong>{{ $ride->driver->pseudo }}</strong></p>
                <a href="{{ route('rides.show', $ride) }}" class="mt-6 inline-block text-teal-600 font-medium">Voir le trajet →</a>
            </div>
        @endforeach
    </div>
</div>
@endsection