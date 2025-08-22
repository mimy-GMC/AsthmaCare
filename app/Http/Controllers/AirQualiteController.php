<?php

namespace App\Http\Controllers;

use App\Models\AirQualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirQualiteController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->qualitesAir()->orderBy('date_mesure', 'desc');

        // Filtrage optionnel : localite, date_mesure, aqi_min, aqi_max
        if ($request->filled('localite')) {
            $query->where('localite', 'like', '%' . $request->localite . '%');
        }
        if ($request->filled('date_mesure')) {
            $query->whereDate('date_mesure', $request->date_mesure);
        }
        if ($request->filled('aqi_min')) {
            $query->where('aqi', '>=', (int)$request->aqi_min);
        }
        if ($request->filled('aqi_max')) {
            $query->where('aqi', '<=', (int)$request->aqi_max);
        }

        return $query->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_mesure' => 'required|date',
            'aqi' => 'required|integer|min:0|max:500',
            'pollen' => 'nullable|integer|min:0',
            'pm2_5' => 'nullable|numeric|min:0',
            'pm10' => 'nullable|numeric|min:0',
            'localite' => 'required|string|max:255',
        ]);

        return Auth::user()->qualitesAir()->create($validated);
    }

    public function show($id)
    {
        $record = Auth::user()->qualitesAir()->findOrFail($id);
        return $record;
    }

    public function update(Request $request, $id)
    {
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
        return $record;
    }

    public function destroy($id)
    {
        $record = Auth::user()->qualitesAir()->findOrFail($id);
        $record->delete();

        return response()->json(['message' => 'Enregistrement qualité de l\'air supprimé.']);
    }
}
