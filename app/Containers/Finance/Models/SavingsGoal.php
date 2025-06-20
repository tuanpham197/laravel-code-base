<?php

declare(strict_types=1);

namespace App\Containers\Finance\Models;

use App\Containers\Family\Models\FamilyGroup;
use App\Models\User;
use App\Ship\Parents\Models\Model;
use Database\Factories\SavingsGoalFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingsGoal extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return SavingsGoalFactory::new();
    }

    protected $fillable = [
        'family_group_id',
        'account_id',
        'name',
        'target_amount',
        'current_amount',
        'target_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'target_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function familyGroup(): BelongsTo
    {
        return $this->belongsTo(FamilyGroup::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
} 