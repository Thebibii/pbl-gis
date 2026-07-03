<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\SekolahModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user();

        if (!$user->inGroup('operator_sekolah')) {
            return redirect()->to('/operator/dashboard')->with('error', 'Akses ditolak!');
        }

        // Ambil sekolah_id milik operator dari tabel users
        $userRow = (new UserModel())
            ->select('sekolah_id')
            ->find($user->id);

        $sekolahId = $userRow->sekolah_id ?? null;

        if (!$sekolahId) {
            return view('pages/operator/dashboard', [
                'title'   => 'Dashboard Operator Sekolah',
                'user'    => $user,
                'sekolah' => null,
                'stats'   => null,
                'alerts'  => [
                    [
                        'icon'  => 'error',
                        'title' => 'Akun Belum Terhubung',
                        'desc'  => 'Akun Anda belum dikaitkan dengan data sekolah. Hubungi administrator.',
                    ],
                ],
            ]);
        }

        $sekolahModel = new SekolahModel();
        $sekolah      = $sekolahModel->find($sekolahId);

        // Field-field yang dianggap penting untuk kelengkapan profil sekolah
        $fieldsPenting = [
            'nama_kepsek',
            'telepon',
            'email',
            'alamat',
            'foto_utama',
            'latitude',
            'longitude',
            'kurikulum',
        ];

        $terisi = 0;
        foreach ($fieldsPenting as $field) {
            if (!empty($sekolah[$field])) {
                $terisi++;
            }
        }

        $kelengkapanPersen = (int) round(($terisi / count($fieldsPenting)) * 100);
        $punyaLokasi       = !empty($sekolah['latitude']) && !empty($sekolah['longitude']);

        // Bangun alert dinamis berdasarkan field yang masih kosong
        $alerts = [];

        if (!$punyaLokasi) {
            $alerts[] = [
                'icon'  => 'location_on',
                'title' => 'Lengkapi Koordinat',
                'desc'  => 'Titik lokasi sekolah Anda belum ditentukan pada peta',
            ];
        }

        if (empty($sekolah['foto_utama'])) {
            $alerts[] = [
                'icon'  => 'add_a_photo',
                'title' => 'Foto Utama Kosong',
                'desc'  => 'Unggah foto depan sekolah untuk ditampilkan di profil publik',
            ];
        }

        if (empty($sekolah['nama_kepsek'])) {
            $alerts[] = [
                'icon'  => 'person',
                'title' => 'Nama Kepala Sekolah Kosong',
                'desc'  => 'Lengkapi nama kepala sekolah pada profil',
            ];
        }

        if (empty($sekolah['telepon']) && empty($sekolah['email'])) {
            $alerts[] = [
                'icon'  => 'contact_phone',
                'title' => 'Kontak Belum Lengkap',
                'desc'  => 'Tambahkan nomor telepon atau email sekolah',
            ];
        }

        if (($sekolah['akreditasi'] ?? 'Belum Terakreditasi') === 'Belum Terakreditasi') {
            $alerts[] = [
                'icon'  => 'workspace_premium',
                'title' => 'Akreditasi Belum Diperbarui',
                'desc'  => 'Perbarui status akreditasi sekolah jika sudah tersedia',
            ];
        }

        $data = [
            'title'   => 'Dashboard Operator Sekolah',
            'user'    => $user,
            'sekolah' => $sekolah,
            'stats'   => [
                'kelengkapan_persen' => $kelengkapanPersen,
                'akreditasi'         => $sekolah['akreditasi'] ?? 'Belum Terakreditasi',
                'punya_lokasi'       => $punyaLokasi,
                'jenjang'            => $sekolah['jenjang'] ?? '-',
                'status'             => $sekolah['status'] ?? '-',
            ],
            'alerts'  => $alerts,
        ];

        return view('pages/operator/dashboard', $data);
    }
}
