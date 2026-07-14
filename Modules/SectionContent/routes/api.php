<?php

use Illuminate\Support\Facades\Route;
use Modules\SectionContent\Http\Controllers\SectionContentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sectioncontents', SectionContentController::class)->names('sectioncontent');
});
