<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Http\Controllers\ModelNotFoundException;


class EntrepriseController extends Controller
{
    public function index()
    {
        // Récupère toutes les entreprises
        $entreprises = Entreprise::all();

        return response()->json($entreprises);
    }

    public function store(Request $request)
    {
            $request->validate([
                'NOM' => 'required|string|max:255',
                'SIREN' => 'required|string|max:9|unique:ENTREPRISE,SIREN',
                'SIRET_SIEGE' => 'required|string|max:14|unique:ENTREPRISE,SIRET_SIEGE',
            ]);
    
            $entreprise = new Entreprise();
            $entreprise->NOM = $request->input('NOM');
            $entreprise->SIREN = $request->input('SIREN');
            $entreprise->SIRET_SIEGE = $request->input('SIRET_SIEGE');
            $entreprise->save();

            return view('welcome');
        }

        public function search(Request $request)
        {
            $query = $request->input('query');
            $entreprises = Entreprise::query()
                ->where('NOM', 'like', "%$query%")
                ->orWhere('SIREN', '=', $query)
                ->orWhere('SIRET_SIEGE', '=', $query)
                ->get();
        
            return response()->json($entreprises, 200);
        }
        
    
        public function show($id)
        {
            $entreprise = Entreprise::where('SIREN', $id)->with('comments')->firstOrFail();
            return view('entreprise', compact('entreprise'));
        }
    
    }