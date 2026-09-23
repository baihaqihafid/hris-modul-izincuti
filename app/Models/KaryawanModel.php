<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table         = 'karyawan';
    protected $primaryKey    = 'id_karyawan';
    protected $allowedFields  = [
        'nik', 'nama_karyawan', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'no_hp', 'email', 'departemen_id', 'jabatan_id',
        'tanggal_masuk', 'status_karyawan', 'foto',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $returnType    = 'array';

    /**
     * Ambil semua karyawan beserta nama departemen & jabatan
     */
    public function getAllWithRelasi()
    {
        return $this->select('karyawan.*, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('departemen', 'departemen.id_departemen = karyawan.departemen_id', 'left')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->orderBy('karyawan.nama_karyawan', 'ASC')
            ->findAll();
    }

    /**
     * Ambil satu data karyawan beserta relasi
     */
    public function getDetailWithRelasi(int $id)
    {
        return $this->select('karyawan.*, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('departemen', 'departemen.id_departemen = karyawan.departemen_id', 'left')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->where('karyawan.id_karyawan', $id)
            ->first();
    }
}