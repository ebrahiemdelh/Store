<?php

namespace App\Services\CurrencyConverter;

class CurrencyConverter
{
    protected $apiKey;
    protected $baseUrl = 'https://v6.exchangerate-api.com/v6/b6cd6a07462751631e611ce7/latest/';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function convert($toCurrency, $fromCurrency = "USD", $amount = 1)
    {
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        $exchangeRates = $this->fetchExchangeRates($fromCurrency);

        if (!isset($exchangeRates[$toCurrency])) {
            throw new \Exception("Exchange rate not available for {$toCurrency}.");
        }

        // Convert the amount
        return round($amount * $exchangeRates[$toCurrency], 2);
    }
    protected function fetchExchangeRates($fromCurrency)
    {
        $response = file_get_contents($this->baseUrl . $fromCurrency);

        if ($response === false) {
            throw new \Exception("Failed to fetch exchange rates.");
        }

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            throw new \Exception("Error fetching exchange rates: {$data['error']}");
        }

        return $data['rates'];
    }
}
