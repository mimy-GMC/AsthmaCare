<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AsthmaCare - Application de suivi et gestion de l'asthme">
    <title>@yield('title', 'AsthmaCare') - Suivi de votre santé respiratoire</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .main-container {
            min-height: calc(100vh - 200px);
            padding-bottom: 2rem;
        }
    </style>
</head>
<body class="health-body">

    @include('partials.header')

    <main class="main-container">
        @if(!request()->routeIs('dashboard'))
            <div class="page-header">
                <div class="container mx-auto px-4">
                    <h1 class="page-title">@yield('title')</h1>
                    <p class="page-subtitle">@yield('subtitle', 'Gestion de votre santé respiratoire')</p>
                </div>
            </div>
        @endif

        <div class="container mx-auto px-4">
            <!-- Messages de session -->
            @if(session('success'))
                <div class="health-alert health-alert-success pulse">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="health-alert health-alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="health-alert health-alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>Veuillez corriger les erreurs suivantes :</strong>
                        <ul class="mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
