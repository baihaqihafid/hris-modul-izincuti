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
                <form action="<?= base_url('karyawan/profil/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" value="<?= esc($karyawan['nik']) ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" value="<?= esc($karyawan['nama_karyawan']) ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat, Tanggal Lahir</label>
                            <input type="text" class="form-control" value="<?= esc($karyawan['tempat_lahir']) ?>, <?= date('d-m-Y', strtotime($karyawan['tanggal_lahir'])) ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" value="<?= esc($karyawan['jenis_kelamin']) ?>" disabled>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat <span class="text-danger">*dapat diubah</span></label>
                            <textarea name="alamat" class="form-control" rows="2" required><?= old('alamat', $karyawan['alamat']) ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. HP <span class="text-danger">*dapat diubah</span></label>
                            <input type="text" name="no_hp" class="form-control" value="<?= old('no_hp', $karyawan['no_hp']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*dapat diubah</span></label>
                            <input type="email" name="email" class="form-control" value="<?= old('email', $karyawan['email']) ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Ganti Foto Profil</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Form Ganti Password -->
<div class="card card-stat">
    <div class="card-header bg-white">
        <strong><i class="bi bi-lock"></i> Ganti Password</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('karyawan/profil/ganti-password') ?>" method="post">
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