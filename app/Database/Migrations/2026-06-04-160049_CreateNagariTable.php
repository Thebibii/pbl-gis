<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNagariTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kecamatan_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'nama_nagari' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
            ],
            'kode_nagari' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'latitude' => [
                'type' => 'DECIMAL',
                'constraint' => '10,8',
                'null' => true,
            ],
            'longitude' => [
                'type' => 'DECIMAL',
                'constraint' => '11,8',
                'null' => true,
            ],
            'geojson_file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('kecamatan_id', 'kecamatan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('nagari');
    }
    public function down()
    {
        $this->forge->dropTable('nagari');
    }
}
