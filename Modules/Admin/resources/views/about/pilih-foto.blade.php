@extends('admin::layouts.master')

@section('title', "Pilih Foto {$label}")
@section('page_title', "Pilih Foto {$label}")

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.about.edit') }}">Tentang Kami</a></li>
<li class="breadcrumb-item active">Pilih Foto {{ $label }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Pilih Foto {{ $label }} untuk Halaman Tentang Kami
                </h5>
                <a href="{{ route('admin.about.edit') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Tentang Kami
                </a>
            </div>
            <div class="card-body">
                @if($galleries->isEmpty())
                    <div class="alert alert-warning mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Belum ada foto di galeri.
                        <a href="{{ route('admin.gallery.create') }}" class="alert-link">Upload foto sekarang</a>.
                    </div>
                @else
                    {{-- Category Filter Tabs --}}
                    <div class="mb-4 d-flex flex-wrap gap-1">
                        <a href="{{ route('admin.about.pilih-foto', $slot) }}"
                            class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline-secondary' }}">
                            Semua
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('admin.about.pilih-foto', ['slot' => $slot, 'category' => $cat->id]) }}"
                                class="btn btn-sm {{ request('category') == $cat->id ? 'btn-primary' : 'btn-outline-secondary' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Photo Grid --}}
                    <div class="row g-3">
                        {{-- "Tanpa Foto" option --}}
                        <div class="col-4 col-md-3 col-lg-2">
                            <a href="{{ route('admin.about.simpan-foto', ['slot' => $slot, 'photo' => 0]) }}"
                                class="text-decoration-none">
                                <div class="border rounded p-2 text-center h-100 {{ is_null($currentId) ? 'border-primary bg-primary bg-opacity-10' : '' }}">
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height:120px;">
                                        <span class="text-muted">
                                            <i class="fas fa-ban fa-2x mb-2 d-block"></i>
                                            Tanpa Foto
                                        </span>
                                    </div>
                                    <small class="d-block mt-1 text-muted">Kosongkan pilihan</small>
                                    @if(is_null($currentId))
                                        <span class="badge bg-primary mt-1">Dipilih</span>
                                    @endif
                                </div>
                            </a>
                        </div>

                        @foreach($galleries as $photo)
                            <div class="col-4 col-md-3 col-lg-2">
                                <a href="{{ route('admin.about.simpan-foto', ['slot' => $slot, 'photo' => $photo->id]) }}"
                                    class="text-decoration-none">
                                    <div class="border rounded p-2 h-100 {{ $currentId == $photo->id ? 'border-primary bg-primary bg-opacity-10' : '' }}">
                                        <img src="{{ $photo->image_url }}"
                                            alt="{{ $photo->caption ?? 'Foto' }}"
                                            class="img-thumbnail w-100 d-block"
                                            style="height:120px;object-fit:cover;">
                                        <small class="d-block mt-1 text-muted text-truncate">
                                            {{ $photo->caption ?? '(Tanpa caption)' }}
                                        </small>
                                        @if($photo->galleryCategory)
                                            <span class="badge bg-secondary badge-sm">{{ $photo->galleryCategory->name }}</span>
                                        @endif
                                        @if($currentId == $photo->id)
                                            <span class="badge bg-primary mt-1">Dipilih</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $galleries->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection