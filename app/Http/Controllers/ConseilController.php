<?php

namespace App\Http\Controllers;

use App\Models\Conseil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConseilController extends Controller
{
    /** Liste des conseils de l'utilisateur connecté */
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'categorie' => 'required|string|max:255',
                'contenu' => 'required|string',
                'niveau_alerte' => 'required|integer|min:0|max:10',
            ]);

            $conseil = Auth::user()->conseils()->create($validated);

            return response()->json([
                'success' => true,
                'data' => $conseil,
                'message' => 'Conseil ajouté avec succès.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du conseil.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Créer un conseil
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'categorie' => 'required|string|max:255',
                'contenu' => 'required|string',
                'niveau_alerte' => 'required|integer|min:0|max:10',
            ]);

            $conseil = Auth::user()->conseils()->create($validated);

            return response()->json([
                'success' => true,
                'data' => $conseil,
                'message' => 'Conseil ajouté avec succès.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du conseil.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Afficher un conseil
    public function show($id)
    {
        try {
            $conseil = Auth::user()->conseils()->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $conseil
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Conseil introuvable.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 404);
        }
    }

    // Modifier un conseil
    public function update(Request $request, $id)
    {
        try {
            $conseil = Auth::user()->conseils()->findOrFail($id);

            $validated = $request->validate([
                'categorie' => 'required|string|max:255',
                'contenu' => 'required|string',
                'niveau_alerte' => 'required|integer|min:0|max:10',
            ]);

            $conseil->update($validated);

            return response()->json([
                'success' => true,
                'data' => $conseil,
                'message' => 'Conseil mis à jour avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du conseil.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // Supprimer un conseil
    public function destroy($id)
    {
         try {
            $conseil = Auth::user()->conseils()->findOrFail($id);
            $conseil->delete();

            return response()->json([
                'success' => true,
                'message' => 'Conseil supprimé avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du conseil.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
