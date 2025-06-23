<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenFoodFactsService
{
    private HttpClientInterface $client;
    private string $baseUrl = 'https://world.openfoodfacts.org';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchProductByName(string $name): ?array
    {
        $response = $this->client->request('GET', $this->baseUrl . '/cgi/search.pl', [
            'query' => [
                'search_terms' => $name,
                'search_simple' => 1,
                'action' => 'process',
                'json' => 1,
                'page_size' => 1
            ],
        ]);

        $data = $response->toArray();

        if (!empty($data['products'][0])) {
            return $data['products'][0];
        }

        return null;
    }
}
