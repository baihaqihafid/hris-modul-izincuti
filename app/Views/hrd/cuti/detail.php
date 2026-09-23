<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">
        <table class="table table-borderless">
            <tr><th width="200">Nama Karyawan</th><td><?= esc($cuti['nama_karyawan']) ?> (<?= esc($cuti['nik']) ?>)</td></tr>
            <tr><th>Departemen</th><td><?= esc($cuti['nama_departemen'] ?? '-') ?></td></tr>
            <tr><th>Jabatan</th><td><?= esc($cuti['nama_jabatan'] ?? '-') ?></td></tr>
            <tr><th>Periode Cuti</th><td><?= date('d-m-Y', strtotime($cuti['tanggal_mulai'])) ?> s/d <?= date('d-m-Y', strtotime($cuti['tanggal_selesai'])) ?></td></tr>
            <tr><th>Lama Cuti</th><td><?= $cuti['lama_cuti'] ?> hari</td></tr>
            <tr><th>Tanggal Pengajuan</th><td><?= date('d-m-Y', strtotime($cuti['tanggal_pengajuan'])) ?></td></tr>
            <tr><th>Alasan</th><td><?= esc($cuti['alasan']) ?></td></tr>
            <tr>
                <th>Dokumen Pendukung</th>
                <td>
                    <?php if ($cuti['dokumen']) : ?>
                        <a href="<?= base_url('assets/uploads/dokumen/' . $cuti['dokumen']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-file-earmark"></i> Lihat Dokumen
                        </a>
                    <?php else : ?>
                        <span class="text-muted">Tidak ada</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Sisa Cuti Karyawan Saat Ini</th>
                <td>
                    <?php if ($hak_cuti) : ?>
                        <?= $hak_cuti['sisa_cuti'] ?> dari <?= $hak_cuti['total_cuti'] ?> hari
                    <?php else : ?>
                        <span class="text-danger">Data hak cuti tidak ditemukan untuk tahun ini</span>
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

        <?php if ($cuti['status'] === 'Menunggu') : ?>
            <hr>
            <form action="<?= base_url('hrd/cuti/proses/' . $cuti['id_cuti']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Catatan (opsional)</label>
                    <textarea name="catatan_hrd" class="form-control" rows="2"></textarea>
                </div>
                <button type="submit" name="status" value="Disetujui" class="btn btn-success" onclick="return confirm('Setujui pengajuan cuti ini? Sisa cuti karyawan akan otomatis dikurangi.')">
                    <i class="bi bi-check-circle"></i> Setujui
                </button>
                <button type="submit" name="status" value="Ditolak" class="btn btn-danger" onclick="return confirm('Tolak pengajuan cuti ini?')">
                    <i class="bi bi-x-circle"></i> Tolak
                </button>
            </form>
        <?php endif; ?>

        <a href="<?= base_url('hrd/cuti') ?>" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>