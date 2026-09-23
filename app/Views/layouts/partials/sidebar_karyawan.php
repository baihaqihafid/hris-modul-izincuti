<?php $uri = service('uri')->getPath(); ?>
<a href="<?= base_url('karyawan/dashboard') ?>" class="<?= str_contains($uri, 'karyawan/dashboard') ? 'active' : '' ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>
<a href="<?= base_url('karyawan/profil') ?>" class="<?= str_contains($uri, 'karyawan/profil') ? 'active' : '' ?>">
    <i class="bi bi-person-badge"></i> Profil Saya
</a>
<a href="<?= base_url('karyawan/izin') ?>" class="<?= str_contains($uri, 'karyawan/izin') ? 'active' : '' ?>">
    <i class="bi bi-file-earmark-text"></i> Pengajuan Izin
</a>
<a href="<?= base_url('karyawan/cuti') ?>" class="<?= str_contains($uri, 'karyawan/cuti') ? 'active' : '' ?>">
    <i class="bi bi-calendar-week"></i> Pengajuan Cuti
</a>