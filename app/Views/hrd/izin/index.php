<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">

        <div class="mb-3">
            <a href="<?= base_url('hrd/izin') ?>" class="btn btn-sm <?= !$status ? 'btn-primary' : 'btn-outline-primary' ?>">Semua</a>
            <a href="<?= base_url('hrd/izin?status=Menunggu') ?>" class="btn btn-sm <?= $status == 'Menunggu' ? 'btn-warning' : 'btn-outline-warning' ?>">Menunggu</a>
            <a href="<?= base_url('hrd/izin?status=Disetujui') ?>" class="btn btn-sm <?= $status == 'Disetujui' ? 'btn-success' : 'btn-outline-success' ?>">Disetujui</a>
            <a href="<?= base_url('hrd/izin?status=Ditolak') ?>" class="btn btn-sm <?= $status == 'Ditolak' ? 'btn-danger' : 'btn-outline-danger' ?>">Ditolak</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="3%">#</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Jenis Izin</th>
                        <th>Tanggal Izin</th>
                        <th>Status</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($izin)) : ?>
                        <tr><td colspan="8" class="text-center text-muted">Tidak ada data pengajuan izin.</td></tr>
                    <?php else : ?>
                        <?php foreach ($izin as $i => $row) : ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($row['nama_karyawan']) ?></td>
                                <td><?= esc($row['nama_departemen'] ?? '-') ?></td>
                                <td><?= esc($row['nama_jabatan'] ?? '-') ?></td>
                                <td><?= esc($row['jenis_izin']) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_izin'])) ?></td>
                                <td>
                                    <span class="badge badge-status-<?= $row['status'] ?>"><?= esc($row['status']) ?></span>
                                </td>
                                <td>
                                    <a href="<?= base_url('hrd/izin/detail/' . $row['id_izin']) ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= base_url('hrd/izin/delete/' . $row['id_izin']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus data pengajuan izin ini?')">
                                        <i class="bi bi-trash"></i>
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