<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <form action="<?= base_url('hrd/hak-cuti') ?>" method="get" class="d-flex gap-2">
                <select name="tahun" class="form-select" onchange="this.form.submit()">
                    <?php for ($y = date('Y') - 1; $y <= date('Y') + 1; $y++) : ?>
                        <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </form>

            <form action="<?= base_url('hrd/hak-cuti/generate') ?>" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-arrow-repeat"></i> Generate Hak Cuti Tahun <?= date('Y') ?>
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="3%">#</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tahun</th>
                        <th>Total Cuti</th>
                        <th>Sisa Cuti</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($hak_cuti)) : ?>
                        <tr><td colspan="7" class="text-center text-muted">Belum ada data hak cuti untuk tahun <?= $tahun ?>. Klik "Generate Hak Cuti" untuk membuat otomatis.</td></tr>
                    <?php else : ?>
                        <?php foreach ($hak_cuti as $i => $h) : ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($h['nik']) ?></td>
                                <td><?= esc($h['nama_karyawan']) ?></td>
                                <td><?= $h['tahun'] ?></td>
                                <td><?= $h['total_cuti'] ?></td>
                                <td><strong><?= $h['sisa_cuti'] ?></strong></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $h['id_hak_cuti'] ?>">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit<?= $h['id_hak_cuti'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="<?= base_url('hrd/hak-cuti/update/' . $h['id_hak_cuti']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Hak Cuti - <?= esc($h['nama_karyawan']) ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Total Cuti (hari)</label>
                                                    <input type="number" name="total_cuti" class="form-control" value="<?= $h['total_cuti'] ?>" min="0" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Sisa Cuti (hari)</label>
                                                    <input type="number" name="sisa_cuti" class="form-control" value="<?= $h['sisa_cuti'] ?>" min="0" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>