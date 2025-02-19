<?php

namespace App\Payments\PaymentMethods\Contracts;

interface PaymentMethod
{
    public function processPayment(array $details);
}
