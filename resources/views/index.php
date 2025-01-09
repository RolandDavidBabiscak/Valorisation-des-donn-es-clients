@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Commentaires pour l'entreprise {{ $id }}</h1>

    <!-- Liste des commentaires -->
    <div class="space-y-4">
        @forelse ($commentaires as $commentaire)
            <div class="p-4 bg-gray-100 rounded shadow">
                <p class="text-gray-700">{{ $commentaire->contenu }}</p>
                <span class="text-sm text-gray-500">Ajouté le {{ $commentaire->created_at->format('d/m/Y') }}</span>
            </div>
        @empty
            <p class="text-gray-500">Aucun commentaire trouvé pour cette entreprise.</p>
        @endforelse
    </div>

    <!-- Formulaire pour ajouter un commentaire -->
    <div class="mt-6">
        <form action="{{ route('commentaires.store') }}" method="POST">
            @csrf
            <input type="hidden" name="entreprise_id" value="{{ $id }}">
            <textarea name="contenu" rows="3" class="w-full p-3 border rounded mb-4" placeholder="Ajouter un commentaire..." required></textarea>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Ajouter un commentaire
            </button>
        </form>
    </div>
</div>
@endsection
