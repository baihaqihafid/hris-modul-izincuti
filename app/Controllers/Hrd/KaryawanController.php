<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\HakCutiModel;

class KaryawanController extends BaseController
{
    protected $karyawanModel;
    protected $hakCutiModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->hakCutiModel  = new HakCutiModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Data Karyawan',
            'karyawan' => $this->karyawanModel->getAllWithRelasi(),
        ];

        return view('hrd/karyawan/index', $data);
    }

    public function detail($id)
    {
        $karyawan = $this->karyawanModel->getDetailWithRelasi($id);

        if (!$karyawan) {
            return redirect()->to('/hrd/karyawan')->with('error', 'Data karyawan tidak ditemukan.');
        }

        $data = [
            'title'    => 'Detail Karyawan',
            'karyawan' => $karyawan,
            'hak_cuti' => $this->hakCutiModel->getByKaryawanTahun($id, date('Y')),
        ];

        return view('hrd/karyawan/detail', $data);
    }
}