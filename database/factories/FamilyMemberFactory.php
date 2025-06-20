<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyMember>
 */
class FamilyMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'relationship' => $this->faker->randomElement(['Father', 'Mother', 'Child']),
            'date_of_birth' => $this->faker->date(),
            'family_group_id' => FamilyGroup::factory(),
            'user_id' => User::factory(),
        ];
    }
}
