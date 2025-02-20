<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepositoryEloquent implements CustomerRepository
{
    public function create(array $data): Customer
    {        
        return Customer::create($data);
    }

    public function getCustomerByDocument(string $document): Customer
    {
        return Customer::where('document', $document)->first();
    }

    public function getCustomerByAsaasId(string $asaasId): Customer
    {
        return Customer::where('asaas_id', $asaasId)->first();
    }
}