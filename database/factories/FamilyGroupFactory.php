<?php

namespace Database\Factories;

use App\Containers\Family\Models\FamilyGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Containers\Family\Models\FamilyGroup>
 */
class FamilyGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FamilyGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_name' => $this->faker->lastName() . ' Family',
            'created_date' => now(),
        ];
    }
}
