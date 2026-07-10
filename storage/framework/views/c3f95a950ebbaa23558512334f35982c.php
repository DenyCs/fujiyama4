

<?php $__env->startSection('title', 'Galeri'); ?>
<?php $__env->startSection('page_title', 'Galeri Foto'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Galeri</li>
<?php $__env->stopSection(); ?>

<?php
    $categoryLabels = [
        'interior'    => 'Interior',
        'proses_masak'=> 'Proses Masak',
        'suasana'     => 'Suasana',
        'lainnya'     => 'Lainnya',
    ];
    $categoryColors = [
        'interior'    => 'bg-primary',
        'proses_masak'=> 'bg-danger',
        'suasana'     => 'bg-success',
        'lainnya'     => 'bg-secondary',
    ];
    $selectedCategory = request('category', '');
?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <h5 class="card-title mb-0">Daftar Foto</h5>
            <span class="badge bg-info"><?php echo e($galleries->total()); ?> foto</span>
        </div>
        <div class="d-flex gap-2">
            
            <form action="<?php echo e(route('admin.gallery.index')); ?>" method="GET" class="d-flex gap-2">
                <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $categoryLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e($selectedCategory == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </form>
            <a href="<?php echo e(route('admin.gallery.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Foto
            </a>
        </div>
    </div>

    <div class="card-body">
        <?php if($galleries->count()): ?>
        <div class="row g-3">
            <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card h-100 shadow-sm">
                    <div class="position-relative">
                        <img src="<?php echo e($gallery->image_url); ?>"
                            alt="<?php echo e($gallery->caption ?? 'Foto Galeri'); ?>"
                            class="card-img-top"
                            style="height: 140px; object-fit: cover;">
                        <span class="badge <?php echo e($categoryColors[$gallery->category] ?? 'bg-secondary'); ?> position-absolute top-0 end-0 m-2">
                            <?php echo e($categoryLabels[$gallery->category] ?? 'Lainnya'); ?>

                        </span>
                    </div>
                    <div class="card-body p-2 text-center">
                        <small class="text-muted d-block mb-1"><?php echo e($gallery->caption ?: '-'); ?></small>
                        <span class="badge bg-light text-dark">Urutan: <?php echo e($gallery->order); ?></span>
                    </div>
                    <div class="card-footer p-1 d-flex justify-content-center gap-1">
                        <a href="<?php echo e(route('admin.gallery.edit', $gallery)); ?>" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('admin.gallery.destroy', $gallery)); ?>" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-images fa-4x mb-3 d-block"></i>
            <p class="fs-5">Belum ada foto di galeri.</p>
            <a href="<?php echo e(route('admin.gallery.create')); ?>" class="btn btn-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Foto Pertama
            </a>
        </div>
        <?php endif; ?>
    </div>

    <?php if($galleries->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($galleries->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/gallery/index.blade.php ENDPATH**/ ?>