<?php

namespace Database\Factories;

use App\Containers\Finance\Models\Category;
use App\Containers\Finance\Models\RecurringExpense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecurringExpense>
 */
class RecurringExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecurringExpense::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'name' => $this->faker->words(3, true),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'frequency' => $this->faker->randomElement(['daily', 'weekly', 'monthly', 'yearly']),
            'description' => $this->faker->sentence(),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'next_due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->optional()->dateTimeBetween('+1 month', '+1 year'),
            'status' => $this->faker->randomElement(['active', 'paused', 'completed']),
            'auto_pay' => $this->faker->boolean(),
            'reminder_days' => $this->faker->optional()->numberBetween(1, 7),
        ];
    }
}
