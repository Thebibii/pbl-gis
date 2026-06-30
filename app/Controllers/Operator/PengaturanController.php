<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;

class PengaturanController extends BaseController
{
    public function index()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user();
        
        if (!$user->inGroup('operator_sekolah')) {
            return redirect()->to('/operator/dashboard')->with('error', 'Akses ditolak!');
        }

        $data = [
            'title' => 'Pengaturan Akun',
            'user' => $user,
        ];

        return view('pages/operator/pengaturan/index', $data);
    }
}
