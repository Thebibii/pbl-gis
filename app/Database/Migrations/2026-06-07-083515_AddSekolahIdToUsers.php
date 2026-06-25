<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSekolahIdToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'sekolah_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,  // NULL jika bukan operator_sekolah
                'after'      => 'username',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'sekolah_id');
    }
}
