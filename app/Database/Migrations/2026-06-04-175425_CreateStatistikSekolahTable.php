<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatistikSekolahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'sekolah_id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'tahun_ajaran'              => ['type' => 'VARCHAR', 'constraint' => 9, 'null' => false, 'comment' => 'Format: 2024/2025'],
            'jumlah_siswa_l'            => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
            'jumlah_siswa_p'            => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
            'jumlah_guru_tetap'         => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
            'jumlah_guru_honor'         => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
            'jumlah_tenaga_kependidikan' => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
            'jumlah_rombel'             => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
            'created_at'                => ['type' => 'DATETIME', 'null' => true],
            'updated_at'                => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['sekolah_id', 'tahun_ajaran']); // 1 data per tahun ajaran per sekolah
        $this->forge->addForeignKey('sekolah_id', 'sekolah', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('statistik_sekolah');
    }
    public function down()
    {
        $this->forge->dropTable('statistik_sekolah');
    }
}
