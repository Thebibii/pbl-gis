<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Models\UserIdentityModel;

class AccountSettingController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Tampilkan halaman pengaturan akun
     */
    public function index()
    {
        $user = auth()->user();

        return view('pages/account_settings/index', [
            'user' => $user,
        ]);
    }

    /**
     * Proses update profil & password
     */
    public function update()
    {
        $user = auth()->user();

        $changePassword = (bool) $this->request->getPost('current_password')
            || (bool) $this->request->getPost('new_password')
            || (bool) $this->request->getPost('confirm_password');

        $rules = [
            'username' => "required|min_length[3]|max_length[30]|is_unique[users.username,id,{$user->id}]",
            'email'    => "required|valid_email|is_unique[auth_identities.secret,user_id,{$user->id}]",
        ];

        if ($changePassword) {
            $rules['current_password'] = 'required';
            $rules['new_password']     = 'required|min_length[8]';
            $rules['confirm_password'] = 'required|matches[new_password]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Verifikasi password sekarang sebelum lanjut apa pun
        if ($changePassword) {
            $validPassword = auth()->check([
                'email'    => $user->email,
                'password' => $this->request->getPost('current_password'),
            ]);

            if (! $validPassword->isOK()) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['current_password' => 'Password sekarang tidak sesuai.']);
            }
        }

        try {
            // Update username
            $user->username = $this->request->getPost('username');

            // Update email (auth_identities.secret)
            $newEmail = $this->request->getPost('email');
            if ($newEmail !== $user->email) {
                $user->email = $newEmail;
            }

            // Update password jika diisi
            if ($changePassword) {
                $user->password = $this->request->getPost('new_password');
            }

            $this->userModel->save($user);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->to(route_to('account.settings'))
            ->with('success', 'Pengaturan akun berhasil diperbarui.');
    }
}
