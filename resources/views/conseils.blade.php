@extends('layouts.app')

@section('title', 'Conseils Santé')

@section('content')
<h2 class="text-2xl font-semibold mb-6">Conseils santé et Préventions</h2>

<!-- Formulaire ajout conseil -->
<form id="conseilForm" class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf

    <!-- Catégorie -->
    <div>
        <label for="categorie" class="block font-medium">Catégorie</label>
        <input type="text" id="categorie" name="categorie"
               class="mt-1 p-2 border rounded w-full">
    </div>

    <!-- Contenu -->
    <div>
        <label for="contenu" class="block font-medium">Contenu</label>
        <textarea id="contenu" name="contenu" rows="3"
                  class="mt-1 p-2 border rounded w-full"></textarea>
    </div>

    <!-- Niveau alerte -->
    <div>
        <label for="niveau_alerte" class="block font-medium">Niveau alerte (0-10)</label>
        <input type="number" id="niveau_alerte" name="niveau_alerte" min="0" max="10"
               class="mt-1 p-2 border rounded w-full">
    </div>

    <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Ajouter
    </button>
</form>

<!-- Message -->
<p id="conseilSuccessMessage" class="hidden mt-4 text-green-600 font-semibold">
    Conseil ajouté avec succès !
</p>

<!-- Liste -->
<hr class="my-6">
<h3 class="text-xl font-semibold mb-4">Liste des conseils</h3>
<table class="w-full bg-white shadow rounded-lg overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Catégorie</th>
            <th class="p-3 text-left">Contenu</th>
            <th class="p-3 text-left">Niveau alerte</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody id="conseilsTable"></tbody>
</table>
@endsection
