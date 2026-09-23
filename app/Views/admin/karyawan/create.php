<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <form action="<?= base_url('admin/karyawan/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-4">
                <label class="form-label">NIK <span class="text-muted small">(otomatis dari departemen)</span></label>
                <input type="text" name="nik" id="nikField" class="form-control" value="<?= old('nik') ?>" readonly required>
                <small class="text-muted">Pilih departemen terlebih dahulu</small>
            </div>

                <div class="col-md-8">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_karyawan" class="form-control" value="<?= old('nama_karyawan') ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?= old('tempat_lahir') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= old('tanggal_lahir') ?>" required>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required><?= old('alamat') ?></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= old('no_hp') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Departemen</label>
                    <select name="departemen_id" id="departemenSelect" class="form-select" required onchange="generateNik(this.value)">
                        <option value="">-- Pilih --</option>
                        <?php foreach ($departemen as $d) : ?>
                            <option value="<?= $d['id_departemen'] ?>" <?= old('departemen_id') == $d['id_departemen'] ? 'selected' : '' ?>>
                                <?= esc($d['nama_departemen']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jabatan</label>
                    <select name="jabatan_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($jabatan as $j) : ?>
                            <option value="<?= $j['id_jabatan'] ?>" <?= old('jabatan_id') == $j['id_jabatan'] ? 'selected' : '' ?>>
                                <?= esc($j['nama_jabatan']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status Karyawan</label>
                    <select name="status_karyawan" class="form-select" required>
                        <option value="Aktif" selected>Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Resign">Resign</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="<?= old('tanggal_masuk') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="<?= base_url('admin/karyawan') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
function generateNik(departemenId) {
    const nikField = document.getElementById('nikField');

    if (!departemenId) {
        nikField.value = '';
        return;
    }

    nikField.value = 'Memuat...';

    fetch('<?= base_url('admin/karyawan/generate-nik') ?>?departemen_id=' + departemenId)
        .then(response => response.json())
        .then(data => {
            nikField.value = data.nik;
        })
        .catch(error => {
            console.error('Gagal generate NIK:', error);
            nikField.value = '';
        });
}
</script>

<?= $this->endSection() ?>