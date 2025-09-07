@extends('layouts.app')

@section('title', 'Conditions d\'utilisation')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold font-serif text-[#4b5ca9ff] mb-8 text-center">Conditions d'utilisation</h1>

        <div class="bg-white shadow-md rounded-xl p-8 space-y-6">
            <p class="text-lg font-serif text-gray-700">
                En utilisant <strong>AsthmaCare</strong>, vous acceptez les présentes conditions d'utilisation.  
                Notre objectif est de garantir un usage sécurisé et respectueux de l'application.
            </p>

            <h2 class="text-2xl font-semibold font-serif text-[#644ba9]">1. Utilisation responsable</h2>
            <p class="font-serif text-gray-600">
                L'application est destinée uniquement à un usage personnel pour le suivi de la santé respiratoire.  
                Toute tentative de fraude, piratage ou détournement est strictement interdite et pourra entraîner des poursuites judiciaires.
            </p>

            <h2 class="text-2xl font-semibold font-serif text-[#644ba9]">2. Limitation de responsabilité</h2>
            <p class="font-serif text-gray-600">
                AsthmaCare fournit des outils de suivi mais ne remplace pas l'avis médical.  
                L'utilisateur reste responsable de sa santé et doit consulter un professionnel en cas de besoin.
            </p>

            <h2 class="text-2xl font-semibold font-serif text-[#644ba9]">3. Modification des conditions</h2>
            <p class="font-serif text-gray-600">
                Nous nous réservons le droit de modifier ces conditions à tout moment afin de garantir la sécurité et la conformité légale.  
                Les utilisateurs seront informés en cas de changement important.
            </p>
        </div>
    </div>
</section>
@endsection
