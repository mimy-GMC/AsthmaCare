@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="container mx-auto py-12 space-y-10">

    <!-- Header page -->
    <div class="text-center mb-8">
        <i class="fas fa-user-circle text-5xl text-[#4b5ca9ff] mb-2"></i>
        <h1 class="text-3xl font-serif font-bold text-gray-800">Mon Profil</h1>
        <p class="text-sm font-serif text-gray-600">Gérez vos informations personnelles et la sécurité de votre compte.</p>
    </div>

    <!-- Infos profil -->
    <div class="health-card health-form rounded-2xl shadow-lg hover:shadow-xl transition">
        <h2 class="flex items-center gap-2 text-xl font-serif font-bold mb-4 text-[#4b5ca9ff]">
            <i class="fas fa-user"></i> Informations personnelles
        </h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex items-center gap-4 mb-4">
                <!-- Aperçu avatar -->
                <img id="photoPreview" class="w-16 h-16 rounded-full object-cover" 
                     src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://via.placeholder.com/64' }}" 
                     alt="Avatar">

                <!-- Input file -->
                <input type="file" name="photo" id="photo" accept="image/*"
                       class="block w-full text-sm font-serif text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0
                              file:text-sm file:font-semibold
                              file:bg-[#4b5ca9ff] file:text-white
                              hover:file:bg-[#3a4783ff]"
                       onchange="previewPhoto(event)">
            </div>
            @error('photo')
                <p class="text-red-500 font-serif text-sm mt-1">{{ $message }}</p>
            @enderror

            <div class="mb-4">
                <label class="block text-sm font-medium font-serif text-gray-700">Nom</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 block w-full rounded-md font-serif border-gray-300 shadow-sm focus:ring-[#4b5ca9ff] focus:border-[#4b5ca9ff]">
                @error('name')
                    <p class="text-red-500 font-serif text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium font-serif text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full rounded-md font-serif border-gray-300 shadow-sm focus:ring-[#4b5ca9ff] focus:border-[#4b5ca9ff]">
                @error('email')
                    <p class="text-red-500 font-serif text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="px-6 py-2 bg-[#4b5ca9ff] text-white font-serif rounded-lg hover:bg-[#3a4783ff] transition">
                Mettre à jour
            </button>
        </form>

        <script>
            function previewPhoto(event) {
                const reader = new FileReader();
                reader.onload = function(){
                    const output = document.getElementById('photoPreview');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </div>

    <!-- Mot de passe -->
    <div class="health-card health-form rounded-2xl shadow-lg hover:shadow-xl transition">
        <h2 class="flex items-center gap-2 text-xl font-serif font-bold mb-4 text-[#4b5ca9ff]">
            <i class="fas fa-lock"></i>Mot de passe
        </h2>
        @include('profile.partials.update-password-form')
    </div>

    <!-- Suppression -->
    <div class="health-card health-form rounded-2xl shadow-lg hover:shadow-xl transition border border-red-200">
        <h2 class="flex items-center gap-2 text-xl font-serif font-bold mb-4 text-red-600">
            <i class="fas fa-triangle-exclamation"></i> Supprimer le compte
        </h2>
        @include('profile.partials.delete-user-form')
    </div>

</div>
@endsection
