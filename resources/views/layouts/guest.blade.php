<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AsthmaCare') }} - Connexion / Inscription</title>

    <!-- TailwindCSS & FontAwesome -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">

        <!-- Form Container -->
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
