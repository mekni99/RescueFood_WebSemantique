<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use EasyRdf\Graph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use EasyRdf\RdfNamespace;
use App\Models\AssociationRequest;

class AssociationRequestController extends Controller
{
    private $fusekiEndpoint;
    private $owlGraph;

    public function __construct()
    {
        $this->fusekiEndpoint = 'http://localhost:3030/restaurant_dataset/sparql';

        // Charger le fichier OWL
        $this->owlGraph = new Graph();
        $this->owlGraph->parseFile(storage_path('app/ontology.owl'), 'rdfxml');

        // Définir les préfixes pour accéder aux propriétés OWL
        RdfNamespace::set('ex', 'http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#');
    }

    public function index()
    {
      

        $client = new Client();

        // Définir la requête SPARQL pour récupérer les demandes d'association
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?request ?association_name ?association_email ?product_requested ?quantity ?status
            WHERE {
                ?request a ex:AssociationRequest ;
                    ex:association_name ?association_name ;
                    ex:association_email ?association_email ;
                    ex:product_requested ?product_requested ;
                    ex:quantity ?quantity ;
                    ex:status ?status .
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

            $associationRequests = json_decode($response->getBody(), true);

            if (empty($associationRequests['results']['bindings'])) {
                return view('pages.associationRequest')->with('message', 'Aucune demande d\'association trouvée.');
            }

            return view('pages.associationRequest', compact('associationRequests'));

        } catch (RequestException $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $requestId = '<http://example.org/associationRequest' . uniqid() . '>';

        // Sanitiser les entrées
        $associationName = addslashes(trim($request->input('association_name')));
        $associationEmail = addslashes(trim($request->input('association_email')));
        $productRequested = addslashes(trim($request->input('product_requested')));
        $quantity = addslashes(trim($request->input('quantity')));
        $status = addslashes(trim($request->input('status')));

        // Construire la requête SPARQL
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            INSERT DATA {
                $requestId a ex:AssociationRequest ;
                    ex:association_name \"$associationName\" ;
                    ex:association_email \"$associationEmail\" ;
                    ex:product_requested \"$productRequested\" ;
                    ex:quantity \"$quantity\" ;
                    ex:status \"$status\" .
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

            return redirect()->back()->with('success', 'Demande d\'association ajoutée avec succès!');
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Erreur lors de l\'ajout de la demande : ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout de la demande : ' . $e->getMessage());
        }
    }

    public function update(Request $request, $requestId)
    {
        $request->validate([
            'association_name' => 'required|string|max:255',
            'association_email' => 'required|email|max:255',
            'product_requested' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'status' => 'required|string|max:50',
        ]);

        $associationName = addslashes(trim($request->input('association_name')));
        $associationEmail = addslashes(trim($request->input('association_email')));
        $productRequested = addslashes(trim($request->input('product_requested')));
        $quantity = addslashes(trim($request->input('quantity')));
        $status = addslashes(trim($request->input('status')));

        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            DELETE {
                <$requestId> ex:association_name ?oldAssociationName ;
                             ex:association_email ?oldAssociationEmail ;
                             ex:product_requested ?oldProductRequested ;
                             ex:quantity ?oldQuantity ;
                             ex:status ?oldStatus .
            }
            INSERT {
                <$requestId> a ex:AssociationRequest ;
                            ex:association_name \"$associationName\" ;
                            ex:association_email \"$associationEmail\" ;
                            ex:product_requested \"$productRequested\" ;
                            ex:quantity \"$quantity\" ;
                            ex:status \"$status\" .
            }
            WHERE {
                <$requestId> ex:association_name ?oldAssociationName ;
                             ex:association_email ?oldAssociationEmail ;
                             ex:product_requested ?oldProductRequested ;
                             ex:quantity ?oldQuantity ;
                             ex:status ?oldStatus .
            }
        ";

        Log::info("SPARQL Update Query: " . $query);

        $client = new Client();

        try {
            $response = $client->post('http://localhost:3030/restaurant_dataset/update', [
                'headers' => [
                    'Content-Type' => 'application/sparql-update',
                ],
                'body' => $query
            ]);

            return redirect()->back()->with('success', 'Demande d\'association mise à jour avec succès!');
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Erreur lors de la mise à jour de la demande : ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour de la demande : ' . $e->getMessage());
        }
    }
}