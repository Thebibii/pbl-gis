<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;


class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();

        $user = new User([
            'username' => 'superadmin',
            'email'    => 'admin@gissekolah.id',
            'password' => 'G1sAdm!n2025',  // Ganti setelah login!
        ]);
        $users->save($user);

        $user = $users->findById($users->getInsertID());
        $user->activate();             // bypass verifikasi email
        $user->addGroup('superadmin'); // assign role
    }
}
