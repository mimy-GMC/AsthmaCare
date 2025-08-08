<?php

namespace App\Http\Controllers;

use App\Models\Symptome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SymptomeController extends Controller
{
    //Lister les symptômes de l'utilisateur connecté
    public function index()
    {
        return Auth::user()->symptomes()->orderBy('date_debut', 'desc')->get();
    }

    //Créer un symptôme
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'intensite' => 'required|integer|min:1|max:10',
            'declencheurs' => 'nullable|string',
            'commentaires' => 'nullable|string'
        ]);

        return Auth::user()->symptomes()->create($validated);
    }

    //Voir un symptôme précis
    public function show($id)
    {
        $symptome = Auth::user()->symptomes()->findOrFail($id);
        return $symptome;
    }

    //Modifier un symptôme
    public function update(Request $request, $id)
    {
        $symptome = Auth::user()->symptomes()->findOrFail($id);

        $validated = $request->validate([
            'date_debut' => 'required|date',
            'intensite' => 'required|integer|min:1|max:10',
            'declencheurs' => 'nullable|string',
            'commentaires' => 'nullable|string'
        ]);

        $symptome->update($validated);

        return $symptome;
    }

    //Supprimer un symptôme
    public function destroy($id)
    {
        $symptome = Auth::user()->symptomes()->findOrFail($id);
        $symptome->delete();

        return response()->json(['message' => 'Symptôme supprimé avec succès']);
    }
}
