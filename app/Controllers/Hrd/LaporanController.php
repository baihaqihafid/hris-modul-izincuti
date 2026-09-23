<?php

namespace App\Controllers\Hrd;

use App\Controllers\BaseController;
use App\Models\PengajuanIzinModel;
use App\Models\PengajuanCutiModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    protected $izinModel;
    protected $cutiModel;

    public function __construct()
    {
        $this->izinModel = new PengajuanIzinModel();
        $this->cutiModel = new PengajuanCutiModel();
    }

    public function izin()
    {
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'title' => 'Laporan Izin Karyawan',
            'izin'  => $this->getLaporanIzin($bulan, $tahun),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return view('hrd/laporan/izin', $data);
    }

    public function izinPdf()
    {
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'izin'  => $this->getLaporanIzin($bulan, $tahun),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return $this->generatePdf('hrd/laporan/izin_pdf', $data, 'Laporan-Izin-' . $bulan . '-' . $tahun);
    }

    public function cuti()
    {
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'title' => 'Laporan Cuti Karyawan',
            'cuti'  => $this->getLaporanCuti($bulan, $tahun),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return view('hrd/laporan/cuti', $data);
    }

    public function cutiPdf()
    {
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'cuti'  => $this->getLaporanCuti($bulan, $tahun),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        return $this->generatePdf('hrd/laporan/cuti_pdf', $data, 'Laporan-Cuti-' . $bulan . '-' . $tahun);
    }

    private function getLaporanIzin($bulan, $tahun)
    {
        return $this->izinModel
            ->select('pengajuan_izin.*, karyawan.nama_karyawan, karyawan.nik, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('karyawan', 'karyawan.id_karyawan = pengajuan_izin.karyawan_id')
            ->join('departemen', 'departemen.id_departemen = karyawan.departemen_id', 'left')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->where('MONTH(pengajuan_izin.tanggal_izin)', $bulan)
            ->where('YEAR(pengajuan_izin.tanggal_izin)', $tahun)
            ->orderBy('pengajuan_izin.tanggal_izin', 'ASC')
            ->findAll();
    }

    private function getLaporanCuti($bulan, $tahun)
    {
        return $this->cutiModel
            ->select('pengajuan_cuti.*, karyawan.nama_karyawan, karyawan.nik, departemen.nama_departemen, jabatan.nama_jabatan')
            ->join('karyawan', 'karyawan.id_karyawan = pengajuan_cuti.karyawan_id')
            ->join('departemen', 'departemen.id_departemen = karyawan.departemen_id', 'left')
            ->join('jabatan', 'jabatan.id_jabatan = karyawan.jabatan_id', 'left')
            ->where('MONTH(pengajuan_cuti.tanggal_mulai)', $bulan)
            ->where('YEAR(pengajuan_cuti.tanggal_mulai)', $tahun)
            ->orderBy('pengajuan_cuti.tanggal_mulai', 'ASC')
            ->findAll();
    }
    
    /**
     * Generate PDF dari view menggunakan Dompdf
     * Install dulu: composer require dompdf/dompdf
     */
    private function generatePdf($view, $data, $filename)
    {
        $html = view($view, $data);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream($filename . '.pdf', ['Attachment' => false]);
    }

    
    /**
     * export HTML table sebagai file Excel (.xls)
     */
    public function izinExcel()
{
    $bulan = $this->request->getGet('bulan') ?? date('m');
    $tahun = $this->request->getGet('tahun') ?? date('Y');

    $data = [
        'izin'  => $this->getLaporanIzin($bulan, $tahun),
        'bulan' => $bulan,
        'tahun' => $tahun,
    ];

    return $this->generateExcel('hrd/laporan/izin_excel', $data, 'Laporan-Izin-' . $bulan . '-' . $tahun);
}

public function cutiExcel()
{
    $bulan = $this->request->getGet('bulan') ?? date('m');
    $tahun = $this->request->getGet('tahun') ?? date('Y');

    $data = [
        'cuti'  => $this->getLaporanCuti($bulan, $tahun),
        'bulan' => $bulan,
        'tahun' => $tahun,
    ];

    return $this->generateExcel('hrd/laporan/cuti_excel', $data, 'Laporan-Cuti-' . $bulan . '-' . $tahun);
    }
    private function generateExcel($view, $data, $filename)
    {
        $html = view($view, $data);

        return $this->response
            ->setHeader('Content-Type', 'application/vnd.ms-excel')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '.xls"')
            ->setBody($html);
    }
}