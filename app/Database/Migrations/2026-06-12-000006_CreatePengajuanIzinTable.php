<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajuanIzinTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_izin' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'karyawan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_pengajuan' => [
                'type' => 'DATE',
            ],
            'tanggal_izin' => [
                'type' => 'DATE',
            ],
            'jenis_izin' => [
                'type'       => 'ENUM',
                'constraint' => ['Sakit', 'Keperluan Pribadi', 'Keluarga', 'Lainnya'],
            ],
            'alasan' => [
                'type' => 'TEXT',
            ],
            'dokumen' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Menunggu', 'Disetujui', 'Ditolak'],
                'default'    => 'Menunggu',
            ],
            'catatan_hrd' => [
                'type'    => 'TEXT',
                'null'    => true,
                'default' => null,
            ],
            'approved_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'default'    => null,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_izin', true);
        $this->forge->addForeignKey('karyawan_id', 'karyawan', 'id_karyawan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengajuan_izin');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan_izin');
    }
}