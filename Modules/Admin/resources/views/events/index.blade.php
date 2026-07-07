@extends('admin::layouts.master')

@section('title', 'Event & Promo')
@section('content_header', 'Event & Promo')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Event</h3>
        <div class="card-tools">
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Event
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Diskon / Promo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->start_date->format('d M Y') }}</td>
                    <td>{{ $event->end_date->format('d M Y') }}</td>
                    <td>{{ $event->discount_promo ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ $event->status === 'active' ? 'success' : 'secondary' }}">
                            {{ $event->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus event ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada event.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $events->links() }}
    </div>
</div>
@endsection