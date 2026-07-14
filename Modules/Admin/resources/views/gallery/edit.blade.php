@extends('admin::layouts.master')

@section('title', 'Edit Foto Galeri')
@section('page_title', 'Edit Foto Galeri')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Galeri</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Foto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label>
                        <div>
                            <img src="{{ $gallery->image_url }}" alt="{{ $gallery->caption ?? 'Foto' }}"
                                style="max-height: 200px; border-radius: 8px; object-fit: cover;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ganti Foto (opsional)</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            onchange="previewNewImage(event)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto. Format: JPG, PNG, WebP. Maks 2MB.</small>
                        <div class="mt-2">
                            <img id="image-preview" src="#" alt="Preview Baru"
                                style="max-height: 200px; display: none; border-radius: 8px; object-fit: cover;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="gallery_category_id" class="form-label">Kategori</label>
                        <select name="gallery_category_id" id="gallery_category_id"
                            class="form-select @error('gallery_category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('gallery_category_id', $gallery->gallery_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                            value="{{ old('caption', $gallery->caption) }}" maxlength="255"
                            placeholder="Misal: Dapur Utama, Ruang Makan, Proses Memasak Ramen">
                        @error('caption')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Urutan</label>
                        <input type="number" name="order" id="order"
                            class="form-control @error('order') is-invalid @enderror"
                            value="{{ old('order', $gallery->order) }}" min="0" style="max-width: 120px;">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Angka lebih kecil akan tampil lebih dahulu.</small>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
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
    function previewNewImage(event) {
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