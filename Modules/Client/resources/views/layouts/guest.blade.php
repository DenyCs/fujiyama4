<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" x-data x-init="document.documentElement.classList.add(localStorage.theme || 'dark')">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    @if($restaurantSetting->favicon_image)
        <link rel="icon" type="image/png" href="{{ asset($restaurantSetting->favicon_image) }}">
    @endif

    <title>@yield('title', 'Fujiyama Ramen') — {{ config('app.name', 'Fujiyama Ramen') }}</title>

    {{-- Anti-flash: set dark class immediately before any CSS renders --}}
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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Smooth theme transition */
        html.transitioning *, html.transitioning *::before, html.transitioning *::after {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease !important;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-white dark:bg-neutral-950 text-neutral-900 dark:text-neutral-200 font-['Inter'] antialiased"
    x-data="{ theme: localStorage.getItem('theme') || 'dark' }"
    x-init="
        $store.cart.count = {{ $cartCount ?? 0 }};
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
                <a href="{{ route('client.home') }}" class="flex items-center gap-2 group shrink-0">
                    {{-- Dark mode logo (terang/putih) --}}
                    <img x-show="theme === 'dark'"
                        src="{{ $restaurantSetting->logo_dark ? asset($restaurantSetting->logo_dark) : '' }}"
                        alt="Fujiyama Ramen"
                        class="h-10 lg:h-12 w-auto object-contain"
                        @if(!$restaurantSetting->logo_dark) style="display: none !important;" @endif
                    >
                    {{-- Light mode logo (gelap) --}}
                    <img x-show="theme === 'light'"
                        src="{{ $restaurantSetting->logo_light ? asset($restaurantSetting->logo_light) : '' }}"
                        alt="Fujiyama Ramen"
                        class="h-10 lg:h-12 w-auto object-contain"
                        @if(!$restaurantSetting->logo_light) style="display: none !important;" @endif
                    >
                    {{-- Fallback: text logo jika belum upload --}}
                    <span x-show="(theme === 'dark' && !{{ $restaurantSetting->logo_dark ? 'true' : 'false' }}) || (theme === 'light' && !{{ $restaurantSetting->logo_light ? 'true' : 'false' }})"
                        class="text-xl lg:text-2xl font-extrabold font-['Noto_Sans_JP'] bg-gradient-to-r from-orange-400 via-orange-500 to-red-500 bg-clip-text text-transparent [text-shadow:_0_1px_3px_rgba(0,0,0,0.3)] dark:[text-shadow:_0_1px_3px_rgba(0,0,0,0.6)] leading-tight"
                        @if($restaurantSetting->logo_dark && $restaurantSetting->logo_light) style="display: none !important;" @endif
                    >FujiYama4</span>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-6">
                    <a href="{{ route('client.home') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('client.home') ? 'text-orange-500 font-semibold' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500' }}">Beranda</a>
                    <a href="{{ route('client.menu') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('client.menu') ? 'text-orange-500 font-semibold' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500' }}">Menu</a>
                    <a href="{{ route('reservation.create') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('reservation.*') ? 'text-orange-500 font-semibold' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500' }}">Reservasi</a>
                    <a href="{{ route('client.events') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('client.events') ? 'text-orange-500 font-semibold' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500' }}">Event & Promo</a>
                    <a href="{{ route('cart.index') }}" class="relative transition-colors {{ request()->routeIs('cart.*') ? 'text-orange-500' : 'text-neutral-600 dark:text-neutral-400 hover:text-orange-500' }}" title="Keranjang">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        {{-- Cart Badge --}}
                        <span x-show="$store.cart.count > 0"
                            x-text="$store.cart.count"
                            class="absolute -top-2 -right-3 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-bold leading-none text-white bg-orange-600 rounded-full"
                            style="display: none;">
                        </span>
                    </a>

                    {{-- Theme Toggle (Desktop) --}}
                    <button type="button"
                        @click="theme = (theme === 'dark' ? 'light' : 'dark')"
                        class="p-2 rounded-lg transition-colors text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-neutral-800"
                        title="Toggle dark/light mode">
                        {{-- Sun icon (shown when dark mode → click to switch to light) --}}
                        <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        {{-- Moon icon (shown when light mode → click to switch to dark) --}}
                        <svg x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-orange-400 hover:text-orange-300 transition-colors">Admin Panel</a>
                        @endif
                    @endauth
                </div>

            </div>
        </div>

    </nav>

    {{-- Theme Toggle (Mobile Fixed) — Top Right Corner --}}
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
    <main class="pt-16 lg:pt-20 pb-0 lg:pb-0">
        @yield('content')
    </main>

    <!-- Bottom Navbar (Mobile Only) — Floating Glass Pill -->
    <nav class="lg:hidden fixed bottom-[14px] left-4 right-4 z-50 h-16 px-2 rounded-[28px] bg-white/80 dark:bg-neutral-900/70 backdrop-blur-md border border-neutral-200/40 dark:border-white/[0.06] shadow-lg shadow-black/10 dark:shadow-black/40">
        <div class="relative flex items-center justify-around h-full">
            {{-- 1. Beranda --}}
            <a href="{{ route('client.home') }}" class="flex flex-col items-center gap-0.5 min-w-[52px] transition-all duration-200 {{ request()->routeIs('client.home') ? 'text-orange-500 font-semibold' : 'text-neutral-500 dark:text-neutral-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                <span class="text-[10px] font-medium leading-tight">Beranda</span>
            </a>

            {{-- 2. Event --}}
            <a href="{{ route('client.events') }}" class="flex flex-col items-center gap-0.5 min-w-[52px] transition-all duration-200 {{ request()->routeIs('client.events') ? 'text-orange-500 font-semibold' : 'text-neutral-500 dark:text-neutral-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
                <span class="text-[10px] font-medium leading-tight">Event</span>
            </a>

            {{-- 3. Center Button (floating) — Menu --}}
            <div class="relative flex flex-col items-center min-w-[52px]">
                <a href="{{ route('client.menu') }}" class="absolute -top-[36px] aspect-square flex items-center justify-center w-[58px] h-[58px] rounded-full border-[6px] border-white dark:border-neutral-950 shadow-lg shadow-orange-500/50 active:scale-95 transition-transform duration-200 z-10"
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

            {{-- 4. Reservasi --}}
            <a href="{{ route('reservation.create') }}" class="flex flex-col items-center gap-0.5 min-w-[52px] transition-all duration-200 {{ request()->routeIs('reservation.*') ? 'text-orange-500 font-semibold' : 'text-neutral-500 dark:text-neutral-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-[10px] font-medium leading-tight">Reservasi</span>
            </a>

            {{-- 5. Cart --}}
            <a href="{{ route('cart.index') }}" class="relative flex flex-col items-center gap-0.5 min-w-[52px] transition-all duration-200 {{ request()->routeIs('cart.*') ? 'text-orange-500 font-semibold' : 'text-neutral-500 dark:text-neutral-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
                <span class="text-[10px] font-medium leading-tight">Cart</span>
                {{-- Cart Badge --}}
                <span x-show="$store.cart.count > 0"
                    x-text="$store.cart.count"
                    class="absolute -top-0.5 -right-1 inline-flex items-center justify-center min-w-[15px] h-[15px] px-1 text-[9px] font-bold leading-none text-white bg-orange-500 rounded-full"
                    style="display: none;">
                </span>
            </a>
        </div>
    </nav>

    <!-- Footer -->
    <footer class="bg-neutral-100 dark:bg-neutral-900 border-t border-neutral-200 dark:border-neutral-800 pb-20 lg:pb-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        {{-- Dark mode footer logo --}}
                        <img x-show="theme === 'dark'"
                            src="{{ $restaurantSetting->logo_dark ? asset($restaurantSetting->logo_dark) : '' }}"
                            alt="Fujiyama Ramen"
                            class="h-8 w-auto object-contain"
                            @if(!$restaurantSetting->logo_dark) style="display: none !important;" @endif
                        >
                        {{-- Light mode footer logo --}}
                        <img x-show="theme === 'light'"
                            src="{{ $restaurantSetting->logo_light ? asset($restaurantSetting->logo_light) : '' }}"
                            alt="Fujiyama Ramen"
                            class="h-8 w-auto object-contain"
                            @if(!$restaurantSetting->logo_light) style="display: none !important;" @endif
                        >
                        {{-- Fallback text --}}
                        <span x-show="(theme === 'dark' && !{{ $restaurantSetting->logo_dark ? 'true' : 'false' }}) || (theme === 'light' && !{{ $restaurantSetting->logo_light ? 'true' : 'false' }})"
                            class="text-lg font-extrabold font-['Noto_Sans_JP'] bg-gradient-to-r from-orange-400 via-orange-500 to-red-500 bg-clip-text text-transparent"
                            @if($restaurantSetting->logo_dark && $restaurantSetting->logo_light) style="display: none !important;" @endif
                        >FujiYama4</span>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-500 leading-relaxed">
                        {{ $restaurantSetting->footer_description ?? 'Authentic Japanese ramen experience. Handcrafted noodles, rich broth, and premium toppings — crafted with passion since 2015.' }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="hidden md:block">
                    <h4 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('client.home') }}" class="text-sm text-neutral-600 dark:text-neutral-500 hover:text-orange-500 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('client.menu') }}" class="text-sm text-neutral-600 dark:text-neutral-500 hover:text-orange-500 transition-colors">Menu</a></li>
                        <li><a href="{{ route('client.events') }}" class="text-sm text-neutral-600 dark:text-neutral-500 hover:text-orange-500 transition-colors">Event & Promo</a></li>
                        <li><a href="{{ route('reservation.create') }}" class="text-sm text-neutral-600 dark:text-neutral-500 hover:text-orange-500 transition-colors">Reservasi</a></li>
                    </ul>
                </div>

                <!-- Info -->
                <div>
                    <h4 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm text-neutral-600 dark:text-neutral-500">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $restaurantSetting->address ?? 'Jl. Ramen No. 123, Jakarta' }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $restaurantSetting->phone ?? '0812-3456-7890' }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $restaurantSetting->getOpeningHoursSummary() }}
                        </li>
                    </ul>

                    @if(isset($socialLinks) && $socialLinks->count())
                    <div class="mt-5">
                        <h4 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wider mb-3">Ikuti Kami</h4>
                        <div class="flex gap-3">
                            @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                               class="w-9 h-9 rounded-full bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center
                                      hover:bg-orange-500 dark:hover:bg-orange-500 hover:text-white transition-colors duration-200
                                      text-neutral-600 dark:text-neutral-400"
                               title="{{ $link->platform }}"
                               aria-label="{{ $link->platform }}">
                                {{-- Instagram --}}
                                @if($link->icon_identifier === 'instagram')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                @elseif($link->icon_identifier === 'facebook')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                @elseif($link->icon_identifier === 'tiktok')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                                @elseif($link->icon_identifier === 'whatsapp')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                @elseif($link->icon_identifier === 'youtube')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                @elseif($link->icon_identifier === 'twitter')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                @endif
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-neutral-200 dark:border-neutral-800 text-center">
                <p class="text-xs text-neutral-500 dark:text-neutral-600">&copy; {{ date('Y') }} {{ $restaurantSetting->copyright_text ?? 'Fujiyama Ramen. All rights reserved.' }}</p>
            </div>
        </div>
    </footer>

    <script>
        // Hero slider component
        document.addEventListener('alpine:init', () => {
            // Cart store — shared across all client pages
            Alpine.store('cart', {
                count: {{ $cartCount ?? 0 }},
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

            Alpine.data('testimonialSlider', (count) => ({
                active: 0,
                total: count,
                darkMode: true,
                interval: null,

                init() {
                    if (this.total > 1) {
                        this.startAutoplay();
                    }
                },

                startAutoplay() {
                    this.interval = setInterval(() => {
                        this.active = (this.active + 1) % this.total;
                    }, 4000);
                },

                stopAutoplay() {
                    clearInterval(this.interval);
                },

                destroy() {
                    this.stopAutoplay();
                }
            }));
        });
    </script>

    @stack('scripts')
</body>
</html>