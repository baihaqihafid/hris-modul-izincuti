<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <form action="<?= base_url('admin/user/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="hrd" <?= old('role') == 'hrd' ? 'selected' : '' ?>>HRD</option>
                        <option value="karyawan" <?= old('role') == 'karyawan' ? 'selected' : '' ?>>Karyawan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hubungkan dengan Data Karyawan (opsional)</label>
                    <select name="karyawan_id" class="form-select">
                        <option value="">-- Tidak Ada (khusus Admin) --</option>
                        <?php foreach ($karyawan as $k) : ?>
                            <option value="<?= $k['id_karyawan'] ?>" <?= old('karyawan_id') == $k['id_karyawan'] ? 'selected' : '' ?>>
                                <?= esc($k['nik'] . ' - ' . $k['nama_karyawan']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">Wajib diisi untuk role HRD dan Karyawan.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>