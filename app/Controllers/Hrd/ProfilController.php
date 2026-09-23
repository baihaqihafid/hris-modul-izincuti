<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\UserModel;

class ProfilController extends BaseController
{
    protected $karyawanModel;
    protected $userModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->userModel     = new UserModel();
    }

    public function index()
    {
        $karyawanId = session()->get('karyawan_id');

        $data = [
            'title'    => 'Profil Saya',
            'karyawan' => $this->karyawanModel->getDetailWithRelasi($karyawanId),
        ];

        return view('hrd/profil/index', $data);
    }

    public function gantiPassword()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/hrd/profil')->with('error', 'Akun tidak ditemukan.');
        }

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasi   = $this->request->getPost('konfirmasi_password');

        if (!password_verify($passwordLama, $user['password'])) {
            return redirect()->to('/hrd/profil')->with('error', 'Password lama tidak sesuai.');
        }

        if (strlen($passwordBaru) < 6) {
            return redirect()->to('/hrd/profil')->with('error', 'Password baru minimal 6 karakter.');
        }

        if ($passwordBaru !== $konfirmasi) {
            return redirect()->to('/hrd/profil')->with('error', 'Konfirmasi password tidak cocok.');
        }

        $this->userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/hrd/profil')->with('success', 'Password berhasil diubah.');
    }
}