@extends('layouts.app')

@section('title', 'Ajouter une crise')

@section('content')
<div class="space-y-6">
    <h2 class="text-2xl font-semibold mb-6">Journal de Symptômes</h2>

    <!-- Formulaire -->
    <form id="symptomForm" class="health-card space-y-4">
        @csrf

        <!-- Date et heure -->
        <div>
            <label for="date_debut" class="block font-medium text-gray-700">Date et heure</label>
            <input type="datetime-local" id="date_debut" name="date_debut" class="health-form-input mt-1 w-full">
        </div>

        <!-- Intensité -->
        <div>
            <label for="intensite" class="block font-medium text-gray-700">Intensité (1-10)</label>
            <input type="number" id="intensite" name="intensite" min="1" max="10" class="health-form-input mt-1 w-full">
        </div>

        <!-- Déclencheurs -->
        <div>
            <label class="block font-medium text-gray-700">Déclencheurs</label>
            <div class="grid grid-cols-2 gap-2 mt-2">
                @foreach(['pollution', 'pollen', 'froid', 'exercice', 'stress', 'autre'] as $declencheur)
                <label class="inline-flex items-center health-card p-2 cursor-pointer hover:shadow-md">
                    <input type="checkbox" name="declencheurs[]" value="{{ $declencheur }}" class="rounded text-primary">
                    <span class="ml-2 capitalize">{{ ucfirst($declencheur) }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Commentaires -->
        <div>
            <label for="commentaires" class="block font-medium text-gray-700">Commentaires</label>
            <textarea id="commentaires" name="commentaires" rows="3" class="health-form-input mt-1 w-full"></textarea>
        </div>

        <button type="submit" class="btn-health btn-health-primary">
            Enregistrer
        </button>
    </form>

    <!-- Message de confirmation -->
    <p id="successMessage" class="hidden text-green-600 font-semibold health-alert health-alert-success mt-4">
        Symptôme ajouté avec succès !
    </p>

    <!-- Liste des récentes crises -->
    <hr class="my-6">
    <h3 class="text-xl font-heading font-semibold text-gray-800 mb-4">Mes récentes crises</h3>
    <div class="overflow-x-auto health-card">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left">
                    <th class="p-3">Date début</th>
                    <th class="p-3">Intensité</th>
                    <th class="p-3">Déclencheurs</th>
                    <th class="p-3">Commentaires</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="symptomsTable" class="divide-y"></tbody>
        </table>
    </div>
</div>
@endsection
