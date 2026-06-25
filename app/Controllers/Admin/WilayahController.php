<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;

class WilayahController extends BaseController
{
    protected $kecamatanModel;

    public function __construct()
    {
        $this->kecamatanModel = new KecamatanModel();
    }

    // ── Helpers ──────────────────────────────────────────────────────

    private function getGeojsonFiles(): array
    {
        $files = glob(FCPATH . '*.geojson');
        if (!$files) return [];

        return array_map('basename', $files);
    }

    private function countSekolah(int $kecamatanId): int
    {
        $db = \Config\Database::connect();
        return (int) $db->table('sekolah')
            ->where('kecamatan_id', $kecamatanId)
            ->where('is_active', 1)
            ->where('deleted_at IS NULL')
            ->countAllResults();
    }

    private function buildPageList(int $current, int $last): array
    {
        if ($last <= 7) return range(1, $last);
        if ($current <= 4) return [1, 2, 3, 4, 5, '...', $last];
        if ($current >= $last - 3) return [1, '...', $last - 4, $last - 3, $last - 2, $last - 1, $last];
        return [1, '...', $current - 1, $current, $current + 1, '...', $last];
    }

    // ── Page (server render) ──────────────────────────────────────────

    public function index()
    {
        $search  = trim((string) $this->request->getGet('search'));
        $page    = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = 10;

        $builder = $this->kecamatanModel->builder();

        if ($search !== '') {
            $builder->groupStart()
                ->like('nama_kecamatan', $search)
                ->orLike('kode_kecamatan', $search)
                ->groupEnd();
        }

        $total    = $builder->countAllResults(false);
        $lastPage = $total > 0 ? (int) ceil($total / $perPage) : 1;

        if ($page > $lastPage) {
            $page = $lastPage;
        }

        $offset = ($page - 1) * $perPage;
        $rows   = $builder->limit($perPage, $offset)->get()->getResultArray();

        foreach ($rows as &$row) {
            $row['jumlah_sekolah'] = $this->countSekolah((int) $row['id']);
        }
        unset($row);

        return view('pages/admin/wilayah/index', [
            'rows'          => $rows,
            'total'         => $total,
            'perPage'       => $perPage,
            'currentPage'   => $page,
            'lastPage'      => $lastPage,
            'pages'         => $this->buildPageList($page, $lastPage),
            'search'        => $search,
            'geojsonFiles'  => $this->getGeojsonFiles(),
            'kecamatanList' => $this->kecamatanModel
                ->select('id, nama_kecamatan, kode_kecamatan')
                ->orderBy('nama_kecamatan', 'ASC')
                ->findAll(),
        ]);
    }

    // ── CRUD (form POST + redirect) ────────────────────────────────────

    public function store()
    {
        $rules = [
            'kecamatan_id' => 'required|is_natural_no_zero',
            'geojson_file' => 'permit_empty|max_length[255]',
            'latitude'     => 'permit_empty|decimal',
            'longitude'    => 'permit_empty|decimal',
        ];

        $messages = [
            'kecamatan_id' => [
                'required'           => 'Kecamatan wajib dipilih.',
                'is_natural_no_zero' => 'Pilihan kecamatan tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('open_modal', 'add');
        }

        $id  = (int) $this->request->getPost('kecamatan_id');
        $row = $this->kecamatanModel->find($id);

        if (!$row) {
            return redirect()->back()->with('error', 'Kecamatan tidak ditemukan.');
        }

        $this->kecamatanModel->update($id, [
            'geojson_file' => $this->request->getPost('geojson_file') ?: null,
            'latitude'     => $this->request->getPost('latitude')     ?: null,
            'longitude'    => $this->request->getPost('longitude')    ?: null,
            'warna'        => $this->request->getPost('warna')        ?: null,
        ]);

        return redirect()->to(route_to('admin.wilayah'))
            ->with('success', 'Data wilayah berhasil disimpan.');
    }

    public function update(int $id)
    {
        $row = $this->kecamatanModel->find($id);

        if (!$row) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $rules = [
            'geojson_file' => 'permit_empty|max_length[255]',
            'latitude'     => 'permit_empty|decimal',
            'longitude'    => 'permit_empty|decimal',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('open_modal', 'edit')
                ->with('open_id', $id);
        }

        $this->kecamatanModel->update($id, [
            'geojson_file' => $this->request->getPost('geojson_file') ?: null,
            'latitude'     => $this->request->getPost('latitude')     ?: null,
            'longitude'    => $this->request->getPost('longitude')    ?: null,
            'warna'        => $this->request->getPost('warna')        ?: null,
        ]);

        return redirect()->to(route_to('admin.wilayah'))
            ->with('success', 'Data wilayah berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $row = $this->kecamatanModel->find($id);

        if (!$row) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $this->kecamatanModel->update($id, [
            'geojson_file' => null,
            'latitude'     => null,
            'longitude'    => null,
            'warna'        => null,
        ]);

        return redirect()->to(route_to('admin.wilayah'))
            ->with('success', 'Data wilayah berhasil direset.');
    }
}
