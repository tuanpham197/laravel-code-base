<?php

namespace Database\Factories;

use App\Containers\Finance\Models\Asset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->words(3, true),
            'type' => $this->faker->randomElement(['real_estate', 'vehicle', 'investment', 'retirement', 'crypto', 'other']),
            'value' => $this->faker->randomFloat(2, 1000, 1000000),
            'description' => $this->faker->sentence(),
            'purchase_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'purchase_price' => $this->faker->randomFloat(2, 1000, 1000000),
            'location' => $this->faker->optional()->address(),
            'status' => $this->faker->randomElement(['active', 'sold', 'depreciated']),
            'appreciation_rate' => $this->faker->optional()->randomFloat(2, -5, 15),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}
