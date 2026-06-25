<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJenisFasilitasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_fasilitas' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'ikon'           => ['type' => 'TEXT', 'null' => true, 'comment' => 'Tabler icon name'],
            // 'kategori'       => ['type' => 'ENUM', 'constraint' => ["'Akademik'", "'Olahraga'", "'Ibadah'", "'Kesehatan'", "'Umum'"], 'default' => 'Umum'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis_fasilitas');
    }
    public function down()
    {
        $this->forge->dropTable('jenis_fasilitas');
    }
}
