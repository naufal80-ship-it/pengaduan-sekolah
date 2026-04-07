@extends('layouts.app')
@section('title', 'Tinjau Pengaduan')
@section('page-title', 'Tinjau Pengaduan')

@section('content')
<div class="row">
    <div class="col-lg-7">
        <!-- Back -->
        <div class="mb-3">
            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-file-text me-2 text-primary"></i>Detail Pengaduan</span>
                <div class="d-flex gap-2">
                    {!! $pengaduan->kategoriBadge !!}
                    {!! $pengaduan->statusBadge !!}
                </div>
            </div>
            <div class="card-body">
                <h5 class="fw-800 mb-3">{{ $pengaduan->judul }}</h5>

                <div class="p-3 rounded-2 mb-3 d-flex gap-3" style="background:#f8fafc;border:1px solid #e2e8f0;">
                    <div>
                        <div style="font-size:.68rem;color:#94a3b8;font-weight:700;text-transform:uppercase;">Pelapor</div>
                        <div style="font-size:.88rem;font-weight:400;color:#1a2340;"><i class="bi bi-person-fill text-primary me-1"></i>{{ $pengaduan->user->name }}</div>
                        <div style="font-size:.78rem;color:#6b7280;">NIS {{ $pengaduan->user->nis }} · {{ $pengaduan->user->kelas }}</div>
                    </div>
                    <div class="border-start ps-3">
                        <div style="font-size:.68rem;color:#94a3b8;font-weight:700;text-transform:uppercase;">Lokasi</div>
                        <div class="fw-600" style="font-size:.88rem;"><i class="bi bi-geo-alt-fill text-primary me-1"></i>{{ $pengaduan->lokasi }}</div>
                    </div>
                    <div class="border-start ps-3">
                        <div style="font-size:.68rem;color:#94a3b8;font-weight:700;text-transform:uppercase;">Tanggal</div>
                        <div style="font-size:.88rem;font-weight:400;color:#1a2340;"><i class="bi bi-calendar3 text-primary me-1"></i>{{ $pengaduan->created_at->isoFormat('D MMM Y, HH:mm') }} WIB</div>
                    </div>
                </div>

                <div class="mb-3">
                    <div style="font-size:.72rem;color:#94a3b8;font-weight:700;text-transform:uppercase;margin-bottom:8px;">Deskripsi Masalah</div>
                    <div class="p-3 rounded-2" style="background:#f8fafc;border:1px solid #e2e8f0;font-size:.9rem;line-height:1.7;">
                        {{ $pengaduan->deskripsi }}
                    </div>
                </div>

                @if($pengaduan->foto)
                <div>
                    <div style="font-size:.72rem;color:#94a3b8;font-weight:700;text-transform:uppercase;margin-bottom:8px;">Foto Bukti</div>
                    <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto pengaduan"
                         class="rounded-2 w-100" style="max-height:360px;object-fit:cover;">
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Update Status Panel -->
    <div class="col-lg-5">
        <div class="card" style="position:sticky;top:80px;">
            <div class="card-header">
                <i class="bi bi-pencil-square me-2 text-primary"></i>Update Status Pengaduan
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger py-2" style="font-size:.82rem;">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.pengaduan.updateStatus', $pengaduan) }}">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-600">Status Pengaduan</label>
                        <select name="status" class="form-select" required>
                            <option value="menunggu"  {{ $pengaduan->status === 'menunggu'  ? 'selected' : '' }}>⏳ Menunggu</option>
                            <option value="diproses"  {{ $pengaduan->status === 'diproses'  ? 'selected' : '' }}>🔄 Diproses</option>
                            <option value="selesai"   {{ $pengaduan->status === 'selesai'   ? 'selected' : '' }}>✅ Selesai</option>
                            <option value="ditolak"   {{ $pengaduan->status === 'ditolak'   ? 'selected' : '' }}>❌ Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-600">Tanggapan Admin</label>
                        <textarea name="tanggapan" rows="5" class="form-control"
                                  placeholder="Tulis tanggapan atau keterangan untuk siswa...">{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
                        <div class="form-text">Tanggapan akan ditampilkan kepada siswa pelapor.</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save-fill me-2"></i>Simpan Perubahan
                    </button>
                </form>

                @if($pengaduan->tanggapan)
                <hr>
                <div class="p-3 rounded-2" style="background:#eff6ff;border:1px solid #bfdbfe;">
                    <div style="font-size:.72rem;font-weight:700;color:#1d4ed8;margin-bottom:6px;text-transform:uppercase;">Tanggapan Terakhir</div>
                    <p class="mb-0" style="font-size:.85rem;color:#1e3a8a;">{{ $pengaduan->tanggapan }}</p>
                    <div style="font-size:.72rem;color:#60a5fa;margin-top:6px;">
                        Diperbarui: {{ $pengaduan->updated_at->isoFormat('D MMM Y, HH:mm') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
