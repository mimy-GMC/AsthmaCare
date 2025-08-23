<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SyncWebAndAPIAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur est connecté via web, créer un token pour l'API
        if (auth()->check() && !$request->user()->currentAccessToken()) {
            $token = $request->user()->createToken('web-auth')->plainTextToken;
            session(['sanctum_token' => $token]);
        }
        
        return $next($request);
    }
}