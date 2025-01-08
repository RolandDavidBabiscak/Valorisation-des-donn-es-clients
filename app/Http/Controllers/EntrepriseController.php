<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        // Récupère toutes les entreprises
        $entreprises = Entreprise::all();

        return response()->json($entreprises);
    }

    public function show($id)
    {
        // Récupère une entreprise spécifique
        $entreprise = Entreprise::find($id);

        if (!$entreprise) {
            return response()->json(['message' => 'Entreprise non trouvée'], 404);
        }

        return response()->json($entreprise);
    }

    public function searchBySiren($siren)
    {
        $entreprises = Entreprise::where('SIREN', $siren)->get();

        if ($entreprises->isEmpty()) {
            return response()->json(['message' => 'Aucune entreprise trouvée'], 404);
        }

        return response()->json($entreprises);
    }

}
