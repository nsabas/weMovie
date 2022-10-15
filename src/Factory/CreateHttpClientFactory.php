<?php

namespace App\Factory;

use Symfony\Component\HttpClient\HttpClient;

class CreateHttpClientFactory
{
    static public function createHttpClient(string $baseUri, string $apiKey, array $baseParam = []){
        $client = HttpClient::create([
            'base_uri' => $baseUri,
            'query' => [
                'api_key' => $apiKey,
                'language' => 'fr-FR'
            ]
        ]);

        return $client;
    }

}
