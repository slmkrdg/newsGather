<?php

namespace App\Services\News\Config;

class NewsServiceDirector
{
    public function buildServiceConfig(string $driver): NewsServiceConfig
    {
        $builder = new NewsServiceConfigBuilder();

        return $builder
            ->setBaseUrl(config("news.{$driver}.base_url"))
            ->setApiKey(config("news.{$driver}.api_key"))
            ->setTimeout(60)
            ->build();
    }

}