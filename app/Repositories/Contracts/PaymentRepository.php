<?php

namespace App\Repositories\Contracts;

use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Pagination\LengthAwarePaginator;

interface PaymentRepository
{
    public function create(array $data): Payment;

    public function getPayments(Customer $customer) : LengthAwarePaginator;
}