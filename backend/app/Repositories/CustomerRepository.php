<?php

namespace App\Repositories;

use App\Models\Customer;

interface CustomerRepository
{
    public function create(array $data): Customer;
    public function getCustomerByDocument(string $document): Customer;

    public function getCustomerByAsaasId(string $asaasId): Customer;
}