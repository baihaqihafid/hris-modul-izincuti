<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\PengajuanIzinModel;

class IzinController extends BaseController
{
    protected $izinModel;

    public function __construct()
    {
        $this->izinModel = new PengajuanIzinModel();
    }

    public function index()
    {
        $karyawanId = session()->get('karyawan_id');

        $data = [
            'title' => 'Pengajuan Izin Saya',
            'izin'  => $this->izinModel->getByKaryawan($karyawanId),
        ];

        return view('karyawan/izin/index', $data);
    }

    public function create()
    {
        return view('karyawan/izin/create', ['title' => 'Ajukan Izin']);
    }

    public function store()
    {
        $rules = [
            'tanggal_izin' => 'required|valid_date',
            'jenis_izin'   => 'required|in_list[Sakit,Keperluan Pribadi,Keluarga,Lainnya]',
            'alasan'       => 'required|min_length[5]',
            'dokumen'      => 'permit_empty|max_size[dokumen,2048]|ext_in[dokumen,pdf,jpg,jpeg,png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dokumenNama = null;
        $dokumen = $this->request->getFile('dokumen');
        if ($dokumen && $dokumen->isValid() && !$dokumen->hasMoved()) {
            $dokumenNama = $dokumen->getRandomName();
            $dokumen->move(FCPATH . 'assets/uploads/dokumen', $dokumenNama);
        }

        $this->izinModel->insert([
            'karyawan_id'       => session()->get('karyawan_id'),
            'tanggal_pengajuan' => date('Y-m-d'),
            'tanggal_izin'      => $this->request->getPost('tanggal_izin'),
            'jenis_izin'        => $this->request->getPost('jenis_izin'),
            'alasan'            => $this->request->getPost('alasan'),
            'dokumen'           => $dokumenNama,
            'status'            => 'Menunggu',
        ]);

        return redirect()->to('/karyawan/izin')->with('success', 'Pengajuan izin berhasil dikirim. Menunggu persetujuan HRD.');
    }

    public function detail($id)
    {
        $izin = $this->izinModel->find($id);

        if (!$izin || $izin['karyawan_id'] != session()->get('karyawan_id')) {
            return redirect()->to('/karyawan/izin')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Pengajuan Izin',
            'izin'  => $izin,
        ];

        return view('karyawan/izin/detail', $data);
    }
}