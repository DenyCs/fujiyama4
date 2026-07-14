@extends('client::layouts.guest')

@section('title', 'Event & Promo — Fujiyama Ramen')

@section('content')
<div class="min-h-screen bg-white dark:bg-neutral-950"
     x-data="{
         filter: '{{ $filter }}',
         setFilter(f) {
             this.filter = f;
             const url = new URL(window.location);
             url.searchParams.set('filter', f);
             url.searchParams.delete('page');
             window.location = url.toString();
         },
         isOngoing(event) {
             const now = new Date().toISOString().split('T')[0];
             return event.status === 'active' && event.start_date <= now && event.end_date >= now;
         },
         isUpcoming(event) {
             const now = new Date().toISOString().split('T')[0];
             return event.status === 'active' && event.start_date > now;
         },
         formatDate(d) {
             const parts = d.split('-');
             const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
             return parts[2] + ' ' + months[parseInt(parts[1])-1];
         }
     }">

    {{-- ========== HEADER PAGE ========== --}}
    <section class="pt-12 md:pt-16 pb-8 md:pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Page header --}}
            <div class="text-center">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold text-orange-600 dark:text-orange-400 bg-orange-500/10 dark:bg-orange-500/10 border border-orange-500/20 dark:border-orange-500/20 mb-4">
                    🎉 Event & Promo
                </span>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white leading-tight tracking-tight mb-4">
                    Semua Event & Promo<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-orange-500 to-amber-500">Fujiyama Ramen</span>
                </h1>
                <p class="text-neutral-600 dark:text-neutral-400 max-w-xl mx-auto text-sm md:text-base">
                    Ikuti berbagai event spesial dan promo menarik dari Fujiyama Ramen. Ada banyak kejutan menanti!
                </p>
            </div>
        </div>
    </section>

    {{-- ========== FILTER TABS ========== --}}
    <section class="pb-6 md:pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-2">
                <button @click="setFilter('all')"
                    :class="filter === 'all'
                        ? 'bg-orange-600 dark:bg-orange-500 text-white shadow-lg shadow-orange-500/25'
                        : 'bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 border border-neutral-200 dark:border-neutral-700'"
                    class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    Semua
                </button>
                <button @click="setFilter('ongoing')"
                    :class="filter === 'ongoing'
                        ? 'bg-green-600 text-white shadow-lg shadow-green-500/25'
                        : 'bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 border border-neutral-200 dark:border-neutral-700'"
                    class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 flex items-center gap-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    Sedang Berlangsung
                </button>
                <button @click="setFilter('upcoming')"
                    :class="filter === 'upcoming'
                        ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/25'
                        : 'bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 border border-neutral-200 dark:border-neutral-700'"
                    class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Akan Datang
                </button>
            </div>
        </div>
    </section>

    {{-- ========== EVENTS GRID ========== --}}
    <section class="py-8 md:py-16 bg-white dark:bg-neutral-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($events->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach($events as $event)
                    <a href="{{ route('client.events.show', $event->id) }}"
                        class="group relative bg-white/70 dark:bg-neutral-900/60 backdrop-blur border border-neutral-200/60 dark:border-neutral-800/60 rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:scale-[1.02] hover:shadow-xl hover:shadow-neutral-200/50 dark:hover:shadow-neutral-900/50">
                        {{-- Image --}}
                        <div class="relative aspect-video overflow-hidden bg-gradient-to-br from-orange-100 dark:from-orange-900/30 to-neutral-100 dark:to-neutral-900">
                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async">
                            {{-- Overlay gradient bottom --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>

                            {{-- Discount badge (top-left) --}}
                            @if($event->discount_promo)
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold text-white bg-orange-600 shadow-lg shadow-orange-600/25">
                                    {{ $event->discount_promo }}
                                </span>
                            </div>
                            @endif

                            {{-- Status badge (top-right) --}}
                            <div class="absolute top-3 right-3 z-10">
                                @php
                                    $now = now()->startOfDay();
                                    $isOngoing = $event->status === 'active' && $event->start_date->lte($now) && $event->end_date->gte($now);
                                    $isUpcoming = $event->status === 'active' && $event->start_date->gt($now);
                                @endphp
                                @if($isOngoing)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow-lg shadow-green-500/25">
                                    <span class="relative flex h-1.5 w-1.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-white"></span>
                                    </span>
                                    Sedang Berlangsung
                                </span>
                                @elseif($isUpcoming)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500 text-white shadow-lg shadow-amber-500/25">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Segera Hadir
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-neutral-500/80 text-white">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Telah Berakhir
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5 md:p-6">
                            {{-- Date Range --}}
                            <div class="flex items-center gap-2 text-sm text-orange-600 dark:text-orange-400 font-medium mb-3">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $event->start_date->format('d M') }} — {{ $event->end_date->format('d M Y') }}</span>
                            </div>

                            <h3 class="text-lg md:text-xl font-extrabold text-neutral-900 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors mb-2">
                                {{ $event->title }}
                            </h3>
                            <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed line-clamp-2 mb-4">
                                {{ $event->description }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-neutral-200 dark:border-neutral-800">
                                @if($event->location)
                                <div class="flex items-center gap-2 text-sm text-neutral-500 dark:text-neutral-400">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>{{ $event->location }}</span>
                                </div>
                                @endif
                                <span class="inline-flex items-center gap-1.5 text-sm font-bold text-orange-600 dark:text-orange-400 group-hover:gap-2.5 transition-all">
                                    Lihat Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($events->hasPages())
                <div class="mt-12">
                    <div class="flex items-center justify-center">
                        {{ $events->links() }}
                    </div>
                </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="text-center py-20 md:py-28">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-orange-100 dark:bg-orange-900/30 mb-8">
                        <span class="text-5xl">🎉</span>
                    </div>
                    <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">
                        Belum Ada Event Saat Ini
                    </h3>
                    <p class="text-neutral-500 dark:text-neutral-400 max-w-md mx-auto text-sm md:text-base leading-relaxed">
                        Belum ada event yang tersedia untuk kategori ini. Pantau terus ya, event seru bakal segera hadir!
                    </p>
                    <a href="{{ route('client.home') }}"
                        class="inline-flex items-center gap-2 mt-8 px-6 py-3 bg-orange-600 hover:bg-orange-500 text-white font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-orange-500/25">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
                @endif
        </div>
    </section>

    {{-- ========== BOTTOM CTA ========== --}}
    <section class="py-12 md:py-16 bg-white dark:bg-neutral-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl shadow-lg shadow-orange-500/20 dark:shadow-orange-900/40">

                {{-- Layer 1: Blurred ramen photo background --}}
                @if($ctaMenuImage)
                <div class="absolute inset-0">
                    <img src="{{ asset('storage/' . $ctaMenuImage) }}" alt=""
                        class="w-full h-full object-cover scale-110"
                        style="filter: blur(24px); opacity: 0.35;"
                        loading="lazy" aria-hidden="true">
                </div>
                @endif

                {{-- Layer 2: Rich multi-stop gradient overlay --}}
                {{-- Dark mode --}}
                <div class="absolute inset-0 bg-gradient-to-br from-orange-700/95 via-red-700/90 to-orange-900/95 dark:block hidden"></div>
                <div class="absolute inset-0 dark:block hidden" style="background: radial-gradient(ellipse at 20% 30%, rgba(251,146,60,0.2) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(239,68,68,0.15) 0%, transparent 50%);"></div>
                {{-- Light mode --}}
                <div class="absolute inset-0 bg-gradient-to-br from-orange-500/90 via-orange-600/85 to-amber-600/90 dark:hidden"></div>
                <div class="absolute inset-0 dark:hidden" style="background: radial-gradient(ellipse at 20% 30%, rgba(255,255,255,0.15) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(254,215,170,0.2) 0%, transparent 50%);"></div>

                {{-- Layer 3: Noise texture overlay (subtle grain) --}}
                <div class="absolute inset-0 opacity-[0.03] mix-blend-overlay pointer-events-none" aria-hidden="true"
                    style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22n%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.8%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23n)%22/%3E%3C/svg%3E');">
                </div>

                {{-- Decorative blur orbs --}}
                <div class="absolute -top-20 -right-20 w-72 h-72 bg-orange-400/30 dark:bg-orange-400/20 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
                <div class="absolute -bottom-16 -left-16 w-56 h-56 bg-amber-300/20 dark:bg-red-500/15 rounded-full blur-2xl pointer-events-none" aria-hidden="true"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[30rem] h-[30rem] bg-orange-500/5 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 md:p-14 text-center">
                    <h2 class="text-2xl md:text-3xl font-black text-white mb-4 [text-shadow:0_2px_8px_rgba(0,0,0,0.3)]"
                        style="text-shadow: 0 2px 12px rgba(0,0,0,0.4), 0 1px 3px rgba(0,0,0,0.2);">
                        Sambil Nunggu Event,<br>Pesan Ramen Dulu Yuk!
                    </h2>
                    <p class="text-white/90 dark:text-orange-50/85 max-w-lg mx-auto mb-6 text-sm md:text-base leading-relaxed [text-shadow:0_1px_3px_rgba(0,0,0,0.3)]"
                        style="text-shadow: 0 1px 4px rgba(0,0,0,0.35);">
                        Nikmati menu autentik Jepang dari dapur kami. Pesan sekarang dan rasakan sendiri kelezatannya!
                    </p>
                    <a href="{{ route('client.menu') }}"
                        class="inline-flex items-center gap-2 px-8 py-3.5 bg-white hover:bg-neutral-100 text-orange-700 font-bold text-lg rounded-xl transition-all duration-300 hover:shadow-xl hover:shadow-orange-500/30 hover:-translate-y-0.5 active:scale-95">
                        Lihat Menu
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Custom pagination styling --}}
@if($events->hasPages())
<style>
    /* Override default pagination styling */
    .pagination nav[role="navigation"] {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .pagination nav[role="navigation"] svg {
        width: 16px;
        height: 16px;
    }
    .pagination nav[role="navigation"] > div:first-child {
        display: none;
    }
    .pagination span[aria-current="page"] span {
        background-color: #ea580c !important;
        border-color: #ea580c !important;
        color: white !important;
        font-weight: 600;
    }
    .pagination span[aria-disabled="true"] span,
    .pagination span[aria-disabled="true"] {
        opacity: 0.4;
    }
    .pagination a {
        transition: all 0.2s;
    }
    .pagination a:hover span {
        background-color: rgba(234, 88, 12, 0.1) !important;
    }
</style>
@endif
@endsection