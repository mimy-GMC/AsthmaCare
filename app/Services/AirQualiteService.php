<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AirQualiteService
{
    protected $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        // Récupère la clé depuis le fichier services.php
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = rtrim(config('services.openweather.url'), '/');
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
        $url = "{$this->baseUrl}/air_pollution?lat={$lat}&lon={$lon}&appid={$this->apiKey}";

        try {
            $response = Http::timeout(10)->get($url);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('OpenWeatherMap API error: ', [
                'url' => $url,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return null;

        } catch (\Exception $e) {
            Log::error('Exception during OpenWeatherMap API call: ', [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);
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
            'timestamp' => $apiData['list'][0]['dt'],
        ];
    }
}