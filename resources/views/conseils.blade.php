@extends('layouts.app')

@section('title', 'Conseils Santé')

@section('content')
<h2 class="text-2xl font-heading font-bold mb-6">Conseils santé et Pr<div class="health-card p-6 space-y-4">éventions</h2>

<!-- Formulaire ajout conseil -->
<div class="health-card p-6 space-y-4">
    <form id="conseilForm" class="health-card p-6 space-y-4">
        @csrf

        <!-- Catégorie -->
        <div>
            <label for="categorie" class="health-form-label">Catégorie</label>
            <input type="text" id="categorie" name="categorie" class="health-form-input">
        </div>

        <!-- Contenu -->
        <div>
            <label for="contenu" class="health-form-label">Contenu</label>
            <textarea id="contenu" name="contenu" rows="3" class="health-form-textarea"></textarea>
        </div>

        <!-- Niveau alerte -->
        <div>
            <label for="niveau_alerte" class="health-form-label">Niveau alerte (0-10)</label>
            <input type="number" id="niveau_alerte" name="niveau_alerte" min="0" max="10" class="health-form-input">
        </div>

        <button type="submit" class="btn-health btn-health-primary">
            Ajouter
        </button>
    </form>

    <!-- Message -->
    <p id="conseilSuccessMessage" class="health-alert health-alert-success hidden mt-4">
        Conseil ajouté avec succès !
    </p>
</div>

<!-- Liste -->
<hr class="my-6">
<h3 class="text-xl font-heading font-semibold mb-4">Liste des conseils</h3>
<table class="health-table">
    <thead>
        <tr>
            <th>Catégorie</th>
            <th>Contenu</th>
            <th>Niveau alerte</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="conseilsTable"></tbody>
</table>
@endsection
