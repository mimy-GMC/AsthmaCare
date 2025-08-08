<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\SymptomeController;
use App\Http\Controllers\AirQualiteController;
use App\Http\Controllers\ConseilController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    // Symptomes
    Route::get('/symptomes', [SymptomeController::class, 'index']);
    Route::post('/symptomes', [SymptomeController::class, 'store']);
    Route::get('/symptomes/{id}', [SymptomeController::class, 'show']);
    Route::put('/symptomes/{id}', [SymptomeController::class, 'update']);
    Route::delete('/symptomes/{id}', [SymptomeController::class, 'destroy']);

    // AirQualite
    Route::get('/air-qualites', [AirQualiteController::class, 'index']);
    Route::post('/air-qualites', [AirQualiteController::class, 'store']);
    Route::get('/air-qualites/{id}', [AirQualiteController::class, 'show']);
    Route::put('/air-qualites/{id}', [AirQualiteController::class, 'update']);
    Route::delete('/air-qualites/{id}', [AirQualiteController::class, 'destroy']);

    // Conseils
    Route::get('/conseils', [ConseilController::class, 'index']);
    Route::post('/conseils', [ConseilController::class, 'store']);
    Route::get('/conseils/{id}', [ConseilController::class, 'show']);
    Route::put('/conseils/{id}', [ConseilController::class, 'update']);
    Route::delete('/conseils/{id}', [ConseilController::class, 'destroy']);


    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});


