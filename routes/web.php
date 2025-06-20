<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Landing'))->name('home');

// Route::middleware('guest')->group(function () {
//     Route::get('register', [AuthController::class, 'create'])->name('register');
//     Route::post('register', [AuthController::class, 'register'])->name('postregister');
//     Route::get('login', [AuthController::class, 'create'])->name('login');
//     Route::post('login', [AuthController::class, 'login'])->name('auth.login');
// });

// Route::middleware('auth')->group(function () {
//     Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
//     Route::get('budget', fn () => Inertia::render('Budget'))->name('budget');
//     Route::get('goals', fn () => Inertia::render('Goals'))->name('goals');
// });

// Route::get('/test', fn () => Inertia::render('Landing'))->name('home');
