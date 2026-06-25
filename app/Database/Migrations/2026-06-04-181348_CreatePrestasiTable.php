<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrestasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'sekolah_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'nama_prestasi' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => false],
            'tingkat'       => ['type' => 'ENUM', 'constraint' => ['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional']],
            'jenis'         => ['type' => 'ENUM', 'constraint' => ['Akademik', 'Non-Akademik', 'Olahraga', 'Seni']],
            'tahun'         => ['type' => 'YEAR', 'null' => false],
            'keterangan'    => ['type' => 'TEXT', 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sekolah_id', 'sekolah', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prestasi');
    }
    public function down()
    {
        $this->forge->dropTable('prestasi');
    }
}
