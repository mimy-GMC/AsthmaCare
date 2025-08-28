@extends('layouts.app')

@section('title', 'Qualité de l\'air')

@section('content')
<!-- Données Locales AQI -->
<h2 class="text-2xl font-heading font-bold mb-6">Suivi de la Qualité de l'air</h2>

<!-- Formulaire ajout mesure -->
<div class="health-card p-6 space-y-4">
    <form id="airForm" class="space-y-4">
        @csrf

        <!-- Date de la mesure -->
        <div>
            <label for="date_mesure" class="health-form-label">Date de mesure</label>
            <input type="datetime-local" id="date_mesure" name="date_mesure" class="health-form-input">
        </div>

        <!-- AQI -->
        <div>
            <label for="aqi" class="health-form-label">Indice AQI (0-500)</label>
            <input type="number" id="aqi" name="aqi" min="0" max="500"
                class="health-form-input">
        </div>

        <!-- Particules -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="pm2_5" class="health-form-label">PM2.5 (µg/m³)</label>
                <input type="number" step="0.01" id="pm2_5" name="pm2_5" class="health-form-input">
            </div>
            <div>
                <label for="pm10" class="health-form-label">PM10 (µg/m³)</label>
                <input type="number" step="0.01" id="pm10" name="pm10" class="health-form-input">
            </div>
        </div>

        <!-- Pollen -->
        <div>
            <label for="pollen" class="health-form-label">Pollen (optionnel)</label>
            <input type="number" id="pollen" name="pollen" min="0" class="health-form-input">
        </div>

        <!-- Localité -->
        <div>
            <label for="localite" class="health-form-label">Localité</label>
            <input type="text" id="localite" name="localite" class="health-form-input">
        </div>

        <button type="submit" class="btn-health btn-health-primary">
            Enregistrer
        </button>
    </form>

    <!-- Message -->
    <p id="airSuccessMessage" class="health-alert health-alert-success hidden mt-4">
        Mesure ajoutée avec succès !
    </p>
</div>

<!-- Historique -->
<hr class="my-6">
<h3 class="text-xl font-heading font-semibold mb-4">Historique Qualité de l'air</h3>
<table class="health-table">
    <thead>
        <tr>
            <th>Date_mesure</th>
            <th>AQI</th>
            <th>PM2.5</th>
            <th>PM10</th>
            <th>Pollen</th>
            <th>Localité</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="airTable"></tbody>
</table>

<!-- Données externes AQI -->
<hr class="my-6">
<h3 class="text-xl font-heading font-semibold mb-4">Qualité de l'air externe (API)</h3>

<div class="health-card p-6 space-y-4">
    <!-- Choix de la ville -->
    <div>
        <label for="citySelect" class="health-form-label">Choisir une ville</label>
        <select id="citySelect" class="health-form-input">
            <option value="48.8566,2.3522">Paris</option>
            <option value="45.7640,4.8357">Lyon</option>
            <option value="43.2965,5.3698">Marseille</option>
            <option value="50.6292,3.0573">Lille</option>
            <option value="44.8378,-0.5792">Bordeaux</option>
        </select>
    </div>

    <button id="fetchExternalAir" class="btn-health btn-health-secondary">
        Récupérer données externes
    </button>

    <!-- Résultats -->
    <div class="mt-4 space-y-2">
        <p><strong>AQI :</strong> <span id="aqi">-</span></p>
        <p><strong>PM2.5 :</strong> <span id="pm25">-</span></p>
        <p><strong>PM10 :</strong> <span id="pm10">-</span></p>
    </div>
</div>
@endsection
