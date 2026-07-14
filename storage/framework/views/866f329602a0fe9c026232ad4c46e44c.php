

<?php $__env->startSection('title', 'Reservasi — Admin'); ?>

<?php $__env->startSection('content_header'); ?>
<h1 class="m-0 text-dark">Reservasi Meja</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title">Daftar Reservasi</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Orang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($reservations->firstItem() + $loop->index); ?></td>
                    <td><?php echo e($r->name); ?></td>
                    <td><?php echo e($r->phone); ?></td>
                    <td><?php echo e($r->reservation_date->format('d M Y')); ?></td>
                    <td><?php echo e($r->reservation_time); ?></td>
                    <td><?php echo e($r->guest_count); ?></td>
                    <td>
                        <?php if($r->status === 'pending'): ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php elseif($r->status === 'confirmed'): ?>
                            <span class="badge bg-success">Dikonfirmasi</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Dibatalkan</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.reservations.show', $r)); ?>" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada reservasi.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($reservations->hasPages()): ?>
    <div class="card-footer clearfix">
        <?php echo e($reservations->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/reservations/index.blade.php ENDPATH**/ ?>