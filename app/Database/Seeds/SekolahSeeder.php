<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SekolahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'npsn'          => '10302476', // Data Resmi Pusdatin
            'nama_sekolah'  => 'SMAN 1 Batusangkar',
            'slug'          => 'sman-1-batusangkar',
            'jenjang'       => 'SD',
            'status'        => 'Negeri',
            'akreditasi'    => 'A',
            'kecamatan_id'  => 4, // CATATAN: Sesuaikan dengan ID Kecamatan Lima Kaum di tabel kecamatan Anda
            'nagari_id'  => 25, // CATATAN: Sesuaikan dengan ID Nagari Baringin di tabel nagari Anda
            'alamat'        => 'JL. SULTAN ALAM BAGAGARSYAH NO. 41, Kampung Baru, Kel. Baringin, Kec. Lima Kaum, Kab. Tanah Datar, Sumatera Barat',
            'latitude'      => -0.46142100, // Koordinat perkiraan area Batusangkar
            'longitude'     => 100.59723100,
            'nama_kepsek'   => 'Drs. Mulyono, M.Si.', // Kepala Sekolah Aktif
            'telepon'       => '075271046',
            'email'         => 'smansa1batusangkar@gmail.com',
            'website'       => 'https://sman1batusangkar.sch.id',
            'foto_utama'    => null,
            'kurikulum'     => 'Kurikulum Merdeka',
            'tahun_berdiri' => 1954,
            'luas_lahan'    => 4714,
            'is_active'     => 1,
            'created_at'    => Time::now(),
            'updated_at'    => Time::now(),
        ];
        $this->db->table('sekolah')->insert($data);

        // 1. ASUMSI UTAMA: ID Sekolah SMAN 1 Batusangkar di database Anda
        // Silakan sesuaikan ID ini dengan primary key hasil seeder sekolah Anda sebelumnya
        $sekolahId = 1;

        // ==========================================
        // SEEDER: jenis_fasilitas
        // ==========================================
        // ==========================================
        // SEEDER: jenis_fasilitas (Menggunakan Path SVG Tabler Icons)
        // ==========================================
        $jenisFasilitas = [
            [
                'id'             => 1,
                'nama_fasilitas' => 'Ruang Kelas',
                // Icon: door
                'ikon'           => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 12v.01" /><path d="M3 21h18" /><path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />'
            ],
            [
                'id'             => 2,
                'nama_fasilitas' => 'Perpustakaan',
                // Icon: book
                'ikon'           => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6v13" /><path d="M12 6v13" /><path d="M21 6v13" />'
            ],
            [
                'id'             => 3,
                'nama_fasilitas' => 'Laboratorium IPA',
                // Icon: flask
                'ikon'           => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 3h6" /><path d="M10 9h4" /><path d="M10 3v6l-4 7a3.5 3.5 0 0 0 3 5.5h6a3.5 3.5 0 0 0 3 -5.5l-4 -7v-6" />'
            ],
            [
                'id'             => 4,
                'nama_fasilitas' => 'Laboratorium TIK',
                // Icon: device-laptop
                'ikon'           => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19h18" /><path d="M5 6m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z" />'
            ],
            [
                'id'             => 5,
                'nama_fasilitas' => 'Ruang Guru',
                // Icon: users
                'ikon'           => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />'
            ],
            [
                'id'             => 6,
                'nama_fasilitas' => 'Mushalla',
                // Icon: building-mosque
                'ikon'           => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2v3M10 3h4" /><path d="M5 21v-5c0 -2.485 3.134 -4.5 7 -4.5s7 2.015 7 4.5v5" /><path d="M3 21h18" />'
            ],
        ];


        $this->db->table('jenis_fasilitas')->insertBatch($jenisFasilitas);


        // ==========================================
        // SEEDER: sekolah_fasilitas (Data Sarpras SMAN 1 Batusangkar)
        // ==========================================
        $sekolahFasilitas = [
            [
                'sekolah_id'         => $sekolahId,
                'jenis_fasilitas_id' => 1, // Ruang Kelas
                'kondisi'            => 'Baik',
                'jumlah'             => 21,
                'keterangan'         => 'Kondisi ruang belajar mengajar representatif',
            ],
            [
                'sekolah_id'         => $sekolahId,
                'jenis_fasilitas_id' => 2, // Perpustakaan
                'kondisi'            => 'Baik',
                'jumlah'             => 1,
                'keterangan'         => 'Perpustakaan sekolah digital dan fisik',
            ],
            [
                'sekolah_id'         => $sekolahId,
                'jenis_fasilitas_id' => 3, // Laboratorium IPA
                'kondisi'            => 'Baik',
                'jumlah'             => 1,
                'keterangan'         => 'Laboratorium penunjang praktikum sains',
            ],
            [
                'sekolah_id'         => $sekolahId,
                'jenis_fasilitas_id' => 4, // Laboratorium TIK
                'kondisi'            => 'Baik',
                'jumlah'             => 4,
                'keterangan'         => 'Digunakan untuk asesmen berbasis komputer',
            ],
            [
                'sekolah_id'         => $sekolahId,
                'jenis_fasilitas_id' => 5, // Ruang Guru
                'kondisi'            => 'Baik',
                'jumlah'             => 1,
                'keterangan'         => 'Ruang majelis guru utama',
            ],
            [
                'sekolah_id'         => $sekolahId,
                'jenis_fasilitas_id' => 6, // Mushalla
                'kondisi'            => 'Baik',
                'jumlah'             => 1,
                'keterangan'         => 'Sarana ibadah warga sekolah',
            ],
        ];

        $this->db->table('sekolah_fasilitas')->insertBatch($sekolahFasilitas);


        // ==========================================
        // SEEDER: statistik_sekolah (Data Riil Dapodik Kemendikbud)
        // ==========================================
        $statistikSekolah = [
            [
                'sekolah_id'                 => $sekolahId,
                'tahun_ajaran'               => '2024/2025',
                'jumlah_siswa_l'            => 378,
                'jumlah_siswa_p'            => 619, // Total Siswa PD: 997
                'jumlah_guru_tetap'         => 46,  // Termasuk PNS & PPPK
                'jumlah_guru_honor'         => 0,
                'jumlah_tenaga_kependidikan' => 12,  // Pegawai Tata Usaha / Tendik
                'jumlah_rombel'             => 29,  // Total 29 Rombongan Belajar
                'created_at'                 => Time::now(),
                'updated_at'                 => Time::now(),
            ]
        ];

        $this->db->table('statistik_sekolah')->insertBatch($statistikSekolah);


        // ==========================================
        // SEEDER: prestasi (Data Historis SMAN 1 Batusangkar)
        // ==========================================
        $prestasi = [
            [
                'sekolah_id'    => $sekolahId,
                'nama_prestasi' => 'Paskibraka Nasional di Istana Negara',
                'tingkat'       => 'Nasional',
                'jenis'         => 'Non-Akademik',
                'tahun'         => 2017,
                'keterangan'    => 'Siswa terpilih mewakili Provinsi Sumatera Barat menjadi anggota Paskibraka Nasional',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'sekolah_id'    => $sekolahId,
                'nama_prestasi' => 'Juara 3 Lomba Karya Tulis Ilmiah (LKTI) Fakultas Kedokteran UNAND',
                'tingkat'       => 'Provinsi',
                'jenis'         => 'Akademik',
                'tahun'         => 2017,
                'keterangan'    => 'Meraih podium kompetisi karya ilmiah remaja tingkat Sumatera Barat',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'sekolah_id'    => $sekolahId,
                'nama_prestasi' => 'Lolos Seleksi Perguruan Tinggi Negeri (PTN) Favorit',
                'tingkat'       => 'Nasional',
                'jenis'         => 'Akademik',
                'tahun'         => 2025,
                'keterangan'    => 'Kelulusan siswa menembus angka 95% masuk ke PTN favorit melalui jalur prestasi dan tes',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
        ];

        $this->db->table('prestasi')->insertBatch($prestasi);
    }
}
