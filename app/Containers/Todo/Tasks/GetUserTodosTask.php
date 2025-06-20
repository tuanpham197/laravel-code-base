<?php

declare(strict_types=1);

namespace App\Containers\Todo\Tasks;

use App\Ship\Contracts\UserProfile;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Todo\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

class GetUserTodosTask extends Task
{
    public function run(UserProfile $user): Collection
    {
        // Sử dụng getId() để lấy todos của user
        return Todo::query()
            ->where('user_id', $user->getId())
            ->get();
    }

    public function runWithEmail(string $email): Collection
    {
        // Sử dụng getEmail() để tìm todos của user qua email
        return Todo::query()
            ->whereHas('user', function ($query) use ($email) {
                $query->where('email', $email);
            })
            ->get();
    }
} 