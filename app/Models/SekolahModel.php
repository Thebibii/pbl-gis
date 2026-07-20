<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = 'sekolah';

    protected $allowedFields = [
        'npsn',
        'nama_kepsek',
        'nama_sekolah',
        'slug',
        'jenjang',
        'status',
        'akreditasi',
        'kecamatan_id',
        'nagari_id',
        'alamat',
        'latitude',
        'longitude',
        'nama_kepsek',
        'telepon',
        'email',
        'website',
        'visi',
        'misi',
        'foto_utama',
        'kurikulum',
        'tahun_berdiri',
        'luas_lahan',
        'is_active',
    ];

    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        helper('text');

        if (isset($data['data']['nama_sekolah'])) {
            $data['data']['slug'] = url_title(
                $data['data']['nama_sekolah'],
                '-',
                true
            );
        }

        return $data;
    }

    public function forPeta(): array
    {
        return $this->select('sekolah.id, nama_sekolah, jenjang, status, akreditasi, 
                          sekolah.latitude, sekolah.longitude, alamat, foto_utama, sekolah.slug,
                          sekolah.kecamatan_id, kecamatan.nama_kecamatan,
                          statistik_sekolah.jumlah_siswa_l, statistik_sekolah.jumlah_siswa_p,
                          statistik_sekolah.jumlah_guru_tetap, statistik_sekolah.jumlah_guru_honor')
            ->join('statistik_sekolah', 'statistik_sekolah.sekolah_id = sekolah.id', 'left')
            ->join('kecamatan', 'kecamatan.id = sekolah.kecamatan_id', 'left')
            ->where('sekolah.is_active', 1)
            ->orderBy('sekolah.created_at', 'DESC')
            ->findAll();
    }

    public function getFiltered(string $search = '', string $jenjang = '', string $status = '', string $akreditasi = '', int $perPage = 10): array
    {
        $builder = $this->select('id, npsn, nama_sekolah, slug, jenjang, status, akreditasi, alamat');

        if ($search !== '') {
            $builder->groupStart()
                ->like('nama_sekolah', $search)
                ->orLike('npsn', $search)
                ->groupEnd();
        }

        if ($jenjang !== '') {
            $builder->where('jenjang', $jenjang);
        }

        if ($status !== '') {
            $builder->where('status', $status);
        }

        if ($akreditasi !== '') {
            $builder->where('akreditasi', $akreditasi);
        }

        $builder->orderBy('created_at', 'DESC');

        $total = $builder->countAllResults(false); // false = jangan reset query

        $data = $builder->paginate($perPage, 'default');

        return [
            'data'   => $data,
            'pager'  => $this->pager,
            'total'  => $total,
        ];
    }

    /**
     * Untuk halaman /cari — mendukung filter, sort, dan paginasi manual (AJAX-friendly).
     */
    public function cariSekolah(array $filters = [], int $page = 1, int $perPage = 12): array
    {
        $builder = $this
            ->select('sekolah.id, sekolah.npsn, sekolah.nama_sekolah, sekolah.slug, sekolah.jenjang,
                  sekolah.status, sekolah.akreditasi, sekolah.alamat, sekolah.foto_utama,
                  kecamatan.nama_kecamatan')
            ->join('kecamatan', 'kecamatan.id = sekolah.kecamatan_id', 'left')
            ->where('sekolah.is_active', 1);

        if (!empty($filters['jenjang'])) {
            $builder->where('sekolah.jenjang', $filters['jenjang']);
        }

        // Jika status kosong (misal JS bug), anggap semua
        if (!empty($filters['status'])) {
            $builder->whereIn('sekolah.status', $filters['status']);
        }

        if (!empty($filters['akreditasi'])) {
            // UI kirim 'Baru', DB simpan 'Belum Terakreditasi'
            $akreditasi = array_map(
                fn($a) => $a === 'Baru' ? 'Belum Terakreditasi' : $a,
                $filters['akreditasi']
            );
            $builder->whereIn('sekolah.akreditasi', $akreditasi);
        }

        if (!empty($filters['search'])) {
            $keyword = trim($filters['search']);
            $builder->groupStart()
                ->like('sekolah.nama_sekolah', $keyword)
                ->orLike('sekolah.npsn', $keyword)
                ->orLike('sekolah.alamat', $keyword)
                ->groupEnd();
        }

        // Sorting
        $sort = $filters['sort'] ?? '';
        switch ($sort) {
            case 'nama_asc':
                $builder->orderBy('sekolah.nama_sekolah', 'ASC');
                break;
            case 'nama_desc':
                $builder->orderBy('sekolah.nama_sekolah', 'DESC');
                break;
            case 'akreditasi_asc':
                $builder->orderBy("FIELD(sekolah.akreditasi,'A','B','C','Belum Terakreditasi')");
                $builder->orderBy('sekolah.created_at', 'DESC');
                break;
            case 'akreditasi_desc':
                $builder->orderBy("FIELD(sekolah.akreditasi,'Belum Terakreditasi','C','B','A')");
                $builder->orderBy('sekolah.created_at', 'DESC');
                break;
            default: // '' (terbaru)
                $builder->orderBy('sekolah.created_at', 'DESC');
                break;
        }

        $total  = $builder->countAllResults(false); // false = jangan reset WHERE/JOIN
        $offset = ($page - 1) * $perPage;
        $data   = $builder->findAll($perPage, $offset); // findAll tambahkan soft delete & apply limit

        return [
            'data'        => $data,
            'total'       => $total,
            'page'        => $page,
            'per_page'    => $perPage,
            'total_pages' => (int) ceil($total / $perPage),
        ];
    }
}
