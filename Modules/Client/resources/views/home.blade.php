@extends('client::layouts.guest')

@section('title', 'Fujiyama Ramen — Authentic Japanese Ramen')

@section('content')
    <!-- Hero Slider Section (Banner-driven, Crunchyroll-style) -->
    <section class="relative overflow-hidden lg:h-[calc(100vh-5rem)]" x-data="heroSlider({{ $banners->count() }})">
        @if($banners->count())
            {{-- ========================================== --}}
            {{-- MOBILE: Fixed-height image stack container --}}
            {{-- ========================================== --}}
            <div class="md:hidden relative w-full aspect-[4/3] overflow-hidden">
                @foreach($banners as $i => $banner)
                <div
                    x-show="current === {{ $i }}"
                    x-transition:enter="transition duration-700 ease-in-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-300 ease-in-out"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0"
                    style="display: none;"
                >
                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="block w-full h-full object-cover object-right">
                    {{-- Gradient overlay: fade bottom of image into page background (dual-mode) --}}
                    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-white dark:from-neutral-950 via-white/80 dark:via-neutral-950/80 to-transparent"></div>
                </div>
                @endforeach
            </div>

            {{-- ========================================== --}}
            {{-- MOBILE: Text content — absolute stacked for zero height change during transition --}}
            {{-- ========================================== --}}
            <div class="md:hidden relative bg-white dark:bg-neutral-950 px-4 sm:px-8 pt-4 pb-4 -mt-6">
                <div class="relative" style="min-height: 340px;">
                @foreach($banners as $i => $banner)
                <div
                    x-show="current === {{ $i }}"
                    x-transition:enter="transition duration-500 ease-in-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition duration-200 ease-in-out"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0"
                    style="display: none;"
                >
                    <div class="max-w-xl">
                        {{-- Badge Row --}}
                        <div class="flex items-center gap-3 mb-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-neutral-100 dark:bg-neutral-800/80 backdrop-blur-sm text-neutral-800 dark:text-white text-[11px] font-bold rounded-full border border-neutral-300 dark:border-neutral-700/50">
                                @if($banner->subtitle)
                                    {{ $banner->subtitle }}
                                @else
                                    🔥 Best Seller
                                @endif
                            </span>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400 font-medium flex items-center gap-1.5">
                                • Ramen
                                <span class="text-neutral-400 dark:text-neutral-600">•</span> Pedas
                                <span class="text-neutral-400 dark:text-neutral-600">•</span> Premium
                            </span>
                        </div>

                        {{-- Title --}}
                        <h1 class="text-3xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white leading-tight tracking-tight mb-6 drop-shadow-lg">
                            {{ $banner->title }}
                        </h1>

                        {{-- Description --}}
                        @if($banner->description)
                        <p class="text-base text-neutral-700 dark:text-neutral-300 max-w-lg mb-10 leading-relaxed line-clamp-3 drop-shadow">
                            {{ $banner->description }}
                        </p>
                        @endif

                        {{-- CTA Button --}}
                        @if($banner->cta_link)
                        <a href="{{ $banner->cta_link }}"
                            class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-orange-600 hover:bg-orange-500 text-white font-bold text-sm uppercase tracking-wide rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-orange-600/25 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                            <span>{{ $banner->cta_text }}</span>
                        </a>
                        @endif

                        {{-- Pagination Dots — inside content, below CTA --}}
                        <div class="flex items-center gap-2 mt-8">
                            @foreach($banners as $idx => $b)
                            <button
                                @click="goTo({{ $idx }})"
                                class="rounded-full transition-all duration-300"
                                :class="current === {{ $idx }} ? 'w-6 h-2 bg-orange-500 shadow-lg shadow-orange-500/40' : 'w-2 h-2 bg-neutral-400/60 dark:bg-neutral-500/60 hover:bg-neutral-500/80 dark:hover:bg-neutral-400/80'"
                                aria-label="Slide {{ $idx + 1 }}"
                            ></button>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- DESKTOP: Absolute-positioned slides (unchanged) --}}
            {{-- ========================================== --}}
            @foreach($banners as $i => $banner)
            <div
                x-show="current === {{ $i }}"
                x-transition:enter="transition duration-700 ease-in-out"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="hidden md:block absolute inset-0"
                style="display: none;"
            >
                {{-- Desktop: Full-bleed background image with dual-mode gradient overlay --}}
                <div class="absolute inset-0">
                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="block w-full h-full object-cover object-right">
                    {{-- Dark mode gradient: solid dark left → transparent right --}}
                    <div class="absolute inset-0 hidden dark:block" style="background: linear-gradient(to right, rgba(10,10,10,1) 0%, rgba(10,10,10,0.85) 30%, rgba(10,10,10,0.4) 55%, transparent 75%);"></div>
                    {{-- Light mode gradient: solid light left → transparent right --}}
                    <div class="absolute inset-0 dark:hidden" style="background: linear-gradient(to right, rgba(250,250,250,0.97) 0%, rgba(250,250,250,0.88) 30%, rgba(250,250,250,0.55) 55%, transparent 75%);"></div>
                </div>

                {{-- Content container — bottom-aligned on desktop --}}
                <div class="relative z-10 h-full flex flex-col justify-end">
                    <div class="relative px-4 sm:px-8 lg:px-12 xl:px-16 pt-10 pb-16 flex flex-col justify-center flex-1">
                        {{-- Subtle decorative glow behind text --}}
                        <div class="hidden md:block absolute top-1/4 left-0 w-48 h-48 bg-orange-600/10 rounded-full blur-3xl"></div>

                        <div class="relative max-w-xl md:max-w-lg lg:max-w-xl">
                            {{-- Badge Row --}}
                            <div class="flex items-center gap-3 mb-6">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-neutral-100 dark:bg-neutral-800/80 backdrop-blur-sm text-neutral-800 dark:text-white text-[11px] font-bold rounded-full border border-neutral-300 dark:border-neutral-700/50">
                                    @if($banner->subtitle)
                                        {{ $banner->subtitle }}
                                    @else
                                        🔥 Best Seller
                                    @endif
                                </span>
                                <span class="text-sm text-neutral-500 dark:text-neutral-400 font-medium flex items-center gap-1.5">
                                    • Ramen
                                    <span class="text-neutral-400 dark:text-neutral-600">•</span> Pedas
                                    <span class="text-neutral-400 dark:text-neutral-600">•</span> Premium
                                </span>
                            </div>

                            {{-- Title --}}
                            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white leading-tight tracking-tight mb-6 drop-shadow-lg">
                                {{ $banner->title }}
                            </h1>

                            {{-- Description --}}
                            @if($banner->description)
                            <p class="text-base md:text-lg text-neutral-700 dark:text-neutral-300 max-w-lg mb-10 leading-relaxed line-clamp-3 drop-shadow">
                                {{ $banner->description }}
                            </p>
                            @endif

                            {{-- CTA Button --}}
                            @if($banner->cta_link)
                            <a href="{{ $banner->cta_link }}"
                                class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-orange-600 hover:bg-orange-500 text-white font-bold text-sm uppercase tracking-wide rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-orange-600/25 hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                                <span>{{ $banner->cta_text }}</span>
                            </a>
                            @endif

                            {{-- Pagination Dots --}}
                            <div class="flex items-center gap-2 mt-8">
                                @foreach($banners as $idx => $b)
                                <button
                                    @click="goTo({{ $idx }})"
                                    class="rounded-full transition-all duration-300"
                                    :class="current === {{ $idx }} ? 'w-6 h-2 bg-orange-500 shadow-lg shadow-orange-500/40' : 'w-2 h-2 bg-neutral-400/60 dark:bg-neutral-500/60 hover:bg-neutral-500/80 dark:hover:bg-neutral-400/80'"
                                    aria-label="Slide {{ $idx + 1 }}"
                                ></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        @else
            {{-- Fallback when no banners --}}
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
                        <a href="{{ route('client.menu') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-orange-600 hover:bg-orange-500 text-white font-bold text-lg rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-orange-600/25 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            Lihat Menu
                        </a>
                    </div>

                    @if($heroMenus->count())
                    <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl mx-auto">
                        @foreach($heroMenus as $menu)
                        <div class="group relative bg-white/90 dark:bg-neutral-900/80 backdrop-blur-sm border border-neutral-200 dark:border-neutral-800 rounded-2xl p-4 text-left hover:border-orange-600/50 transition-all duration-300 hover:-translate-y-1 shadow-sm dark:shadow-none">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-orange-600/20 flex items-center justify-center text-2xl flex-shrink-0">
                                    @if($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover rounded-xl">
                                    @else
                                        🍜
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-neutral-900 dark:text-white truncate">{{ $menu->name }}</h4>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-500 truncate">{{ $menu->category->name ?? '' }}</p>
                                </div>
                                <span class="ml-auto text-sm font-bold text-orange-600 dark:text-orange-400 flex-shrink-0">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce z-20">
                <svg class="w-6 h-6 text-neutral-400 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        @endif
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
                @forelse($featuredMenus as $menu)
                <div class="group bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden hover:border-orange-600/50 hover:shadow-lg hover:shadow-orange-600/10 transition-all duration-300 p-3 sm:pt-6 sm:pb-5 sm:px-5 relative flex flex-col items-center text-center"
                    x-data="{ added: false }">

                    {{-- Image — transparent PNG, no wrapper frame, inside card --}}
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                            class="w-24 h-24 sm:w-40 sm:h-40 object-contain group-hover:scale-110 transition-all duration-500 mb-1 sm:mb-2 drop-shadow-[0_6px_10px_rgba(0,0,0,0.15)] dark:drop-shadow-[0_10px_20px_rgba(234,88,12,0.25)]">
                    @else
                        <div class="w-24 h-24 sm:w-40 sm:h-40 flex items-center justify-center text-4xl sm:text-6xl mb-1 sm:mb-2">
                            🍜
                        </div>
                    @endif

                    {{-- Category badge (floating above image) --}}
                    <span class="absolute top-1.5 sm:top-2 left-1.5 sm:left-3 px-2 sm:px-3 py-0.5 sm:py-1 bg-white/90 dark:bg-neutral-950/80 backdrop-blur-sm text-[10px] sm:text-xs font-semibold text-orange-600 dark:text-orange-400 rounded-full border border-neutral-200 dark:border-neutral-700 z-10">
                        {{ $menu->category->name ?? 'Menu' }}
                    </span>

                    {{-- Nama Menu --}}
                    <h3 class="text-sm sm:text-lg font-bold text-neutral-900 dark:text-white mb-1 sm:mb-2 mt-1 sm:mt-2">{{ $menu->name }}</h3>

                    {{-- Deskripsi --}}
                    <p class="text-xs sm:text-sm text-neutral-500 mb-2 sm:mb-4 line-clamp-2 leading-relaxed">{{ $menu->description ?: 'Lezat, autentik, dan dibuat dengan bahan-bahan premium.' }}</p>

                    {{-- Harga --}}
                    <span class="text-base sm:text-xl font-bold text-orange-600 dark:text-orange-400 mb-2 sm:mb-4">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>

                    {{-- Tombol Tambah ke Keranjang (pill outline) --}}
                    <button type="button"
                        @click="added = true; $store.cart.addItem({{ $menu->id }}); setTimeout(() => added = false, 2000)"
                        class="inline-flex items-center gap-1 sm:gap-2 px-3 py-2 sm:px-5 sm:py-2.5 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white rounded-full transition-all duration-300 text-xs sm:text-sm font-semibold mt-auto">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        <span class="hidden sm:inline" x-text="added ? '✓ Ditambahkan' : 'Tambah ke Keranjang'">Tambah ke Keranjang</span>
                        <span class="sm:hidden" x-text="added ? '✓' : '+ Keranjang'">+ Keranjang</span>
                    </button>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-neutral-500">Menu belum tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section — Artistic 2‑Column Layout -->
    <section id="tentang-kami" class="relative py-16 md:py-24 overflow-hidden bg-white dark:bg-neutral-950"
        x-data="{ expanded: false }">
        <div class="absolute top-10 right-0 w-[28rem] h-[28rem] bg-orange-500/10 dark:bg-orange-500/5 rounded-full blur-3xl pointer-events-none translate-x-1/4 -translate-y-1/4"></div>
        <div class="absolute bottom-0 right-10 w-72 h-72 bg-amber-400/8 dark:bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- KOLOM KIRI: Badge + Headline + Deskripsi + Social Proof --}}
                <div class="order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-orange-300/60 dark:border-orange-500/30 bg-orange-50/60 dark:bg-orange-500/10 mb-6">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        <span class="text-sm font-semibold text-orange-600 dark:text-orange-400 tracking-wide">Tentang Fujiyama Ramen</span>
                    </div>

                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-neutral-900 dark:text-white leading-[1.1] mb-5">
                        {{ $about->title ?? 'Tentang Kami' }}
                    </h2>

                    @if($about->subtitle)
                    <p class="text-lg text-neutral-600 dark:text-neutral-400 max-w-md mb-6 leading-relaxed">
                        {{ $about->subtitle }}
                    </p>
                    @endif

                    @if($about->story)
                    <div class="max-w-md mb-8">
                        <div x-show="!expanded" x-transition>
                            <p class="text-neutral-600 dark:text-neutral-400 leading-relaxed line-clamp-3">
                                {{ $about->story }}
                            </p>
                            @if(strlen($about->story) > 300)
                            <button @click="expanded = true"
                                class="mt-3 inline-flex items-center gap-1.5 text-orange-500 hover:text-orange-400 font-semibold text-sm transition-colors">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            @endif
                        </div>
                        <div x-show="expanded" x-transition>
                            <p class="text-neutral-600 dark:text-neutral-400 leading-relaxed whitespace-pre-line">
                                {{ $about->story }}
                            </p>
                            <button @click="expanded = false"
                                class="mt-3 inline-flex items-center gap-1.5 text-orange-500 hover:text-orange-400 font-semibold text-sm transition-colors">
                                Sembunyikan
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @else
                    <p class="text-neutral-400 dark:text-neutral-500 italic max-w-md mb-8">
                        Cerita kami akan segera hadir di sini. ✨
                    </p>
                    @endif

                    {{-- Social Proof --}}
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-2">
                            @php $avColors = ['bg-orange-500', 'bg-amber-500', 'bg-red-400', 'bg-yellow-500']; $avInits = ['DR', 'SW', 'AR', 'NF']; @endphp
                            @foreach($avInits as $i => $init)
                            <div class="w-9 h-9 rounded-full {{ $avColors[$i] }} border-2 border-white dark:border-neutral-900 flex items-center justify-center text-[11px] font-bold text-white shadow-sm">{{ $init }}</div>
                            @endforeach
                            <div class="w-9 h-9 rounded-full bg-neutral-200 dark:bg-neutral-700 border-2 border-white dark:border-neutral-900 flex items-center justify-center text-[11px] font-bold text-neutral-500 dark:text-neutral-400 shadow-sm">+500</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-0.5 mb-0.5">
                                @for($s = 0; $s < 5; $s++)
                                <svg class="w-3.5 h-3.5 text-orange-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400">Dipercaya 500+ Pelanggan</p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: Foto Hero + Glow + Foto Overlap --}}
                <div class="order-1 lg:order-2 relative flex justify-center lg:justify-end">
                    @php
                        $heroPhoto = $aboutInterior->first() ?? $aboutGalleryAll->first();
                        $secondPhoto = $aboutInterior->skip(1)->first() ?? $aboutGalleryAll->skip(1)->first();
                    @endphp
                    @if($heroPhoto)
                    <div class="relative w-full max-w-md lg:max-w-lg">
                        <div class="relative z-10 rounded-3xl overflow-hidden"
                            style="box-shadow: 0 0 80px rgba(234,88,12,0.25), 0 0 160px rgba(234,88,12,0.08);">
                            <img src="{{ $heroPhoto->image_url }}"
                                alt="{{ $heroPhoto->caption ?? 'Interior Fujiyama Ramen' }}"
                                class="w-full aspect-[4/5] object-cover"
                                loading="lazy">
                        </div>
                        @if($secondPhoto)
                        <div class="absolute -bottom-6 -left-6 z-20 w-36 h-44 md:w-44 md:h-52 rotate-[-3deg] rounded-2xl overflow-hidden border-4 border-white dark:border-neutral-800 shadow-xl">
                            <img src="{{ $secondPhoto->image_url }}"
                                alt="{{ $secondPhoto->caption ?? 'Interior Fujiyama' }}"
                                class="w-full h-full object-cover"
                                loading="lazy">
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="relative w-full max-w-md lg:max-w-lg aspect-[4/5] rounded-3xl bg-gradient-to-br from-orange-100 to-amber-50 dark:from-neutral-800 dark:to-neutral-800/50 border border-orange-200 dark:border-neutral-700 flex items-center justify-center"
                        style="box-shadow: 0 0 80px rgba(234,88,12,0.15);">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-orange-300 dark:text-orange-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-neutral-400 dark:text-neutral-500 text-sm italic">Foto interior segera hadir 📸</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ========== GALERI FOTO SECTION — Premium Redesign ========== --}}
    <section id="galeri-foto" class="relative py-16 md:py-24 overflow-hidden bg-neutral-100 dark:bg-neutral-900/50">
    {{-- ======================================== --}}
    {{-- DECORATIVE BACKGROUND BLOBS --}}
    {{-- ======================================== --}}
    <div class="absolute -top-32 right-[10%] w-[28rem] h-[28rem] bg-orange-500/12 dark:bg-orange-500/6 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute -bottom-28 left-[5%] w-[26rem] h-[26rem] bg-amber-400/10 dark:bg-amber-500/5 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- ======================================== --}}
        {{-- SECTION HEADER — Badge + Gradient Title --}}
        {{-- ======================================== --}}
        <div class="text-center mb-10 md:mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold text-orange-600 dark:text-orange-400 bg-orange-500/10 dark:bg-orange-500/10 border border-orange-500/20 dark:border-orange-500/20 mb-4">
                📸 Momen di Fujiyama
            </span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white leading-tight tracking-tight mb-4">
                Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-orange-500 to-amber-500">Foto</span>
            </h2>
            <p class="text-neutral-600 dark:text-neutral-400 max-w-xl mx-auto text-sm md:text-base">
                Intip keseruan di balik layar — dari proses memasak hingga suasana hangat di Fujiyama Ramen.
            </p>
        </div>

        {{-- ======================================== --}}
        {{-- GALLERY GRID (reuse partial) --}}
        {{-- ======================================== --}}
        @include('client::partials.gallery-grid', ['galleries' => $allAboutGalleries])

        {{-- ======================================== --}}
        {{-- "LIHAT SEMUA FOTO" Button — only if total > 9 --}}
        {{-- ======================================== --}}
        @if($totalGalleryCount > 9)
        <div class="mt-12 text-center">
            <a href="{{ route('client.gallery') }}"
                class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold text-sm md:text-base shadow-lg shadow-orange-500/25 hover:shadow-xl hover:shadow-orange-500/30 hover:scale-[1.03] transition-all duration-300 hover:-translate-y-0.5">
                <span>Lihat Semua Foto</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
                <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-white/20 text-xs font-semibold ml-1">
                    {{ $totalGalleryCount }}+
                </span>
            </a>
        </div>
        @endif
    </div>
