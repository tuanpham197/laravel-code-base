<?php

namespace Database\Seeders;

use App\Containers\Finance\Models\Budget;
use App\Containers\Finance\Models\Category;
use App\Models\User;
use App\Containers\Family\Models\UserFamilyRole;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = UserFamilyRole::all();

        foreach ($userRoles as $userRole) {
            // Get expense categories for this family
            $expenseCategories = Category::where('type', 'expense')
                ->where('family_group_id', $userRole->family_group_id)
                ->get();

            // Create a budget for each expense category
            foreach ($expenseCategories as $category) {
                Budget::factory()->create([
                    'user_id' => $userRole->user_id,
                    'family_group_id' => $userRole->family_group_id,
                    'category_id' => $category->id,
                    'amount' => rand(500, 2000),
                    'period' => 'monthly',
                    'start_date' => now()->startOfMonth(),
                    'end_date' => now()->endOfMonth(),
                ]);
            }

            // Create some additional random budgets with existing categories
            $categories = Category::where('family_group_id', $userRole->family_group_id)->get();
            for ($i = 0; $i < 3; $i++) {
                Budget::factory()->create([
                    'user_id' => $userRole->user_id,
                    'family_group_id' => $userRole->family_group_id,
                    'category_id' => $categories->random()->id,
                ]);
            }
        }
    }
} 