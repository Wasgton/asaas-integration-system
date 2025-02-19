<?php

namespace App\Payments\PaymentMethods;
use App\Payments\PaymentMethods\Contracts\PaymentMethod;
use GuzzleHttp\Client;

abstract class Payment implements PaymentMethod
{
    protected Client $client;
    protected string $baseUrl;
    protected string $apiKey;
    
    public function __construct()
    {
        $this->baseUrl = config('asaas.base_url');
        $this->apiKey = config('asaas.api_key');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 0,     
            'allow_redirects' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);
    }
    
    
}