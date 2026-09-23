<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="alert alert-info">
    <i class="bi bi-info-circle"></i> Sisa cuti Anda saat ini: <strong><?= $hak_cuti['sisa_cuti'] ?? 0 ?> hari</strong> dari total <?= $hak_cuti['total_cuti'] ?? 0 ?> hari.
</div>

<div class="card card-stat">
    <div class="card-body">
        <form action="<?= base_url('karyawan/cuti/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="<?= old('tanggal_mulai') ?>" required min="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="<?= old('tanggal_selesai') ?>" required min="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Alasan</label>
                    <textarea name="alasan" class="form-control" rows="3" required><?= old('alasan') ?></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Dokumen Pendukung (opsional, PDF/JPG/PNG, maks 2MB)</label>
                    <input type="file" name="dokumen" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Ajukan</button>
                <a href="<?= base_url('karyawan/cuti') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>