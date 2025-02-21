<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\User;

interface CustomerRepository
{
    public function create(array $data): Customer;
    public function getCustomerByDocument(string $document): Customer|null;

    public function getCustomerByAsaasId(string $asaasId): Customer|null;

    public function getCustomerFromUser(User $user): Customer|null;
}