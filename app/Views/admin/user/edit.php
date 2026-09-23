<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <form action="<?= base_url('admin/user/update/' . $user['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= old('username', $user['username']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="hrd" <?= $user['role'] == 'hrd' ? 'selected' : '' ?>>HRD</option>
                        <option value="karyawan" <?= $user['role'] == 'karyawan' ? 'selected' : '' ?>>Karyawan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hubungkan dengan Data Karyawan</label>
                    <select name="karyawan_id" class="form-select">
                        <option value="">-- Tidak Ada (khusus Admin) --</option>
                        <?php foreach ($karyawan as $k) : ?>
                            <option value="<?= $k['id_karyawan'] ?>" <?= $user['karyawan_id'] == $k['id_karyawan'] ? 'selected' : '' ?>>
                                <?= esc($k['nik'] . ' - ' . $k['nama_karyawan']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1" <?= $user['is_active'] == 1 ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?= $user['is_active'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>