<?php

namespace App\Models\Sekolah;

use CodeIgniter\Model;

class JenisFasilitasModel extends Model
{
    protected $table            = 'jenis_fasilitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'nama_fasilitas',
        'ikon'
    ];

    public function getFiltered(string $search = '', int $perPage = 10)
    {
        $builder = $this->select('id, nama_fasilitas, ikon');

        if ($search !== '') {
            $builder->groupStart()->like('nama_fasilitas', $search)->groupEnd();
        }

        $total = $builder->countAllResults(false); // Get total count without resetting query
        $data = $builder->paginate($perPage, 'default');
        return [
            'data'  => $data,
            'total' => $total,
            'pager' => $this->pager,
        ];
    }
}
