<?php

namespace Tests\Unit;

use App\Payments\Factories\PaymentFactory;
use App\Payments\PaymentMethods\BoletoPayment;
use App\Payments\PaymentMethods\CreditCardPayment;
use App\Payments\PaymentMethods\PixPayment;
use DomainException;
use Tests\TestCase;

class PaymentFactoryTest extends TestCase
{
    /**
     * @throws DomainException
     */
    public function test_should_get_payment_methods_from_factory() : void
    {    
        $creditCardMethod = PaymentFactory::createPaymentMethod('CREDIT_CARD');
        $boletoMethod = PaymentFactory::createPaymentMethod('BOLETO');
        $pixMethod = PaymentFactory::createPaymentMethod('PIX');

        $this->assertInstanceOf(CreditCardPayment::class, $creditCardMethod);
        $this->assertInstanceOf(BoletoPayment::class, $boletoMethod);
        $this->assertInstanceOf(PixPayment::class, $pixMethod);
    }
    
    /**
     * @throws DomainException
     */
    public function test_should_get_exception_when_instantiate_invalid_method() : void
    {    
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Payment method not supported");
        PaymentFactory::createPaymentMethod('debit_card');
    }
}
