{{-- ======================================== --}}
{{-- Gallery Grid + Lightbox — Reusable Partial --}}
{{-- Expects: $galleries (AboutGallery collection) --}}
{{-- Optional: $limit (int|null, default: 9 for desktop, 2 for mobile on landing page) --}}
{{-- Optional: $showFilter (bool, default: true) --}}
{{-- Optional: $context (string, 'landing'|'fullpage', default: 'landing') --}}
{{-- ======================================== --}}
@php
    $limit = $limit ?? null;
    $showFilter = $showFilter ?? false;
    $context = $context ?? 'landing';

    $tabCategories = [
        'semua' => 'Semua',
        'interior' => 'Interior',
        'proses_masak' => 'Proses Masak',
        'suasana' => 'Suasana',
    ];
    $allGalleryPhotos = $galleries->map(function($g) {
        return [
            'url' => $g->image_url,
            'caption' => $g->caption ?? '',
            'category' => $g->category,
        ];
    })->values()->toArray();
@endphp

<div x-data="galleryComponent()" @keydown.escape.window="closeLightbox()">

    {{-- ======================================== --}}
    {{-- PILL TAB FILTER --}}
    {{-- ======================================== --}}
    <div class="{{ $showFilter ? 'flex' : 'hidden md:flex' }} flex-wrap justify-center gap-2 mb-10">
        @foreach($tabCategories as $catKey => $catLabel)
            @php $catCount = ($catKey === 'semua') ? $galleries->count() : $galleries->where('category', $catKey)->count(); @endphp
            <button @click="activeTab = '{{ $catKey }}'"
                :class="activeTab === '{{ $catKey }}'
                    ? 'bg-gradient-to-r from-orange-500 to-orange-500 text-white shadow-lg shadow-orange-500/25'
                    : 'text-neutral-500 dark:text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200 hover:bg-neutral-200/60 dark:hover:bg-neutral-800/60'"
                class="px-5 py-2.5 rounded-full font-semibold text-sm transition-all duration-300 whitespace-nowrap">
                {{ $catLabel }}
                <span class="ml-1.5 text-xs" :class="activeTab === '{{ $catKey }}' ? 'opacity-80' : 'opacity-60'">({{ $catCount }})</span>
            </button>
        @endforeach
    </div>

    {{-- ======================================== --}}
    {{-- BENTO GRID GALLERY — Per Tab --}}
    {{-- ======================================== --}}
    @foreach($tabCategories as $catKey => $catLabel)
        @php
            $catGalleries = ($catKey === 'semua')
                ? $galleries
                : $galleries->where('category', $catKey);
            // Build flat index mapping for lightbox
            $photoIndices = ($catKey === 'semua')
                ? $galleries->keys()->toArray()
                : $galleries->filter(fn($g) => $g->category === $catKey)->keys()->toArray();
        @endphp
        <div x-show="activeTab === '{{ $catKey }}'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            @if($catGalleries->count())
            {{-- DESKTOP BENTO GRID: 4-col, rich varied pattern --}}
            <div class="hidden md:grid grid-cols-4 auto-rows-[170px] gap-4"
                :class="{ 'in-view': inView }">
                @php
                    $desktopPatterns = [
                        'col-span-2 row-span-2', // hero
                        'col-span-1 row-span-2', // tall
                        'col-span-1 row-span-1', // small
                        'col-span-2 row-span-1', // wide
                        'col-span-1 row-span-1', // small
                        'col-span-2 row-span-1', // wide
                        'col-span-1 row-span-2', // tall-alt
                        'col-span-1 row-span-1', // small
                    ];
                @endphp
                @foreach($catGalleries as $idx => $gallery)
                    @php
                        $cellClass = $desktopPatterns[$idx % count($desktopPatterns)];
                        $flatIdx = $galleries->search(fn($g) => $g->id === $gallery->id);
                    @endphp
                    <div @click="openLightbox({{ $flatIdx }})"
                        x-show="inView"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 translate-y-6"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:enter.delay="{{ min($idx * 60, 800) }}ms"
                        class="{{ $cellClass }} group relative overflow-hidden rounded-2xl border border-neutral-200 dark:border-neutral-800 hover:border-orange-400/60 transition-all duration-500 cursor-pointer hover:shadow-[0_0_25px_rgba(249,115,22,0.15)] hover:scale-[1.02]">
                        <img src="{{ $gallery->image_url }}"
                            alt="{{ $gallery->caption ?? 'Foto ' . $catLabel }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                            loading="lazy">
                        {{-- Hover overlay: gradient + expand icon + caption --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex flex-col items-center justify-center p-4">
                            {{-- Expand icon --}}
                            <div class="mb-2 w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:scale-100 scale-75 transition-transform duration-300">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                            @if($gallery->caption)
                            <p class="text-white text-sm font-semibold translate-y-2 group-hover:translate-y-0 transition-transform duration-300 delay-75">
                                {{ $gallery->caption }}
                            </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- MOBILE GRID: limited photos (landing: 2, fullpage: all) --}}
            <div class="md:hidden grid grid-cols-2 gap-3"
                :class="{ 'in-view': inView }">
                @php
                    $mobileGalleries = ($context === 'landing' && $catGalleries->count() > 2)
                        ? $catGalleries->take(2)
                        : $catGalleries;
                @endphp
                @foreach($mobileGalleries as $idx => $gallery)
                    @php
                        $isTall = ($idx === 0 || $idx === 3 || $idx % 5 === 0);
                        $flatIdxMobile = $galleries->search(fn($g) => $g->id === $gallery->id);
                    @endphp
                    <div @click="openLightbox({{ $flatIdxMobile }})"
                        x-show="inView"
                        x-transition:enter="transition ease-out duration-400"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:enter.delay="{{ min($idx * 50, 600) }}ms"
                        class="group relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-800 hover:border-orange-400/60 transition-all duration-500 cursor-pointer hover:shadow-[0_0_20px_rgba(249,115,22,0.12)] {{ $isTall ? 'row-span-2' : '' }}">
                        <div class="{{ $isTall ? 'aspect-[3/4]' : 'aspect-square' }} overflow-hidden">
                            <img src="{{ $gallery->image_url }}"
                                alt="{{ $gallery->caption ?? 'Foto ' . $catLabel }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                                loading="lazy">
                        </div>
                        {{-- Hover overlay on mobile: gradient + caption --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/15 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center p-3">
                            <div class="mb-1.5 w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:scale-100 scale-75 transition-transform duration-300">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                            @if($gallery->caption)
                            <p class="text-white text-xs font-semibold leading-tight text-center">{{ $gallery->caption }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-orange-100 dark:bg-orange-600/20 text-orange-500 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-neutral-400 dark:text-neutral-500 italic">
                    Foto {{ strtolower($catLabel) }} akan segera hadir. 📸
                </p>
            </div>
            @endif
        </div>
    @endforeach

    {{-- ======================================== --}}
    {{-- PREMIUM LIGHTBOX — Blur Overlay + Nav Arrows --}}
    {{-- ======================================== --}}
    <div x-show="showLightbox"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[999] flex items-center justify-center bg-black/85 backdrop-blur-md p-4 sm:p-8"
        @click.self="closeLightbox()">

        {{-- Close Button (top-right) --}}
        <button @click="closeLightbox()"
            class="absolute top-4 right-4 sm:top-6 sm:right-6 text-white/70 hover:text-white transition-colors p-2 z-20 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm">
            <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Prev Arrow --}}
        <button @click.stop="prevPhoto()"
            class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors p-2 z-20 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm"
            :class="{ 'opacity-30 pointer-events-none': currentPhotos.length <= 1 }">
            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Next Arrow --}}
        <button @click.stop="nextPhoto()"
            class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors p-2 z-20 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm"
            :class="{ 'opacity-30 pointer-events-none': currentPhotos.length <= 1 }">
            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Photo Container — with zoom-in animation --}}
        <div class="relative max-w-5xl w-full max-h-[88vh] flex flex-col items-center"
            x-show="showLightbox"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100">
            <img :src="currentPhoto.url" :alt="currentPhoto.caption"
                class="w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl"
                @click.self.stop="">
            {{-- Caption --}}
            <p x-show="currentPhoto.caption"
                x-text="currentPhoto.caption"
                class="text-center text-white/80 mt-4 text-sm md:text-base max-w-lg px-4"></p>
            {{-- Photo counter --}}
            <p class="text-center text-white/40 mt-2 text-xs">
                <span x-text="currentPhotos.length > 0 ? (lightboxIndex + 1) : 0"></span>
                /
                <span x-text="currentPhotos.length"></span>
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function galleryComponent() {
    return {
        activeTab: 'semua',
        showLightbox: false,
        lightboxIndex: 0,
        inView: false,
        allPhotos: @json($allGalleryPhotos),
        tabKeys: @json(array_keys($tabCategories)),

        get currentPhotos() {
            if (this.activeTab === 'semua') return this.allPhotos;
            return this.allPhotos.filter(p => p.category === this.activeTab);
        },

        get currentPhoto() {
            return this.currentPhotos[this.lightboxIndex] || this.allPhotos[0];
        },

        init() {
            const observer = new IntersectionObserver((entries, obs) => {
                if (entries[0].isIntersecting) {
                    this.inView = true;
                    obs.disconnect();
                }
            }, { threshold: 0.08, rootMargin: '40px' });
            observer.observe(this.$el);
        },

        openLightbox(index) {
            this.lightboxIndex = index;
            this.showLightbox = true;
            document.body.style.overflow = 'hidden';
        },

        closeLightbox() {
            this.showLightbox = false;
            document.body.style.overflow = '';
        },

        prevPhoto() {
            this.lightboxIndex = this.lightboxIndex > 0 ? this.lightboxIndex - 1 : this.currentPhotos.length - 1;
        },

        nextPhoto() {
            this.lightboxIndex = this.lightboxIndex < this.currentPhotos.length - 1 ? this.lightboxIndex + 1 : 0;
        },
    };
}
</script>
@endpush