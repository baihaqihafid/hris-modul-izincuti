<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat mb-3">
    <div class="card-body">
        <h6 class="mb-1">Sisa Cuti Tahun <?= date('Y') ?></h6>
        <h3 class="mb-0 text-primary">
            <?= $hak_cuti['sisa_cuti'] ?? 0 ?> <small class="text-muted fs-6">dari <?= $hak_cuti['total_cuti'] ?? 0 ?> hari</small>
        </h3>
    </div>
</div>

<div class="card card-stat">
    <div class="card-body">

        <a href="<?= base_url('karyawan/cuti/create') ?>" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Ajukan Cuti
        </a>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="3%">#</th>
                        <th>Periode</th>
                        <th>Lama</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($cuti)) : ?>
                        <tr><td colspan="6" class="text-center text-muted">Belum ada pengajuan cuti.</td></tr>
                    <?php else : ?>
                        <?php foreach ($cuti as $i => $row) : ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_mulai'])) ?> - <?= date('d-m-Y', strtotime($row['tanggal_selesai'])) ?></td>
                                <td><?= $row['lama_cuti'] ?> hari</td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                                <td><span class="badge badge-status-<?= $row['status'] ?>"><?= esc($row['status']) ?></span></td>
                                <td>
                                    <a href="<?= base_url('karyawan/cuti/detail/' . $row['id_cuti']) ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>