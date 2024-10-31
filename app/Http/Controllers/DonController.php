<?php

namespace App\Http\Controllers;

use App\Models\Don;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use GuzzleHttp\Client; // Import GuzzleHttp Client
use EasyRdf\Graph;
use EasyRdf\RdfNamespace;
use Illuminate\Support\Facades\Log;

class DonController extends Controller
{
    private $fusekiEndpoint;

    public function __construct()
    {
        $this->fusekiEndpoint = 'http://localhost:3030/restaurant_dataset/sparql';
        
        // Set up namespaces for RDF
        RdfNamespace::set('ex', 'http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#');
    }

    // Show the donation history for the logged-in user with the role 'restaurant'
    public function index()
    {
        $client = new Client();
    
        // Définir la requête SPARQL pour récupérer les dons
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?donationId ?userId ?category ?subCategory ?quantity ?datePreemption 
            WHERE {
                ?donationId a ex:Donation ;
                    ex:user_id ?userId ;
                    ex:category ?category ;
                    ex:sub_category ?subCategory ;
                    ex:quantity ?quantity ;
                    ex:date_preemption ?datePreemption .
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
    
            // Décoder la réponse JSON
            $donations = json_decode($response->getBody(), true);
            $user_id = auth()->id(); // Supposant que vous utilisez l'authentification
    
            // Vérifiez si des dons ont été récupérés
            if (empty($donations['results']['bindings'])) {
                return view('pages.dons.index')->with('message', 'Aucun don trouvé.')->with('user_id', $user_id);
            }
    
            // Passer les résultats à la vue
            return view('pages.dons.index', [
                'donations' => $donations['results']['bindings'],
                'user_id' => $user_id
            ]);
    
        } catch (RequestException $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()], 500);
        }
    }
    


public function store(Request $request)
{
    // Ensure the user has the 'restaurant' role
    if (Auth::user()->role !== 'restaurant') {
        return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation pour effectuer cette action.');
    }

    // Create a unique identifier for the donation
    $donationId = '<http://example.org/donation' . uniqid() . '>';

    // Sanitize inputs
    $userId = Auth::user()->id; // Get the authenticated user's ID

    // Retrieve inputs safely
    $category = $request->input('category');
    $subCategory = $request->input('sub_category');
    $quantity = $request->input('quantity');
    $datePreemption = $request->input('date_preemption');

    // Check if the input is an array, and get the first element if it is
    $category = is_array($category) ? $category[0] : $category;
    $subCategory = is_array($subCategory) ? $subCategory[0] : $subCategory;
    $quantity = is_array($quantity) ? (int) $quantity[0] : (int) $quantity; // Assuming quantity is an integer
    $datePreemption = is_array($datePreemption) ? $datePreemption[0] : $datePreemption; // Ensure date is in the correct format

    // Sanitize the inputs
    $category = addslashes(trim($category));
    $subCategory = addslashes(trim($subCategory));
    $datePreemption = addslashes(trim($datePreemption));

    // Build the SPARQL query
    $query = "
        PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
        INSERT DATA {
            $donationId a ex:Donation ;
                ex:user_id \"$userId\" ;
                ex:category \"$category\" ;
                ex:sub_category \"$subCategory\" ;
                ex:quantity $quantity ;
                ex:date_preemption \"$datePreemption\" .
        }
    ";


    $client = new Client();

    try {
        // Send the SPARQL update request
        $response = $client->post('http://localhost:3030/restaurant_dataset/update', [
            'headers' => [
                'Content-Type' => 'application/sparql-update',
            ],
            'body' => $query
        ]);

        return redirect()->back()->with('success', 'Don ajouté avec succès!');
    } catch (RequestException $e) {
        $responseBody = $e->getResponse() ? (string)$e->getResponse()->getBody() : 'No response';
        Log::error('Erreur lors de l\'ajout du don: ' . $e->getMessage() . ' Response: ' . $responseBody);
        return redirect()->back()->with('error', 'Erreur lors de l\'ajout du don : ' . $e->getMessage());
    }
}


    private function fetchDonsFromSparql($userId)
    {
        // Create a SPARQL query to fetch donations for the authenticated user
        $query = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            SELECT ?don ?category ?sub_category ?quantity ?date_preemption
            WHERE {
                ?don ex:user_id '$userId' .
                ?don ex:category ?category .
                OPTIONAL { ?don ex:sub_category ?sub_category . }
                OPTIONAL { ?don ex:quantity ?quantity . }
                OPTIONAL { ?don ex:date_preemption ?date_preemption . }
            }
        ";
    
        // Execute the query using GuzzleHttp
        $client = new Client();
        $response = $client->request('GET', $this->fusekiEndpoint, [
            'query' => [
                'query' => $query,
                'format' => 'json'
            ]
        ]);
    
        $data = json_decode($response->getBody(), true);
    
        // Convert to a Laravel collection for easier manipulation
        return collect($data['results']['bindings'] ?? []);
    }
    

    public function storeDonationInSparql($donationData)
{
    $updateQuery = "
        PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
        INSERT DATA {
            ex:donation_{$donationData['user_id']} a ex:Donation ;
                ex:user_id '{$donationData['user_id']}' ;
                ex:category '{$donationData['category']}' ;
                ex:sub_category '{$donationData['sub_category']}' ;
                ex:quantity {$donationData['quantity']} ;
                ex:date_preemption '{$donationData['date_preemption']}' .
        }
    ";

    // Execute the SPARQL update query
    $client = new Client();

    // Send the request
    $response = $client->request('POST', $this->fusekiEndpoint, [
        'form_params' => [
            'update' => $updateQuery  // Keep this as is for SPARQL updates
        ],
        'headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ],
    ]);

    return $response;
}



    public function aboutUs()
    {
        return view('pages.aboutus');
    }

    public function indexAllDons()
    {
        // Fetch all donations
        $dons = Don::with('restaurant')->get();
        return view('pages.dons.all', compact('dons'));
    }

    public function front()
    {
        return view('frontoffice'); // Ensure the view is frontoffice.blade.php
    }
}
