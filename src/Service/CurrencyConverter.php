<?php
// src/Service/CurrencyConverter.php
namespace App\Service;

class CurrencyConverter
{
    public function __construct(
        private ExchangeRateService $exchangeRateService
    ) {}

    public function convert(float $amount, string $fromCurrency, string $toCurrency): float
    {
        $rate = $this->exchangeRateService->getRate($fromCurrency, $toCurrency);
        return $amount * $rate;
    }
}
