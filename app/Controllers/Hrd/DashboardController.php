<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\PengajuanIzinModel;
use App\Models\PengajuanCutiModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $karyawanModel = new KaryawanModel();
        $izinModel     = new PengajuanIzinModel();
        $cutiModel     = new PengajuanCutiModel();

        $data = [
            'title'             => 'Dashboard HRD',
            'total_karyawan'    => $karyawanModel->countAllResults(),
            'izin_pending'      => $izinModel->countByStatus('Menunggu'),
            'cuti_pending'      => $cutiModel->countByStatus('Menunggu'),
            'izin_terbaru'      => $izinModel->getAllWithKaryawan('Menunggu'),
            'cuti_terbaru'      => $cutiModel->getAllWithKaryawan('Menunggu'),
        ];

        return view('hrd/dashboard', $data);
    }
}