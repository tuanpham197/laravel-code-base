<?php

namespace Database\Factories;

use App\Containers\Finance\Models\Account;
use App\Containers\Finance\Models\Category;
use App\Containers\Finance\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory(),
            'category_id' => Category::factory(),
            'type' => $this->faker->randomElement(['income', 'expense']),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'description' => $this->faker->sentence(),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status' => 'completed',
            'notes' => $this->faker->optional()->paragraph(),
            'tags' => json_encode($this->faker->optional()->words(3)),
        ];
    }
}
