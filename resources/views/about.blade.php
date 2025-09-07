@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <div>
            <h1 class="text-4xl font-bold font-serif text-[#4b5ca9ff] mb-12">À propos d'AsthmaCare</h1>
            <p class="text-lg font-serif text-gray-600 mb-6 text-justify">
                AsthmaCare est une application web innovante dédiée au suivi et à la gestion de l'asthme.  
                Elle aide les utilisateurs à <strong>enregistrer leurs crises</strong>, <strong>analyser les déclencheurs</strong>, <strong>suivre la qualité de l'air</strong> et recevoir des <strong>recommandations personnalisées</strong>.  
            </p>
            <p class="text-lg font-serif text-gray-600 mb-6 text-justify">
                Grâce à l'intégration de <strong>données environnementales en temps réel</strong> (pollution, allergènes, météo) et des <strong>outils de visualisation (graphiques, cartes interactives)</strong>, AsthmaCare permet une meilleure compréhension de l’évolution de la maladie.  
            </p>
            <p class="text-lg font-serif text-gray-600 text-justify">
                Notre objectif est de fournir un outil <strong>simple, esthétique et accessible</strong> qui accompagne les patients au quotidien et facilite le dialogue avec les professionnels de santé.  
            </p>
        </div>

        <div class="health-card p-8 text-center">
            <div class="health-card-header">
                <img src="https://img.freepik.com/photos-premium/femme-affaires-noire-portrait-franc-jeune-professionnel-regardant-camera-confiance_817921-955.jpg" 
                alt="Avatar développeur" 
                class="mx-auto rounded-full mb-8 shadow-md object-cover">
                
                <h2 class="text-2xl font-serif font-semibold">Miryam GAKOSSO</h2>
            </div>
            <div class="health-card-body text-gray-700 mt-4">
                <p>
                    Développeuse et conceptrice d'AsthmaCare.  
                    Passionnée par la <strong>santé numérique</strong> et le <strong>bien-être respiratoire</strong>, 
                    Miryam a créé cette application pour offrir aux patients un outil pratique, sécurisé et moderne pour mieux gérer leur asthme.
                </p>
                <p class="mt-4">
                    Son objectif est de combiner <strong>innovation technologique</strong> et <strong>impact social</strong>, 
                    afin de rendre les solutions digitales de santé accessibles à tous.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
