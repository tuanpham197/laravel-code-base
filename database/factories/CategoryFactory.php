<?php

namespace Database\Factories;

use App\Containers\Finance\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'type' => $this->faker->randomElement(['income', 'expense', 'other']),
            'description' => $this->faker->sentence(),
            'icon' => $this->faker->randomElement(['💰', '🏠', '🚗', '🍔', '🏥', '🎮', '✈️', '📱', '🎵', '📚']),
            'color' => $this->faker->hexColor(),
            'is_active' => true,
        ];
    }
}
