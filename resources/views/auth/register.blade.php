@extends('layouts.auth')
@section('title', 'Daftar')

@section('content')
<h5 style="font-size:1.05rem;font-weight:800;" class="mb-1">Daftar Akun Siswa</h5>
<p class="text-muted mb-4" style="font-size:.82rem;">Isi data diri Anda untuk membuat akun.</p>

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

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="Nama lengkap" required>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-7">
            <label class="form-label">NIS</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <input type="text" name="nis"
       class="form-control @error('nis') is-invalid @enderror"
       value="{{ old('nis') }}"
       placeholder="Nomor Induk Siswa"
       maxlength="10"
       oninput="this.value=this.value.replace(/[^0-9]/g,'')"
       required>
@error('nis')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
        <div class="col-5">
            <label class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror"
                   value="{{ old('kelas') }}" placeholder="X IPA 1" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="email@sekolah.sch.id" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Min. 8 karakter" required>
        </div>
    </div>
    <div class="mb-4">
        <label class="form-label">Konfirmasi Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="Ulangi password" required>
        </div>
    </div>
    <button type="submit" class="btn btn-auth">
        <i class="bi bi-person-plus-fill me-1"></i> Daftar Sekarang
    </button>
</form>

<div class="auth-switch mt-3">
    Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
</div>
@endsection
