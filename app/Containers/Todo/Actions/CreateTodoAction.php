<?php

declare(strict_types=1);

namespace App\Containers\Todo\Actions;

use App\Containers\Todo\Models\Todo;
use App\Containers\Todo\Tasks\CreateTodoTask;
use App\Ship\Parents\Actions\Action;
use App\Traits\PropertyFillable as TraitsPropertyFillable;

/**
 * Create Todo Action
 *
 * Orchestrates the creation of a new todo
 */
class CreateTodoAction extends Action
{
    use TraitsPropertyFillable;

    private array $todo;

    public function __construct(
        private readonly CreateTodoTask $createTodoTask
    ) {}

    /**
     * Create a new todo
     *
     * @param  mixed  $data
     * @return Todo
     */
    public function run(): Todo
    {
        return $this->createTodoTask->run($this->todo);
    }
}
