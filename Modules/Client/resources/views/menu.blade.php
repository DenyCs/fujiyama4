@extends('client::layouts.guest')

@section('title', 'Menu — Fujiyama Ramen')

@section('content')
<div class="min-h-screen pt-20 pb-16 bg-white dark:bg-neutral-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white mb-3">Menu Kami</h1>
            <p class="text-neutral-600 dark:text-neutral-400 text-lg max-w-2xl mx-auto">Nikmati berbagai pilihan ramen autentik, minuman segar, dan topping tambahan favoritmu.</p>
        </div>

        @if($menus->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-6">📋</div>
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Menu Belum Tersedia</h2>
            <p class="text-neutral-500">Menu akan segera hadir. Silakan cek kembali nanti.</p>
        </div>
        @else
        <!-- Menu Grid (flat — no category sections) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($menus as $menu)
            <div class="group bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden hover:border-orange-600/50 hover:shadow-lg hover:shadow-orange-600/10 transition-all duration-300"
                x-data="{ added: false }">
                <!-- Menu Image -->
                <div class="relative h-48 bg-gradient-to-br from-orange-200 dark:from-orange-900/30 to-neutral-100 dark:to-neutral-900 flex items-center justify-center overflow-hidden">
                    @if($menu->image)
                        <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="text-6xl">🍜</div>
                    @endif
                    <!-- Price Badge -->
                    <div class="absolute top-3 right-3 px-3 py-1.5 bg-white/90 dark:bg-neutral-900/90 backdrop-blur-sm border border-neutral-200 dark:border-neutral-700 rounded-lg">
                        <span class="text-sm font-bold text-orange-600 dark:text-orange-400">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Menu Info -->
                <div class="p-5">
                    <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-1">{{ $menu->name }}</h3>
                    @if($menu->description)
                        <p class="text-sm text-neutral-500 mb-4 line-clamp-2">{{ $menu->description }}</p>
                    @endif

                    <!-- Add to Cart Button -->
                    <button type="button"
                        @click="added = true; $store.cart.addItem({{ $menu->id }}); setTimeout(() => added = false, 2000)"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2.5 bg-orange-600/10 dark:bg-orange-600/20 hover:bg-orange-600 dark:hover:bg-orange-600 text-orange-600 dark:text-orange-400 hover:text-white border border-orange-600/30 hover:border-orange-600 rounded-xl transition-all duration-300 text-sm font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        <span x-text="added ? '✓ Ditambahkan' : 'Tambah ke Keranjang'">Tambah ke Keranjang</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection