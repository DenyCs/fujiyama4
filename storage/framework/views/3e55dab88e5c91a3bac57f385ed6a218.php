<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> — Fujiyama Ramen</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    
    <nav class="app-header navbar navbar-expand bg-primary shadow-sm" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link text-white">
                        <i class="fas fa-user-circle me-1"></i> <?php echo e(Auth::user()->name); ?>

                    </span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="nav-link btn btn-link text-white" style="text-decoration: none;">
                            <i class="fas fa-sign-out-alt me-1"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    
    <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link text-decoration-none">
                <span class="brand-text fw-bold fs-5">🍜 Fujiyama Admin</span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-3">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.banners.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.banners.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-image"></i>
                            <p>Banner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.categories.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.menus.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.menus.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-utensils"></i>
                            <p>Menu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Pesanan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.events.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.events.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-star"></i>
                            <p>Event & Promo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.reservations.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.reservations.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Reservasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.testimonials.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-star"></i>
                            <p>Testimoni</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.faqs.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.faqs.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>FAQ</p>
                        </a>
                    </li>
                    <li class="nav-item <?php echo e(request()->routeIs('admin.about.*') || request()->routeIs('admin.gallery.*') || request()->routeIs('admin.settings.*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link <?php echo e(request()->routeIs('admin.about.*') || request()->routeIs('admin.gallery.*') || request()->routeIs('admin.settings.*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Pengaturan
                                <i class="nav-arrow fas fa-angle-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.about.edit')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.about.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-info-circle"></i>
                                    <p>Tentang Kami</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.gallery.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.gallery.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>Galeri</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.settings.location.edit')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings.location.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-map-marker-alt"></i>
                                    <p>Lokasi & Jam Buka</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    
    <main class="app-main">
        <div class="app-content">
            <div class="container-fluid">
                
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h3 class="mb-0"><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <?php echo $__env->yieldContent('breadcrumb'); ?>
                        </ol>
                    </div>
                </div>

                
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </main>

    
    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">
            Fujiyama Ramen Admin v1.0
        </div>
        <strong>&copy; <?php echo e(date('Y')); ?> Fujiyama Ramen.</strong> All rights reserved.
    </footer>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/layouts/master.blade.php ENDPATH**/ ?>