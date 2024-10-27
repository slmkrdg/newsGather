<?php

namespace App\Services\News\Config;

interface NewsServiceConfigBuilderInterface
{
    public function setBaseUrl(string $url): self;
    public function setApiKey(string $key): self;
    public function setTimeout(int $timeout): self;
    public function build(): NewsServiceConfig;
}