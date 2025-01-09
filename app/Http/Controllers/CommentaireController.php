<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $request->validate([
            'COMMENTAIRE' => 'required|string|max:255',
            'ENTREPRISE_ID' => 'required|integer|exists:ENTREPRISE,ENTREPRISE_ID',
        ]);

        try {
            // Création du commentaire
            Commentaire::create([
                'COMMENTAIRE' => $request->input('COMMENTAIRE'),
                'ENTREPRISE_ID' => $request->input('ENTREPRISE_ID'),
            ]);

            return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du commentaire.');
        }
    }
}