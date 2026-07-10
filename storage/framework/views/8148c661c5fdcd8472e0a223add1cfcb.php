

<?php $__env->startSection('title', 'Event & Promo'); ?>
<?php $__env->startSection('content_header', 'Event & Promo'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Event</h3>
        <div class="card-tools">
            <a href="<?php echo e(route('admin.events.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Event
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Diskon / Promo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                        <?php if($event->image): ?>
                            <img src="<?php echo e(asset('storage/' . $event->image)); ?>" alt="<?php echo e($event->title); ?>" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($event->title); ?></td>
                    <td><?php echo e($event->start_date->format('d M Y')); ?></td>
                    <td><?php echo e($event->end_date->format('d M Y')); ?></td>
                    <td><?php echo e($event->discount_promo ?? '-'); ?></td>
                    <td>
                        <span class="badge badge-<?php echo e($event->status === 'active' ? 'success' : 'secondary'); ?>">
                            <?php echo e($event->status === 'active' ? 'Aktif' : 'Tidak Aktif'); ?>

                        </span>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('admin.events.destroy', $event)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus event ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center">Belum ada event.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        <?php echo e($events->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/events/index.blade.php ENDPATH**/ ?>