</section>

    {{-- ========== LOKASI & JAM BUKA SECTION ========== --}}
    @php
        $isOpen = $setting->isOpen();
        $todaySchedule = $setting->todaySchedule();
        $days = [
            'senin' => 'Senin', 'selasa' => 'Selasa', 'rabu' => 'Rabu',
            'kamis' => 'Kamis', 'jumat' => 'Jumat', 'sabtu' => 'Sabtu', 'minggu' => 'Minggu',
        ];
        $dayKeys = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        $today = $dayKeys[(int) now()->dayOfWeek];
        $todayLabel = $days[$today];
        $openingHours = $setting->opening_hours;
        if (is_string($openingHours)) {
            $openingHours = json_decode($openingHours, true) ?? [];
        }
        $todayFullSchedule = $openingHours[$today] ?? '—';
    @endphp

    <section id="lokasi" class="relative overflow-hidden"
        x-data="{ hoursExpanded: false }">

        {{-- ========================================== --}}
        {{-- MOBILE: Ride-share UI — Full-bleed Map + Floating Overlay + Bottom Sheet --}}
        {{-- ========================================== --}}
        <div class="md:hidden">
            {{-- Full-bleed Map --}}
            <div class="relative w-full h-80">
                @if($setting->google_maps_embed_url)
                    <iframe src="{{ $setting->google_maps_embed_url }}"
                        width="100%" height="100%"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full"></iframe>
                @else
                    <div class="w-full h-full bg-neutral-200 dark:bg-neutral-800 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto text-neutral-400 dark:text-neutral-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            <p class="text-neutral-400 dark:text-neutral-500 text-xs">Peta segera tersedia</p>
                        </div>
                    </div>
                @endif

                {{-- Floating Overlay (map top-left) — Liquid Glass status badge + greeting --}}
                <div class="absolute top-3 left-3 right-3 pointer-events-none">
                    <div class="flex flex-col gap-2">
                        {{-- Open/Close Badge --}}
                        <span class="inline-flex items-center gap-1.5 self-start px-3 py-1.5 rounded-full text-xs font-bold backdrop-blur-xl
                            {{ $isOpen
                                ? 'bg-green-500/20 text-green-100 border border-green-400/30'
                                : 'bg-neutral-800/30 text-neutral-300 border border-neutral-500/30' }}">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $isOpen ? 'bg-green-400' : 'bg-neutral-500' }} opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 {{ $isOpen ? 'bg-green-400' : 'bg-neutral-500' }}"></span>
                            </span>
                            {{ $isOpen ? '🟢 Sedang Buka' : '⚫ Sedang Tutup' }}
                        </span>
                        {{-- Greeting text --}}
                        <p class="text-white text-sm font-semibold drop-shadow-lg">
                            Kunjungi Fujiyama Ramen 🍜
                        </p>
                    </div>
                </div>
            </div>

                {{-- ========================================== --}}
                {{-- BOTTOM SHEET — Gradient Glass (flush to edges, rounded top only, overlaps map) --}}
                {{-- ========================================== --}}
                <div class="relative z-10 -mt-12 px-5 pt-5 pb-6
                    bg-gradient-to-br from-white via-orange-50/60 to-amber-50/40 dark:bg-gradient-to-br dark:from-neutral-900 dark:via-neutral-900 dark:to-orange-950/30
                    backdrop-blur-xl
                    border border-orange-200/30 dark:border-orange-500/10
                    rounded-t-3xl
                    shadow-xl shadow-black/5 dark:shadow-black/30">
                    {{-- Handle Bar --}}
                    <div class="flex justify-center mb-5">
                        <div class="w-10 h-1 bg-neutral-300/80 dark:bg-neutral-600/80 rounded-full"></div>
                    </div>

                    {{-- 3 Info Cards — stacked glass layers --}}
                    <div class="space-y-4">
                        {{-- Card 1: Alamat --}}
                        <div class="flex gap-4 p-4 bg-gradient-to-br from-white/80 to-orange-50/40 dark:from-neutral-800/80 dark:to-neutral-900/40 backdrop-blur-sm rounded-xl border border-orange-200/20 dark:border-orange-500/10">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white shadow-md shadow-orange-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs font-semibold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-1">Alamat</h4>
                                <p class="text-sm text-neutral-800 dark:text-neutral-200 leading-relaxed">
                                    {{ $setting->address ?? 'Alamat restoran akan segera ditambahkan.' }}
                                </p>
                            </div>
                        </div>

                        {{-- Card 2: Telepon --}}
                        @if($setting->phone)
                        <div class="flex gap-4 p-4 bg-gradient-to-br from-white/80 to-orange-50/40 dark:from-neutral-800/80 dark:to-neutral-900/40 backdrop-blur-sm rounded-xl border border-orange-200/20 dark:border-orange-500/10">
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white shadow-md shadow-orange-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs font-semibold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-1">Telepon</h4>
                                <a href="tel:{{ $setting->phone }}" class="text-orange-600 dark:text-orange-400 font-semibold text-sm hover:underline transition">
                                    {{ $setting->phone }}
                                </a>
                            </div>
                        </div>
                        @endif

                        {{-- Card 3: Jam Operasional (Hari Ini + Accordion) --}}
                        <div class="p-4 bg-gradient-to-br from-white/80 to-orange-50/40 dark:from-neutral-800/80 dark:to-neutral-900/40 backdrop-blur-sm rounded-xl border border-orange-200/20 dark:border-orange-500/10">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white shadow-md shadow-orange-500/30">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-xs font-semibold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-1">Jam Buka</h4>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $todayLabel }} — Hari Ini</p>
                                            @php $isClosed = (mb_strtolower(trim($todayFullSchedule)) === 'tutup'); @endphp
                                            <p class="text-sm font-bold {{ $isClosed ? 'text-red-500 dark:text-red-400' : 'text-neutral-800 dark:text-white' }}">
                                                {{ $todayFullSchedule }}
                                            </p>
                                        </div>
                                        <button @click="hoursExpanded = !hoursExpanded"
                                            class="flex items-center gap-1 text-xs font-medium text-orange-500 hover:text-orange-400 transition-colors flex-shrink-0">
                                            <span x-text="hoursExpanded ? 'Sembunyikan' : 'Lihat jam lengkap'">Lihat jam lengkap</span>
                                            <svg class="w-3.5 h-3.5 transition-transform duration-300" :class="hoursExpanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- Accordion: Full 7-day schedule --}}
                                    <div x-show="hoursExpanded" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-3 pt-3 border-t border-neutral-200/60 dark:border-neutral-700/60">
                                        <div class="space-y-1.5">
                                            @foreach($days as $key => $label)
                                                @php
                                                    $isToday = ($key === $today);
                                                    $schedule = $openingHours[$key] ?? '—';
                                                    $dayIsClosed = (mb_strtolower(trim($schedule)) === 'tutup');
                                                @endphp
                                                <div class="flex items-center justify-between py-1 px-2 rounded text-xs
                                                    {{ $isToday ? 'bg-orange-50 dark:bg-orange-900/20 font-semibold' : '' }}">
                                                    <span class="{{ $isToday ? 'text-orange-600 dark:text-orange-400' : 'text-neutral-500 dark:text-neutral-400' }}">
                                                        {{ $label }}
                                                        @if($isToday)<span class="ml-1 text-[10px]">• Hari Ini</span>@endif
                                                    </span>
                                                    <span class="{{ $isToday ? 'text-neutral-900 dark:text-white' : 'text-neutral-600 dark:text-neutral-300' }} {{ $dayIsClosed ? 'text-red-500 dark:text-red-400' : '' }}">
                                                        {{ $schedule }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{-- ========================================== --}}
        {{-- DESKTOP: Full-Width Map + Single Floating Combined Card (Status + Address + Phone + Schedule) --}}
        {{-- ========================================== --}}
        @php
            // Calculate progress percentage through today's operating hours
            $progressPercent = 0;
            $showProgress = false;
            $todayIsClosedDay = (mb_strtolower(trim($todayFullSchedule)) === 'tutup');
            if (!$todayIsClosedDay && preg_match('/(\d{1,2}):(\d{2})\s*-\s*(\d{1,2}):(\d{2})/', $todayFullSchedule, $matches)) {
                $openHour = (int)$matches[1];
                $openMin = (int)$matches[2];
                $closeHour = (int)$matches[3];
                $closeMin = (int)$matches[4];
                $openTotal = $openHour * 60 + $openMin;
                $closeTotal = $closeHour * 60 + $closeMin;
                if ($closeTotal <= $openTotal) $closeTotal += 1440; // crosses midnight
                $nowTotal = (int)now()->format('H') * 60 + (int)now()->format('i');
                if ($nowTotal < $openTotal) $nowTotal += 1440;
                $totalMinutes = $closeTotal - $openTotal;
                $elapsed = max(0, $nowTotal - $openTotal);
                $progressPercent = $totalMinutes > 0 ? min(100, round(($elapsed / $totalMinutes) * 100)) : 0;
                $showProgress = $isOpen;
            }
        @endphp
        <div class="hidden md:block py-16 md:py-24">
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Section Header --}}
                <div class="text-center mb-10">
                    <span class="inline-block text-orange-500 font-semibold text-sm tracking-widest uppercase mb-2">Kunjungi Kami</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white">
                        Lokasi & Jam Buka
                    </h2>
                    <div class="mt-3 mx-auto w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-400 rounded-full"></div>
                </div>

                {{-- ========================================== --}}
                {{-- MAP: Full Width with Floating Status Card Overlay --}}
                {{-- ========================================== --}}
                <div class="relative">
                    @if($setting->google_maps_embed_url)
                        <div class="relative w-full h-96 lg:h-[28rem] rounded-3xl overflow-hidden border border-neutral-200/40 dark:border-neutral-700/30 shadow-2xl shadow-neutral-300/20 dark:shadow-black/30">
                            <iframe src="{{ $setting->google_maps_embed_url }}"
                                width="100%" height="100%"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="w-full h-full saturate-[1.05]"></iframe>
                            {{-- Subtle gradient overlay at bottom for depth --}}
                            <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-black/15 to-transparent pointer-events-none"></div>
                        </div>
                    @else
                        <div class="relative w-full h-96 lg:h-[28rem] rounded-3xl overflow-hidden border border-dashed border-neutral-300 dark:border-neutral-600 bg-neutral-100 dark:bg-neutral-800/50 flex items-center justify-center">
                            <div class="text-center p-8">
                                <svg class="w-16 h-16 mx-auto text-neutral-300 dark:text-neutral-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                </svg>
                                <p class="text-neutral-400 dark:text-neutral-500 text-sm italic">Peta akan segera tersedia</p>
                            </div>
                        </div>
                    @endif

                    {{-- ========================================== --}}
                    {{-- FLOATING CARD: Combined — Status + Address + Phone + Schedule — top-right over map --}}
                    {{-- ========================================== --}}
                    <div class="absolute top-4 right-4 z-20 w-[calc(100%-2rem)] max-w-[320px]
                        bg-white/80 dark:bg-neutral-900/80
                        backdrop-blur-md
                        border border-neutral-200/40 dark:border-white/[0.06]
                        rounded-2xl
                        shadow-lg shadow-black/10 dark:shadow-black/30
                        p-4
                        [text-shadow:0_1px_2px_rgba(0,0,0,0.06)]">

                        {{-- Compact Header: Icon + Title + Status Badge --}}
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white shadow-sm shadow-orange-500/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="text-xs font-bold text-neutral-900 dark:text-white drop-shadow-[0_1px_2px_rgba(0,0,0,0.05)]">Status Hari Ini</h4>
                            </div>
                            {{-- BUKA / TUTUP Badge --}}
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold
                                {{ $isOpen
                                    ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 border border-green-300/50 dark:border-green-600/50'
                                    : 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 border border-red-300/50 dark:border-red-600/50' }}">
                                <span class="relative flex h-1.5 w-1.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $isOpen ? 'bg-green-500' : 'bg-red-500' }} opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 {{ $isOpen ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                </span>
                                {{ $isOpen ? 'BUKA' : 'TUTUP' }}
                            </span>
                        </div>

                        {{-- Today's Schedule --}}
                        <div class="mb-3 drop-shadow-[0_1px_2px_rgba(0,0,0,0.05)]">
                            <p class="text-[10px] text-neutral-400 dark:text-neutral-500 mb-0.5">{{ $todayLabel }} — Hari Ini</p>
                            <p class="text-sm font-bold {{ $todayIsClosedDay ? 'text-red-500 dark:text-red-400' : 'text-orange-600 dark:text-orange-400' }}">
                                {{ $todayFullSchedule }}
                            </p>
                        </div>

                        {{-- Progress Bar / Closed Alert --}}
                        @if($showProgress)
                        <div class="space-y-1.5 mb-3">
                            <div class="flex justify-between items-center text-[10px] text-neutral-500 dark:text-neutral-400">
                                <span>Progress</span>
                                <span class="font-bold text-orange-600 dark:text-orange-400">{{ $progressPercent }}%</span>
                            </div>
                            <div class="relative w-full h-2 bg-neutral-200/80 dark:bg-neutral-700/80 rounded-full overflow-hidden">
                                <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-orange-500 to-orange-400 rounded-full transition-all duration-700 ease-out"
                                    style="width: {{ $progressPercent }}%">
                                </div>
                                <div class="absolute top-1/2 -translate-y-1/2 transition-all duration-700 ease-out"
                                    style="left: calc({{ $progressPercent }}% - 6px)">
                                    <span class="text-xs leading-none drop-shadow-sm">🍜</span>
                                </div>
                            </div>
                        </div>
                        @elseif($todayIsClosedDay)
                        <div class="flex items-center gap-1.5 p-2 rounded-lg bg-red-50/50 dark:bg-red-900/10 border border-red-200/20 dark:border-red-800/20 mb-3">
                            <svg class="w-3.5 h-3.5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-[10px] text-red-600 dark:text-red-400">Tutup hari ini</span>
                        </div>
                        @else
                        <div class="flex items-center gap-1.5 p-2 rounded-lg bg-orange-50/50 dark:bg-orange-900/10 border border-orange-200/20 dark:border-orange-800/20 mb-3">
                            <svg class="w-3.5 h-3.5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-[10px] text-orange-600 dark:text-orange-400">Di luar jam operasional</span>
                        </div>
                        @endif

                        {{-- ========== Divider ========== --}}
                        <div class="border-t border-neutral-200/30 dark:border-neutral-700/30 my-3"></div>

                        {{-- ========== Address Row ========== --}}
                        <div class="flex items-start gap-2 mb-2.5 drop-shadow-[0_1px_2px_rgba(0,0,0,0.05)]">
                            <svg class="w-3.5 h-3.5 text-neutral-400 dark:text-neutral-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400 leading-snug line-clamp-2">
                                {{ $setting->address ?? 'Alamat akan segera ditambahkan.' }}
                            </p>
                        </div>

                        {{-- ========== Phone Row ========== --}}
                        <div class="flex items-center gap-2 mb-3 drop-shadow-[0_1px_2px_rgba(0,0,0,0.05)]">
                            <svg class="w-3.5 h-3.5 text-neutral-400 dark:text-neutral-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            @if($setting->phone)
                            <a href="tel:{{ $setting->phone }}" class="text-xs text-orange-600 dark:text-orange-400 font-medium hover:underline transition">
                                {{ $setting->phone }}
                            </a>
                            @else
                            <span class="text-xs text-neutral-500 dark:text-neutral-400">—</span>
                            @endif
                        </div>

                        {{-- ========== Divider ========== --}}
                        <div class="border-t border-neutral-200/30 dark:border-neutral-700/30 my-3"></div>

                        {{-- ========== Full Schedule Toggle ========== --}}
                        <button @click="hoursExpanded = !hoursExpanded"
                            class="w-full flex items-center justify-center gap-1.5 text-[10px] font-medium text-orange-600 dark:text-orange-400 hover:bg-orange-50 dark:hover:bg-orange-900/20 rounded-lg py-1.5 transition-colors drop-shadow-[0_1px_2px_rgba(0,0,0,0.05)]">
                            <span x-text="hoursExpanded ? 'Sembunyikan Jam Lengkap' : 'Lihat Jam Lengkap'">Lihat Jam Lengkap</span>
                            <svg class="w-3 h-3 transition-transform duration-300" :class="hoursExpanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Full 7-Day Schedule — Compact 2-Column Grid --}}
                        <div x-show="hoursExpanded"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mt-3 pt-3 border-t border-neutral-200/30 dark:border-neutral-700/30">
                            <div class="grid grid-cols-2 gap-1">
                                @foreach($days as $key => $label)
                                    @php
                                        $isDayToday = ($key === $today);
                                        $schedule = $openingHours[$key] ?? '—';
                                        $dayIsClosed = (mb_strtolower(trim($schedule)) === 'tutup');
                                    @endphp
                                    <div class="flex items-center justify-between py-1 px-1.5 rounded text-[10px] leading-tight
                                        {{ $isDayToday ? 'bg-orange-50 dark:bg-orange-900/20 font-semibold' : '' }}">
                                        <span class="mr-1 {{ $isDayToday ? 'text-orange-600 dark:text-orange-400' : 'text-neutral-400 dark:text-neutral-500' }} truncate">
                                            {{ Str::limit($label, 3, '') }}
                                            @if($isDayToday)<span class="text-[8px] opacity-70">★</span>@endif
                                        </span>
                                        <span class="text-right {{ $isDayToday ? 'text-neutral-900 dark:text-white' : 'text-neutral-500 dark:text-neutral-400' }} {{ $dayIsClosed ? 'text-red-500 dark:text-red-400' : '' }}">
                                            {{ $schedule }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== TESTIMONIAL SECTION — Dark Themed, Blurred Photo Decor, Carousel ========== --}}
    {{-- Always dark section: bg-neutral-900 (light mode) / bg-neutral-950 (dark mode) — intentional spotlight effect --}}
    <section
        x-data="{ active: 0, desktopPage: 0, totalItems: {{ $testimonials->count() }}, totalPages: {{ $testimonialPages->count() }} }"
        class="relative py-16 md:py-28 overflow-hidden bg-neutral-900 dark:bg-neutral-950"
    >
        {{-- ======================================== --}}
        {{-- DECORATIVE: Blurred Customer Photos --}}
        {{-- ======================================== --}}
        @if($testimonials->count())
            @php
                $blurPhotos = $testimonials->filter(fn($t) => $t->customer_photo_url)->values();
            @endphp
            @if($blurPhotos->count())
                <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
                    {{-- Top-left (always shown) --}}
                    @if($blurPhotos->get(0))
                    <div class="absolute -top-8 left-[4%] w-40 md:w-64 h-40 md:h-64 rounded-2xl overflow-hidden opacity-25 md:opacity-30 -rotate-6 blur-xl grayscale">
                        <img src="{{ $blurPhotos[0]->customer_photo_url }}" alt="" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <span class="absolute top-[100px] md:top-[130px] left-[10%] text-white/20 text-[10px] font-medium rotate-[-6deg] hidden md:block">{{ $blurPhotos[0]->customer_name }}</span>
                    @endif
                    {{-- Center-right (hidden on mobile, shown md+) --}}
                    @if($blurPhotos->get(1))
                    <div class="absolute top-1/3 right-[3%] w-40 md:w-56 h-40 md:h-56 rounded-2xl overflow-hidden opacity-20 md:opacity-25 rotate-3 blur-xl grayscale hidden md:block">
                        <img src="{{ $blurPhotos[1]->customer_photo_url }}" alt="" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <span class="absolute top-[55%] right-[15%] text-white/20 text-[10px] font-medium rotate-[3deg] hidden md:block">{{ $blurPhotos[1]->customer_name }}</span>
                    @endif
                    {{-- Bottom-left (hidden on mobile, shown md+) --}}
                    @if($blurPhotos->get(2))
                    <div class="absolute bottom-[15%] left-[15%] w-36 md:w-48 h-36 md:h-48 rounded-2xl overflow-hidden opacity-20 blur-xl grayscale rotate-12 hidden md:block">
                        <img src="{{ $blurPhotos[2]->customer_photo_url }}" alt="" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    @endif
                    {{-- Top center variant (lg+ only) --}}
                    @if($blurPhotos->get(3))
                    <div class="absolute top-[10%] right-[25%] w-32 md:w-44 h-32 md:h-44 rounded-2xl overflow-hidden opacity-20 -rotate-12 blur-xl grayscale hidden lg:block">
                        <img src="{{ $blurPhotos[3]->customer_photo_url }}" alt="" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    @endif
                </div>
            @endif
        @endif

        {{-- Subtle grain / texture overlay --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(249,115,22,0.03)_0%,_transparent_70%)] pointer-events-none" aria-hidden="true"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- ======================================== --}}
            {{-- HEADLINE — BESAR dengan 1 KATA BERAKSEN --}}
            {{-- ======================================== --}}
            <div class="text-center mb-14 md:mb-20">
                <h2 class="text-3xl md:text-5xl lg:text-6xl font-black font-['Noto_Sans_JP'] text-white leading-tight tracking-tight">
                    Apa Kata <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-orange-500 to-amber-500">Pelanggan</span> Kami
                </h2>
                <p class="mt-4 text-neutral-400 max-w-xl mx-auto text-sm md:text-base">
                    Setiap mangkuk punya cerita, setiap tegukan sarat kenangan.
                </p>
            </div>

            @if($testimonials->count())
                {{-- ======================================== --}}
                {{-- MOBILE: Single Card Carousel — absolute-overlap (fixes layout-flow jump) --}}
                {{-- ======================================== --}}
                <div class="lg:hidden relative min-h-[380px]">
                    @foreach($testimonials as $i => $testimonial)
                    <div
                        class="absolute inset-0 transition-opacity duration-300"
                        :class="active === {{ $i }} ? 'opacity-100' : 'opacity-0 pointer-events-none'"
                    >
                        {{-- Reusable Card — same structure as desktop --}}
                        <div class="relative bg-neutral-900/60 backdrop-blur-xl border border-white/10 rounded-2xl p-6 md:p-8">
                            {{-- Quote Mark — top right --}}
                            <span class="absolute top-4 right-5 text-6xl md:text-7xl font-['Noto_Sans_JP'] text-orange-500 leading-none select-none" aria-hidden="true">&ldquo;</span>

                            {{-- Stars --}}
                            <div class="flex gap-0.5 mb-4 relative z-10">
                                @for($j = 1; $j <= 5; $j++)
                                    <svg class="w-5 h-5 {{ $j <= $testimonial->rating ? 'text-yellow-400' : 'text-neutral-700' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>

                            {{-- Review Text --}}
                            <p class="text-neutral-300 leading-relaxed mb-6 min-h-[80px] relative z-10 line-clamp-5">
                                "{{ $testimonial->review }}"
                            </p>

                            {{-- Customer Info --}}
                            <div class="flex items-center gap-3 pt-5 border-t border-white/10">
                                @if($testimonial->customer_photo_url)
                                    <img src="{{ $testimonial->customer_photo_url }}" alt="{{ $testimonial->customer_name }}"
                                        class="w-10 h-10 rounded-full object-cover ring-2 ring-orange-500/50">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold text-sm ring-2 ring-orange-500/50">
                                        {{ $testimonial->initials }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-white text-sm">{{ $testimonial->customer_name }}</p>
                                    @if($testimonial->order_type)
                                        <p class="text-xs text-neutral-500">Pesan: {{ $testimonial->order_type }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- ======================================== --}}
                {{-- DESKTOP: Paginated 3-Card Grid (lg+) — absolute-overlap (fixes layout-flow jump) --}}
                {{-- ======================================== --}}
                <div class="hidden lg:block relative lg:min-h-[340px]">
                    @foreach($testimonialPages as $pageIdx => $page)
                    <div
                        class="absolute inset-0 grid grid-cols-3 gap-6 transition-opacity duration-300"
                        :class="desktopPage === {{ $pageIdx }} ? 'opacity-100' : 'opacity-0 pointer-events-none'"
                    >
                        @foreach($page as $testimonial)
                        <div class="relative bg-neutral-900/60 backdrop-blur-xl border border-white/10 rounded-2xl p-8 hover:border-orange-500/20 transition-all duration-300">
                            {{-- Quote Mark — top right --}}
                            <span class="absolute top-4 right-5 text-6xl md:text-7xl font-['Noto_Sans_JP'] text-orange-500 leading-none select-none" aria-hidden="true">&ldquo;</span>

                            {{-- Stars --}}
                            <div class="flex gap-0.5 mb-4 relative z-10">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-neutral-700' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>

                            {{-- Review Text --}}
                            <p class="text-neutral-300 leading-relaxed mb-6 min-h-[100px] relative z-10 line-clamp-5">
                                "{{ $testimonial->review }}"
                            </p>

                            {{-- Customer Info --}}
                            <div class="flex items-center gap-3 pt-5 border-t border-white/10">
                                @if($testimonial->customer_photo_url)
                                    <img src="{{ $testimonial->customer_photo_url }}" alt="{{ $testimonial->customer_name }}"
                                        class="w-10 h-10 rounded-full object-cover ring-2 ring-orange-500/50">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold text-sm ring-2 ring-orange-500/50">
                                        {{ $testimonial->initials }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-white text-sm">{{ $testimonial->customer_name }}</p>
                                    @if($testimonial->order_type)
                                        <p class="text-xs text-neutral-500">Pesan: {{ $testimonial->order_type }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>

                {{-- ======================================== --}}
                {{-- MOBILE PAGINATION DOTS — Bottom-Right (below lg) --}}
                {{-- ======================================== --}}
                @if($testimonials->count() > 1)
                <div class="flex justify-end items-center gap-2 mt-10 mb-4 lg:hidden">
                    @foreach($testimonials as $idx => $t)
                    <button
                        @click="active = {{ $idx }}"
                        class="rounded-full transition-all duration-300"
                        :class="active === {{ $idx }} ? 'w-6 h-2 bg-orange-500 shadow-lg shadow-orange-500/40' : 'w-2 h-2 bg-neutral-600 hover:bg-neutral-500'"
                        aria-label="Testimoni {{ $idx + 1 }}"
                    ></button>
                    @endforeach
                </div>
                @endif

                {{-- ======================================== --}}
                {{-- DESKTOP PAGINATION DOTS — Bottom-Right (lg+) --}}
                {{-- ======================================== --}}
                @if($testimonialPages->count() > 1)
                <div class="hidden lg:flex justify-end items-center gap-2 mt-10 mb-4">
                    @foreach($testimonialPages as $idx => $page)
                    <button
                        @click="desktopPage = {{ $idx }}"
                        class="rounded-full transition-all duration-300"
                        :class="desktopPage === {{ $idx }} ? 'w-6 h-2 bg-orange-500 shadow-lg shadow-orange-500/40' : 'w-2 h-2 bg-neutral-600 hover:bg-neutral-500'"
                        aria-label="Halaman Testimoni {{ $idx + 1 }}"
                    ></button>
                    @endforeach
                </div>
                @endif
            @else
                {{-- Empty State — tetap dark theme --}}
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-orange-500/10 text-orange-500 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <p class="text-neutral-500 italic">
                        Testimoni pelanggan akan segera hadir di sini. 💬
                    </p>
                </div>
            @endif
        </div>
    </section>

    {{-- ======================================== --}}
    {{-- EVENTS & PROMO SECTION — Hero Banner + Floating Tab Navigation --}}
    {{-- ======================================== --}}
    @if($events->count())
    <section class="py-16 md:py-20 bg-neutral-100 dark:bg-neutral-900/50"
        x-data="{
            activeEventIndex: 0,
            transition: false,
            switchEvent(index) {
                if (index === this.activeEventIndex) return;
                this.transition = true;
                setTimeout(() => {
                    this.activeEventIndex = index;
                    this.transition = false;
                }, 150);
            }
        }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-10">
                <span class="inline-block text-xs font-bold text-orange-500 uppercase tracking-[0.2em] mb-3">Event & Promo</span>
                <h2 class="text-3xl md:text-4xl font-black text-neutral-900 dark:text-white">
                    Jangan Lewatkan Keseruannya!
                </h2>
                <p class="text-neutral-600 dark:text-neutral-400 mt-3 max-w-xl mx-auto">
                    Ikuti event spesial dan promo menarik dari Fujiyama Ramen.
                </p>
            </div>

            {{-- HERO BANNER CONTAINER --}}
            <div class="relative w-full rounded-2xl md:rounded-3xl overflow-hidden h-64 md:h-96 shadow-2xl shadow-black/20">
                @foreach($events as $index => $event)
                <div class="absolute inset-0 transition-all duration-500 ease-in-out"
                    :class="activeEventIndex === {{ $index }}
                        ? 'opacity-100 visible z-10'
                        : 'opacity-0 invisible z-0'">
                    {{-- Hero Image --}}
                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                        class="absolute inset-0 w-full h-full object-cover">

                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/20"></div>

                    {{-- Content --}}
                    <div class="absolute inset-0 p-6 md:p-10 flex flex-col justify-end">
                        {{-- Badge Discount/Promo --}}
                        @if($event->discount_promo)
                        <span class="inline-block px-3 py-1 mb-3 bg-orange-500 text-white text-xs md:text-sm font-bold rounded-full w-fit shadow-lg shadow-orange-500/30">
                            {{ $event->discount_promo }}
                        </span>
                        @endif


                        {{-- Title --}}
                        <h3 class="text-xl md:text-3xl lg:text-4xl font-black text-white mb-2 leading-tight">
                            {{ $event->title }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-neutral-300 text-sm md:text-base leading-relaxed line-clamp-2 md:line-clamp-3 max-w-xl">
                            {{ $event->description }}
                        </p>

                        {{-- Date --}}
                        <div class="flex items-center gap-2 mt-3 text-xs md:text-sm text-neutral-400">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $event->start_date->format('d M Y') }} — {{ $event->end_date->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- FLOATING WHITE CONTAINER — Event Tabs --}}
            <div class="relative mx-2 md:mx-4 -mt-6 z-20">
                <div class="bg-white dark:bg-neutral-900 rounded-xl md:rounded-2xl shadow-xl shadow-black/15 border border-neutral-200 dark:border-neutral-700/50 overflow-hidden">
                    <div class="flex items-center overflow-x-auto scrollbar-hide py-3 pl-3 pr-5 sm:pr-6 gap-2 md:gap-3">
                        @foreach($events as $index => $event)
                        <button @click="switchEvent({{ $index }})"
                            class="flex-shrink-0 flex flex-col items-start px-4 py-2 md:px-5 md:py-3 rounded-xl transition-all duration-300 border min-w-[140px] md:min-w-[180px]"
                            :class="activeEventIndex === {{ $index }}
                                ? 'bg-orange-500 border-orange-500 text-white shadow-lg shadow-orange-500/25'
                                : 'bg-neutral-100 dark:bg-neutral-800 border-transparent text-neutral-600 dark:text-neutral-400 hover:bg-neutral-200 dark:hover:bg-neutral-700/80 hover:border-neutral-300 dark:hover:border-neutral-600'">
                            {{-- Event Title (truncated) --}}
                            <span class="text-sm md:text-base font-bold truncate w-full text-left"
                                :class="activeEventIndex === {{ $index }} ? 'text-white' : ''">
                                {{ $event->title }}
                            </span>
                            {{-- Additional Info --}}
                            <span class="text-xs mt-0.5"
                                :class="activeEventIndex === {{ $index }} ? 'text-orange-100' : 'text-neutral-400 dark:text-neutral-500'">
                                @if($event->discount_promo)
                                    🏷️ {{ $event->discount_promo }} ·
                                @endif
                                {{ $event->start_date->format('d M') }} — {{ $event->end_date->format('d M') }}
                            </span>
                        </button>
                        @endforeach

                        {{-- "Lihat Semua Event & Promo" CTA — di kanan setelah tab event --}}
                        <a href="{{ route('client.events') }}"
                            class="flex-shrink-0 flex items-center gap-1 px-3 py-2 md:px-5 md:py-3 rounded-xl border border-orange-400/60 dark:border-orange-500/40 text-orange-600 dark:text-orange-400 hover:text-white hover:bg-orange-500 dark:hover:bg-orange-500 transition-all duration-300 text-xs sm:text-sm font-semibold ml-auto whitespace-nowrap">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ========== FAQ SECTION — Split View with Liquid Glass ========== --}}
    <section id="faq" class="relative py-16 md:py-24 overflow-hidden"
        x-data="{ selectedFaq: 0 }">
        {{--
        ========================================
        DECORATIVE BACKGROUND — Gradient + Blobs + Dots
        ========================================
        --}}
        {{-- 1. Gradient base layer (light: warm pastel, dark: deep with warm glow) --}}
        <div class="absolute inset-0 pointer-events-none">
            {{-- Light mode gradient --}}
            <div class="absolute inset-0 dark:hidden bg-gradient-to-br from-orange-50 via-amber-50/80 to-white"></div>
            {{-- Dark mode: radial warm glows on deep base --}}
            <div class="absolute inset-0 hidden dark:block bg-neutral-950">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_30%_20%,rgba(251,146,60,0.08)_0%,transparent_60%)]"></div>
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_70%_80%,rgba(251,146,60,0.06)_0%,transparent_50%)]"></div>
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_50%,rgba(234,88,12,0.04)_0%,transparent_70%)]"></div>
            </div>
        </div>

        {{-- 2. Large soft glow blobs (behind liquid glass container) — 3 blobs positioned at corners/mid --}}
        {{-- Blob 1: Top-right, warm orange --}}
        <div class="absolute -top-24 -right-24 w-[28rem] h-[28rem] bg-orange-500/20 dark:bg-orange-500/8 rounded-full blur-3xl pointer-events-none"></div>
        {{-- Blob 2: Bottom-left, amber --}}
        <div class="absolute -bottom-32 -left-32 w-[32rem] h-[32rem] bg-amber-400/15 dark:bg-amber-500/6 rounded-full blur-3xl pointer-events-none"></div>
        {{-- Blob 3: Center-right (desktop only), soft coral --}}
        <div class="absolute top-1/3 -right-16 w-80 h-80 bg-orange-400/10 dark:bg-orange-600/5 rounded-full blur-3xl pointer-events-none hidden lg:block"></div>

        {{-- 3. Decorative small dots scattered around (particles) --}}
        {{-- Light mode dots --}}
        <div class="absolute top-16 left-[5%] w-2.5 h-2.5 bg-orange-400/30 rounded-full pointer-events-none dark:hidden"></div>
        <div class="absolute top-1/3 right-[8%] w-2 h-2 bg-amber-500/25 rounded-full pointer-events-none dark:hidden"></div>
        <div class="absolute bottom-24 left-[12%] w-3 h-3 bg-orange-300/35 rounded-full pointer-events-none dark:hidden"></div>
        <div class="absolute bottom-16 right-[4%] w-2 h-2 bg-orange-400/20 rounded-full pointer-events-none dark:hidden"></div>
        <div class="absolute top-[55%] left-[3%] w-1.5 h-1.5 bg-yellow-400/30 rounded-full pointer-events-none dark:hidden"></div>
        {{-- Dark mode dots (more subtle) --}}
        <div class="absolute top-20 left-[7%] w-2 h-2 bg-orange-400/15 rounded-full pointer-events-none hidden dark:block"></div>
        <div class="absolute top-[40%] right-[10%] w-1.5 h-1.5 bg-amber-400/12 rounded-full pointer-events-none hidden dark:block"></div>
        <div class="absolute bottom-32 left-[15%] w-2.5 h-2.5 bg-orange-500/10 rounded-full pointer-events-none hidden dark:block"></div>
        <div class="absolute bottom-20 right-[6%] w-1.5 h-1.5 bg-orange-300/12 rounded-full pointer-events-none hidden dark:block"></div>
        <div class="absolute top-[60%] left-[2%] w-2 h-2 bg-orange-400/10 rounded-full pointer-events-none hidden dark:block"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- ===== LIQUID GLASS CONTAINER ===== --}}
            <div class="rounded-3xl bg-white/70 dark:bg-neutral-900/60 backdrop-blur-2xl border border-black/5 dark:border-white/10 shadow-xl shadow-black/5 dark:shadow-black/20 p-6 md:p-10">
                {{-- Section Header --}}
                <div class="text-center mb-10 md:mb-12">
                    <span class="inline-block text-orange-500 font-semibold text-sm tracking-widest uppercase mb-2">
                        Pertanyaan yang Sering Diajukan
                    </span>
                    <h2 class="text-3xl md:text-5xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white">
                        FAQ
                    </h2>
                    <div class="mt-3 mx-auto w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-400 rounded-full"></div>
                    <p class="mt-4 text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto">
                        Semua yang perlu kamu tahu sebelum berkunjung ke Fujiyama Ramen.
                    </p>
                </div>

                @if($faqs->count())
                    {{-- ===== MOBILE LAYOUT: Inline Accordion (below md) ===== --}}
                    <div class="md:hidden space-y-3">
                        @foreach($faqs as $index => $faq)
                        <div class="rounded-2xl overflow-hidden transition-all duration-300"
                            :class="selectedFaq === {{ $index }}
                                ? 'bg-orange-500/10 dark:bg-orange-500/10 border border-orange-500/30'
                                : 'bg-neutral-100/80 dark:bg-neutral-800/50 border border-transparent'">
                            <button @click="selectedFaq = selectedFaq === {{ $index }} ? -1 : {{ $index }}"
                                class="w-full flex items-center justify-between gap-3 p-4 text-left transition-all duration-300 group"
                                :class="selectedFaq === {{ $index }}
                                    ? 'text-orange-600 dark:text-orange-400'
                                    : 'text-neutral-700 dark:text-neutral-300'">
                                <span class="text-sm font-semibold leading-snug pr-2">
                                    {{ $faq->question }}
                                </span>
                                <svg class="w-4 h-4 flex-shrink-0 transition-transform duration-300"
                                    :class="selectedFaq === {{ $index }} ? 'rotate-90 text-orange-500' : 'text-neutral-400'"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <div x-show="selectedFaq === {{ $index }}"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 -translate-y-2 max-h-0"
                                x-transition:enter-end="opacity-100 translate-y-0 max-h-96"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 max-h-96"
                                x-transition:leave-end="opacity-0 -translate-y-2 max-h-0"
                                class="overflow-hidden"
                                style="display: none;">
                                <div class="px-4 pb-4 pt-0">
                                    <div class="w-10 h-0.5 bg-gradient-to-r from-orange-500 to-orange-400 rounded-full mb-3"></div>
                                    <p class="text-neutral-600 dark:text-neutral-400 leading-relaxed text-sm">
                                        {{ $faq->answer }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- ===== DESKTOP LAYOUT: Split View (md+) ===== --}}
                    <div class="hidden md:grid md:grid-cols-2 gap-8 lg:gap-10">
                        {{-- LEFT COLUMN: Question List --}}
                        <div class="space-y-3">
                            @foreach($faqs as $index => $faq)
                            <button @click="selectedFaq = {{ $index }}"
                                class="w-full flex items-center justify-between gap-3 p-4 md:p-5 rounded-2xl text-left transition-all duration-300 group"
                                :class="selectedFaq === {{ $index }}
                                    ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/25'
                                    : 'bg-neutral-100 dark:bg-neutral-800/60 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-200 dark:hover:bg-neutral-700/80'">
                                <span class="text-sm md:text-base font-semibold leading-snug"
                                    :class="selectedFaq === {{ $index }} ? 'text-white' : ''">
                                    {{ $faq->question }}
                                </span>
                                <svg class="w-4 h-4 flex-shrink-0 transition-transform duration-300"
                                    :class="selectedFaq === {{ $index }} ? 'text-white translate-x-1' : 'text-neutral-400 dark:text-neutral-500 group-hover:translate-x-0.5'"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            @endforeach
                        </div>

                        {{-- RIGHT COLUMN: Answer Card --}}
                        <div class="md:sticky md:top-24 h-fit">
                            @foreach($faqs as $index => $faq)
                            <div x-show="selectedFaq === {{ $index }}"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-x-4"
                                x-transition:enter-end="opacity-100 translate-x-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-x-0"
                                x-transition:leave-end="opacity-0 -translate-x-4"
                                class="bg-white dark:bg-neutral-800 rounded-3xl border border-orange-500/20 dark:border-orange-500/20 shadow-xl shadow-orange-500/5 p-6 md:p-8"
                                style="display: none;">
                                <h3 class="text-lg md:text-xl font-extrabold text-neutral-900 dark:text-white mb-4 leading-snug">
                                    {{ $faq->question }}
                                </h3>
                                <div class="w-12 h-1 bg-gradient-to-r from-orange-500 to-orange-400 rounded-full mb-5"></div>
                                <p class="text-neutral-600 dark:text-neutral-300 leading-relaxed text-sm md:text-base">
                                    {{ $faq->answer }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @else
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
                @endif
            </div>{{-- END Liquid Glass Container --}}
        </div>
    </section>

@endsection
