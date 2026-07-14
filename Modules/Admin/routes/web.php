<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\CategoryController;
use Modules\Admin\Http\Controllers\MenuController;
use Modules\Admin\Http\Controllers\OrderController;
use Modules\Admin\Http\Controllers\ReservationController;
use Modules\Admin\Http\Controllers\EventController;
use Modules\Admin\Http\Controllers\BannerController;
use Modules\Admin\Http\Controllers\AboutController;
use Modules\Admin\Http\Controllers\TestimonialController;
use Modules\Admin\Http\Controllers\SettingsController;
use Modules\Admin\Http\Controllers\FaqController;
use Modules\Admin\Http\Controllers\GalleryCategoryController;
use Modules\Admin\Http\Controllers\GalleryController;
use Modules\Admin\Http\Controllers\SocialLinkController;
use Modules\Admin\Http\Controllers\SectionContentController;
use Modules\Admin\Http\Controllers\ChangePasswordController;
use Modules\Admin\Http\Controllers\ActivityLogController;
use Modules\Admin\Http\Middleware\AdminMiddleware;

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
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

    // Tentang Kami (singleton — langsung edit, hanya teks)
    Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about', [AboutController::class, 'update'])->name('about.update');

    // Pilih Foto untuk AboutUs (halaman terpisah, bukan modal)
    Route::get('/about/pilih-foto/{slot}', [AboutController::class, 'pilihFoto'])->name('about.pilih-foto');
    Route::get('/about/simpan-foto/{slot}/{photo}', [AboutController::class, 'simpanFoto'])->name('about.simpan-foto');

    // Kategori Galeri CRUD
    Route::resource('gallery-categories', GalleryCategoryController::class)->except(['show']);

    // Galeri Foto CRUD (kelola foto gallery di menu terpisah)
    Route::resource('gallery', GalleryController::class)->except(['show']);

    // Testimonial CRUD
    Route::resource('testimonials', TestimonialController::class)->except(['show']);

    // Pengaturan — Lokasi & Jam Buka (singleton)
    Route::get('/settings/location', [SettingsController::class, 'edit'])->name('settings.location.edit');
    Route::put('/settings/location', [SettingsController::class, 'update'])->name('settings.location.update');

    // Pengaturan — Branding (logo & favicon)
    Route::get('/settings/branding', [SettingsController::class, 'branding'])->name('settings.branding');
    Route::post('/settings/branding', [SettingsController::class, 'updateBranding'])->name('settings.branding.update');

    // Pengaturan — Footer (deskripsi & copyright)
    Route::get('/settings/footer', [SettingsController::class, 'editFooter'])->name('settings.footer.edit');
    Route::put('/settings/footer', [SettingsController::class, 'updateFooter'])->name('settings.footer.update');

    // FAQ CRUD
    Route::resource('faqs', FaqController::class)->except(['show']);

    // Section Content (edit all sections in one page)
    Route::get('/section-content', [SectionContentController::class, 'edit'])->name('section-content.edit');
    Route::post('/section-content', [SectionContentController::class, 'update'])->name('section-content.update');

    // Social Media Links CRUD
    Route::resource('social-links', SocialLinkController::class)->except(['show']);

    // Change Password
    Route::get('/change-password', [ChangePasswordController::class, 'edit'])->name('change-password.edit');
    Route::put('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

    // Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('/activity-logs/{activity}', [ActivityLogController::class, 'show'])->name('activity-logs.show');
});
