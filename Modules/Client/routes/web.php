<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Http\Controllers\ClientController;

// Public landing page (no auth required)
Route::get('/', [ClientController::class, 'home'])->name('client.home');
Route::get('/menu', [ClientController::class, 'menu'])->name('client.menu');
Route::get('/events', [ClientController::class, 'events'])->name('client.events');
