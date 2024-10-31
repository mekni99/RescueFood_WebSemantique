<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use EasyRdf\Graph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use EasyRdf\RdfNamespace;
use App\Models\Notification;
use App\Models\Transport;

class TransportController extends Controller
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
        Log::info('Fetching transports from SPARQL endpoint.');

        $notifications = Notification::all(); // Retrieve notifications from the database
        $client = new Client();

        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?transport ?vehicle_type ?license_plate ?driver_name ?status
            WHERE {
                ?transport a ex:Transport ;
                    ex:vehicle_type ?vehicle_type ;
                    ex:license_plate ?license_plate ;
                    ex:driver_name ?driver_name ;
                    ex:status ?status .
            }
        ";

        try {
            Log::info('Executing SPARQL query.', ['query' => $query]);
            $response = $client->post($this->fusekiEndpoint, [
                'form_params' => [
                    'query' => $query,
                    'output' => 'application/json'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            // Transformation des données reçues
            $data = json_decode($response->getBody(), true);
            $transports = [];

            foreach ($data['results']['bindings'] as $binding) {
                $transports[] = [
                    'vehicle_type' => $binding['vehicle_type']['value'],
                    'license_plate' => $binding['license_plate']['value'],
                    'driver_name' => $binding['driver_name']['value'],
                    'status' => $binding['status']['value'],
                ];
            }

            Log::info('Fetched transports successfully.', ['count' => count($transports)]);
            return view('transports.index', compact('transports', 'notifications'));

        } catch (RequestException $e) {
            Log::error('Error while fetching transports: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info('Adding new transport.', $request->all());

        $transportId = '<http://example.org/transport' . uniqid() . '>';

        $vehicleType = addslashes(trim($request->input('vehicle_type')));
        $licensePlate = addslashes(trim($request->input('license_plate')));
        $driverName = addslashes(trim($request->input('driver_name')));
        $status = addslashes(trim($request->input('status')));

        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            INSERT DATA {
                $transportId a ex:Transport ;
                    ex:vehicle_type \"$vehicleType\" ;
                    ex:license_plate \"$licensePlate\" ;
                    ex:driver_name \"$driverName\" ;
                    ex:status \"$status\" .
            }
        ";

        Log::info("SPARQL Insert Query: " . $query);

        $client = new Client();

        try {
            $response = $client->post('http://localhost:3030/restaurant_dataset/update', [
                'headers' => [
                    'Content-Type' => 'application/sparql-update',
                ],
                'body' => $query
            ]);

            Log::info('Transport added successfully.');
            return redirect()->back()->with('success', 'Transport ajouté avec succès!');
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Error while adding transport: ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->withErrors('Erreur lors de l\'ajout du transport.');
        }
    }
    
}