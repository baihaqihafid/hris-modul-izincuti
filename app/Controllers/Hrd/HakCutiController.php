<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\HakCutiModel;
use App\Models\KaryawanModel;

class HakCutiController extends BaseController
{
    protected $hakCutiModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->hakCutiModel  = new HakCutiModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'title'    => 'Kelola Hak Cuti Karyawan',
            'hak_cuti' => $this->hakCutiModel->getAllWithKaryawan($tahun),
            'tahun'    => $tahun,
        ];

        return view('hrd/hak_cuti/index', $data);
    }

    public function update($id)
    {
        $hakCuti = $this->hakCutiModel->find($id);

        if (!$hakCuti) {
            return redirect()->to('/hrd/hak-cuti')->with('error', 'Data hak cuti tidak ditemukan.');
        }

        $rules = [
            'total_cuti' => 'required|is_natural',
            'sisa_cuti'  => 'required|is_natural',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $this->hakCutiModel->update($id, [
            'total_cuti' => $this->request->getPost('total_cuti'),
            'sisa_cuti'  => $this->request->getPost('sisa_cuti'),
        ]);

        return redirect()->to('/hrd/hak-cuti?tahun=' . $hakCuti['tahun'])->with('success', 'Hak cuti berhasil diperbarui.');
    }

    /**
     * Generate hak cuti untuk semua karyawan yang belum punya di tahun berjalan
     */
    public function generate()
    {
        $tahun = date('Y');
        $karyawanList = $this->karyawanModel->where('status_karyawan', 'Aktif')->findAll();

        $jumlahDibuat = 0;

        foreach ($karyawanList as $karyawan) {
            $existing = $this->hakCutiModel->getByKaryawanTahun($karyawan['id_karyawan'], $tahun);

            if (!$existing) {
                $this->hakCutiModel->insert([
                    'karyawan_id' => $karyawan['id_karyawan'],
                    'tahun'       => $tahun,
                    'total_cuti'  => 12,
                    'sisa_cuti'   => 12,
                ]);
                $jumlahDibuat++;
            }
        }

        return redirect()->to('/hrd/hak-cuti?tahun=' . $tahun)->with('success', "Berhasil generate hak cuti untuk {$jumlahDibuat} karyawan.");
    }
}