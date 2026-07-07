@extends('admin::layouts.master')

@section('title', 'Detail Pesanan ' . $order->order_code)
@section('page_title', 'Detail Pesanan: ' . $order->order_code)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Pesanan</a></li>
    <li class="breadcrumb-item active">{{ $order->order_code }}</li>
@endsection

@section('content')
    <div class="row">
        {{-- Order Info --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Pesanan</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Kode Pesanan</dt>
                        <dd class="col-sm-8"><strong class="text-primary">{{ $order->order_code }}</strong></dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            @php
                                $statusColors = ['pending' => 'warning', 'diproses' => 'info', 'selesai' => 'success', 'batal' => 'danger'];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">Tanggal</dt>
                        <dd class="col-sm-8">{{ $order->created_at->format('d F Y, H:i') }}</dd>

                        <dt class="col-sm-4">Metode Bayar</dt>
                        <dd class="col-sm-8">{{ $order->payment_method === 'transfer' ? 'Transfer Bank' : 'Bayar di Tempat (COD)' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Pemesan</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8">{{ $order->customer_name }}</dd>

                        <dt class="col-sm-4">No. HP</dt>
                        <dd class="col-sm-8">{{ $order->customer_phone }}</dd>

                        @if($order->note)
                        <dt class="col-sm-4">Catatan</dt>
                        <dd class="col-sm-8">{{ $order->note }}</dd>
                        @endif

                        @if($order->user_id)
                        <dt class="col-sm-4">User ID</dt>
                        <dd class="col-sm-8">#{{ $order->user_id }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Item Pesanan</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->menu_name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-dark">
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total</td>
                        <td class="fw-bold text-success">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Update Status Form --}}
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Ubah Status</h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                @foreach(['pending', 'diproses', 'selesai', 'batal'] as $status)
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="{{ $status }}">
                        <button type="submit"
                            class="btn btn-{{ $statusColors[$status] ?? 'secondary' }} {{ $order->status === $status ? 'disabled' : '' }}"
                            {{ $order->status === $status ? 'disabled' : '' }}>
                            {{ ucfirst($status) }}
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
@endsection