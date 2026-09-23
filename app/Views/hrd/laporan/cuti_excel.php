<table border="1">
    <tr>
        <th>#</th>
        <th>NIK</th>
        <th>Nama Karyawan</th>
        <th>Departemen</th>
        <th>Jabatan</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Lama</th>
        <th>Alasan</th>
        <th>Status</th>
    </tr>
    <?php foreach ($cuti as $i => $row) : ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= esc($row['nik']) ?></td>
            <td><?= esc($row['nama_karyawan']) ?></td>
            <td><?= esc($row['nama_departemen'] ?? '-') ?></td>
            <td><?= esc($row['nama_jabatan'] ?? '-') ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal_mulai'])) ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal_selesai'])) ?></td>
            <td><?= $row['lama_cuti'] ?> hari</td>
            <td><?= esc($row['alasan']) ?></td>
            <td><?= esc($row['status']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>