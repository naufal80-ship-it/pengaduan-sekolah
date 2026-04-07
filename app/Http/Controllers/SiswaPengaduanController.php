<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaPengaduanController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalPengaduan  = Pengaduan::where('user_id', $user->id)->count();
        $menunggu        = Pengaduan::where('user_id', $user->id)->where('status', 'menunggu')->count();
        $diproses        = Pengaduan::where('user_id', $user->id)->where('status', 'diproses')->count();
        $selesai         = Pengaduan::where('user_id', $user->id)->where('status', 'selesai')->count();
        $recentPengaduan = Pengaduan::where('user_id', $user->id)->latest()->take(5)->get();

        return view('siswa.dashboard', compact(
            'totalPengaduan', 'menunggu', 'diproses', 'selesai', 'recentPengaduan'
        ));
    }

    public function index()
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('siswa.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        return view('siswa.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:kebersihan,kerusakan,keamanan,fasilitas,lainnya',
            'lokasi'    => 'required|string|max:255',
            'deskripsi' => 'required|string|min:20',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'judul.required'     => 'Judul pengaduan wajib diisi.',
            'kategori.required'  => 'Kategori wajib dipilih.',
            'lokasi.required'    => 'Lokasi wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 20 karakter.',
            'foto.image'         => 'File harus berupa gambar.',
            'foto.max'           => 'Ukuran foto maksimal 2MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id'   => Auth::id(),
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'lokasi'    => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto'      => $fotoPath,
            'status'    => 'menunggu',
        ]);

        return redirect()->route('siswa.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim! Kami akan segera menindaklanjuti.');
    }

    public function show(Pengaduan $pengaduan)
    {
        // Ensure siswa can only see their own reports
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return view('siswa.pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        if ($pengaduan->status !== 'menunggu') {
            return back()->with('error', 'Pengaduan yang sudah diproses tidak dapat diedit.');
        }

        return view('siswa.pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        if ($pengaduan->status !== 'menunggu') {
            return back()->with('error', 'Pengaduan yang sudah diproses tidak dapat diedit.');
        }

        $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|in:kebersihan,kerusakan,keamanan,fasilitas,lainnya',
            'lokasi'    => 'required|string|max:255',
            'deskripsi' => 'required|string|min:20',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = $pengaduan->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        $pengaduan->update([
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'lokasi'    => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto'      => $fotoPath,
        ]);

        return redirect()->route('siswa.pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        if ($pengaduan->status !== 'menunggu') {
            return back()->with('error', 'Pengaduan yang sudah diproses tidak dapat dihapus.');
        }

        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect()->route('siswa.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
