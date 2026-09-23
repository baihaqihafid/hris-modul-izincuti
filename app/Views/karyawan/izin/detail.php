<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <table class="table table-borderless">
            <tr><th width="200">Jenis Izin</th><td><?= esc($izin['jenis_izin']) ?></td></tr>
            <tr><th>Tanggal Izin</th><td><?= date('d-m-Y', strtotime($izin['tanggal_izin'])) ?></td></tr>
            <tr><th>Tanggal Pengajuan</th><td><?= date('d-m-Y', strtotime($izin['tanggal_pengajuan'])) ?></td></tr>
            <tr><th>Alasan</th><td><?= esc($izin['alasan']) ?></td></tr>
            <tr>
                <th>Dokumen</th>
                <td>
                    <?php if ($izin['dokumen']) : ?>
                        <a href="<?= base_url('assets/uploads/dokumen/' . $izin['dokumen']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-file-earmark"></i> Lihat
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

        <a href="<?= base_url('karyawan/izin') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>