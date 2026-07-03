<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Sekolah\PrestasiModel;
use App\Models\SekolahModel;
use App\Models\UserModel;

class PrestasiController extends BaseController
{
    protected PrestasiModel $prestasiModel;
    protected SekolahModel $sekolahModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->prestasiModel = new PrestasiModel();
        $this->sekolahModel  = new SekolahModel();
        $this->userModel     = new UserModel();
    }

    // public function index()
    // {
    //     if (! auth()->loggedIn()) {
    //         return redirect()->to('/login');
    //     }

    //     $user = auth()->user();

    //     if (! $user->inGroup('operator_sekolah')) {
    //         return redirect()->to('/operator/dashboard')
    //             ->with('error', 'Akses ditolak!');
    //     }

    //     // Ambil sekolah_id milik operator
    //     $userRow = $this->userModel
    //         ->select('sekolah_id')
    //         ->find($user->id);

    //     $sekolahId = $userRow->sekolah_id ?? null;

    //     if (! $sekolahId) {
    //         return redirect()->to('/operator/dashboard')
    //             ->with('error', 'Akun Anda belum terhubung dengan sekolah.');
    //     }

    //     // Ambil data sekolah
    //     $sekolah = $this->sekolahModel->find($sekolahId);

    //     // Ambil seluruh prestasi milik sekolah
    //     $prestasi = $this->prestasiModel
    //         ->where('sekolah_id', $sekolahId)
    //         ->orderBy('tahun', 'DESC')
    //         ->findAll();
    //     // dd($prestasi);
    //     $data = [
    //         'title'     => 'Data Prestasi',
    //         'user'      => $user,
    //         'sekolah'   => $sekolah,
    //         'prestasi'  => $prestasi,
    //     ];

    //     return view('pages/operator/prestasi/index', $data);
    // }

    public function index()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user();

        if (!$user->inGroup('operator_sekolah')) {
            return redirect()->to('/');
        }

        if (empty($user->sekolah_id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $perPage = 10;

        $result = $this->prestasiModel->getFiltered(
            $user->sekolah_id,
            '',
            $perPage
        );

        return view('pages/operator/prestasi/index', [
            'initialData' => [
                'data'        => $result['data'],
                'total'       => $result['total'],
                'perPage'     => $perPage,
                'currentPage' => 1,
                'lastPage'    => $result['pager']
                    ? $result['pager']->getLastPage()
                    : 1,
            ],
        ]);
    }

    public function getData()
    {
        if (!auth()->loggedIn()) {
            return $this->response->setStatusCode(401);
        }

        $user = auth()->user();

        if (empty($user->sekolah_id)) {
            return $this->response->setStatusCode(404);
        }

        $search  = trim($this->request->getGet('search') ?? '');
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $_GET['page'] = $page;

        $result = $this->prestasiModel->getFiltered(
            $user->sekolah_id,
            $search,
            $perPage
        );

        return $this->response->setJSON([
            'data'        => $result['data'],
            'total'       => $result['total'],
            'perPage'     => $perPage,
            'currentPage' => $page,
            'lastPage'    => $result['pager']
                ? $result['pager']->getLastPage()
                : 1,
        ]);
    }
}
