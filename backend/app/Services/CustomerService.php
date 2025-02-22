<?php

namespace App\Services;

use App\Models\Customer;
use App\Repositories\AsaasApiRepository;
use App\Repositories\Contracts\CustomerRepository;
use GuzzleHttp\Exception\GuzzleException;
use HttpException;

class CustomerService
{
    public function __construct(
        private readonly CustomerRepository $customerRepository,
        private readonly AsaasApiRepository $asaasApiRepository,
    ) {}

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
        $searchedCustomer = $this->asaasApiRepository->getCustomerByEmail($user->email);
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
        $data['asaas_id'] = $this->asaasApiRepository->sendCustomerCreationRequest($requestData);
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

   
    

}