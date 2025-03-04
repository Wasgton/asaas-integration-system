<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApiRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @throws \JsonException
     */
    public function sendCustomerCreationRequest(array $customerRequestData): string
    {
        $response = $this->client->request('POST', 'customers', ['json' => $customerRequestData]);
        $apiResponseData = json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        return $apiResponseData['id'];
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getCustomerByEmail(string $email): array|null
    {
        $response = $this->client->request('GET', 'customers?email='.$email);
        $arrayResponse = json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        if (!$arrayResponse['totalCount']) {
            return null;
        }
        return $arrayResponse['data'][0];
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getCustomerById(string $id): array|null
    {
        $response = $this->client->request('GET', 'customers/'.$id);
        $arrayResponse = json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        if (!$arrayResponse['totalCount']) {
            return null;
        }
        return $arrayResponse['data'][0];
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function createPayment(array $data) : array
    {
        $response = $this->client->request('POST', 'payments', ['http_errors' => false, 'json' => $data]);
        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getQrCode(string $id): array
    {
        $response = $this->client->request('GET', 'payments/'.$id.'/pixQrCode');
        if ($response->getStatusCode() === 404) {
            throw new NotFoundHttpException();
        }
        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }

}