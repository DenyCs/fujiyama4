

<?php $__env->startSection('title', 'Branding — Logo & Favicon'); ?>
<?php $__env->startSection('page_title', 'Branding — Logo & Favicon'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title">Logo untuk Dark Mode</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('admin.settings.branding.update')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label">Preview Logo Dark Mode</label>
                        <div class="bg-dark rounded p-3 mb-2 d-flex align-items-center justify-content-center" style="min-height: 120px;">
                            <?php if($setting->logo_dark): ?>
                                <img src="<?php echo e(asset($setting->logo_dark)); ?>" alt="Logo Dark" class="img-fluid" style="max-height: 100px;">
                            <?php else: ?>
                                <span class="text-white-50">Belum ada logo dark</span>
                            <?php endif; ?>
                        </div>
                        <small class="text-muted">Preview dengan background gelap (mensimulasikan dark mode navbar).</small>
                    </div>

                    <div class="mb-3">
                        <label for="logo_dark" class="form-label">Upload Logo untuk Dark Mode</label>
                        <input type="file" class="form-control <?php $__errorArgs = ['logo_dark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="logo_dark" name="logo_dark" accept="image/png,image/jpeg,image/webp,image/svg+xml">
                        <small class="text-muted">Gunakan logo dengan warna terang/putih, PNG transparan, rekomendasi ukuran 200×60px.</small>
                        <?php $__errorArgs = ['logo_dark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr class="my-4">

                    
                    <div class="mb-3">
                        <label class="form-label">Preview Logo Light Mode</label>
                        <div class="bg-light rounded p-3 mb-2 d-flex align-items-center justify-content-center border" style="min-height: 120px;">
                            <?php if($setting->logo_light): ?>
                                <img src="<?php echo e(asset($setting->logo_light)); ?>" alt="Logo Light" class="img-fluid" style="max-height: 100px;">
                            <?php else: ?>
                                <span class="text-muted">Belum ada logo light</span>
                            <?php endif; ?>
                        </div>
                        <small class="text-muted">Preview dengan background terang (mensimulasikan light mode navbar).</small>
                    </div>

                    <div class="mb-3">
                        <label for="logo_light" class="form-label">Upload Logo untuk Light Mode</label>
                        <input type="file" class="form-control <?php $__errorArgs = ['logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="logo_light" name="logo_light" accept="image/png,image/jpeg,image/webp,image/svg+xml">
                        <small class="text-muted">Gunakan logo dengan warna gelap, PNG transparan, rekomendasi ukuran 200×60px.</small>
                        <?php $__errorArgs = ['logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <hr class="my-4">

                    
                    <div class="mb-3">
                        <label for="favicon_image" class="form-label">Upload Favicon Baru</label>
                        <input type="file" class="form-control <?php $__errorArgs = ['favicon_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="favicon_image" name="favicon_image" accept="image/png,image/x-icon,image/svg+xml">
                        <small class="text-muted">Format: PNG, ICO, SVG. Maks: 512 KB. Rekomendasi: 32×32 px atau 64×64 px.</small>
                        <?php $__errorArgs = ['favicon_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Branding
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h5 class="card-title">Preview Favicon</h5>
            </div>
            <div class="card-body text-center">
                <?php if($setting->favicon_image): ?>
                    <img src="<?php echo e(asset($setting->favicon_image)); ?>" alt="Favicon" style="width: 64px; height: 64px;">
                    <p class="mt-2 text-muted">64×64 px</p>
                <?php else: ?>
                    <div class="bg-warning rounded d-inline-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <span class="text-dark fw-bold">🍜</span>
                    </div>
                    <p class="mt-2 text-muted">Belum ada favicon</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card card-secondary card-outline mt-3">
            <div class="card-header">
                <h5 class="card-title">Informasi</h5>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li><strong>Logo Dark Mode</strong>: ditampilkan saat pengguna mengaktifkan dark mode (latar gelap). Gunakan logo versi putih/terang agar kontras.</li>
                    <li><strong>Logo Light Mode</strong>: ditampilkan saat pengguna menggunakan light mode (latar terang). Gunakan logo versi gelap/berwarna.</li>
                    <li>Kedua logo sebaiknya berupa <strong>PNG transparan</strong> dengan rasio lebar-tinggi proporsional (rekomendasi ~200×60px).</li>
                    <li>Jika belum diupload, teks "FujiYama4" akan ditampilkan sebagai fallback di website.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/settings/branding.blade.php ENDPATH**/ ?>