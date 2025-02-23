<?php

namespace App\Repositories\Contracts;

use App\Models\Customer;
use App\Models\User;

interface CustomerRepository
{
    public function create(array $data): Customer;

    public function getCustomerFromUser(User $user): Customer|null;
}