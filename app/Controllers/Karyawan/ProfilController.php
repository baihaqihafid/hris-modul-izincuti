<?php

namespace App\Controllers\Karyawan;

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

        return view('karyawan/profil/index', $data);
    }

    public function update()
    {
        $karyawanId = session()->get('karyawan_id');
        $karyawan = $this->karyawanModel->find($karyawanId);

        if (!$karyawan) {
            return redirect()->to('/karyawan/profil')->with('error', 'Data tidak ditemukan.');
        }

        $rules = [
            'no_hp'  => 'required|min_length[9]',
            'alamat' => 'required',
            'email'  => "required|valid_email|is_unique[karyawan.email,id_karyawan,{$karyawanId}]",
            'foto'   => 'is_image[foto]|max_size[foto,2048]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'no_hp'  => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'email'  => $this->request->getPost('email'),
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            if ($karyawan['foto'] && file_exists(FCPATH . 'assets/uploads/foto/' . $karyawan['foto'])) {
                unlink(FCPATH . 'assets/uploads/foto/' . $karyawan['foto']);
            }
            $fotoNama = $foto->getRandomName();
            $foto->move(FCPATH . 'assets/uploads/foto', $fotoNama);
            $updateData['foto'] = $fotoNama;
        }

        $this->karyawanModel->update($karyawanId, $updateData);

        return redirect()->to('/karyawan/profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function gantiPassword()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/karyawan/profil')->with('error', 'Akun tidak ditemukan.');
        }

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasi   = $this->request->getPost('konfirmasi_password');

        if (!password_verify($passwordLama, $user['password'])) {
            return redirect()->to('/karyawan/profil')->with('error', 'Password lama tidak sesuai.');
        }

        if (strlen($passwordBaru) < 6) {
            return redirect()->to('/karyawan/profil')->with('error', 'Password baru minimal 6 karakter.');
        }

        if ($passwordBaru !== $konfirmasi) {
            return redirect()->to('/karyawan/profil')->with('error', 'Konfirmasi password tidak cocok.');
        }

        $this->userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/karyawan/profil')->with('success', 'Password berhasil diubah.');
    }
}