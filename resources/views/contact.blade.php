@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="py-16 bg-gray-50 min-h-screen flex items-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <h1 class="text-4xl font-semibold text-[#644ba9] font-serif mb-16 text-center">
            Vous pouvez nous contacter
        </h1>
    
        <div class="flex justify-center">
            <!-- Formulaire Contact -->
            <div class="health-card health-form w-full max-w-lg">
                <h2 class="text-xl font-normal font-serif mb-6 text-center">Envoyer un message</h2>
                
                <!-- Message de statut -->
                <div id="contact-message" class="hidden mb-4 p-3 rounded"></div>
                
                <form action="{{ route('contact.send') }}" method="POST" id="contact-form">
                    @csrf
                    <label class="health-form-label" for="name">Nom</label>
                    <input class="health-form-input font-serif mb-4" type="text" id="name" name="name" placeholder="Votre nom" required>

                    <label class="health-form-label" for="email">Email</label>
                    <input class="health-form-input font-serif mb-4" type="email" id="email" name="email" placeholder="Votre email" required>

                    <label class="health-form-label" for="message">Message</label>
                    <textarea class="health-form-input font-serif mb-6" id="message" name="message" rows="4" placeholder="Votre message" required></textarea>

                    <button type="submit" class="btn-health btn-health-primary font-serif w-full">Envoyer</button>
                </form>

                @if(session('success'))
                    <p class="mt-4 text-green-600 text-center">{{ session('success') }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
