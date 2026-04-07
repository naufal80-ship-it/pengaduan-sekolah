<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@sekolah.sch.id',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Sample siswa
        User::create([
            'name'     => 'Budi Santoso',
            'nis'      => '2024001',
            'kelas'    => 'X IPA 1',
            'email'    => 'budi@siswa.sch.id',
            'password' => Hash::make('siswa123'),
            'role'     => 'siswa',
        ]);

        User::create([
            'name'     => 'Siti Rahayu',
            'nis'      => '2024002',
            'kelas'    => 'XI IPS 2',
            'email'    => 'siti@siswa.sch.id',
            'password' => Hash::make('siswa123'),
            'role'     => 'siswa',
        ]);
    }
}
