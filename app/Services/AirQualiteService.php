<?php
// app/Services/AirQualiteService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AirQualiteService
{
    protected $apiKey;

    public function __construct()
    {
        // Récupère la clé depuis le fichier .env
        $this->apiKey = env('OPENWEATHER_API_KEY');
    }

    /**
     * Récupère les données de pollution pour une localisation donnée
     *
     * @param float $lat Latitude
     * @param float $lon Longitude
     * @return array|null Données de pollution ou null en cas d'erreur
     */
    public function getAirQualite(float $lat, float $lon): ?array
    {
        $url = "http://api.openweathermap.org/data/2.5/air_pollution?lat={$lat}&lon={$lon}&appid={$this->apiKey}";

        try {
            $response = Http::timeout(10)->get($url);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('OpenWeatherMap API error: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('Exception during OpenWeatherMap API call: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Transforme les données brutes de l'API en un format plus simple pour le front
     */
    public function formatAirQualiteData(array $apiData): array
    {
        if (empty($apiData['list'][0])) {
            return [];
        }

        $main = $apiData['list'][0]['main'];
        $components = $apiData['list'][0]['components'];

        return [
            'aqi' => $main['aqi'], // 1=Bon, 2=Modéré, 3=Malsain pour groupes sensibles, etc.
            'pm2_5' => $components['pm2_5'],
            'pm10' => $components['pm10'],
            // Tu peux ajouter d'autres composants si tu veux (so2, no2, etc.)
            'timestamp' => $apiData['list'][0]['dt'],
        ];
    }
}