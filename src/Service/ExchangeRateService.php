<?php
// src/Service/ExchangeRateService.php
namespace App\Service;

class ExchangeRateService
{
    public function getRate(string $fromCurrency, string $toCurrency): float
    {
        // Dans la vraie vie, ici on appellerait une API
        throw new \RuntimeException('Appel réel interdit dans les tests');
    }
}
