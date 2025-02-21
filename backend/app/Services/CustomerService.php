<?php

namespace App\Services;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use GuzzleHttp\Exception\GuzzleException;
use HttpException;
use Illuminate\Http\Response;

class CustomerService extends AsaasAbstractService
{
    public function __construct(private readonly CustomerRepository $customerRepository)
    {
        parent::__construct();
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    public function ensureCustomerExists(array $customerDetails) : Customer
    {
        $user = auth()->user();
        $existingCustomer = $this->customerRepository->getCustomerFromUser($user);
        if ($existingCustomer) {
            return $existingCustomer;
        }
        $searchedCustomer = $this->sendCustomerSearchRequest($user->email);
        if (!$searchedCustomer) {
            return $this->createCustomer($customerDetails);
        }
        $customer = [
            'user_id' => $user->id,
            'asaas_id' => $searchedCustomer['id'],
            ...$customerDetails
        ];
        return $this->customerRepository->create($customer);
    }

    /**
     * @throws GuzzleException
     * @throws HttpException
     */
    public function createCustomer(array $data) : Customer
    {
        $requestData = $this->prepareCustomerRequestData($data);
        $data['asaas_id'] = $this->sendCustomerCreationRequest($requestData);
        $data['user_id'] = auth()->user()->id;
        return $this->customerRepository->create($data);
    }

    private function prepareCustomerRequestData(array $data): array
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'cpfCnpj' => $data['document'],
        ];
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    private function sendCustomerCreationRequest(array $customerRequestData): string
    {
        $response = $this->client->request('POST', 'customers', ['json' => $customerRequestData]);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new HttpException('Error to create customer');
        }
        $apiResponseData = json_decode((string)$response->getBody(), true);
        return $apiResponseData['id'];
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    private function sendCustomerSearchRequest(string $email): array|null
    {
        $response = $this->client->request('GET', 'customers?email='.$email);
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new HttpException('Error to create customer');
        }
        $arrayResponse = json_decode((string)$response->getBody(), true);
        if (!$arrayResponse['totalCount']) {
            return null;
        }
        return $arrayResponse['data'][0];
    }


}