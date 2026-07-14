@extends('admin::layouts.master')

@section('title', 'Tambah Foto Galeri')
@section('page_title', 'Tambah Foto Galeri')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Galeri</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Tambah Foto Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="image" class="form-label">Pilih Foto <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/jpg,image/webp" required
                            onchange="previewImage(event)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: JPG, PNG, WebP. Maks 2MB.</small>
                        <div class="mt-2">
                            <img id="image-preview" src="#" alt="Preview"
                                style="max-height: 200px; display: none; border-radius: 8px; object-fit: cover;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="gallery_category_id" class="form-label">Kategori</label>
                        <select name="gallery_category_id" id="gallery_category_id"
                            class="form-select @error('gallery_category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('gallery_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('gallery_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" name="caption" id="caption"
                            class="form-control @error('caption') is-invalid @enderror"
                            value="{{ old('caption') }}" maxlength="255"
                            placeholder="Misal: Dapur Utama, Ruang Makan, Proses Memasak Ramen">
                        @error('caption')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Urutan</label>
                        <input type="number" name="order" id="order"
                            class="form-control @error('order') is-invalid @enderror"
                            value="{{ old('order', 0) }}" min="0" style="max-width: 120px;">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Angka lebih kecil akan tampil lebih dahulu.</small>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        var preview = document.getElementById('image-preview');
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
@endpush