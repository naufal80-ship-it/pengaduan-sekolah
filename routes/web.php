    <?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\SiswaPengaduanController;
    use App\Http\Controllers\AdminController;
    use Illuminate\Support\Facades\Route;

    // ── Root redirect ────────────────────────────────────────────────
    Route::get('/', fn() => redirect()->route('login'));

    // ── Auth ─────────────────────────────────────────────────────────
    Route::middleware('guest')->group(function () {
        Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login',   [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register',[AuthController::class, 'register']);
        Route::get('/lupa-password',  [AuthController::class, 'showForgotPassword'])->name('forgot.password');
        Route::post('/lupa-password', [AuthController::class, 'resetPassword'])->name('reset.password');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    // ── Siswa ─────────────────────────────────────────────────────────
    Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [SiswaPengaduanController::class, 'dashboard'])->name('dashboard');

        Route::get('/pengaduan',              [SiswaPengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/buat',         [SiswaPengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan',             [SiswaPengaduanController::class, 'store'])->name('pengaduan.store');
        Route::get('/pengaduan/{pengaduan}',  [SiswaPengaduanController::class, 'show'])->name('pengaduan.show');
        Route::get('/pengaduan/{pengaduan}/edit', [SiswaPengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::put('/pengaduan/{pengaduan}',  [SiswaPengaduanController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{pengaduan}', [SiswaPengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    });

    // ── Admin ─────────────────────────────────────────────────────────
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/pengaduan',                      [AdminController::class, 'indexPengaduan'])->name('pengaduan.index');
        Route::get('/pengaduan/{pengaduan}',           [AdminController::class, 'showPengaduan'])->name('pengaduan.show');
        Route::put('/pengaduan/{pengaduan}/status',    [AdminController::class, 'updateStatus'])->name('pengaduan.updateStatus');
        Route::delete('/pengaduan/{pengaduan}',        [AdminController::class, 'destroyPengaduan'])->name('pengaduan.destroy');

        Route::get('/siswa', [AdminController::class, 'indexSiswa'])->name('siswa.index');
    });
