<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> — Fujiyama Ramen</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

    <?php echo $__env->yieldPushContent('styles'); ?>
    <style>
        /* Sidebar visual hierarchy */
        .sidebar-parent-link {
            font-weight: 600 !important;
            font-size: 0.875rem !important;
            color: #fff !important;
        }
        .sidebar-parent-link:hover {
            color: #fff !important;
            background: rgba(255,255,255,0.05) !important;
        }
        .menu-open > .sidebar-parent-link {
            background: rgba(255,255,255,0.08) !important;
        }
        .sidebar-child-link {
            font-weight: 400 !important;
            font-size: 0.8125rem !important;
            color: #9ca3af !important;
            padding-left: 2.5rem !important;
            transition: all 0.15s ease;
        }
        .sidebar-child-link:hover {
            color: #fff !important;
            background: rgba(255,255,255,0.05) !important;
        }
        .sidebar-child-link.active {
            color: #fff !important;
            background: rgba(249, 115, 22, 0.2) !important;
            border-left: 3px solid #f97316 !important;
            padding-left: calc(2.5rem - 3px) !important;
        }
        .sidebar-child-link.active:hover {
            background: rgba(249, 115, 22, 0.3) !important;
        }
        .sidebar-child-link .nav-icon {
            font-size: 0.75rem !important;
            width: 1rem !important;
            margin-right: 0.25rem !important;
        }
        .sidebar-parent-link .nav-icon {
            font-size: 0.9rem !important;
        }

        /* Topbar override — Fujiyama dark theme */
        .app-header.navbar {
            background-color: #0a0a0a !important;
            border-bottom: 2px solid #f97316 !important;
        }
        .app-header.navbar .nav-link {
            color: #fff !important;
            transition: color 0.15s ease;
        }
        .app-header.navbar .nav-link:hover {
            color: #fb923c !important;
        }
        .app-header.navbar [data-bs-theme="dark"] {
            background-color: #0a0a0a !important;
        }

        /* Page header styling */
        .page-header {
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
        }
        @media (prefers-color-scheme: dark) {
            .page-header {
                background-color: #171717;
                border-bottom-color: #262626;
            }
        }

        /* Breadcrumb styling — orange for active item */
        .page-header .breadcrumb-item a {
            color: #6b7280;
            text-decoration: none;
        }
        .page-header .breadcrumb-item.active {
            color: #f97316;
            font-weight: 600;
        }
        @media (prefers-color-scheme: dark) {
            .page-header .breadcrumb-item a {
                color: #9ca3af;
            }
            .page-header .breadcrumb-item.active {
                color: #fb923c;
            }
        }

        /* SafeGuard: prevent any SVG/icon from overflowing and filling entire page */
        svg {
            max-width: 100% !important;
            height: auto !important;
        }
        .pagination svg {
            width: 1em !important;
            height: 1em !important;
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    
    <nav class="app-header navbar navbar-expand bg-neutral-950 shadow-sm border-b-2 border-orange-500" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white hover:text-orange-400 transition-colors" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white hover:text-orange-400 transition-colors" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> <?php echo e(Auth::user()->name); ?>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                        <li>
                            <a href="<?php echo e(route('admin.change-password.edit')); ?>" class="dropdown-item">
                                <i class="fas fa-lock me-2"></i> Ganti Password
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
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
        <div class="sidebar-wrapper" x-data="{ search: '' }">
            
            <div class="px-3 pt-3 pb-2">
                <div class="position-relative">
                    <i class="fas fa-search position-absolute text-muted" style="left: 10px; top: 50%; transform: translateY(-50%); font-size: 0.85rem; z-index: 5;"></i>
                    <input type="text" x-model="search" placeholder="Cari menu..."
                        class="form-control form-control-sm ps-4 pe-4 bg-dark border-secondary text-light"
                        style="border-radius: 6px; font-size: 0.85rem;"
                        @input.debounce.100ms="search = $event.target.value">
                    <button x-show="search.length > 0" @click="search = ''"
                        class="btn btn-sm position-absolute text-muted" type="button"
                        style="right: 0; top: 50%; transform: translateY(-50%); background: none; border: none; z-index: 5;">
                        <i class="fas fa-times" style="font-size: 0.75rem;"></i>
                    </button>
                </div>
            </div>

            <nav class="mt-1">
                <ul class="nav sidebar-menu flex-column" role="menu">
                    
                    <li class="nav-item" x-show="search === '' || 'dashboard'.includes(search.toLowerCase())">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link sidebar-parent-link font-semibold text-white <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    
                    <?php $isOperasionalActive = request()->routeIs('admin.orders.*') || request()->routeIs('admin.reservations.*'); ?>
                    <li class="nav-item"
                        x-data="{ open: <?php echo e($isOperasionalActive ? 'true' : 'false'); ?> }"
                        x-show="search === '' || 'pesanan'.includes(search.toLowerCase()) || 'reservasi'.includes(search.toLowerCase())"
                        :class="{ 'menu-open': open || search !== '' }">
                        <a href="#" class="nav-link sidebar-parent-link font-semibold text-white" @click.prevent="open = !open">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Operasional
                                <i class="nav-arrow fas" :class="(open || search !== '') ? 'fa-angle-down' : 'fa-angle-right'"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" x-show="open || search !== ''">
                            <li class="nav-item" x-show="search === '' || 'pesanan'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.orders.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-receipt"></i>
                                    <p>Pesanan</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'reservasi'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.reservations.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.reservations.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>Reservasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    
                    <?php $isKatalogActive = request()->routeIs('admin.menus.*') || request()->routeIs('admin.categories.*'); ?>
                    <li class="nav-item"
                        x-data="{ open: <?php echo e($isKatalogActive ? 'true' : 'false'); ?> }"
                        x-show="search === '' || 'menu'.includes(search.toLowerCase()) || 'kategori'.includes(search.toLowerCase())"
                        :class="{ 'menu-open': open || search !== '' }">
                        <a href="#" class="nav-link sidebar-parent-link font-semibold text-white" @click.prevent="open = !open">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Katalog
                                <i class="nav-arrow fas" :class="(open || search !== '') ? 'fa-angle-down' : 'fa-angle-right'"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" x-show="open || search !== ''">
                            <li class="nav-item" x-show="search === '' || 'menu'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.menus.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.menus.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-utensils"></i>
                                    <p>Menu</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'kategori'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.categories.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-tags"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    
                    <?php $isKontenActive = request()->routeIs('admin.banners.*') || request()->routeIs('admin.events.*') || request()->routeIs('admin.about.*') || request()->routeIs('admin.gallery.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.faqs.*') || request()->routeIs('admin.section-content.*'); ?>
                    <li class="nav-item"
                        x-data="{ open: <?php echo e($isKontenActive ? 'true' : 'false'); ?> }"
                         x-show="search === '' || 'banner'.includes(search.toLowerCase()) || 'event'.includes(search.toLowerCase()) || 'tentang kami'.includes(search.toLowerCase()) || 'tentang'.includes(search.toLowerCase()) || 'kami'.includes(search.toLowerCase()) || 'galeri'.includes(search.toLowerCase()) || 'testimoni'.includes(search.toLowerCase()) || 'faq'.includes(search.toLowerCase()) || 'konten section'.includes(search.toLowerCase()) || 'konten'.includes(search.toLowerCase()) || 'section'.includes(search.toLowerCase())"
                        :class="{ 'menu-open': open || search !== '' }">
                        <a href="#" class="nav-link sidebar-parent-link font-semibold text-white" @click.prevent="open = !open">
                            <i class="nav-icon fas fa-laptop"></i>
                            <p>
                                Konten Website
                                <i class="nav-arrow fas" :class="(open || search !== '') ? 'fa-angle-down' : 'fa-angle-right'"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" x-show="open || search !== ''">
                            <li class="nav-item" x-show="search === '' || 'banner'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.banners.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.banners.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-image"></i>
                                    <p>Banner</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'event'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.events.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.events.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-calendar-check"></i>
                                    <p>Event</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'tentang kami'.includes(search.toLowerCase()) || 'tentang'.includes(search.toLowerCase()) || 'kami'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.about.edit')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.about.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-info-circle"></i>
                                    <p>Tentang Kami</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'galeri'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.gallery.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.gallery.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>Galeri</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'testimoni'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.testimonials.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-star"></i>
                                    <p>Testimoni</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'faq'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.faqs.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.faqs.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-question-circle"></i>
                                    <p>FAQ</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'konten section'.includes(search.toLowerCase()) || 'konten'.includes(search.toLowerCase()) || 'section'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.section-content.edit')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.section-content.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-pen-to-square"></i>
                                    <p>Konten Section</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    
                    <?php $isPengaturanActive = request()->routeIs('admin.settings.location.*') || request()->routeIs('admin.settings.branding*') || request()->routeIs('admin.settings.footer.*') || request()->routeIs('admin.social-links.*') || request()->routeIs('admin.activity-logs.*'); ?>
                    <li class="nav-item"
                        x-data="{ open: <?php echo e($isPengaturanActive ? 'true' : 'false'); ?> }"
                        x-show="search === '' || 'lokasi'.includes(search.toLowerCase()) || 'jam buka'.includes(search.toLowerCase()) || 'branding'.includes(search.toLowerCase()) || 'logo'.includes(search.toLowerCase()) || 'favicon'.includes(search.toLowerCase()) || 'footer'.includes(search.toLowerCase()) || 'copyright'.includes(search.toLowerCase()) || 'social media'.includes(search.toLowerCase()) || 'sosial'.includes(search.toLowerCase()) || 'media'.includes(search.toLowerCase()) || 'log aktivitas'.includes(search.toLowerCase()) || 'log'.includes(search.toLowerCase()) || 'aktivitas'.includes(search.toLowerCase())"
                        :class="{ 'menu-open': open || search !== '' }">
                        <a href="#" class="nav-link sidebar-parent-link font-semibold text-white" @click.prevent="open = !open">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Pengaturan
                                <i class="nav-arrow fas" :class="(open || search !== '') ? 'fa-angle-down' : 'fa-angle-right'"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" x-show="open || search !== ''">
                            <li class="nav-item" x-show="search === '' || 'lokasi'.includes(search.toLowerCase()) || 'jam buka'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.settings.location.edit')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.settings.location.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-map-marker-alt"></i>
                                    <p>Lokasi & Jam Buka</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'branding'.includes(search.toLowerCase()) || 'logo'.includes(search.toLowerCase()) || 'favicon'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.settings.branding')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.settings.branding*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-paint-brush"></i>
                                    <p>Branding</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'footer'.includes(search.toLowerCase()) || 'copyright'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.settings.footer.edit')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.settings.footer.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Footer</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'social media'.includes(search.toLowerCase()) || 'sosial'.includes(search.toLowerCase()) || 'media'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.social-links.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.social-links.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-share-alt"></i>
                                    <p>Social Media</p>
                                </a>
                            </li>
                            <li class="nav-item" x-show="search === '' || 'log aktivitas'.includes(search.toLowerCase()) || 'log'.includes(search.toLowerCase()) || 'aktivitas'.includes(search.toLowerCase())">
                                <a href="<?php echo e(route('admin.activity-logs.index')); ?>" class="nav-link sidebar-child-link font-normal text-neutral-400 <?php echo e(request()->routeIs('admin.activity-logs.*') ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>Log Aktivitas</p>
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
                
                <div class="page-header row mb-4 mx-0 px-3 py-3 bg-white dark:bg-neutral-900 border-bottom rounded-2">
                    <div class="col-sm-6 d-flex align-items-center">
                        <h3 class="mb-0 fw-bold fs-2 text-neutral-900 dark:text-white"><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></h3>
                    </div>
                    <div class="col-sm-6 d-flex align-items-center justify-content-end">
                        <ol class="breadcrumb float-sm-end mb-0">
                            <?php
                                    $routeName = Route::currentRouteName();
                                    $breadcrumb = [];

                                    // Mapping: route prefix → [group_name, module_label, is_singleton]
                                    $groups = [
                                        'admin.dashboard'           => ['Dashboard', 'Dashboard', true],
                                        'admin.orders'              => ['Operasional', 'Pesanan', false],
                                        'admin.reservations'        => ['Operasional', 'Reservasi', false],
                                        'admin.menus'               => ['Katalog', 'Menu', false],
                                        'admin.categories'          => ['Katalog', 'Kategori', false],
                                        'admin.banners'             => ['Konten Website', 'Banner', false],
                                        'admin.events'              => ['Konten Website', 'Event', false],
                                        'admin.about'               => ['Konten Website', 'Tentang Kami', true],
                                        'admin.gallery'             => ['Konten Website', 'Galeri', false],
                                        'admin.gallery-categories'  => ['Konten Website', 'Galeri', false],
                                        'admin.testimonials'        => ['Konten Website', 'Testimoni', false],
                                        'admin.faqs'                => ['Konten Website', 'FAQ', false],
                                        'admin.section-content'     => ['Konten Website', 'Konten Section', true],
                                        'admin.settings.location'   => ['Pengaturan', 'Lokasi & Jam Buka', true],
                                        'admin.settings.branding'   => ['Pengaturan', 'Branding', true],
                                        'admin.settings.footer'     => ['Pengaturan', 'Footer', true],
                                        'admin.social-links'        => ['Pengaturan', 'Social Media', false],
                                        'admin.activity-logs'       => ['Pengaturan', 'Log Aktivitas', false],
                                        'admin.change-password'     => ['Akun', 'Ganti Password', true],
                                    ];

                                    // Action labels (including non-standard actions)
                                    $actionLabels = [
                                        'index'         => '',
                                        'create'        => 'Tambah Baru',
                                        'edit'          => 'Edit',
                                        'show'          => 'Detail',
                                        'updateStatus'  => 'Update Status',
                                        'store'         => 'Tambah Baru',
                                        'update'        => 'Edit',
                                    ];

                                    $matchedGroup = null;
                                    $matchedModuleKey = null;
                                    $isSingleton = false;

                                    foreach ($groups as $prefix => [$groupName, $moduleLabel, $singleton]) {
                                        if (str_starts_with($routeName, $prefix)) {
                                            $matchedGroup = $groupName;
                                            $matchedModuleKey = $prefix;
                                            $moduleLabelFinal = $moduleLabel;
                                            $isSingleton = $singleton;
                                            break;
                                        }
                                    }

                                    if ($matchedGroup && $matchedModuleKey) {
                                        // Ambil action dari route name (bagian terakhir)
                                        $parts = explode('.', $routeName);
                                        $action = end($parts);

                                        if ($isSingleton && $matchedModuleKey === 'admin.dashboard') {
                                            // Dashboard: single item only
                                            $breadcrumb[] = ['label' => $moduleLabelFinal, 'active' => true];
                                        } elseif ($isSingleton) {
                                            // Singleton modules (About, Settings Location, Section Content):
                                            // Just "Group / Module" — no action suffix
                                            $breadcrumb[] = ['label' => $matchedGroup, 'active' => false];
                                            $breadcrumb[] = ['label' => $moduleLabelFinal, 'active' => true];
                                        } else {
                                            // Normal CRUD modules: Group / Module / Action
                                            $breadcrumb[] = ['label' => $matchedGroup, 'active' => false];
                                            $breadcrumb[] = ['label' => $moduleLabelFinal, 'active' => ($action === 'index')];

                                            if (isset($actionLabels[$action]) && $actionLabels[$action] !== '') {
                                                $breadcrumb[] = ['label' => $actionLabels[$action], 'active' => true];
                                            } elseif ($action !== 'index') {
                                                // Fallback: ucfirst action
                                                $breadcrumb[] = ['label' => ucfirst(str_replace('_', ' ', $action)), 'active' => true];
                                            }
                                        }
                                    }
                                ?>

                                <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="breadcrumb-item <?php if($item['active']): ?> active <?php endif; ?>" <?php if($item['active']): ?> aria-current="page" <?php endif; ?>>
                                        <?php echo e($item['label']); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<script>
// Disable AdminLTE auto-breadcrumb — we use server-rendered breadcrumb only
window.addEventListener('load', function () {
    const bc = document.querySelector('.breadcrumb');
    if (bc) { bc.setAttribute('data-bs-auto-breadcrumb', 'false'); }
});
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\fujiyama4\Modules/Admin\resources/views/layouts/master.blade.php ENDPATH**/ ?>