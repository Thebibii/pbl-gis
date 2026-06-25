<?php

namespace App\Models\Sekolah;

use CodeIgniter\Model;

class StatistikSekolahModel extends Model
{
    protected $table = 'statistik_sekolah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'sekolah_id',
        'tahun_ajaran',
        'jumlah_siswa_l',
        'jumlah_siswa_p',
        'jumlah_guru_tetap',
        'jumlah_guru_honor',
        'jumlah_tenaga_kependidikan',
        'jumlah_rombel',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
