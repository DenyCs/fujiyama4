

<?php $__env->startSection('title', 'Banner'); ?>
<?php $__env->startSection('page_title', 'Banner'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Banner</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Banner</h5>
        <a href="<?php echo e(route('admin.banners.create')); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Banner
        </a>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th style="width: 80px">Gambar</th>
                    <th>Judul</th>
                    <th>Subtitle</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <img src="<?php echo e($banner->image_url); ?>" alt="<?php echo e($banner->title); ?>"
                            style="width: 60px; height: 35px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td><?php echo e($banner->title); ?></td>
                    <td><?php echo e($banner->subtitle ?: '-'); ?></td>
                    <td><?php echo e($banner->order); ?></td>
                    <td>
                        <span class="badge <?php echo e($banner->status === 'active' ? 'bg-success' : 'bg-secondary'); ?>">
                            <?php echo e($banner->status === 'active' ? 'Aktif' : 'Tidak Aktif'); ?>

                        </span>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.banners.edit', $banner)); ?>" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('admin.banners.destroy', $banner)); ?>" method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus banner ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-3 text-muted">Belum ada banner.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($banners->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($banners->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/banners/index.blade.php ENDPATH**/ ?>