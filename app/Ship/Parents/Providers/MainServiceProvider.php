<?php

declare(strict_types=1);

namespace App\Ship\Parents\Providers;

use App\Containers\Todo\Providers\TodoServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Main Service Provider
 *
 * Registers all container service providers
 */
class MainServiceProvider extends ServiceProvider
{
    /**
     * Container service providers to register
     *
     * @var array<class-string<ServiceProvider>>
     */
    protected array $serviceProviders = [
        TodoServiceProvider::class,
    ];

    /**
     * Register any application services
     */
    public function register(): void
    {
        foreach ($this->serviceProviders as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Bootstrap any application services
     */
    public function boot(): void
    {
        //
    }
}
