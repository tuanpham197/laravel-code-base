<?php

namespace Database\Factories;

use App\Containers\Finance\Models\SavingsGoal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SavingsGoal>
 */
class SavingsGoalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SavingsGoal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $targetAmount = $this->faker->randomFloat(2, 1000, 50000);
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'target_amount' => $targetAmount,
            'current_amount' => $this->faker->randomFloat(2, 0, $targetAmount),
            'target_date' => $this->faker->dateTimeBetween('+6 months', '+2 years'),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'status' => $this->faker->randomElement(['active', 'completed', 'paused']),
            'contribution_frequency' => $this->faker->randomElement(['weekly', 'monthly']),
            'contribution_amount' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
