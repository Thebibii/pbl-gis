<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use League\Csv\Reader;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;

class SekolahController extends BaseController
{
    protected $sekolahModel;
    protected $userModel;
    protected $kecamatanModel;
    protected $jenisFasilitasModel;
    protected $sekolahFasilitasModel;
    protected $statistikSekolahModel;   // ← tambah
    protected $prestasiModel;           // ← tambah

    public function __construct()
    {
        $this->userModel           = new \App\Models\UserModel();
        $this->sekolahModel           = new \App\Models\SekolahModel();
        $this->kecamatanModel         = new \App\Models\KecamatanModel();
        $this->jenisFasilitasModel    = new \App\Models\Sekolah\JenisFasilitasModel();
        $this->sekolahFasilitasModel  = new \App\Models\Sekolah\SekolahFasilitasModel();
        $this->statistikSekolahModel  = new \App\Models\Sekolah\StatistikSekolahModel(); // ← tambah
        $this->prestasiModel          = new \App\Models\Sekolah\PrestasiModel();          // ← tambah
    }
    // public function index()
    // {
    //     $data = [
    //         'sekolahs' => $this->sekolahModel
    //             ->select('sekolah.id, npsn, nama_sekolah, slug, jenjang, status, akreditasi, alamat')
    //             ->findAll(),
    //     ];

    //     return view('pages/admin/sekolah/index', $data);
    // }

    public function index()
    {
        $perPage = 10;
        $result  = $this->sekolahModel->getFiltered('', '', $perPage);

        return view('pages/admin/sekolah/index', [
            'initialData' => [
                'data'        => $result['data'],
                'total'       => $result['total'],
                'perPage'     => $perPage,
                'currentPage' => 1,
                'lastPage'    => $result['pager']->getLastPage(),
            ],
        ]);
    }




    public function delete(string $slug)
    {
        // Verifikasi method spoofing
        // if ($this->request->getPost('_method') !== 'DELETE') {
        //     return redirect()->to(route_to('admin.sekolah'));
        // }

        $sekolah = $this->sekolahModel->where('slug', $slug)->first();

        if (!$sekolah) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }

        $this->sekolahModel->delete($sekolah['id']);

