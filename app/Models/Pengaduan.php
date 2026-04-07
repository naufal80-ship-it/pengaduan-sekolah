<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'lokasi',
        'deskripsi',
        'foto',
        'status',      // 'menunggu', 'diproses', 'selesai', 'ditolak'
        'tanggapan',   // Admin response
        'admin_id',    // Admin who responded
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'menunggu'  => '<span class="badge bg-warning text-dark">Menunggu</span>',
            'diproses'  => '<span class="badge bg-primary">Diproses</span>',
            'selesai'   => '<span class="badge bg-success">Selesai</span>',
            'ditolak'   => '<span class="badge bg-danger">Ditolak</span>',
            default     => '<span class="badge bg-secondary">Tidak Diketahui</span>',
        };
    }

    public function getKategoriBadgeAttribute(): string
    {
        return match($this->kategori) {
            'kebersihan'   => '<span class="badge-kategori kategori-kebersihan">Kebersihan</span>',
            'kerusakan'    => '<span class="badge-kategori kategori-kerusakan">Kerusakan</span>',
            'keamanan'     => '<span class="badge-kategori kategori-keamanan">Keamanan</span>',
            'fasilitas'    => '<span class="badge-kategori kategori-fasilitas">Fasilitas</span>',
            'lainnya'      => '<span class="badge-kategori kategori-lainnya">Lainnya</span>',
            default        => '<span class="badge bg-secondary">' . $this->kategori . '</span>',
        };
    }
}
