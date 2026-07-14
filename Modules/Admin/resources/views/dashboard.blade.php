@extends('admin::layouts.master')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('content')
    {{-- 1. Quick Actions --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent border-bottom-0 pb-0">
                    <h5 class="card-title mb-0 text-orange fw-bold" style="color:#f97316 !important;">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h5>
                </div>
                <div class="card-body pt-2">
                    <div class="row g-3">
                        <div class="col-lg-4 col-md-4 col-12">
                            <a href="{{ route('admin.menus.create') }}"
                               class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 border rounded-3 quick-action-card"
                                     style="transition: all 0.2s ease;">
                                    <div class="flex-shrink-0 me-3">
                                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                              style="width:48px;height:48px;background:rgba(249,115,22,0.12);">
                                            <i class="fas fa-plus-circle fa-lg" style="color:#f97316;"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold" style="font-size:0.95rem;">Tambah Menu Baru</div>
                                        <small class="text-muted">Buat menu makanan/minuman</small>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <i class="fas fa-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <a href="{{ route('admin.events.create') }}"
                               class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 border rounded-3 quick-action-card"
                                     style="transition: all 0.2s ease;">
                                    <div class="flex-shrink-0 me-3">
                                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                              style="width:48px;height:48px;background:rgba(249,115,22,0.12);">
                                            <i class="fas fa-calendar-plus fa-lg" style="color:#f97316;"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold" style="font-size:0.95rem;">Tambah Event/Promo</div>
                                        <small class="text-muted">Buat promo atau acara baru</small>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <i class="fas fa-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <a href="{{ route('admin.orders.index') }}"
                               class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 border rounded-3 quick-action-card"
                                     style="transition: all 0.2s ease;">
                                    <div class="flex-shrink-0 me-3">
                                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                              style="width:48px;height:48px;background:rgba(249,115,22,0.12);">
                                            <i class="fas fa-receipt fa-lg" style="color:#f97316;"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold" style="font-size:0.95rem;">Lihat Semua Pesanan</div>
                                        <small class="text-muted">Kelola pesanan pelanggan</small>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <i class="fas fa-chevron-right text-muted"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Revenue Chart + Top Menus (side by side) --}}
    <div class="row">
        {{-- Revenue Chart 7 Hari --}}
        <div class="col-lg-8 col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2" style="color:#f97316;"></i>Pendapatan 7 Hari Terakhir
                    </h5>
                </div>
                <div class="card-body">
                    @if(collect($revenueData)->sum('total') === 0)
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-chart-bar fa-3x mb-3 d-block opacity-50"></i>
                            <p class="mb-0">Belum ada data pendapatan untuk ditampilkan.</p>
                        </div>
                    @else
                        <canvas id="revenueChart" style="min-height: 300px; height: 300px; max-height: 300px; width: 100%;"></canvas>
                    @endif
                </div>
            </div>
        </div>

        {{-- Top 5 Menus --}}
        <div class="col-lg-4 col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-crown me-2" style="color:#f97316;"></i>Menu Terlaris Minggu Ini
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($topMenus->isEmpty())
                        <div class="text-center py-5 text-muted px-3">
                            <i class="fas fa-utensils fa-2x mb-3 d-block opacity-50"></i>
                            <p class="mb-0">Belum ada data penjualan minggu ini.</p>
                        </div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($topMenus as $index => $menu)
                                <li class="list-group-item d-flex align-items-center px-3 py-3">
                                    <div class="flex-shrink-0 me-3">
                                        @if($index === 0)
                                            <span class="badge rounded-pill d-inline-flex align-items-center justify-content-center"
                                                  style="width:32px;height:32px;background:#f97316;color:#fff;font-size:0.85rem;font-weight:700;">
                                                {{ $index + 1 }}
                                            </span>
                                        @elseif($index === 1)
                                            <span class="badge rounded-pill d-inline-flex align-items-center justify-content-center"
                                                  style="width:32px;height:32px;background:#6b7280;color:#fff;font-size:0.85rem;font-weight:700;">
                                                {{ $index + 1 }}
                                            </span>
                                        @elseif($index === 2)
                                            <span class="badge rounded-pill d-inline-flex align-items-center justify-content-center"
                                                  style="width:32px;height:32px;background:#92400e;color:#fff;font-size:0.85rem;font-weight:700;">
                                                {{ $index + 1 }}
                                            </span>
                                        @else
                                            <span class="badge rounded-pill d-inline-flex align-items-center justify-content-center bg-secondary"
                                                  style="width:32px;height:32px;font-size:0.85rem;font-weight:600;">
                                                {{ $index + 1 }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1" style="min-width:0;">
                                        <div class="fw-semibold text-truncate" style="font-size:0.9rem;">
                                            {{ $menu->menu_name }}
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2 text-end">
                                        <span class="fw-bold" style="color:#f97316;">{{ $menu->total_qty }}</span>
                                        <small class="text-muted d-block" style="font-size:0.75rem;">terjual</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('revenueChart');
    if (!canvas) return;

    const revenueData = @json($revenueData);

    const labels = revenueData.map(d => d.date);
    const data = revenueData.map(d => d.total);

    const ctx = canvas.getContext('2d');

    // Detect dark mode
    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark' ||
                   document.body.classList.contains('dark-mode');

    const gridColor = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)';
    const textColor = isDark ? 'rgba(255,255,255,0.7)' : 'rgba(0,0,0,0.6)';

    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(249,115,22,0.25)');
    gradient.addColorStop(1, 'rgba(249,115,22,0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan',
                data: data,
                borderColor: '#f97316',
                backgroundColor: gradient,
                borderWidth: 2.5,
                fill: true,
                tension: 0.35,
                pointBackgroundColor: '#f97316',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointHoverBackgroundColor: '#f97316',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    backgroundColor: isDark ? '#1f2937' : '#fff',
                    titleColor: isDark ? '#f3f4f6' : '#111827',
                    bodyColor: isDark ? '#d1d5db' : '#374151',
                    borderColor: isDark ? '#374151' : '#e5e7eb',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: gridColor,
                        drawBorder: false,
                    },
                    ticks: {
                        color: textColor,
                        font: { size: 11 },
                        maxRotation: 0,
                    },
                    border: {
                        display: false,
                    }
                },
                y: {
                    grid: {
                        color: gridColor,
                        drawBorder: false,
                    },
                    ticks: {
                        color: textColor,
                        font: { size: 11 },
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                            if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + 'rb';
                            return 'Rp ' + value;
                        }
                    },
                    border: {
                        display: false,
                    },
                    beginAtZero: true,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.quick-action-card:hover {
    border-color: #f97316 !important;
    background: rgba(249,115,22,0.04);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(249,115,22,0.08);
}
</style>
@endpush