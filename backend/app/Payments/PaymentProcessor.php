<?php

namespace App\Payments;

use App\Payments\PaymentMethods\PaymentMethod;

class PaymentProcessor
{
    public function __construct(private readonly PaymentMethod $paymentMethod){}

    public function process(array $details)
    {
        return $this->paymentMethod->processPayment($details);
    }
}