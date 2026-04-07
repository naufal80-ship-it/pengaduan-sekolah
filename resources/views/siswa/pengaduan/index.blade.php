@extends('layouts.app')
@section('title', 'Pengaduan Saya')
@section('page-title', 'Pengaduan Saya')

@section('topbar-actions')
    <a href="{{ route('siswa.pengaduan.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Buat Pengaduan
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2 text-primary"></i>Daftar Pengaduan</span>
        <small class="text-muted">{{ $pengaduan->total() }} total pengaduan</small>
    </div>
    <div class="card-body p-0">
        @if($pengaduan->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox" style="font-size:3rem;opacity:.25;display:block;margin-bottom:12px;"></i>
                Belum ada pengaduan.
                <a href="{{ route('siswa.pengaduan.create') }}" class="d-block mt-2 fw-600" style="color:#1a56db;">
                    <i class="bi bi-plus-circle me-1"></i>Buat pengaduan pertama Anda
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
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
                                <div class="fw-600" style="font-size:.87rem;">{{ Str::limit($item->judul, 45) }}</div>
                            </td>
                            <td>{!! $item->kategoriBadge !!}</td>
                            <td style="font-size:.82rem;color:#6b7280;">
                                <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($item->lokasi, 25) }}
                            </td>
                            <td style="font-size:.8rem;color:#6b7280;">{{ $item->created_at->format('d M Y') }}</td>
                            <td>{!! $item->statusBadge !!}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('siswa.pengaduan.show', $item) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($item->status === 'menunggu')
                                    <a href="{{ route('siswa.pengaduan.edit', $item) }}" 
                                       class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('siswa.pengaduan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus pengaduan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
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
