@extends('admin::layouts.master')

@section('title', 'Banner')
@section('page_title', 'Banner')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item active">Banner</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Banner</h5>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Banner
        </a>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th style="width: 80px">Gambar</th>
                    <th>Judul</th>
                    <th>Subtitle</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                <tr>
                    <td>
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                            style="width: 60px; height: 35px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td>{{ $banner->title }}</td>
                    <td>{{ $banner->subtitle ?: '-' }}</td>
                    <td>{{ $banner->order }}</td>
                    <td>
                        <span class="badge {{ $banner->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $banner->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus banner ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3 text-muted">Belum ada banner.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($banners->hasPages())
    <div class="card-footer">
        {{ $banners->links() }}
    </div>
    @endif
</div>
@endsection