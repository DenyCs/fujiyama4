

<?php $__env->startSection('title', 'Pesanan'); ?>
<?php $__env->startSection('page_title', 'Daftar Pesanan'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Pesanan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Pesanan</h5>
        </div>
        <div class="card-body p-0">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Kode Pesanan</th>
                        <th>Pemesan</th>
                        <th>No. HP</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($orders->firstItem() + $loop->index); ?></td>
                            <td>
                                <code class="bg-dark text-orange px-2 py-1 rounded"><?php echo e($order->order_code); ?></code>
                            </td>
                            <td><?php echo e($order->customer_name); ?></td>
                            <td><?php echo e($order->customer_phone); ?></td>
                            <td>Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                            <td>
                                <?php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'diproses' => 'info',
                                        'selesai' => 'success',
                                        'batal' => 'danger',
                                    ];
                                    $color = $statusColors[$order->status] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?php echo e($color); ?>">
                                    <?php echo e(ucfirst($order->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>"
                                        class="btn btn-outline-primary" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button"
                                        class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false" title="Ubah Status">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php $__currentLoopData = ['pending', 'diproses', 'selesai', 'batal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <form action="<?php echo e(route('admin.orders.updateStatus', $order)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <input type="hidden" name="status" value="<?php echo e($status); ?>">
                                                    <button type="submit" class="dropdown-item <?php echo e($order->status === $status ? 'active' : ''); ?>">
                                                        <span class="badge bg-<?php echo e($statusColors[$status] ?? 'secondary'); ?> me-2">&nbsp;</span>
                                                        <?php echo e(ucfirst($status)); ?>

                                                    </button>
                                                </form>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-3 text-muted">
                                <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                                Belum ada pesanan masuk.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($orders->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($orders->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/orders/index.blade.php ENDPATH**/ ?>