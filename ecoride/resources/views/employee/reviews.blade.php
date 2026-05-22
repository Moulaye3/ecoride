@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-emerald-700 mb-8">Avis en attente de modération</h1>

    @if($reviews->isEmpty())
        <p class="text-gray-500 text-center py-12">Aucun avis en attente.</p>
    @else
        <div class="bg-white rounded-3xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-emerald-50">
                    <tr>
                        <th class="px-6 py-5 text-left">Trajet</th>
                        <th class="px-6 py-5 text-left">Auteur</th>
                        <th class="px-6 py-5 text-left">Note</th>
                        <th class="px-6 py-5 text-left">Commentaire</th>
                        <th class="px-6 py-5 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($reviews as $review)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-5">
                            {{ $review->ride->departure_city }} → {{ $review->ride->arrival_city }}
                        </td>
                        <td class="px-6 py-5">{{ $review->reviewer->pseudo }}</td>
                        <td class="px-6 py-5">
                            <span class="font-bold">{{ $review->rating }} / 5</span>
                        </td>
                        <td class="px-6 py-5 text-sm">{{ Str::limit($review->comment, 80) }}</td>
                        <td class="px-6 py-5 text-center">
                            <form action="{{ route('admin.reviews.validate', $review) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-emerald-600 text-white px-5 py-2 rounded-xl text-sm hover:bg-emerald-700">
                                    Valider
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.reviews.refuse', $review) }}" method="POST" class="inline ml-2">
                                @csrf
                                <button type="submit" onclick="return confirm('Refuser cet avis ?')" 
                                        class="bg-red-600 text-white px-5 py-2 rounded-xl text-sm hover:bg-red-700">
                                    Refuser
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection