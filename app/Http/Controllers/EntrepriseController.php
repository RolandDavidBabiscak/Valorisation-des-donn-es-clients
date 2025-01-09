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

        if ($entreprise) {
            return response()->json($entreprise);
        } else {
            return response()->json(['message' => 'Entreprise non trouvée'], 404);
        }
    }

    public function store(Request $request)
    {
            $request->validate([
                'NOM' => 'required|string|max:255',
                'SIREN' => 'required|string|max:14|unique:ENTREPRISE,SIREN',
                'SIRET_SIEGE' => 'required|string|max:14|unique:ENTREPRISE,SIRET_SIEGE',
            ]);
    
            $entreprise = new Entreprise();
            $entreprise->NOM = $request->input('NOM');
            $entreprise->SIREN = $request->input('SIREN');
            $entreprise->SIRET_SIEGE = $request->input('SIRET_SIEGE');
            $entreprise->save();

            return view('welcome');
        }
}