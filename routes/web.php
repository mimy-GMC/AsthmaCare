<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/historique', function () {
        return view('historique');
    })->name('historique');

    Route::get('/journal', function () {
        return view('journal');
    })->name('journal');

    Route::get('/air-qualite', function () {
        return view('airqualite');
    })->name('airqualite');

    Route::get('/conseils', function () {
        return view('conseils');
    })->name('conseils');
});

require __DIR__.'/auth.php';
