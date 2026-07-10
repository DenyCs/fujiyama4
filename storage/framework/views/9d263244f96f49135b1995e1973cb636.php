

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('page_title', 'Dashboard'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Dashboard</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3><?php echo e($orderCount ?? 0); ?></h3>
                    <p>Pesanan Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="small-box-footer">
                    Lihat Pesanan <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>Rp <?php echo e(number_format($revenueToday ?? 0, 0, ',', '.')); ?></h3>
                    <p>Pendapatan Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-info">
                <div class="inner">
                    <h3><?php echo e($menuCount ?? 0); ?></h3>
                    <p>Menu Tersedia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <a href="<?php echo e(route('admin.menus.index')); ?>" class="small-box-footer">
                    Kelola Menu <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Selamat Datang di Panel Admin</h5>
                </div>
                <div class="card-body">
                    <p>Gunakan menu di sidebar kiri untuk mengelola:</p>
                    <ul>
                        <li><strong>Kategori</strong> — Tambah, edit, atau hapus kategori menu</li>
                        <li><strong>Menu</strong> — Kelola daftar menu beserta harga dan gambar</li>
                        <li><strong>Pesanan</strong> — Lihat dan ubah status pesanan pelanggan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/dashboard.blade.php ENDPATH**/ ?>