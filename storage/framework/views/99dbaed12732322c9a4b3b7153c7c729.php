

<?php $__env->startSection('title', 'Lokasi & Jam Buka'); ?>
<?php $__env->startSection('header', 'Lokasi & Jam Buka'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0"><i class="bi bi-geo-alt-fill me-2"></i>Pengaturan Lokasi & Jam Operasional</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.settings.location.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-muted fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-building me-1"></i> Informasi Restoran
                        </h6>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="address" id="address" rows="3"
                            class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Jl. Fujiyama No. 123, Kawasan Kuliner, Jakarta Selatan"><?php echo e(old('address', $setting->address)); ?></textarea>
                        <?php $__errorArgs = ['address'];
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

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone"
                            class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('phone', $setting->phone)); ?>"
                            placeholder="+622112345678">
                        <?php $__errorArgs = ['phone'];
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
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-muted fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-map me-1"></i> Google Maps Embed
                        </h6>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="google_maps_embed_url" class="form-label">Google Maps Embed URL</label>
                        <input type="url" name="google_maps_embed_url" id="google_maps_embed_url"
                            class="form-control <?php $__errorArgs = ['google_maps_embed_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('google_maps_embed_url', $setting->google_maps_embed_url)); ?>"
                            placeholder="https://www.google.com/maps/embed?pb=...">
                        <div class="form-text mt-2">
                            <strong>Cara mendapatkan:</strong> Buka <a href="https://maps.google.com" target="_blank">Google Maps</a> →
                            cari lokasi restoran → klik <strong>Share</strong> → pilih tab <strong>Embed a map</strong> →
                            copy URL dari atribut <code>src</code> iframe → paste di sini.
                        </div>
                        <?php $__errorArgs = ['google_maps_embed_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        
                        <?php if($setting->google_maps_embed_url): ?>
                            <div class="mt-3 ratio ratio-16x9 rounded overflow-hidden border" style="max-height: 300px;">
                                <iframe src="<?php echo e($setting->google_maps_embed_url); ?>"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-muted fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-clock me-1"></i> Jam Operasional
                        </h6>
                    </div>

                    <?php
                        $days = [
                            'senin' => 'Senin',
                            'selasa' => 'Selasa',
                            'rabu' => 'Rabu',
                            'kamis' => 'Kamis',
                            'jumat' => 'Jumat',
                            'sabtu' => 'Sabtu',
                            'minggu' => 'Minggu',
                        ];
                        $dayKeys = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                        $today = $dayKeys[(int) now()->dayOfWeek];
                    ?>

                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isToday = ($key === $today);
                            $value = old('opening_hours.' . $key, $setting->opening_hours[$key] ?? '');
                        ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="opening_<?php echo e($key); ?>" class="form-label">
                                <?php echo e($label); ?>

                                <?php if($isToday): ?>
                                    <span class="badge bg-orange ms-1" style="background-color:#f97316;">Hari Ini</span>
                                <?php endif; ?>
                            </label>
                            <input type="text" name="opening_hours[<?php echo e($key); ?>]"
                                id="opening_<?php echo e($key); ?>"
                                class="form-control <?php echo e($isToday ? 'border-warning' : ''); ?> <?php $__errorArgs = ['opening_hours.' . $key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e($value); ?>"
                                placeholder="11:00 - 22:00 atau Tutup">
                            <?php $__errorArgs = ['opening_hours.' . $key];
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/settings/location.blade.php ENDPATH**/ ?>