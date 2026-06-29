<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSekolahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'npsn'              => ['type' => 'VARCHAR', 'constraint' => 8, 'null' => true],
            'nama_sekolah'      => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
            ],
            'jenjang'           => ['type' => 'ENUM', 'constraint' => ['TK', 'SD', 'SMP'], 'null' => true],
            'status'            => ['type' => 'ENUM', 'constraint' => ['Negeri', 'Swasta'], 'null' => true],
            'akreditasi'        => ['type' => 'ENUM', 'constraint' => ['A', 'B', 'C', 'Belum Terakreditasi'], 'default' => 'Belum Terakreditasi'],
            'kecamatan_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nagari_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'alamat'            => ['type' => 'TEXT', 'null' => true],
            'latitude'          => ['type' => 'DECIMAL', 'constraint' => '10,8', 'null' => true],
            'longitude'         => ['type' => 'DECIMAL', 'constraint' => '11,8', 'null' => true],
            'nama_kepsek'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'telepon'           => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email'             => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'website'           => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'foto_utama'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'kurikulum'         => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'tahun_berdiri'     => ['type' => 'YEAR', 'null' => true],
            'luas_lahan'        => ['type' => 'INT', 'constraint' => 11, 'null' => true, 'comment' => 'dalam m2'],
            'is_active'         => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('npsn');
        $this->forge->addUniqueKey('slug');
        $this->forge->addKey(['kecamatan_id', 'jenjang', 'akreditasi']); // composite index for map filter
        $this->forge->addForeignKey('kecamatan_id', 'kecamatan', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->addForeignKey('nagari_id', 'nagari', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('sekolah');
    }
    public function down()
    {
        $this->forge->dropTable('sekolah');
    }
}
