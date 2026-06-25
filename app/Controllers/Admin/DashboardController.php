<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;
use App\Models\SekolahModel;
use CodeIgniter\HTTP\ResponseInterface;


class DashboardController extends BaseController
{
    protected $kecamatanModel;

    public function __construct()
    {
        $this->kecamatanModel = new KecamatanModel();
    }

    public function index()
    {
        $model = new SekolahModel();
        $db    = \Config\Database::connect();

        // Total sekolah aktif
        $total_sekolah = $model->where('is_active', 1)->countAllResults();

        // Total siswa (L + P) dari statistik terbaru per sekolah
        $total_siswa = $db->query("
            SELECT SUM(ss.jumlah_siswa_l + ss.jumlah_siswa_p) AS total
            FROM statistik_sekolah ss
            INNER JOIN (
                SELECT sekolah_id, MAX(tahun_ajaran) AS tahun_ajaran
                FROM statistik_sekolah
                GROUP BY sekolah_id
            ) latest ON ss.sekolah_id = latest.sekolah_id
                     AND ss.tahun_ajaran = latest.tahun_ajaran
        ")->getRow()->total ?? 0;

        // Sebaran akreditasi
        $akreditasi_rows = $db->table('sekolah')
            ->select('akreditasi, COUNT(*) as jumlah')
            ->where('is_active', 1)
            ->where('deleted_at', null)
            ->groupBy('akreditasi')
            ->get()->getResultArray();

        $total_akreditasi = array_sum(array_column($akreditasi_rows, 'jumlah'));
        $persen_a = 0;
        foreach ($akreditasi_rows as $row) {
            if ($row['akreditasi'] === 'A') {
                $persen_a = $total_akreditasi > 0
                    ? round($row['jumlah'] / $total_akreditasi * 100, 1)
                    : 0;
                break;
            }
        }

        $stats = [
            'total_sekolah'      => $total_sekolah,
            'total_siswa'        => $total_siswa,
            'persen_akreditasi_a' => $persen_a,
            'akreditasi'         => $akreditasi_rows,
            'total_akreditasi'   => $total_akreditasi,
        ];

        $sekolah_list   = $model->forPeta();
        $kecamatan_list = $this->kecamatanModel->select('id, nama_kecamatan, geojson_file, warna')->findAll();

        // ── Ambil GeoJSON kabupaten langsung di server ──────────────
        $wilayah_geojson = null;
        $wilayah_path    = FCPATH . 'id1305_tanah_datar.geojson';

        if (is_file($wilayah_path)) {
            $raw = file_get_contents($wilayah_path);
            $decoded = json_decode($raw, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $wilayah_geojson = $decoded;
            } else {
                log_message('error', 'GeoJSON kabupaten gagal di-decode: ' . json_last_error_msg());
            }
        } else {
            log_message('error', 'File GeoJSON kabupaten tidak ditemukan: ' . $wilayah_path);
        }

        // ── GeoJSON semua kecamatan (baru) ──────────────────────────
        $kecamatan_geojson = [];

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

        return view('pages/admin/dashboard', [
            'stats'              => $stats,
            'sekolah_list'       => $sekolah_list,
            'kecamatan_list'     => $kecamatan_list,
            'wilayah_geojson'    => $wilayah_geojson,
            'kecamatan_geojson'  => $kecamatan_geojson,
        ]);
    }
}
