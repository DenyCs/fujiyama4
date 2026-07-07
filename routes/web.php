<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route '/' is handled by Modules/Client/routes/web.php
// Route '/admin/*' is handled by Modules/Admin/routes/web.php

// Dashboard Breeze tidak dipakai — redirect ke home
// Route::get('/dashboard', function () {
//     return redirect('/');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Profile pages tidak dipakai di sisi client
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
