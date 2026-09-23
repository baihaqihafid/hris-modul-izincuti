<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <?php if ($karyawan['foto']) : ?>
                    <img src="<?= base_url('assets/uploads/foto/' . $karyawan['foto']) ?>" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
                <?php else : ?>
                    <i class="bi bi-person-circle" style="font-size: 8rem; color: #ccc;"></i>
                <?php endif; ?>
                <h5><?= esc($karyawan['nama_karyawan']) ?></h5>
                <p class="text-muted mb-0"><?= esc($karyawan['nama_jabatan'] ?? '-') ?></p>
                <p class="text-muted"><?= esc($karyawan['nama_departemen'] ?? '-') ?></p>
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr><th width="180">NIK</th><td><?= esc($karyawan['nik']) ?></td></tr>
                    <tr><th>Nama</th><td><?= esc($karyawan['nama_karyawan']) ?></td></tr>
                    <tr><th>Departemen</th><td><?= esc($karyawan['nama_departemen'] ?? '-') ?></td></tr>
                    <tr><th>Jabatan</th><td><?= esc($karyawan['nama_jabatan'] ?? '-') ?></td></tr>
                    <tr><th>Email</th><td><?= esc($karyawan['email']) ?></td></tr>
                    <tr><th>No. HP</th><td><?= esc($karyawan['no_hp']) ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Form Ganti Password HRD -->
<div class="card card-stat">
    <div class="card-header bg-white">
        <strong><i class="bi bi-lock"></i> Ganti Password</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('hrd/profil/ganti-password') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Password Lama</label>
                    <input type="password" name="password_lama" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password_baru" class="form-control" required minlength="6">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="konfirmasi_password" class="form-control" required minlength="6">
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-warning"><i class="bi bi-lock"></i> Ganti Password</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>