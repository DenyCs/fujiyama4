@extends('admin::layouts.master')

@section('title', 'Tentang Kami')
@section('page_title', 'Tentang Kami')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Tentang Kami</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Informasi Tentang Kami</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.about.update') }}" method="POST">
            @csrf
            @method('PUT')

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

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary ms-2">
                    <i class="fas fa-images me-1"></i> Kelola Galeri Foto
                </a>
            </div>
        </form>
    </div>
</div>
@endsection