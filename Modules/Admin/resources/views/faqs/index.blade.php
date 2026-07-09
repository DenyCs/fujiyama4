@extends('admin::layouts.master')

@section('title', 'FAQ — Admin')
@section('page_title', 'FAQ')

@section('breadcrumb')
    <li class="breadcrumb-item active">FAQ</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar FAQ</h5>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah FAQ
        </a>
    </div>
    <div class="card-body">
        @if($faqs->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th style="width: 80px;">Urutan</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $faq->question }}</strong>
                            </td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 300px;">
                                    {{ Str::limit($faq->answer, 100) }}
                                </span>
                            </td>
                            <td class="text-center">{{ $faq->order }}</td>
                            <td>
                                <span class="badge {{ $faq->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $faq->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                        onsubmit="return confirm('Hapus FAQ ini?')">
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
        @else
            <div class="text-center py-5">
                <i class="fas fa-question-circle text-muted fa-3x mb-3"></i>
                <p class="text-muted">Belum ada FAQ. Klik tombol "Tambah FAQ" untuk menambahkan.</p>
            </div>
        @endif
    </div>
</div>
@endsection