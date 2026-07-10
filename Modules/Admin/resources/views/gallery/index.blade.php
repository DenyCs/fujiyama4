@extends('admin::layouts.master')

@section('title', 'Galeri')
@section('page_title', 'Galeri Foto')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Galeri</li>
@endsection

@php
    $categoryLabels = [
        'interior'    => 'Interior',
        'proses_masak'=> 'Proses Masak',
        'suasana'     => 'Suasana',
        'lainnya'     => 'Lainnya',
    ];
    $categoryColors = [
        'interior'    => 'bg-primary',
        'proses_masak'=> 'bg-danger',
        'suasana'     => 'bg-success',
        'lainnya'     => 'bg-secondary',
    ];
    $selectedCategory = request('category', '');
@endphp

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <h5 class="card-title mb-0">Daftar Foto</h5>
            <span class="badge bg-info">{{ $galleries->total() }} foto</span>
        </div>
        <div class="d-flex gap-2">
            {{-- Category Filter Dropdown --}}
            <form action="{{ route('admin.gallery.index') }}" method="GET" class="d-flex gap-2">
                <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categoryLabels as $key => $label)
                        <option value="{{ $key }}" {{ $selectedCategory == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Foto
            </a>
        </div>
    </div>

    <div class="card-body">
        @if($galleries->count())
        <div class="row g-3">
            @foreach($galleries as $gallery)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="card h-100 shadow-sm">
                    <div class="position-relative">
                        <img src="{{ $gallery->image_url }}"
                            alt="{{ $gallery->caption ?? 'Foto Galeri' }}"
                            class="card-img-top"
                            style="height: 140px; object-fit: cover;">
                        <span class="badge {{ $categoryColors[$gallery->category] ?? 'bg-secondary' }} position-absolute top-0 end-0 m-2">
                            {{ $categoryLabels[$gallery->category] ?? 'Lainnya' }}
                        </span>
                    </div>
                    <div class="card-body p-2 text-center">
                        <small class="text-muted d-block mb-1">{{ $gallery->caption ?: '-' }}</small>
                        <span class="badge bg-light text-dark">Urutan: {{ $gallery->order }}</span>
                    </div>
                    <div class="card-footer p-1 d-flex justify-content-center gap-1">
                        <a href="{{ route('admin.gallery.edit', $gallery) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5 text-muted">
            <i class="fas fa-images fa-4x mb-3 d-block"></i>
            <p class="fs-5">Belum ada foto di galeri.</p>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Foto Pertama
            </a>
        </div>
        @endif
    </div>

    @if($galleries->hasPages())
    <div class="card-footer">
        {{ $galleries->links() }}
    </div>
    @endif
</div>
@endsection