<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\HakCutiModel;
use App\Models\PengajuanIzinModel;
use App\Models\PengajuanCutiModel;
use App\Models\KaryawanModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $karyawanId = session()->get('karyawan_id');

        $karyawanModel = new KaryawanModel();
        $hakCutiModel  = new HakCutiModel();
        $izinModel     = new PengajuanIzinModel();
        $cutiModel     = new PengajuanCutiModel();

        $data = [
            'title'      => 'Dashboard Karyawan',
            'karyawan'   => $karyawanModel->find($karyawanId),
            'hak_cuti'   => $hakCutiModel->getByKaryawanTahun($karyawanId, date('Y')),
            'izin'       => $izinModel->getByKaryawan($karyawanId),
            'cuti'       => $cutiModel->getByKaryawan($karyawanId),
        ];

        return view('karyawan/dashboard', $data);
    }
}