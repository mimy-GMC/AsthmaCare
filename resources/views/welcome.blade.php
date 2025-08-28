<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="AsthmaCare - Application de suivi et gestion de l'asthme">
        <title>AsthmaCare - Votre compagnon santé respiratoire</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css'])
        
        <style>
            .hero-section {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
            }
            
            .feature-card {
                transition: all 0.3s ease;
            }
            
            .feature-card:hover {
                transform: translateY(-10px);
            }
            
            .health-stat {
                background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
                border-radius: var(--border-radius);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Navigation -->
        <nav class="health-header">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="health-brand">
                            <i class="fas fa-lungs mr-2"></i> AsthmaCare
                        </a>
                    </div>
                    
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="#features" class="health-nav-link">Fonctionnalités</a>
                        <a href="#about" class="health-nav-link">À propos</a>
                        <a href="#contact" class="health-nav-link">Contact</a>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="health-nav-link">Tableau de bord</a>
                            @else
                                <a href="{{ route('login') }}" class="health-nav-link">Connexion</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-health btn-health-primary">
                                        Inscription
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center text-white">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6">
                        Prenez le contrôle de votre santé respiratoire
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 opacity-90">
                        AsthmaCare vous aide à suivre et gérer votre asthme au quotidien
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-health btn-health-primary text-lg px-8 py-3">
                                <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-health btn-health-primary text-lg px-8 py-3">
                                <i class="fas fa-user-plus mr-2"></i> Commencer gratuitement
                            </a>
                            <a href="{{ route('login') }}" class="btn-health bg-white text-blue-600 text-lg px-8 py-3">
                                <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Fonctionnalités principales
                    </h2>
                    <p class="text-xl text-gray-600">
                        Tout ce dont vous avez besoin pour mieux gérer votre asthme
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="health-card feature-card text-center">
                        <div class="health-card-header">
                            <i class="fas fa-book-medical text-4xl mb-4"></i>
                            <h3 class="text-xl font-semibold">Journal des symptômes</h3>
                        </div>
                        <div class="health-card-body">
                            <p>Suivez vos crises d'asthme, leur intensité et les déclencheurs pour mieux comprendre votre condition.</p>
                        </div>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="health-card feature-card text-center">
                        <div class="health-card-header">
                            <i class="fas fa-wind text-4xl mb-4"></i>
                            <h3 class="text-xl font-semibold">Qualité de l'air</h3>
                        </div>
                        <div class="health-card-body">
                            <p>Surveillez la qualité de l'air autour de vous et recevez des alertes lorsque les conditions se détériorent.</p>
                        </div>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="health-card feature-card text-center">
                        <div class="health-card-header">
                            <i class="fas fa-lightbulb text-4xl mb-4"></i>
                            <h3 class="text-xl font-semibold">Conseils personnalisés</h3>
                        </div>
                        <div class="health-card-body">
                            <p>Recevez des recommandations adaptées à votre condition et à l'environnement.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="health-stat text-center p-6">
                        <div class="text-4xl font-bold mb-2">24/7</div>
                        <div class="text-lg">Surveillance continue</div>
                    </div>
                    <div class="health-stat text-center p-6">
                        <div class="text-4xl font-bold mb-2">100%</div>
                        <div class="text-lg">Données sécurisées</div>
                    </div>
                    <div class="health-stat text-center p-6">
                        <div class="text-4xl font-bold mb-2">1000+</div>
                        <div class="text-lg">Utilisateurs satisfaits</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">AsthmaCare</h3>
                        <p class="text-gray-400">Votre compagnon pour une meilleure santé respiratoire.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Navigation</h3>
                        <ul class="space-y-2">
                            <li><a href="#features" class="text-gray-400 hover:text-white">Fonctionnalités</a></li>
                            <li><a href="#about" class="text-gray-400 hover:text-white">À propos</a></li>
                            <li><a href="#contact" class="text-gray-400 hover:text-white">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Légal</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Confidentialité</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Conditions d'utilisation</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact</h3>
                        <p class="text-gray-400">support@asthmacare.com</p>
                        <div class="flex space-x-4 mt-4">
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                    <p class="text-gray-400">© {{ date('Y') }} AsthmaCare. Développé par Miryam GAKOSSO. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </body>
</html>