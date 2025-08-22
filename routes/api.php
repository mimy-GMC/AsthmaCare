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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('symptomes', SymptomeController::class);
    Route::apiResource('air-qualites', AirQualiteController::class);
    Route::apiResource('conseils', ConseilController::class);
});
