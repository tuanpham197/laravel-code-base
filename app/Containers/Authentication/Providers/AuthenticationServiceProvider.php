<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Providers;

use App\Ship\Parents\Providers\MainServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthenticationServiceProvider extends MainServiceProvider
{
    /**
     * Register any application services
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services
     */
    public function boot(): void
    {
        parent::boot();

        $this->loadWebRoutes();

        Route::prefix('/')
            ->middleware('web')
            ->group(function () {
                $this->loadRoutesFromDirectory(app_path('Containers/Authentication/UI/*/Routes'));
            });
    }

    /**
     * Load routes from directory
     */
    private function loadRoutesFromDirectory(string $directory): void
    {
        $files = glob($directory . '/*.php');
        
        foreach ($files as $file) {
            require $file;
        }
    }

    private function loadWebRoutes(): void
    {
        $this->loadRoutesFrom(base_path('app/Containers/Authentication/UI/WEB/Routes/auth.php'));
    }
} 