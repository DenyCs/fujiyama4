<?php

use Illuminate\Support\Facades\Route;
use Modules\Testimonial\Http\Controllers\TestimonialController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('testimonials', TestimonialController::class)->names('testimonial');
});
