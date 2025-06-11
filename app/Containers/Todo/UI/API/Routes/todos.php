<?php

declare(strict_types=1);

use App\Containers\Todo\UI\API\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Todo API Routes
|--------------------------------------------------------------------------
|
| Here are the API routes for the Todo container
|
*/

Route::prefix('api/v1')->group(function (): void {
    Route::prefix('todos')->group(function (): void {
        Route::get('/', [TodoController::class, 'index'])->name('todos.index');
        Route::post('/', [TodoController::class, 'store'])->name('todos.store');
        Route::patch('/{id}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
    });
});
