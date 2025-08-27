<?php

namespace App\Http\Controllers;

use App\Models\AirQualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirQualiteController extends Controller
{
    /**
     * Liste les données de qualité de l'air de l'utilisateur connecté,
     * avec filtres optionnels.
     */
    public function index(Request $request)
    {
        try {
            $query = Auth::user()->qualitesAir()->orderBy('date_mesure', 'desc');

            // Filtrage optionnel
            if ($request->filled('localite')) {
                $query->where('localite', 'like', '%' . $request->localite . '%');
            }
            if ($request->filled('date_mesure')) {
                $query->whereDate('date_mesure', $request->date_mesure);
            }
            if ($request->filled('aqi_min')) {
                $query->where('aqi', '>=', (int) $request->aqi_min);
            }
            if ($request->filled('aqi_max')) {
                $query->where('aqi', '<=', (int) $request->aqi_max);
            }

            $data = $query->get();

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Données de qualité d\'air récupérées avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des données.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Crée un nouvel enregistrement qualité de l'air
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'date_mesure' => 'required|date',
                'aqi' => 'required|integer|min:0|max:500',
                'pollen' => 'nullable|integer|min:0',
                'pm2_5' => 'nullable|numeric|min:0',
                'pm10' => 'nullable|numeric|min:0',
                'localite' => 'required|string|max:255',
            ]);

            $record = Auth::user()->qualitesAir()->create($validated);

            return response()->json([
                'success' => true,
                'data' => $record,
                'message' => 'Enregistrement qualité de l\'air créé avec succès.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l\'enregistrement.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Affiche un enregistrement qualité de l'air
    public function show($id)
    {
        try {
            $record = Auth::user()->qualitesAir()->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $record
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Enregistrement introuvable.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 404);
        }
    }

    // Met à jour un enregistrement qualité de l'air
    public function update(Request $request, $id)
    {
         try {
            $record = Auth::user()->qualitesAir()->findOrFail($id);

            $validated = $request->validate([
                'date_mesure' => 'required|date',
                'aqi' => 'required|integer|min:0|max:500',
                'pollen' => 'nullable|integer|min:0',
                'pm2_5' => 'nullable|numeric|min:0',
                'pm10' => 'nullable|numeric|min:0',
                'localite' => 'required|string|max:255',
            ]);

            $record->update($validated);

            return response()->json([
                'success' => true,
                'data' => $record,
                'message' => 'Enregistrement qualité de l\'air mis à jour avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de l\'enregistrement.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Supprime un enregistrement qualité de l'air
    public function destroy($id)
    {
        try {
            $record = Auth::user()->qualitesAir()->findOrFail($id);
            $record->delete();

            return response()->json([
                'success' => true,
                'message' => 'Enregistrement qualité de l\'air supprimé avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de l\'enregistrement.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
