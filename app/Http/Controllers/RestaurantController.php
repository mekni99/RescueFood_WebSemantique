<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    public function index()
    {
        $client = new Client();
        // Définir l'endpoint directement dans le contrôleur
        $endpoint = 'http://localhost:3030/restaurant_dataset/sparql'; // Remplacez par votre URL d'endpoint Fuseki

        // Vérifiez que l'endpoint est défini
        if (empty($endpoint)) {
            throw new \InvalidArgumentException("L'endpoint Fuseki n'est pas défini.");
        }

        $query = "
            PREFIX ex: <http://example.org/>
            SELECT ?restaurant ?name ?address ?city ?postal_code ?contact_name ?contact_phone ?contact_email ?food_type ?collection_zone ?banque_alimentaire_id
            WHERE {
                ?restaurant a ex:Restaurant ;
                    ex:name ?name ;
                    ex:address ?address ;
                    ex:city ?city ;
                    ex:postal_code ?postal_code ;
                    ex:contact_name ?contact_name ;
                    ex:contact_phone ?contact_phone ;
                    ex:contact_email ?contact_email ;
                    ex:food_type ?food_type ;
                    ex:collection_zone ?collection_zone ;
                    ex:banque_alimentaire_id ?banque_alimentaire_id .
            }
        ";

        try {
            $response = $client->post($endpoint, [
                'form_params' => [
                    'query' => $query,
                    'output' => 'application/json'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $restaurants = json_decode($response->getBody(), true);
            
            // Vérifiez si des résultats existent
            if (empty($restaurants['results']['bindings'])) {
                return view('restaurants.index')->with('message', 'Aucun restaurant trouvé.');
            }

            return view('restaurants.index', compact('restaurants'));

        } catch (RequestException $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Générer un identifiant unique pour le restaurant
        $restaurantId = '<http://example.org/restaurant' . uniqid() . '>';
    
        // Sanitize et échapper les entrées utilisateur
        $name = addslashes(trim($request->input('name')));
        $address = addslashes(trim($request->input('address')));
        $city = addslashes(trim($request->input('city')));
        $postalCode = addslashes(trim($request->input('postal_code')));
        $contactName = addslashes(trim($request->input('contact_name')));
        $contactPhone = addslashes(trim($request->input('contact_phone')));
        $contactEmail = addslashes(trim($request->input('contact_email')));
        $foodType = addslashes(trim($request->input('food_type')));
        $collectionZone = addslashes(trim($request->input('collection_zone')));
        $banqueAlimentaireId = addslashes(trim($request->input('banque_alimentaire_id')));
    
        // Construire la requête SPARQL
        $query = "
            PREFIX ex: <http://example.org/>
    
            INSERT DATA {
                $restaurantId a ex:Restaurant ;
                    ex:name \"$name\" ;
                    ex:address \"$address\" ;
                    ex:city \"$city\" ;
                    ex:postal_code \"$postalCode\" ;
                    ex:contact_name \"$contactName\" ;
                    ex:contact_phone \"$contactPhone\" ;
                    ex:contact_email \"$contactEmail\" ;
                    ex:food_type \"$foodType\" ;
                    ex:collection_zone \"$collectionZone\" ;
                    ex:banque_alimentaire_id \"$banqueAlimentaireId\" .
            }
        ";
    
        // Journaliser la requête SPARQL pour le débogage
        Log::info("SPARQL Query: " . $query);
    
        // Créer un client HTTP Guzzle
        $client = new \GuzzleHttp\Client();
    
        try {
            // Envoyer la requête au point de terminaison SPARQL Fuseki
            $response = $client->post('http://localhost:3030/restaurant_dataset/update', [
                'headers' => [
                    'Content-Type' => 'application/sparql-update',
                ],
                'body' => $query
            ]);
    
            // Rediriger avec un message de succès
            return redirect()->back()->with('success', 'Restaurant ajouté avec succès!');
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Journaliser la réponse d'erreur pour le débogage
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Erreur lors de l\'ajout du restaurant: ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du restaurant : ' . $e->getMessage());
        }
    }
    
}
