<?php
declare(strict_types=1);

namespace App\Containers\Finance\Models;

use App\Models\User;

class FinancialUser extends User
{
    /**
     * Get the financial profile of the user
     *
     * @return array
     */
    public function getFinancialProfile(): array
    {
        // TODO: Implement getFinancialProfile() method.
        return [
            'accounts' => $this->accounts()->get()->map(fn($account) => [
                'id' => $account->id,
                'name' => $account->name,
                'balance' => $account->balance,
            ])->toArray(),
            'total_balance' => $this->accounts()->sum('balance'),
            'total_expenses' => $this->transactions()->where('type', 'expense')->sum('amount'),
            'total_income' => $this->transactions()->where('type', 'income')->sum('amount'),
        ];
    }
}