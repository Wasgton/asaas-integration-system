<?php

namespace Database\Factories;

use Faker\Provider\pt_BR\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker = $this->withFaker();
        $this->faker->addProvider(new Person($this->faker));
        return [
            'user_id' => auth()->user()->id,
            'asaas_id' => $this->faker->regexify('cus_\d{12}'),
            'name' => $this->faker->name(),
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->email,
        ];
    }
}
