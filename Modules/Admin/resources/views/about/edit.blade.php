@extends('admin::layouts.master')

@section('title', 'Tentang Kami')
@section('page_title', 'Tentang Kami')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Tentang Kami</li>
@endsection

@section('content')
{{-- Tab Navigation --}}
<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#text-tab" type="button" role="tab">
            <i class="fas fa-pen me-1"></i> Teks & Cerita
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#gallery-tab" type="button" role="tab">
            <i class="fas fa-images me-1"></i> Galeri Foto
            <span class="badge bg-secondary ms-1">{{ $galleries->count() }}</span>
        </button>
    </li>
</ul>

<div class="tab-content">
    {{-- ============================================= --}}
    {{-- TAB 1: EDIT TEXT (SINGLETON)                  --}}
    {{-- ============================================= --}}
    <div class="tab-pane fade show active" id="text-tab" role="tabpanel">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi Tentang Kami</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $about->title) }}" required maxlength="255">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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

                    <div class="mb-3">
                        <label for="story" class="form-label">Cerita / Filosofi</label>
                        <textarea name="story" id="story" rows="12"
                            class="form-control @error('story') is-invalid @enderror"
                            placeholder="Ceritakan filosofi, sejarah, atau kisah di balik Fujiyama Ramen...">{{ old('story', $about->story) }}</textarea>
                        @error('story')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Teks panjang — bisa berisi cerita filosofi restoran, sejarah, dll.</small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ============================================= --}}
    {{-- TAB 2: GALLERY FOTO                           --}}
    {{-- ============================================= --}}
    <div class="tab-pane fade" id="gallery-tab" role="tabpanel">
        {{-- Form Tambah Foto --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Tambah Foto Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="image" class="form-label">Pilih Foto <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/jpg,image/webp" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, WebP. Maks 2MB.</small>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select name="category" id="category"
                                class="form-select @error('category') is-invalid @enderror">
                                <option value="interior" {{ old('category') == 'interior' ? 'selected' : '' }}>Interior</option>
                                <option value="proses_masak" {{ old('category') == 'proses_masak' ? 'selected' : '' }}>Proses Masak</option>
                                <option value="suasana" {{ old('category') == 'suasana' ? 'selected' : '' }}>Suasana</option>
                                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <input type="text" name="caption" id="caption"
                                class="form-control @error('caption') is-invalid @enderror"
                                value="{{ old('caption') }}" maxlength="255"
                                placeholder="Misal: Dapur Utama, Ruang Makan">
                            @error('caption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-1 mb-3">
                            <label for="order" class="form-label">Urutan</label>
                            <input type="number" name="order" id="order"
                                class="form-control @error('order') is-invalid @enderror"
                                value="{{ old('order', 0) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-1 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- List Foto yang Sudah Ada --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Daftar Foto ({{ $galleries->count() }})</h5>
            </div>
            <div class="card-body p-0">
                @if($galleries->count())
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 100px;">Foto</th>
                                <th>Caption</th>
                                <th>Kategori</th>
                                <th style="width: 80px;">Urutan</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $categoryLabels = [
                                    'interior' => 'Interior',
                                    'proses_masak' => 'Proses Masak',
                                    'suasana' => 'Suasana',
                                    'lainnya' => 'Lainnya',
                                ];
                                $categoryColors = [
                                    'interior' => 'bg-primary',
                                    'proses_masak' => 'bg-danger',
                                    'suasana' => 'bg-success',
                                    'lainnya' => 'bg-secondary',
                                ];
                            @endphp
                            @foreach($galleries as $gallery)
                            <tr>
                                <td>
                                    <img src="{{ $gallery->image_url }}"
                                        alt="{{ $gallery->caption ?? 'Foto' }}"
                                        style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px;">
                                </td>
                                <td class="align-middle">
                                    {{ $gallery->caption ?? '-' }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge {{ $categoryColors[$gallery->category] ?? 'bg-secondary' }}">
                                        {{ $categoryLabels[$gallery->category] ?? 'Lainnya' }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-info">{{ $gallery->order }}</span>
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('admin.about.gallery.destroy', $gallery) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-images fa-3x mb-3 d-block"></i>
                    <p>Belum ada foto di galeri. Tambahkan foto pertama melalui form di atas.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Keep active tab after form submission with errors
    document.addEventListener('DOMContentLoaded', function () {
        @if($errors->has('image') || $errors->has('caption') || $errors->has('order') || $errors->has('category'))
            // Switch to gallery tab if gallery-related validation errors exist
            var galleryTab = document.querySelector('[data-bs-target="#gallery-tab"]');
            if (galleryTab) {
                var tab = new bootstrap.Tab(galleryTab);
                tab.show();
            }
        @endif
    });
</script>
@endpush