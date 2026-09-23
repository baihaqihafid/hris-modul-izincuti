<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="3%">#</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($karyawan as $i => $k) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
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
                                <a href="<?= base_url('hrd/karyawan/detail/' . $k['id_karyawan']) ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>