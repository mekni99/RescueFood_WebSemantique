<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

class ProduitController extends Controller
{
    private $fusekiEndpoint;

    public function __construct()
    {
        // Endpoint SPARQL de Jena Fuseki
        $this->fusekiEndpoint = 'http://localhost:3030/restaurant_dataset/sparql';
    }

    // Afficher la liste des produits
    public function index()
    {
        $client = new Client();

        // Définir la requête SPARQL pour récupérer les données des produits
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?produit ?association_name ?product_requested ?quantity
            WHERE {
                ?produit a ex:Produit ;
                    ex:association_name ?association_name ;
                    ex:product_requested ?product_requested ;
                    ex:quantity ?quantity .
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

            $produits = json_decode($response->getBody(), true);

            if (empty($produits['results']['bindings'])) {
                return view('pages.produit')->with('message', 'Aucun produit trouvé.');
            }

            return view('pages.produit', compact('produits'));

        } catch (RequestException $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }

    // Ajouter un nouveau produit
    public function store(Request $request)
    {
        $produitId = '<http://example.org/produit' . uniqid() . '>';

        // Sanitize inputs
        $associationName = addslashes(trim($request->input('association_name')));
        $productRequested = addslashes(trim($request->input('product_requested')));
        $quantity = (int) $request->input('quantity');

        // Construire la requête SPARQL
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            INSERT DATA {
                $produitId a ex:Produit ;
                    ex:association_name \"$associationName\" ;
                    ex:product_requested \"$productRequested\" ;
                    ex:quantity $quantity .
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

            return redirect()->back()->with('success', 'Produit ajouté avec succès!');
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Erreur lors de l\'ajout du produit: ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du produit : ' . $e->getMessage());
        }
    }

   
    


}