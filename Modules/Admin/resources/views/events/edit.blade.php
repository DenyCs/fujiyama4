@extends('admin::layouts.master')

@section('title', 'Edit Event')
@section('content_header', 'Edit Event')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Event</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $event->description) }}</textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}" required>
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_date">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}" required>
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            @if ($event->image)
            <div class="form-group">
                <label>Gambar Saat Ini</label>
                <br>
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" style="max-width: 200px; border-radius: 4px;">
            </div>
            @endif

            <div class="form-group">
                <label for="image">Ganti Gambar (opsional)</label>
                <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                <small class="form-text text-muted">Format: JPG, JPEG, PNG, WEBP. Maks 2 MB. Kosongkan jika tidak ingin mengganti gambar.</small>
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="discount_promo">Diskon / Promo (opsional)</label>
                <input type="text" name="discount_promo" id="discount_promo" class="form-control @error('discount_promo') is-invalid @enderror" value="{{ old('discount_promo', $event->discount_promo) }}" placeholder="Contoh: Diskon 20%">
                @error('discount_promo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="active" {{ old('status', $event->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $event->status) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection