<?php

use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'dashboard')
  ->middleware(['auth', 'verified'])
  ->name('dashboard');


// Subscribers (dynamic via controller)
Route::get('/subscribers', [SubscriberController::class, 'all'])
  ->middleware(['auth', 'verified'])
  ->name('subscribers.all');
