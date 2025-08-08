<?php

namespace App\Http\Controllers;

use App\Models\Conseil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConseilController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->conseils()->orderBy('niveau_alerte', 'desc');

        // filtres optionnels
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }
        if ($request->filled('niveau_min')) {
            $query->where('niveau_alerte', '>=', (int)$request->niveau_min);
        }
        if ($request->filled('niveau_max')) {
            $query->where('niveau_alerte', '<=', (int)$request->niveau_max);
        }

        return $query->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie' => 'required|string|max:255',
            'contenu' => 'required|string',
            'niveau_alerte' => 'required|integer|min:0|max:10',
        ]);

        return Auth::user()->conseils()->create($validated);
    }

    public function show($id)
    {
        $conseil = Auth::user()->conseils()->findOrFail($id);
        return $conseil;
    }

    public function update(Request $request, $id)
    {
        $conseil = Auth::user()->conseils()->findOrFail($id);

        $validated = $request->validate([
            'categorie' => 'required|string|max:255',
            'contenu' => 'required|string',
            'niveau_alerte' => 'required|integer|min:0|max:10',
        ]);

        $conseil->update($validated);
        return $conseil;
    }

    public function destroy($id)
    {
        $conseil = Auth::user()->conseils()->findOrFail($id);
        $conseil->delete();

        return response()->json(['message' => 'Conseil supprimé.']);
    }
}
