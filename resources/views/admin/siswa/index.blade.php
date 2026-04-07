@extends('layouts.app')
@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')
<div class="card mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.siswa.index') }}">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control form-control-sm"
                           placeholder="Cari nama, NIS, atau email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary btn-sm w-100">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people-fill me-2 text-primary"></i>Daftar Siswa Terdaftar</span>
        <small class="text-muted">{{ $siswa->total() }} siswa</small>
    </div>
    <div class="card-body p-0">
        @if($siswa->isEmpty())
            <div class="text-center py-5 text-muted" style="font-size:.88rem;">
                <i class="bi bi-people" style="font-size:2.5rem;opacity:.25;display:block;margin-bottom:10px;"></i>
                Tidak ada siswa ditemukan.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Email</th>
                            <th>Bergabung</th>
                            <th>Total Pengaduan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $index => $s)
                        <tr>
                            <td class="text-muted" style="font-size:.8rem;">{{ $siswa->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:32px;height:32px;background:#eff6ff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.82rem;font-weight:700;color:#1a56db;flex-shrink:0;">
                                        {{ substr($s->name, 0, 1) }}
                                    </div>
                                    <div class="fw-600" style="font-size:.87rem;">{{ $s->name }}</div>
                                </div>
                            </td>
                            <td style="font-size:.85rem;font-family:monospace;">{{ $s->nis }}</td>
                            <td>
                                <span class="badge" style="background:#eff6ff;color:#1d4ed8;font-size:.75rem;">{{ $s->kelas }}</span>
                            </td>
                            <td style="font-size:.82rem;color:#6b7280;">{{ $s->email }}</td>
                            <td style="font-size:.8rem;color:#6b7280;">{{ $s->created_at->isoFormat('D MMM Y, HH:mm') }} WIB</td>
                            <td>
                                <span class="fw-700" style="color:#1a56db;">{{ $s->pengaduan_count }}</span>
                                <span class="text-muted" style="font-size:.78rem;"> pengaduan</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $siswa->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
