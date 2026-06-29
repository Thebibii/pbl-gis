<?php

namespace App\Models;

use CodeIgniter\Model;

class NagariModel extends Model
{
    protected $table = 'nagari';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kecamatan_id',
        'nama_nagari',
        'slug',
        'kode_nagari',
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

        if (isset($data['data']['nama_nagari'], $data['data']['kode_nagari'])) {
            $data['data']['slug'] = url_title(
                $data['data']['nama_nagari'],
                '-',
                true
            ) . '-' . $data['data']['kode_nagari'];
        }

        return $data;
    }
}
