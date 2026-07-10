

<?php $__env->startSection('title', 'Galeri Foto — Fujiyama Ramen'); ?>

<?php $__env->startSection('content'); ?>
    
    <section class="relative pt-24 pb-8 md:pt-32 md:pb-12 overflow-hidden bg-neutral-100 dark:bg-neutral-900/50">
        
        <div class="absolute -top-32 right-[10%] w-[28rem] h-[28rem] bg-orange-500/12 dark:bg-orange-500/6 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
        <div class="absolute -bottom-20 left-[5%] w-[24rem] h-[24rem] bg-amber-400/10 dark:bg-amber-500/5 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <a href="<?php echo e(route('client.home')); ?>#galeri-foto"
                class="inline-flex items-center gap-2 text-neutral-500 dark:text-neutral-400 hover:text-orange-500 dark:hover:text-orange-400 transition-colors mb-6 text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Beranda
            </a>

            
            <div class="text-center mb-8">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold text-orange-600 dark:text-orange-400 bg-orange-500/10 dark:bg-orange-500/10 border border-orange-500/20 dark:border-orange-500/20 mb-4">
                    📸 Koleksi Lengkap
                </span>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white leading-tight tracking-tight mb-4">
                    Galeri Foto <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-orange-500 to-amber-500">Fujiyama Ramen</span>
                </h1>
                <p class="text-neutral-600 dark:text-neutral-400 max-w-xl mx-auto text-sm md:text-base">
                    Jelajahi seluruh koleksi foto — dari proses memasak hingga suasana hangat di Fujiyama Ramen.
                </p>
            </div>
        </div>
    </section>

    
    <section class="relative py-8 md:py-16 overflow-hidden bg-neutral-100 dark:bg-neutral-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php echo $__env->make('client::partials.gallery-grid', ['galleries' => $allAboutGalleries], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client::layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\fujiyama4\Modules\Client\app\Providers/../../resources/views/gallery.blade.php ENDPATH**/ ?>