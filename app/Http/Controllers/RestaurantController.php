<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use EasyRdf\Graph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use EasyRdf\RdfNamespace;
use App\Models\Notification; 

class RestaurantController extends Controller
{
    private $fusekiEndpoint;
    private $owlGraph;

    public function __construct()
    {
        $this->fusekiEndpoint = 'http://localhost:3030/restaurant_dataset/sparql';
        
        // Load the OWL file
        $this->owlGraph = new Graph();
        $this->owlGraph->parseFile(storage_path('app/ontology.owl'), 'rdfxml');

        // Set prefixes for accessing OWL properties
        RdfNamespace::set('ex', 'http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#');
    }

    public function index()
    {  
        $notifications = Notification::all(); // Retrieve notifications from the database

        $client = new Client();

        // Define the SPARQL query based on OWL data
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
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
            $response = $client->post($this->fusekiEndpoint, [
                'form_params' => [
                    'query' => $query,
                    'output' => 'application/json'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $restaurants = json_decode($response->getBody(), true);

            if (empty($restaurants['results']['bindings'])) {
                return view('restaurants.index')->with('message', 'Aucun restaurant trouvé.');
            }

            return view('restaurants.index', compact('restaurants','notifications'));

        } catch (RequestException $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $restaurantId = '<http://example.org/restaurant' . uniqid() . '>';

        // Sanitize inputs
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

        // Build the SPARQL query
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
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

        Log::info("SPARQL Query: " . $query);

        $client = new Client();

        try {
            $response = $client->post('http://localhost:3030/restaurant_dataset/update', [
                'headers' => [
                    'Content-Type' => 'application/sparql-update',
                ],
                'body' => $query
            ]);

            return redirect()->back()->with('success', 'Restaurant ajouté avec succès!');
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Erreur lors de l\'ajout du restaurant: ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du restaurant : ' . $e->getMessage());
        }
    }
    public function update(Request $request, $restaurantId)
{
    // Validation des données d'entrée
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'postal_code' => 'required|string|max:10',
        'contact_name' => 'required|string|max:255',
        'contact_phone' => 'required|string|max:15',
        'contact_email' => 'required|email|max:255',
        'food_type' => 'required|string|max:255',
        'collection_zone' => 'required|string|max:255',
        'banque_alimentaire_id' => 'required|string|max:255',
    ]);

    // Préparation des valeurs d'entrée
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

    // Création de la requête SPARQL
    $query = "
        PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
        DELETE {
            <$restaurantId> ex:name ?oldName ;
                          ex:address ?oldAddress ;
                          ex:city ?oldCity ;
                          ex:postal_code ?oldPostalCode ;
                          ex:contact_name ?oldContactName ;
                          ex:contact_phone ?oldContactPhone ;
                          ex:contact_email ?oldContactEmail ;
                          ex:food_type ?oldFoodType ;
                          ex:collection_zone ?oldCollectionZone ;
                          ex:banque_alimentaire_id ?oldBanqueAlimentaireId .
        }
        INSERT {
            <$restaurantId> a ex:Restaurant ;
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
        WHERE {
            <$restaurantId> ex:name ?oldName ;
                            ex:address ?oldAddress ;
                            ex:city ?oldCity ;
                            ex:postal_code ?oldPostalCode ;
                            ex:contact_name ?oldContactName ;
                            ex:contact_phone ?oldContactPhone ;
                            ex:contact_email ?oldContactEmail ;
                            ex:food_type ?oldFoodType ;
                            ex:collection_zone ?oldCollectionZone ;
                            ex:banque_alimentaire_id ?oldBanqueAlimentaireId .
        }
    ";

    Log::info("SPARQL Update Query: " . $query);

    // Envoi de la requête SPARQL au serveur Fuseki
    $client = new Client();

    try {
        $response = $client->post('http://localhost:3030/restaurant_dataset/update', [
            'headers' => [
                'Content-Type' => 'application/sparql-update',
            ],
            'body' => $query
        ]);

        return redirect()->back()->with('success', 'Restaurant mis à jour avec succès!');
    } catch (RequestException $e) {
        $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
        Log::error('Erreur lors de la mise à jour du restaurant: ' . $e->getMessage() . ' Response: ' . $responseBody);
        return redirect()->back()->with('error', 'Erreur lors de la mise à jour du restaurant : ' . $e->getMessage());
    }
}

    

}
