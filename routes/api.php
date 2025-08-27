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
use App\Http\Controllers\ExternalAirQualiteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Routes publiques (avec Breeze controllers pour register/login)
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::apiResource('symptomes', SymptomeController::class);
    Route::apiResource('air-qualites', AirQualiteController::class);
    Route::apiResource('conseils', ConseilController::class);

    Route::get('/external/air-qualites', [ExternalAirQualiteController::class, 'getAirQualite']);
    Route::get('/conseils-personnalises', [ConseilController::class, 'getConseilsPersonnalises']);
});
