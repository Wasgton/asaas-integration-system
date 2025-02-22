<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApiRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AsaasApiRepository implements ApiRepository
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
    
    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    public function sendCustomerCreationRequest(array $customerRequestData): string
    {
        $response = $this->client->request('POST', 'customers', ['json' => $customerRequestData]);
        $apiResponseData = json_decode((string)$response->getBody(), true);
        return $apiResponseData['id'];
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    public function getCustomerByEmail(string $email): array|null
    {
        $response = $this->client->request('GET', 'customers?email='.$email);
        $arrayResponse = json_decode((string)$response->getBody(), true);
        if (!$arrayResponse['totalCount']) {
            return null;
        }
        return $arrayResponse['data'][0];
    }
    
    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    public function getCustomerById(string $id): array|null
    {
        $response = $this->client->request('GET', 'customers/'.$id);
        $arrayResponse = json_decode((string)$response->getBody(), true);
        if (!$arrayResponse['totalCount']) {
            return null;
        }
        return $arrayResponse['data'][0];
    }

    public function createPayment(array $data) : array
    {
        $response = $this->client->request('POST', 'payments', ['http_errors' => false, 'json' => $data]);
        return json_decode((string)$response->getBody(), true);
    }

}