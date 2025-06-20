<?php

declare(strict_types=1);

namespace App\Ship\Providers;

use App\Ship\Contracts\UserProfile;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserProfile::class, function ($app) {
            return $app->make(User::class);
        });
    }
} 