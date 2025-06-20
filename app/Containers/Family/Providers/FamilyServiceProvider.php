<?php

declare(strict_types=1);

namespace App\Containers\Family\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Todo Service Provider
 *
 * Registers Todo container services and routes
 */
class FamilyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services
     */
    public function register(): void
    {
        // Register container-specific services here if needed
    }

    /**
     * Bootstrap any application services
     */
    public function boot(): void
    {
        $this->loadRoutes();
    }

    /**
     * Load container routes
     */
    private function loadRoutes(): void
    {
        $routePath = __DIR__.'/../UI/API/Routes/family_group.php';

        if (file_exists($routePath)) {
            Route::middleware('api')->group($routePath);
        }
    }
}
