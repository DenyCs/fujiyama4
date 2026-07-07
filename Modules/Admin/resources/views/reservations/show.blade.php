@extends('admin::layouts.master')

@section('title', 'Detail Reservasi — Admin')

@section('content_header')
<h1 class="m-0 text-dark">Detail Reservasi</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Reservasi</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th>Nama</th><td>{{ $reservation->name }}</td></tr>
                    <tr><th>No HP</th><td>{{ $reservation->phone }}</td></tr>
                    <tr><th>Tanggal</th><td>{{ $reservation->reservation_date->format('d M Y') }}</td></tr>
                    <tr><th>Jam</th><td>{{ $reservation->reservation_time }}</td></tr>
                    <tr><th>Jumlah Orang</th><td>{{ $reservation->guest_count }}</td></tr>
                    <tr><th>Catatan</th><td>{{ $reservation->note ?? '—' }}</td></tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($reservation->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($reservation->status === 'confirmed')
                                <span class="badge bg-success">Dikonfirmasi</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Status</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.reservations.updateStatus', $reservation) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="status">Pilih Status</label>
                        <select name="status" id="status" class="form-control">
                            @foreach(\Modules\Reservation\Models\Reservation::STATUSES as $key => $label)
                                <option value="{{ $key }}" {{ $reservation->status === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-default">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Pre-Order Section --}}
@php
    $preOrders = $reservation->orders()->with('items')->get();
@endphp
@if ($preOrders->isNotEmpty())
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-orange">
                <h3 class="card-title">
                    <i class="fas fa-shopping-cart mr-1"></i> Pre-Order Terkait Reservasi Ini
                </h3>
            </div>
            <div class="card-body p-0">
                @foreach ($preOrders as $order)
                    <div class="p-3 border-bottom">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Kode Pesanan:</strong>
                                <span class="text-primary">{{ $order->order_code }}</span>
                                <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'diproses' ? 'info' : ($order->status === 'selesai' ? 'success' : 'danger')) }} ml-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                        <table class="table table-sm table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Menu</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->menu_name }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@endsection
