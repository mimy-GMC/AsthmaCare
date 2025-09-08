<section class="health-card health-form rounded-2xl shadow-lg hover:shadow-xl transition p-6">
    <header class="mb-4 text-center">
        <h2 class="text-lg font-serif font-bold text-[#4b5ca9ff]">
            Informations du profil       </h2>

        <p class="text-sm font-serif text-gray-600">
          Mettez à jour les informations de votre profil et votre adresse e-mail.
        </p>
    </header>

    <!-- Formulaire de vérification email -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="mb-4">
            <x-input-label for="name" :value="__('Nom')" class="font-serif"/>
            <x-text-input id="name" name="name" type="text" class="health-form-input mt-1 block w-full font-serif" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 font-serif" :messages="$errors->get('name')" />
        </div>

        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="font-serif"/>
            <x-text-input id="email" name="email" type="email" class="health-form-input mt-1 block w-full font-serif" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 font-serif" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-center">
                    <p class="text-sm font-serif text-gray-800">
                        Votre email n’est pas vérifié.
                        <button form="send-verification" class="underline text-sm text-[#4b5ca9ff] hover:text-[#3a4783ff] ms-2">
                            Cliquez ici pour renvoyer l'email de vérification.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 font-serif">
                            Un nouveau lien de vérification a été envoyé à votre email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="submit" class="btn-health btn-health-primary font-serif">Enregistrer</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 font-serif"
                >Enregistré.</p>
            @endif
        </div>
    </form>
</section>
