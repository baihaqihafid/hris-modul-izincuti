<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">

        <form action="<?= base_url('hrd/laporan/izin') ?>" method="get" class="row g-2 mb-3 align-items-end">
            <div class="col-auto">
                <label class="form-label">Bulan</label>
                <select name="bulan" class="form-select">
                    <?php
                        $namaBulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
                        foreach ($namaBulan as $no => $nama) :
                    ?>
                        <option value="<?= $no ?>" <?= $bulan == $no ? 'selected' : '' ?>><?= $nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label">Tahun</label>
                <select name="tahun" class="form-select">
                    <?php for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++) : ?>
                        <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Tampilkan</button>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('hrd/laporan/izin/pdf?bulan=' . $bulan . '&tahun=' . $tahun) ?>" target="_blank" class="btn btn-danger">
                    <i class="bi bi-file-pdf"></i> Cetak PDF
                </a>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('hrd/laporan/izin/excel?bulan=' . $bulan . '&tahun=' . $tahun) ?>" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i> Cetak Excel
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="3%">#</th>
                        <th>NIK</th>
                        <th>Nama</th>
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
                        <tr><td colspan="9" class="text-center text-muted">Tidak ada data izin pada periode ini.</td></tr>
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
                                <td><span class="badge badge-status-<?= $row['status'] ?>"><?= esc($row['status']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>