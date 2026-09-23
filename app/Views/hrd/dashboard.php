<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-stat bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total Karyawan</h6>
                    <h3 class="mb-0"><?= $total_karyawan ?></h3>
                </div>
                <i class="bi bi-people icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat bg-warning text-dark">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Izin Menunggu Persetujuan</h6>
                    <h3 class="mb-0"><?= $izin_pending ?></h3>
                </div>
                <i class="bi bi-file-earmark-text icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat bg-info text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Cuti Menunggu Persetujuan</h6>
                    <h3 class="mb-0"><?= $cuti_pending ?></h3>
                </div>
                <i class="bi bi-calendar-week icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card card-stat">
            <div class="card-header bg-white"><strong>Pengajuan Izin Terbaru</strong></div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Nama</th><th>Jenis</th><th>Tanggal</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php if (empty($izin_terbaru)) : ?>
                            <tr><td colspan="4" class="text-center text-muted py-3">Tidak ada pengajuan izin menunggu.</td></tr>
                        <?php else : ?>
                            <?php foreach (array_slice($izin_terbaru, 0, 5) as $i) : ?>
                                <tr>
                                    <td><?= esc($i['nama_karyawan']) ?></td>
                                    <td><?= esc($i['jenis_izin']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($i['tanggal_izin'])) ?></td>
                                    <td><a href="<?= base_url('hrd/izin/detail/' . $i['id_izin']) ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-stat">
            <div class="card-header bg-white"><strong>Pengajuan Cuti Terbaru</strong></div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Nama</th><th>Periode</th><th>Lama</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php if (empty($cuti_terbaru)) : ?>
                            <tr><td colspan="4" class="text-center text-muted py-3">Tidak ada pengajuan cuti menunggu.</td></tr>
                        <?php else : ?>
                            <?php foreach (array_slice($cuti_terbaru, 0, 5) as $c) : ?>
                                <tr>
                                    <td><?= esc($c['nama_karyawan']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($c['tanggal_mulai'])) ?> - <?= date('d-m-Y', strtotime($c['tanggal_selesai'])) ?></td>
                                    <td><?= $c['lama_cuti'] ?> hari</td>
                                    <td><a href="<?= base_url('hrd/cuti/detail/' . $c['id_cuti']) ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>