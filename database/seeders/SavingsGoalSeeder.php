<?php

namespace Database\Seeders;

use App\Containers\Finance\Models\SavingsGoal;
use App\Models\User;
use App\Containers\Family\Models\UserFamilyRole;
use Illuminate\Database\Seeder;

class SavingsGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = UserFamilyRole::all();
        $commonGoals = [
            [
                'name' => 'Emergency Fund',
                'target_amount' => 10000,
                'description' => '3-6 months of living expenses',
            ],
            [
                'name' => 'New Car',
                'target_amount' => 25000,
                'description' => 'Save for a new car purchase',
            ],
            [
                'name' => 'Vacation',
                'target_amount' => 5000,
                'description' => 'Annual vacation fund',
            ],
        ];

        foreach ($userRoles as $userRole) {
            // Create common goals for each user's family
            foreach ($commonGoals as $goal) {
                SavingsGoal::factory()->create([
                    'user_id' => $userRole->user_id,
                    'family_group_id' => $userRole->family_group_id,
                    'name' => $goal['name'],
                    'target_amount' => $goal['target_amount'],
                    'description' => $goal['description'],
                    'current_amount' => rand(0, $goal['target_amount']),
                    'target_date' => now()->addMonths(rand(6, 24)),
                ]);
            }

            // Create additional random goals
            SavingsGoal::factory(2)->create([
                'user_id' => $userRole->user_id,
                'family_group_id' => $userRole->family_group_id,
            ]);
        }
    }
} 