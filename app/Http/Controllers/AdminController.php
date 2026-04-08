<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPengaduan = Pengaduan::count();
        $menunggu       = Pengaduan::where('status', 'menunggu')->count();
        $diproses       = Pengaduan::where('status', 'diproses')->count();
        $selesai        = Pengaduan::where('status', 'selesai')->count();
        $ditolak        = Pengaduan::where('status', 'ditolak')->count();
        $totalSiswa     = User::where('role', 'siswa')->count();

        $recentPengaduan = Pengaduan::with('user')->latest()->take(8)->get();

        $perKategori = Pengaduan::selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->get();

        return view('admin.dashboard', compact(
            'totalPengaduan', 'menunggu', 'diproses', 'selesai', 'ditolak',
            'totalSiswa', 'recentPengaduan', 'perKategori'
        ));
    }

    public function indexPengaduan(Request $request)
    {
        $query = Pengaduan::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        $pengaduan = $query->latest()->paginate(15);

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function showPengaduan(Pengaduan $pengaduan)
    {
        $pengaduan->load('user');
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status'    => 'required|in:menunggu,diproses,selesai,ditolak',
            'tanggapan' => 'nullable|string|max:1000',
        ], [
            'status.required' => 'Status wajib dipilih.',
        ]);


        
        $pengaduan->update([
            'status'    => $request->status,
            'tanggapan' => $request->tanggapan,
            'admin_id'  => Auth::id(),
        ]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function indexSiswa(Request $request)
    {
        $query = User::where('role', 'siswa');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $siswa = $query->withCount('pengaduan')->latest()->paginate(15);

        return view('admin.siswa.index', compact('siswa'));
    }

    public function destroyPengaduan(Pengaduan $pengaduan)
    {
        if ($pengaduan->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($pengaduan->foto);
        }
        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
