<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="health-alert health-alert-info pulse mb-4" :status="session('status')" />

    <h2 class="text-3xl font-serif font-bold text-center text-[#4b5ca9ff] mb-4">Connexion</h2>
    
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="health-form-label">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="health-form-input" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="health-form-label">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="health-form-input" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="mb-4 flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary" />
            <label for="remember_me" class="ms-2 text-gray-700 font-serif text-sm">Se souvenir de moi</label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-serif text-xs hover:underline">
                    Mot de passe oublié?
                </a>
            @endif

            <button type="submit" class="btn-health btn-health-primary">
                Se connecter
            </button>
        </div>
    </form>
</x-guest-layout>
