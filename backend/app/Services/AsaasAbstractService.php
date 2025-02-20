<?php

namespace App\Services;


use GuzzleHttp\Client;

abstract class AsaasAbstractService
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
            'allow_redirects' => false,
            'headers' => [
                'access_token' => $this->apiKey,
                'accept' => 'application/json',
                'content-type'=>'application/json',
            ],
        ]);
    }

}