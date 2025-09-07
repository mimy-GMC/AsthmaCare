@extends('layouts.app')

@section('title', 'Fonctionnalités')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold font-serif text-[#644ba9] mb-4">Fonctionnalités AsthmaCare</h1>
            <p class="text-lg font-serif text-gray-600">Découvrez toutes nos fonctionnalités pour gérer votre asthme au quotidien et celles en perspectives d'évolution.</p>
        </div>

        <!-- Toutes les fonctionnalités -->
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
                    <h3 class="text-xl font-semibold">Notifications push</h3>
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

            <!-- OpenWeatherMap -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-cloud text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">OpenWeatherMap Air Pollution</h3>
                </div>
                <div class="health-card-body">
                    <p>Données AQI, PM2.5, PM10, ozone et plus pour surveiller la qualité de l'air en temps réel selon votre localisation.</p>
                </div>
            </div>

            <!-- Leaflet.js -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-map text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">Leaflet.js</h3>
                </div>
                <div class="health-card-body">
                    <p>Cartographie interactive avec couches colorées représentant les niveaux AQI sur votre zone.</p>
                </div>
            </div>

            <!-- Chart.js -->
            <div class="health-card text-center">
                <div class="health-card-header">
                    <i class="fas fa-chart-pie text-4xl mb-3"></i>
                    <h3 class="text-xl font-semibold">Chart.js</h3>
                </div>
                <div class="health-card-body">
                    <p>Visualisation des données santé : évolution des crises, intensité moyenne, déclencheurs fréquents.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Perspectives d'évolution -->
<section class="py-20 bg-cyan-50 border-t">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fas fa-mobile-alt text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Application mobile</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Suivi nomade grâce à une app React Native ou Expo.</p>
                    </div>
                </div>

                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fas fa-file-pdf text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Export PDF</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Partage facile de vos données santé avec votre médecin.</p>
                    </div>
                </div>

                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fa-brands fa-avianex text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Mode hors-ligne</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Utilisation sans internet avec synchronisation automatique.</p>
                    </div>
                </div>

                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fas fa-microchip text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">IoT & capteurs</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Connexion avec capteurs de qualité de l'air personnels.</p>
                    </div>
                </div>

                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fas fa-robot text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">IA prédictive</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Anticipation des crises grâce à l'analyse des données historiques.</p>
                    </div>
                </div>

                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fas fa-user-md text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Espace médecin</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Partage sécurisé des données patients avec les professionnels.</p>
                    </div>
                </div>

                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fas fa-capsules text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Inhalateurs connectés</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Synchronisation avec inhalateurs et objets santé connectés.</p>
                    </div>
                </div>

                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fas fa-users text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Communauté</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Partage anonymisé de données entre patients.</p>
                    </div>
                </div>

                <div class="health-card text-center">
                    <div class="health-card-header">
                        <i class="fas fa-hospital text-4xl mb-3"></i>
                        <h3 class="text-xl font-semibold">Dossiers médicaux</h3>
                    </div>
                    <div class="health-card-body">
                        <p>Intégration avec les dossiers médicaux électroniques.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
