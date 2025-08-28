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
    <header class="health-header bg-primary text-white shadow-md">
        <nav class="health-nav container mx-auto flex justify-between items-center py-4 px-4 md:px-0">
            <a href="{{ url('/') }}" class="health-brand flex items-center gap-2 text-xl font-bold">
                <i class="fas fa-lungs"></i> AsthmaCare
            </a>

            <ul class="health-nav-menu flex gap-4">
                <li><a href="{{ route('features') }}" class="health-nav-link {{ request()->routeIs('features') ? 'active' : '' }}"><i class="fas fa-th-large"></i> Fonctionnalités</a></li>
                <li><a href="{{ route('about') }}" class="health-nav-link {{ request()->routeIs('about') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> À propos</a></li>
                <li><a href="{{ route('contact') }}" class="health-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Contact</a></li>
            </ul>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-health btn-health-primary">
                            <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="health-nav-link">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-health btn-health-primary">
                                <i class="fas fa-user-plus mr-2"></i> Inscription
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
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
    </section>

    <!-- Sections intégrées via routes -->
    <main class="bg-gray-50">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

</body>
</html>
