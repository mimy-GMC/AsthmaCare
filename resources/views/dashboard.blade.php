<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Bloc Résumé Rapide -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Dernières crises -->
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h3 class="text-lg font-bold text-gray-700 mb-3">Dernières crises</h3>
                <div id="dashboard-symptomes" class="text-gray-600">
                    <p class="text-sm">Chargement...</p>
                </div>
            </div>

            <!-- Qualité de l'air -->
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h3 class="text-lg font-bold text-gray-700 mb-3">Qualité de l’air</h3>
                <div id="dashboard-airQualite" class="text-gray-600">
                    <p class="text-sm">Chargement...</p>
                </div>
            </div>

            <!-- Conseils -->
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h3 class="text-lg font-bold text-gray-700 mb-3">Conseil du jour</h3>
                <div id="dashboard-conseil" class="text-gray-600">
                    <p class="text-sm">Chargement...</p>
                </div>
            </div>
        </div>

        <!-- Bloc Graphique Aperçu -->
        <div class="bg-white shadow-md rounded-2xl p-6">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Aperçu des crises</h3>
            <canvas id="dashboardChart" height="120"></canvas>
        </div>
    </div>
</x-app-layout>
