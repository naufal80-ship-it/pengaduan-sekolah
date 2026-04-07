@extends('layouts.app')
@section('title', 'Dashboard Siswa')
@section('page-title', 'Dashboard')

@section('topbar-actions')
    <a href="{{ route('siswa.pengaduan.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Buat Pengaduan
    </a>
@endsection

@section('content')
<!-- Welcome Banner -->
<div class="p-4 mb-4 rounded-3" style="background:linear-gradient(135deg,#0f1f4b,#1a56db);color:#fff;">
    <div class="d-flex align-items-center gap-3">
        <div style="width:52px;height:52px;background:rgba(255,255,255,.15);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;backdrop-filter:blur(10px);">
            👋
        </div>
        <div>
            <h5 class="mb-0 fw-800" style="font-size:1.1rem;">Selamat datang, {{ Auth::user()->name }}!</h5>
            <div style="font-size:.82rem;opacity:.8;">{{ Auth::user()->kelas }} &bull; NIS {{ Auth::user()->nis }}</div>
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#eff6ff;color:#1a56db;">
                <i class="bi bi-inbox-fill"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#1a56db;">{{ $totalPengaduan }}</div>
                <div class="stat-label">Total Pengaduan</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#fef9c3;color:#ca8a04;">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#ca8a04;">{{ $menunggu }}</div>
                <div class="stat-label">Menunggu</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#eff6ff;color:#2563eb;">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#2563eb;">{{ $diproses }}</div>
                <div class="stat-label">Diproses</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#16a34a;">{{ $selesai }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Pengaduan -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history me-2 text-primary"></i>Pengaduan Terbaru</span>
        <a href="{{ route('siswa.pengaduan.index') }}" class="btn btn-sm btn-outline-primary">
            Lihat Semua
        </a>
    </div>
    <div class="card-body p-0">
        @if($recentPengaduan->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox" style="font-size:2.5rem;opacity:.3;"></i>
                <p class="mt-2 mb-0" style="font-size:.88rem;">Belum ada pengaduan. <a href="{{ route('siswa.pengaduan.create') }}">Buat sekarang</a></p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentPengaduan as $item)
                        <tr>
                            <td class="fw-600">{{ Str::limit($item->judul, 40) }}</td>
                            <td>{!! $item->kategoriBadge !!}</td>
                            <td style="font-size:.8rem;color:#6b7280;">{{ $item->created_at->format('d M Y') }}</td>
                            <td>{!! $item->statusBadge !!}</td>
                            <td>
                                <a href="{{ route('siswa.pengaduan.show', $item) }}" class="btn btn-xs btn-outline-primary" style="font-size:.75rem;padding:3px 8px;">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
