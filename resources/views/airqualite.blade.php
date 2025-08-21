@extends('layouts.app')

@section('title', 'Qualité de l\'air')

@section('content')
<h2 class="text-2xl font-semibold mb-6">Suivi de la Qualité de l'air</h2>

<!-- Formulaire ajout mesure -->
<form id="airForm" class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf

    <!-- Date de la mesure -->
    <div>
        <label for="date_mesure" class="block font-medium">Date de mesure</label>
        <input type="date" id="date_mesure" name="date_mesure"
               class="mt-1 p-2 border rounded w-full">
    </div>

    <!-- AQI -->
    <div>
        <label for="aqi" class="block font-medium">Indice AQI (0-500)</label>
        <input type="number" id="aqi" name="aqi" min="0" max="500"
               class="mt-1 p-2 border rounded w-full">
    </div>

    <!-- Particules -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="pm2_5" class="block font-medium">PM2.5 (µg/m³)</label>
            <input type="number" step="0.01" id="pm2_5" name="pm2_5"
                   class="mt-1 p-2 border rounded w-full">
        </div>
        <div>
            <label for="pm10" class="block font-medium">PM10 (µg/m³)</label>
            <input type="number" step="0.01" id="pm10" name="pm10"
                   class="mt-1 p-2 border rounded w-full">
        </div>
    </div>

    <!-- Pollen -->
    <div>
        <label for="pollen" class="block font-medium">Pollen (optionnel)</label>
        <input type="number" id="pollen" name="pollen" min="0"
               class="mt-1 p-2 border rounded w-full">
    </div>

    <!-- Localité -->
    <div>
        <label for="localite" class="block font-medium">Localité</label>
        <input type="text" id="localite" name="localite"
               class="mt-1 p-2 border rounded w-full">
    </div>

    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Enregistrer
    </button>
</form>

<!-- Message -->
<p id="airSuccessMessage" class="hidden mt-4 text-green-600 font-semibold">
    Mesure ajoutée avec succès !
</p>

<!-- Liste -->
<hr class="my-6">
<h3 class="text-xl font-semibold mb-4">Historique Qualité de l'air</h3>
<table class="w-full bg-white shadow rounded-lg overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Date</th>
            <th class="p-3 text-left">AQI</th>
            <th class="p-3 text-left">PM2.5</th>
            <th class="p-3 text-left">PM10</th>
            <th class="p-3 text-left">Pollen</th>
            <th class="p-3 text-left">Localité</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody id="airTable"></tbody>
</table>
@endsection
