<?php

declare(strict_types=1);

use App\Containers\Family\UI\API\Controllers\FamilyGroupController;
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
    Route::prefix('family-groups')->group(function (): void {
        Route::get('/', [FamilyGroupController::class, 'index'])->name('family-groups.index');
        Route::post('/', [FamilyGroupController::class, 'store'])->name('family-groups.store');
    });
});
