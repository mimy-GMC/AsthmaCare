<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Pages publiques
Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Route de pour l'envoi du formulaire de contact
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Routes (accessible uniquement aux utilisateurs authentifiés ET email vérifié)
Route::middleware(['auth', 'verified', 'sync.auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Journal des symptômes
    Route::get('/journal', function () {
        return view('journal');
    })->name('journal');

    // Historique
    Route::get('/historique', function () {
        return view('historique');
    })->name('historique');

    // Carte qualité de l'air
    Route::get('/carte', function () {
        return view('carte');
    })->name('carte');

    // Qualité de l'air
    Route::get('/air-qualite', function () {
        return view('airqualite');
    })->name('air-qualite');

    // Conseils santé
    Route::get('/conseils', function () {
        return view('conseils');
    })->name('conseils');

    // Profil utilisateur (CRUD)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
