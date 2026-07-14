@extends('client::layouts.guest')

@section('title', 'Galeri Foto — Fujiyama Ramen')

@section('content')
    {{-- ========== HEADER PAGE ========== --}}
    <section class="relative pt-12 md:pt-16 pb-8 md:pb-12 overflow-hidden bg-neutral-100 dark:bg-neutral-900/50">
        {{-- Decorative blobs --}}
        <div class="absolute -top-32 right-[10%] w-[28rem] h-[28rem] bg-orange-500/12 dark:bg-orange-500/6 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
        <div class="absolute -bottom-20 left-[5%] w-[24rem] h-[24rem] bg-amber-400/10 dark:bg-amber-500/5 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Page header --}}
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

    {{-- ========== GALLERY GRID FULL (reuse partial) ========== --}}
    <section class="relative py-8 md:py-16 overflow-hidden bg-neutral-100 dark:bg-neutral-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('client::partials.gallery-grid', ['galleries' => $allAboutGalleries, 'context' => 'fullpage', 'showFilter' => true])
        </div>
    </section>
@endsection