@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">À propos d'AsthmaCare</h1>
        <p class="text-lg text-gray-600 mb-8">
            AsthmaCare est une application web dédiée au suivi et à la gestion de l'asthme. 
            Elle permet aux utilisateurs d'enregistrer leurs crises, d'analyser les déclencheurs, de suivre la qualité de l'air et de recevoir des conseils personnalisés pour améliorer leur santé respiratoire.
        </p>

        <div class="health-card inline-block p-8 mt-8">
            <div class="health-card-header text-center">
                <i class="fas fa-user-cog text-5xl mb-3"></i>
                <h2 class="text-2xl font-semibold">Miryam GAKOSSO</h2>
            </div>
            <div class="health-card-body text-gray-700">
                <p>Développeur et concepteur d'AsthmaCare. Passionné par la santé numérique et le bien-être respiratoire, Miryam a créé cette application pour offrir un outil simple, efficace et esthétique pour tous les utilisateurs.</p>
            </div>
        </div>
    </div>
</section>
@endsection
