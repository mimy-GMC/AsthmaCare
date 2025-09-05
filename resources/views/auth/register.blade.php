<x-guest-layout>
    <h2 class="text-2xl font-serif font-bold text-center text-primary mb-4">Inscription</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium font-serif text-gray-700">Nom</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium font-serif text-gray-700">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium font-serif text-gray-700">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium font-serif text-gray-700">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('login') }}" class="text-sm text-primary hover:underline">Déjà inscrit ?</a>
            <button type="submit" class="btn-health btn-health-primary">
                S'inscrire
            </button>
        </div>
    </form>
</x-guest-layout>
