<?php

namespace App\Payments\PaymentMethods\Contracts;

interface PaymentMethod
{
    public function processPayment(array $paymentData);

    public function validate(array $paymentData): void;
}
