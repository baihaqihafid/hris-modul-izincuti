<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\UserModel;
use App\Models\PengajuanIzinModel;
use App\Models\PengajuanCutiModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $karyawanModel = new KaryawanModel();
        $userModel     = new UserModel();
        $izinModel     = new PengajuanIzinModel();
        $cutiModel     = new PengajuanCutiModel();

        $data = [
            'title'          => 'Dashboard Admin',
            'total_karyawan' => $karyawanModel->countAllResults(),
            'total_user'     => $userModel->countAllResults(),
            'total_izin'     => $izinModel->countAllResults(),
            'total_cuti'     => $cutiModel->countAllResults(),
            'izin_pending'   => $izinModel->countByStatus('Menunggu'),
            'cuti_pending'   => $cutiModel->countByStatus('Menunggu'),
        ];

        return view('admin/dashboard', $data);
    }
}