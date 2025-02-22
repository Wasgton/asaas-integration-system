<?php

namespace App\Payments\PaymentMethods;

use App\Payments\PaymentMethods\Contracts\PaymentMethod;

class PixPayment implements PaymentMethod
{

    public function processPayment(array $paymentData)
    {
        // TODO: Implement processPayment() method.
    }

    public function validate(array $paymentData): void
    {
        // TODO: Implement validate() method.
    }
}