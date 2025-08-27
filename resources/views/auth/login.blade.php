<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="health-alert health-alert-info pulse mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="health-form-label">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="health-form-input" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="health-form-label">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="health-form-input" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-4 flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary" />
            <label for="remember_me" class="ms-2 text-gray-700 text-sm">{{ __('Remember me') }}</label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn-health btn-health-primary">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
