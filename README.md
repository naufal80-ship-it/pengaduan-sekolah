# 🏫 SiPengadu — Sistem Pengaduan Sarana Sekolah

Web aplikasi pengaduan sarana sekolah berbasis **Laravel 12** dengan **Bootstrap 5**.  
Mendukung 2 role: **Siswa** dan **Admin**.

---

## 📦 Fitur

### 👨‍🎓 Siswa
- ✅ Register & Login
- ✅ Dashboard dengan statistik pengaduan pribadi
- ✅ Buat pengaduan baru (dengan upload foto)
- ✅ Lihat daftar semua pengaduan milik sendiri
- ✅ Edit pengaduan (hanya yang masih "Menunggu")
- ✅ Hapus pengaduan (hanya yang masih "Menunggu")
- ✅ Lihat detail & tanggapan dari admin

### 🛡️ Admin
- ✅ Dashboard dengan statistik lengkap & chart per kategori
- ✅ Kelola semua pengaduan (filter & pencarian)
- ✅ Update status pengaduan (Menunggu → Diproses → Selesai/Ditolak)
- ✅ Beri tanggapan kepada siswa
- ✅ Lihat data seluruh siswa terdaftar

---

## 🚀 Cara Install

### 1. Clone & Install Dependencies

```bash
git clone <repo> pengaduan-sekolah
cd pengaduan-sekolah
composer install
npm install && npm run build
```

### 2. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuaikan database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pengaduan_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrasi & Seeder

```bash
php artisan migrate --seed
php artisan storage:link
```

### 4. Jalankan Server

```bash
php artisan serve
```

Buka: http://localhost:8000

---

## 🔐 Akun Default (Seeder)

| Role  | Email                    | Password  |
|-------|--------------------------|-----------|
| Admin | admin@sekolah.sch.id     | admin123  |
| Siswa | budi@siswa.sch.id        | siswa123  |
| Siswa | siti@siswa.sch.id        | siswa123  |

---

## 📁 Struktur Proyek

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── SiswaPengaduanController.php
│   │   │   └── AdminController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       └── Pengaduan.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php      (layout utama dengan sidebar)
│   │   └── auth.blade.php     (layout halaman login/register)
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── siswa/
│   │   ├── dashboard.blade.php
│   │   └── pengaduan/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       ├── edit.blade.php
│   │       └── show.blade.php
│   └── admin/
│       ├── dashboard.blade.php
│       ├── pengaduan/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       └── siswa/
│           └── index.blade.php
├── routes/
│   └── web.php
└── bootstrap/
    └── app.php
```

---

## 🎨 Desain

- **Warna Utama**: Biru (#1a56db) + Silver (#c0c7d0)
- **Font**: Plus Jakarta Sans
- **UI Framework**: Bootstrap 5.3
- **Icons**: Bootstrap Icons 1.11

---

## 📋 Kategori Pengaduan

| Kategori   | Deskripsi                        |
|------------|----------------------------------|
| Kebersihan | Masalah kebersihan lingkungan    |
| Kerusakan  | Sarana/prasarana rusak           |
| Keamanan   | Masalah keamanan sekolah         |
| Fasilitas  | Kekurangan/kerusakan fasilitas   |
| Lainnya    | Pengaduan kategori lain          |

---

## 📊 Status Pengaduan

| Status   | Keterangan                         |
|----------|------------------------------------|
| Menunggu | Baru dikirim, belum ditinjau admin |
| Diproses | Admin sedang menangani             |
| Selesai  | Masalah telah diselesaikan         |
| Ditolak  | Pengaduan ditolak (dengan alasan)  |
