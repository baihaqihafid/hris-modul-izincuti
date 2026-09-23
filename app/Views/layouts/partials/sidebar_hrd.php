<?php $uri = service('uri')->getPath(); ?>
<a href="<?= base_url('hrd/dashboard') ?>" class="<?= str_contains($uri, 'hrd/dashboard') ? 'active' : '' ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>
<a href="<?= base_url('hrd/profil') ?>" class="<?= str_contains($uri, 'hrd/profil') ? 'active' : '' ?>">
    <i class="bi bi-person-badge"></i> Profil Saya
</a>
<a href="<?= base_url('hrd/karyawan') ?>" class="<?= str_contains($uri, 'hrd/karyawan') ? 'active' : '' ?>">
    <i class="bi bi-people"></i> Data Karyawan
</a>
<a href="<?= base_url('hrd/hak-cuti') ?>" class="<?= str_contains($uri, 'hrd/hak-cuti') ? 'active' : '' ?>">
    <i class="bi bi-calendar2-check"></i> Hak Cuti Karyawan
</a>
<a href="<?= base_url('hrd/izin') ?>" class="<?= str_contains($uri, 'hrd/izin') ? 'active' : '' ?>">
    <i class="bi bi-file-earmark-text"></i> Pengajuan Izin
</a>
<a href="<?= base_url('hrd/cuti') ?>" class="<?= str_contains($uri, 'hrd/cuti') ? 'active' : '' ?>">
    <i class="bi bi-calendar-week"></i> Pengajuan Cuti
</a>
<a href="<?= base_url('hrd/laporan/izin') ?>" class="<?= str_contains($uri, 'hrd/laporan/izin') ? 'active' : '' ?>">
    <i class="bi bi-file-pdf"></i> Laporan Izin
</a>
<a href="<?= base_url('hrd/laporan/cuti') ?>" class="<?= str_contains($uri, 'hrd/laporan/cuti') ? 'active' : '' ?>">
    <i class="bi bi-file-pdf"></i> Laporan Cuti
</a>
