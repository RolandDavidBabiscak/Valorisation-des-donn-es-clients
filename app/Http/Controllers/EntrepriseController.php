<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Http\Controllers\ModelNotFoundException;
use App\Models\Note;

class EntrepriseController extends Controller
{
    // Méthode pour récupérer toutes les entreprises
    public function index()
    {
        // Récupère toutes les entreprises
        $entreprises = Entreprise::all();

        // Retourne les entreprises au format JSON
        return response()->json($entreprises);
    }

    // Méthode pour enregistrer une nouvelle entreprise
    public function store(Request $request)
    {
        // Valide les données de la requête
        $request->validate([
            'NOM' => 'required|string|max:255',
            'SIREN' => 'required|string|max:9|unique:ENTREPRISE,SIREN',
            'SIRET_SIEGE' => 'required|string|max:14|unique:ENTREPRISE,SIRET_SIEGE',
        ]);

        // Crée une nouvelle instance d'Entreprise et assigne les valeurs
        $entreprise = new Entreprise();
        $entreprise->NOM = $request->input('NOM');
        $entreprise->SIREN = $request->input('SIREN');
        $entreprise->SIRET_SIEGE = $request->input('SIRET_SIEGE');
        $entreprise->save();

        // Retourne la vue 'welcome'
        return view('welcome');
    }

    // Méthode pour rechercher des entreprises
    public function search(Request $request)
    {
        // Récupère la requête de recherche
        $query = $request->input('query');

        // Recherche les entreprises correspondant à la requête
        $entreprises = Entreprise::query()
            ->where('NOM', 'like', "%$query%")
            ->orWhere('SIREN', '=', $query)
            ->orWhere('SIRET_SIEGE', '=', $query)
            ->get();

        // Retourne les résultats de la recherche au format JSON
        return response()->json($entreprises, 200);
    }

    // Méthode pour afficher les détails d'une entreprise
    public function show($id)
    {
        // Récupère l'entreprise par son SIREN et charge les commentaires associés
        $entreprise = Entreprise::where('SIREN', $id)->with('comments')->firstOrFail();

        // Retourne la vue 'entreprise' avec les détails de l'entreprise
        return view('entreprise', compact('entreprise'));
    }

    // Méthode pour noter une entreprise
    public function noterEntreprise(Request $request, $siren)
    {
        // Récupère l'entreprise par son SIREN
        $entreprise = Entreprise::where('SIREN', $siren)->firstOrFail();

        // Met à jour ou crée une nouvelle note pour l'entreprise
        $note = Note::updateOrCreate(
            ['ENTREPRISE_ID' => $entreprise->id],
            ['NOTE' => $request->input('rating')]
        );

        // Retourne une réponse JSON indiquant le succès de l'opération
        return response()->json(['success' => true]);
    }
}