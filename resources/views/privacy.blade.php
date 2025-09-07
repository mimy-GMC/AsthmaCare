@extends('layouts.app')

@section('title', 'Politique de Confidentialité')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold font-serif text-[#4b5ca9ff] mb-8 text-center">Politique de Confidentialité</h1>

        <div class="bg-white shadow-md rounded-xl p-8 space-y-6">
            <p class="text-lg font-serif text-gray-700">
                Chez <strong>AsthmaCare</strong>, la sécurité de vos données personnelles est notre priorité.  
                Nous mettons en œuvre des mesures techniques et organisationnelles pour protéger vos informations contre toute perte, accès non autorisé, fraude ou piratage.
            </p>

            <h2 class="text-2xl font-semibold font-serif text-[#644ba9]">1. Collecte des données</h2>
            <p class="font-serif text-gray-600">
                Nous collectons uniquement les informations nécessaires à l'utilisation de l'application (nom, email, données de santé saisies volontairement).  
                Aucune donnée sensible n'est partagée avec des tiers sans votre consentement.
            </p>

            <h2 class="text-2xl font-semibold font-serif text-[#644ba9]">2. Sécurité</h2>
            <p class="font-serif text-gray-600">
                Toutes vos données sont protégées par des protocoles de sécurité avancés.  
                En cas de tentative de piratage ou de fraude, des mesures légales seront engagées conformément aux lois en vigueur.
            </p>

            <h2 class="text-2xl font-semibold font-serif text-[#644ba9]">3. Vos droits</h2>
            <p class="font-serif text-gray-600">
                Vous disposez d'un droit d'accès, de rectification et de suppression de vos données personnelles.  
                Pour toute demande, contactez-nous via la page <a href="{{ route('contact') }}" class="text-[#644ba9] underline">Contact</a>.
            </p>
        </div>
    </div>
</section>
@endsection
