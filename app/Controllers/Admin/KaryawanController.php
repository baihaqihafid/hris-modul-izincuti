<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use App\Models\HakCutiModel;

class KaryawanController extends BaseController
{
    protected $karyawanModel;
    protected $departemenModel;
    protected $jabatanModel;
    protected $hakCutiModel;

    public function __construct()
    {
        $this->karyawanModel   = new KaryawanModel();
        $this->departemenModel = new DepartemenModel();
        $this->jabatanModel    = new JabatanModel();
        $this->hakCutiModel    = new HakCutiModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Kelola Data Karyawan',
            'karyawan' => $this->karyawanModel->getAllWithRelasi(),
        ];

        return view('admin/karyawan/index', $data);
    }

    public function create()
    {
        // Generate NIK otomatis berdasarkan departemen terakhir
        // Default kosong dulu, akan diupdate via JavaScript saat departemen dipilih
        $data = [
            'title'      => 'Tambah Karyawan',
            'departemen' => $this->departemenModel->orderBy('nama_departemen', 'ASC')->findAll(),
            'jabatan'    => $this->jabatanModel->orderBy('nama_jabatan', 'ASC')->findAll(),
            'nik_preview' => '',
        ];

        return view('admin/karyawan/create', $data);
    }

    public function generateNik()
    {
        $departemenId = $this->request->getGet('departemen_id');

        if (!$departemenId) {
            return $this->response->setJSON(['nik' => '']);
        }

        $departemen = $this->departemenModel->find($departemenId);

        if (!$departemen) {
            return $this->response->setJSON(['nik' => '']);
    }

    // Buat kode prefix dari nama departemen
    $nama = strtoupper($departemen['nama_departemen']);
    $kodeMap = [
        'HUMAN RESOURCE' => 'HRD',
        'HRD'            => 'HRD',
        'FINANCE'        => 'FIN',
        'IT'             => 'IT',
        'MARKETING'      => 'MKT',
        'OPERASIONAL'    => 'OPS',
        'LOGISTIK'       => 'LOG',
        'PRODUKSI'       => 'PRD',
    ];

    // Cari prefix yang cocok
    $prefix = 'KRY'; // default
    foreach ($kodeMap as $key => $kode) {
        if (str_contains($nama, $key)) {
            $prefix = $kode;
            break;
        }
    }

    // Cari NIK terakhir dengan prefix ini
    $db = \Config\Database::connect();
    $last = $db->table('karyawan')
        ->like('nik', $prefix, 'after')
        ->orderBy('nik', 'DESC')
        ->limit(1)
        ->get()
        ->getRowArray();

    if ($last) {
        // Ambil angka di belakang prefix
        $angka = (int) substr($last['nik'], strlen($prefix));
        $angka++;
    } else {
        $angka = 1;
    }

    $nik = $prefix . str_pad($angka, 3, '0', STR_PAD_LEFT);

    return $this->response->setJSON(['nik' => $nik]);
    }

    public function store()
    {
        $rules = [
            'nik'             => 'required|min_length[3]|is_unique[karyawan.nik]',
            'nama_karyawan'   => 'required|min_length[3]',
            'jenis_kelamin'   => 'required|in_list[Laki-laki,Perempuan]',
            'tempat_lahir'    => 'required',
            'tanggal_lahir'   => 'required|valid_date',
            'alamat'          => 'required',
            'no_hp'           => 'required|min_length[9]',
            'email'           => 'required|valid_email|is_unique[karyawan.email]',
            'departemen_id'   => 'required|is_natural_no_zero',
            'jabatan_id'      => 'required|is_natural_no_zero',
            'tanggal_masuk'   => 'required|valid_date',
            'status_karyawan' => 'required|in_list[Aktif,Tidak Aktif,Resign]',
            'foto'            => 'is_image[foto]|max_size[foto,2048]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fotoNama = null;
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoNama = $foto->getRandomName();
            $foto->move(FCPATH . 'assets/uploads/foto', $fotoNama);
        }

        $karyawanId = $this->karyawanModel->insert([
            'nik'             => $this->request->getPost('nik'),
            'nama_karyawan'   => $this->request->getPost('nama_karyawan'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'    => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'   => $this->request->getPost('tanggal_lahir'),
            'alamat'          => $this->request->getPost('alamat'),
            'no_hp'           => $this->request->getPost('no_hp'),
            'email'           => $this->request->getPost('email'),
            'departemen_id'   => $this->request->getPost('departemen_id'),
            'jabatan_id'      => $this->request->getPost('jabatan_id'),
            'tanggal_masuk'   => $this->request->getPost('tanggal_masuk'),
            'status_karyawan' => $this->request->getPost('status_karyawan'),
            'foto'            => $fotoNama,
        ], true);

        // Otomatis buat hak cuti tahun ini
        $this->hakCutiModel->insert([
            'karyawan_id' => $karyawanId,
            'tahun'       => date('Y'),
            'total_cuti'  => 12,
            'sisa_cuti'   => 12,
        ]);

        return redirect()->to('/admin/karyawan')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $karyawan = $this->karyawanModel->find($id);

        if (!$karyawan) {
            return redirect()->to('/admin/karyawan')->with('error', 'Data karyawan tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Karyawan',
            'karyawan'   => $karyawan,
            'departemen' => $this->departemenModel->orderBy('nama_departemen', 'ASC')->findAll(),
            'jabatan'    => $this->jabatanModel->orderBy('nama_jabatan', 'ASC')->findAll(),
        ];

        return view('admin/karyawan/edit', $data);
    }

    public function update($id)
    {
        $karyawan = $this->karyawanModel->find($id);

        if (!$karyawan) {
            return redirect()->to('/admin/karyawan')->with('error', 'Data karyawan tidak ditemukan.');
        }

        $rules = [
            'nik'             => "required|min_length[3]|is_unique[karyawan.nik,id_karyawan,{$id}]",
            'nama_karyawan'   => 'required|min_length[3]',
            'jenis_kelamin'   => 'required|in_list[Laki-laki,Perempuan]',
            'tempat_lahir'    => 'required',
            'tanggal_lahir'   => 'required|valid_date',
            'alamat'          => 'required',
            'no_hp'           => 'required|min_length[9]',
            'email'           => "required|valid_email|is_unique[karyawan.email,id_karyawan,{$id}]",
            'departemen_id'   => 'required|is_natural_no_zero',
            'jabatan_id'      => 'required|is_natural_no_zero',
            'tanggal_masuk'   => 'required|valid_date',
            'status_karyawan' => 'required|in_list[Aktif,Tidak Aktif,Resign]',
            'foto'            => 'is_image[foto]|max_size[foto,2048]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'nik'             => $this->request->getPost('nik'),
            'nama_karyawan'   => $this->request->getPost('nama_karyawan'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'    => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'   => $this->request->getPost('tanggal_lahir'),
            'alamat'          => $this->request->getPost('alamat'),
            'no_hp'           => $this->request->getPost('no_hp'),
            'email'           => $this->request->getPost('email'),
            'departemen_id'   => $this->request->getPost('departemen_id'),
            'jabatan_id'      => $this->request->getPost('jabatan_id'),
            'tanggal_masuk'   => $this->request->getPost('tanggal_masuk'),
            'status_karyawan' => $this->request->getPost('status_karyawan'),
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama jika ada
            if ($karyawan['foto'] && file_exists(FCPATH . 'assets/uploads/foto/' . $karyawan['foto'])) {
                unlink(FCPATH . 'assets/uploads/foto/' . $karyawan['foto']);
            }

            $fotoNama = $foto->getRandomName();
            $foto->move(FCPATH . 'assets/uploads/foto', $fotoNama);
            $updateData['foto'] = $fotoNama;
        }

        $this->karyawanModel->update($id, $updateData);

        return redirect()->to('/admin/karyawan')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $karyawan = $this->karyawanModel->find($id);

        if (!$karyawan) {
            return redirect()->to('/admin/karyawan')->with('error', 'Data karyawan tidak ditemukan.');
        }

        // Cek apakah karyawan punya akun user
        $db = \Config\Database::connect();
        $userTerkait = $db->table('users')->where('karyawan_id', $id)->countAllResults();

        if ($userTerkait > 0) {
            return redirect()->to('/admin/karyawan')->with('error', 'Karyawan tidak dapat dihapus karena masih memiliki akun login. Hapus akun user terkait terlebih dahulu.');
        }

        if ($karyawan['foto'] && file_exists(FCPATH . 'assets/uploads/foto/' . $karyawan['foto'])) {
            unlink(FCPATH . 'assets/uploads/foto/' . $karyawan['foto']);
        }

        $this->karyawanModel->delete($id);

        return redirect()->to('/admin/karyawan')->with('success', 'Data karyawan berhasil dihapus.');
    }

    public function detail($id)
    {
        $karyawan = $this->karyawanModel->getDetailWithRelasi($id);

        if (!$karyawan) {
            return redirect()->to('/admin/karyawan')->with('error', 'Data karyawan tidak ditemukan.');
        }

        $data = [
            'title'    => 'Detail Karyawan',
            'karyawan' => $karyawan,
            'hak_cuti' => $this->hakCutiModel->getByKaryawanTahun($id, date('Y')),
        ];

        return view('admin/karyawan/detail', $data);
    }
}