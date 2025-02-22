<?php

namespace App\Payments\Factories;

use App\Payments\PaymentMethods\BoletoPayment;
use App\Payments\PaymentMethods\Contracts\PaymentMethod;
use App\Payments\PaymentMethods\CreditCardPayment;
use App\Payments\PaymentMethods\PixPayment;
use DomainException;

class PaymentFactory
{
    public static function createPaymentMethod(string $type) : PaymentMethod
    {
         return match ($type) {
             'BOLETO' => app(BoletoPayment::class),
             'CREDIT_CARD' => app(CreditCardPayment::class),
             'PIX' => app(PixPayment::class),
             default => throw new DomainException("Payment method not supported")
         };
    }

}