<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\KaryawanModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getByUsername($username);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan.');
        }

        if (!$user['is_active']) {
            return redirect()->back()->withInput()->with('error', 'Akun Anda tidak aktif. Silakan hubungi admin.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah.');
        }

        // Ambil nama karyawan jika ada
        $namaKaryawan = null;
        if ($user['karyawan_id']) {
            $karyawanModel = new KaryawanModel();
            $karyawan = $karyawanModel->find($user['karyawan_id']);
            $namaKaryawan = $karyawan['nama_karyawan'] ?? null;
        }

        session()->set([
            'user_id'        => $user['id'],
            'username'       => $user['username'],
            'role'           => $user['role'],
            'karyawan_id'    => $user['karyawan_id'],
            'nama_karyawan'  => $namaKaryawan,
            'logged_in'      => true,
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }

    public function dashboard()
    {
        $role = session()->get('role');

        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'hrd':
                return redirect()->to('/hrd/dashboard');
            case 'karyawan':
                return redirect()->to('/karyawan/dashboard');
            default:
                return redirect()->to('/login');
        }
    }
}