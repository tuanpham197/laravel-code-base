<?php

namespace Database\Factories;

use App\Containers\Finance\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->words(2, true) . ' Account',
            'type' => $this->faker->randomElement(['checking', 'savings', 'credit', 'investment']),
            'balance' => $this->faker->randomFloat(2, 0, 100000),
            'currency' => 'USD',
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
