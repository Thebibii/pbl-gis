<?php

namespace App\Models\Sekolah;

use CodeIgniter\Model;

class PrestasiModel extends Model
{
    protected $table = 'prestasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'sekolah_id',
        'nama_prestasi',
        'tingkat',
        'jenis',
        'tahun',
        'keterangan',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getFiltered(int $sekolahId, string $search = '', int $perPage = 10)
    {
        $builder = $this->select('id, nama_prestasi, tingkat, jenis, tahun')
            ->where('sekolah_id', $sekolahId);

        if ($search !== '') {
            $builder->groupStart()
                ->like('nama_prestasi', $search)
                ->orLike('tingkat', $search)
                ->orLike('jenis', $search)
                ->orLike('tahun', $search)
                ->groupEnd();
        }

        $total = $builder->countAllResults(false);

        $data = $builder->paginate($perPage, 'default');

        return [
            'data'  => $data,
            'total' => $total,
            'pager' => $this->pager,
        ];
    }
}
