<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Izin</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
        h3 { text-align: center; margin-bottom: 2px; }
        p.sub { text-align: center; margin-top: 0; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h3>LAPORAN PENGAJUAN IZIN KARYAWAN</h3>
    <p class="sub">
        Periode: <?php
            $namaBulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
            echo $namaBulan[$bulan] . ' ' . $tahun;
        ?>
    </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama Karyawan</th>
                <th>Departemen</th>
                <th>Jabatan</th>
                <th>Jenis Izin</th>
                <th>Tanggal Izin</th>
                <th>Alasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($izin)) : ?>
                <tr><td colspan="9" style="text-align:center;">Tidak ada data.</td></tr>
            <?php else : ?>
                <?php foreach ($izin as $i => $row) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($row['nik']) ?></td>
                        <td><?= esc($row['nama_karyawan']) ?></td>
                        <td><?= esc($row['nama_departemen'] ?? '-') ?></td>
                        <td><?= esc($row['nama_jabatan'] ?? '-') ?></td>
                        <td><?= esc($row['jenis_izin']) ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal_izin'])) ?></td>
                        <td><?= esc($row['alasan']) ?></td>
                        <td><?= esc($row['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <p style="margin-top: 30px; text-align: right;">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </p>
</body>
</html>