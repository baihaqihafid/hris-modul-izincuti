<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nik'             => 'KRY001',
                'nama_karyawan'   => 'Budi Santoso',
                'jenis_kelamin'   => 'Laki-laki',
                'tempat_lahir'    => 'Surabaya',
                'tanggal_lahir'   => '1990-05-15',
                'alamat'          => 'Jl. Raya No. 1, Sidoarjo',
                'no_hp'           => '081234567890',
                'email'           => 'budi@sikaryawan.com',
                'departemen_id'   => 1,
                'jabatan_id'      => 2,
                'tanggal_masuk'   => '2020-01-01',
                'status_karyawan' => 'Aktif',
                'foto'            => null,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'nik'             => 'KRY002',
                'nama_karyawan'   => 'Siti Rahayu',
                'jenis_kelamin'   => 'Perempuan',
                'tempat_lahir'    => 'Malang',
                'tanggal_lahir'   => '1995-08-20',
                'alamat'          => 'Jl. Mawar No. 5, Sidoarjo',
                'no_hp'           => '082345678901',
                'email'           => 'siti@sikaryawan.com',
                'departemen_id'   => 3,
                'jabatan_id'      => 4,
                'tanggal_masuk'   => '2021-03-01',
                'status_karyawan' => 'Aktif',
                'foto'            => null,
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('karyawan')->insertBatch($data);
    }
}