<table border="1">
    <tr>
        <th>#</th>
        <th>NIK</th>
        <th>Nama Karyawan</th>
        <th>Departemen</th>
        <th>Jabatan</th>
        <th>Jenis Izin</th>
        <th>Tanggal Izin</th>
        <th>Alasan</th>
        <th>Status</th>
    </tr>
    <?php foreach ($izin as $i => $row) : ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= esc($row['nik']) ?></td>
            <td><?= esc($row['nama_karyawan']) ?></td>
            <td><?= esc($row['nama_departemen'] ?? '-') ?></td>
            <td><?= esc($row['nama_jabatan'] ?? '-') ?></td>
            <td><?= esc($row['jenis_izin']) ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal_izin'])) ?></td>
            <td><?= esc($row['alasan']) ?></td>
            <td><?= esc($row['status']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>