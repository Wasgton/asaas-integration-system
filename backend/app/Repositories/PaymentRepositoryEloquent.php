<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepository;

class PaymentRepositoryEloquent implements PaymentRepository
{
    public function create(array $data): Payment
    {        
        return Payment::create($data);
    }

    public function getPaymentByAsaasId(string $asaasId): Payment|null
    {
        return Payment::where('asaas_id', $asaasId)->first();
    }

}