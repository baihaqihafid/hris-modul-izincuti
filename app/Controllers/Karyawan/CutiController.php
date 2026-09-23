<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\PengajuanCutiModel;
use App\Models\HakCutiModel;

class CutiController extends BaseController
{
    protected $cutiModel;
    protected $hakCutiModel;

    public function __construct()
    {
        $this->cutiModel    = new PengajuanCutiModel();
        $this->hakCutiModel = new HakCutiModel();
    }

    public function index()
    {
        $karyawanId = session()->get('karyawan_id');

        $data = [
            'title'    => 'Pengajuan Cuti Saya',
            'cuti'     => $this->cutiModel->getByKaryawan($karyawanId),
            'hak_cuti' => $this->hakCutiModel->getByKaryawanTahun($karyawanId, date('Y')),
        ];

        return view('karyawan/cuti/index', $data);
    }

    public function create()
    {
        $karyawanId = session()->get('karyawan_id');

        $data = [
            'title'    => 'Ajukan Cuti',
            'hak_cuti' => $this->hakCutiModel->getByKaryawanTahun($karyawanId, date('Y')),
        ];

        return view('karyawan/cuti/create', $data);
    }

    public function store()
    {
        $rules = [
            'tanggal_mulai'   => 'required|valid_date',
            'tanggal_selesai' => 'required|valid_date',
            'alasan'          => 'required|min_length[5]',
            'dokumen'         => 'permit_empty|max_size[dokumen,2048]|ext_in[dokumen,pdf,jpg,jpeg,png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tglMulai   = $this->request->getPost('tanggal_mulai');
        $tglSelesai = $this->request->getPost('tanggal_selesai');

        if (strtotime($tglSelesai) < strtotime($tglMulai)) {
            return redirect()->back()->withInput()->with('error', 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.');
        }

        // Hitung lama cuti (inklusif)
        $lamaCuti = (strtotime($tglSelesai) - strtotime($tglMulai)) / 86400 + 1;

        $karyawanId = session()->get('karyawan_id');
        $tahun = date('Y', strtotime($tglMulai));
        $hakCuti = $this->hakCutiModel->getByKaryawanTahun($karyawanId, $tahun);

        if (!$hakCuti) {
            return redirect()->back()->withInput()->with('error', 'Data hak cuti Anda untuk tahun ' . $tahun . ' belum tersedia. Silakan hubungi HRD.');
        }

        if ($hakCuti['sisa_cuti'] < $lamaCuti) {
            return redirect()->back()->withInput()->with('error', 'Sisa cuti Anda tidak cukup. Sisa cuti: ' . $hakCuti['sisa_cuti'] . ' hari, diajukan: ' . $lamaCuti . ' hari.');
        }

        $dokumenNama = null;
        $dokumen = $this->request->getFile('dokumen');
        if ($dokumen && $dokumen->isValid() && !$dokumen->hasMoved()) {
            $dokumenNama = $dokumen->getRandomName();
            $dokumen->move(FCPATH . 'assets/uploads/dokumen', $dokumenNama);
        }

        $this->cutiModel->insert([
            'karyawan_id'       => $karyawanId,
            'tanggal_pengajuan' => date('Y-m-d'),
            'tanggal_mulai'     => $tglMulai,
            'tanggal_selesai'   => $tglSelesai,
            'lama_cuti'         => $lamaCuti,
            'alasan'            => $this->request->getPost('alasan'),
            'dokumen'           => $dokumenNama,
            'status'            => 'Menunggu',
        ]);

        return redirect()->to('/karyawan/cuti')->with('success', 'Pengajuan cuti berhasil dikirim. Menunggu persetujuan HRD.');
    }

    public function detail($id)
    {
        $cuti = $this->cutiModel->find($id);

        if (!$cuti || $cuti['karyawan_id'] != session()->get('karyawan_id')) {
            return redirect()->to('/karyawan/cuti')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Pengajuan Cuti',
            'cuti'  => $cuti,
        ];

        return view('karyawan/cuti/detail', $data);
    }
}