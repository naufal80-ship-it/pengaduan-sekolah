<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SiPengadu') — Sistem Pengaduan Sarana Sekolah</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:       #1a56db;
            --primary-dark:  #1342b0;
            --primary-light: #e8f0fe;
            --silver:        #c0c7d0;
            --silver-light:  #BFC9D1;
            --silver-dark:   #57595B;
            --sidebar-bg:    #0f1f4b;
            --sidebar-text:  #c8d6f0;
            --sidebar-hover: #1a3a7a;
            --sidebar-active:#1a56db;
            --card-shadow:   0 2px 12px rgba(26,86,219,.10);
            --radius:        12px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--silver-light);
            color: #1a2340;
            min-height: 100vh;
        }

        /* ── Sidebar ─────────────────────────────────── */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 24px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: var(--primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: #fff;
            margin-bottom: 10px;
        }

        .sidebar-brand .brand-name {
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.3px;
        }

        .sidebar-brand .brand-sub {
            font-size: .72rem;
            color: var(--sidebar-text);
            opacity: .7;
        }

        .sidebar-nav { flex: 1; padding: 16px 12px; }

        .nav-section-label {
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--sidebar-text);
            opacity: .5;
            padding: 12px 8px 6px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--sidebar-text);
            font-size: .88rem;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 2px;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar-nav .nav-link.active {
            background: var(--sidebar-active);
            color: #fff;
            font-weight: 600;
        }

        .sidebar-nav .nav-link i { font-size: 1rem; width: 20px; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.05);
        }

        .sidebar-user .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar-user .user-info .name {
            font-size: .82rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }

        .sidebar-user .user-info .role-badge {
            font-size: .65rem;
            color: var(--sidebar-text);
            opacity: .7;
        }

        /* ── Main Content ────────────────────────────── */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #fff;
            padding: 14px 28px;
            border-bottom: 1px solid #e2e7ed;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .topbar .page-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1a2340;
            margin: 0;
        }

        .topbar .topbar-actions .btn {
            font-size: .82rem;
        }

        .content-area { padding: 28px; flex: 1; }

        /* ── Cards ───────────────────────────────────── */
        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e8ecf0;
            border-radius: var(--radius) var(--radius) 0 0 !important;
            padding: 16px 20px;
            font-weight: 700;
            font-size: .92rem;
        }

        /* ── Stat Cards ──────────────────────────────── */
        .stat-card {
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: var(--card-shadow);
            border: none;
        }

        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stat-card .stat-value {
            font-size: 1.7rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-card .stat-label {
            font-size: .78rem;
            color: var(--silver-dark);
            font-weight: 500;
            margin-top: 3px;
        }

        /* ── Status badges ───────────────────────────── */
        .badge-status {
            font-size: .72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .badge-kategori {
            font-size: .7rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .kategori-kebersihan { background: #dcfce7; color: #15803d; }
        .kategori-kerusakan  { background: #fee2e2; color: #dc2626; }
        .kategori-keamanan   { background: #fef3c7; color: #b45309; }
        .kategori-fasilitas  { background: #dbeafe; color: #1d4ed8; }
        .kategori-lainnya    { background: #f3e8ff; color: #7c3aed; }

        /* ── Table ───────────────────────────────────── */
        .table-custom th {
            background: var(--silver-light);
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--silver-dark);
            border: none;
            padding: 12px 16px;
        }

        .table-custom td {
            padding: 12px 16px;
            vertical-align: middle;
            border-color: #f0f2f5;
            font-size: .87rem;
        }

        .table-custom tbody tr:hover { background: var(--primary-light); }

        /* ── Buttons ─────────────────────────────────── */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            font-weight: 600;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
            font-weight: 600;
        }

        /* ── Form ────────────────────────────────────── */
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(26,86,219,.15);
        }

        /* ── Alert ───────────────────────────────────── */
        .alert { border: none; border-radius: 10px; font-size: .88rem; }

        /* ── Sidebar toggle (mobile) ─────────────────── */
        .sidebar-toggle { display: none; }

        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .sidebar-toggle { display: inline-flex; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div style="display:flex;justify-content:center;margin-bottom:10px;">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:250px;height:250px;object-fit:contain;border-radius:8px;">
</div>
<div class="brand-name">PengaduanKu</div>
        <div class="brand-sub">Sistem Pengaduan Sarana Sekolah</div>
    </div>

    <nav class="sidebar-nav">
        @if(Auth::user()->isAdmin())
            <div class="nav-section-label">Menu Admin</div>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.pengaduan.index') }}"
               class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                <i class="bi bi-inbox-fill"></i> Kelola Pengaduan
            </a>
            <a href="{{ route('admin.siswa.index') }}"
               class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Data Siswa
            </a>
        @else
            <div class="nav-section-label">Menu Siswa</div>
            <a href="{{ route('siswa.dashboard') }}"
               class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('siswa.pengaduan.index') }}"
               class="nav-link {{ request()->routeIs('siswa.pengaduan.index') ? 'active' : '' }}">
                <i class="bi bi-list-ul"></i> Pengaduan Saya
            </a>
            <a href="{{ route('siswa.pengaduan.create') }}"
               class="nav-link {{ request()->routeIs('siswa.pengaduan.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle-fill"></i> Buat Pengaduan
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user mb-2">
            <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="user-info">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role-badge">{{ ucfirst(Auth::user()->role) }}
                    @if(Auth::user()->isSiswa()) — {{ Auth::user()->kelas }} @endif
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger w-100">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Topbar -->
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-outline-secondary sidebar-toggle" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
        </div>
        <div class="topbar-actions">
            @yield('topbar-actions')
        </div>
    </div>

    <!-- Alerts -->
    <div class="px-4 pt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="content-area">
        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Sidebar toggle (mobile)
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>
@stack('scripts')
</body>
</html>
