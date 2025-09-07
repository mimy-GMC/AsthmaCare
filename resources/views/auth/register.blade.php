<x-guest-layout>
    <h2 class="text-3xl font-serif font-bold text-center text-[#4b5ca9ff] mb-4">Inscription</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="health-form-label">Nom</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="health-form-input">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="health-form-label">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="health-form-input">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="health-form-label">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="health-form-input">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="health-form-label">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="health-form-input">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('login') }}" class="text-sm text-cyan-700 font-serif font-medium hover:underline hover:text-purple-700">Déjà inscrit ?</a>
            <button type="submit" class="btn-health btn-health-primary">
                S'inscrire
            </button>
        </div>
    </form>
</x-guest-layout>
