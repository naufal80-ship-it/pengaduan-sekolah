@extends('layouts.auth')
@section('title', 'Lupa Password')

@section('content')
<h5 style="font-size:1.05rem;font-weight:800;margin-bottom:4px;">Lupa Password</h5>
<p class="text-muted mb-4" style="font-size:.82rem;">Masukkan email dan NIS untuk mereset password.</p>

@if($errors->any())
    <div class="alert alert-danger py-2 mb-3" style="font-size:.82rem;border-radius:8px;">
        <i class="bi bi-exclamation-triangle-fill me-1"></i>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('reset.password') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="email@sekolah.sch.id" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">NIS</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
            <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
                   value="{{ old('nis') }}" placeholder="Nomor Induk Siswa"
                   maxlength="10"
                   oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                   required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Min. 8 karakter" required>
        </div>
    </div>
    <div class="mb-4">
        <label class="form-label">Konfirmasi Password Baru</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="Ulangi password baru" required>
        </div>
    </div>
    <button type="submit" class="btn btn-auth">
        <i class="bi bi-key-fill me-1"></i> Reset Password
    </button>
</form>

<div class="auth-switch mt-3">
    Ingat password? <a href="{{ route('login') }}">Kembali Login</a>
</div>
@endsection
