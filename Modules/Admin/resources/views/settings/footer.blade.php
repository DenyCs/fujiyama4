@extends('admin::layouts.master')

@section('title', 'Pengaturan Footer')
@section('header', 'Pengaturan Footer')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0"><i class="bi bi-file-earmark-text me-2"></i>Pengaturan Footer Website</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.footer.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-muted fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-text-paragraph me-1"></i> Konten Footer
                        </h6>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="footer_description" class="form-label">Deskripsi Footer</label>
                        <textarea name="footer_description" id="footer_description" rows="3"
                            class="form-control @error('footer_description') is-invalid @enderror"
                            placeholder="Authentic Japanese ramen experience...">{{ old('footer_description', $setting->footer_description) }}</textarea>
                        <div class="form-text">Teks deskripsi singkat restoran yang tampil di footer website.</div>
                        @error('footer_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="copyright_text" class="form-label">Teks Copyright</label>
                        <input type="text" name="copyright_text" id="copyright_text"
                            class="form-control @error('copyright_text') is-invalid @enderror"
                            value="{{ old('copyright_text', $setting->copyright_text) }}"
                            placeholder="Fujiyama Ramen. All rights reserved.">
                        <div class="form-text">
                            Tahun &copy; ditambahkan otomatis. Contoh output:
                            &copy; {{ date('Y') }} <strong id="copyright-preview">{{ old('copyright_text', $setting->copyright_text) ?: 'Fujiyama Ramen. All rights reserved.' }}</strong>
                        </div>
                        @error('copyright_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('copyright_text').addEventListener('input', function() {
        document.getElementById('copyright-preview').textContent = this.value || 'Fujiyama Ramen. All rights reserved.';
    });
</script>
@endpush