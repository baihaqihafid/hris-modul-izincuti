<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-stat bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Sisa Cuti Tahun <?= date('Y') ?></h6>
                    <h3 class="mb-0"><?= $hak_cuti['sisa_cuti'] ?? 0 ?> / <?= $hak_cuti['total_cuti'] ?? 0 ?> hari</h3>
                </div>
                <i class="bi bi-calendar2-check icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat bg-warning text-dark">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total Pengajuan Izin</h6>
                    <h3 class="mb-0"><?= count($izin) ?></h3>
                </div>
                <i class="bi bi-file-earmark-text icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat bg-info text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total Pengajuan Cuti</h6>
                    <h3 class="mb-0"><?= count($cuti) ?></h3>
                </div>
                <i class="bi bi-calendar-week icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="card card-stat">
    <div class="card-body">
        <h5>Selamat datang, <?= esc($karyawan['nama_karyawan'] ?? session()->get('username')) ?> 👋</h5>
        <p class="text-muted mb-0">
            Gunakan menu di sebelah kiri untuk mengajukan izin atau cuti, melihat status pengajuan,
            serta mengelola profil Anda.
        </p>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-6">
        <div class="card card-stat">
            <div class="card-header bg-white"><strong>Riwayat Izin Terbaru</strong></div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light"><tr><th>Jenis</th><th>Tanggal</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php if (empty($izin)) : ?>
                            <tr><td colspan="3" class="text-center text-muted py-3">Belum ada pengajuan.</td></tr>
                        <?php else : ?>
                            <?php foreach (array_slice($izin, 0, 5) as $i) : ?>
                                <tr>
                                    <td><?= esc($i['jenis_izin']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($i['tanggal_izin'])) ?></td>
                                    <td><span class="badge badge-status-<?= $i['status'] ?>"><?= esc($i['status']) ?></span></td>
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
            <div class="card-header bg-white"><strong>Riwayat Cuti Terbaru</strong></div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light"><tr><th>Periode</th><th>Lama</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php if (empty($cuti)) : ?>
                            <tr><td colspan="3" class="text-center text-muted py-3">Belum ada pengajuan.</td></tr>
                        <?php else : ?>
                            <?php foreach (array_slice($cuti, 0, 5) as $c) : ?>
                                <tr>
                                    <td><?= date('d-m-Y', strtotime($c['tanggal_mulai'])) ?> - <?= date('d-m-Y', strtotime($c['tanggal_selesai'])) ?></td>
                                    <td><?= $c['lama_cuti'] ?> hari</td>
                                    <td><span class="badge badge-status-<?= $c['status'] ?>"><?= esc($c['status']) ?></span></td>
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