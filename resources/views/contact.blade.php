@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6 text-center">Contact & Réseaux sociaux</h1>
        <p class="text-center text-gray-600 mb-12">Vous pouvez contacter notre équipe ou suivre nos activités sur les réseaux sociaux.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Formulaire Contact -->
            <div class="health-card health-form">
                <h2 class="text-2xl font-semibold mb-4">Envoyer un message</h2>
                <form>
                    <label class="health-form-label" for="name">Nom</label>
                    <input class="health-form-input mb-4" type="text" id="name" placeholder="Votre nom">

                    <label class="health-form-label" for="email">Email</label>
                    <input class="health-form-input mb-4" type="email" id="email" placeholder="Votre email">

                    <label class="health-form-label" for="message">Message</label>
                    <textarea class="health-form-input mb-4" id="message" rows="4" placeholder="Votre message"></textarea>

                    <button type="submit" class="btn-health btn-health-primary w-full">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
