@extends('admin::layouts.master')

@section('title', 'Lokasi & Jam Buka')
@section('header', 'Lokasi & Jam Buka')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0"><i class="bi bi-geo-alt-fill me-2"></i>Pengaturan Lokasi & Jam Operasional</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.location.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-muted fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-building me-1"></i> Informasi Restoran
                        </h6>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="address" id="address" rows="3"
                            class="form-control @error('address') is-invalid @enderror"
                            placeholder="Jl. Fujiyama No. 123, Kawasan Kuliner, Jakarta Selatan">{{ old('address', $setting->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $setting->phone) }}"
                            placeholder="+622112345678">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-muted fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-map me-1"></i> Google Maps Embed
                        </h6>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="google_maps_embed_url" class="form-label">Google Maps Embed URL</label>
                        <input type="url" name="google_maps_embed_url" id="google_maps_embed_url"
                            class="form-control @error('google_maps_embed_url') is-invalid @enderror"
                            value="{{ old('google_maps_embed_url', $setting->google_maps_embed_url) }}"
                            placeholder="https://www.google.com/maps/embed?pb=...">
                        <div class="form-text mt-2">
                            <strong>Cara mendapatkan:</strong> Buka <a href="https://maps.google.com" target="_blank">Google Maps</a> →
                            cari lokasi restoran → klik <strong>Share</strong> → pilih tab <strong>Embed a map</strong> →
                            copy URL dari atribut <code>src</code> iframe → paste di sini.
                        </div>
                        @error('google_maps_embed_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Preview Map --}}
                        @if($setting->google_maps_embed_url)
                            <div class="mt-3 ratio ratio-16x9 rounded overflow-hidden border" style="max-height: 300px;">
                                <iframe src="{{ $setting->google_maps_embed_url }}"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-muted fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-clock me-1"></i> Jam Operasional
                        </h6>
                    </div>

                    @php
                        $days = [
                            'senin' => 'Senin',
                            'selasa' => 'Selasa',
                            'rabu' => 'Rabu',
                            'kamis' => 'Kamis',
                            'jumat' => 'Jumat',
                            'sabtu' => 'Sabtu',
                            'minggu' => 'Minggu',
                        ];
                        $dayKeys = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                        $today = $dayKeys[(int) now()->dayOfWeek];
                    @endphp

                    @foreach($days as $key => $label)
                        @php
                            $isToday = ($key === $today);
                            $value = old('opening_hours.' . $key, $setting->opening_hours[$key] ?? '');
                        @endphp
                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="opening_{{ $key }}" class="form-label">
                                {{ $label }}
                                @if($isToday)
                                    <span class="badge bg-orange ms-1" style="background-color:#f97316;">Hari Ini</span>
                                @endif
                            </label>
                            <input type="text" name="opening_hours[{{ $key }}]"
                                id="opening_{{ $key }}"
                                class="form-control {{ $isToday ? 'border-warning' : '' }} @error('opening_hours.' . $key) is-invalid @enderror"
                                value="{{ $value }}"
                                placeholder="11:00 - 22:00 atau Tutup">
                            @error('opening_hours.' . $key)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection