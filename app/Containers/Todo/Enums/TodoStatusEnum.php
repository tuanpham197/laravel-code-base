<?php

declare(strict_types=1);

namespace App\Containers\Todo\Enums;

/**
 * Todo Status Enum
 *
 * Represents the possible states of a todo item
 */
enum TodoStatusEnum: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    /**
     * Get all available statuses
     *
     * @return array<string>
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get status label for display
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }

    /**
     * Check if status is completed
     */
    public function isCompleted(): bool
    {
        return $this === self::COMPLETED;
    }

    /**
     * Check if status is pending
     */
    public function isPending(): bool
    {
        return $this === self::PENDING;
    }
}
