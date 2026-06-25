<?php

namespace App\Models;

use CodeIgniter\Model;

class KelurahanModel extends Model
{
    protected $table = 'kelurahan';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kecamatan_id',
        'nama_kelurahan',
        'slug',
        'kode_kelurahan',
        'latitude',
        'longitude',
        'geojson_file',
    ];

    protected $useTimestamps = true;

    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        helper('text');

        if (isset($data['data']['nama_kelurahan'], $data['data']['kode_kelurahan'])) {
            $data['data']['slug'] = url_title(
                $data['data']['nama_kelurahan'],
                '-',
                true
            ) . '-' . $data['data']['kode_kelurahan'];
        }

        return $data;
    }
}
