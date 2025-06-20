<?php

declare(strict_types=1);

namespace App\Containers\Todo\Models;

use App\Containers\Todo\Data\Factories\TodoFactory;
use App\Containers\Todo\Enums\TodoStatusEnum;
use App\Ship\Parents\Models\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Todo Model
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property TodoStatusEnum $status
 * @property Carbon|null $completed_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Todo extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model
     */
    protected static function newFactory(): Factory
    {
        return TodoFactory::new();
    }

    protected $fillable = [
        'title',
        'description',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'status' => TodoStatusEnum::class,
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Mark the todo as completed
     */
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => TodoStatusEnum::COMPLETED,
            'completed_at' => Carbon::now(new \DateTimeZone('Asia/Tokyo')),
        ]);
    }

    /**
     * Mark the todo as incomplete
     */
    public function markAsIncomplete(): void
    {
        $this->update([
            'status' => TodoStatusEnum::PENDING,
            'completed_at' => null,
        ]);
    }

    /**
     * Mark the todo as cancelled
     */
    public function markAsCancelled(): void
    {
        $this->update([
            'status' => TodoStatusEnum::CANCELLED,
            'completed_at' => null,
        ]);
    }

    /**
     * Scope to get only completed todos
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', TodoStatusEnum::COMPLETED->value);
    }

    /**
     * Scope to get only incomplete todos
     */
    public function scopeIncomplete($query)
    {
        return $query->where('status', TodoStatusEnum::PENDING->value);
    }

    /**
     * Scope to get only cancelled todos
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', TodoStatusEnum::CANCELLED->value);
    }
}
