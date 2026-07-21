<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyCoordinatePrecision extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('sekolah', [
            'latitude'  => ['type' => 'DECIMAL', 'constraint' => '11,9', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '12,9', 'null' => true],
        ]);

        $this->forge->modifyColumn('kecamatan', [
            'latitude'  => ['type' => 'DECIMAL', 'constraint' => '11,9', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '12,9', 'null' => true],
        ]);

        $this->forge->modifyColumn('nagari', [
            'latitude'  => ['type' => 'DECIMAL', 'constraint' => '11,9', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '12,9', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('sekolah', [
            'latitude'  => ['type' => 'DECIMAL', 'constraint' => '10,8', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '11,8', 'null' => true],
        ]);

        $this->forge->modifyColumn('kecamatan', [
            'latitude'  => ['type' => 'DECIMAL', 'constraint' => '10,8', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '11,8', 'null' => true],
        ]);

        $this->forge->modifyColumn('nagari', [
            'latitude'  => ['type' => 'DECIMAL', 'constraint' => '10,8', 'null' => true],
            'longitude' => ['type' => 'DECIMAL', 'constraint' => '11,8', 'null' => true],
        ]);
    }
}
