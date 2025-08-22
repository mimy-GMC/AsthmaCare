<?php

namespace App\Http\Controllers;

use App\Models\Symptome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SymptomeController extends Controller
{
    // Lister les symptômes de l'utilisateur connecté
    public function index()
    {
        return Auth::user()
            ->symptomes()
            ->orderBy('date_debut', 'desc')
            ->get();
    }

    // Créer un symptôme
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut'   => 'required|date',
            'intensite'    => 'required|integer|min:1|max:10',
            'declencheurs' => 'nullable|array', 
            'declencheurs.*' => 'string',       //Validation de declencheurs en array + vérification que chaque élément est une string
            'commentaires' => 'nullable|string'
        ]);

        // Créer l'entrée
        return Auth::user()->symptomes()->create([
            'date_debut'   => $validated['date_debut'],
            'intensite'    => $validated['intensite'],
            'declencheurs' => $validated['declencheurs'] ?? [],
            'commentaires' => $validated['commentaires'] ?? null,
        ]);
    }

    // Voir un symptôme précis
    public function show($id)
    {
        return Auth::user()->symptomes()->findOrFail($id);
    }

    // Modifier un symptôme
    public function update(Request $request, $id)
    {
        $symptome = Auth::user()->symptomes()->findOrFail($id);

        $validated = $request->validate([
            'date_debut'   => 'required|date',
            'intensite'    => 'required|integer|min:1|max:10',
            'declencheurs' => 'nullable|array',
            'declencheurs.*' => 'string',
            'commentaires' => 'nullable|string'
        ]);

        $symptome->update([
            'date_debut'   => $validated['date_debut'],
            'intensite'    => $validated['intensite'],
            'declencheurs' => $validated['declencheurs'] ?? [],
            'commentaires' => $validated['commentaires'] ?? null,
        ]);

        return $symptome;
    }

    // Supprimer un symptôme
    public function destroy($id)
    {
        $symptome = Auth::user()->symptomes()->findOrFail($id);
        $symptome->delete();

        return response()->json([
            'success' => true,
            'message' => 'Symptôme supprimé avec succès 🗑️'
        ], 200);
    }
}