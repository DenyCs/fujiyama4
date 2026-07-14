

<?php $__env->startSection('title', 'Kategori'); ?>
<?php $__env->startSection('page_title', 'Daftar Kategori'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Kategori</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Kategori</h5>
            <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Kategori
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th style="width: 10%">Jumlah Menu</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($category->name); ?></td>
                        <td><code><?php echo e($category->slug); ?></code></td>
                        <td><span class="badge bg-info"><?php echo e($category->menus_count); ?></span></td>
                        <td>
                            <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-3">Belum ada kategori.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($categories->hasPages()): ?>
        <div class="card-footer">
            <?php echo e($categories->links()); ?>

        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/categories/index.blade.php ENDPATH**/ ?>