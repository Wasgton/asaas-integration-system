<?php

namespace App\Payments\Factories;

use App\Payments\Methods\BoletoPayment;
use App\Payments\Methods\CreditCardPayment;
use App\Payments\Methods\PaymentMethod;
use App\Payments\Methods\PixPayment;

class PaymentFactory
{

    public static function createPaymentMethod(string $type) : PaymentMethod
    {
         return match ($type) {
             'boleto' => new BoletoPayment(),
             'credit_card' => new CreditCardPayment(),
             'pix' => new PixPayment(),
             default => throw new \Exception("Payment method not supported")
         };
    }
    
}