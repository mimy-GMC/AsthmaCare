<section class="health-card health-form rounded-2xl shadow-lg hover:shadow-xl transition p-6 space-y-6">
    <header class="text-center">
        <h2 class="text-lg font-serif font-bold text-red-600">
            Supprimer le compte
        </h2>

        <p class="text-sm font-serif text-gray-600">
            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.
        </p>
    </header>

    <x-danger-button
        type="button" 
        class="btn-health btn-health-danger font-serif" 
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Supprimer le compte</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('delete')

            <h2 class="text-lg font-serif font-bold text-red-600">
                Êtes-vous sûr de vouloir supprimer votre compte ?
            </h2>

            <p class="text-sm font-serif text-gray-600">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div>
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only font-serif" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="health-form-input mt-1 block w-3/4 font-serif"
                    placeholder="{{ __('Mot de passe') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 font-serif" />
            </div>

            <div class="flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="font-serif">
                   Annuler
                </x-secondary-button>

                <x-danger-button type="submit" class="btn-health btn-health-danger font-serif">
                    Supprimer le compte
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
