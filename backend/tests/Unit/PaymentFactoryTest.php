<?php

namespace Tests\Unit;

use App\Payments\Factories\PaymentFactory;
use App\Payments\Methods\BoletoPayment;
use App\Payments\Methods\CreditCardPayment;
use App\Payments\Methods\PixPayment;
use PHPUnit\Framework\TestCase;

class PaymentFactoryTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function test_should_get_payment_methods_from_factory() : void
    {    
        $creditCardMethod = PaymentFactory::createPaymentMethod('credit_card');
        $boletoMethod = PaymentFactory::createPaymentMethod('boleto');
        $pixMethod = PaymentFactory::createPaymentMethod('pix');
        
        $this->assertInstanceOf(CreditCardPayment::class, $creditCardMethod);
        $this->assertInstanceOf(BoletoPayment::class, $boletoMethod);
        $this->assertInstanceOf(PixPayment::class, $pixMethod);
    }
}
