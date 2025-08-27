<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseFormat
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Si c'est une réponse JSON et qu'elle ne contient pas déjà une structure standard
        if ($request->expectsJson() && !isset($response->getData()->success)) {
            $original = $response->getOriginalContent();
            
            if ($response->isSuccessful()) {
                $formatted = [
                    'success' => true,
                    'data' => $original,
                    'message' => 'Opération réussie.'
                ];
            } else {
                $formatted = [
                    'success' => false,
                    'message' => 'Une erreur est survenue.',
                    'errors' => $original
                ];
            }
            
            return response()->json($formatted, $response->status());
        }
        
        return $response;
    }
}