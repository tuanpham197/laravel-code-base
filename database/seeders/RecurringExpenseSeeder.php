<?php

namespace Database\Seeders;

use App\Containers\Finance\Models\Category;
use App\Containers\Finance\Models\RecurringExpense;
use App\Models\User;
use App\Containers\Family\Models\UserFamilyRole;
use Illuminate\Database\Seeder;

class RecurringExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = UserFamilyRole::all();
        
        $commonExpenses = [
            [
                'name' => 'Rent/Mortgage',
                'amount' => 2000,
                'frequency' => 'monthly',
            ],
            [
                'name' => 'Internet',
                'amount' => 80,
                'frequency' => 'monthly',
            ],
            [
                'name' => 'Phone Bill',
                'amount' => 60,
                'frequency' => 'monthly',
            ],
            [
                'name' => 'Gym Membership',
                'amount' => 50,
                'frequency' => 'monthly',
            ],
            [
                'name' => 'Streaming Services',
                'amount' => 30,
                'frequency' => 'monthly',
            ],
        ];

        foreach ($userRoles as $userRole) {
            // Get expense categories for this family
            $expenseCategories = Category::where('type', 'expense')
                ->where('family_group_id', $userRole->family_group_id)
                ->get();

            // Create common recurring expenses for each user's family
            foreach ($commonExpenses as $expense) {
                RecurringExpense::factory()->create([
                    'user_id' => $userRole->user_id,
                    'family_group_id' => $userRole->family_group_id,
                    'category_id' => $expenseCategories->random()->id,
                    'name' => $expense['name'],
                    'amount' => $expense['amount'],
                    'frequency' => $expense['frequency'],
                    'next_due_date' => now()->addMonth(),
                ]);
            }

            // Create additional random recurring expenses
            RecurringExpense::factory(5)->create([
                'user_id' => $userRole->user_id,
                'family_group_id' => $userRole->family_group_id,
                'category_id' => $expenseCategories->random()->id,
            ]);
        }
    }
} 