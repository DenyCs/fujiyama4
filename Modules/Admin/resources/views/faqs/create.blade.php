@extends('admin::layouts.master')

@section('title', 'Tambah FAQ — Admin')
@section('page_title', 'Tambah FAQ')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.faqs.index') }}">FAQ</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Tambah FAQ Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="question" class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                <input type="text" name="question" id="question"
                    class="form-control @error('question') is-invalid @enderror"
                    value="{{ old('question') }}"
                    placeholder="Masukkan pertanyaan..."
                    required maxlength="255">
                @error('question')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="answer" class="form-label">Jawaban <span class="text-danger">*</span></label>
                <textarea name="answer" id="answer" rows="6"
                    class="form-control @error('answer') is-invalid @enderror"
                    placeholder="Masukkan jawaban..."
                    required>{{ old('answer') }}</textarea>
                @error('answer')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="order" class="form-label">Urutan</label>
                    <input type="number" name="order" id="order"
                        class="form-control @error('order') is-invalid @enderror"
                        value="{{ old('order', 0) }}"
                        min="0" placeholder="0">
                    <small class="text-muted">Semakin kecil angka, semakin atas posisinya.</small>
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection