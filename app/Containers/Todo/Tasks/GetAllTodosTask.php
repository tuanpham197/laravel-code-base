<?php

declare(strict_types=1);

namespace App\Containers\Todo\Tasks;

use App\Containers\Todo\Models\Todo;
use App\Containers\Todo\Enums\TodoStatusEnum;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Collection;

/**
 * Get All Todos Task
 *
 * Handles retrieving todos with optional filtering
 */
class GetAllTodosTask extends Task
{
    private ?TodoStatusEnum $status = null;

    /**
     * Set filter for status
     */
    public function filterByStatus(TodoStatusEnum $status): self
    {
        $this->status = $status;

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

        if ($this->status !== null) {
            $query->where('status', $this->status->value);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }
}
