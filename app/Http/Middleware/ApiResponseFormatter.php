<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseFormatter
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // On ne touche qu'aux réponses JSON venant de l'API
        if ($request->is('api/*') && $request->expectsJson()) {
            // Évite le double formatage si 'success' est déjà défini
            if (method_exists($response, 'getData') && isset($response->getData()->success)) {
                return $response;
            }

            $original = $response->getOriginalContent();
            $statusCode = $response->getStatusCode();
            $success = $statusCode >= 200 && $statusCode < 300;
            
            $formatted = [
                'success'   => $success,
                'message'   => $success ? 'Opération réussie' : 'Une erreur est survenue',
                'data'      => $success ? $original : null,
                'errors'    => !$success ? $original : null,
                'timestamp' => now()->toISOString()
            ];
            
            return response()->json($formatted, $response->status());
        }
        
        return $response;
    }
}