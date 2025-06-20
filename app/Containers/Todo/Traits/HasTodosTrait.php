<?php

declare(strict_types=1);

namespace App\Containers\Todo\Traits;

use App\Containers\Todo\Models\Todo;
use App\Containers\Todo\Enums\TodoStatusEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTodosTrait
{
    /**
     * Get all todos for the user.
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    /**
     * Get completed todos for the user.
     */
    public function completedTodos(): Collection
    {
        return $this->todos()
            ->where('status', TodoStatusEnum::COMPLETED)
            ->get();
    }

    /**
     * Get pending todos for the user.
     */
    public function pendingTodos(): Collection
    {
        return $this->todos()
            ->where('status', TodoStatusEnum::PENDING)
            ->get();
    }

    /**
     * Get cancelled todos for the user.
     */
    public function cancelledTodos(): Collection
    {
        return $this->todos()
            ->where('status', TodoStatusEnum::CANCELLED)
            ->get();
    }

    /**
     * Get the count of completed todos.
     */
    public function getCompletedTodosCount(): int
    {
        return $this->todos()
            ->where('status', TodoStatusEnum::COMPLETED)
            ->count();
    }

    /**
     * Get the completion rate of todos.
     */
    public function getTodosCompletionRate(): float
    {
        $totalTodos = $this->todos()
            ->whereIn('status', [TodoStatusEnum::COMPLETED->value, TodoStatusEnum::PENDING->value])
            ->count();

        if ($totalTodos === 0) {
            return 0.0;
        }

        $completedTodos = $this->getCompletedTodosCount();
        return round(($completedTodos / $totalTodos) * 100, 2);
    }

    /**
     * Create a new todo for the user.
     */
    public function createTodo(string $title, ?string $description = null): Todo
    {
        return $this->todos()->create([
            'title' => $title,
            'description' => $description,
            'status' => TodoStatusEnum::PENDING,
        ]);
    }
} 