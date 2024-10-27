<?php

namespace App\Services\News\Factory;

use InvalidArgumentException;
use App\Services\News\Sdk\NewsServiceInterface;
use App\Services\News\Config\NewsServiceDirector;
use App\Services\News\Sdk\CryptoPanic\CryptoPanicService;


class NewsServiceFactory
{
    protected NewsServiceDirector $director;

    public function __construct(NewsServiceDirector $director)
    {
        $this->director = $director;
    }

    public function create(string $serviceName): NewsServiceInterface
    {
        $config = $this->director->buildServiceConfig($serviceName);
        switch ($serviceName) {
            case 'cryptopanic':
                return new CryptoPanicService($config);
                
            default:
                throw new InvalidArgumentException("Unknown service: {$serviceName}");
        }
    }
}
