@extends('client::layouts.guest')

@section('title', 'Event & Promo — Fujiyama Ramen')

@section('content')
    <!-- Page Header -->
    <section class="relative pt-28 pb-12 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-neutral-950 via-orange-950/20 to-neutral-950"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-orange-600/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <span class="inline-block text-xs font-bold text-orange-400 uppercase tracking-[0.2em] mb-4">Event & Promo</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black font-['Noto_Sans_JP'] text-white mb-4">
                    Jangan Lewatkan<br>Keseruannya!
                </h1>
                <p class="text-neutral-400 text-lg">
                    Ikuti berbagai event spesial dan promo menarik dari Fujiyama Ramen. Ada banyak kejutan menanti!
                </p>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section class="py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($events->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($events as $event)
                    <div class="group relative bg-neutral-900/80 border {{ $event->isActive() ? 'border-orange-600/20 hover:border-orange-500/50' : 'border-neutral-800 hover:border-neutral-700' }} rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:shadow-orange-500/5">
                        <!-- Image -->
                        <div class="aspect-[16/10] overflow-hidden bg-gradient-to-br from-orange-900/30 to-neutral-900">
                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full {{ $event->isActive() ? 'bg-orange-500 text-white' : 'bg-neutral-700/90 text-neutral-300' }}">
                                    @if($event->isActive())
                                        <span class="relative flex h-1.5 w-1.5">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-white"></span>
                                        </span>
                                        Sedang Berlangsung
                                    @else
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Telah Berakhir
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Date Range -->
                            <div class="flex items-center gap-2 text-sm text-orange-400 font-medium mb-3">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $event->start_date->format('d M Y') }} — {{ $event->end_date->format('d M Y') }}</span>
                            </div>

                            <h3 class="text-xl font-extrabold text-white group-hover:text-orange-400 transition-colors mb-3">
                                {{ $event->title }}
                            </h3>
                            <p class="text-neutral-400 text-sm leading-relaxed">
                                {{ $event->description }}
                            </p>

                            @if($event->location)
                            <div class="flex items-center gap-2 mt-4 pt-4 border-t border-neutral-800 text-sm text-neutral-500">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ $event->location }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($events->hasPages())
                <div class="mt-12">
                    {{ $events->links() }}
                </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="text-6xl mb-6">🎉</div>
                    <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Event</h3>
                    <p class="text-neutral-500 max-w-md mx-auto">
                        Saat ini belum ada event atau promo yang sedang berlangsung. Pantau terus halaman ini untuk update terbaru!
                    </p>
                    <a href="{{ route('client.home') }}"
                        class="inline-flex items-center gap-2 mt-8 px-6 py-3 bg-orange-600 hover:bg-orange-500 text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
                @endif
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-orange-600 to-red-600 p-10 md:p-14 text-center">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

                <div class="relative">
                    <h2 class="text-2xl md:text-3xl font-black text-white mb-4">
                        Sambil Nunggu Event,<br>Pesan Ramen Dulu Yuk!
                    </h2>
                    <p class="text-orange-100/80 max-w-lg mx-auto mb-6">
                        Nikmati menu autentik Jepang dari dapur kami. Pesan sekarang dan rasakan sendiri kelezatannya!
                    </p>
                    <a href="{{ route('client.menu') }}"
                        class="inline-flex items-center gap-2 px-8 py-3.5 bg-white hover:bg-neutral-100 text-orange-700 font-bold text-lg rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
                        Lihat Menu
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection