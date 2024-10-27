<?php

namespace App\Services\News\Config;

class NewsServiceConfig
{
    public string $baseUrl;
    public string $apiKey;
    public int $timeout;

    public function __construct(string $baseUrl, string $apiKey, int $timeout)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->timeout = $timeout;
    }
}
