<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveDeletedAtFromSekolah extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('sekolah', 'deleted_at');
    }

    public function down()
    {
        $this->forge->addColumn('sekolah', [
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'updated_at',
            ],
        ]);
    }
}
