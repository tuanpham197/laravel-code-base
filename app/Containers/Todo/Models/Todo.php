<?php

declare(strict_types=1);

namespace App\Containers\Todo\Models;

use App\Containers\Todo\Data\Factories\TodoFactory;
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
 * @property bool $is_completed
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
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
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
            'is_completed' => true,
            'completed_at' => Carbon::now(new \DateTimeZone('Asia/Tokyo')),
        ]);
    }

    /**
     * Mark the todo as incomplete
     */
    public function markAsIncomplete(): void
    {
        $this->update([
            'is_completed' => false,
            'completed_at' => null,
        ]);
    }

    /**
     * Scope to get only completed todos
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    /**
     * Scope to get only incomplete todos
     */
    public function scopeIncomplete($query)
    {
        return $query->where('is_completed', false);
    }
}
