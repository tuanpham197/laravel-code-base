<?php

namespace Database\Seeders;

use App\Containers\Finance\Models\Category;
use App\Containers\Family\Models\FamilyGroup;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Housing', 'type' => 'expense', 'description' => 'Rent, mortgage, utilities, etc.'],
            ['name' => 'Transportation', 'type' => 'expense', 'description' => 'Car payments, gas, public transit'],
            ['name' => 'Food', 'type' => 'expense', 'description' => 'Groceries and dining out'],
            ['name' => 'Healthcare', 'type' => 'expense', 'description' => 'Medical expenses and insurance'],
            ['name' => 'Entertainment', 'type' => 'expense', 'description' => 'Movies, games, hobbies'],
            ['name' => 'Salary', 'type' => 'income', 'description' => 'Regular employment income'],
            ['name' => 'Investments', 'type' => 'income', 'description' => 'Stock dividends, interest'],
            ['name' => 'Freelance', 'type' => 'income', 'description' => 'Contract work and side gigs'],
            ['name' => 'Gifts', 'type' => 'income', 'description' => 'Received gifts and bonuses'],
            ['name' => 'Other', 'type' => 'other', 'description' => 'Miscellaneous transactions'],
        ];

        // Create categories for each family group
        FamilyGroup::all()->each(function ($familyGroup) use ($categories) {
            // Create predefined categories
            foreach ($categories as $category) {
                Category::factory()->create(array_merge($category, [
                    'family_group_id' => $familyGroup->id,
                ]));
            }

            // Create additional random categories
            Category::factory(5)->create([
                'family_group_id' => $familyGroup->id,
            ]);
        });
    }
} 