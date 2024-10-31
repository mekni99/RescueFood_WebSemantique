<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Import du Facade Log
use EasyRdf\Graph;
use EasyRdf\RdfNamespace;
use GuzzleHttp\Client;

class DestinataireDashboardController extends Controller
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
        $sparqlQuery = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?first_name ?last_name ?contact ?address ?specific_needs
            WHERE {
                ?destinataire a ex:Destinataire ;
                             ex:firstName ?first_name ;
                             ex:lastName ?last_name ;
                             ex:contact ?contact ;
                             ex:address ?address ;
                             ex:specificNeeds ?specific_needs .
            }
        ";

        $response = Http::get($this->fusekiEndpoint, [
            'query' => $sparqlQuery,
            'format' => 'json'
        ]);

        if ($response->failed()) {
            Log::error('Failed to retrieve destinataires.', [
                'query' => $sparqlQuery,
                'response' => $response->body(),
            ]);
            return back()->withErrors(['error' => 'Erreur lors de la récupération des destinataires.']);
        }

        $destinataires = $response->json()['results']['bindings'];

        Log::info('Destinataires retrieved successfully.', [
            'count' => count($destinataires),
        ]);

        return view('pages.destinataire-dashboard', compact('destinataires'));
    }

    /**
     * Stocker un nouveau destinataire.
     */
    public function store(Request $request)
{
    // Générer un ID unique pour le destinataire
    $destinataireId = '<http://example.org/destinataire/' . uniqid() . '>';

    // Récupérer et nettoyer les données d'entrée
    $firstName = addslashes(trim($request->input('first_name')));
    $lastName = addslashes(trim($request->input('last_name')));
    $contact = addslashes(trim($request->input('contact')));
    $address = addslashes(trim($request->input('address')));
    $specificNeeds = addslashes(trim($request->input('specific_needs')));

    // Construire la requête SPARQL pour insérer les données du destinataire
    $query = "
        PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
        INSERT DATA {
            $destinataireId a ex:Destinataire ;
                ex:firstName \"$firstName\" ;
                ex:lastName \"$lastName\" ;
                ex:contact \"$contact\" ;
                ex:address \"$address\" ;
                ex:specificNeeds \"$specificNeeds\" .
        }
    ";

    Log::info("SPARQL Insert Query: " . $query);

    $client = new Client();

    try {
        // Envoyer la requête au serveur Fuseki
        $response = $client->post('http://localhost:3030/restaurant_dataset/update', [
            'headers' => [
                'Content-Type' => 'application/sparql-update',
            ],
            'body' => $query
        ]);

        return redirect()->back()->with('success', 'Destinataire ajouté avec succès!');
    } catch (RequestException $e) {
        $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
        Log::error('Erreur lors de l\'ajout du destinataire: ' . $e->getMessage() . ' Response: ' . $responseBody);
        return redirect()->back()->with('error', 'Erreur lors de l\'ajout du destinataire : ' . $e->getMessage());
    }
}

}
