@extends('layouts.app')
@section('title', 'Edit Pengaduan')
@section('page-title', 'Edit Pengaduan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-3">
            <a href="{{ route('siswa.pengaduan.show', $pengaduan) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-fill me-2 text-primary"></i>Edit Pengaduan
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

                <form method="POST" action="{{ route('siswa.pengaduan.update', $pengaduan) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-600">Judul Pengaduan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $pengaduan->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-600">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                @foreach(['kebersihan','kerusakan','keamanan','fasilitas','lainnya'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $pengaduan->kategori) === $kat ? 'selected' : '' }}>
                                    {{ ucfirst($kat) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-600">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                                   value="{{ old('lokasi', $pengaduan->lokasi) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-600">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror"
                                  required>{{ old('deskripsi', $pengaduan->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-600">Foto Bukti</label>
                        @if($pengaduan->foto)
                            <div class="mb-2">
                                <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto saat ini"
                                     class="rounded" style="max-height:150px;">
                                <div class="form-text">Foto saat ini. Upload baru untuk mengganti.</div>
                            </div>
                        @endif
                        <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg">
                        <div class="form-text">Format: JPG, PNG. Maks. 2MB.</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save-fill me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('siswa.pengaduan.show', $pengaduan) }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
