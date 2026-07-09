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
        <!-- Menu Grid — 2 cols mobile, 2 cols sm, 3 cols lg -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
            @foreach($menus as $menu)
            <div class="group bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden hover:border-orange-600/50 hover:shadow-lg hover:shadow-orange-600/10 transition-all duration-300 p-3 sm:pt-6 sm:pb-5 sm:px-5 flex flex-col items-center text-center"
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
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection