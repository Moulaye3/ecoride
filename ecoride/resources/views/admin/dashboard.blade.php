@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-emerald-700 mb-10">Dashboard Administrateur</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-3xl p-8 shadow">
            <p class="text-gray-500">Utilisateurs totaux</p>
            <p class="text-5xl font-bold text-emerald-600 mt-2">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-white rounded-3xl p-8 shadow">
            <p class="text-gray-500">Trajets publiés</p>
            <p class="text-5xl font-bold text-emerald-600 mt-2">{{ $stats['total_rides'] }}</p>
        </div>
        <div class="bg-white rounded-3xl p-8 shadow">
            <p class="text-gray-500">Avis en attente</p>
            <p class="text-5xl font-bold text-amber-600 mt-2">{{ $stats['pending_reviews'] }}</p>
        </div>
        <div class="bg-white rounded-3xl p-8 shadow">
            <p class="text-gray-500">Trajets terminés</p>
            <p class="text-5xl font-bold text-teal-600 mt-2">{{ $stats['completed_rides'] }}</p>
        </div>
    </div>

    <div class="mt-12">
        <a href="{{ route('admin.reviews') }}" 
           class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-2xl inline-block font-medium">
            Gérer les avis en attente →
        </a>
    </div>
</div>
@endsection