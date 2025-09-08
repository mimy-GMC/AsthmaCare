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
        try {
            $data = Auth::user()
                ->symptomes()
                ->orderBy('date_debut', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Liste des symptômes récupérée avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des symptômes.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Créer un symptôme
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'date_debut'   => 'required|date',
                'nom'         => 'required|string|max:255',
                'intensite'    => 'required|integer|min:1|max:10',
                'declencheurs' => 'nullable|array',
                'declencheurs.*' => 'string',
                'commentaires' => 'nullable|string'
            ]);

            $symptome = Auth::user()->symptomes()->create([
                'date_debut'   => $validated['date_debut'],
                'nom'         => $validated['nom'],
                'intensite'    => $validated['intensite'],
                'declencheurs' => $validated['declencheurs'] ?? [],
                'commentaires' => $validated['commentaires'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'data' => $symptome,
                'message' => 'Symptôme ajouté avec succès.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du symptôme.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Voir un symptôme précis
    public function show($id)
    {
       try {
            $symptome = Auth::user()->symptomes()->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $symptome
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Symptôme introuvable.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 404);
        }
    }

    // Modifier un symptôme
    public function update(Request $request, $id)
    {
        try {
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

            return response()->json([
                'success' => true,
                'data' => $symptome,
                'message' => 'Symptôme mis à jour avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du symptôme.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Supprimer un symptôme
    public function destroy($id)
    {
        try {
            $symptome = Auth::user()->symptomes()->findOrFail($id);
            $symptome->delete();

            return response()->json([
                'success' => true,
                'message' => 'Symptôme supprimé avec succès 🗑️'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du symptôme.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}