<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use EasyRdf\Graph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use EasyRdf\RdfNamespace;

class StockController extends Controller
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
        $client = new Client();

        // Define the SPARQL query to retrieve stock data
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?stock ?category ?quantity ?sub_category
            WHERE {
                ?stock a ex:Stock ;
                    ex:category ?category ;
                    ex:quantity ?quantity ;
                    ex:sub_category ?sub_category .
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

            $stocks = json_decode($response->getBody(), true);

            if (empty($stocks['results']['bindings'])) {
                return view('pages.stock')->with('message', 'Aucun stock trouvé.');
            }

            return view('pages.stock', compact('stocks'));

        } catch (RequestException $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $stockId = '<http://example.org/stock' . uniqid() . '>';

        // Sanitize inputs
        $category = addslashes(trim($request->input('category')));
        $quantity = addslashes(trim($request->input('quantity')));
        $subCategory = addslashes(trim($request->input('sub_category')));

        // Build the SPARQL query
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            INSERT DATA {
                $stockId a ex:Stock ;
                    ex:category \"$category\" ;
                    ex:quantity $quantity ;
                    ex:sub_category \"$subCategory\" .
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

            return redirect()->back()->with('success', 'Stock ajouté avec succès!');
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Erreur lors de l\'ajout du stock: ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du stock : ' . $e->getMessage());
        }
    }
}