<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <table class="table table-borderless">
            <tr><th width="200">Periode Cuti</th><td><?= date('d-m-Y', strtotime($cuti['tanggal_mulai'])) ?> s/d <?= date('d-m-Y', strtotime($cuti['tanggal_selesai'])) ?></td></tr>
            <tr><th>Lama Cuti</th><td><?= $cuti['lama_cuti'] ?> hari</td></tr>
            <tr><th>Tanggal Pengajuan</th><td><?= date('d-m-Y', strtotime($cuti['tanggal_pengajuan'])) ?></td></tr>
            <tr><th>Alasan</th><td><?= esc($cuti['alasan']) ?></td></tr>
            <tr>
                <th>Dokumen</th>
                <td>
                    <?php if ($cuti['dokumen']) : ?>
                        <a href="<?= base_url('assets/uploads/dokumen/' . $cuti['dokumen']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-file-earmark"></i> Lihat
                        </a>
                    <?php else : ?>
                        <span class="text-muted">Tidak ada</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td><span class="badge badge-status-<?= $cuti['status'] ?>"><?= esc($cuti['status']) ?></span></td>
            </tr>
            <?php if ($cuti['status'] !== 'Menunggu') : ?>
                <tr><th>Catatan HRD</th><td><?= esc($cuti['catatan_hrd'] ?? '-') ?></td></tr>
            <?php endif; ?>
        </table>

        <a href="<?= base_url('karyawan/cuti') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>