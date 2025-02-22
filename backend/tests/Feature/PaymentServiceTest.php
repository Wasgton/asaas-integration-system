<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\CustomerService;
use App\Services\PaymentService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_create_payment(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /**@var $service PaymentService*/
        $service = app(PaymentService::class);
        /**@var $customerService CustomerService*/
        $customerData = [
            'name' => $this->faker->name,
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->email
        ];        
        $paymentDetails = [
            'customer' => $customerData,
            "billingType"=> "CREDIT_CARD",
            "installmentCount"=> 2,
            "creditCard"=> [
                "holderName"=> "marcelo h almeida",
                "number"=> "5464171120127912",
                "expiryMonth"=> "02",
                "expiryYear"=> "2026",
                "ccv"=> "429"
            ],
            "creditCardHolderInfo"=> [
                "name"=> "Marcelo Henrique Almeida",
                "email"=> "marcelo.almeida@gmail.com",
                "cpfCnpj"=> "24971563792",
                "postalCode"=> "89223-005",
                "addressNumber"=> "277",
                "addressComplement"=> null,
                "phone"=> "71998781877",
            ],
            "value"=> 100.00,
            "totalValue"=> 100.00,
            "dueDate"=> Carbon::now()->addDays(15)->format('Y-m-d'),
        ];
        $payment = $service->createPayment($paymentDetails);
        $this->assertDatabaseHas('payments', $payment->toArray());
    }
    
    public function test_should_return_error_when_data_is_incorrect(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /**@var $service PaymentService*/
        $service = app(PaymentService::class);
        $customerService = app(CustomerService::class);
        $customerData = [
            'name' => $this->faker->name,
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->email
        ];        
        $paymentDetails = [
            'customer' => $customerData,
            "billingType"=> "CREDIT_CARD",
            "installmentCount"=> 2,
            "creditCard"=> [
                "holderName"=> "",
                "number"=> "5464171120127912",
                "expiryMonth"=> "02",
                "expiryYear"=> "2026",
                "ccv"=> "429"
            ],
            "creditCardHolderInfo"=> [
                "name"=> "Marcelo Henrique Almeida",
                "email"=> "marcelo.almeida@gmail.com",
                "cpfCnpj"=> "24971563792",
                "postalCode"=> "89223-005",
                "addressNumber"=> "277",
                "addressComplement"=> null,
                "phone"=> "719987818771",
            ],
            "value"=> 100.00,
            "totalValue"=> 100.00,
            "dueDate"=> Carbon::now()->addDays(15)->format('Y-m-d'),
        ];
        $this->expectException(ValidationException::class);
        $service->createPayment($paymentDetails);
    }

    /**
     * @throws \HttpException
     * @throws GuzzleException
     */
    public function test_should_return_error_for_invalid_cpf(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /**@var $service PaymentService */
        $service = app(PaymentService::class);

        $customerData = [
            'name'     => $this->faker->name,
            'document' => $this->faker->cpf(false),
            'email'    => $this->faker->email
        ];
        $paymentDetails = [
            'customer'             => $customerData,
            "billingType"          => "CREDIT_CARD",
            "installmentCount"     => 2,
            "creditCard"           => [
                "holderName"  => "Marcelo H Almeida",
                "number"      => "5464171120127912",
                "expiryMonth" => "02",
                "expiryYear"  => "2026",
                "ccv"         => "429"
            ],
            "creditCardHolderInfo" => [
                "name"              => "Marcelo Henrique Almeida",
                "email"             => "marcelo.almeida@gmail.com",
                "cpfCnpj"           => "123456789",
                "postalCode"        => "89223-005",
                "addressNumber"     => "277",
                "addressComplement" => null,
                "phone"             => "71998781877",
            ],
            "value"                => 100.00,
            "totalValue"           => 100.00,
            "dueDate"              => Carbon::now()->addDays(15)->format('Y-m-d'),
        ];
        $this->expectException(ValidationException::class);
        $service->createPayment($paymentDetails);
    }

    public function test_should_return_error_for_invalid_cnpj(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /**@var $service PaymentService */
        $service = app(PaymentService::class);

        $customerData = [
            'name'     => $this->faker->name,
            'document' => $this->faker->cnpj(false),
            'email'    => $this->faker->email
        ];
        $paymentDetails = [
            'customer'             => $customerData,
            "billingType"          => "CREDIT_CARD",
            "installmentCount"     => 2,
            "creditCard"           => [
                "holderName"  => "Marcelo H Almeida",
                "number"      => "5464171120127912",
                "expiryMonth" => "02",
                "expiryYear"  => "2026",
                "ccv"         => "429"
            ],
            "creditCardHolderInfo" => [
                "name"              => "Marcelo Henrique Almeida",
                "email"             => "marcelo.almeida@gmail.com",
                "cpfCnpj"           => "INVALID_CPF_CNPJ",
                "postalCode"        => "89223-005",
                "addressNumber"     => "277",
                "addressComplement" => null,
                "phone"             => "71998781877",
            ],
            "value"                => 100.00,
            "totalValue"           => 100.00,
            "dueDate"              => Carbon::now()->addDays(15)->format('Y-m-d'),
        ];
        $this->expectException(ValidationException::class);
        $service->createPayment($paymentDetails);
    }
    
}
