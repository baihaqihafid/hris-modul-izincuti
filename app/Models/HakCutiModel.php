<?php

namespace App\Models;

use CodeIgniter\Model;

class HakCutiModel extends Model
{
    protected $table         = 'hak_cuti';
    protected $primaryKey    = 'id_hak_cuti';
    protected $allowedFields = ['karyawan_id', 'tahun', 'total_cuti', 'sisa_cuti'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $returnType    = 'array';

    /**
     * Ambil hak cuti karyawan untuk tahun tertentu
     */
    public function getByKaryawanTahun(int $karyawanId, $tahun)
    {
        return $this->where('karyawan_id', $karyawanId)
            ->where('tahun', $tahun)
            ->first();
    }

    /**
     * Ambil semua hak cuti dengan data karyawan (untuk halaman HRD)
     */
    public function getAllWithKaryawan($tahun)
    {
        return $this->select('hak_cuti.*, karyawan.nama_karyawan, karyawan.nik')
            ->join('karyawan', 'karyawan.id_karyawan = hak_cuti.karyawan_id')
            ->where('hak_cuti.tahun', $tahun)
            ->orderBy('karyawan.nama_karyawan', 'ASC')
            ->findAll();
    }

    /**
     * Kurangi sisa cuti karyawan
     */
    public function kurangiSisaCuti(int $karyawanId, $tahun, int $jumlahHari)
    {
        $hakCuti = $this->getByKaryawanTahun($karyawanId, $tahun);

        if ($hakCuti) {
            $sisaBaru = max(0, $hakCuti['sisa_cuti'] - $jumlahHari);
            $this->update($hakCuti['id_hak_cuti'], ['sisa_cuti' => $sisaBaru]);
            return $sisaBaru;
        }

        return null;
    }

    /**
     * Kembalikan sisa cuti (jika pengajuan ditolak setelah sebelumnya disetujui, dsb)
     */
    public function tambahSisaCuti(int $karyawanId, $tahun, int $jumlahHari)
    {
        $hakCuti = $this->getByKaryawanTahun($karyawanId, $tahun);

        if ($hakCuti) {
            $sisaBaru = min($hakCuti['total_cuti'], $hakCuti['sisa_cuti'] + $jumlahHari);
            $this->update($hakCuti['id_hak_cuti'], ['sisa_cuti' => $sisaBaru]);
            return $sisaBaru;
        }

        return null;
    }
}