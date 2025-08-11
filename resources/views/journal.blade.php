@extends('layouts.app')

@section('title', 'Ajouter une crise')

@section('content')
<h2 class="text-2xl font-semibold mb-6">Journal de Symptômes</h2>

<form id="symptomForm" class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf

    <!-- Date et heure -->
    <div>
        <label for="date" class="block font-medium">Date et heure</label>
        <input type="datetime-local" id="date_debut" name="date_debut"
               class="mt-1 p-2 border rounded w-full">
    </div>

    <!-- Intensité -->
    <div>
        <label for="intensite" class="block font-medium">Intensité (1-10)</label>
        <input type="number" id="intensite" name="intensite" min="1" max="10"
               class="mt-1 p-2 border rounded w-full">
    </div>

    <!-- Déclencheurs -->
        <div class="mb-4">
            <label class="block font-medium">Déclencheurs</label>
            <div class="space-y-2">
                @foreach(['pollution', 'pollen', 'froid', 'exercice', 'stress', 'autre'] as $declencheurs)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="declencheurs[]" value="{{ $declencheurs }}" 
                           class="rounded text-blue-500">
                    <span class="ml-2">{{ ucfirst($declencheurs) }}</span>
                </label>
                @endforeach
            </div>
        </div>

    <!-- Commentaires -->
    <div>
        <label for="commentaires" class="block font-medium">Commentaires</label>
        <textarea id="commentaires" name="commentaires" rows="3"
                  class="mt-1 p-2 border rounded w-full"></textarea>
    </div>

    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Enregistrer
    </button>
</form>

<!-- Message de confirmation -->
<p id="successMessage" class="hidden mt-4 text-green-600 font-semibold">
    Symptôme ajouté avec succès !
</p>
@endsection
