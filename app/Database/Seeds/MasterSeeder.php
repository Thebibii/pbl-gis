<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run()
    {
        // Panggil seeder-seeder lainnya di sini

        $this->call('SuperAdminSeeder');
        $this->call('KecamatanSeeder');
        $this->call('KelurahanSeeder');
        $this->call('SekolahSeeder');
    }
}
