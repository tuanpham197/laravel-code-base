<?php

namespace Database\Seeders;

use App\Containers\Finance\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        foreach ($users as $user) {
            // Create a checking account for each user
            Account::factory()->create([
                'user_id' => $user->id,
                'name' => 'Checking Account',
                'type' => 'checking',
                'balance' => rand(1000, 10000),
            ]);

            // Create a savings account for each user
            Account::factory()->create([
                'user_id' => $user->id,
                'name' => 'Savings Account',
                'type' => 'savings',
                'balance' => rand(5000, 50000),
            ]);

            // Create additional random accounts
            Account::factory(3)->create([
                'user_id' => $user->id,
            ]);
        }
    }
} 