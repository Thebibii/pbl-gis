<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSekolahFasilitasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'sekolah_id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'jenis_fasilitas_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'kondisi'             => ['type' => 'ENUM', 'constraint' => ['Baik', 'Rusak Ringan', 'Rusak Berat'], 'default' => 'Baik'],
            'jumlah'              => ['type' => 'INT', 'constraint' => 5, 'default' => 1],
            'keterangan'          => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['sekolah_id', 'jenis_fasilitas_id']); // 1 sekolah, 1 jenis fasilitas
        $this->forge->addForeignKey('sekolah_id', 'sekolah', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jenis_fasilitas_id', 'jenis_fasilitas', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->createTable('sekolah_fasilitas');
    }
    public function down()
    {
        $this->forge->dropTable('sekolah_fasilitas');
    }
}
