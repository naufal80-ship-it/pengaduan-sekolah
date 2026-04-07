@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<h5 class="fw-700 mb-1" style="font-size:1.05rem;font-weight:800;">Masuk ke Akun</h5>
<p class="text-muted mb-4" style="font-size:.82rem;">Silakan masukkan email dan password Anda.</p>

@if($errors->any())
    <div class="alert alert-danger py-2 mb-3" style="font-size:.82rem;border-radius:8px;">
        <i class="bi bi-exclamation-triangle-fill me-1"></i>
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="email@sekolah.sch.id" required autofocus>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
        </div>
    </div>
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <div class="form-check mb-0">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember" style="font-size:.82rem;">Ingat saya</label>
        </div>
    </div>
    <button type="submit" class="btn btn-auth">
        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
    </button>
</form>

<div class="auth-switch mt-3">
    Belum punya akun? <a href="{{ route('register') }}">Daftar sebagai siswa</a>
</div>
<div class="auth-switch mt-1">
    <a href="{{ route('forgot.password') }}">Lupa password?</a>
</div>
@endsection
