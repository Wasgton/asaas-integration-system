<?php

namespace Database\Factories;

use App\Enum\BillingType;
use App\Enum\Status;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'asaas_id' => $this->faker->regexify('pay_\d{12}'),
            'customer_id' => Customer::factory()->create()->id,
            'value' => 200,
            'billing_type' => BillingType::PIX,
            'status' => Status::PENDING,
            'payment_date' => null,
            'bank_slip_url' => null,
            'invoice_number' => '00005101',
            'invoice_url' => $this->faker->url,
            'transaction_receipt_url' => $this->faker->url,
            'deleted' => false,
            'anticipated' => false
        ];
    }
}
