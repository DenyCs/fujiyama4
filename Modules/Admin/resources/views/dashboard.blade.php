@extends('admin::layouts.master')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    {{-- Small Boxes --}}
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $orderCount ?? 0 }}</h3>
                    <p>Pesanan Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                    Lihat Pesanan <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($revenueToday ?? 0, 0, ',', '.') }}</h3>
                    <p>Pendapatan Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box text-bg-info">
                <div class="inner">
                    <h3>{{ $menuCount ?? 0 }}</h3>
                    <p>Menu Tersedia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <a href="{{ route('admin.menus.index') }}" class="small-box-footer">
                    Kelola Menu <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Quick Info --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Selamat Datang di Panel Admin</h5>
                </div>
                <div class="card-body">
                    <p>Gunakan menu di sidebar kiri untuk mengelola:</p>
                    <ul>
                        <li><strong>Kategori</strong> — Tambah, edit, atau hapus kategori menu</li>
                        <li><strong>Menu</strong> — Kelola daftar menu beserta harga dan gambar</li>
                        <li><strong>Pesanan</strong> — Lihat dan ubah status pesanan pelanggan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection