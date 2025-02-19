<?php

namespace App\Payments\Factories;

use App\Payments\PaymentMethods\BoletoPayment;
use App\Payments\PaymentMethods\CreditCardPayment;
use App\Payments\PaymentMethods\PaymentMethod;
use App\Payments\PaymentMethods\PixPayment;

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