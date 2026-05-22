@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-emerald-700">Mes Véhicules</h1>
        <a href="{{ route('vehicles.create') }}" class="bg-emerald-600 text-white px-8 py-4 rounded-2xl font-semibold hover:bg-emerald-700">
            + Ajouter un véhicule
        </a>
    </div>

    @if($vehicles->isEmpty())
        <p class="text-center text-gray-500 py-12">Vous n'avez pas encore de véhicule.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($vehicles as $vehicle)
                <div class="bg-white border border-emerald-100 rounded-3xl p-8 hover:shadow-xl transition">
                    <p class="text-2xl font-bold">{{ $vehicle->brand }} {{ $vehicle->model }}</p>
                    <p class="text-emerald-600">{{ $vehicle->plate }}</p>
                    <p class="text-sm mt-4">{{ $vehicle->seats }} places • {{ ucfirst($vehicle->energy) }}</p>
                    
                    <div class="flex gap-3 mt-8">
                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="flex-1 text-center py-3 border border-emerald-600 text-emerald-600 rounded-2xl hover:bg-emerald-50">Modifier</a>
                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce véhicule ?')" 
                                    class="w-full py-3 border border-red-600 text-red-600 rounded-2xl hover:bg-red-50">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection