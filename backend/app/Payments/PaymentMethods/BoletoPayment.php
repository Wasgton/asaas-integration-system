<?php

namespace App\Payments\PaymentMethods;

use App\Payments\PaymentMethods\Contracts\PaymentMethod;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BoletoPayment implements PaymentMethod
{

    public function processPayment(array $paymentData)
    {
        // TODO: Implement processPayment() method. 
    }

    public function validate(array $paymentData): void
    {
        $validator = Validator::make($paymentData,[
            'installmentCount'                       => 'sometimes|max:12',
            'totalValue'                             => 'required_with:installmentCount|numeric|min:1',
        ],
        );
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}