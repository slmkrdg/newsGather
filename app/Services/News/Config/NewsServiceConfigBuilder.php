<?php

namespace App\Services\News\Config;

class NewsServiceConfigBuilder implements NewsServiceConfigBuilderInterface
{
    protected string $baseUrl;
    protected string $apiKey;
    protected int $timeout = 30; // Varsayılan timeout

    public function setBaseUrl(string $url): self
    {
        $this->baseUrl = $url;
        return $this;
    }

    public function setApiKey(string $key): self
    {
        $this->apiKey = $key;
        return $this;
    }

    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function build(): NewsServiceConfig
    {
        return new NewsServiceConfig($this->baseUrl, $this->apiKey, $this->timeout);
    }
}
