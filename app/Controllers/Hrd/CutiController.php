<?php

namespace App\Controllers\Hrd;

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
        $status = $this->request->getGet('status');

        $data = [
            'title'  => 'Pengajuan Cuti Karyawan',
            'cuti'   => $this->cutiModel->getAllWithKaryawan($status),
            'status' => $status,
        ];

        return view('hrd/cuti/index', $data);
    }

    public function detail($id)
    {
        $cuti = $this->cutiModel->getDetailWithKaryawan($id);

        if (!$cuti) {
            return redirect()->to('/hrd/cuti')->with('error', 'Data pengajuan tidak ditemukan.');
        }

        $hakCuti = $this->hakCutiModel->getByKaryawanTahun($cuti['karyawan_id'], date('Y', strtotime($cuti['tanggal_mulai'])));

        $data = [
            'title'    => 'Detail Pengajuan Cuti',
            'cuti'     => $cuti,
            'hak_cuti' => $hakCuti,
        ];

        return view('hrd/cuti/detail', $data);
    }

    public function proses($id)
    {
        $cuti = $this->cutiModel->find($id);

        if (!$cuti) {
            return redirect()->to('/hrd/cuti')->with('error', 'Data pengajuan tidak ditemukan.');
        }

        if ($cuti['status'] !== 'Menunggu') {
            return redirect()->to('/hrd/cuti')->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $rules = [
            'status'      => 'required|in_list[Disetujui,Ditolak]',
            'catatan_hrd' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $statusBaru = $this->request->getPost('status');

        // Jika disetujui, potong sisa cuti
        if ($statusBaru === 'Disetujui') {
            $tahun = date('Y', strtotime($cuti['tanggal_mulai']));
            $hakCuti = $this->hakCutiModel->getByKaryawanTahun($cuti['karyawan_id'], $tahun);

            if (!$hakCuti) {
                return redirect()->back()->with('error', 'Data hak cuti karyawan untuk tahun ' . $tahun . ' tidak ditemukan. Silakan generate hak cuti terlebih dahulu.');
            }

            if ($hakCuti['sisa_cuti'] < $cuti['lama_cuti']) {
                return redirect()->back()->with('error', 'Sisa cuti karyawan tidak cukup (sisa: ' . $hakCuti['sisa_cuti'] . ' hari, diajukan: ' . $cuti['lama_cuti'] . ' hari).');
            }

            $this->hakCutiModel->kurangiSisaCuti($cuti['karyawan_id'], $tahun, $cuti['lama_cuti']);
        }

        $this->cutiModel->update($id, [
            'status'      => $statusBaru,
            'catatan_hrd' => $this->request->getPost('catatan_hrd'),
            'approved_by' => session()->get('user_id'),
        ]);

        return redirect()->to('/hrd/cuti')->with('success', 'Pengajuan cuti berhasil diproses.');
    }
    public function delete($id)
    {
        $cuti = $this->cutiModel->find($id);

        if (!$cuti) {
            return redirect()->to('/hrd/cuti')->with('error', 'Data pengajuan tidak ditemukan.');
        }

        // Jika sebelumnya disetujui, kembalikan sisa cuti karyawan
        if ($cuti['status'] === 'Disetujui') {
            $tahun = date('Y', strtotime($cuti['tanggal_mulai']));
            $this->hakCutiModel->tambahSisaCuti($cuti['karyawan_id'], $tahun, $cuti['lama_cuti']);
        }

        // Hapus file dokumen jika ada
        if ($cuti['dokumen'] && file_exists(FCPATH . 'assets/uploads/dokumen/' . $cuti['dokumen'])) {
            unlink(FCPATH . 'assets/uploads/dokumen/' . $cuti['dokumen']);
        }

        $this->cutiModel->delete($id);

        return redirect()->to('/hrd/cuti')->with('success', 'Data pengajuan cuti berhasil dihapus.');
    }
}