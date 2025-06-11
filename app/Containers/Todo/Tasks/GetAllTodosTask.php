<?php

declare(strict_types=1);

namespace App\Containers\Todo\Tasks;

use App\Containers\Todo\Models\Todo;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Collection;

/**
 * Get All Todos Task
 *
 * Handles retrieving todos with optional filtering
 */
class GetAllTodosTask extends Task
{
    private ?bool $completed = null;

    /**
     * Set filter for completed status
     */
    public function filterByCompleted(bool $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get all todos with applied filters
     *
     * @return Collection<int, Todo>
     */
    public function run(): Collection
    {
        $query = Todo::query();

        if ($this->completed !== null) {
            $query = $this->completed
                ? $query->completed()
                : $query->incomplete();
        }

        return $query->orderBy('created_at', 'desc')->get();
    }
}
