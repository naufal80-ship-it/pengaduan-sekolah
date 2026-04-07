@extends('layouts.app')
@section('title', 'Kelola Pengaduan')
@section('page-title', 'Kelola Pengaduan')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="bi bi-funnel me-2 text-primary"></i>Filter & Pencarian
    </div>
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.pengaduan.index') }}">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm"
                           placeholder="Cari judul, deskripsi, nama siswa..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="menunggu"  {{ request('status') === 'menunggu'  ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses"  {{ request('status') === 'diproses'  ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai"   {{ request('status') === 'selesai'   ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak"   {{ request('status') === 'ditolak'   ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua Kategori</option>
                        <option value="kebersihan" {{ request('kategori') === 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="kerusakan"  {{ request('kategori') === 'kerusakan'  ? 'selected' : '' }}>Kerusakan</option>
                        <option value="keamanan"   {{ request('kategori') === 'keamanan'   ? 'selected' : '' }}>Keamanan</option>
                        <option value="fasilitas"  {{ request('kategori') === 'fasilitas'  ? 'selected' : '' }}>Fasilitas</option>
                        <option value="lainnya"    {{ request('kategori') === 'lainnya'    ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm flex-fill">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-x"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-inbox-fill me-2 text-primary"></i>Daftar Pengaduan</span>
        <small class="text-muted">{{ $pengaduan->total() }} pengaduan</small>
    </div>
    <div class="card-body p-0">
        @if($pengaduan->isEmpty())
            <div class="text-center py-5 text-muted" style="font-size:.88rem;">
                <i class="bi bi-inbox" style="font-size:2.5rem;opacity:.25;display:block;margin-bottom:10px;"></i>
                Tidak ada pengaduan ditemukan.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Siswa</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengaduan as $index => $item)
                        <tr>
                            <td class="text-muted" style="font-size:.8rem;">{{ $pengaduan->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-600" style="font-size:.87rem;">{{ Str::limit($item->judul, 40) }}</div>
                            </td>
                            <td>
                                <div style="font-size:.82rem;font-weight:600;">{{ $item->user->name }}</div>
                                <div style="font-size:.72rem;color:#94a3b8;">{{ $item->user->kelas }}</div>
                            </td>
                            <td>{!! $item->kategoriBadge !!}</td>
                            <td style="font-size:.8rem;color:#6b7280;">{{ Str::limit($item->lokasi, 25) }}</td>
                            <td style="font-size:.8rem;color:#6b7280;">{{ $item->created_at->format('d M Y') }}</td>
                            <td>{!! $item->statusBadge !!}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.pengaduan.show', $item) }}"
                                       class="btn btn-sm btn-primary" title="Tinjau">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.pengaduan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus pengaduan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $pengaduan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
