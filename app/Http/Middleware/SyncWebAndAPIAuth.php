<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SyncWebAndAPIAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur est connecté via web
        if (auth()->check()) {
            $user = $request->user();
            
            // Vérifier si on a déjà un token en session
            $existingToken = session('sanctum_token');
            
            // Vérifier si le token existe toujours pour l'utilisateur
            $tokenValid = $existingToken && $user->tokens()
                ->where('token', hash('sha256', explode('|', $existingToken)[1]))
                ->exists();
            
            // Si pas de token valide, en créer un nouveau
            if (!$tokenValid) {
                // Supprimer les anciens tokens "web-auth"
                $user->tokens()
                    ->where('name', 'web-auth')
                    ->delete();
                
                // Créer un nouveau token
                $token = $user->createToken('web-auth')->plainTextToken;
                session(['sanctum_token' => $token]);
            }
        }
        
        return $next($request);
    }
}