        return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }

    public function create()
    {
        $kecamatan = $this->kecamatanModel->select('id, nama_kecamatan, geojson_file')
            ->orderBy('nama_kecamatan', 'ASC')
            ->findAll();
        $jenisFasilitas = $this->jenisFasilitasModel->findAll();
        return view('pages/admin/sekolah/create', [
            'kecamatanList' =>  $kecamatan,
            'jenisFasilitas' => $jenisFasilitas
        ]);
    }

    public function store()
    {
        $rules = [
            'nama_sekolah' => 'required|min_length[3]|max_length[255]|is_unique[sekolah.nama_sekolah]', // ← Diperbarui
            'npsn'         => 'required|exact_length[8]|is_unique[sekolah.npsn]',
            'nama_kepsek'  => 'required|min_length[5]|max_length[100]',
            'jenjang'      => 'required|in_list[TK,SD,SMP]',
            'status'       => 'required|in_list[Negeri,Swasta]',
            'alamat'       => 'required',
            'luas_lahan'   => 'required',
            'tahun_berdiri' => 'permit_empty|numeric|greater_than[1900]|less_than_equal_to[2100]',
            'latitude'     => 'required|decimal',
            'longitude'    => 'required|decimal',
            'foto'         => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]',
        ];

        // Definisikan pesan error dalam bahasa Indonesia
        $errors = [
            'nama_sekolah' => [
                'required'   => 'Nama sekolah wajib diisi.',
                'min_length' => 'Nama sekolah minimal harus 3 karakter.',
                'max_length' => 'Nama sekolah maksimal 255 karakter.',
                'is_unique'  => 'Nama sekolah sudah terdaftar di sistem.',
            ],
            'npsn' => [
                'required'     => 'NPSN wajib diisi.',
                'exact_length' => 'NPSN harus berukuran tepat 8 karakter.',
                'is_unique'    => 'NPSN sudah terdaftar di sistem.',
            ],
            'nama_kepsek' => [
                'required'   => 'Nama Kepala sekolah wajib diisi.',
                'min_length' => 'Nama Kepala sekolah minimal harus 5 karakter.',
                'max_length' => 'Nama Kepala sekolah maksimal 100 karakter.',
            ],
            'jenjang' => [
                'required' => 'Jenjang sekolah wajib dipilih.',
                'in_list'  => 'Jenjang harus berupa salah satu dari: SD, SMP, SMA.',
            ],
            'status' => [
                'required' => 'Status sekolah wajib dipilih.',
                'in_list'  => 'Status harus berupa Negeri atau Swasta.',
            ],
            'alamat' => [
                'required' => 'Alamat wajib diisi.',
            ],
            'latitude' => [
                'required' => 'Latitude wajib diisi.',
                'decimal'  => 'Format latitude harus berupa angka desimal.',
            ],
            'longitude' => [
                'required' => 'Longitude wajib diisi.',
                'decimal'  => 'Format longitude harus berupa angka desimal.',
            ],
            'luas_lahan' => [
                'required'  => 'Luas lahan wajib diisi.',
            ],
            'tahun_berdiri' => [
                'numeric'           => 'Tahun berdiri harus berupa angka.',
                'greater_than'      => 'Tahun berdiri harus lebih besar dari 1900.',
                'less_than_equal_to' => 'Tahun berdiri harus kurang dari atau sama dengan tahun saat ini.',
            ],

            'foto' => [                                          // ← tambah ini
                'uploaded' => 'Foto sekolah wajib diunggah.',
                'is_image' => 'File harus berupa gambar (jpg, png, gif, webp).',
                'max_size' => 'Ukuran foto maksimal 2MB.',
            ],

        ];

        // Masukkan variabel $errors ke dalam fungsi validate
        if (!$this->validate($rules, $errors)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        // ── 2. Validasi statistik (manual, kondisional) ───────────────────────
        $tahunAjaran   = trim($this->request->getPost('tahun_ajaran') ?? '');
        $adaStatistik  = $this->request->getPost('jumlah_siswa_l')
            || $this->request->getPost('jumlah_siswa_p')
            || $this->request->getPost('jumlah_guru_tetap')
            || $this->request->getPost('jumlah_guru_honor')
            || $this->request->getPost('jumlah_tenaga_kependidikan')
            || $this->request->getPost('jumlah_rombel');

        // Jika ada angka statistik diisi tapi tahun_ajaran kosong → tolak
        if ($adaStatistik && $tahunAjaran === '') {
            return redirect()->back()->withInput()
                ->with('errors', ['tahun_ajaran' => 'Tahun ajaran wajib diisi jika data statistik dimasukkan.']);
        }

        // Validasi format tahun_ajaran jika diisi (harus "YYYY/YYYY", max 9 char)
        if ($tahunAjaran !== '' && !preg_match('/^\d{4}\/\d{4}$/', $tahunAjaran)) {
            return redirect()->back()->withInput()
                ->with('errors', ['tahun_ajaran' => 'Format tahun ajaran tidak valid. Gunakan format: 2024/2025']);
        }

        // ── 3. Validasi prestasi (manual, per-row kondisional) ────────────────
        $prestasiList  = $this->request->getPost('prestasi') ?? [];
        $prestasiErrors = [];

        foreach ($prestasiList as $i => $item) {
            $nama  = trim($item['nama_prestasi'] ?? '');
            $tahun = trim($item['tahun'] ?? '');

            // Row benar-benar kosong → skip, tidak perlu divalidasi
            if ($nama === '' && $tahun === '') continue;

            // Salah satu diisi → keduanya harus ada
            if ($nama === '') {
                $prestasiErrors["prestasi.{$i}.nama_prestasi"] =
                    'Nama prestasi wajib diisi pada baris ' . ($i + 1) . '.';
            }

            if ($tahun === '') {
                $prestasiErrors["prestasi.{$i}.tahun"] =
                    'Tahun wajib diisi pada baris ' . ($i + 1) . '.';
            }

            // Tahun diisi tapi bukan angka valid
            if ($tahun !== '' && (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2100)) {
                $prestasiErrors["prestasi.{$i}.tahun"] =
                    'Tahun tidak valid pada baris ' . ($i + 1) . '.';
            }
        }

        if (!empty($prestasiErrors)) {
            return redirect()->back()->withInput()
                ->with('errors', $prestasiErrors);
        }

        // --- Upload foto ---
        $fotoFile = $this->request->getFile('foto');
        $fotoName = $fotoFile->getRandomName();
        $fotoFile->move(FCPATH . 'uploads/sekolah/', $fotoName);

        $data = [
            'npsn'          => $this->request->getPost('npsn'),
            'nama_kepsek'           => $this->request->getPost('nama_kepsek'),
            'nama_sekolah'  => $this->request->getPost('nama_sekolah'),
            'jenjang'       => $this->request->getPost('jenjang'),
            'status'        => $this->request->getPost('status'),
            'akreditasi'    => $this->request->getPost('akreditasi'),
            'kurikulum'     => $this->request->getPost('kurikulum'),
            'tahun_berdiri' => $this->request->getPost('tahun_berdiri') ?: null,
            'alamat'        => $this->request->getPost('alamat'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude'),
            'kecamatan_id'  => $this->request->getPost('kecamatan_id') ?: null,
            'telepon'       => $this->request->getPost('telepon') ?: null,
            'email'         => $this->request->getPost('email') ?: null,
            'website'       => $this->request->getPost('website') ?: null,
            'luas_lahan'       => $this->request->getPost('luas_lahan') ?: null,
            'is_active'     => $this->request->getPost('is_active') ? 1 : 0,
            'foto_utama'         => $fotoName,
        ];

        // --- Insert sekolah utama ---
        $sekolahId = $this->sekolahModel->insert($data, true);

        $npsn        = $data['npsn'];
        $username    = 'op_' . $npsn;          // contoh: op_10308727
        $email       = $username . '@sigis.local';
        $rawPassword = $npsn;

        // Safety net: pastikan username unik
        $suffix = 1;
        while ($this->userModel->where('username', $username)->first()) {
            $username = 'op_' . $npsn . '_' . $suffix;
            $email    = $username . '@sigis.local';
            $suffix++;
        }

        $userEntity = new User([
            'username'   => $username,
            'email'      => $email,
            'password'   => $rawPassword,
            'sekolah_id' => $sekolahId,
        ]);

        $this->userModel->save($userEntity);
        $newUser = $this->userModel->findById($this->userModel->getInsertID());

        $newUser->addGroup('operator_sekolah');
        $newUser->activate();

        // --- Statistik: hanya insert jika tahun_ajaran diisi ---
        $tahunAjaran = trim($this->request->getPost('tahun_ajaran') ?? '');
        if ($tahunAjaran !== '') {
            $this->statistikSekolahModel->insert([
                'sekolah_id'                  => $sekolahId,
                'tahun_ajaran'                => $tahunAjaran,
                'jumlah_siswa_l'              => (int) ($this->request->getPost('jumlah_siswa_l') ?? 0),
                'jumlah_siswa_p'              => (int) ($this->request->getPost('jumlah_siswa_p') ?? 0),
                'jumlah_guru_tetap'           => (int) ($this->request->getPost('jumlah_guru_tetap') ?? 0),
                'jumlah_guru_honor'           => (int) ($this->request->getPost('jumlah_guru_honor') ?? 0),
                'jumlah_tenaga_kependidikan'  => (int) ($this->request->getPost('jumlah_tenaga_kependidikan') ?? 0),
                'jumlah_rombel'               => (int) ($this->request->getPost('jumlah_rombel') ?? 0),
            ]);
        }

        // --- Fasilitas: aman, hanya jika ada yang dicentang ---
        $fasilitasData = $this->request->getPost('fasilitas') ?? [];

        foreach ($fasilitasData as $item) {
            // Pastikan jenis_id ada (checkbox yang dicentang saja yang masuk)
            if (empty($item['jenis_id'])) continue;

            $this->sekolahFasilitasModel->insert([
                'sekolah_id'         => $sekolahId,
                'jenis_fasilitas_id' => (int) $item['jenis_id'],
                'jumlah'             => (int) ($item['jumlah'] ?? 1),
                'kondisi'            => $item['kondisi'] ?? 'Baik',
                'keterangan'         => $item['keterangan'] ?? null,
            ]);
        }

        // --- Prestasi: hanya insert jika nama_prestasi DAN tahun keduanya diisi ---
        $prestasiList = $this->request->getPost('prestasi') ?? [];
        foreach ($prestasiList as $item) {
            $namaPrestasi = trim($item['nama_prestasi'] ?? '');
            $tahun        = trim($item['tahun'] ?? '');

            // Keduanya wajib ada karena NOT NULL di database
            if ($namaPrestasi === '' || $tahun === '') continue;

            $this->prestasiModel->insert([
                'sekolah_id'    => $sekolahId,
                'nama_prestasi' => $namaPrestasi,
                // Sesuaikan value option di view dengan ENUM migration
                'tingkat'       => $item['tingkat']    ?? 'Sekolah',
                'jenis'         => $item['jenis']      ?? 'Akademik',
                'tahun'         => (int) $tahun,
                'keterangan'    => !empty($item['keterangan']) ? $item['keterangan'] : null,
            ]);
        }


        return redirect()->to('/admin/sekolah')
            ->with('success', 'Data sekolah berhasil disimpan.');
    }



    public function edit(string $slug)
    {
        $sekolah = $this->sekolahModel->where('slug', $slug)->first();

        if (!$sekolah) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Sekolah tidak ditemukan: $slug");
        }

        $sekolahId = $sekolah['id'];

        // Ambil statistik terbaru (1 record)
        $statistik = $this->statistikSekolahModel
            ->where('sekolah_id', $sekolahId)
            ->orderBy('tahun_ajaran', 'DESC')
            ->first();

        // Ambil fasilitas yang dimiliki sekolah ini
        $fasilitasDimiliki = $this->sekolahFasilitasModel
            ->where('sekolah_id', $sekolahId)
            ->findAll();

        // Buat lookup: jenis_fasilitas_id → data row (jumlah, kondisi, keterangan)
        $fasilitasMap = [];
        foreach ($fasilitasDimiliki as $f) {
            $fasilitasMap[$f['jenis_fasilitas_id']] = $f;
        }

        // Ambil semua prestasi sekolah ini
        $prestasi = $this->prestasiModel
            ->where('sekolah_id', $sekolahId)
            ->orderBy('tahun', 'DESC')
            ->findAll();

        // Daftar master kecamatan & jenis fasilitas (sama seperti create)
        $kecamatan = $this->kecamatanModel
            ->select('id, nama_kecamatan, geojson_file')
            ->orderBy('nama_kecamatan', 'ASC')
            ->findAll();

        $jenisFasilitas = $this->jenisFasilitasModel->findAll();

        return view('pages/admin/sekolah/edit', [
            'sekolah'       => $sekolah,
            'statistik'     => $statistik,
            'fasilitasMap'  => $fasilitasMap,
            'prestasiList'  => $prestasi,
            'kecamatanList' => $kecamatan,
            'jenisFasilitas' => $jenisFasilitas,
        ]);
    }

    public function update(string $slug)
    {
        $sekolah = $this->sekolahModel->where('slug', $slug)->first();
        // dd($sekolah);

        if (!$sekolah) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Sekolah tidak ditemukan: $slug");
        }

        $sekolahId = $sekolah['id'];

        // ── 1. Validasi field utama ───────────────────────────────────────────────
        $rules = [
            'nama_sekolah'  => "required|min_length[3]|max_length[255]|is_unique[sekolah.nama_sekolah,id,{$sekolahId}]",
            // is_unique dikecualikan untuk record sekolah itu sendiri
            'npsn'          => "required|exact_length[8]|is_unique[sekolah.npsn,id,{$sekolahId}]",
            'nama_kepsek'  => 'required|min_length[5]|max_length[100]',
            'jenjang'       => 'required|in_list[TK,SD,SMP]',
            'status'        => 'required|in_list[Negeri,Swasta]',
            'alamat'        => 'required',
            'luas_lahan'    => 'required',
            'tahun_berdiri' => 'permit_empty|numeric|greater_than[1900]|less_than_equal_to[2100]',
            'latitude'      => 'required|decimal',
            'longitude'     => 'required|decimal',
            // Foto opsional saat update (hanya divalidasi jika ada file baru)
            'foto'          => 'permit_empty|uploaded[foto]|is_image[foto]|max_size[foto,2048]',
        ];

        $errors = [
            'nama_sekolah' => [
                'required'   => 'Nama sekolah wajib diisi.',
                'min_length' => 'Nama sekolah minimal harus 3 karakter.',
                'max_length' => 'Nama sekolah maksimal 255 karakter.',
                'is_unique'  => 'Nama sekolah sudah digunakan.',
            ],
            'npsn' => [
                'required'     => 'NPSN wajib diisi.',
                'exact_length' => 'NPSN harus berukuran tepat 8 karakter.',
                'is_unique'    => 'NPSN sudah terdaftar di sistem.',
            ],
            'nama_kepsek' => [
                'required'   => 'Nama Kepala sekolah wajib diisi.',
                'min_length' => 'Nama Kepala sekolah minimal harus 5 karakter.',
                'max_length' => 'Nama Kepala sekolah maksimal 100 karakter.',
            ],
            'jenjang' => [
                'required' => 'Jenjang sekolah wajib dipilih.',
                'in_list'  => 'Jenjang harus berupa salah satu dari: SD, SMP, SMA.',
            ],
            'status' => [
                'required' => 'Status sekolah wajib dipilih.',
                'in_list'  => 'Status harus berupa Negeri atau Swasta.',
            ],
            'alamat' => [
                'required' => 'Alamat wajib diisi.',
            ],
            'latitude' => [
                'required' => 'Latitude wajib diisi.',
                'decimal'  => 'Format latitude harus berupa angka desimal.',
            ],
            'longitude' => [
                'required' => 'Longitude wajib diisi.',
                'decimal'  => 'Format longitude harus berupa angka desimal.',
            ],
            'luas_lahan' => [
                'required' => 'Luas lahan wajib diisi.',
            ],
            'tahun_berdiri' => [
                'numeric'            => 'Tahun berdiri harus berupa angka.',
                'greater_than'       => 'Tahun berdiri harus lebih besar dari 1900.',
                'less_than_equal_to' => 'Tahun berdiri harus kurang dari atau sama dengan tahun saat ini.',
            ],
            'foto' => [
                'is_image' => 'File harus berupa gambar (jpg, png, gif, webp).',
                'max_size' => 'Ukuran foto maksimal 2MB.',
            ],
        ];

        if (!$this->validate($rules, $errors)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // ── 2. Validasi statistik (sama persis dengan store) ─────────────────────
        $tahunAjaran  = trim($this->request->getPost('tahun_ajaran') ?? '');
        $adaStatistik = $this->request->getPost('jumlah_siswa_l')
            || $this->request->getPost('jumlah_siswa_p')
            || $this->request->getPost('jumlah_guru_tetap')
            || $this->request->getPost('jumlah_guru_honor')
            || $this->request->getPost('jumlah_tenaga_kependidikan')
            || $this->request->getPost('jumlah_rombel');

        if ($adaStatistik && $tahunAjaran === '') {
            return redirect()->back()->withInput()
                ->with('errors', ['tahun_ajaran' => 'Tahun ajaran wajib diisi jika data statistik dimasukkan.']);
        }

        if ($tahunAjaran !== '' && !preg_match('/^\d{4}\/\d{4}$/', $tahunAjaran)) {
            return redirect()->back()->withInput()
                ->with('errors', ['tahun_ajaran' => 'Format tahun ajaran tidak valid. Gunakan format: 2024/2025']);
        }

        // ── 3. Validasi prestasi (sama persis dengan store) ───────────────────────
        $prestasiList   = $this->request->getPost('prestasi') ?? [];
        $prestasiErrors = [];

        foreach ($prestasiList as $i => $item) {
            $nama  = trim($item['nama_prestasi'] ?? '');
            $tahun = trim($item['tahun'] ?? '');

            if ($nama === '' && $tahun === '') continue;

            if ($nama === '') {
                $prestasiErrors["prestasi.{$i}.nama_prestasi"] =
                    'Nama prestasi wajib diisi pada baris ' . ($i + 1) . '.';
            }

            if ($tahun === '') {
                $prestasiErrors["prestasi.{$i}.tahun"] =
                    'Tahun wajib diisi pada baris ' . ($i + 1) . '.';
            }

            if ($tahun !== '' && (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2100)) {
                $prestasiErrors["prestasi.{$i}.tahun"] =
                    'Tahun tidak valid pada baris ' . ($i + 1) . '.';
            }
        }

        if (!empty($prestasiErrors)) {
            return redirect()->back()->withInput()
                ->with('errors', $prestasiErrors);
        }

        // ── 4. Handle upload foto ─────────────────────────────────────────────────
        $fotoName = $sekolah['foto_utama']; // default: tetap pakai foto lama
        $fotoFile = $this->request->getFile('foto');
        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            // Hapus foto lama dari disk jika ada
            if (!empty($sekolah['foto'])) {
                $fotoLamaPath = FCPATH . 'uploads/sekolah/' . $sekolah['foto'];
                if (file_exists($fotoLamaPath)) {
                    unlink($fotoLamaPath);
                }
            }

            // Simpan foto baru
            $fotoName = $fotoFile->getRandomName();
            $fotoFile->move(FCPATH . 'uploads/sekolah/', $fotoName);
        }

        // ── 5. Update data sekolah utama ─────────────────────────────────────────
        $data = [
            'npsn'          => $this->request->getPost('npsn'),
            'nama_kepsek'   => $this->request->getPost('nama_kepsek') ?: null,
            'nama_sekolah'  => $this->request->getPost('nama_sekolah'),
            'jenjang'       => $this->request->getPost('jenjang'),
            'status'        => $this->request->getPost('status'),
            'akreditasi'    => $this->request->getPost('akreditasi'),
            'kurikulum'     => $this->request->getPost('kurikulum'),
            'tahun_berdiri' => $this->request->getPost('tahun_berdiri') ?: null,
            'alamat'        => $this->request->getPost('alamat'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude'),
            'kecamatan_id'  => $this->request->getPost('kecamatan_id') ?: null,
            'telepon'       => $this->request->getPost('telepon') ?: null,
            'email'         => $this->request->getPost('email') ?: null,
            'luas_lahan'         => $this->request->getPost('luas_lahan') ?: null,
            'website'       => $this->request->getPost('website') ?: null,
            'is_active'     => $this->request->getPost('is_active') ? 1 : 0,
            'foto_utama'          => $fotoName,
        ];

        $this->sekolahModel->update($sekolahId, $data);
        $slug = $this->sekolahModel->find($sekolahId)['slug'];

        // ── 6. Upsert statistik ───────────────────────────────────────────────────
        if ($tahunAjaran !== '') {
            $existingStatistik = $this->statistikSekolahModel
                ->where('sekolah_id', $sekolahId)
                ->first();

            $statistikData = [
                'sekolah_id'                 => $sekolahId,
                'tahun_ajaran'               => $tahunAjaran,
                'jumlah_siswa_l'             => (int) ($this->request->getPost('jumlah_siswa_l') ?? 0),
                'jumlah_siswa_p'             => (int) ($this->request->getPost('jumlah_siswa_p') ?? 0),
                'jumlah_guru_tetap'          => (int) ($this->request->getPost('jumlah_guru_tetap') ?? 0),
                'jumlah_guru_honor'          => (int) ($this->request->getPost('jumlah_guru_honor') ?? 0),
                'jumlah_tenaga_kependidikan' => (int) ($this->request->getPost('jumlah_tenaga_kependidikan') ?? 0),
                'jumlah_rombel'              => (int) ($this->request->getPost('jumlah_rombel') ?? 0),
            ];

            if ($existingStatistik) {
                $this->statistikSekolahModel->update($existingStatistik['id'], $statistikData);
            } else {
                $this->statistikSekolahModel->insert($statistikData);
            }
        }

        // ── 7. Fasilitas: delete semua lalu re-insert ─────────────────────────────
        $this->sekolahFasilitasModel->where('sekolah_id', $sekolahId)->delete();

        $fasilitasData = $this->request->getPost('fasilitas') ?? [];
        foreach ($fasilitasData as $item) {
            if (empty($item['jenis_id'])) continue;

            $this->sekolahFasilitasModel->insert([
                'sekolah_id'         => $sekolahId,
                'jenis_fasilitas_id' => (int) $item['jenis_id'],
                'jumlah'             => (int) ($item['jumlah'] ?? 1),
                'kondisi'            => $item['kondisi'] ?? 'Baik',
                'keterangan'         => $item['keterangan'] ?? null,
            ]);
        }

        // ── 8. Prestasi: delete semua lalu re-insert ──────────────────────────────
        $this->prestasiModel->where('sekolah_id', $sekolahId)->delete();

        $prestasiList = $this->request->getPost('prestasi') ?? [];
        foreach ($prestasiList as $item) {
            $namaPrestasi = trim($item['nama_prestasi'] ?? '');
            $tahun        = trim($item['tahun'] ?? '');

            if ($namaPrestasi === '' || $tahun === '') continue;

            $this->prestasiModel->insert([
                'sekolah_id'    => $sekolahId,
                'nama_prestasi' => $namaPrestasi,
                'tingkat'       => $item['tingkat'] ?? 'Sekolah',
                'jenis'         => $item['jenis']   ?? 'Akademik',
                'tahun'         => (int) $tahun,
                'keterangan'    => !empty($item['keterangan']) ? $item['keterangan'] : null,
            ]);
        }

        return redirect()->to('/admin/sekolah/' . $slug . '/detail')
            ->with('success', 'Data sekolah berhasil diperbarui.');
    }

    public function show($slug)
    {
        $sekolah = $this->sekolahModel
            ->select('sekolah.*, kecamatan.nama_kecamatan')
            ->join('kecamatan', 'kecamatan.id = sekolah.kecamatan_id', 'left')
            ->where('sekolah.slug', $slug)
            ->where('sekolah.deleted_at', null)
            ->first();

        // 404 jika tidak ditemukan
        if (!$sekolah) {
            return $this->show404();
        }

        $statistikModel  = new \App\Models\Sekolah\StatistikSekolahModel();
        $fasilitasModel  = new \App\Models\Sekolah\SekolahFasilitasModel();

        // Statistik tahun ajaran terbaru
        $statistik = $statistikModel
            ->where('sekolah_id', $sekolah['id'])
            ->orderBy('tahun_ajaran', 'DESC')
            ->first();

        // Fasilitas + join nama & ikon dari jenis_fasilitas
        $fasilitas = $fasilitasModel
            ->select('sekolah_fasilitas.*, jenis_fasilitas.nama_fasilitas, jenis_fasilitas.ikon')
            ->join('jenis_fasilitas', 'jenis_fasilitas.id = sekolah_fasilitas.jenis_fasilitas_id', 'left')
            ->where('sekolah_id', $sekolah['id'])
            ->findAll();

        $prestasi = $this->prestasiModel
            ->where('sekolah_id', $sekolah['id'])
            ->orderBy('tahun', 'DESC')
            ->findAll();

        return view('pages/admin/sekolah/show', [
            'sekolah'   => $sekolah,
            'statistik' => $statistik,
            'fasilitas' => $fasilitas,
            'prestasi'  => $prestasi,
        ]);
    }

    // Helper 404 yang elegan
    private function show404()
    {
        return view('pages/admin/sekolah/show', [
            'sekolah'   => null,
            'statistik' => null,
            'fasilitas' => [],
        ]);
    }

    public function getData()
    {
        // Hapus blok isAJAX() ini, tidak perlu

        $search  = trim($this->request->getGet('search') ?? '');
        $jenjang = trim($this->request->getGet('jenjang') ?? '');
        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $_GET['page'] = $page;

        $result = $this->sekolahModel->getFiltered($search, $jenjang, $perPage);
        return $this->response
            ->setContentType('application/json')
            ->setJSON([
                'data'        => $result['data'],
                'total'       => $result['total'],
                'perPage'     => $perPage,
                'currentPage' => $page,
                'lastPage'    => $result['pager']->getLastPage(),
            ]);
    }



    public function importStore()
    {
        $file = $this->request->getFile('csv_file');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        if ($file->getClientExtension() !== 'csv') {
            return redirect()->back()->with('error', 'Hanya file .csv yang diperbolehkan.');
        }

        $file->move(WRITEPATH . 'uploads/import');
        $path = WRITEPATH . 'uploads/import/' . $file->getName();

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        helper('text');

        $inserted = 0;
        $skipped  = 0;

        foreach ($csv->getRecords() as $row) {
            $namaSekolah = trim($row['nama_sekolah'] ?? '');

            if (empty($namaSekolah)) {
                $skipped++;
                continue;
            }

            $slug = !empty(trim($row['slug'] ?? ''))
                ? trim($row['slug'])
                : url_title($namaSekolah, '-', true);

            $data = [
                'npsn'          => trim($row['npsn'] ?? '') ?: null,
                'nama_sekolah'  => $namaSekolah,
                'slug'          => $slug,
                'jenjang'       => trim($row['jenjang'] ?? '') ?: null,
                'status'        => trim($row['status'] ?? '') ?: null,
                'akreditasi'    => trim($row['akreditasi'] ?? '') ?: null,
                'kecamatan_id'  => !empty($row['kecamatan_id']) ? (int) $row['kecamatan_id'] : null,
                'nagari_id'     => !empty($row['nagari_id'])    ? (int) $row['nagari_id']    : null,
                'alamat'        => trim($row['alamat'] ?? '') ?: null,
                'latitude'      => trim($row['latitude'] ?? '') ?: null,
                'longitude'     => trim($row['longitude'] ?? '') ?: null,
                'nama_kepsek'   => trim($row['nama_kepsek'] ?? '') ?: null,
                'telepon'       => trim($row['telepon'] ?? '') ?: null,
                'email'         => trim($row['email'] ?? '') ?: null,
                'website'       => trim($row['website'] ?? '') ?: null,
                'foto_utama'    => trim($row['foto_utama'] ?? '') ?: null,
                'kurikulum'     => trim($row['kurikulum'] ?? '') ?: null,
                'tahun_berdiri' => !empty($row['tahun_berdiri']) ? (int) $row['tahun_berdiri'] : null,
                'luas_lahan'    => trim($row['luas_lahan'] ?? '') ?: null,
                'is_active'     => isset($row['is_active']) && $row['is_active'] !== '' ? (int) $row['is_active'] : 1,
            ];

            // Insert sekolah — dapat ID-nya
            $sekolahId = $this->sekolahModel->insert($data, true);

            if (!$sekolahId) {
                $skipped++;
                continue;
            }

            // --- Buat operator_sekolah ---
            $npsn        = $data['npsn'] ?? uniqid('op');
            $username    = 'op_' . $npsn;          // contoh: op_10308727
            $email       = $username . '@sigis.local';
            $rawPassword = $npsn;

            // Safety net: pastikan username unik
            $suffix = 1;
            while ($this->userModel->where('username', $username)->first()) {
                $username = 'op_' . $npsn . '_' . $suffix;
                $email    = $username . '@sigis.local';
                $suffix++;
            }

            $userEntity = new User([
                'username'   => $username,
                'email'      => $email,
                'password'   => $rawPassword,
                'sekolah_id' => $sekolahId,
            ]);

            $this->userModel->save($userEntity);
            $newUser = $this->userModel->findById($this->userModel->getInsertID());

            $newUser->addGroup('operator_sekolah');
            $newUser->activate();

            $inserted++;
        }

        unlink($path);

        if ($inserted === 0) {
            return redirect()->back()->with('error', 'Tidak ada data valid untuk diimport.');
        }

        $msg = "Berhasil import {$inserted} sekolah beserta akun operator.";
        if ($skipped > 0) {
            $msg .= " {$skipped} baris dilewati.";
        }

        return redirect()->route('admin.sekolah')->with('success', $msg);
    }
}
