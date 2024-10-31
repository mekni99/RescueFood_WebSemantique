<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use EasyRdf\Graph;
use EasyRdf\RdfNamespace;

class DestinataireDashboardController extends Controller
{
    private $fusekiEndpoint;
    private $owlGraph;

    public function __construct()
    {
        $this->fusekiEndpoint = 'http://localhost:3030/Rescuefood/sparql';
        
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
            return back()->withErrors(['error' => 'Erreur lors de la récupération des destinataires.']);
        }

        $destinataires = $response->json()['results']['bindings'];

        return view('pages.destinataire-dashboard', compact('destinataires'));
    }

    /**
     * Stocker un nouveau destinataire.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'specific_needs' => 'nullable|string|max:255',
        ]);

        $sparqlInsertQuery = "
            PREFIX ex: <http://www.semanticweb.org/user/ontologies/2024/9/untitled-ontology-2#>
            INSERT DATA {
                _:destinataire a ex:Destinataire ;
                
                               ex:firstName \"{$request->first_name}\" ;
                               ex:lastName \"{$request->last_name}\" ;
                               ex:contact \"{$request->contact}\" ;
                               ex:address \"{$request->address}\" ;
                               ex:specificNeeds \"{$request->specific_needs}\" .
            }
        ";

        $response = Http::post($this->fusekiEndpoint, [
            'update' => $sparqlInsertQuery
        ]);

        if ($response->failed()) {
            return redirect()->route('destinataire.index')->with('error', 'Erreur lors de l\'ajout du destinataire.');
        }

        return redirect()->route('destinataire.index')->with('success', 'Destinataire ajouté avec succès.');
    }}