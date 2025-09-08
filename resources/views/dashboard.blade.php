@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <h2 class="font-serif font-semibold text-xl text-gray-800 leading-tight">
        Votre tableau de bord
    </h2>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Bloc Résumé Rapide -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Dernières crises -->
            <div class="health-card p-6 shadow-md rounded-xl bg-white">
                <h3 class="text-lg font-serif font-bold mb-3">Dernières crises</h3>
                <ul id="dashboard-symptomes" class="space-y-2 text-sm text-gray-600">
                    <li>Chargement...</li>
                </ul>
            </div>

            <!-- Qualité de l'air -->
            <div class="health-card p-6 shadow-md rounded-xl bg-white">
                <h3 class="text-lg font-serif font-bold mb-3">Qualité de l’air</h3>
                <div id="dashboard-airQualite" class="space-y-2 text-sm text-gray-600">
                    <p>Chargement...</p>
                </div>
            </div>

            <!-- Conseils -->
            <div class="health-card p-6 shadow-md rounded-xl bg-white">
                <h3 class="text-lg font-serif font-bold mb-3">Conseil du jour</h3>
                <div id="dashboard-conseil" class="space-y-2 text-sm text-gray-600">
                    <p>Chargement...</p>
                </div>
            </div>
        </div>

        <!-- Bloc Graphique Aperçu -->
        <div class="health-card p-6 shadow-md rounded-xl bg-white">
            <h3 class="text-lg font-serif font-bold mb-4">Aperçu des crises</h3>
            <canvas id="dashboardChart" height="120"></canvas>
        </div>

        <!-- Bloc Carte -->
        <div class="health-card p-6 shadow-md rounded-xl bg-white">
            <h3 class="text-lg font-serif font-bold mb-4">Carte de la qualité de l'air</h3>
            <div id="map" class="w-full h-96 rounded-xl"></div>
        </div>
    </div>
@endsection
