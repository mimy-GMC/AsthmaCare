<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AsthmaCare') }} - Connexion / Inscription</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }
    </style>
</head>
<body class="health-body font-body">

    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="mb-6 flex items-center gap-2 text-2xl font-bold text-primary">
            <i class="fas fa-lungs"></i> AsthmaCare
        </a>

        <!-- Carte du formulaire -->
        <div class="w-full sm:max-w-md px-6 py-6 bg-white health-card">
            {{ $slot }}
        </div>

        <!-- Footer mini -->
        <footer class="mt-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} AsthmaCare - Développé par Miryam GAKOSSO
        </footer>
    </div>

</body>
</html>
