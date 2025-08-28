@extends('layouts.app')

@section('title', 'Fonctionnalités')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Fonctionnalités AsthmaCare</h1>
            <p class="text-lg text-gray-600">Découvrez toutes les fonctionnalités et nouveautés de notre application pour gérer votre asthme au quotidien.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Journal des symptômes -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-book-medical text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">Journal des symptômes</h3>
                </div>
                <div class="health-card-body">
                    <p>Enregistrez vos crises, intensités, déclencheurs et commentaires pour un suivi précis.</p>
                </div>
            </div>

            <!-- Qualité de l'air -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-wind text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">Qualité de l'air</h3>
                </div>
                <div class="health-card-body">
                    <p>Consultez la qualité de l'air autour de vous avec des alertes AQI pour protéger vos poumons.</p>
                </div>
            </div>

            <!-- Conseils personnalisés -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-lightbulb text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">Conseils personnalisés</h3>
                </div>
                <div class="health-card-body">
                    <p>Recevez des recommandations adaptées à votre état et aux conditions environnementales.</p>
                </div>
            </div>

            <!-- Carte interactive -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-map-marked-alt text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">Carte interactive</h3>
                </div>
                <div class="health-card-body">
                    <p>Visualisez les zones à risque, les stations météo et les niveaux de pollution en temps réel.</p>
                </div>
            </div>

            <!-- Nouveauté: Alertes push -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-bell text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">Alertes push</h3>
                </div>
                <div class="health-card-body">
                    <p>Recevez des notifications instantanées en cas de pic de pollution ou conditions dangereuses.</p>
                </div>
            </div>

            <!-- Nouveauté: Statistiques & Graphiques -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-chart-line text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">Statistiques avancées</h3>
                </div>
                <div class="health-card-body">
                    <p>Visualisez vos crises et tendances sous forme de graphiques pour mieux comprendre votre santé.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
