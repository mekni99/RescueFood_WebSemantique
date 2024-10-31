<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

class AssociationController extends Controller
{
    private $fusekiEndpoint;

    public function __construct()
    {
        $this->fusekiEndpoint = 'http://localhost:3030/association/sparql';
    }

    public function index()
    {
        $client = new Client();

        // SPARQL query to retrieve associations
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?association ?name ?contact_details ?specific_needs ?status
            WHERE {
                ?association a ex:Association ;
                    ex:name ?name ;
                    ex:contact_details ?contact_details ;
                    ex:specific_needs ?specific_needs ;
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

            $associations = json_decode($response->getBody(), true);

            // Initialize an empty array if no results are found
            if (empty($associations['results']['bindings'])) {
                $associations = []; // Define $associations as an empty array
                return view('associations.index')->with('message', 'Aucune association trouvée.')->with('associations', $associations);
            }

            return view('associations.index', compact('associations'));

        } catch (RequestException $e) {
            Log::error('Erreur lors de la récupération des données : ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_details' => 'required|string',
            'specific_needs' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Create unique ID for new association
        $associationId = '<http://example.org/association' . uniqid() . '>';
        $name = addslashes(trim($request->input('name')));
        $contactDetails = addslashes(trim($request->input('contact_details')));
        $specificNeeds = addslashes(trim($request->input('specific_needs')));
        $status = addslashes(trim($request->input('status')));

        // SPARQL query to insert association
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            INSERT DATA {
                $associationId a ex:Association ;
                    ex:name \"$name\" ;
                    ex:contact_details \"$contactDetails\" ;
                    ex:specific_needs \"$specificNeeds\" ;
                    ex:status \"$status\" .
            }
        ";

        Log::info("SPARQL Query: " . $query);

        $client = new Client();

        try {
            $response = $client->post('http://localhost:3030/association/update', [
                'headers' => [
                    'Content-Type' => 'application/sparql-update',
                ],
                'body' => $query
            ]);

            return redirect()->back()->with('success', 'Association ajoutée avec succès!');
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Erreur lors de l\'ajout de l\'association: ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout de l\'association : ' . $e->getMessage());
        }
    }
}
