<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OthersPagesController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Pages publiques
Route::get('/features', [OthersPagesController::class, 'features'])->name('features');
Route::get('/about', [OthersPagesController::class, 'about'])->name('about');
Route::get('/contact', [OthersPagesController::class, 'contact'])->name('contact');

// Routes (accessible uniquement aux utilisateurs authentifiés ET email vérifié)
Route::middleware(['auth', 'verified'])->group(function () {

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
