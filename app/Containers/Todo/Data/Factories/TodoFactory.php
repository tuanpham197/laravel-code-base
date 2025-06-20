<?php

declare(strict_types=1);

namespace App\Containers\Todo\Data\Factories;

use App\Containers\Todo\Models\Todo;
use App\Containers\Todo\Enums\TodoStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Todo Factory
 *
 * @extends Factory<Todo>
 */
class TodoFactory extends Factory
{
    protected $model = Todo::class;

    /**
     * Define the model's default state
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'status' => TodoStatusEnum::PENDING,
            'completed_at' => null,
        ];
    }

    /**
     * State for completed todos
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TodoStatusEnum::COMPLETED,
            'completed_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * State for incomplete todos
     */
    public function incomplete(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TodoStatusEnum::PENDING,
            'completed_at' => null,
        ]);
    }

    /**
     * State for cancelled todos
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TodoStatusEnum::CANCELLED,
            'completed_at' => null,
        ]);
    }
}
