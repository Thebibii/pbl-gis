<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKecamatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nama_kecamatan'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'slug'            => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null'       => false
            ],
            'kode_kecamatan'  => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true
            ],
            'latitude'        => [
                'type'       => 'DECIMAL',
                'constraint' => '10,8',
                'null'       => true
            ],
            'longitude'       => [
                'type'       => 'DECIMAL',
                'constraint' => '11,8',
                'null'       => true
            ],
            'geojson_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'warna' => [
                'type'       => 'VARCHAR',
                'constraint' => 7, // Cukup untuk menyimpan kode HEX seperti #FFFFFF
                'null'       => true,
                'default'    => '#3388ff' // Opsional: warna default jika tidak diisi
            ],
            'created_at'      => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at'      => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addUniqueKey('kode_kecamatan');
        $this->forge->createTable('kecamatan');
    }

    public function down()
    {
        $this->forge->dropTable('kecamatan');
    }
}
