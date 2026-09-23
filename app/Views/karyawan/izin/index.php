<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">

        <a href="<?= base_url('karyawan/izin/create') ?>" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Ajukan Izin
        </a>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="3%">#</th>
                        <th>Jenis Izin</th>
                        <th>Tanggal Izin</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($izin)) : ?>
                        <tr><td colspan="6" class="text-center text-muted">Belum ada pengajuan izin.</td></tr>
                    <?php else : ?>
                        <?php foreach ($izin as $i => $row) : ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($row['jenis_izin']) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_izin'])) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                                <td><span class="badge badge-status-<?= $row['status'] ?>"><?= esc($row['status']) ?></span></td>
                                <td>
                                    <a href="<?= base_url('karyawan/izin/detail/' . $row['id_izin']) ?>" class="btn btn-sm btn-info">
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