<?php

declare(strict_types=1);

namespace App\Containers\Todo\Actions;

use App\Ship\Contracts\UserProfile;
use App\Ship\Parents\Actions\Action;
use App\Containers\Todo\Tasks\GetUserTodosTask;
use Illuminate\Database\Eloquent\Collection;

class GetUserTodosAction extends Action
{
    public function __construct(
        private readonly GetUserTodosTask $getUserTodosTask,
        private readonly UserProfile $user,
    ) {}

    public function run(): array
    {
        $todos = $this->getUserTodosTask->run($this->user);
        
        return [
            'user_name' => $this->user->getName(),
            'user_email' => $this->user->getEmail(),
            'todos' => $todos->map(fn ($todo) => [
                'id' => $todo->id,
                'title' => $todo->title,
                'status' => $todo->status,
            ])->toArray(),
        ];
    }
} 