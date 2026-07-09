@extends('admin::layouts.master')

@section('title', 'Edit Testimoni — Admin')
@section('page_title', 'Edit Testimoni')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimoni</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit Testimoni</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="customer_name" class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror"
                        value="{{ old('customer_name', $testimonial->customer_name) }}" required maxlength="255">
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="order_type" class="form-label">Pesan Menu</label>
                    <input type="text" name="order_type" id="order_type" class="form-control @error('order_type') is-invalid @enderror"
                        value="{{ old('order_type', $testimonial->order_type) }}" maxlength="255" placeholder="Contoh: Tonkotsu Ramen, Chicken Katsu">
                    @error('order_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="customer_photo" class="form-label">Foto Pelanggan</label>
                    @if($testimonial->customer_photo_url)
                        <div class="mb-2">
                            <img src="{{ $testimonial->customer_photo_url }}" alt="{{ $testimonial->customer_name }}"
                                class="rounded-circle" style="width:64px;height:64px;object-fit:cover;">
                            <small class="text-muted ms-2">Foto saat ini</small>
                        </div>
                    @endif
                    <input type="file" name="customer_photo" id="customer_photo" class="form-control @error('customer_photo') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/jpg,image/webp">
                    <small class="text-muted">Format: JPG, PNG, WEBP. Maks 2MB. Kosongkan jika tidak ingin mengganti.</small>
                    @error('customer_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                    <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} ⭐</option>
                        @endfor
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="order" class="form-label">Urutan</label>
                    <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror"
                        value="{{ old('order', $testimonial->order) }}" min="0">
                    <small class="text-muted">Angka lebih kecil tampil lebih dulu.</small>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Review <span class="text-danger">*</span></label>
                <textarea name="review" id="review" rows="4" class="form-control @error('review') is-invalid @enderror"
                    required placeholder="Tulis review dari pelanggan...">{{ old('review', $testimonial->review) }}</textarea>
                @error('review')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="active" {{ old('status', $testimonial->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $testimonial->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection