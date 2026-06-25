<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table = 'kecamatan';
    protected $allowedFields = [
        'nama_kecamatan',
        'slug',
        'kode_kecamatan',
        'geojson_file',
        'warna',
        'latitude',
        'longitude'
    ];

    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        helper('text');

        if (isset($data['data']['nama_kecamatan'])) {
            $data['data']['slug'] = url_title(
                $data['data']['nama_kecamatan'],
                '-',
                true
            );
        }

        return $data;
    }
}
