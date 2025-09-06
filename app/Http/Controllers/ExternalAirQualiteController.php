<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\AirQualiteService;

class ExternalAirQualiteController extends Controller
{
    protected $airQualiteService;

    public function __construct(AirQualiteService $airQualiteService)
    {
        $this->airQualiteService = $airQualiteService;
    }

    /**
     * Renvoie les données de qualité d'air pour les coordonnées fournies
     * Route: GET /api/external/air-qualites
     */
    public function getAirQualite(Request $request)
    {
        // Validation des paramètres d'entrée
        $validated = $request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'lon' => 'required|numeric|between:-180,180',
        ]);

        try {
            $lat = $validated['lat'];
            $lon = $validated['lon'];

            // Appel du service
            $apiData = $this->airQualiteService->getAirQualite($lat, $lon);

            if (is_null($apiData)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossible de récupérer les données de qualité de l\'air.',
                    'data' => null
                ], 503);
            }

            // Formatage et renvoi des données
            $formattedData = $this->airQualiteService->formatAirQualiteData($apiData);

            return response()->json([
                'success' => true,
                'message' => 'Données récupérées avec succès',
                'data' => $formattedData
            ], 200);

        } catch (\Exception $e) {
            Log::error('Erreur contrôleur qualité air: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur interne du serveur',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }

    }
}
