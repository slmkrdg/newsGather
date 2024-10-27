<?php

namespace App\Services\News\Sdk\CryptoPanic;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Services\News\Sdk\NewsServiceInterface;
use App\Services\News\Config\NewsServiceConfig;


class CryptoPanicService implements NewsServiceInterface
{
    protected Client $client;
    protected NewsServiceConfig $config;

    public function __construct(NewsServiceConfig $config)
    {
        $this->config = $config;
        $this->client = new Client();
    }

    public function fetchNews(): array
    {
        try {
            $response = $this->client->request('GET', $this->config->baseUrl."?auth_token=".$this->config->apiKey."&kind=news");

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }

    }
}