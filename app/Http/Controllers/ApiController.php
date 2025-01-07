<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $endpoint = 'https://api.societe.com/apisite/v1/endpoint'; // Remplacez par le bon endpoint

        // Paramètres à envoyer à l'API
        $params = [
            'param1' => $request->input('param1'), // Paramètre reçu depuis la requête
            'param2' => $request->input('param2'), // Autres paramètres nécessaires
        ];

        try {
            // Requête HTTP avec les en-têtes nécessaires
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->get($endpoint, $params);

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
