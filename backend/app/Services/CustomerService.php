<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use GuzzleHttp\Exception\GuzzleException;

class CustomerService extends AsaasAbstractService
{
    public function __construct(private readonly CustomerRepository $customerRepository)
    {
        parent::__construct();
    }

    /**
     * @throws GuzzleException
     */
    public function createCustomer(array $data)
    {
        $newData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'cpfCnpj' => $data['document'],
        ];
        $response = $this->client->request('POST', 'customers', ['form_params' => $newData]);
        $responseArray = json_decode((string)$response->getBody(), true);
        $customerData = [
            'user_id' => auth()->user()->id,
            'asaas_id' => $responseArray['id'],
            'document' => $data['document'],
            'email' => $data['email'],
            'name' => $data['name'],
        ];
        $this->customerRepository->create($customerData);
    }

}