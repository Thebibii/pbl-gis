<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JenisFasilitasController extends BaseController
{
    protected $jenisFasilitasModel;

    public function __construct()
    {
        $this->jenisFasilitasModel = new \App\Models\Sekolah\JenisFasilitasModel();
    }

    public function index()
    {
        $perPage = 10;
        $result  = $this->jenisFasilitasModel->getFiltered('',  $perPage);
        return view('pages/admin/jenis_fasilitas/index', [
            'initialData' => [
                'data'        => $result['data'],
                'total'       => $result['total'],
                'perPage'     => $perPage,
                'currentPage' => 1,
                'lastPage'    => $result['pager'] ? $result['pager']->getLastPage() : 1,
            ],
        ]);
    }

    public function getData()
    {
        $search  = trim($this->request->getGet('search') ?? '');
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $_GET['page'] = $page; // Set for pagination

        $result = $this->jenisFasilitasModel->getFiltered($search, $perPage);
        return $this->response
            ->setContentType('application/json')
            ->setJSON([
                'data'        => $result['data'],
                'total'       => $result['total'],
                'perPage'     => $perPage,
                'currentPage' => $page,
                'lastPage'    => $result['pager'] ? $result['pager']->getLastPage() : 1,
            ]);
    }

    public function store()
    {
        $rules = [
            'nama_fasilitas' => 'required|min_length[2]|max_length[255]',
            'ikon'           => 'required|min_length[2]|max_length[2000]',
        ];

        $errors = [
            'nama_fasilitas' => [
                'required'   => 'Nama fasilitas wajib diisi.',
                'min_length' => 'Nama fasilitas minimal 2 karakter.',
                'max_length' => 'Nama fasilitas maksimal 255 karakter.',
            ],
            'ikon' => [
                'required'   => 'Ikon wajib diisi.',
                'min_length' => 'Ikon minimal 2 karakter.',
                'max_length' => 'Ikon maksimal terlalu panjang.',
            ],
        ];

        if (!$this->validate($rules, $errors)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $this->validator->getErrors(),
                'csrf_token' => csrf_hash()
            ]);
        }

        $data = [
            'nama_fasilitas' => $this->request->getPost('nama_fasilitas'),
            'ikon'           => strtolower(trim($this->request->getPost('ikon'))),
        ];

        $this->jenisFasilitasModel->insert($data);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Jenis Fasilitas berhasil ditambahkan.',
            'csrf_token' => csrf_hash()
        ]);
    }

    public function update(int $id)
    {
        $rules = [
            'nama_fasilitas' => 'required|min_length[2]|max_length[255]',
            'ikon'           => 'required|min_length[2]|max_length[2000]',
        ];

        $errors = [
            'nama_fasilitas' => [
                'required'   => 'Nama fasilitas wajib diisi.',
                'min_length' => 'Nama fasilitas minimal 2 karakter.',
                'max_length' => 'Nama fasilitas maksimal 255 karakter.',
            ],
            'ikon' => [
                'required'   => 'Ikon wajib diisi.',
                'min_length' => 'Ikon minimal 2 karakter.',
                'max_length' => 'Ikon maksimal terlalu panjang.',
            ],
        ];

        if (!$this->validate($rules, $errors)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $this->validator->getErrors(),
                'csrf_token' => csrf_hash()
            ]);
        }

        $data = [
            'nama_fasilitas' => $this->request->getPost('nama_fasilitas'),
            'ikon' => strtolower(trim($this->request->getPost('ikon'))),
        ];

        $this->jenisFasilitasModel->update($id, $data);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Jenis Fasilitas berhasil diperbarui.',
            'csrf_token' => csrf_hash()
        ]);
    }

    public function delete(int $id)
    {
        $fasilitas = $this->jenisFasilitasModel->find($id);

        if (!$fasilitas) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan.',
                'csrf_token' => csrf_hash()
            ]);
        }

        $this->jenisFasilitasModel->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Data berhasil dihapus.',
            'csrf_token' => csrf_hash()
        ]);
    }
}
