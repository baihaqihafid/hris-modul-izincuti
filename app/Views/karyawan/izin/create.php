<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <form action="<?= base_url('karyawan/izin/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Izin</label>
                    <input type="date" name="tanggal_izin" class="form-control" value="<?= old('tanggal_izin') ?>" required min="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Izin</label>
                    <select name="jenis_izin" class="form-select" required>
                        <option value="">-- Pilih Jenis Izin --</option>
                        <option value="Sakit" <?= old('jenis_izin') == 'Sakit' ? 'selected' : '' ?>>Sakit</option>
                        <option value="Keperluan Pribadi" <?= old('jenis_izin') == 'Keperluan Pribadi' ? 'selected' : '' ?>>Keperluan Pribadi</option>
                        <option value="Keluarga" <?= old('jenis_izin') == 'Keluarga' ? 'selected' : '' ?>>Keluarga</option>
                        <option value="Lainnya" <?= old('jenis_izin') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Alasan</label>
                    <textarea name="alasan" class="form-control" rows="3" required><?= old('alasan') ?></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Dokumen Pendukung (opsional, PDF/JPG/PNG, maks 2MB)</label>
                    <input type="file" name="dokumen" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                    <small class="text-muted">Contoh: surat keterangan dokter untuk izin sakit.</small>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Ajukan</button>
                <a href="<?= base_url('karyawan/izin') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>