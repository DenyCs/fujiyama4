<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\CategoryController;
use Modules\Admin\Http\Controllers\MenuController;
use Modules\Admin\Http\Controllers\OrderController;
use Modules\Admin\Http\Controllers\ReservationController;
use Modules\Admin\Http\Controllers\EventController;
use Modules\Admin\Http\Controllers\BannerController;
use Modules\Admin\Http\Middleware\AdminMiddleware;

Route::middleware(['web', 'auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Kategori CRUD
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Menu CRUD
    Route::resource('menus', MenuController::class)->except(['show']);

    // Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Event CRUD
    Route::resource('events', EventController::class)->except(['show']);

    // Banner CRUD
    Route::resource('banners', BannerController::class)->except(['show']);

    // Reservasi
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
});
