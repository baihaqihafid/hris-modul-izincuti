<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-stat">
    <div class="card-body">

        <a href="<?= base_url('admin/user/create') ?>" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Username</th>
                        <th>Nama Karyawan</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $i => $u) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($u['username']) ?></td>
                            <td><?= esc($u['nama_karyawan'] ?? '-') ?></td>
                            <td>
                                <?php
                                    $roleBadge = match($u['role']) {
                                        'admin' => 'danger',
                                        'hrd' => 'primary',
                                        'karyawan' => 'success',
                                        default => 'secondary',
                                    };
                                ?>
                                <span class="badge bg-<?= $roleBadge ?>"><?= esc(ucfirst($u['role'])) ?></span>
                            </td>
                            <td>
                                <?php if ($u['is_active']) : ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/user/edit/' . $u['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <?php if (!($u['role'] === 'admin' && $u['id'] == session()->get('user_id'))) : ?>
                                    <a href="<?= base_url('admin/user/delete/' . $u['id']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>