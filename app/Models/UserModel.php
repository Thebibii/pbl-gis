<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    /**
     * Ambil data pengguna dengan filter search, group, dan paginasi.
     *
     * @return array{data: array, total: int, pager: \CodeIgniter\Pager\Pager}
     */

    protected $allowedFields  = [
        'username',
        'status',
        'status_message',
        'active',
        'last_active',
        'sekolah_id',
    ];

    public function getFiltered(string $search = '', string $group = '', int $perPage = 10): array
    {
        $db = \Config\Database::connect();

        $builder = $db->table('users u')
            ->select('u.id, u.username, u.active, ui.secret AS email, g.group, s.nama_sekolah, s.slug AS sekolah_slug')
            ->join('auth_identities ui', "ui.user_id = u.id AND ui.type = 'email_password'", 'left')
            ->join('auth_groups_users g', 'g.user_id = u.id', 'left')
            ->join('sekolah s', 's.id = u.sekolah_id', 'left');

        if ($search !== '') {
            $builder->groupStart()
                ->like('u.username', $search)
                ->orLike('ui.secret', $search)
                ->groupEnd();
        }

        if ($group !== '') {
            $builder->where('g.group', $group);
        }

        $total = $builder->countAllResults(false);

        $pager  = \Config\Services::pager();
        $offset = ($this->getCurrentPage($pager, $perPage) - 1) * $perPage;

        $data = $builder->limit($perPage, $offset)->get()->getResultArray();

        $pager->makeLinks(
            (int) ceil($offset / $perPage) + 1,
            $perPage,
            $total
        );

        return [
            'data'  => $data,
            'total' => $total,
            'pager' => $pager,
        ];
    }

    private function getCurrentPage(\CodeIgniter\Pager\Pager $pager, int $perPage): int
    {
        $page = (int) (\Config\Services::request()->getGet('page') ?? 1);
        return max(1, $page);
    }
}
