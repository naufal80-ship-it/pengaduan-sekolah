@extends('layouts.app')
@section('title', 'Detail Pengaduan')
@section('page-title', 'Detail Pengaduan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Back button -->
        <div class="mb-3">
            <a href="{{ route('siswa.pengaduan.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-file-text me-2 text-primary"></i>Informasi Pengaduan</span>
                <div class="d-flex gap-2 align-items-center">
                    {!! $pengaduan->kategoriBadge !!}
                    {!! $pengaduan->statusBadge !!}
                </div>
            </div>
            <div class="card-body">
                <h5 class="fw-800 mb-3">{{ $pengaduan->judul }}</h5>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded-2" style="background:#f8fafc;border:1px solid #e2e8f0;">
                            <div style="font-size:.72rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;">Lokasi</div>
                            <div class="mt-1 fw-600" style="font-size:.88rem;">
                                <i class="bi bi-geo-alt-fill text-primary me-1"></i>{{ $pengaduan->lokasi }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-2" style="background:#f8fafc;border:1px solid #e2e8f0;">
                            <div style="font-size:.72rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;">Tanggal Pengaduan</div>
                            <div class="mt-1 fw-600" style="font-size:.88rem;">
                                <i class="bi bi-calendar3 text-primary me-1"></i>{{ $pengaduan->created_at->isoFormat('D MMMM Y, HH:mm') }} WIB
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div style="font-size:.72rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;">Deskripsi</div>
                    <div class="p-3 rounded-2" style="background:#f8fafc;border:1px solid #e2e8f0;font-size:.9rem;line-height:1.7;">
                        {{ $pengaduan->deskripsi }}
                    </div>
                </div>

                @if($pengaduan->foto)
                <div class="mb-3">
                    <div style="font-size:.72rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;">Foto Bukti</div>
                    <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto pengaduan"
                         class="rounded-2" style="max-width:100%;max-height:360px;object-fit:cover;">
                </div>
                @endif
            </div>
        </div>

        <!-- Tanggapan Admin -->
        @if($pengaduan->tanggapan)
        <div class="card border-0" style="background:#eff6ff;border:1px solid #bfdbfe!important;">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div style="width:32px;height:32px;background:#1a56db;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;color:#fff;">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <div style="font-size:.8rem;font-weight:700;color:#1d4ed8;">Tanggapan Admin</div>
                        <div style="font-size:.72rem;color:#60a5fa;">{{ $pengaduan->updated_at->isoFormat('D MMM Y, HH:mm') }}</div>
                    </div>
                </div>
                <p class="mb-0" style="font-size:.88rem;color:#1e3a8a;line-height:1.7;">{{ $pengaduan->tanggapan }}</p>
            </div>
        </div>
        @else
            <div class="text-center py-3 text-muted" style="font-size:.85rem;">
                <i class="bi bi-clock me-1"></i>Menunggu tanggapan dari admin.
            </div>
        @endif

        @if($pengaduan->status === 'menunggu')
        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('siswa.pengaduan.edit', $pengaduan) }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
            <form method="POST" action="{{ route('siswa.pengaduan.destroy', $pengaduan) }}"
                  onsubmit="return confirm('Yakin hapus pengaduan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-trash me-1"></i>Hapus
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
