<?php

namespace App\Payments\PaymentMethods;

interface PaymentMethod {
    public function processPayment(array $details);
}
