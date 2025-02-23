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

    public function getCustomerFromUser(User $user): Customer|null
    {
        return $user->customer;
    }
}