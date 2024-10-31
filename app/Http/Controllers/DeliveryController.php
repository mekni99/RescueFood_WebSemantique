<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;
use App\Models\Delivery;
use App\Models\Transport;

class DeliveryController extends Controller
{
    private $fusekiEndpoint;

    public function __construct()
    {
        $this->fusekiEndpoint = 'http://localhost:3030/restaurant_dataset/sparql';
    }

    public function index()
    {
        Log::info('Fetching deliveries from SPARQL endpoint.');

        $deliveries = Delivery::with('transport')->get(); // Récupérer les livraisons avec leur transport
        $client = new Client();

        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?delivery ?start_address ?delivery_address ?recipient_name ?status
            WHERE {
                ?delivery a ex:Delivery ;
                    ex:start_address ?start_address ;
                    ex:delivery_address ?delivery_address ;
                    ex:recipient_name ?recipient_name ;
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
            $deliveries = [];

            foreach ($data['results']['bindings'] as $binding) {
                $deliveries[] = [
                    'start_address' => $binding['start_address']['value'],
                    'delivery_address' => $binding['delivery_address']['value'],
                    'recipient_name' => $binding['recipient_name']['value'],
                    'status' => $binding['status']['value'],
                ];
            }

            Log::info('Fetched deliveries successfully.', ['count' => count($deliveries)]);
            return view('deliveries.index', compact('deliveries'));

        } catch (RequestException $e) {
            Log::error('Error while fetching deliveries: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info('Adding new delivery.', $request->all());

        $deliveryId = '<http://example.org/delivery' . uniqid() . '>';

        $startAddress = addslashes(trim($request->input('start_address')));
        $deliveryAddress = addslashes(trim($request->input('delivery_address')));
        $recipientName = addslashes(trim($request->input('recipient_name')));
        $status = addslashes(trim($request->input('status')));
        $transportId = addslashes(trim($request->input('transport_id')));

        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            INSERT DATA {
                $deliveryId a ex:Delivery ;
                    ex:start_address \"$startAddress\" ;
                    ex:delivery_address \"$deliveryAddress\" ;
                    ex:recipient_name \"$recipientName\" ;
                    ex:status \"$status\" ;
                    ex:transport_id \"$transportId\" .
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

            Log::info('Delivery added successfully.');
            return redirect()->back()->with('success', 'Delivery ajoutée avec succès!');
        } catch (RequestException $e) {
            $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
            Log::error('Error while adding delivery: ' . $e->getMessage() . ' Response: ' . $responseBody);
            return redirect()->back()->withErrors('Erreur lors de l\'ajout de la livraison.');
        }
    }
}