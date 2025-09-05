<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'AsthmaCare'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=serif:400,600,700&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="antialiased bg-gray-50">

    {{-- HEADER GLOBAL --}}
    @include('partials.header')

    <main class="pt-20">
        @yield('content')
    </main>

    {{-- FOOTER GLOBAL --}}
    @include('partials.footer')

</body>
</html>
