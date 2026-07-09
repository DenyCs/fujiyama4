<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth" x-data x-init="document.documentElement.classList.add(localStorage.theme || 'dark')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Fujiyama Ramen'); ?> — <?php echo e(config('app.name', 'Fujiyama Ramen')); ?></title>

    
    <script>
        (function() {
            const t = localStorage.getItem('theme');
            if (!t || t === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        /* Smooth theme transition */
        html.transitioning *, html.transitioning *::before, html.transitioning *::after {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease !important;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-white dark:bg-neutral-950 text-neutral-900 dark:text-neutral-200 font-['Inter'] antialiased"
    x-data="{ theme: localStorage.getItem('theme') || 'dark' }"
    x-init="
        $store.cart.count = <?php echo e($cartCount ?? 0); ?>;
        theme = localStorage.getItem('theme') || 'dark';
        $watch('theme', v => {
            document.documentElement.classList.add('transitioning');
            localStorage.setItem('theme', v);
            v === 'dark' ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark');
            setTimeout(() => document.documentElement.classList.remove('transitioning'), 300);
        });
    ">

    <!-- Sticky Navbar — Liquid Glass / Glassmorphism -->
    <nav x-data="{ open: false, scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="scrolled ? 'shadow-2xl shadow-black/30' : 'shadow-lg shadow-black/10'"
        class="fixed top-0 left-0 right-0 z-50 bg-white/90 dark:bg-neutral-950/90 backdrop-blur-2xl [-webkit-backdrop-filter:blur(40px)] border-b border-black/[0.04] dark:border-white/[0.06] border-t border-t-white/10 dark:border-t-white/[0.03] transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <a href="<?php echo e(route('client.home')); ?>" class="flex items-center gap-2 group">
                    <span class="text-3xl">🍜</span>
                    <div>
                        <span class="text-xl lg:text-2xl font-extrabold font-['Noto_Sans_JP'] text-neutral-900 dark:text-white tracking-tight">
                            富士山<span class="text-orange-500">ラーメン</span>
                        </span>
                        <span class="block text-[10px] text-orange-500/80 tracking-[0.25em] uppercase leading-none">Fujiyama Ramen</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-6">
                    <a href="<?php echo e(route('client.home')); ?>" class="text-sm font-medium transition-colors <?php echo e(request()->routeIs('client.home') ? 'text-orange-500 font-semibold' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500'); ?>">Beranda</a>
                    <a href="<?php echo e(route('client.menu')); ?>" class="text-sm font-medium transition-colors <?php echo e(request()->routeIs('client.menu') ? 'text-orange-500 font-semibold' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500'); ?>">Menu</a>
                    <a href="<?php echo e(route('reservation.create')); ?>" class="text-sm font-medium transition-colors <?php echo e(request()->routeIs('reservation.*') ? 'text-orange-500 font-semibold' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500'); ?>">Reservasi</a>
                    <a href="<?php echo e(route('client.events')); ?>" class="text-sm font-medium transition-colors <?php echo e(request()->routeIs('client.events') ? 'text-orange-500 font-semibold' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500'); ?>">Event & Promo</a>
                    <a href="<?php echo e(route('cart.index')); ?>" class="relative transition-colors <?php echo e(request()->routeIs('cart.*') ? 'text-orange-500' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500'); ?>" title="Keranjang">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        
                        <span x-show="$store.cart.count > 0"
                            x-text="$store.cart.count"
                            class="absolute -top-2 -right-3 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-bold leading-none text-white bg-orange-600 rounded-full"
                            style="display: none;">
                        </span>
                    </a>

                    
                    <button type="button"
                        @click="theme = (theme === 'dark' ? 'light' : 'dark')"
                        class="p-2 rounded-lg transition-colors text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800"
                        title="Toggle dark/light mode">
                        
                        <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        
                        <svg x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-medium text-orange-400 hover:text-orange-300 transition-colors">Admin Panel</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    </nav>

    
    <button type="button"
        @click="theme = (theme === 'dark' ? 'light' : 'dark')"
        class="lg:hidden fixed top-3 right-3 z-[60] w-9 h-9 flex items-center justify-center rounded-full bg-white/40 dark:bg-neutral-800/60 backdrop-blur-md border border-neutral-200 dark:border-neutral-700 shadow-lg transition-colors"
        title="Toggle dark/light mode">
        <svg x-show="theme === 'dark'" class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <svg x-show="theme === 'light'" class="w-4 h-4 text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
        </svg>
    </button>

    <!-- Main Content -->
    <main class="pt-16 lg:pt-20 pb-24 lg:pb-0">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Bottom Navbar (Mobile Only) — Floating Glass Pill -->
    <nav class="lg:hidden fixed bottom-[14px] left-4 right-4 z-50 h-16 px-2 rounded-[28px] bg-white/80 dark:bg-neutral-900/70 backdrop-blur-md border border-neutral-200/40 dark:border-white/[0.06] shadow-lg shadow-black/10 dark:shadow-black/40">
        <div class="relative flex items-center justify-around h-full">
            
            <a href="<?php echo e(route('client.home')); ?>" class="flex flex-col items-center gap-0.5 min-w-[52px] transition-all duration-200 <?php echo e(request()->routeIs('client.home') ? 'text-orange-500 font-semibold' : 'text-neutral-500 dark:text-neutral-400'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                <span class="text-[10px] font-medium leading-tight">Beranda</span>
            </a>

            
            <a href="<?php echo e(route('client.events')); ?>" class="flex flex-col items-center gap-0.5 min-w-[52px] transition-all duration-200 <?php echo e(request()->routeIs('client.events') ? 'text-orange-500 font-semibold' : 'text-neutral-500 dark:text-neutral-400'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
                <span class="text-[10px] font-medium leading-tight">Event</span>
            </a>

            
            <div class="relative flex flex-col items-center min-w-[52px]">
                <a href="<?php echo e(route('client.menu')); ?>" class="absolute -top-[36px] aspect-square flex items-center justify-center w-[58px] h-[58px] rounded-full border-[6px] border-white dark:border-neutral-950 shadow-lg shadow-orange-500/50 active:scale-95 transition-transform duration-200 z-10"
                    title="Menu"
                    style="background: radial-gradient(circle at 30% 30%, #fb923c, #ea580c);">
                    <svg class="w-7 h-7" fill="none" stroke="#1a0f08" viewBox="0 0 24 24">
                        <!-- Mangkuk Ramen -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19.5v-2a2 2 0 012-2h12a2 2 0 012 2v2M8 11.5V8.5M12 9.5V6M16 11.5V8.5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15.5h18"/>
                        <circle cx="12" cy="12" r="1" fill="#1a0f08" stroke="none"/>
                        <circle cx="8" cy="14" r="1" fill="#1a0f08" stroke="none"/>
                        <circle cx="16" cy="14" r="1" fill="#1a0f08" stroke="none"/>
                    </svg>
                </a>
                <span class="text-[10px] font-semibold text-orange-500 leading-tight mt-6">Pesan</span>
            </div>

            
            <a href="<?php echo e(route('reservation.create')); ?>" class="flex flex-col items-center gap-0.5 min-w-[52px] transition-all duration-200 <?php echo e(request()->routeIs('reservation.*') ? 'text-orange-500 font-semibold' : 'text-neutral-500 dark:text-neutral-400'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-[10px] font-medium leading-tight">Reservasi</span>
            </a>

            
            <a href="<?php echo e(route('cart.index')); ?>" class="relative flex flex-col items-center gap-0.5 min-w-[52px] transition-all duration-200 <?php echo e(request()->routeIs('cart.*') ? 'text-orange-500 font-semibold' : 'text-neutral-500 dark:text-neutral-400'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
                <span class="text-[10px] font-medium leading-tight">Cart</span>
                
                <span x-show="$store.cart.count > 0"
                    x-text="$store.cart.count"
                    class="absolute -top-0.5 -right-1 inline-flex items-center justify-center min-w-[15px] h-[15px] px-1 text-[9px] font-bold leading-none text-white bg-orange-500 rounded-full"
                    style="display: none;">
                </span>
            </a>
        </div>
    </nav>

    <!-- Footer -->
    <footer class="bg-neutral-100 dark:bg-neutral-900 border-t border-neutral-200 dark:border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-2xl">🍜</span>
                        <span class="text-lg font-extrabold font-['Noto_Sans_JP'] text-neutral-900 dark:text-white">
                            富士山<span class="text-orange-500">ラーメン</span>
                        </span>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-500 leading-relaxed">
                        Authentic Japanese ramen experience. Handcrafted noodles, rich broth, and premium toppings — crafted with passion since 2015.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="<?php echo e(route('client.home')); ?>" class="text-sm text-neutral-600 dark:text-neutral-500 hover:text-orange-500 transition-colors">Beranda</a></li>
                        <li><a href="<?php echo e(route('client.menu')); ?>" class="text-sm text-neutral-600 dark:text-neutral-500 hover:text-orange-500 transition-colors">Menu</a></li>
                        <li><a href="<?php echo e(route('client.home')); ?>#kategori" class="text-sm text-neutral-600 dark:text-neutral-500 hover:text-orange-500 transition-colors">Kategori</a></li>
                        <li><a href="<?php echo e(route('reservation.create')); ?>" class="text-sm text-neutral-600 dark:text-neutral-500 hover:text-orange-500 transition-colors">Reservasi</a></li>
                    </ul>
                </div>

                <!-- Info -->
                <div>
                    <h4 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm text-neutral-600 dark:text-neutral-500">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Jl. Ramen No. 123, Jakarta
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            0812-3456-7890
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Senin—Minggu: 11:00—22:00
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-neutral-200 dark:border-neutral-800 text-center">
                <p class="text-xs text-neutral-500 dark:text-neutral-600">&copy; <?php echo e(date('Y')); ?> Fujiyama Ramen. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Hero slider component
        document.addEventListener('alpine:init', () => {
            // Cart store — shared across all client pages
            Alpine.store('cart', {
                count: <?php echo e($cartCount ?? 0); ?>,
                async addItem(menuId) {
                    const csrf = document.querySelector('meta[name="csrf-token"]').content;
                    try {
                        const res = await fetch('/cart', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ menu_id: menuId, qty: 1 })
                        });
                        const data = await res.json();
                        if (data.success) {
                            this.count = data.count;
                        }
                    } catch (e) {
                        console.error('Failed to add to cart:', e);
                    }
                }
            });

            Alpine.data('heroSlider', (count) => ({
                current: 0,
                total: count,
                interval: null,

                init() {
                    if (this.total > 1) {
                        this.startAutoplay();
                    }
                },

                startAutoplay() {
                    this.interval = setInterval(() => {
                        this.next();
                    }, 5000);
                },

                stopAutoplay() {
                    clearInterval(this.interval);
                },

                next() {
                    this.current = (this.current + 1) % this.total;
                    this.resetAutoplay();
                },

                goTo(index) {
                    this.current = index;
                    this.resetAutoplay();
                },

                resetAutoplay() {
                    this.stopAutoplay();
                    this.startAutoplay();
                },

                destroy() {
                    this.stopAutoplay();
                }
            }));
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\fujiyama4\Modules\Client\app\Providers/../../resources/views/layouts/guest.blade.php ENDPATH**/ ?>