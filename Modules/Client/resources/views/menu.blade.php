@extends('client::layouts.guest')

@section('title', 'Menu — Fujiyama Ramen')

@section('content')
<div class="min-h-screen bg-white dark:bg-neutral-950"
    x-data="{
        activeCategory: '',
        searchQuery: '',
        allCategories: {{ $categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name, 'slug' => 'cat-' . $c->id])->toJson() }},
        init() {
            // Intersection Observer to detect active section
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.activeCategory = entry.target.dataset.categorySlug;
                    }
                });
            }, { rootMargin: '-30% 0px -60% 0px', threshold: 0 });

            this.$nextTick(() => {
                document.querySelectorAll('[data-category-slug]').forEach(el => {
                    observer.observe(el);
                });
            });
        },
        filteredMenus(catId) {
            const items = document.querySelectorAll(`#cat-${catId} [data-menu-name]`);
            if (!items) return;
            items.forEach(el => {
                const name = el.dataset.menuName.toLowerCase();
                el.style.display = (this.searchQuery === '' || name.includes(this.searchQuery.toLowerCase())) ? '' : 'none';
            });
        },
        scrollTo(catId) {
            const el = document.getElementById('cat-' + catId);
            if (el) {
                const offset = 150; // navbar (64px mobile / 80px lg) + sticky tabs (~70px)
                const top = el.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        }
    }"
    x-effect="allCategories.forEach(c => filteredMenus(c.id))">

    {{-- ===== HEADER HALAMAN ===== --}}
    <div class="pt-12 pb-8 md:pt-16 md:pb-10 text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Badge --}}
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 rounded-full text-xs sm:text-sm font-semibold tracking-wide mb-4">
                🍜 Menu Kami
            </span>
            {{-- Judul --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white mb-3">
                Jelajahi Menu Fujiyama Ramen
            </h1>
            {{-- Subtitle --}}
            <p class="text-neutral-500 dark:text-neutral-400 text-sm sm:text-base max-w-xl mx-auto">
                Setiap mangkuk dibuat dengan bahan segar dan resep autentik Jepang. Temukan favoritmu!
            </p>

            {{-- Search Bar --}}
            <div class="mt-6 max-w-md mx-auto relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" x-model="searchQuery" placeholder="Cari menu favoritmu..."
                    class="w-full pl-10 pr-10 py-3 bg-neutral-100 dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-xl text-sm text-neutral-900 dark:text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all">
                {{-- Clear button --}}
                <button x-show="searchQuery.length > 0" @click="searchQuery = ''"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ===== STICKY TAB NAVIGASI ===== --}}
    <div class="sticky top-16 lg:top-20 z-30 bg-white/80 dark:bg-neutral-950/80 backdrop-blur-md border-b border-neutral-200 dark:border-neutral-800 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-1 sm:gap-2 py-2.5 sm:py-3 overflow-x-auto scrollbar-hide -mx-1 px-1">
                <template x-for="cat in allCategories" :key="cat.id">
                    <button type="button"
                        @click="scrollTo(cat.id)"
                        :class="activeCategory === cat.slug
                            ? 'bg-orange-500 text-white shadow-md shadow-orange-500/30'
                            : 'bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-200 dark:hover:bg-neutral-700'"
                        class="shrink-0 px-3.5 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 whitespace-nowrap"
                        x-text="cat.name">
                    </button>
                </template>
            </div>
        </div>
    </div>

    {{-- ===== SECTION PER KATEGORI ===== --}}
    <div class="@empty($categories) pt-0 @endempty">
        @forelse($categories as $category)
        <section id="cat-{{ $category->id }}"
            data-category-slug="cat-{{ $category->id }}"
            class="py-10 sm:py-14 @if(!$loop->first) border-t border-neutral-200 dark:border-neutral-800 @endif">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Header Kategori --}}
                <div class="mb-6 sm:mb-8 text-center" data-category-id="{{ $category->id }}">
                    <h2 class="text-2xl sm:text-3xl font-bold text-neutral-900 dark:text-white mb-1">
                        {{ $category->name }}
                    </h2>
                    {{-- Garis aksen oranye --}}
                    <div class="w-10 h-1 bg-orange-500 mx-auto rounded-full mt-2 mb-2"></div>
                    <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400">
                        {{ $category->menus->count() }} menu tersedia
                    </p>
                </div>

                {{-- Grid Menu per kategori --}}
                @if($category->menus->isEmpty())
                <div class="text-center py-8 text-neutral-400 dark:text-neutral-500">
                    <p>Belum ada menu di kategori ini.</p>
                </div>
                @else
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
                    @foreach($category->menus as $menu)
                    <div data-menu-name="{{ $menu->name }}"
                        class="group bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden hover:border-orange-600/50 hover:shadow-lg hover:shadow-orange-600/10 transition-all duration-300 p-3 sm:pt-6 sm:pb-5 sm:px-5 flex flex-col items-center text-center"
                        x-data="{ added: false }">

                        {{-- Image --}}
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                class="w-24 h-24 sm:w-40 sm:h-40 object-contain group-hover:scale-110 transition-all duration-500 mb-1 sm:mb-2 drop-shadow-[0_6px_10px_rgba(0,0,0,0.15)] dark:drop-shadow-[0_10px_20px_rgba(234,88,12,0.25)]">
                        @else
                            <div class="w-24 h-24 sm:w-40 sm:h-40 flex items-center justify-center text-4xl sm:text-6xl mb-1 sm:mb-2">
                                🍜
                            </div>
                        @endif

                        {{-- Nama Menu --}}
                        <h3 class="text-sm sm:text-lg font-bold text-neutral-900 dark:text-white mb-1 sm:mb-2 mt-1 sm:mt-2">{{ $menu->name }}</h3>

                        {{-- Deskripsi --}}
                        @if($menu->description)
                            <p class="text-xs sm:text-sm text-neutral-500 mb-2 sm:mb-4 line-clamp-2">{{ $menu->description }}</p>
                        @else
                            <div class="mb-2 sm:mb-4"></div>
                        @endif

                        {{-- Harga --}}
                        <span class="text-base sm:text-xl font-bold text-orange-600 dark:text-orange-400 mb-2 sm:mb-4">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>

                        {{-- Tombol Tambah ke Keranjang --}}
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
                    @endforeach
                </div>
                @endif
            </div>
        </section>
        @empty
        {{-- Empty state (no categories with menus) --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <div class="text-6xl mb-6">📋</div>
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Menu Belum Tersedia</h2>
            <p class="text-neutral-500">Menu akan segera hadir. Silakan cek kembali nanti.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection