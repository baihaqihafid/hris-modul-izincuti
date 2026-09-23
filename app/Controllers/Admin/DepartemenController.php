<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DepartemenModel;

class DepartemenController extends BaseController
{
    protected $departemenModel;

    public function __construct()
    {
        $this->departemenModel = new DepartemenModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Kelola Departemen',
            'departemen' => $this->departemenModel->orderBy('nama_departemen', 'ASC')->findAll(),
        ];

        return view('admin/departemen/index', $data);
    }

    public function store()
    {
        $rules = [
            'nama_departemen' => 'required|min_length[3]|is_unique[departemen.nama_departemen]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->departemenModel->insert([
            'nama_departemen' => $this->request->getPost('nama_departemen'),
        ]);

        return redirect()->to('/admin/departemen')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function update($id)
    {
        $departemen = $this->departemenModel->find($id);

        if (!$departemen) {
            return redirect()->to('/admin/departemen')->with('error', 'Departemen tidak ditemukan.');
        }

        $rules = [
            'nama_departemen' => "required|min_length[3]|is_unique[departemen.nama_departemen,id_departemen,{$id}]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->departemenModel->update($id, [
            'nama_departemen' => $this->request->getPost('nama_departemen'),
        ]);

        return redirect()->to('/admin/departemen')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function delete($id)
    {
        $departemen = $this->departemenModel->find($id);

        if (!$departemen) {
            return redirect()->to('/admin/departemen')->with('error', 'Departemen tidak ditemukan.');
        }

        // Cegah hapus jika masih dipakai karyawan
        $db = \Config\Database::connect();
        $jumlah = $db->table('karyawan')->where('departemen_id', $id)->countAllResults();

        if ($jumlah > 0) {
            return redirect()->to('/admin/departemen')->with('error', 'Departemen tidak dapat dihapus karena masih digunakan oleh karyawan.');
        }

        $this->departemenModel->delete($id);

        return redirect()->to('/admin/departemen')->with('success', 'Departemen berhasil dihapus.');
    }
}