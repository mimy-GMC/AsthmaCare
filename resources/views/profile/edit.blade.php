<x-app-layout>
    <div class="container mx-auto py-12 space-y-6">
        <div class="health-card health-form">
            <h2 class="text-xl font-heading font-bold mb-4">Modifier le profil</h2>
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="health-card health-form">
            <h2 class="text-xl font-heading font-bold mb-4">Changer le mot de passe</h2>
            @include('profile.partials.update-password-form')
        </div>

        <div class="health-card health-form">
            <h2 class="text-xl font-heading font-bold mb-4 text-red-600">Supprimer le compte</h2>
            @include('profile.partials.delete-user-form')
        </div>        
    </div>
</x-app-layout>
