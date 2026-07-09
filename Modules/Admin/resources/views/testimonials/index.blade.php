@extends('admin::layouts.master')

@section('title', 'Testimoni — Admin')
@section('page_title', 'Testimoni')

@section('breadcrumb')
    <li class="breadcrumb-item active">Testimoni</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Testimoni</h5>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Testimoni
        </a>
    </div>
    <div class="card-body">
        @if($testimonials->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Pelanggan</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Status</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonials->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($testimonial->customer_photo_url)
                                        <img src="{{ $testimonial->customer_photo_url }}" alt="{{ $testimonial->customer_name }}"
                                            class="rounded-circle" style="width:36px;height:36px;object-fit:cover;">
                                    @else
                                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bold"
                                            style="width:36px;height:36px;font-size:12px;">
                                            {{ $testimonial->initials }}
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $testimonial->customer_name }}</strong>
                                        @if($testimonial->order_type)
                                            <br><small class="text-muted">{{ $testimonial->order_type }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-nowrap">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                    {{ $testimonial->review }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $testimonial->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $testimonial->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                        onsubmit="return confirm('Hapus testimoni ini?')">
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
            <div class="mt-3">
                {{ $testimonials->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-star text-muted fa-3x mb-3"></i>
                <p class="text-muted">Belum ada testimoni. Klik tombol "Tambah Testimoni" untuk menambahkan.</p>
            </div>
        @endif
    </div>
</div>
@endsection