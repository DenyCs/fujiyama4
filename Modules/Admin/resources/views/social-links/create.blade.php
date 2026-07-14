@extends('admin::layouts.master')

@section('title', 'Tambah Social Media')
@section('page_title', 'Tambah Social Media Link')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.social-links.index') }}">Social Media</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.social-links.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="platform" class="form-label">Platform</label>
                    <select name="platform" id="platform" class="form-select @error('platform') is-invalid @enderror" required>
                        <option value="">-- Pilih Platform --</option>
                        <option value="Instagram" {{ old('platform') === 'Instagram' ? 'selected' : '' }}>Instagram</option>
                        <option value="Facebook" {{ old('platform') === 'Facebook' ? 'selected' : '' }}>Facebook</option>
                        <option value="TikTok" {{ old('platform') === 'TikTok' ? 'selected' : '' }}>TikTok</option>
                        <option value="WhatsApp" {{ old('platform') === 'WhatsApp' ? 'selected' : '' }}>WhatsApp</option>
                        <option value="YouTube" {{ old('platform') === 'YouTube' ? 'selected' : '' }}>YouTube</option>
                        <option value="Twitter/X" {{ old('platform') === 'Twitter/X' ? 'selected' : '' }}>Twitter/X</option>
                        <option value="Lainnya" {{ old('platform') === 'Lainnya' ? 'selected' : '' }}>Lainnya (input manual)</option>
                    </select>
                    @error('platform')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" id="custom-platform-wrapper" style="display: none;">
                    <label for="platform_custom" class="form-label">Nama Platform Custom</label>
                    <input type="text" id="platform_custom" class="form-control" placeholder="Nama platform kustom...">
                    <small class="text-muted">Isi nama platform custom, lalu salin ke field Platform di atas.</small>
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                           value="{{ old('url') }}" placeholder="https://..." required>
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon (opsional — Font Awesome class)</label>
                    <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror"
                           value="{{ old('icon') }}" placeholder="fa-custom-icon">
                    <small class="text-muted">Kosongkan untuk auto-map dari nama platform.</small>
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Urutan</label>
                    <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror"
                           value="{{ old('order', 0) }}" min="0">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.social-links.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('platform').addEventListener('change', function () {
            const wrapper = document.getElementById('custom-platform-wrapper');
            if (this.value === 'Lainnya') {
                wrapper.style.display = 'block';
                // Copy custom platform name to the platform select if user types
                const customInput = document.getElementById('platform_custom');
                customInput.addEventListener('input', function () {
                    // We'll keep the select as "Lainnya" but store value for form submit
                    document.getElementById('platform').setAttribute('data-custom', this.value);
                });
                // When submitting, set platform value to custom input
                this.closest('form').addEventListener('submit', function () {
                    const customName = document.getElementById('platform_custom').value.trim();
                    if (customName && document.getElementById('platform').value === 'Lainnya') {
                        document.getElementById('platform').value = customName;
                    }
                });
            } else {
                wrapper.style.display = 'none';
                document.getElementById('platform').removeAttribute('data-custom');
            }
        });
    </script>
    @endpush
@endsection