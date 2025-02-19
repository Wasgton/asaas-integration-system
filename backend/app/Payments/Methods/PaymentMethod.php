<?php

namespace App\Payments\Methods;

interface PaymentMethod {
    public function processPayment(array $details);
}
