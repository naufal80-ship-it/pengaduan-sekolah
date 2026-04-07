<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            }

            return redirect()->route('siswa.dashboard')->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'password' => 'Password yang anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nis'      => 'required|digits:10|unique:users',
            'kelas'    => 'required|string|max:20',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'nis.required'      => 'NIS wajib diisi.',
            'nis.digits'        => 'NIS harus tepat 10 digit angka.',
            'nis.unique'        => 'NIS sudah terdaftar.',
            'kelas.required'    => 'Kelas wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 8 karakter.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'nis'      => $request->nis,
            'kelas'    => $request->kelas,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
        ]);

        Auth::login($user);

        return redirect()->route('siswa.dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    public function showForgotPassword()
{
    return view('auth.forgot-password');
}

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'nis'   => 'required',
        'password' => 'required|min:8|confirmed',
    ], [
        'email.required'    => 'Email wajib diisi.',
        'email.email'       => 'Format email tidak valid.',
        'nis.required'      => 'NIS wajib diisi.',
        'password.required' => 'Password baru wajib diisi.',
        'password.min'      => 'Password minimal 8 karakter.',
        'password.confirmed'=> 'Konfirmasi password tidak cocok.',
    ]);

    $user = User::where('email', $request->email)
                ->where('nis', $request->nis)
                ->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'Email dan NIS tidak cocok atau tidak terdaftar.',
        ])->withInput($request->only('email', 'nis'));
    }

    $user->update([
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    return redirect()->route('login')
        ->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
}
}
