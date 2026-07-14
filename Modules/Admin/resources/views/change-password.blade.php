@extends('admin::layouts.master')

@section('title', 'Ganti Password')
@section('page_title', 'Ganti Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-header">
                <h5 class="card-title m-0">
                    <i class="fas fa-lock me-2"></i>Ganti Password
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.change-password.update') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" id="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               placeholder="Masukkan password saat ini" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control"
                               placeholder="Ulangi password baru" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan Password Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection