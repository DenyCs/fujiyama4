@extends('admin::layouts.master')

@section('title', 'Reservasi — Admin')

@section('content_header')
<h1 class="m-0 text-dark">Reservasi Meja</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title">Daftar Reservasi</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Orang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $r)
                <tr>
                    <td>{{ $reservations->firstItem() + $loop->index }}</td>
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->phone }}</td>
                    <td>{{ $r->reservation_date->format('d M Y') }}</td>
                    <td>{{ $r->reservation_time }}</td>
                    <td>{{ $r->guest_count }}</td>
                    <td>
                        @if($r->status === 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($r->status === 'confirmed')
                            <span class="badge bg-success">Dikonfirmasi</span>
                        @else
                            <span class="badge bg-danger">Dibatalkan</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.reservations.show', $r) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada reservasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($reservations->hasPages())
    <div class="card-footer clearfix">
        {{ $reservations->links() }}
    </div>
    @endif
</div>
@endsection