<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\User;
use App\Repositories\Contracts\CustomerRepository;

class CustomerRepositoryEloquent implements CustomerRepository
{
    public function create(array $data): Customer
    {        
        return Customer::create($data);
    }

    public function getCustomerByDocument(string $document): Customer|null
    {
        return Customer::where('document', $document)->first();
    }

    public function getCustomerByAsaasId(string $asaasId): Customer|null
    {
        return Customer::where('asaas_id', $asaasId)->first();
    }

    public function getCustomerFromUser(User $user): Customer|null
    {
        return $user->customer;
    }
}