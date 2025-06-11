<?php

declare(strict_types=1);

namespace App\Containers\Todo\Actions;

use App\Containers\Todo\Models\Todo;
use App\Containers\Todo\Tasks\ToggleTodoStatusTask;
use App\Ship\Parents\Actions\Action;
use App\Traits\PropertyFillable;

/**
 * Toggle Todo Status Action
 *
 * Orchestrates toggling the completion status of a todo
 */
class ToggleTodoStatusAction extends Action
{
    use PropertyFillable;

    private int $todoId;

    public function __construct(
        private readonly ToggleTodoStatusTask $toggleTodoStatusTask
    ) {}

    /**
     * Toggle the completion status of a todo
     */
    public function run(): Todo
    {
        return $this->toggleTodoStatusTask->run($this->todoId);
    }
}
