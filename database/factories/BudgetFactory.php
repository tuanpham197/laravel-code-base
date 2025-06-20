<?php

namespace Database\Factories;

use App\Containers\Finance\Models\Budget;
use App\Containers\Finance\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'name' => $this->faker->words(3, true),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'period' => $this->faker->randomElement(['daily', 'weekly', 'monthly', 'yearly']),
            'start_date' => $startDate,
            'end_date' => $this->faker->dateTimeBetween($startDate, '+1 year'),
            'description' => $this->faker->sentence(),
            'is_active' => true,
            'notification_threshold' => $this->faker->optional()->numberBetween(70, 90),
        ];
    }
}
