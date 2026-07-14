@extends('admin::layouts.master')

@section('title', 'Social Media')
@section('page_title', 'Social Media Links')

@section('breadcrumb')
    <li class="breadcrumb-item active">Social Media</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Social Media</h5>
            <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">Icon</th>
                        <th>Platform</th>
                        <th>URL</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($links as $link)
                        <tr>
                            <td class="text-center">
                                <i class="fab fa-{{ $link->icon_identifier }} fa-lg text-secondary"></i>
                            </td>
                            <td class="fw-semibold">{{ $link->platform }}</td>
                            <td>
                                <a href="{{ $link->url }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 280px;">
                                    {{ $link->url }}
                                </a>
                            </td>
                            <td>{{ $link->order }}</td>
                            <td>
                                <span class="badge {{ $link->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $link->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.social-links.edit', $link) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus social link ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada social link.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection