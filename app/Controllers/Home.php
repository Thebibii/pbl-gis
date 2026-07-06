<?php

namespace App\Controllers;

use App\Models\KecamatanModel;
use App\Models\SekolahModel;

class Home extends BaseController
{
    protected $kecamatanModel;

    public function __construct()
    {
        $this->kecamatanModel = new KecamatanModel();
    }
    public function index(): string
    {
        $sekolahModel = new SekolahModel();

        // Mengambil 8 data terbaru beserta nama_kecamatan
        $data['sekolah'] = $sekolahModel->select('sekolah.*, kecamatan.nama_kecamatan')
            ->join('kecamatan', 'kecamatan.id = sekolah.kecamatan_id', 'left')
            ->orderBy('sekolah.created_at', 'DESC')
            ->findAll(8);

        // dd($data['sekolah']);
        // Mengirim data ke view 'welcome_message'
        return view('welcome_message', $data);
    }


    public function peta(): string
    {
        $sekolahModel = new \App\Models\SekolahModel();
        $kecamatan_list = $this->kecamatanModel->select('id, nama_kecamatan, geojson_file, warna')->findAll();

        $kecamatan_geojson = []; // <- inisialisasi, sebelumnya tidak ada

        foreach ($kecamatan_list as $kec) {
            $path = FCPATH . $kec['geojson_file'];

            if (!is_file($path)) {
                log_message('error', 'GeoJSON kecamatan tidak ditemukan: ' . $path);
                continue;
            }

            $decoded = json_decode(file_get_contents($path), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'GeoJSON kecamatan gagal decode (' . $kec['geojson_file'] . '): ' . json_last_error_msg());
                continue;
            }

            $kecamatan_geojson[] = [
                'id'             => $kec['id'],
                'nama_kecamatan' => $kec['nama_kecamatan'],
                'warna'          => $kec['warna'],
                'geojson'        => $decoded,
            ];
        }

        $total_sekolah = $sekolahModel->countAllResults(false);
        $sekolah = array_map(function ($s) {
            $siswa = $s['jumlah_siswa_l'] + $s['jumlah_siswa_p'];
            $guru = $s['jumlah_guru_tetap'] + $s['jumlah_guru_honor'];
            return [
                'id'         => $s['id'],
                'nama'       => $s['nama_sekolah'],
                'slug'       => $s['slug'],
                'jenis'      => $s['jenjang'],
                'status'     => strtoupper($s['status']),
                'akreditasi' => $s['akreditasi'],
                'lat'        => (float) $s['latitude'],
                'lng'        => (float) $s['longitude'],
                'alamat'     => $s['alamat'],
                'siswa'      => $siswa,
                'guru'       => $guru,
                'nama_kecamatan' => $s['nama_kecamatan'],
                'img'        => $s['foto_utama']
                    ? base_url('uploads/sekolah/' . $s['foto_utama'])
                    : null,
            ];
        }, $sekolahModel->forPeta());
        return view('pages/peta', [
            'sekolahData'      => json_encode($sekolah, JSON_UNESCAPED_UNICODE),
            'kecamatanGeojson' => json_encode($kecamatan_geojson, JSON_UNESCAPED_UNICODE), // <- baru
            'totalSekolah'     => $total_sekolah,
        ]);
    }


    public function cari(): string
    {
        $model       = new SekolahModel();
        $initialData = $model->cariSekolah([], 1, 12);
        return view('pages/cari', compact('initialData'));
    }

    public function cariFilter(): \CodeIgniter\HTTP\ResponseInterface
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Forbidden']);
        }

        $json = $this->request->getJSON(true) ?? [];

        $filters = [
            'jenjang'    => $json['jenjang']    ?? '',
            'status'     => $json['status']     ?? [],
            'akreditasi' => $json['akreditasi'] ?? [],
            'sort'       => $json['sort']       ?? 'rekomendasi',
            'search'     => trim((string) ($json['search'] ?? '')),
        ];
        $page = max(1, (int) ($json['page'] ?? 1));

        $model  = new SekolahModel();
        $result = $model->cariSekolah($filters, $page, 12);

        // Kembalikan CSRF token baru agar request berikutnya tidak 403
        return $this->response->setJSON([
            ...$result,
            'csrf_token' => csrf_hash(),
        ]);
    }

    public function sekolah($slug)
    {
        $db = \Config\Database::connect();

        // 1. Data utama sekolah
        $sekolah = $db->table('sekolah')
            ->select('
            sekolah.id,
            npsn,
            nama_kepsek,
            nama_sekolah,
            sekolah.slug,
            jenjang,
            status,
            akreditasi,
            alamat,
            sekolah.latitude,
            sekolah.longitude,
            telepon,
            email,
            website,
            visi,
            misi,
            kurikulum,
            luas_lahan,
            foto_utama,
            kecamatan.geojson_file,
            kecamatan.nama_kecamatan
        ')
            ->join('nagari', 'nagari.id = sekolah.nagari_id', 'left')
            ->join('kecamatan', 'kecamatan.id = sekolah.kecamatan_id', 'left')
            ->where('sekolah.slug', $slug)
            ->where('is_active', 1)
            ->get()
            ->getRowArray();

        if (!$sekolah) {
            return $this->show404();
        }

        $sekolahId = $sekolah['id'];

        // 2. Statistik siswa, guru, rombel
        $statistik = $db->table('statistik_sekolah')
            ->where('sekolah_id', $sekolahId)
            ->orderBy('tahun_ajaran', 'DESC')
            ->get()
            ->getRowArray();

        // 3. Fasilitas (join jenis_fasilitas)
        $fasilitas = $db->table('sekolah_fasilitas sf')
            ->select('jf.nama_fasilitas, jf.ikon, sf.kondisi, sf.jumlah, sf.keterangan')
            ->join('jenis_fasilitas jf', 'jf.id = sf.jenis_fasilitas_id')
            ->where('sf.sekolah_id', $sekolahId)
            ->get()
            ->getResultArray();

        // 4. Prestasi
        $prestasi = $db->table('prestasi')
            ->where('sekolah_id', $sekolahId)
            ->orderBy('tahun', 'DESC')
            ->get()
            ->getResultArray();
        // dd($sekolah);
        // 5. Sekolah terdekat (3 terdekat berdasarkan jarak Haversine)
        $lat = $sekolah['latitude'];
        $lng = $sekolah['longitude'];

        $sekolahTerdekat = $db->query("
    SELECT
        s.nama_sekolah,
        s.slug,
        s.jenjang,
        s.status,
        s.akreditasi,
        s.foto_utama,
        s.latitude,
        s.longitude,
        (
            6371 * ACOS(
                COS(RADIANS(?)) * COS(RADIANS(s.latitude)) *
                COS(RADIANS(s.longitude) - RADIANS(?)) +
                SIN(RADIANS(?)) * SIN(RADIANS(s.latitude))
            )
        ) AS jarak_km
    FROM sekolah s
    WHERE s.id != ?
      AND s.is_active = 1
      AND s.latitude IS NOT NULL
      AND s.longitude IS NOT NULL
    ORDER BY jarak_km ASC
    LIMIT 3
", [$lat, $lng, $lat, $sekolahId])->getResultArray();


        return view('pages/sekolah', [
            'slug'      => $slug,
            'sekolah'   => $sekolah,
            'statistik' => $statistik,
            'fasilitas' => $fasilitas,
            'prestasi'  => $prestasi,
            'sekolahTerdekat'  => $sekolahTerdekat, // tambah ini
        ]);
    }

    private function show404()
    {
        return view('pages/sekolah', [
            'slug'      => null,
            'sekolah'   => [],
            'statistik' => [],
            'fasilitas' => [],
            'prestasi'  => [],
            'sekolahTerdekat'  => [], // tambah ini
        ]);
    }

    public function bandingkan()
    {
        return view('pages/bandingkan');
    }
}
