<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\KaryawanModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->userModel     = new UserModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola User',
            'users' => $this->userModel->getAllWithKaryawan(),
        ];

        return view('admin/user/index', $data);
    }

    public function create()
    {
        $data = [
            'title'    => 'Tambah User',
            'karyawan' => $this->karyawanModel->findAll(),
        ];

        return view('admin/user/create', $data);
    }

    public function store()
    {
        $rules = [
            'username'    => 'required|min_length[4]|is_unique[users.username]',
            'password'    => 'required|min_length[6]',
            'role'        => 'required|in_list[admin,hrd,karyawan]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $karyawanId = $this->request->getPost('karyawan_id');

        $this->userModel->insert([
            'karyawan_id' => $karyawanId ?: null,
            'username'    => $this->request->getPost('username'),
            'password'    => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'        => $this->request->getPost('role'),
            'is_active'   => $this->request->getPost('is_active') ?? 1,
        ]);

        return redirect()->to('/admin/user')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/user')->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'title'    => 'Edit User',
            'user'     => $user,
            'karyawan' => $this->karyawanModel->findAll(),
        ];

        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/user')->with('error', 'User tidak ditemukan.');
        }

        $rules = [
            'username' => "required|min_length[4]|is_unique[users.username,id,{$id}]",
            'role'     => 'required|in_list[admin,hrd,karyawan]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $karyawanId = $this->request->getPost('karyawan_id');

        $updateData = [
            'karyawan_id' => $karyawanId ?: null,
            'username'    => $this->request->getPost('username'),
            'role'        => $this->request->getPost('role'),
            'is_active'   => $this->request->getPost('is_active') ?? 0,
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to('/admin/user')->with('success', 'User berhasil diperbarui.');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/user')->with('error', 'User tidak ditemukan.');
        }

        if ($user['role'] === 'admin' && $user['id'] == session()->get('user_id')) {
            return redirect()->to('/admin/user')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/admin/user')->with('success', 'User berhasil dihapus.');
    }
}