<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AsthmaCare</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
</head>
<body class="bg-gray-50 text-gray-900">

    @include('partials.header')

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    @include('partials.footer')

    @vite('resources/js/app.js') {{-- Pour Axios, Chart.js plus tard --}}
</body>
</html>
