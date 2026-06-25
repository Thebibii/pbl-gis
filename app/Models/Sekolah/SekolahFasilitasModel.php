<?php

namespace App\Models\Sekolah;

use CodeIgniter\Model;

class SekolahFasilitasModel extends Model
{
    protected $table = 'sekolah_fasilitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'sekolah_id',
        'jenis_fasilitas_id',
        'kondisi',
        'jumlah',
        'keterangan',
    ];
}
