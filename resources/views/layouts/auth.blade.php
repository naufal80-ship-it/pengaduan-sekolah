<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — SiPengadu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1342b0;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #BFC9D1 0%, #ECECEC 50%, #BFC6C4 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            overflow: hidden;
            width: 100%;
            max-width: 460px;
        }
        .auth-header {
            background: linear-gradient(135deg, #0f1f4b, #1342b0);
            padding: 32px 32px 24px;
            text-align: center;
        }
        .auth-logo {
            width: 56px; height: 56px;
            background: rgba(255,255,255,.15);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; color: #fff;
            margin: 0 auto 12px;
            backdrop-filter: blur(10px);
        }
        .auth-header h1 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #fff;
            margin: 0 0 4px;
        }
        .auth-header p {
            font-size: .8rem;
            color: rgba(255,255,255,.7);
            margin: 0;
        }
        .auth-body { padding: 28px 32px 32px; }
        .form-label { font-size: .83rem; font-weight: 600; color: #374151; }
        .form-control {
            border-radius: 8px;
            border-color: #d1d5db;
            font-size: .9rem;
            padding: 10px 14px;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(26,86,219,.15);
        }
        .btn-auth {
            background: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 11px;
            font-weight: 700;
            font-size: .9rem;
            width: 100%;
            color: #fff;
            transition: background .2s;
        }
        .btn-auth:hover { background: var(--primary-dark); color: #fff; }
        .input-group-text {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #6b7280;
        }
        .invalid-feedback { font-size: .78rem; }
        .auth-switch {
            text-align: center;
            font-size: .83rem;
            color: #6b7280;
            margin-top: 20px;
        }
        .auth-switch a { color: var(--primary); font-weight: 600; text-decoration: none; }
        .auth-switch a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="auth-card">
    <div class="auth-header">
    <div style="display:flex;flex-direction:column;align-items:center;text-align:center;">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:150px;height:150px;object-fit:cover;border-radius:50%;margin-bottom:6px;">
    <h1 style="font-size:1.4rem;font-weight:800;color:#fff;margin:0 0 4px;">PengaduanKu</h1>
    <p style="font-size:.8rem;color:rgba(255,255,255,.7);margin:0;">Sistem Pengaduan Sarana Sekolah</p>
</div>
</div>
    <div class="auth-body">
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
