<?php $uri = service('uri')->getPath(); ?>
<a href="<?= base_url('admin/dashboard') ?>" class="<?= str_contains($uri, 'admin/dashboard') ? 'active' : '' ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>
<a href="<?= base_url('admin/karyawan') ?>" class="<?= str_contains($uri, 'admin/karyawan') ? 'active' : '' ?>">
    <i class="bi bi-people"></i> Data Karyawan
</a>
<a href="<?= base_url('admin/departemen') ?>" class="<?= str_contains($uri, 'admin/departemen') ? 'active' : '' ?>">
    <i class="bi bi-diagram-3"></i> Departemen
</a>
<a href="<?= base_url('admin/jabatan') ?>" class="<?= str_contains($uri, 'admin/jabatan') ? 'active' : '' ?>">
    <i class="bi bi-briefcase"></i> Jabatan
</a>
<a href="<?= base_url('admin/user') ?>" class="<?= str_contains($uri, 'admin/user') ? 'active' : '' ?>">
    <i class="bi bi-person-gear"></i> Kelola User
</a>