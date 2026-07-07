@extends('admin::layouts.master')

@section('title', 'Daftar Menu')
@section('page_title', 'Daftar Menu')

@section('breadcrumb')
    <li class="breadcrumb-item active">Menu</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Menu</h5>
            <a href="{{ route('admin.menus.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Menu
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 10%">Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th style="width: 8%">Status</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                            <span class="badge bg-secondary">No Image</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $menu->name }}</strong>
                            @if($menu->description)
                            <br><small class="text-muted">{{ Str::limit($menu->description, 50) }}</small>
                            @endif
                        </td>
                        <td>{{ $menu->category->name ?? '-' }}</td>
                        <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td>
                            @if($menu->is_available)
                            <span class="badge bg-success">Tersedia</span>
                            @else
                            <span class="badge bg-danger">Habis</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-3">Belum ada menu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($menus->hasPages())
        <div class="card-footer">
            {{ $menus->links() }}
        </div>
        @endif
    </div>
@endsection