<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JabatanModel;

class JabatanController extends BaseController
{
    protected $jabatanModel;

    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Kelola Jabatan',
            'jabatan' => $this->jabatanModel->orderBy('nama_jabatan', 'ASC')->findAll(),
        ];

        return view('admin/jabatan/index', $data);
    }

    public function store()
    {
        $rules = [
            'nama_jabatan' => 'required|min_length[3]|is_unique[jabatan.nama_jabatan]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->jabatanModel->insert([
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
        ]);

        return redirect()->to('/admin/jabatan')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function update($id)
    {
        $jabatan = $this->jabatanModel->find($id);

        if (!$jabatan) {
            return redirect()->to('/admin/jabatan')->with('error', 'Jabatan tidak ditemukan.');
        }

        $rules = [
            'nama_jabatan' => "required|min_length[3]|is_unique[jabatan.nama_jabatan,id_jabatan,{$id}]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->jabatanModel->update($id, [
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
        ]);

        return redirect()->to('/admin/jabatan')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $jabatan = $this->jabatanModel->find($id);

        if (!$jabatan) {
            return redirect()->to('/admin/jabatan')->with('error', 'Jabatan tidak ditemukan.');
        }

        $db = \Config\Database::connect();
        $jumlah = $db->table('karyawan')->where('jabatan_id', $id)->countAllResults();

        if ($jumlah > 0) {
            return redirect()->to('/admin/jabatan')->with('error', 'Jabatan tidak dapat dihapus karena masih digunakan oleh karyawan.');
        }

        $this->jabatanModel->delete($id);

        return redirect()->to('/admin/jabatan')->with('success', 'Jabatan berhasil dihapus.');
    }
}