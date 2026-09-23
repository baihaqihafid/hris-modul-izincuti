<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <form action="<?= base_url('admin/karyawan/update/' . $karyawan['id_karyawan']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <?php if ($karyawan['foto']) : ?>
                <div class="mb-3">
                    <img src="<?= base_url('assets/uploads/foto/' . $karyawan['foto']) ?>" width="80" height="80" class="rounded-circle" style="object-fit: cover;">
                </div>
            <?php endif; ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control" value="<?= old('nik', $karyawan['nik']) ?>" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_karyawan" class="form-control" value="<?= old('nama_karyawan', $karyawan['nama_karyawan']) ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="Laki-laki" <?= $karyawan['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= $karyawan['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?= old('tempat_lahir', $karyawan['tempat_lahir']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= old('tanggal_lahir', $karyawan['tanggal_lahir']) ?>" required>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required><?= old('alamat', $karyawan['alamat']) ?></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= old('no_hp', $karyawan['no_hp']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email', $karyawan['email']) ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Departemen</label>
                    <select name="departemen_id" class="form-select" required>
                        <?php foreach ($departemen as $d) : ?>
                            <option value="<?= $d['id_departemen'] ?>" <?= $karyawan['departemen_id'] == $d['id_departemen'] ? 'selected' : '' ?>>
                                <?= esc($d['nama_departemen']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jabatan</label>
                    <select name="jabatan_id" class="form-select" required>
                        <?php foreach ($jabatan as $j) : ?>
                            <option value="<?= $j['id_jabatan'] ?>" <?= $karyawan['jabatan_id'] == $j['id_jabatan'] ? 'selected' : '' ?>>
                                <?= esc($j['nama_jabatan']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status Karyawan</label>
                    <select name="status_karyawan" class="form-select" required>
                        <option value="Aktif" <?= $karyawan['status_karyawan'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="Tidak Aktif" <?= $karyawan['status_karyawan'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                        <option value="Resign" <?= $karyawan['status_karyawan'] == 'Resign' ? 'selected' : '' ?>>Resign</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="<?= old('tanggal_masuk', $karyawan['tanggal_masuk']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ganti Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="<?= base_url('admin/karyawan') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>