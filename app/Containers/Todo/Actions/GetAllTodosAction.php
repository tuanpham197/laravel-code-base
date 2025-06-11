<?php

declare(strict_types=1);

namespace App\Containers\Todo\Actions;

use App\Containers\Todo\Tasks\GetAllTodosTask;
use App\Ship\Parents\Actions\Action;
use Illuminate\Database\Eloquent\Collection;

/**
 * Get All Todos Action
 *
 * Orchestrates retrieving all todos with optional filtering
 */
class GetAllTodosAction extends Action
{
    public function __construct(
        private readonly GetAllTodosTask $getAllTodosTask
    ) {}

    /**
     * Get all todos with optional filtering
     *
     * @param  bool|null  $completed  Filter by completion status
     */
    public function run(?bool $completed = null): Collection
    {
        $task = $this->getAllTodosTask;

        if ($completed !== null) {
            $task->filterByCompleted($completed);
        }

        return $task->run();
    }
}
