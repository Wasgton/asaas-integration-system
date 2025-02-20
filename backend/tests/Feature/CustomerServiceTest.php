<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    use WithFaker;

    protected function setUpFaker(): void
    {
        $this->faker = $this->makeFaker('pt_BR');
    }
    /**
     * A basic feature test example.
     */
    public function test_should_create_customer(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /**@var CustomerService $service*/
        $service = app(CustomerService::class);
        $data = [
            'name' => $this->faker->name,
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->email
        ];
        $service->createCustomer($data);
        $this->assertDatabaseHas(Customer::class, $data);
    }
}
