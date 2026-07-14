<?php

use Illuminate\Support\Facades\Route;
use Modules\SectionContent\Http\Controllers\SectionContentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sectioncontents', SectionContentController::class)->names('sectioncontent');
});
