<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <table class="table table-borderless">
            <tr><th width="200">Nama Karyawan</th><td><?= esc($izin['nama_karyawan']) ?> (<?= esc($izin['nik']) ?>)</td></tr>
            <tr><th>Departemen</th><td><?= esc($izin['nama_departemen'] ?? '-') ?></td></tr>
            <tr><th>Jabatan</th><td><?= esc($izin['nama_jabatan'] ?? '-') ?></td></tr>
            <tr><th>Jenis Izin</th><td><?= esc($izin['jenis_izin']) ?></td></tr>
            <tr><th>Tanggal Izin</th><td><?= date('d-m-Y', strtotime($izin['tanggal_izin'])) ?></td></tr>
            <tr><th>Tanggal Pengajuan</th><td><?= date('d-m-Y', strtotime($izin['tanggal_pengajuan'])) ?></td></tr>
            <tr><th>Alasan</th><td><?= esc($izin['alasan']) ?></td></tr>
            <tr>
                <th>Dokumen Pendukung</th>
                <td>
                    <?php if ($izin['dokumen']) : ?>
                        <a href="<?= base_url('assets/uploads/dokumen/' . $izin['dokumen']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-file-earmark"></i> Lihat Dokumen
                        </a>
                    <?php else : ?>
                        <span class="text-muted">Tidak ada</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td><span class="badge badge-status-<?= $izin['status'] ?>"><?= esc($izin['status']) ?></span></td>
            </tr>
            <?php if ($izin['status'] !== 'Menunggu') : ?>
                <tr><th>Catatan HRD</th><td><?= esc($izin['catatan_hrd'] ?? '-') ?></td></tr>
            <?php endif; ?>
        </table>

        <?php if ($izin['status'] === 'Menunggu') : ?>
            <hr>
            <form action="<?= base_url('hrd/izin/proses/' . $izin['id_izin']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Catatan (opsional)</label>
                    <textarea name="catatan_hrd" class="form-control" rows="2"></textarea>
                </div>
                <button type="submit" name="status" value="Disetujui" class="btn btn-success" onclick="return confirm('Setujui pengajuan izin ini?')">
                    <i class="bi bi-check-circle"></i> Setujui
                </button>
                <button type="submit" name="status" value="Ditolak" class="btn btn-danger" onclick="return confirm('Tolak pengajuan izin ini?')">
                    <i class="bi bi-x-circle"></i> Tolak
                </button>
            </form>
        <?php endif; ?>

        <a href="<?= base_url('hrd/izin') ?>" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>