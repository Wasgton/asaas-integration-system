<?php

namespace Tests\Feature;

use App\DTO\CreateCustomerDto;
use App\Models\Customer;
use App\Models\User;
use App\Repositories\CustomerRepositoryEloquent;
use App\Services\CustomerService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

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
        $create = [
            'name' => $this->faker->name,
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->email
        ];
        $service->createCustomer($create);
        $this->assertDatabaseHas(Customer::class, $create);
    }

    /**
     * @throws \HttpException
     * @throws GuzzleException
     */
    public function test_should_ensure_customer_exists(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /**@var CustomerService $service*/
        $service = app(CustomerService::class);
        $create = [
            'name' => $this->faker->name,
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->email
        ];
        $service->ensureCustomerExists($create);
        $this->assertDatabaseHas(Customer::class, $create);
    }

    /**
     * @throws \HttpException
     * @throws GuzzleException
     */
    public function test_ensure_customer_should_get_from_db(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /**@var CustomerService $service*/
        $service = app(CustomerService::class);
        $create = [
            'name' => $this->faker->name,
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->email,
            'asaas_id' => 'cus_000000000000',
            'user_id' => $user->id,
        ];
        $repository = new CustomerRepositoryEloquent();
        $repository->create($create);
        $customer = $service->ensureCustomerExists($create);
        $this->assertEquals($customer->asaas_id, $create['asaas_id']);
        $this->assertEquals($customer->name, $create['name']);
        $this->assertEquals($customer->document, $create['document']);
        $this->assertEquals($customer->email, $create['email']);
        $this->assertEquals($customer->user_id, $create['user_id']);
    }

    /**
     * @throws \HttpException
     * @throws GuzzleException
     */
    public function test_should_get_customer_from_api_when_exists(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        /**@var CustomerService $service*/
        $service = app(CustomerService::class);
        $create = [
            'name' => $this->faker->name,
            'document' => $this->faker->cpf(false),
            'email' => auth()->user()->email,
        ];
        $client = new Client([
            'base_uri' => config('asaas.base_url'),
            'allow_redirects' => false,
            'headers' => [
                'access_token' => config('asaas.api_key'),
                'accept' => 'application/json',
                'content-type'=>'application/json',
            ],
        ]);
        $client->request('POST', 'customers', ['json' => $create]);
        $this->assertDatabaseMissing('customers', $create);
        $service->ensureCustomerExists($create);
        $this->assertDatabaseHas('customers', $create);
    }
    
//    public function test_should_get_client_from_api()
//    {
//        $client = new \GuzzleHttp\Client();
//        $response = $client->request('GET', 'https://api-sandbox.asaas.com/v3/customers?cpfCnpj=75813927590', [
//            'headers' => [
//                'accept' => 'application/json',
//                'access_token' => '$aact_MzkwODA2MWY2OGM3MWRlMDU2NWM3MzJlNzZmNGZhZGY6OmNjODhlZjE1LTA2OGQtNDlhZi1hZmRhLTg0ZDhmOTI3NDdmZDo6JGFhY2hfNDFlYTgwM2YtNjNlNi00MGY4LWE2ODctODg3M2UxYzY0Mzdj',
//            ],
//        ]);
//        $arrayResponse = json_decode((string)$response->getBody(), true);
//        dd($arrayResponse);
//    }
    
}
