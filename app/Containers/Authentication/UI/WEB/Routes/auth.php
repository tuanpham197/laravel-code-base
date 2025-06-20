<?php

declare(strict_types=1);

use App\Containers\Authentication\UI\WEB\Controllers\AuthController;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Authentication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web authentication routes for your application.
| These routes are loaded by the AuthenticationServiceProvider.
|
*/

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'create'])
        ->name('register');

    Route::post('register', [AuthController::class, 'register'])
        ->name('postregister');

    Route::get('login', [AuthController::class, 'loginForm'])
        ->name('login');

    Route::post('login', [AuthController::class, 'login'])
        ->name('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
});