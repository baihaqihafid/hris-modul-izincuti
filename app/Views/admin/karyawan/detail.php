<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                <?php if ($karyawan['foto']) : ?>
                    <img src="<?= base_url('assets/uploads/foto/' . $karyawan['foto']) ?>" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
                <?php else : ?>
                    <i class="bi bi-person-circle" style="font-size: 8rem; color: #ccc;"></i>
                <?php endif; ?>
                <h5><?= esc($karyawan['nama_karyawan']) ?></h5>
                <p class="text-muted"><?= esc($karyawan['nama_jabatan'] ?? '-') ?></p>
            </div>
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tr><th width="200">NIK</th><td><?= esc($karyawan['nik']) ?></td></tr>
                    <tr><th>Jenis Kelamin</th><td><?= esc($karyawan['jenis_kelamin']) ?></td></tr>
                    <tr><th>Tempat, Tanggal Lahir</th><td><?= esc($karyawan['tempat_lahir']) ?>, <?= date('d-m-Y', strtotime($karyawan['tanggal_lahir'])) ?></td></tr>
                    <tr><th>Alamat</th><td><?= esc($karyawan['alamat']) ?></td></tr>
                    <tr><th>No. HP</th><td><?= esc($karyawan['no_hp']) ?></td></tr>
                    <tr><th>Email</th><td><?= esc($karyawan['email']) ?></td></tr>
                    <tr><th>Departemen</th><td><?= esc($karyawan['nama_departemen'] ?? '-') ?></td></tr>
                    <tr><th>Jabatan</th><td><?= esc($karyawan['nama_jabatan'] ?? '-') ?></td></tr>
                    <tr><th>Tanggal Masuk</th><td><?= date('d-m-Y', strtotime($karyawan['tanggal_masuk'])) ?></td></tr>
                    <tr><th>Status</th><td><span class="badge bg-success"><?= esc($karyawan['status_karyawan']) ?></span></td></tr>
                    <tr>
                        <th>Hak Cuti Tahun <?= date('Y') ?></th>
                        <td>
                            <?php if ($hak_cuti) : ?>
                                Total: <?= $hak_cuti['total_cuti'] ?> hari | Sisa: <strong><?= $hak_cuti['sisa_cuti'] ?> hari</strong>
                            <?php else : ?>
                                <span class="text-muted">Belum ada data hak cuti</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="<?= base_url('admin/karyawan') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>