

<?php $__env->startSection('title', 'Tentang Kami'); ?>
<?php $__env->startSection('page_title', 'Tentang Kami'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Tentang Kami</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('admin.about.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row">
            
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Informasi Tentang Kami</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title"
                                class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('title', $about->title)); ?>" required maxlength="255">
                            <?php $__errorArgs = ['title'];
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

                        
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" id="subtitle"
                                class="form-control <?php $__errorArgs = ['subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('subtitle', $about->subtitle)); ?>" maxlength="255"
                                placeholder="Misal: Filosofi di Balik Setiap Mangkuk">
                            <?php $__errorArgs = ['subtitle'];
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

                        
                        <div class="mb-3">
                            <label for="story" class="form-label">Cerita / Filosofi</label>
                            <textarea name="story" id="story" rows="12"
                                class="form-control <?php $__errorArgs = ['story'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Tulis cerita atau filosofi restoran di sini..."><?php echo e(old('story', $about->story)); ?></textarea>
                            <?php $__errorArgs = ['story'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted">Gunakan teks biasa atau HTML sederhana. Cerita ini akan ditampilkan di landing page.</small>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Pilih Foto untuk Halaman Tentang Kami</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Pilih satu foto utama (besar) dan satu foto sekunder (overlap kecil) yang akan tampil di halaman depan.
                            Klik tombol di bawah untuk memilih foto dari galeri.
                        </p>

                        <?php if($galleries->isEmpty()): ?>
                            <div class="alert alert-warning mb-0">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Belum ada foto di galeri.
                                <a href="<?php echo e(route('admin.gallery.create')); ?>" class="alert-link">Upload foto sekarang</a>.
                            </div>
                        <?php else: ?>
                            
                            <div class="mb-4 p-3 border rounded">
                                <h6 class="fw-bold mb-3">Foto Utama (Hero)</h6>
                                <div class="text-center mb-2">
                                    <?php if($about->primaryPhoto): ?>
                                        <img src="<?php echo e($about->primaryPhoto->image_url); ?>"
                                            alt="<?php echo e($about->primaryPhoto->caption ?? 'Foto Utama'); ?>"
                                            class="img-thumbnail mb-2" style="max-height:180px;max-width:100%;object-fit:cover;">
                                        <p class="small text-muted mb-0 text-truncate">
                                            <?php echo e($about->primaryPhoto->caption ?? '(Tanpa caption)'); ?>

                                        </p>
                                        <?php if($about->primaryPhoto->galleryCategory): ?>
                                            <span class="badge bg-secondary badge-sm"><?php echo e($about->primaryPhoto->galleryCategory->name); ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center text-muted"
                                            style="height:140px;">
                                            <div>
                                                <i class="fas fa-image fa-2x mb-2 d-block"></i>
                                                <span>Tanpa Foto</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.about.pilih-foto', 'utama')); ?>"
                                        class="btn btn-sm btn-outline-primary flex-grow-1 text-center">
                                        <i class="fas fa-search me-1"></i>
                                        <?php echo e($about->primaryPhoto ? 'Ganti Foto' : 'Pilih Foto'); ?>

                                    </a>
                                    <?php if($about->primaryPhoto): ?>
                                        <a href="<?php echo e(route('admin.about.simpan-foto', ['slot' => 'utama', 'photo' => 0])); ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus foto utama?')"
                                            title="Hapus Pilihan">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="mb-3 p-3 border rounded">
                                <h6 class="fw-bold mb-3">Foto Sekunder (Overlap)</h6>
                                <div class="text-center mb-2">
                                    <?php if($about->secondaryPhoto): ?>
                                        <img src="<?php echo e($about->secondaryPhoto->image_url); ?>"
                                            alt="<?php echo e($about->secondaryPhoto->caption ?? 'Foto Sekunder'); ?>"
                                            class="img-thumbnail mb-2" style="max-height:180px;max-width:100%;object-fit:cover;">
                                        <p class="small text-muted mb-0 text-truncate">
                                            <?php echo e($about->secondaryPhoto->caption ?? '(Tanpa caption)'); ?>

                                        </p>
                                        <?php if($about->secondaryPhoto->galleryCategory): ?>
                                            <span class="badge bg-secondary badge-sm"><?php echo e($about->secondaryPhoto->galleryCategory->name); ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center text-muted"
                                            style="height:140px;">
                                            <div>
                                                <i class="fas fa-image fa-2x mb-2 d-block"></i>
                                                <span>Tanpa Foto</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.about.pilih-foto', 'sekunder')); ?>"
                                        class="btn btn-sm btn-outline-primary flex-grow-1 text-center">
                                        <i class="fas fa-search me-1"></i>
                                        <?php echo e($about->secondaryPhoto ? 'Ganti Foto' : 'Pilih Foto'); ?>

                                    </a>
                                    <?php if($about->secondaryPhoto): ?>
                                        <a href="<?php echo e(route('admin.about.simpan-foto', ['slot' => 'sekunder', 'photo' => 0])); ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus foto sekunder?')"
                                            title="Hapus Pilihan">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <hr>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-info-circle me-1"></i>
                                Upload foto baru melalui halaman <a href="<?php echo e(route('admin.gallery.index')); ?>">Galeri Foto</a>.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
            <a href="<?php echo e(route('admin.gallery.index')); ?>" class="btn btn-outline-secondary ms-2">
                <i class="fas fa-images me-1"></i> Kelola Galeri Foto
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/about/edit.blade.php ENDPATH**/ ?>