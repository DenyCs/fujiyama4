@extends('admin::layouts.master')

@section('title', 'Kategori Galeri — Admin')
@section('page_title', 'Kategori Galeri')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Kategori Galeri</h5>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Galeri
            </a>
            <a href="{{ route('admin.gallery-categories.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Kategori
            </a>
    </div>
    <div class="card-body">
        @if($categories->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Nama Kategori</th>
                            <th style="width: 100px;">Jumlah Foto</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $cat->name }}</strong></td>
                            <td class="text-center">{{ $cat->galleries()->count() }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.gallery-categories.edit', $cat) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.gallery-categories.destroy', $cat) }}" method="POST"
                                        onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-folder-open text-muted fa-3x mb-3"></i>
                <p class="text-muted">Belum ada kategori galeri. Klik tombol "Tambah Kategori" untuk menambahkan.</p>
            </div>
        @endif
    </div>
</div>
@endsection