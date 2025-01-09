<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Entreprise;

class CommentaireController extends Controller
{
    public function index($id)
    {
                // Récupérer l'entreprise avec ses commentaires
            $entreprise = Entreprise::with('commentaires')->findOrFail($id);

            // Passer les données à la vue
            return view('commentaires.index', [
                'commentaires' => $entreprise->commentaires,
                'entreprise' => $entreprise,
                'id' => $id
            ]);

    }
    
    
    

    public function store(Request $request, $id)
    {
        $request->validate([
            'TEXTE' => 'required|string|max:1000',
        ]);

        Commentaire::create([
            'ENTREPRISE_ID' => $id,
            'TEXTE' => $request->TEXTE,
        ]);

        return redirect()->route('commentaire.index', ['id' => $id])->with('success', 'Commentaire ajouté avec succès.');
    }

}