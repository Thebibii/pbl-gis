<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;
use App\Models\SekolahModel;

class SekolahController extends BaseController
{
    protected SekolahModel $sekolahModel;
    protected KecamatanModel $kecamatanModel;

    public function __construct()
    {
        $this->sekolahModel = new SekolahModel();
        $this->kecamatanModel = new KecamatanModel();
    }

    public function index()
    {
        // Cek login
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user();

        // Cek role
        if (!$user->inGroup('operator_sekolah')) {
            return redirect()->to('/operator/dashboard')
                ->with('error', 'Akses ditolak!');
        }

        // Pastikan user memiliki sekolah
        if (empty($user->sekolah_id)) {
            return redirect()->back()
                ->with('error', 'Akun Anda belum terhubung dengan sekolah.');
        }

        // Ambil data sekolah
        $sekolah = $this->sekolahModel->find($user->sekolah_id);

        if (!$sekolah) {
            return redirect()->back()
                ->with('error', 'Data sekolah tidak ditemukan.');
        }


        $kecamatan_list = $this->kecamatanModel
            ->select('id, nama_kecamatan, geojson_file, warna')
            ->where('geojson_file IS NOT NULL')
            ->findAll();

        $kecamatan_geojson = [];

        foreach ($kecamatan_list as $kec) {

            $path = FCPATH . $kec['geojson_file'];

            if (!is_file($path)) {
                continue;
            }

            $decoded = json_decode(file_get_contents($path), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                continue;
            }

            $kecamatan_geojson[] = [
                'id'             => $kec['id'],
                'nama_kecamatan' => $kec['nama_kecamatan'],
                'warna'          => $kec['warna'],
                'geojson'        => $decoded,
            ];
        }



        // Cari nama kecamatan untuk display
        $kecamatanName = '';
        foreach ($kecamatan_list as $kec) {
            if ((string) $kec['id'] === (string) $sekolah['kecamatan_id']) {
                $kecamatanName = $kec['nama_kecamatan'];
                break;
            }
        }

        $data = [
            'title'    => 'Data Sekolah',
            'user'     => $user,
            'sekolah'  => $sekolah,
            'kecamatan_geojson' => $kecamatan_geojson,
            'kecamatanName' => $kecamatanName,
            'validation' => \Config\Services::validation(),
        ];

        return view('pages/operator/sekolah/index', $data);
    }

    public function update()
    {
        // Cek login
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user();

        // Cek role
        if (!$user->inGroup('operator_sekolah')) {
            return redirect()->to('/operator/dashboard')
                ->with('error', 'Akses ditolak!');
        }

        // Load sekolah untuk conditional validation
        $sekolah = $this->sekolahModel->find($user->sekolah_id);

        if (!$sekolah) {
            return redirect()->back()
                ->with('error', 'Data sekolah tidak ditemukan.');
        }

        // Foto: wajib jika belum ada foto, opsional jika sudah ada
        $fotoRule = !empty($sekolah['foto_utama'])
            ? 'permit_empty|uploaded[foto_utama]|is_image[foto_utama]|mime_in[foto_utama,image/png,image/jpeg,image/jpg,image/webp]|max_size[foto_utama,2048]'
            : 'uploaded[foto_utama]|is_image[foto_utama]|mime_in[foto_utama,image/png,image/jpeg,image/jpg,image/webp]|max_size[foto_utama,2048]';

        $rules = [
            'nama_kepsek'  => 'required|max_length[150]',
            'akreditasi'   => 'permit_empty|in_list[A,B,C,Belum Terakreditasi]',
            'telepon'      => 'permit_empty|max_length[30]',
            'email'        => 'permit_empty|valid_email|max_length[100]',
            'website'      => 'permit_empty|valid_url_strict',
            'kurikulum'    => 'permit_empty|max_length[100]',
            'alamat'       => 'permit_empty',
            'visi'         => 'permit_empty',
            'misi'         => 'permit_empty',
            'latitude'     => 'required|decimal|greater_than[-90]|less_than[90]',
            'longitude'    => 'required|decimal|greater_than[-180]|less_than[180]',
            'kecamatan_id' => 'required',
            'foto_utama'   => $fotoRule,
        ];

        $errors = [
            'foto_utama' => [
                'uploaded' => 'Foto sekolah wajib diunggah.',
                'is_image' => 'File harus berupa gambar (PNG, JPG, WEBP).',
                'mime_in'  => 'File harus berupa gambar dengan format PNG, JPG, atau WEBP.',
                'max_size' => 'Ukuran foto maksimal 2MB.',
            ],
            'latitude' => [
                'required'     => 'Latitude wajib diisi.',
                'decimal'      => 'Latitude harus berupa angka desimal.',
                'greater_than' => 'Latitude harus lebih besar dari -90.',
                'less_than'    => 'Latitude harus kurang dari 90.',
            ],
            'longitude' => [
                'required'     => 'Longitude wajib diisi.',
                'decimal'      => 'Longitude harus berupa angka desimal.',
                'greater_than' => 'Longitude harus lebih besar dari -180.',
                'less_than'    => 'Longitude harus kurang dari 180.',
            ],
        ];

        if (!$this->validate($rules, $errors)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('error', 'Data gagal diperbarui. Periksa kembali form Anda.');
        }

        $data = [
            'nama_kepsek' => $this->request->getPost('nama_kepsek'),
            'akreditasi'  => $this->request->getPost('akreditasi'),
            'telepon'     => $this->request->getPost('telepon'),
            'email'       => $this->request->getPost('email'),
            'website'     => $this->request->getPost('website'),
            'visi'     => $this->request->getPost('visi'),
            'misi'     => $this->request->getPost('misi'),
            'kurikulum'   => $this->request->getPost('kurikulum'),
            'alamat'      => $this->request->getPost('alamat'),
            'latitude'     => $this->request->getPost('latitude'),
            'longitude'    => $this->request->getPost('longitude'),
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
        ];

        // Upload foto jika ada
        $foto = $this->request->getFile('foto_utama');

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {

            $namaFoto = $foto->getRandomName();

            $foto->move(FCPATH . 'uploads/sekolah', $namaFoto);

            // Hapus foto lama
            if (!empty($sekolah['foto_utama']) && file_exists(FCPATH . 'uploads/sekolah/' . $sekolah['foto_utama'])) {
                unlink(FCPATH . 'uploads/sekolah/' . $sekolah['foto_utama']);
            }

            $data['foto_utama'] = $namaFoto;
        }

        $this->sekolahModel->update($user->sekolah_id, $data);

        return redirect()->to('/operator/sekolah')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
