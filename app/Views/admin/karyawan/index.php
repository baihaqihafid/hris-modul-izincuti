<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">

        <a href="<?= base_url('admin/karyawan/create') ?>" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Karyawan
        </a>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="3%">#</th>
                        <th>Foto</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($karyawan)) : ?>
                        <tr><td colspan="8" class="text-center text-muted">Belum ada data karyawan.</td></tr>
                    <?php else : ?>
                        <?php foreach ($karyawan as $i => $k) : ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <?php if ($k['foto']) : ?>
                                        <img src="<?= base_url('assets/uploads/foto/' . $k['foto']) ?>" width="40" height="40" class="rounded-circle" style="object-fit: cover;">
                                    <?php else : ?>
                                        <i class="bi bi-person-circle fs-3 text-secondary"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($k['nik']) ?></td>
                                <td><?= esc($k['nama_karyawan']) ?></td>
                                <td><?= esc($k['nama_departemen'] ?? '-') ?></td>
                                <td><?= esc($k['nama_jabatan'] ?? '-') ?></td>
                                <td>
                                    <?php
                                        $statusClass = match($k['status_karyawan']) {
                                            'Aktif' => 'success',
                                            'Tidak Aktif' => 'secondary',
                                            'Resign' => 'danger',
                                            default => 'secondary',
                                        };
                                    ?>
                                    <span class="badge bg-<?= $statusClass ?>"><?= esc($k['status_karyawan']) ?></span>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/karyawan/detail/' . $k['id_karyawan']) ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= base_url('admin/karyawan/edit/' . $k['id_karyawan']) ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="<?= base_url('admin/karyawan/delete/' . $k['id_karyawan']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus data karyawan ini?')">
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