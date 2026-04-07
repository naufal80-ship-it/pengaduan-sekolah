@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#eff6ff;color:#1a56db;">
                <i class="bi bi-inbox-fill"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#1a56db;">{{ $totalPengaduan }}</div>
                <div class="stat-label">Total</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
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
    <div class="col-6 col-md-4 col-xl-2">
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
    <div class="col-6 col-md-4 col-xl-2">
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
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#fff1f2;color:#dc2626;">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#dc2626;">{{ $ditolak }}</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card bg-white">
            <div class="stat-icon" style="background:#f5f3ff;color:#7c3aed;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#7c3aed;">{{ $totalSiswa }}</div>
                <div class="stat-label">Total Siswa</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Recent Pengaduan -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history me-2 text-primary"></i>Pengaduan Terbaru</span>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @if($recentPengaduan->isEmpty())
                    <div class="text-center py-5 text-muted" style="font-size:.88rem;">
                        Belum ada pengaduan masuk.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Siswa</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPengaduan as $item)
                                <tr>
                                    <td class="fw-600" style="font-size:.87rem;">{{ Str::limit($item->judul, 35) }}</td>
                                    <td style="font-size:.82rem;">{{ $item->user->name }}</td>
                                    <td>{!! $item->kategoriBadge !!}</td>
                                    <td>{!! $item->statusBadge !!}</td>
                                    <td>
                                        <a href="{{ route('admin.pengaduan.show', $item) }}" class="btn btn-sm btn-outline-primary" style="font-size:.75rem;padding:3px 8px;">
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
    </div>

    <!-- Per Kategori -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-bar-chart-fill me-2 text-primary"></i>Pengaduan per Kategori
            </div>
            <div class="card-body">
                @if($perKategori->isEmpty())
                    <p class="text-muted text-center" style="font-size:.85rem;">Belum ada data.</p>
                @else
                    @foreach($perKategori as $k)
                    @php
                        $pct = $totalPengaduan > 0 ? round(($k->total / $totalPengaduan) * 100) : 0;
                        $colors = [
                            'kebersihan' => '#16a34a',
                            'kerusakan'  => '#dc2626',
                            'keamanan'   => '#b45309',
                            'fasilitas'  => '#1d4ed8',
                            'lainnya'    => '#7c3aed',
                        ];
                        $color = $colors[$k->kategori] ?? '#6b7280';
                    @endphp
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span style="font-size:.82rem;font-weight:600;text-transform:capitalize;">{{ $k->kategori }}</span>
                            <span style="font-size:.8rem;color:#6b7280;">{{ $k->total }} ({{ $pct }}%)</span>
                        </div>
                        <div class="progress" style="height:8px;border-radius:4px;background:#f0f2f5;">
                            <div class="progress-bar" style="width:{{ $pct }}%;background:{{ $color }};border-radius:4px;"></div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
