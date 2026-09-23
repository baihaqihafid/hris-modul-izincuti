<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['karyawan_id', 'username', 'password', 'role', 'is_active'];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $returnType       = 'array';

    /**
     * Cari user berdasarkan username
     */
    public function getByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Ambil user lengkap dengan data karyawan (join)
     */
    public function getUserWithKaryawan(int $userId)
    {
        return $this->select('users.*, karyawan.nama_karyawan, karyawan.foto')
            ->join('karyawan', 'karyawan.id_karyawan = users.karyawan_id', 'left')
            ->where('users.id', $userId)
            ->first();
    }

    /**
     * Ambil semua user dengan nama karyawan (untuk halaman kelola user)
     */
    public function getAllWithKaryawan()
    {
        return $this->select('users.*, karyawan.nama_karyawan')
            ->join('karyawan', 'karyawan.id_karyawan = users.karyawan_id', 'left')
            ->orderBy('users.id', 'ASC')
            ->findAll();
    }
}