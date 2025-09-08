<section class="health-card health-form rounded-2xl shadow-lg hover:shadow-xl transition p-6">
    <header class="mb-4 text-center">
        <h2 class="text-lg font-serif font-bold text-[#4b5ca9ff]">
            Changer le mot de passe
        </h2>

        <p class="mt-1 text-sm font-serif text-gray-600">
            Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Mot de passe actuel')" class="font-serif" />
            <x-text-input id="current_password" name="current_password" type="password" class="health-form-input mt-1 block w-full font-serif" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 font-serif" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Nouveau mot de passe')" class="font-serif"/>
            <x-text-input id="password" name="password" type="password" class="health-form-input mt-1 block w-full font-serif" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 font-serif" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="font-serif"/>
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="health-form-input mt-1 block w-full font-serif" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 font-serif" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="submit" class="btn-health btn-health-primary font-serif">Enregistrer</x-primary-button>

            @if (session('status') === 'password-updated')
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
