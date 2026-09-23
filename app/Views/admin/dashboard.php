<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-stat bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total Karyawan</h6>
                    <h3 class="mb-0"><?= $total_karyawan ?></h3>
                </div>
                <i class="bi bi-people icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat bg-info text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Total User</h6>
                    <h3 class="mb-0"><?= $total_user ?></h3>
                </div>
                <i class="bi bi-person-gear icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat bg-warning text-dark">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Izin Menunggu</h6>
                    <h3 class="mb-0"><?= $izin_pending ?></h3>
                </div>
                <i class="bi bi-file-earmark-text icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat bg-success text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Cuti Menunggu</h6>
                    <h3 class="mb-0"><?= $cuti_pending ?></h3>
                </div>
                <i class="bi bi-calendar-week icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="card card-stat">
    <div class="card-body">
        <h5>Selamat datang, <?= esc(session()->get('username')) ?> 👋</h5>
        <p class="text-muted mb-0">
            Anda login sebagai <strong>Administrator</strong>. Gunakan menu di sebelah kiri untuk mengelola
            data master (departemen, jabatan), data karyawan, dan akun pengguna sistem.
        </p>
        <p class="text-muted mb-0 mt-2">
            Total pengajuan izin: <strong><?= $total_izin ?></strong> | Total pengajuan cuti: <strong><?= $total_cuti ?></strong>
        </p>
    </div>
</div>

<?= $this->endSection() ?>