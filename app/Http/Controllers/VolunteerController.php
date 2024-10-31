<?php 

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use EasyRdf\Graph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use EasyRdf\RdfNamespace;

class VolunteerController extends Controller
{
    private $fusekiEndpoint;
    private $owlGraph;

    public function __construct()
    {
        $this->fusekiEndpoint = 'http://localhost:3030/association/sparql';
        
        // Load the OWL file
        $this->owlGraph = new Graph();
        $this->owlGraph->parseFile(storage_path('app/ontology.owl'), 'rdfxml');

        // Set prefixes for accessing OWL properties
        RdfNamespace::set('ex', 'http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#');
    }

    public function index()
    {
        $client = new Client();
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?volunteer ?name ?location ?availability ?telephone_number
            WHERE {
                ?volunteer a ex:Volunteer ;
                    ex:name ?name ;
                    ex:location ?location ;
                    ex:availability ?availability ;
                    ex:telephone_number ?telephone_number .
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

            $volunteers = json_decode($response->getBody(), true);

            return view('volunteers.index', ['volunteers' => $volunteers['results']['bindings'] ?? [], 'message' => '']);

        } catch (RequestException $e) {
            Log::error('Error fetching volunteers: ' . $e->getMessage());
            return view('volunteers.index')->with('message', 'Error fetching volunteers.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'availability' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:15',
        ]);

        $name = addslashes(trim($request->input('name')));
        $location = addslashes(trim($request->input('location')));
        $availability = addslashes(trim($request->input('availability')));
        $telephoneNumber = addslashes(trim($request->input('telephone_number')));

        $volunteerId = '<http://example.org/volunteer' . uniqid() . '>';

        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            INSERT DATA {
                $volunteerId a ex:Volunteer ;
                    ex:name \"$name\" ;
                    ex:location \"$location\" ;
                    ex:availability \"$availability\" ;
                    ex:telephone_number \"$telephoneNumber\" .
            }
        ";

        Log::info("SPARQL Query: " . $query);

        $client = new Client();

        try {
            $response = $client->post( 'http://localhost:3030/association/update', [
                'headers' => [
                    'Content-Type' => 'application/sparql-update',
                ],
                'body' => $query
            ]);

            return redirect()->route('volunteers.index')->with('success', 'Volontaire ajouté avec succès!');
        } catch (RequestException $e) {
            Log::error('Error adding volunteer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error adding volunteer: ' . $e->getMessage());
        }
    }
}
