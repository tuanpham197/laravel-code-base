<?php

declare(strict_types=1);

namespace App\Ship\Providers;

use App\Models\User;
use App\Ship\Contracts\UserProfile;
use App\Ship\Parents\Providers\MainServiceProvider;

class ShipServiceProvider extends MainServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserProfile::class, User::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
} 