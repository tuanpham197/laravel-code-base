<?php

namespace Database\Seeders;

use App\Containers\Finance\Models\Account;
use App\Containers\Finance\Models\Category;
use App\Containers\Finance\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all accounts and categories
        $accounts = Account::all();
        $expenseCategories = Category::where('type', 'expense')->get();
        $incomeCategories = Category::where('type', 'income')->get();

        foreach ($accounts as $account) {
            // Create expense transactions
            for ($i = 0; $i < 5; $i++) {
                Transaction::factory()->create([
                    'account_id' => $account->id,
                    'category_id' => $expenseCategories->random()->id,
                    'type' => 'expense',
                    'amount' => rand(10, 1000),
                    'date' => now()->subDays(rand(1, 30)),
                ]);
            }

            // Create income transactions
            for ($i = 0; $i < 5; $i++) {
                Transaction::factory()->create([
                    'account_id' => $account->id,
                    'category_id' => $incomeCategories->random()->id,
                    'type' => 'income',
                    'amount' => rand(1000, 5000),
                    'date' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
} 