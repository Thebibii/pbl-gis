<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;

class UserController extends BaseController
{
    protected $userModel;
    protected $sekolahModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->sekolahModel = new \App\Models\SekolahModel();
    }

    public function index()
    {
        $perPage = 10;
        $result  = $this->userModel->getFiltered('', '', $perPage);

        return view('pages/admin/user/index', [
            'initialData' => [
                'data'        => $result['data'],
                'total'       => $result['total'],
                'perPage'     => $perPage,
                'currentPage' => 1,
                'lastPage'    => $result['pager']->getLastPage(),
            ],
        ]);
    }

    public function delete($id)
    {

        $users = $this->userModel;
        $user  = $users->find($id);

        // 1. Pastikan user ada
        if (! $user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User tidak ditemukan.',
            ]);
        }

        // 2. Cegah user menghapus akun miliknya sendiri
        if ((string) $id === (string) auth()->id()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak bisa menghapus akun yang sedang login.',
            ]);
        }

        // 3. Cegah menghapus superadmin terakhir
        if (in_array('superadmin', $user->getGroups(), true)) {
            $superadminCount = $users->whereIn('id', function ($builder) {
                $builder->select('user_id')
                    ->from('auth_groups_users')
                    ->where('group', 'superadmin');
            })->countAllResults();

            if ($superadminCount <= 1) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Tidak bisa menghapus superadmin terakhir.',
                ]);
            }
        }

        // 4. Cegah delete operator_sekolah HANYA kalau sekolahnya masih AKTIF (belum soft-deleted)
        if (in_array('operator_sekolah', $user->getGroups(), true) && ! empty($user->sekolah_id)) {
            $otherOperatorCount = $users
                ->where('sekolah_id', $user->sekolah_id)
                ->where('id !=', $id)
                ->countAllResults();

            if ($otherOperatorCount === 0) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'User ini adalah satu-satunya operator untuk sekolah tersebut. Hapus sekolahnya terlebih dahulu.',
                ]);
            }
        }

        // 5. Eksekusi delete
        try {
            $users->delete($id);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'User berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            log_message('error', '[UserController::delete] ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus user, coba lagi.',
            ]);
        }
    }


    public function getData()
    {
        $search  = trim($this->request->getGet('search') ?? '');
        $group   = trim($this->request->getGet('group') ?? '');
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $_GET['page'] = $page;

        $result = $this->userModel->getFiltered($search, $group, $perPage);
        return $this->response
            ->setContentType('application/json')
            ->setJSON([
                'data'        => $result['data'],
                'total'       => $result['total'],
                'perPage'     => $perPage,
                'currentPage' => $page,
                'lastPage'    => $result['pager']->getLastPage(),
            ]);
    }

    public function create()
    {
        return view('pages/admin/user/create');
    }

    public function store()
    {
        $rules = [
            'username'     => 'required|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[auth_identities.secret]',
            'password'     => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]',
            'role'         => 'required|in_list[superadmin,operator_dinas]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userEntity = new User([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        // sekolah_id sengaja tidak diisi saat create (null by default)

        try {
            $this->userModel->save($userEntity);

            // Ambil user yang baru disimpan untuk dapatkan ID-nya
            $user = $this->userModel->findById($this->userModel->getInsertID());

            // Assign role/group sesuai pilihan
            $user->addGroup($this->request->getPost('role'));

            // Aktifkan akun langsung (skip email activation)
            // Jika ingin tetap pakai email activation, hapus baris ini
            $user->activate();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }

        return redirect()->to(route_to('admin.user'))
            ->with('success', 'Pengguna berhasil ditambahkan. Sekolah dapat ditautkan melalui menu Edit.');
    }

    public function edit($id)
    {
        $user = $this->userModel->findById($id);

        if (!$user) {
            return redirect()->to(route_to('admin.user'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $groups = $user->getGroups();
        $role   = $groups[0] ?? null;

        $email = $user->email; // accessor Shield: ambil dari auth_identities type email_password

        $sekolah     = null;
        $defaultEmail = null;

        if ($role === 'operator_sekolah' && $user->sekolah_id) {
            $sekolah = $this->sekolahModel->find($user->sekolah_id);

            if ($sekolah) {
                helper('text');
                // $slug         = url_title($sekolah['nama_sekolah'], '_', true);
                $defaultEmail = 'op_' . $sekolah['npsn'] . '@gissekolah.id';
            }
        }

        $mustUpdate = (bool) ($user->must_update_profile ?? 1);

        return view('pages/admin/user/edit', [
            'user'         => $user,
            'role'         => $role,
            'email'        => $email,
            'sekolah'      => $sekolah,
            'defaultEmail' => $defaultEmail,
            'mustUpdate'   => $mustUpdate,
        ]);
    }

    public function update($id)
    {
        $user = $this->userModel->findById($id);
        // dd($user, $id);
        if (! $user) {
            return redirect()->to(route_to('admin.user'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $currentRole = $user->getGroups()[0] ?? null;

        // Operator sekolah tidak boleh diedit lewat method ini sama sekali
        if ($currentRole === 'operator_sekolah') {
            return redirect()->to(route_to('admin.user'))
                ->with('error', 'Akun operator sekolah tidak dapat diedit langsung. Gunakan fitur reset akun.');
        }

        $rules = [
            'username'     => "required|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'email'        => "required|valid_email|is_unique[auth_identities.secret,user_id,{$id}]",
            'password'     => 'permit_empty|min_length[8]',
            'pass_confirm' => 'permit_empty|matches[password]',
            'role'         => 'required|in_list[superadmin,operator_dinas]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update username
        $user->username = $this->request->getPost('username');
        $this->userModel->save($user);

        // Update email (identity)
        $newEmail = $this->request->getPost('email');
        if ($newEmail !== $user->email) {
            $user->email = $newEmail;
            $this->userModel->save($user);

            // Alternatif aman jika method di atas tidak tersedia di versi Shield Anda:
            // gunakan $this->userModel->updateEmailIdentity($user, $newEmail);
        }

        // Update password jika diisi
        $newPassword = $this->request->getPost('password');
        if (! empty($newPassword)) {
            $user->password = $newPassword;
            $this->userModel->save($user);
        }

        // Update role jika berubah
        $newRole = $this->request->getPost('role');
        if ($newRole !== $currentRole) {
            if ($currentRole) {
                $user->removeGroup($currentRole);
            }
            $user->addGroup($newRole);
        }

        return redirect()->to(route_to('admin.user'))->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function resetToDefault($id)
    {
        $user = $this->userModel->findById($id);

        if (! $user) {
            return redirect()->to(route_to('admin.user'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $role = $user->getGroups()[0] ?? null;

        if ($role !== 'operator_sekolah' || ! $user->sekolah_id) {
            return redirect()->back()->with('error', 'Aksi ini hanya berlaku untuk akun operator sekolah yang terhubung ke sebuah sekolah.');
        }

        $sekolah = $this->sekolahModel->find($user->sekolah_id);

        if (! $sekolah) {
            return redirect()->back()->with('error', 'Data sekolah terkait tidak ditemukan.');
        }

        helper('text');
        $slug         = url_title($sekolah['npsn'], '_', true);
        $defaultEmail = 'op_' . $slug . '@gissekolah.id';
        $defaultPass  = $sekolah['npsn'];

        // Reset email
        $user->email = $defaultEmail;
        // Reset password
        $user->password = $defaultPass;
        $this->userModel->save($user);

        return redirect()->back()->with('success', 'Akun berhasil direset ke kredensial default.');
    }
}
