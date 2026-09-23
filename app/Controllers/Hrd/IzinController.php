<?php

namespace App\Controllers\Hrd;

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
        $status = $this->request->getGet('status');

        $data = [
            'title'  => 'Pengajuan Izin Karyawan',
            'izin'   => $this->izinModel->getAllWithKaryawan($status),
            'status' => $status,
        ];

        return view('hrd/izin/index', $data);
    }

    public function detail($id)
    {
        $izin = $this->izinModel->getDetailWithKaryawan($id);

        if (!$izin) {
            return redirect()->to('/hrd/izin')->with('error', 'Data pengajuan tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Pengajuan Izin',
            'izin'  => $izin,
        ];

        return view('hrd/izin/detail', $data);
    }

    public function proses($id)
    {
        $izin = $this->izinModel->find($id);

        if (!$izin) {
            return redirect()->to('/hrd/izin')->with('error', 'Data pengajuan tidak ditemukan.');
        }

        if ($izin['status'] !== 'Menunggu') {
            return redirect()->to('/hrd/izin')->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $rules = [
            'status'      => 'required|in_list[Disetujui,Ditolak]',
            'catatan_hrd' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $this->izinModel->update($id, [
            'status'      => $this->request->getPost('status'),
            'catatan_hrd' => $this->request->getPost('catatan_hrd'),
            'approved_by' => session()->get('user_id'),
        ]);

        return redirect()->to('/hrd/izin')->with('success', 'Pengajuan izin berhasil diproses.');
    }
    public function delete($id)
    {
        $izin = $this->izinModel->find($id);

        if (!$izin) {
            return redirect()->to('/hrd/izin')->with('error', 'Data pengajuan tidak ditemukan.');
        }

        // Hapus file dokumen jika ada
        if ($izin['dokumen'] && file_exists(FCPATH . 'assets/uploads/dokumen/' . $izin['dokumen'])) {
            unlink(FCPATH . 'assets/uploads/dokumen/' . $izin['dokumen']);
        }

        $this->izinModel->delete($id);

        return redirect()->to('/hrd/izin')->with('success', 'Data pengajuan izin berhasil dihapus.');
    }
}