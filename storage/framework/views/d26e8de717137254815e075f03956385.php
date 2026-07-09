

<?php $__env->startSection('title', 'Fujiyama Ramen — Authentic Japanese Ramen'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Slider Section (Banner-driven, Crunchyroll-style) -->
    <section class="relative overflow-hidden lg:h-[calc(100vh-5rem)]" x-data="heroSlider(<?php echo e($banners->count()); ?>)">
        <?php if($banners->count()): ?>
            
            
            
            <div class="md:hidden relative w-full aspect-[4/3] overflow-hidden">
                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    x-show="current === <?php echo e($i); ?>"
                    x-transition:enter="transition duration-700 ease-in-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-300 ease-in-out"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0"
                    style="display: none;"
                >
                    <img src="<?php echo e($banner->image_url); ?>" alt="<?php echo e($banner->title); ?>" class="block w-full h-full object-cover object-right">
                    
                    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-white dark:from-neutral-950 via-white/80 dark:via-neutral-950/80 to-transparent"></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            
            
            <div class="md:hidden relative bg-white dark:bg-neutral-950 px-4 sm:px-8 pt-4 pb-0 -mt-6 min-h-[280px] transition-all duration-300">
                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div
                    x-show="current === <?php echo e($i); ?>"
                    x-transition:enter="transition duration-500 ease-in-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-200 ease-in-out"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    style="display: none;"
                >
                    <div class="max-w-xl">
                        
                        <div class="flex items-center gap-3 mb-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-neutral-100 dark:bg-neutral-800/80 backdrop-blur-sm text-neutral-800 dark:text-white text-[11px] font-bold rounded-full border border-neutral-300 dark:border-neutral-700/50">
                                <?php if($banner->subtitle): ?>
                                    <?php echo e($banner->subtitle); ?>

                                <?php else: ?>
                                    🔥 Best Seller
                                <?php endif; ?>
                            </span>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400 font-medium flex items-center gap-1.5">
                                • Ramen
                                <span class="text-neutral-400 dark:text-neutral-600">•</span> Pedas
                                <span class="text-neutral-400 dark:text-neutral-600">•</span> Premium
                            </span>
                        </div>

                        
                        <h1 class="text-3xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white leading-tight tracking-tight mb-6 drop-shadow-lg">
                            <?php echo e($banner->title); ?>

                        </h1>

                        
                        <?php if($banner->description): ?>
                        <p class="text-base text-neutral-700 dark:text-neutral-300 max-w-lg mb-10 leading-relaxed line-clamp-3 drop-shadow">
                            <?php echo e($banner->description); ?>

                        </p>
                        <?php endif; ?>

                        
                        <?php if($banner->cta_link): ?>
                        <a href="<?php echo e($banner->cta_link); ?>"
                            class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-orange-600 hover:bg-orange-500 text-white font-bold text-sm uppercase tracking-wide rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-orange-600/25 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                            <span><?php echo e($banner->cta_text); ?></span>
                        </a>
                        <?php endif; ?>

                        
                        <div class="flex items-center gap-2 mt-8">
                            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button
                                @click="goTo(<?php echo e($idx); ?>)"
                                class="rounded-full transition-all duration-300"
                                :class="current === <?php echo e($idx); ?> ? 'w-6 h-2 bg-orange-500 shadow-lg shadow-orange-500/40' : 'w-2 h-2 bg-neutral-400/60 dark:bg-neutral-500/60 hover:bg-neutral-500/80 dark:hover:bg-neutral-400/80'"
                                aria-label="Slide <?php echo e($idx + 1); ?>"
                            ></button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            
            
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
                x-show="current === <?php echo e($i); ?>"
                x-transition:enter="transition duration-700 ease-in-out"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="hidden md:block absolute inset-0"
                style="display: none;"
            >
                
                <div class="absolute inset-0">
                    <img src="<?php echo e($banner->image_url); ?>" alt="<?php echo e($banner->title); ?>" class="block w-full h-full object-cover object-right">
                    
                    <div class="absolute inset-0 hidden dark:block" style="background: linear-gradient(to right, rgba(10,10,10,1) 0%, rgba(10,10,10,0.85) 30%, rgba(10,10,10,0.4) 55%, transparent 75%);"></div>
                    
                    <div class="absolute inset-0 dark:hidden" style="background: linear-gradient(to right, rgba(250,250,250,0.97) 0%, rgba(250,250,250,0.88) 30%, rgba(250,250,250,0.55) 55%, transparent 75%);"></div>
                </div>

                
                <div class="relative z-10 h-full flex flex-col justify-end">
                    <div class="relative px-4 sm:px-8 lg:px-12 xl:px-16 pt-10 pb-16 flex flex-col justify-center flex-1">
                        
                        <div class="hidden md:block absolute top-1/4 left-0 w-48 h-48 bg-orange-600/10 rounded-full blur-3xl"></div>

                        <div class="relative max-w-xl md:max-w-lg lg:max-w-xl">
                            
                            <div class="flex items-center gap-3 mb-6">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-neutral-100 dark:bg-neutral-800/80 backdrop-blur-sm text-neutral-800 dark:text-white text-[11px] font-bold rounded-full border border-neutral-300 dark:border-neutral-700/50">
                                    <?php if($banner->subtitle): ?>
                                        <?php echo e($banner->subtitle); ?>

                                    <?php else: ?>
                                        🔥 Best Seller
                                    <?php endif; ?>
                                </span>
                                <span class="text-sm text-neutral-500 dark:text-neutral-400 font-medium flex items-center gap-1.5">
                                    • Ramen
                                    <span class="text-neutral-400 dark:text-neutral-600">•</span> Pedas
                                    <span class="text-neutral-400 dark:text-neutral-600">•</span> Premium
                                </span>
                            </div>

                            
                            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white leading-tight tracking-tight mb-6 drop-shadow-lg">
                                <?php echo e($banner->title); ?>

                            </h1>

                            
                            <?php if($banner->description): ?>
                            <p class="text-base md:text-lg text-neutral-700 dark:text-neutral-300 max-w-lg mb-10 leading-relaxed line-clamp-3 drop-shadow">
                                <?php echo e($banner->description); ?>

                            </p>
                            <?php endif; ?>

                            
                            <?php if($banner->cta_link): ?>
                            <a href="<?php echo e($banner->cta_link); ?>"
                                class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-orange-600 hover:bg-orange-500 text-white font-bold text-sm uppercase tracking-wide rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-orange-600/25 hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                                <span><?php echo e($banner->cta_text); ?></span>
                            </a>
                            <?php endif; ?>

                            
                            <div class="flex items-center gap-2 mt-8">
                                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button
                                    @click="goTo(<?php echo e($idx); ?>)"
                                    class="rounded-full transition-all duration-300"
                                    :class="current === <?php echo e($idx); ?> ? 'w-6 h-2 bg-orange-500 shadow-lg shadow-orange-500/40' : 'w-2 h-2 bg-neutral-400/60 dark:bg-neutral-500/60 hover:bg-neutral-500/80 dark:hover:bg-neutral-400/80'"
                                    aria-label="Slide <?php echo e($idx + 1); ?>"
                                ></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php else: ?>
            
            <div class="relative lg:absolute lg:inset-0 flex items-center justify-center overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-neutral-100 via-orange-50/40 to-neutral-100 dark:from-neutral-950 dark:via-orange-950/30 dark:to-neutral-950"></div>
                <div class="absolute top-20 left-10 w-64 h-64 bg-orange-600/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange-800/10 rounded-full blur-3xl"></div>
                <div class="absolute inset-0 opacity-[0.03] dark:opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23f97316\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-40 text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-orange-600/20 border border-orange-600/30 rounded-full mb-8">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                        </span>
                        <span class="text-xs font-semibold text-orange-400 uppercase tracking-wider">Sekarang Buka — 11:00—22:00</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white leading-none tracking-tight mb-6">
                        Authentic<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-500">
                            Ramen
                        </span>
                        Experience
                    </h1>

                    <p class="text-lg md:text-xl text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                        Handcrafted noodles, 18-hour slow-cooked tonkotsu broth, and the freshest toppings —
                        every bowl tells a story of tradition and passion.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="<?php echo e(route('client.menu')); ?>"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-orange-600 hover:bg-orange-500 text-white font-bold text-lg rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-orange-600/25 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            Lihat Menu
                        </a>
                        <a href="#kategori"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-neutral-200 dark:bg-neutral-800 hover:bg-neutral-300 dark:hover:bg-neutral-700 text-neutral-800 dark:text-neutral-200 font-semibold text-lg rounded-xl border border-neutral-300 dark:border-neutral-700 hover:border-neutral-400 dark:hover:border-neutral-600 transition-all duration-300">
                            Kategori
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                    </div>

                    <?php if($heroMenus->count()): ?>
                    <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl mx-auto">
                        <?php $__currentLoopData = $heroMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group relative bg-white/90 dark:bg-neutral-900/80 backdrop-blur-sm border border-neutral-200 dark:border-neutral-800 rounded-2xl p-4 text-left hover:border-orange-600/50 transition-all duration-300 hover:-translate-y-1 shadow-sm dark:shadow-none">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-orange-600/20 flex items-center justify-center text-2xl flex-shrink-0">
                                    <?php if($menu->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>" class="w-full h-full object-cover rounded-xl">
                                    <?php else: ?>
                                        🍜
                                    <?php endif; ?>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-neutral-900 dark:text-white truncate"><?php echo e($menu->name); ?></h4>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-500 truncate"><?php echo e($menu->category->name ?? ''); ?></p>
                                </div>
                                <span class="ml-auto text-sm font-bold text-orange-600 dark:text-orange-400 flex-shrink-0">
                                    Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?>

                                </span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce z-20">
                <svg class="w-6 h-6 text-neutral-400 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        <?php endif; ?>
    </section>

    <!-- Featured Menu Section -->
    <section id="menu-unggulan" class="relative pt-0 md:pt-[10px] pb-12 md:pb-24">
        <div class="absolute inset-0 bg-gradient-to-b from-white dark:from-neutral-950 via-neutral-100/50 dark:via-neutral-900/50 to-white dark:to-neutral-950"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block text-xs font-bold text-orange-500 uppercase tracking-[0.2em] mb-4">
                    Chef's Selection
                </span>
                <h2 class="text-3xl md:text-5xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white mb-4">
                    Menu Unggulan
                </h2>
                <p class="text-neutral-600 dark:text-neutral-400 max-w-xl mx-auto">
                    Pilihan terbaik dari dapur kami — setiap mangkuk diracik dengan bahan premium dan cinta.
                </p>
            </div>

            <!-- Floating Card Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $featuredMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden hover:border-orange-600/50 hover:shadow-lg hover:shadow-orange-600/10 transition-all duration-300 p-3 sm:pt-6 sm:pb-5 sm:px-5 relative flex flex-col items-center text-center"
                    x-data="{ added: false }">

                    
                    <?php if($menu->image): ?>
                        <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>"
                            class="w-24 h-24 sm:w-40 sm:h-40 object-contain group-hover:scale-110 transition-all duration-500 mb-1 sm:mb-2 drop-shadow-[0_6px_10px_rgba(0,0,0,0.15)] dark:drop-shadow-[0_10px_20px_rgba(234,88,12,0.25)]">
                    <?php else: ?>
                        <div class="w-24 h-24 sm:w-40 sm:h-40 flex items-center justify-center text-4xl sm:text-6xl mb-1 sm:mb-2">
                            🍜
                        </div>
                    <?php endif; ?>

                    
                    <span class="absolute top-1.5 sm:top-2 left-1.5 sm:left-3 px-2 sm:px-3 py-0.5 sm:py-1 bg-white/90 dark:bg-neutral-950/80 backdrop-blur-sm text-[10px] sm:text-xs font-semibold text-orange-600 dark:text-orange-400 rounded-full border border-neutral-200 dark:border-neutral-700 z-10">
                        <?php echo e($menu->category->name ?? 'Menu'); ?>

                    </span>

                    
                    <h3 class="text-sm sm:text-lg font-bold text-neutral-900 dark:text-white mb-1 sm:mb-2 mt-1 sm:mt-2"><?php echo e($menu->name); ?></h3>

                    
                    <p class="text-xs sm:text-sm text-neutral-500 mb-2 sm:mb-4 line-clamp-2 leading-relaxed"><?php echo e($menu->description ?: 'Lezat, autentik, dan dibuat dengan bahan-bahan premium.'); ?></p>

                    
                    <span class="text-base sm:text-xl font-bold text-orange-600 dark:text-orange-400 mb-2 sm:mb-4">Rp <?php echo e(number_format($menu->price, 0, ',', '.')); ?></span>

                    
                    <button type="button"
                        @click="added = true; $store.cart.addItem(<?php echo e($menu->id); ?>); setTimeout(() => added = false, 2000)"
                        class="inline-flex items-center gap-1 sm:gap-2 px-3 py-2 sm:px-5 sm:py-2.5 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white rounded-full transition-all duration-300 text-xs sm:text-sm font-semibold mt-auto">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        <span class="hidden sm:inline" x-text="added ? '✓ Ditambahkan' : 'Tambah ke Keranjang'">Tambah ke Keranjang</span>
                        <span class="sm:hidden" x-text="added ? '✓' : '+ Keranjang'">+ Keranjang</span>
                    </button>
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
    <section id="kategori" class="relative pt-0 md:pt-24 pb-24">
        <div class="absolute inset-0 bg-gradient-to-b from-white dark:from-neutral-950 via-neutral-100/30 dark:via-neutral-900/30 to-white dark:to-neutral-950"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block text-xs font-bold text-orange-500 uppercase tracking-[0.2em] mb-4">
                    Explore Our
                </span>
                <h2 class="text-3xl md:text-5xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white mb-4">
                    Kategori
                </h2>
                <p class="text-neutral-600 dark:text-neutral-400 max-w-xl mx-auto">
                    Jelajahi berbagai pilihan menu kami berdasarkan kategori favoritmu.
                </p>
            </div>

            <!-- Category cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group relative bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-6 hover:border-orange-600/50 transition-all duration-300 hover:-translate-y-2 text-center shadow-sm dark:shadow-none">
                    <!-- Icon -->
                    <div class="w-20 h-20 mx-auto mb-5 rounded-2xl bg-gradient-to-br from-orange-100 dark:from-orange-600/20 to-red-100 dark:to-red-600/20 border border-orange-200 dark:border-orange-600/20 flex items-center justify-center text-4xl group-hover:scale-110 transition-transform duration-300">
                        <?php
                            $icons = ['Ramen' => '🍜', 'Minuman' => '🥤', 'Topping' => '🥩', 'Side' => '🥟', 'Dessert' => '🍰'];
                            $icon = '🍽️';
                            foreach($icons as $key => $val) {
                                if(stripos($category->name, $key) !== false) { $icon = $val; break; }
                            }
                        ?>
                        <?php echo e($icon); ?>

                    </div>

                    <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2 group-hover:text-orange-500 transition-colors"><?php echo e($category->name); ?></h3>
                    <p class="text-sm text-neutral-500 mb-4"><?php echo e($category->menus->count()); ?> menu tersedia</p>

                    <div class="flex flex-wrap justify-center gap-2">
                        <?php $__currentLoopData = $category->menus->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="px-2.5 py-1 bg-neutral-100 dark:bg-neutral-800 text-xs text-neutral-600 dark:text-neutral-400 rounded-full"><?php echo e($menu->name); ?></span>
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
    <section class="py-16 md:py-20 bg-neutral-100 dark:bg-neutral-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-block text-xs font-bold text-orange-500 uppercase tracking-[0.2em] mb-3">Event & Promo</span>
                <h2 class="text-3xl md:text-4xl font-black text-neutral-900 dark:text-white">
                    Jangan Lewatkan Keseruannya!
                </h2>
                <p class="text-neutral-600 dark:text-neutral-400 mt-3 max-w-xl mx-auto">
                    Ikuti event spesial dan promo menarik dari Fujiyama Ramen.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative bg-white dark:bg-neutral-800 rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-700/50 hover:border-orange-500/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-500/10">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="<?php echo e($event->image_url); ?>" alt="<?php echo e($event->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full <?php echo e($event->isActive() ? 'bg-orange-500/90 text-white' : 'bg-neutral-500/80 text-white'); ?>">
                                <?php echo e($event->isActive() ? 'AKTIF' : 'BERAKHIR'); ?>

                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-xs text-orange-500 font-medium mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span><?php echo e($event->start_date->format('d M Y')); ?> — <?php echo e($event->end_date->format('d M Y')); ?></span>
                        </div>
                        <h3 class="font-extrabold text-neutral-900 dark:text-white text-lg group-hover:text-orange-500 transition-colors mb-2"><?php echo e($event->title); ?></h3>
                        <p class="text-sm text-neutral-500 line-clamp-2"><?php echo e($event->description); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="text-center mt-10">
                <a href="<?php echo e(route('client.events')); ?>"
                    class="inline-flex items-center gap-2 px-6 py-3 border border-orange-500/50 hover:bg-orange-500/10 text-orange-500 font-semibold rounded-xl transition-all duration-300">
                    Lihat Semua Event & Promo
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang-kami" class="relative py-16 md:py-24 bg-white dark:bg-neutral-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12">
                <span class="inline-block text-xs font-bold text-orange-500 uppercase tracking-[0.2em] mb-3">
                    Our Story
                </span>
                <h2 class="text-3xl md:text-5xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white mb-4">
                    <?php echo e($about->title); ?>

                </h2>
                <?php if($about->subtitle): ?>
                <p class="text-lg text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto italic">
                    "<?php echo e($about->subtitle); ?>"
                </p>
                <?php endif; ?>
            </div>

            
            <div class="max-w-4xl mx-auto mb-16" x-data="{ expanded: false }">
                <div class="prose prose-lg dark:prose-invert max-w-none text-neutral-700 dark:text-neutral-300 leading-relaxed">
                    <?php if($about->story): ?>
                        <div x-show="!expanded" x-transition>
                            <p><?php echo e(Str::limit($about->story, 400)); ?></p>
                            <?php if(strlen($about->story) > 400): ?>
                            <button @click="expanded = true"
                                class="mt-4 inline-flex items-center gap-2 text-orange-500 hover:text-orange-400 font-semibold transition-colors">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <?php endif; ?>
                        </div>
                        <div x-show="expanded" x-transition>
                            <p class="whitespace-pre-line"><?php echo e($about->story); ?></p>
                            <button @click="expanded = false"
                                class="mt-4 inline-flex items-center gap-2 text-orange-500 hover:text-orange-400 font-semibold transition-colors">
                                Sembunyikan
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                </svg>
                            </button>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-neutral-400 dark:text-neutral-500 italic py-8">
                            Cerita kami akan segera hadir di sini. ✨
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            
            <?php if($aboutInterior->count()): ?>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                <?php $__currentLoopData = $aboutInterior; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative overflow-hidden rounded-2xl border border-neutral-200 dark:border-neutral-800 hover:border-orange-500/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-orange-500/10">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="<?php echo e($gallery->image_url); ?>"
                            alt="<?php echo e($gallery->caption ?? 'Foto Interior Fujiyama Ramen'); ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <?php if($gallery->caption): ?>
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent p-4">
                        <p class="text-white text-sm font-medium"><?php echo e($gallery->caption); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-orange-100 dark:bg-orange-600/20 text-orange-500 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-neutral-400 dark:text-neutral-500 italic">
                    Foto interior dan dapur kami akan segera hadir. 📸
                </p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    
    <?php
        $tabCategories = [
            'proses_masak' => 'Proses Masak',
            'suasana' => 'Suasana',
            'lainnya' => 'Lainnya',
        ];
    ?>
    <section id="galeri-foto" class="relative py-16 md:py-24 bg-neutral-100 dark:bg-neutral-900/50" x-data="{ activeTab: 'proses_masak', showLightbox: false, lightboxSrc: '', lightboxCaption: '' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12">
                <span class="inline-block text-xs font-bold text-orange-500 uppercase tracking-[0.2em] mb-3">
                    Behind The Scenes
                </span>
                <h2 class="text-3xl md:text-5xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white mb-4">
                    Galeri Foto
                </h2>
                <p class="text-neutral-600 dark:text-neutral-400 max-w-xl mx-auto">
                    Intip keseruan di balik layar — dari proses memasak hingga suasana hangat di Fujiyama Ramen.
                </p>
            </div>

            
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                <?php $__currentLoopData = $tabCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catKey => $catLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $catCount = $allAboutGalleries->where('category', $catKey)->count(); ?>
                    <button @click="activeTab = '<?php echo e($catKey); ?>'"
                        :class="activeTab === '<?php echo e($catKey); ?>'
                            ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30'
                            : 'bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-700 border border-neutral-200 dark:border-neutral-700'"
                        class="px-5 py-2.5 rounded-full font-semibold text-sm transition-all duration-300">
                        <?php echo e($catLabel); ?>

                        <span class="ml-1.5 text-xs opacity-70">(<?php echo e($catCount); ?>)</span>
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php $__currentLoopData = $tabCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catKey => $catLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $catGalleries = $allAboutGalleries->where('category', $catKey); ?>
                <div x-show="activeTab === '<?php echo e($catKey); ?>'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <?php if($catGalleries->count()): ?>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                        <?php $__currentLoopData = $catGalleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div @click="showLightbox = true; lightboxSrc = '<?php echo e($gallery->image_url); ?>'; lightboxCaption = '<?php echo e($gallery->caption ?? ''); ?>'"
                            class="group relative overflow-hidden rounded-2xl border border-neutral-200 dark:border-neutral-800 hover:border-orange-500/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-orange-500/10 cursor-pointer">
                            <div class="aspect-[4/3] overflow-hidden">
                                <img src="<?php echo e($gallery->image_url); ?>"
                                    alt="<?php echo e($gallery->caption ?? 'Foto ' . $catLabel); ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <?php if($gallery->caption): ?>
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent p-4">
                                <p class="text-white text-sm font-medium"><?php echo e($gallery->caption); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-orange-100 dark:bg-orange-600/20 text-orange-500 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-neutral-400 dark:text-neutral-500 italic">
                            Foto <?php echo e(strtolower($catLabel)); ?> akan segera hadir. 📸
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div x-show="showLightbox"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[999] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
            @click.self="showLightbox = false"
            @keydown.escape.window="showLightbox = false">
            <div class="relative max-w-4xl w-full max-h-[90vh]">
                <button @click="showLightbox = false"
                    class="absolute -top-12 right-0 text-white/80 hover:text-white transition-colors p-2 z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <img :src="lightboxSrc" :alt="lightboxCaption"
                    class="w-full max-h-[80vh] object-contain rounded-2xl">
                <p x-show="lightboxCaption" x-text="lightboxCaption"
                    class="text-center text-white/80 mt-3 text-sm"></p>
            </div>
        </div>
    </section>

    
    <section id="lokasi" class="relative py-16 md:py-24 overflow-hidden bg-white dark:bg-neutral-950">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12">
                <span class="inline-block text-orange-500 font-semibold text-sm tracking-widest uppercase mb-2">Kunjungi Kami</span>
                <div class="flex items-center justify-center gap-3 flex-wrap">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-neutral-900 dark:text-white">
                        Lokasi & Jam Buka
                    </h2>
                    
                    <?php
                        $isOpen = $setting->isOpen();
                        $todaySchedule = $setting->todaySchedule();
                    ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold
                        <?php echo e($isOpen ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 border border-green-300 dark:border-green-700' : 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 border border-red-300 dark:border-red-700'); ?>">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full <?php echo e($isOpen ? 'bg-green-500' : 'bg-red-500'); ?> opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 <?php echo e($isOpen ? 'bg-green-500' : 'bg-red-500'); ?>"></span>
                        </span>
                        <?php echo e($isOpen ? 'SEDANG BUKA' : 'SEDANG TUTUP'); ?>

                        <?php if($todaySchedule): ?>
                            <span class="font-normal opacity-75"><?php echo e($todaySchedule); ?></span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="mt-3 mx-auto w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-400 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                
                <div class="space-y-8">
                    
                    <div class="group flex gap-4 p-5 bg-neutral-50 dark:bg-neutral-800/40 rounded-2xl border border-neutral-200 dark:border-neutral-700/50 hover:border-orange-500/30 transition-all duration-300">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-600/20 flex items-center justify-center text-orange-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-neutral-900 dark:text-white mb-1">Alamat</h4>
                            <p class="text-neutral-600 dark:text-neutral-400 leading-relaxed text-sm">
                                <?php echo e($setting->address ?? 'Alamat restoran akan segera ditambahkan.'); ?>

                            </p>
                        </div>
                    </div>

                    
                    <?php if($setting->phone): ?>
                    <div class="group flex gap-4 p-5 bg-neutral-50 dark:bg-neutral-800/40 rounded-2xl border border-neutral-200 dark:border-neutral-700/50 hover:border-orange-500/30 transition-all duration-300">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-600/20 flex items-center justify-center text-orange-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-neutral-900 dark:text-white mb-1">Telepon</h4>
                            <a href="tel:<?php echo e($setting->phone); ?>" class="text-orange-600 dark:text-orange-400 hover:underline text-sm font-medium transition">
                                <?php echo e($setting->phone); ?>

                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    
                    <div class="p-5 bg-neutral-50 dark:bg-neutral-800/40 rounded-2xl border border-neutral-200 dark:border-neutral-700/50">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-600/20 flex items-center justify-center text-orange-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-neutral-900 dark:text-white">Jam Operasional</h4>
                        </div>

                        <?php
                            $days = [
                                'senin' => 'Senin',
                                'selasa' => 'Selasa',
                                'rabu' => 'Rabu',
                                'kamis' => 'Kamis',
                                'jumat' => 'Jumat',
                                'sabtu' => 'Sabtu',
                                'minggu' => 'Minggu',
                            ];
                            $dayKeys = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                            $today = $dayKeys[(int) now()->dayOfWeek];
                            $openingHours = $setting->opening_hours;
                            if (is_string($openingHours)) {
                                $openingHours = json_decode($openingHours, true) ?? [];
                            }
                        ?>

                        <div class="space-y-2">
                            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isToday = ($key === $today);
                                    $schedule = $openingHours[$key] ?? '—';
                                    $isClosed = (mb_strtolower(trim($schedule)) === 'tutup');
                                ?>
                                <div class="flex items-center justify-between py-2 px-3 rounded-lg text-sm
                                    <?php echo e($isToday ? 'bg-orange-50 dark:bg-orange-900/20 border-l-2 border-orange-500 font-semibold' : 'border-l-2 border-transparent'); ?>">
                                    <span class="<?php echo e($isToday ? 'text-orange-600 dark:text-orange-400' : 'text-neutral-600 dark:text-neutral-400'); ?>">
                                        <?php echo e($label); ?>

                                    </span>
                                    <span class="<?php echo e($isToday ? 'text-neutral-900 dark:text-white' : 'text-neutral-700 dark:text-neutral-300'); ?> <?php echo e($isClosed ? 'text-red-500 dark:text-red-400' : ''); ?>">
                                        <?php echo e($schedule); ?>

                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                
                <div class="lg:sticky lg:top-24 h-fit">
                    <?php if($setting->google_maps_embed_url): ?>
                        <div class="rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-700/50 shadow-lg shadow-neutral-200/50 dark:shadow-neutral-900/50 aspect-[4/3] lg:aspect-auto lg:h-full lg:min-h-[500px]">
                            <iframe src="<?php echo e($setting->google_maps_embed_url); ?>"
                                width="100%" height="100%"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="w-full h-full"></iframe>
                        </div>
                    <?php else: ?>
                        <div class="rounded-2xl overflow-hidden border border-dashed border-neutral-300 dark:border-neutral-600 aspect-[4/3] lg:aspect-auto lg:h-full lg:min-h-[500px] bg-neutral-100 dark:bg-neutral-800/50 flex items-center justify-center">
                            <div class="text-center p-8">
                                <svg class="w-16 h-16 mx-auto text-neutral-300 dark:text-neutral-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                                <p class="text-neutral-400 dark:text-neutral-500 text-sm italic">
                                    Peta akan segera tersedia
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    
    <section x-data="{ activeIndex: 0 }" class="relative py-16 md:py-24 overflow-hidden bg-gradient-to-b from-white to-neutral-50 dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12" x-animate>
                <span class="inline-block text-orange-500 font-semibold text-sm tracking-widest uppercase mb-2">Apa Kata Pelanggan</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-neutral-900 dark:text-white">
                    Testimoni Pelanggan Setia
                </h2>
                <div class="mt-3 mx-auto w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-400 rounded-full"></div>
                <p class="mt-4 text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto">
                    Kami bangga dengan setiap mangkuk yang tersaji dan setiap senyum yang tercipta. ❤️
                </p>
            </div>

            <?php if($testimonials->count()): ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group relative bg-white dark:bg-neutral-800/50 backdrop-blur-sm rounded-2xl p-6 border border-neutral-200 dark:border-neutral-700/50 hover:border-orange-500/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-500/5">
                        
                        <div class="absolute top-4 right-4 text-orange-500/20 dark:text-orange-400/10">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        
                        <div class="flex gap-0.5 mb-4">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <svg class="w-5 h-5 <?php echo e($i <= $testimonial->rating ? 'text-yellow-400' : 'text-neutral-300 dark:text-neutral-600'); ?>" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            <?php endfor; ?>
                        </div>

                        
                        <p class="text-neutral-700 dark:text-neutral-300 leading-relaxed mb-6 line-clamp-4">
                            "<?php echo e($testimonial->review); ?>"
                        </p>

                        
                        <div class="flex items-center gap-3 mt-auto pt-4 border-t border-neutral-100 dark:border-neutral-700/50">
                            <?php if($testimonial->customer_photo_url): ?>
                                <img src="<?php echo e($testimonial->customer_photo_url); ?>" alt="<?php echo e($testimonial->customer_name); ?>"
                                    class="w-10 h-10 rounded-full object-cover ring-2 ring-orange-500/30">
                            <?php else: ?>
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold text-sm ring-2 ring-orange-500/30">
                                    <?php echo e($testimonial->initials); ?>

                                </div>
                            <?php endif; ?>
                            <div>
                                <p class="font-semibold text-neutral-900 dark:text-white text-sm"><?php echo e($testimonial->customer_name); ?></p>
                                <?php if($testimonial->order_type): ?>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-400">Pesan: <?php echo e($testimonial->order_type); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-orange-100 dark:bg-orange-600/20 text-orange-500 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <p class="text-neutral-400 dark:text-neutral-500 italic">
                        Testimoni pelanggan akan segera hadir di sini. 💬
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    
    <section id="faq" class="relative py-16 md:py-24 bg-neutral-100 dark:bg-neutral-900/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12">
                <span class="inline-block text-orange-500 font-semibold text-sm tracking-widest uppercase mb-2">Pertanyaan Umum</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-neutral-900 dark:text-white">
                    FAQ
                </h2>
                <div class="mt-3 mx-auto w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-400 rounded-full"></div>
                <p class="mt-4 text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto">
                    Jawaban untuk pertanyaan yang paling sering ditanyakan.
                </p>
            </div>

            <?php if($faqs->count()): ?>
                <div class="space-y-4" x-data="{ activeFaq: null }">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white dark:bg-neutral-800/80 rounded-2xl border border-neutral-200 dark:border-neutral-700/50 overflow-hidden transition-all duration-300 hover:border-orange-500/30"
                        :class="{ 'border-orange-500/50 shadow-lg shadow-orange-500/10': activeFaq === <?php echo e($index); ?> }">
                        <button @click="activeFaq = activeFaq === <?php echo e($index); ?> ? null : <?php echo e($index); ?>"
                            class="w-full flex items-center justify-between p-5 text-left focus:outline-none group">
                            <span class="text-base md:text-lg font-semibold text-neutral-900 dark:text-white pr-4"
                                :class="{ 'text-orange-500 dark:text-orange-400': activeFaq === <?php echo e($index); ?> }">
                                <?php echo e($faq->question); ?>

                            </span>
                            <svg class="w-5 h-5 flex-shrink-0 text-neutral-400 transition-transform duration-300"
                                :class="{ 'rotate-180 text-orange-500': activeFaq === <?php echo e($index); ?> }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="activeFaq === <?php echo e($index); ?>"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="px-5 pb-5">
                            <div class="pt-2 border-t border-neutral-100 dark:border-neutral-700/50">
                                <p class="text-neutral-600 dark:text-neutral-400 leading-relaxed text-sm md:text-base">
                                    <?php echo e($faq->answer); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-orange-100 dark:bg-orange-600/20 text-orange-500 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-neutral-400 dark:text-neutral-500 italic">
                        FAQ akan segera hadir di sini. ❓
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client::layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules\Client\app\Providers/../../resources/views/home.blade.php ENDPATH**/ ?>