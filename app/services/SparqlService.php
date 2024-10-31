<?php

namespace App\Services;

use EasyRdf\Sparql\Client;

class SparqlService
{
    protected $sparqlClient;

    public function __construct()
    {
        $endpointUrl = config('sparql.endpoint');  // L'URL de votre endpoint SPARQL
        $this->sparqlClient = new Client($endpointUrl);
    }

    public function query($sparqlQuery)
    {
        return $this->sparqlClient->query($sparqlQuery);
    }

    public function update($sparqlUpdate)
    {
        return $this->sparqlClient->update($sparqlUpdate);
    }
}
