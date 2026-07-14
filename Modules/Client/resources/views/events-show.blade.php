@extends('client::layouts.guest')

@section('title', $event->title . ' — Event Fujiyama Ramen')

@php
    $now = now()->startOfDay();
    $isOngoing = $event->status === 'active' && $event->start_date->lte($now) && $event->end_date->gte($now);
    $isUpcoming = $event->status === 'active' && $event->start_date->gt($now);
    $isEnded = !$isOngoing && !$isUpcoming;
@endphp

@section('content')
<div class="min-h-screen bg-white dark:bg-neutral-950 text-neutral-900 dark:text-white">

    {{-- ========== HERO IMAGE (FULL WIDTH) ========== --}}
    <section class="relative w-full">
        <div class="relative w-full h-64 md:h-96 overflow-hidden rounded-b-2xl shadow-xl shadow-black/20">
            <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                class="w-full h-full object-cover" loading="lazy" decoding="async">
            {{-- Bottom gradient overlay --}}
            <div class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black/50 via-black/20 to-transparent pointer-events-none"></div>
            {{-- Discount badge floating top-left --}}
            @if($event->discount_promo)
            <div class="absolute top-4 left-4 z-10">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs md:text-sm font-bold text-white bg-orange-600 shadow-lg shadow-orange-600/30">
                    {{ $event->discount_promo }}
                </span>
            </div>
            @endif
        </div>
    </section>

    {{-- ========== 2-COLUMN CONTENT AREA ========== --}}
    <section class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back link --}}
            <a href="{{ route('client.events') }}"
                class="inline-flex items-center gap-2 text-sm text-neutral-500 dark:text-neutral-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors mb-6 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Semua Event
            </a>

            {{-- ========== DESKTOP: 2-COLUMN FLEX ========== --}}
            <div class="lg:flex lg:gap-10 xl:gap-14">

                {{-- ========== KOLOM KIRI (65-70%) — DETAIL EVENT ========== --}}
                <div class="lg:w-[65%] xl:w-[68%]">

                    {{-- Status + Discount badge row --}}
                    <div class="flex flex-wrap items-center gap-3 mb-5">
                        @if($isOngoing)
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold bg-green-500 text-white shadow-lg shadow-green-500/25">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                            </span>
                            Sedang Berlangsung
                        </span>
                        @elseif($isUpcoming)
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold bg-amber-500 text-white shadow-lg shadow-amber-500/25">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Segera Hadir
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold bg-neutral-500/80 text-white">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Telah Berakhir
                        </span>
                        @endif

                        {{-- Discount badge (if not already in hero, show here too for visibility) --}}
                        @if($event->discount_promo)
                        <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold text-orange-700 dark:text-orange-300 bg-orange-100 dark:bg-orange-500/15 border border-orange-200 dark:border-orange-500/25">
                            {{ $event->discount_promo }}
                        </span>
                        @endif
                    </div>

                    {{-- Judul event --}}
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-neutral-900 dark:text-white leading-tight tracking-tight mb-4">
                        {{ $event->title }}
                    </h1>

                    {{-- Info tanggal + lokasi --}}
                    <div class="flex flex-wrap items-center gap-3 md:gap-5 text-sm text-neutral-600 dark:text-neutral-400 mb-8">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-semibold">{{ $event->start_date->format('d M Y') }} — {{ $event->end_date->format('d M Y') }}</span>
                        </div>
                        @if($event->location)
                        <span class="text-neutral-300 dark:text-neutral-600 hidden sm:inline">|</span>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="font-semibold">{{ $event->location }}</span>
                        </div>
                        @endif
                    </div>

                    {{-- "Detail Event" header with orange accent bar --}}
                    <div class="flex items-center gap-3 mb-5">
                        <span class="w-1 h-8 bg-orange-500 rounded-full flex-shrink-0"></span>
                        <h2 class="text-xl md:text-2xl font-extrabold text-neutral-900 dark:text-white">
                            Detail Event
                        </h2>
                    </div>

                    {{-- Deskripsi — clean paragraphs with comfortable line-height --}}
                    <div class="text-neutral-700 dark:text-neutral-300 text-base md:text-lg leading-relaxed md:leading-loose space-y-4 mb-2">
                        @foreach(explode("\n", trim($event->description)) as $paragraph)
                            @if(trim($paragraph) !== '')
                            <p>{{ $paragraph }}</p>
                            @endif
                        @endforeach
                    </div>

                    {{-- Divider + CTA button --}}
                    <div class="mt-8 pt-7 border-t border-neutral-200 dark:border-neutral-800">
                        @if($isOngoing)
                        <a href="{{ route('client.menu') }}"
                            class="inline-flex items-center gap-2 px-7 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold text-base md:text-lg rounded-2xl shadow-xl shadow-orange-500/30 hover:shadow-orange-600/40 transition-all duration-300 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Pesan Menu Sekarang
                        </a>
                        @elseif($isUpcoming)
                        <a href="{{ route('client.menu') }}"
                            class="inline-flex items-center gap-2 px-7 py-4 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold text-base md:text-lg rounded-2xl shadow-xl shadow-amber-500/30 hover:shadow-amber-600/40 transition-all duration-300 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Lihat Menu Kami
                        </a>
                        @else
                        <a href="{{ route('client.events') }}"
                            class="inline-flex items-center gap-2 px-7 py-4 bg-neutral-200 dark:bg-neutral-800 hover:bg-neutral-300 dark:hover:bg-neutral-700 text-neutral-700 dark:text-neutral-300 font-bold text-base md:text-lg rounded-2xl transition-all duration-300 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Lihat Event Lainnya
                        </a>
                        @endif
                    </div>
                </div>

                {{-- ========== KOLOM KANAN (30-35%) — SIDEBAR EVENT LAINNYA (DESKTOP ONLY) ========== --}}
                @if($otherEvents->count())
                <div class="hidden lg:block lg:w-[35%] xl:w-[32%] flex-shrink-0">
                    <div class="sticky top-24 bg-neutral-50 dark:bg-neutral-900/80 backdrop-blur-sm border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 md:p-6 shadow-sm">
                        {{-- Sidebar header --}}
                        <h3 class="text-lg font-extrabold text-neutral-900 dark:text-white mb-5 flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                            Event Lainnya
                        </h3>

                        {{-- Vertical card list --}}
                        <div class="space-y-3">
                            @foreach($otherEvents as $other)
                            <a href="{{ route('client.events.show', $other->id) }}"
                                class="flex gap-3 p-3 rounded-xl bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 hover:border-orange-300 dark:hover:border-orange-600 hover:shadow-md hover:bg-orange-50/50 dark:hover:bg-orange-500/5 transition-all duration-300 group">
                                {{-- Thumbnail --}}
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-gradient-to-br from-orange-100 dark:from-orange-900/30 to-neutral-100 dark:to-neutral-800 shadow-sm">
                                    <img src="{{ $other->image_url }}" alt="{{ $other->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" decoding="async">
                                </div>
                                {{-- Info --}}
                                <div class="flex-1 min-w-0 flex flex-col justify-center">
                                    <h4 class="text-sm font-bold text-neutral-900 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors line-clamp-2 leading-snug">
                                        {{ $other->title }}
                                    </h4>
                                    <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-1">
                                        {{ $other->start_date->format('d M Y') }} — {{ $other->end_date->format('d M Y') }}
                                    </p>
                                    @if($other->discount_promo)
                                    <span class="inline-block self-start mt-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold text-white bg-orange-500 shadow-sm">
                                        {{ $other->discount_promo }}
                                    </span>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>

                        {{-- Link ke semua event --}}
                        <a href="{{ route('client.events') }}"
                            class="mt-5 flex items-center justify-center gap-1.5 text-xs font-semibold text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 transition-colors py-2">
                            Lihat Semua Event
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endif

            </div>

            {{-- ========== MOBILE: EVENT LAINNYA — Horizontal Scroll Cards ========== --}}
            @if($otherEvents->count())
            <div class="mt-10 lg:hidden">
                <h3 class="text-lg font-extrabold text-neutral-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                    Event Lainnya
                </h3>
                <div class="flex gap-3 overflow-x-auto pb-2 -mx-1 px-1 scrollbar-hide snap-x snap-mandatory">
                    @foreach($otherEvents as $other)
                    <a href="{{ route('client.events.show', $other->id) }}"
                        class="flex-shrink-0 w-72 snap-start group bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden hover:border-orange-300 dark:hover:border-orange-700 hover:shadow-lg transition-all duration-300">
                        {{-- Card image --}}
                        <div class="w-full h-40 overflow-hidden bg-gradient-to-br from-orange-100 dark:from-orange-900/30 to-neutral-100 dark:to-neutral-800">
                            <img src="{{ $other->image_url }}" alt="{{ $other->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy">
                        </div>
                        {{-- Card info --}}
                        <div class="p-3.5">
                            <h4 class="text-sm font-bold text-neutral-900 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors line-clamp-2 leading-snug mb-1.5">
                                {{ $other->title }}
                            </h4>
                            <p class="text-[11px] text-neutral-500 dark:text-neutral-400">
                                {{ $other->start_date->format('d M Y') }} — {{ $other->end_date->format('d M Y') }}
                            </p>
                            @if($other->discount_promo)
                            <span class="inline-block mt-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold text-white bg-orange-500 shadow-sm">
                                {{ $other->discount_promo }}
                            </span>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </section>
</div>
@endsection