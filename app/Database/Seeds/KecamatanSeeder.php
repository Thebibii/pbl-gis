<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kecamatan' => 'X Koto',
                'kode_kecamatan' => '13.04.01',
                'slug'           => 'x-koto',
                'geojson_file'   => 'id1305010_sepuluh_koto.geojson',
                'warna'          => '#e63946',
            ],
            [
                'nama_kecamatan' => 'Batipuh',
                'kode_kecamatan' => '13.04.02',
                'slug'           => 'batipuh',
                'geojson_file'   => 'id1305020_batipuh.geojson',
                'warna'          => '#f4a261',
            ],
            [
                'nama_kecamatan' => 'Batipuh Selatan',
                'kode_kecamatan' => '13.04.14',
                'slug'           => 'batipuh-selatan',
                'geojson_file'   => 'id1305021_batipuh_selatan.geojson',
                'warna'          => '#2a9d8f',
            ],
            [
                'nama_kecamatan' => 'Lima Kaum',
                'kode_kecamatan' => '13.04.04',
                'slug'           => 'lima-kaum',
                'geojson_file'   => 'id1305050_lima_kaum.geojson',
                'warna'          => '#457b9d',
            ],
            [
                'nama_kecamatan' => 'Lintau Buo',
                'kode_kecamatan' => '13.04.06',
                'slug'           => 'lintau-buo',
                'geojson_file'   => 'id1305080_lintau_buo.geojson',
                'warna'          => '#6a4c93',
            ],
            [
                'nama_kecamatan' => 'Lintau Buo Utara',
                'kode_kecamatan' => '13.04.13',
                'slug'           => 'lintau-buo-utara',
                'geojson_file'   => 'id1305081_lintau_buo_utara.geojson',
                'warna'          => '#e9c46a',
            ],
            [
                'nama_kecamatan' => 'Padang Ganting',
                'kode_kecamatan' => '13.04.11',
                'slug'           => 'padang-ganting',
                'geojson_file'   => 'id1305070_padang_ganting.geojson',
                'warna'          => '#264653',
            ],
            [
                'nama_kecamatan' => 'Pariangan',
                'kode_kecamatan' => '13.04.09',
                'slug'           => 'pariangan',
                'geojson_file'   => 'id1305030_pariangan.geojson',
                'warna'          => '#f77f00',
            ],
            [
                'nama_kecamatan' => 'Rambatan',
                'kode_kecamatan' => '13.04.03',
                'slug'           => 'rambatan',
                'geojson_file'   => 'id1305040_rambatan.geojson',
                'warna'          => '#80b918',
            ],
            [
                'nama_kecamatan' => 'Salimpaung',
                'kode_kecamatan' => '13.04.10',
                'slug'           => 'salimpaung',
                'geojson_file'   => 'id1305110_salimpaung.geojson',
                'warna'          => '#c77dff',
            ],
            [
                'nama_kecamatan' => 'Sungai Tarab',
                'kode_kecamatan' => '13.04.08',
                'slug'           => 'sungai-tarab',
                'geojson_file'   => 'id1305100_sungai_tarab.geojson',
                'warna'          => '#0096c7',
            ],
            [
                'nama_kecamatan' => 'Sungayang',
                'kode_kecamatan' => '13.04.07',
                'slug'           => 'sungayang',
                'geojson_file'   => 'id1305090_sungayang.geojson',
                'warna'          => '#d62828',
            ],
            [
                'nama_kecamatan' => 'Tanjuang Baru',
                'kode_kecamatan' => '13.04.12',
                'slug'           => 'tanjuang-baru',
                'geojson_file'   => 'id1305111_tanjung_baru.geojson',
                'warna'          => '#606c38',
            ],
            [
                'nama_kecamatan' => 'Tanjung Emas',
                'kode_kecamatan' => '13.04.05',
                'slug'           => 'tanjung-emas',
                'geojson_file'   => 'id1305060_tanjung_emas.geojson',
                'warna'          => '#bc6c25',
            ],
        ];


        $this->db->table('kecamatan')->insertBatch($data);
    }
}
