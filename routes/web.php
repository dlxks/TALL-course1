<?php

use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

// Create route
Route::get('subscribers/verify/{subscriber}', [SubscriberController::class, 'verify'])
    ->middleware('signed')
    ->name('subscribers.verify');

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
