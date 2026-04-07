@extends('layouts.app')
@section('title', 'Buat Pengaduan')
@section('page-title', 'Buat Pengaduan Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-megaphone-fill me-2 text-primary"></i>Form Pengaduan Sarana Sekolah
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li style="font-size:.85rem;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('siswa.pengaduan.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-600">Judul Pengaduan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}" placeholder="Contoh: Toilet lantai 2 rusak" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-600">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="kebersihan" {{ old('kategori') === 'kebersihan' ? 'selected' : '' }}>🧹 Kebersihan</option>
                                <option value="kerusakan"  {{ old('kategori') === 'kerusakan'  ? 'selected' : '' }}>🔧 Kerusakan</option>
                                <option value="keamanan"   {{ old('kategori') === 'keamanan'   ? 'selected' : '' }}>🔒 Keamanan</option>
                                <option value="fasilitas"  {{ old('kategori') === 'fasilitas'  ? 'selected' : '' }}>🏫 Fasilitas</option>
                                <option value="lainnya"    {{ old('kategori') === 'lainnya'    ? 'selected' : '' }}>📋 Lainnya</option>
                            </select>
                            @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Lokasi Kejadian <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                                   value="{{ old('lokasi') }}" placeholder="Contoh: Gedung A, Lantai 2" required>
                            @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-600">Deskripsi Detail <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Jelaskan masalah secara detail. Minimal 20 karakter." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">Minimal 20 karakter. Semakin detail semakin mudah ditindaklanjuti.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-600">Foto Bukti <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                               accept="image/jpeg,image/png,image/jpg" id="fotoInput">
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">Format: JPG, PNG. Maks. 2MB.</div>
                        <div id="fotoPreview" class="mt-2 d-none">
                            <img id="previewImg" src="" alt="Preview" class="rounded" style="max-height:200px;max-width:100%;object-fit:cover;">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send-fill me-2"></i>Kirim Pengaduan
                        </button>
                        <a href="{{ route('siswa.pengaduan.index') }}" class="btn btn-outline-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('fotoPreview').classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
