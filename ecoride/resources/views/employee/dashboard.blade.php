@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-teal-700 mb-8">Espace Modérateur</h1>

        <div class="bg-white rounded-3xl p-10 shadow">
            <p class="text-2xl">Avis en attente de validation :</p>
            <p class="text-6xl font-bold text-amber-600 mt-4">{{ $pendingReviews }}</p>
        </div>

        <a href="{{ route('employee.reviews') }}" class="mt-8 inline-block bg-teal-600 text-white px-8 py-4 rounded-2xl">
            Voir les avis à modérer →
        </a>
    </div>
@endsection