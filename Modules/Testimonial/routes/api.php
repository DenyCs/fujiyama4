<?php

use Illuminate\Support\Facades\Route;
use Modules\Testimonial\Http\Controllers\TestimonialController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('testimonials', TestimonialController::class)->names('testimonial');
});
