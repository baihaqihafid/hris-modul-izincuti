<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHakCutiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hak_cuti' => [
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
            'tahun' => [
                'type' => 'YEAR',
            ],
            'total_cuti' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 12,
            ],
            'sisa_cuti' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 12,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_hak_cuti', true);
        $this->forge->addForeignKey('karyawan_id', 'karyawan', 'id_karyawan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('hak_cuti');
    }

    public function down()
    {
        $this->forge->dropTable('hak_cuti');
    }
}