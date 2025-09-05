@extends('layouts.app')

@section('content')
    <!-- Section Hero -->
    <section class="relative bg-gradient-to-r from-cyan-50 to-indigo-200 pt-32 pb-20 text-center overflow-hidden">
        <div class="container mx-auto px-6">
            <h1 
                class="text-4xl md:text-5xl font-extrabold font-serif text-[#4b5ca9ff] mb-6 leading-tight animate-fade-in-up text-center"
            >
                <span class="typewriter">Bienvenue sur <span class="text-[#7547a3ff]">AsthmaCare</span></span>
            </h1>
            <p 
                class="text-lg font-serif md:text-xl text-gray-600 mb-8 max-w-2xl mx-auto animate-fade-in delay-200"
            >
                L'application web qui vous aide à mieux vivre avec l'asthme, grâce à un suivi personnalisé et à l'intégration de données environnementales.
            </p>
            <div class="flex justify-center space-x-4 animate-fade-in delay-300">
                <a href="{{ route('features') }}" class="btn-health btn-health-secondary font-serif hover:scale-105 transform transition flex items-center gap-2 group">
                    Découvrir
                    <i class="fas fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Section Fonctionnalités -->
    <section id="features" class="bg-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-serif font-bold text-[#4b5ca9ff] mb-12">
                Fonctionnalités principales
            </h2>
            <div class="grid md:grid-cols-3 gap-12">
                <!-- Journal -->
                <div class="font-serif p-6 shadow-lg rounded-2xl bg-sky-50 hover:shadow-xl transform hover:scale-105 transition duration-300 animate-fade-in-up">
                    <i class="fas fa-notes-medical text-4xl text-[#681c7dc9] mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">Journal des symptômes</h3>
                    <p class="text-gray-600 text-sm font-serif">
                        Suivez vos crises, notez leur intensité et identifiez les déclencheurs.
                    </p>
                </div>
                <!-- Qualité de l'air -->
                <div class="font-serif p-6 shadow-lg rounded-2xl bg-sky-50 hover:shadow-xl transform hover:scale-105 transition duration-300 animate-fade-in-up delay-200">
                    <i class="fas fa-cloud text-4xl text-[#681c7dc9] mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">Qualité de l'air</h3>
                    <p class="text-gray-600 text-sm font-serif">
                        Intégration des données météo et pollution pour anticiper vos crises.
                    </p>
                </div>
                <!-- Conseils -->
                <div class="font-serif p-6 shadow-lg rounded-2xl bg-sky-50 hover:shadow-xl transform hover:scale-105 transition duration-300 animate-fade-in-up delay-400">
                    <i class="fas fa-lightbulb text-4xl text-[#681c7dc9] mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">Conseils personnalisés</h3>
                    <p class="text-gray-600 text-sm font-serif">
                        Recevez des recommandations adaptées à vos habitudes et à votre environnement.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Call-to-Action -->
    <section class="bg-gradient-to-r from-[#4b5ca9ff] to-[#7547a3ff] py-16 text-center text-white relative overflow-hidden">
        <div class="container font-serif mx-auto px-6">
            <h2 class="text-3xl font-bold mb-6">Prenez le contrôle de votre santé respiratoire</h2>
            <p class="mb-8 text-lg">
                Rejoignez dès maintenant AsthmaCare et vivez plus sereinement avec l'asthme.
            </p>
        </div>

        <!-- Effet visuel animé en arrière-plan -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
            <div class="w-72 h-72 bg-white rounded-full absolute -top-10 -left-10 animate-pulse"></div>
            <div class="w-96 h-96 bg-white rounded-full absolute bottom-0 right-0 animate-ping"></div>
        </div>
    </section>
@endsection


