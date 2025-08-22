<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExternalAirQualiteController extends Controller
{
    protected $airQualiteService;

    public function __construct(AirQualiteService $airQualiteService)
    {
        $this->airQualiteService = $airQualiteService;
    }

    /**
     * Renvoie les données de qualité d'air pour les coordonnées fournies
     * Route: GET /api/external/air-quality
     */
    public function getAirQualite(Request $request)
    {
        // Validation des paramètres d'entrée
        $validated = $request->validate([
            'lat' => 'required|numeric|between:-90,90',
            'lon' => 'required|numeric|between:-180,180',
        ]);

        $lat = $validated['lat'];
        $lon = $validated['lon'];

        // Appel du service
        $apiData = $this->airQualiteService->getAirQualite($lat, $lon);

        if (is_null($apiData)) {
            return response()->json(['error' => 'Impossible de récupérer les données de qualité de l\'air.'], 500);
        }

        // Formatage et renvoi des données
        $formattedData = $this->airQualiteService->formatAirQualiteData($apiData);

        return response()->json($formattedData, 200);
    }
}
