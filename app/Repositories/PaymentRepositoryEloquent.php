<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentRepositoryEloquent implements PaymentRepository
{
    public function create(array $data): Payment
    {        
        return Payment::create($data);
    }

    public function getPayments(Customer $customer): LengthAwarePaginator
    {
        return Payment::where('customer_id',$customer->id)
            ->with('customer')
            ->paginate(15);
    }
}