<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Récupérer les données depuis l'API Societe.com
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSocieteData(Request $request)
    {
        // Clé API (configuré dans .env)
        $apiKey = env('API_SOCIETE_COM');

        // Endpoint de l'API
        $endpoint1 = 'https://api.societe.com/api/v1/infoclient';

        // Paramètres à envoyer à l'API
        $params = [
            'siren' => $request->input('siren'),
            'siretsiege' => $request->input('siret_siege'),
            'deno' => $request->input('nom'),
        ];

        try {
            // Requête HTTP avec les en-têtes nécessaires
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->get($endpoint1, $params);

            // Vérification du succès de la requête
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            }

            // Gérer les erreurs
            return response()->json([
                'error' => 'Erreur lors de l\'appel API',
                'status' => $response->status(),
                'message' => $response->body(),
            ], $response->status());
        } catch (\Exception $e) {
            // Gérer les exceptions
            return response()->json([
                'error' => 'Une exception s\'est produite',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getDirigeantData(Request $request)
    {
        // Clé API (configuré dans .env)
        $apiKey = env('API_SOCIETE_COM');

        // Endpoint de l'API
        $endpoint1 = 'https://api.societe.com/api/v1/dirigeants';

        // Paramètres à envoyer à l'API
        $params = [
            'civpp' => $request->input('civilite'),
            'nompp' => $request->input('nom'),
            'prenompp' => $request->input('prenom'),
        ];

        try {
            // Requête HTTP avec les en-têtes nécessaires
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->get($endpoint1, $params);

            // Vérification du succès de la requête
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            }

            // Gérer les erreurs
            return response()->json([
                'error' => 'Erreur lors de l\'appel API',
                'status' => $response->status(),
                'message' => $response->body(),
            ], $response->status());
        } catch (\Exception $e) {
            // Gérer les exceptions
            return response()->json([
                'error' => 'Une exception s\'est produite',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
