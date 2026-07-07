

<?php $__env->startSection('title', 'Fujiyama Ramen — Authentic Japanese Ramen'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-neutral-950 via-orange-950/30 to-neutral-950"></div>

        <!-- Decorative elements -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-orange-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange-800/10 rounded-full blur-3xl"></div>

        <!-- Subtle pattern -->
        <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23f97316\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-40">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-orange-600/20 border border-orange-600/30 rounded-full mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    <span class="text-xs font-semibold text-orange-400 uppercase tracking-wider">Sekarang Buka — 11:00—22:00</span>
                </div>

                <!-- Main headline -->
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black font-['Noto_Sans_JP'] text-white leading-none tracking-tight mb-6">
                    Authentic<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-500">
                        Ramen
                    </span>
                    Experience
                </h1>

                <p class="text-lg md:text-xl text-neutral-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                    Handcrafted noodles, 18-hour slow-cooked tonkotsu broth, and the freshest toppings — 
                    every bowl tells a story of tradition and passion.
                </p>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="<?php echo e(route('client.menu')); ?>"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-orange-600 hover:bg-orange-500 text-white font-bold text-lg rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-orange-600/25 hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Lihat Menu
                    </a>
                    <a href="#kategori"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-neutral-800 hover:bg-neutral-700 text-neutral-200 font-semibold text-lg rounded-xl border border-neutral-700 hover:border-neutral-600 transition-all duration-300">
                        Kategori
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                </div>

                <!-- Hero menu preview cards -->
                <?php if($heroMenus->count()): ?>
                <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl mx-auto">
                    <?php $__currentLoopData = $heroMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group relative bg-neutral-900/80 backdrop-blur-sm border border-neutral-800 rounded-2xl p-4 text-left hover:border-orange-600/50 transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-orange-600/20 flex items-center justify-center text-2xl flex-shrink-0">
                                <?php if($menu->image): ?>
                                    <img src="<?php echo e(asset('storage/menus/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>" class="w-full h-full object-cover rounded-xl">
                                <?php else: ?>
                                    🍜
                                <?php endif; ?>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-bold text-white truncate"><?php echo e($menu->name); ?></h4>
                                <p class="text-xs text-neutral-500 truncate"><?php echo e($menu->category->name ?? ''); ?></p>
                            </div>
                            <span class="ml-auto text-sm font-bold text-orange-400 flex-shrink-0">
                                Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- Featured Menu Section -->
    <section id="menu-unggulan" class="relative py-24">
        <div class="absolute inset-0 bg-gradient-to-b from-neutral-950 via-neutral-900/50 to-neutral-950"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block text-xs font-bold text-orange-500 uppercase tracking-[0.2em] mb-4">
                    Chef's Selection
                </span>
                <h2 class="text-3xl md:text-5xl font-black font-['Noto_Sans_JP'] text-white mb-4">
                    Menu Unggulan
                </h2>
                <p class="text-neutral-400 max-w-xl mx-auto">
                    Pilihan terbaik dari dapur kami — setiap mangkuk diracik dengan bahan premium dan cinta.
                </p>
            </div>

            <!-- Carousel-style grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $featuredMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group relative bg-neutral-900/80 border border-neutral-800 rounded-2xl overflow-hidden hover:border-orange-600/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-600/5">
                    <!-- Image area -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-orange-900/40 to-neutral-900">
                        <?php if($menu->image): ?>
                            <img src="<?php echo e(asset('storage/menus/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <?php else: ?>
                            <div class="absolute inset-0 flex items-center justify-center text-6xl">
                                🍜
                            </div>
                        <?php endif; ?>
                        <!-- Category badge -->
                        <span class="absolute top-3 left-3 px-3 py-1 bg-neutral-950/80 backdrop-blur-sm text-xs font-semibold text-orange-400 rounded-full border border-neutral-700">
                            <?php echo e($menu->category->name ?? 'Menu'); ?>

                        </span>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-orange-400 transition-colors"><?php echo e($menu->name); ?></h3>
                        <p class="text-sm text-neutral-500 line-clamp-2 mb-4 leading-relaxed"><?php echo e($menu->description ?: 'Lezat, autentik, dan dibuat dengan bahan-bahan premium.'); ?></p>

                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-orange-400">Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?></span>
                            <button type="button"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-orange-600 hover:bg-orange-500 text-white text-sm font-semibold rounded-lg transition-colors"
                                x-data="{ toast: false }"
                                @click="toast = true; $store.cart.addItem(<?php echo e($menu->id); ?>); setTimeout(() => toast = false, 2000)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                </svg>
                                <span x-text="toast ? '✓ Ditambahkan' : 'Pesan'">Pesan</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-neutral-500">Menu belum tersedia saat ini.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="kategori" class="relative py-24">
        <div class="absolute inset-0 bg-gradient-to-b from-neutral-950 via-neutral-900/30 to-neutral-950"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block text-xs font-bold text-orange-500 uppercase tracking-[0.2em] mb-4">
                    Explore Our
                </span>
                <h2 class="text-3xl md:text-5xl font-black font-['Noto_Sans_JP'] text-white mb-4">
                    Kategori
                </h2>
                <p class="text-neutral-400 max-w-xl mx-auto">
                    Jelajahi berbagai pilihan menu kami berdasarkan kategori favoritmu.
                </p>
            </div>

            <!-- Category cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group relative bg-neutral-900/80 border border-neutral-800 rounded-2xl p-6 hover:border-orange-600/50 transition-all duration-300 hover:-translate-y-2 text-center">
                    <!-- Icon -->
                    <div class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-orange-600/20 to-red-600/20 border border-orange-600/20 flex items-center justify-center text-4xl group-hover:scale-110 transition-transform duration-300">
                        <?php
                            $icons = ['Ramen' => '🍜', 'Minuman' => '🥤', 'Topping' => '🥩', 'Side' => '🥟', 'Dessert' => '🍰'];
                            $icon = '🍽️';
                            foreach($icons as $key => $val) {
                                if(stripos($category->name, $key) !== false) { $icon = $val; break; }
                            }
                        ?>
                        <?php echo e($icon); ?>

                    </div>

                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-orange-400 transition-colors"><?php echo e($category->name); ?></h3>
                    <p class="text-sm text-neutral-500 mb-4"><?php echo e($category->menus->count()); ?> menu tersedia</p>

                    <div class="flex flex-wrap justify-center gap-2">
                        <?php $__currentLoopData = $category->menus->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="px-2.5 py-1 bg-neutral-800 text-xs text-neutral-400 rounded-full"><?php echo e($menu->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-neutral-500">Belum ada kategori tersedia.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Promo / CTA Banner -->
    <section class="relative py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-orange-600 via-orange-700 to-red-700 p-8 md:p-12 lg:p-16 text-center">
                <!-- Decorative -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

                <div class="relative">
                    <span class="inline-block text-xs font-bold text-orange-200 uppercase tracking-[0.2em] mb-4">
                        Special Offer
                    </span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-4">
                        Siap Merasakan Kelezatan Ramen Kami?
                    </h2>
                    <p class="text-orange-100/80 max-w-xl mx-auto mb-8 text-lg">
                        Pesan sekarang dan nikmati pengalaman ramen autentik langsung dari dapur kami.
                    </p>
                    <a href="<?php echo e(route('client.menu')); ?>"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-white hover:bg-neutral-100 text-orange-700 font-bold text-lg rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
                        Pesan Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Events & Promo Section -->
    <section class="py-16 md:py-20 bg-neutral-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-block text-xs font-bold text-orange-400 uppercase tracking-[0.2em] mb-3">Event & Promo</span>
                <h2 class="text-3xl md:text-4xl font-black text-white">
                    Jangan Lewatkan Keseruannya!
                </h2>
                <p class="text-neutral-400 mt-3 max-w-xl mx-auto">
                    Ikuti event spesial dan promo menarik dari Fujiyama Ramen.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative bg-neutral-800 rounded-2xl overflow-hidden border border-neutral-700/50 hover:border-orange-500/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-500/10">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="<?php echo e($event->image_url); ?>" alt="<?php echo e($event->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full <?php echo e($event->isActive() ? 'bg-orange-500/90 text-white' : 'bg-neutral-600/80 text-neutral-300'); ?>">
                                <?php echo e($event->isActive() ? 'AKTIF' : 'BERAKHIR'); ?>

                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-xs text-orange-400 font-medium mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span><?php echo e($event->start_date->format('d M Y')); ?> — <?php echo e($event->end_date->format('d M Y')); ?></span>
                        </div>
                        <h3 class="font-extrabold text-white text-lg group-hover:text-orange-400 transition-colors mb-2"><?php echo e($event->title); ?></h3>
                        <p class="text-sm text-neutral-400 line-clamp-2"><?php echo e($event->description); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="text-center mt-10">
                <a href="<?php echo e(route('client.events')); ?>"
                    class="inline-flex items-center gap-2 px-6 py-3 border border-orange-500/50 hover:bg-orange-500/10 text-orange-400 font-semibold rounded-xl transition-all duration-300">
                    Lihat Semua Event & Promo
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client::layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules\Client\app\Providers/../../resources/views/home.blade.php ENDPATH**/ ?>