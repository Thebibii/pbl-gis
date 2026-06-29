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
        'foto_utama',
        'kurikulum',
        'tahun_berdiri',
        'luas_lahan',
        'is_active',
    ];

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
            ->findAll();
    }

    public function getFiltered(string $search = '', string $jenjang = '', int $perPage = 10): array
    {
        $builder = $this->select('id, npsn, nama_sekolah, slug, jenjang, status, akreditasi, alamat')
            ->where('deleted_at', null);

        if ($search !== '') {
            $builder->groupStart()
                ->like('nama_sekolah', $search)
                ->orLike('npsn', $search)
                ->groupEnd();
        }

        if ($jenjang !== '') {
            $builder->where('jenjang', $jenjang);
        }

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
            ->select('sekolah.id, sekolah.nama_sekolah, sekolah.slug, sekolah.jenjang,
                  sekolah.status, sekolah.akreditasi, sekolah.alamat, sekolah.foto_utama,
                  kecamatan.nama_kecamatan')
            ->join('kecamatan', 'kecamatan.id = sekolah.kecamatan_id', 'left')
            ->where('sekolah.is_active', 1)
            ->where('sekolah.deleted_at', null); // eksplisit agar countAllResults(false) ikut filter

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

        // Sorting
        $sort = $filters['sort'] ?? 'rekomendasi';
        if ($sort === 'akreditasi') {
            // FIELD() — CI4 mendeteksi '(' dan tidak escape
            $builder->orderBy("FIELD(sekolah.akreditasi,'A','B','C','Belum Terakreditasi')");
        } else {
            $builder->orderBy('sekolah.nama_sekolah', 'ASC');
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
