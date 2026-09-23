<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanIzinModel extends Model
{
    protected $table         = 'pengajuan_izin';
    protected $primaryKey    = 'id_izin';
    protected $allowedFields = [
        'karyawan_id', 'tanggal_pengajuan', 'tanggal_izin', 'jenis_izin',
        'alasan', 'dokumen', 'status', 'catatan_hrd', 'approved_by',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $returnType    = 'array';

    public function getByKaryawan(int $karyawanId)
    {
        return $this->where('karyawan_id', $karyawanId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getAllWithKaryawan(?string $status = null)
    {
        $builder = $this->select('pengajuan_izin.*, karyawan.nama_karyawan, karyawan.nik, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('karyawan', 'karyawan.id_karyawan = pengajuan_izin.karyawan_id')
            ->join('departemen', 'departemen.id_departemen = karyawan.departemen_id', 'left')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->orderBy('pengajuan_izin.created_at', 'DESC');

        if ($status) {
            $builder->where('pengajuan_izin.status', $status);
        }

        return $builder->findAll();
    }

    public function getDetailWithKaryawan(int $id)
    {
        return $this->select('pengajuan_izin.*, karyawan.nama_karyawan, karyawan.nik, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('karyawan', 'karyawan.id_karyawan = pengajuan_izin.karyawan_id')
            ->join('departemen', 'departemen.id_departemen = karyawan.departemen_id', 'left')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->where('pengajuan_izin.id_izin', $id)
            ->first();
    }

    public function countByStatus(string $status)
    {
        return $this->where('status', $status)->countAllResults();
    }
}