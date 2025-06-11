<?php

declare(strict_types=1);

namespace App\Containers\Todo\Tasks;

use App\Containers\Todo\Models\Todo;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Create Todo Task
 *
 * Handles the atomic operation of creating a new todo
 */
class CreateTodoTask extends Task
{
    /**
     * Create a new todo
     *
     * @param  array<string, mixed>  $data
     *
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Todo
    {
        try {
            return Todo::create([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'is_completed' => false,
            ]);
        } catch (Exception $e) {
            throw new CreateResourceFailedException('Failed to create todo: '.$e->getMessage());
        }
    }
}
