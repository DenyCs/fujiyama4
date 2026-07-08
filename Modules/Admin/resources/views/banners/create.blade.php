@extends('admin::layouts.master')

@section('title', 'Tambah Banner')
@section('page_title', 'Tambah Banner')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banner</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Banner</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" required maxlength="255">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="subtitle" class="form-label">Subtitle (Badge)</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
                        value="{{ old('subtitle') }}" maxlength="255"
                        placeholder="Contoh: Promo / Menu Baru">
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Teks kecil di atas judul (badge).</small>
                </div>

                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Deskripsi singkat banner...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Gambar <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/jpg,image/webp" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Rekomendasi ukuran: 1600×900px (landscape lebar). Format: JPG, PNG, WebP. Maks 2MB.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cta_text" class="form-label">Teks Tombol CTA</label>
                    <input type="text" name="cta_text" id="cta_text" class="form-control @error('cta_text') is-invalid @enderror"
                        value="{{ old('cta_text', 'Lihat Selengkapnya') }}" maxlength="255">
                    @error('cta_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cta_link" class="form-label">Link Tujuan CTA</label>
                    <input type="text" name="cta_link" id="cta_link" class="form-control @error('cta_link') is-invalid @enderror"
                        value="{{ old('cta_link') }}" maxlength="255"
                        placeholder="Contoh: /menu atau https://...">
                    @error('cta_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="order" class="form-label">Urutan</label>
                    <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror"
                        value="{{ old('order', 0) }}" min="0">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Urutan tampil (kecil = pertama).</small>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Banner
                </button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection