<?php /* main.php - SIM Izin Cuti Style HRIS */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'SIM Izin Cuti' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
    body {
        margin: 0;
        background-color: #f4f6f9;
        font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100%;
        background-color: #2c3e50;
        transition: 0.3s;
        z-index: 999;
    }

    .sidebar.hide {
        left: -250px;
    }

    .sidebar .brand {
        color: #fff;
        font-weight: bold;
        padding: 1rem;
        display: block;
        text-decoration: none;
        text-align: center;
        border-bottom: 1px solid rgba(255,255,255,.15);
        margin-bottom: 1rem;
    }

    .sidebar .brand i {
        font-size: 2rem;
    }

    .sidebar .nav-link,
    .sidebar a {
        color: #bdc3c7 !important;
        text-decoration: none;
        display: block !important;
        padding: .8rem 1.2rem;
        transition: 0.2s;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active,
    .sidebar a:hover,
    .sidebar a.active {
        color: #fff !important;
        background-color: #34495e !important;
    }

    .sidebar .nav-link i,
    .sidebar a i {
        margin-right: 10px;
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
        transition: 0.3s;
    }

    .main-content.full {
        margin-left: 0;
    }

    .hris-bell-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 8px;
        color: #6c757d;
        transition: 0.2s;
    }

    .hris-bell-btn:hover {
        background-color: #f8f9fa;
        color: #333;
    }

    .hris-dropdown-notif {
        background-color: rgba(255, 255, 255, 0.92) !important;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08) !important;
        border-radius: 10px !important;
        margin-top: 12px !important;
        min-width: 240px !important;
        max-width: 280px !important;
    }

    .hris-dropdown-notif .dropdown-header {
        background-color: transparent !important;
        font-weight: 600;
        color: #2c3e50;
        padding: 0.6rem 1rem 0.4rem 1rem;
    }

    .hris-dropdown-notif .dropdown-item {
        white-space: normal !important;
        font-size: 13px;
        background-color: transparent !important;
    }

    .badge-status-Menunggu { background: #ffc107; color: #000; }
    .badge-status-Disetujui { background: #198754; color: #fff; }
    .badge-status-Ditolak { background: #dc3545; color: #fff; }
    </style>
</head>

<body>

<div id="sidebar" class="sidebar">
    <div class="brand">
        <i class="bi bi-calendar2-check"></i>
        <h6 class="mt-2 mb-0">SIM Izin & Cuti</h6>
    </div>

    <?php
        $role = session()->get('role');
        if ($role === 'admin') {
            echo view('layouts/partials/sidebar_admin');
        } elseif ($role === 'hrd') {
            echo view('layouts/partials/sidebar_hrd');
        } elseif ($role === 'karyawan') {
            echo view('layouts/partials/sidebar_karyawan');
        }
    ?>
</div>

<div id="content" class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">

        <button class="btn btn-outline-secondary me-2" id="toggleSidebar">☰</button>

        <h5 class="mb-0"><?= $title ?? '' ?></h5>

        <div class="d-flex align-items-center gap-2 ms-auto">

            <?php
                $currentRole     = session()->get('role');
                $namaKaryawan    = session()->get('nama_karyawan');
                $displayName     = $namaKaryawan ?? session()->get('username') ?? 'User';

                // Notif HANYA untuk HRD dan Admin
                $tampilNotif = in_array($currentRole, ['hrd', 'admin']);
            ?>

            <?php if ($tampilNotif) : ?>
                <?php
                    $izinModel = model('PengajuanIzinModel');
                    $cutiModel = model('PengajuanCutiModel');

                    // Ambil data pengajuan menunggu beserta nama karyawan
                    $dataIzin = $izinModel->getAllWithKaryawan('Menunggu');
                    $dataCuti = $cutiModel->getAllWithKaryawan('Menunggu');

                    $totalNotif = count($dataIzin) + count($dataCuti);
                ?>

                <div class="dropdown">
                    <a href="#" class="position-relative text-decoration-none hris-bell-btn"
                       data-bs-toggle="dropdown" data-bs-display="static">
                        <i class="bi bi-bell fs-5"></i>
                        <?php if ($totalNotif > 0) : ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                  style="margin-top:3px; margin-left:-3px; font-size:0.65rem;">
                                <?= $totalNotif ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end hris-dropdown-notif">
                        <li><h6 class="dropdown-header">Notifikasi Menunggu</h6></li>
                        <li><hr class="dropdown-divider opacity-50 my-1"></li>

                        <?php if (empty($dataIzin) && empty($dataCuti)) : ?>
                            <li>
                                <span class="dropdown-item-text text-muted small px-3">
                                    Tidak ada notifikasi baru
                                </span>
                            </li>
                        <?php else : ?>

                            <?php foreach ($dataIzin as $iz) : ?>
                                <li>
                                    <a class="dropdown-item py-2"
                                       href="<?= base_url($currentRole . '/izin/detail/' . $iz['id_izin']) ?>">
                                        <div class="small">
                                            Ada pengajuan <strong>izin</strong> baru dari
                                            <strong><?= esc($iz['nama_karyawan']) ?></strong>
                                            dengan alasan
                                            <em><?= esc(mb_strimwidth($iz['alasan'], 0, 40, '...')) ?></em>
                                            menunggu persetujuan.
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>

                            <?php foreach ($dataCuti as $ct) : ?>
                                <li>
                                    <a class="dropdown-item py-2"
                                       href="<?= base_url($currentRole . '/cuti/detail/' . $ct['id_cuti']) ?>">
                                        <div class="small">
                                            Ada pengajuan <strong>cuti</strong> baru dari
                                            <strong><?= esc($ct['nama_karyawan']) ?></strong>
                                            selama <strong><?= $ct['lama_cuti'] ?> hari</strong>
                                            menunggu persetujuan.
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Dropdown Profil -->
            <div class="dropdown">
                <a href="#" class="text-decoration-none text-secondary d-flex align-items-center px-2 py-1"
                   data-bs-toggle="dropdown" data-bs-display="static">
                    <i class="bi bi-person-circle fs-5 me-1"></i>
                    <span class="d-inline small text-dark">
                        <?= esc($displayName) ?>
                        (<?= esc(ucfirst($currentRole)) ?>)
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end hris-dropdown-notif">
                    <li>
                        <span class="dropdown-item-text text-muted small">
                            Status: <strong>Online</strong>
                        </span>
                    </li>
                    <li><hr class="dropdown-divider opacity-50 my-1"></li>
                    <li>
                        <a class="dropdown-item text-danger py-2" href="<?= base_url('logout') ?>"
                           onclick="localStorage.removeItem('sidebar')">
                            <i class="bi bi-box-arrow-left me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const btn     = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");

    let sidebarState = localStorage.getItem("sidebar");

    if (sidebarState === "hide") {
        sidebar.classList.add("hide");
        content.classList.add("full");
    } else if (sidebarState === "show") {
        sidebar.classList.remove("hide");
        content.classList.remove("full");
    } else {
        if (window.innerWidth <= 768) {
            sidebar.classList.add("hide");
            content.classList.add("full");
        }
    }

    btn.addEventListener("click", function () {
        sidebar.classList.toggle("hide");
        content.classList.toggle("full");
        localStorage.setItem("sidebar", sidebar.classList.contains("hide") ? "hide" : "show");
    });
});

document.querySelectorAll("#sidebar a").forEach(link => {
    link.addEventListener("click", function () {
        if (window.innerWidth <= 768) {
            localStorage.setItem("sidebar", "hide");
        }
    });
});
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>