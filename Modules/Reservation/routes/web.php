<?php

use Illuminate\Support\Facades\Route;
use Modules\Reservation\Http\Controllers\ReservationController;

Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservation.store');