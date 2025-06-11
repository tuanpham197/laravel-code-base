<?php

declare(strict_types=1);

namespace App\Containers\Todo\Tasks;

use App\Containers\Todo\Models\Todo;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;

/**
 * Toggle Todo Status Task
 *
 * Handles toggling the completion status of a todo
 */
class ToggleTodoStatusTask extends Task
{
    /**
     * Toggle the completion status of a todo
     *
     * @throws NotFoundException
     */
    public function run(int $todoId): Todo
    {
        $todo = Todo::find($todoId);

        if (! $todo) {
            throw new NotFoundException('Todo not found');
        }

        if ($todo->is_completed) {
            $todo->markAsIncomplete();
        } else {
            $todo->markAsCompleted();
        }

        return $todo->fresh();
    }
}
