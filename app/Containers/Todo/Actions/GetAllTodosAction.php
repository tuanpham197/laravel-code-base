<?php

declare(strict_types=1);

namespace App\Containers\Todo\Actions;

use App\Containers\Todo\Tasks\GetAllTodosTask;
use App\Containers\Todo\Enums\TodoStatusEnum;
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
     * @param  TodoStatusEnum|null  $status  Filter by status
     */
    public function run(?TodoStatusEnum $status = null): Collection
    {
        $task = $this->getAllTodosTask;

        if ($status !== null) {
            $task->filterByStatus($status);
        }

        return $task->run();
    }
}
