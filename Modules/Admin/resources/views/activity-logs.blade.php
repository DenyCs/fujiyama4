@extends('admin::layouts.master')

@section('title', 'Log Aktivitas')
@section('page_title', 'Log Aktivitas Admin')

@push('styles')
<style>
    .properties-json {
        max-height: 200px;
        overflow-y: auto;
        font-size: 0.8rem;
        background: #1e293b;
        color: #e2e8f0;
        border-radius: 6px;
        padding: 10px;
        white-space: pre-wrap;
        word-break: break-all;
    }
    .log-detail-modal .modal-body {
        max-height: 60vh;
        overflow-y: auto;
    }
</style>
@endpush

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="card card-outline card-secondary shadow-sm">
            <div class="card-header">
                <h5 class="card-title m-0">
                    <i class="fas fa-filter me-2"></i>Filter
                </h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small">Dari Tanggal</label>
                        <input type="date" name="date_from" class="form-control form-control-sm"
                               value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Sampai Tanggal</label>
                        <input type="date" name="date_to" class="form-control form-control-sm"
                               value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Admin</label>
                        <select name="causer_id" class="form-select form-select-sm">
                            <option value="">Semua</option>
                            @foreach($causers as $id => $name)
                                <option value="{{ $id }}" {{ request('causer_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small">Modul</label>
                        <select name="subject_type" class="form-select form-select-sm">
                            <option value="">Semua</option>
                            @foreach($subjectTypes as $type)
                                <option value="{{ $type['value'] }}" {{ request('subject_type') == $type['value'] ? 'selected' : '' }}>
                                    {{ $type['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-redo me-1"></i>Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h5 class="card-title m-0">
                    <i class="fas fa-history me-2"></i>Riwayat Aktivitas
                </h5>
                <span class="badge bg-secondary ms-2">{{ $logs->total() }} aktivitas</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Waktu</th>
                                <th>Admin</th>
                                <th>Aktivitas</th>
                                <th>Modul</th>
                                <th style="width: 60px;">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr>
                                <td class="text-muted small">{{ $log->id }}</td>
                                <td class="text-nowrap small">
                                    {{ $log->created_at->format('d M Y') }}
                                    <br>
                                    <span class="text-muted">{{ $log->created_at->format('H:i') }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $log->causer?->name ?? 'System' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="small">{{ $log->description }}</span>
                                </td>
                                <td>
                                    @if($log->subject_type)
                                        <span class="badge bg-secondary small">
                                            {{ class_basename($log->subject_type) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info view-detail"
                                            data-id="{{ $log->id }}" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada aktivitas tercatat.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($logs->hasPages())
            <div class="card-footer">
                {{ $logs->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Detail Modal --}}
<div class="modal fade log-detail-modal" id="logDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-clipboard-list me-2"></i>Detail Aktivitas
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="logDetailContent">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2 text-muted">Memuat detail...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('logDetailModal'));

    document.querySelectorAll('.view-detail').forEach(btn => {
        btn.addEventListener('click', function () {
            const logId = this.dataset.id;
            const contentDiv = document.getElementById('logDetailContent');

            // Show loading
            contentDiv.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2 text-muted">Memuat detail...</p>
                </div>
            `;
            modal.show();

            fetch(`/admin/activity-logs/${logId}`)
                .then(res => res.json())
                .then(data => {
                    const props = data.properties || {};
                    const oldAttrs = props.old || {};
                    const newAttrs = props.attributes || {};

                    let changesHtml = '';
                    if (Object.keys(oldAttrs).length > 0 || Object.keys(newAttrs).length > 0) {
                        changesHtml = `
                            <h6 class="mt-3 mb-2 fw-bold">Perubahan Data:</h6>
                            <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                    <tr><th>Field</th><th>Sebelum</th><th>Sesudah</th></tr>
                                </thead>
                                <tbody>
                        `;
                        const allKeys = new Set([...Object.keys(oldAttrs), ...Object.keys(newAttrs)]);
                        allKeys.forEach(key => {
                            const oldVal = oldAttrs[key] !== undefined ? String(oldAttrs[key]) : '-';
                            const newVal = newAttrs[key] !== undefined ? String(newAttrs[key]) : '-';
                            const changed = oldVal !== newVal;
                            changesHtml += `
                                <tr>
                                    <td class="fw-semibold">${key}</td>
                                    <td class="${changed ? 'text-danger' : ''}">${escapeHtml(oldVal)}</td>
                                    <td class="${changed ? 'text-success' : ''}">${escapeHtml(newVal)}</td>
                                </tr>
                            `;
                        });
                        changesHtml += '</tbody></table>';
                    }

                    contentDiv.innerHTML = `
                        <div class="row mb-2">
                            <div class="col-sm-4 text-muted small">Waktu</div>
                            <div class="col-sm-8">${data.created_at}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-muted small">Admin</div>
                            <div class="col-sm-8"><span class="badge bg-info">${data.causer_name}</span></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-muted small">Aktivitas</div>
                            <div class="col-sm-8 fw-semibold">${data.description}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-muted small">Modul</div>
                            <div class="col-sm-8"><span class="badge bg-secondary">${data.subject_type}</span></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-muted small">ID Subjek</div>
                            <div class="col-sm-8"><code>${data.subject_id ?? '-'}</code></div>
                        </div>
                        ${changesHtml}
                        <h6 class="mt-3 mb-2 fw-bold">Data Lengkap (JSON):</h6>
                        <pre class="properties-json">${JSON.stringify(props, null, 2)}</pre>
                    `;
                })
                .catch(err => {
                    contentDiv.innerHTML = `
                        <div class="alert alert-danger mb-0">
                            Gagal memuat detail. Silakan coba lagi.
                        </div>
                    `;
                });
        });
    });
});

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>
@endpush