<x-guest-layout>
    <div class="health-card text-center">
        <h2 class="text-xl font-bold text-primary mb-4">Vérifiez votre adresse email</h2>
        <p class="text-gray-700 mb-6">
            Merci pour votre inscription ! Avant de commencer, veuillez confirmer votre adresse email en cliquant sur le lien que nous vous avons envoyé.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-green-600">
                ✅ Un nouveau lien de vérification vient d'être envoyé à votre adresse email.
            </div>
        @endif

        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button class="btn-health btn-health-primary" type="submit">
                    Renvoyer l'email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-health btn-health-secondary">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
