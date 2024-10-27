<?php

namespace App\Services\News\Sdk;

interface NewsServiceInterface
{
    /**
     * Haberleri çekme metodu.
     *
     * @return array Ortak formata dönüştürülmüş haber verisi.
     */
    public function fetchNews(): array;
}