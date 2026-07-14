

<?php $__env->startSection('title', 'Daftar Menu'); ?>
<?php $__env->startSection('page_title', 'Daftar Menu'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Menu</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Menu</h5>
            <a href="<?php echo e(route('admin.menus.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Menu
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 10%">Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th style="width: 8%">Status</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>
                            <?php if($menu->image): ?>
                            <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            <?php else: ?>
                            <span class="badge bg-secondary">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?php echo e($menu->name); ?></strong>
                            <?php if($menu->description): ?>
                            <br><small class="text-muted"><?php echo e(Str::limit($menu->description, 50)); ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($menu->category->name ?? '-'); ?></td>
                        <td>Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?></td>
                        <td>
                            <?php if($menu->is_available): ?>
                            <span class="badge bg-success">Tersedia</span>
                            <?php else: ?>
                            <span class="badge bg-danger">Habis</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.menus.edit', $menu)); ?>" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo e(route('admin.menus.destroy', $menu)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
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
                        <td colspan="7" class="text-center py-3">Belum ada menu.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($menus->hasPages()): ?>
        <div class="card-footer">
            <?php echo e($menus->links()); ?>

        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/menus/index.blade.php ENDPATH**/ ?>