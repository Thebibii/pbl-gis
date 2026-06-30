<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Shield\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Jika sudah login, redirect sesuai role
        if (auth()->loggedIn()) {
            return $this->redirectBasedOnRole();
        }

        return view('login');
    }

    public function loginAction()
    {
        // Validasi
        $rules = [
            'email' => 'required',      // Ubah dari 'login' ke 'email'
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Attempt login
        $authenticator = auth('session');
        $result = $authenticator->attempt([
            'email' => $this->request->getPost('email'),      // Ubah dari 'login' ke 'email'
            'password' => $this->request->getPost('password'),
        ]);

        if (!$result->isOK()) {
            return redirect()->back()
                ->with('error', $result->reason())
                ->withInput();
        }

        // Login berhasil, redirect berdasarkan role
        return $this->redirectBasedOnRole();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/login')->with('message', 'Anda telah logout.');
    }

    private function redirectBasedOnRole()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->to('/login');
        }

        // Cek role
        if ($user->inGroup('operator_sekolah')) {
            return redirect()->to('/operator/dashboard');
        } elseif ($user->inGroup('superadmin') || $user->inGroup('admin')) {
            return redirect()->to('/admin/dashboard');
        } else {
            // Default untuk role lain
            return redirect()->to('/');
        }
    }
}