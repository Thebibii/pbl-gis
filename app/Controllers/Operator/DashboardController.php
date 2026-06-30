<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;

class DashboardController extends BaseController
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
            'title' => 'Dashboard Operator Sekolah',
            'user' => $user,
        ];

        return view('pages/operator/dashboard', $data);
    }
}
