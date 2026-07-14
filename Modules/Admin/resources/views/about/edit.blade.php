@extends('admin::layouts.master')

@section('title', 'Tentang Kami')
@section('page_title', 'Tentang Kami')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Tentang Kami</li>
@endsection

@section('content')
    <form action="{{ route('admin.about.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- Text Content (Left) --}}
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Informasi Tentang Kami</h5>
                    </div>
                    <div class="card-body">
                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $about->title) }}" required maxlength="255">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Subtitle --}}
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" id="subtitle"
                                class="form-control @error('subtitle') is-invalid @enderror"
                                value="{{ old('subtitle', $about->subtitle) }}" maxlength="255"
                                placeholder="Misal: Filosofi di Balik Setiap Mangkuk">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Story / Filosofi --}}
                        <div class="mb-3">
                            <label for="story" class="form-label">Cerita / Filosofi</label>
                            <textarea name="story" id="story" rows="12"
                                class="form-control @error('story') is-invalid @enderror"
                                placeholder="Tulis cerita atau filosofi restoran di sini...">{{ old('story', $about->story) }}</textarea>
                            @error('story')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Gunakan teks biasa atau HTML sederhana. Cerita ini akan ditampilkan di landing page.</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Photo Picker Sidebar (Right) — NO MODAL, NO ALPINE, just links --}}
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Pilih Foto untuk Halaman Tentang Kami</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Pilih satu foto utama (besar) dan satu foto sekunder (overlap kecil) yang akan tampil di halaman depan.
                            Klik tombol di bawah untuk memilih foto dari galeri.
                        </p>

                        @if($galleries->isEmpty())
                            <div class="alert alert-warning mb-0">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Belum ada foto di galeri.
                                <a href="{{ route('admin.gallery.create') }}" class="alert-link">Upload foto sekarang</a>.
                            </div>
                        @else
                            {{-- Primary Photo Slot --}}
                            <div class="mb-4 p-3 border rounded">
                                <h6 class="fw-bold mb-3">Foto Utama (Hero)</h6>
                                <div class="text-center mb-2">
                                    @if($about->primaryPhoto)
                                        <img src="{{ $about->primaryPhoto->image_url }}"
                                            alt="{{ $about->primaryPhoto->caption ?? 'Foto Utama' }}"
                                            class="img-thumbnail mb-2" style="max-height:180px;max-width:100%;object-fit:cover;">
                                        <p class="small text-muted mb-0 text-truncate">
                                            {{ $about->primaryPhoto->caption ?? '(Tanpa caption)' }}
                                        </p>
                                        @if($about->primaryPhoto->galleryCategory)
                                            <span class="badge bg-secondary badge-sm">{{ $about->primaryPhoto->galleryCategory->name }}</span>
                                        @endif
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center text-muted"
                                            style="height:140px;">
                                            <div>
                                                <i class="fas fa-image fa-2x mb-2 d-block"></i>
                                                <span>Tanpa Foto</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.about.pilih-foto', 'utama') }}"
                                        class="btn btn-sm btn-outline-primary flex-grow-1 text-center">
                                        <i class="fas fa-search me-1"></i>
                                        {{ $about->primaryPhoto ? 'Ganti Foto' : 'Pilih Foto' }}
                                    </a>
                                    @if($about->primaryPhoto)
                                        <a href="{{ route('admin.about.simpan-foto', ['slot' => 'utama', 'photo' => 0]) }}"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus foto utama?')"
                                            title="Hapus Pilihan">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- Secondary Photo Slot --}}
                            <div class="mb-3 p-3 border rounded">
                                <h6 class="fw-bold mb-3">Foto Sekunder (Overlap)</h6>
                                <div class="text-center mb-2">
                                    @if($about->secondaryPhoto)
                                        <img src="{{ $about->secondaryPhoto->image_url }}"
                                            alt="{{ $about->secondaryPhoto->caption ?? 'Foto Sekunder' }}"
                                            class="img-thumbnail mb-2" style="max-height:180px;max-width:100%;object-fit:cover;">
                                        <p class="small text-muted mb-0 text-truncate">
                                            {{ $about->secondaryPhoto->caption ?? '(Tanpa caption)' }}
                                        </p>
                                        @if($about->secondaryPhoto->galleryCategory)
                                            <span class="badge bg-secondary badge-sm">{{ $about->secondaryPhoto->galleryCategory->name }}</span>
                                        @endif
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center text-muted"
                                            style="height:140px;">
                                            <div>
                                                <i class="fas fa-image fa-2x mb-2 d-block"></i>
                                                <span>Tanpa Foto</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.about.pilih-foto', 'sekunder') }}"
                                        class="btn btn-sm btn-outline-primary flex-grow-1 text-center">
                                        <i class="fas fa-search me-1"></i>
                                        {{ $about->secondaryPhoto ? 'Ganti Foto' : 'Pilih Foto' }}
                                    </a>
                                    @if($about->secondaryPhoto)
                                        <a href="{{ route('admin.about.simpan-foto', ['slot' => 'sekunder', 'photo' => 0]) }}"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus foto sekunder?')"
                                            title="Hapus Pilihan">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <hr>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-info-circle me-1"></i>
                                Upload foto baru melalui halaman <a href="{{ route('admin.gallery.index') }}">Galeri Foto</a>.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit buttons --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary ms-2">
                <i class="fas fa-images me-1"></i> Kelola Galeri Foto
            </a>
        </div>
    </form>
@endsection