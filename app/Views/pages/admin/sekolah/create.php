<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 overflow-y-auto p-6 pt-12 md:p-8 md:pt-12 space-y-8">
    <div class="flex flex-col md:flex-row justify-between gap-x-12 gap-y-4">
        <div>
            <h1 class="text-3xl font-extrabold text-foreground">Tambah Data Sekolah</h1>
            <p class="text-sm font-medium text-muted-foreground mt-1">Lengkapi formulir di bawah ini untuk menambahkan institusi baru ke sistem.</p>
        </div>
        <div class="flex w-fit gap-3 items-center self-end">
            <button class="px-6 py-2.5 rounded-xl border border-border text-slate-600 font-bold text-sm hover:bg-slate-50 transition-all">
                Batal
            </button>
            <button form="form-sekolah" type="submit" class="inline-flex items-center w-fit whitespace-nowrap px-6 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                Simpan Data
            </button>
        </div>
    </div>
    <form id="form-sekolah" action="<?= url_to('admin.sekolah.store') ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
        <?= csrf_field() ?>
        <!-- Form Header with Toggle -->
        <div class="bg-white/80 backdrop-blur-md border border-white/30 p-4.5 md:p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-muted-foreground opacity-60 leading-none mb-1">KONFIGURASI AWAL</p>
                    <h2 class="text-lg font-bold">Status Keaktifan Sekolah</h2>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-slate-600">Status Aktif</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input name="is_active" checked="" class="sr-only peer" type="checkbox" />
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </label>
            </div>
        </div>
        <!-- Section 1: Identitas Sekolah -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-4.5 md:p-8 rounded-2xl md:rounded-4xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="identity">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-xl font-bold">Identitas Sekolah</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                <div class="lg:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">NAMA SEKOLAH <span class="text-red-500 text-xs">*</span></label>
                    <input name="nama_sekolah" value="<?= old('nama_sekolah') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Masukkan nama resmi sekolah" type="text" />
                    <?php if (session('errors.nama_sekolah')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.nama_sekolah') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">NPSN (8 DIGIT) <span class="text-red-500 text-xs">*</span></label>
                    <input name="npsn" value="<?= old('npsn') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Contoh: 12345678" type="number" />
                    <?php if (session('errors.npsn')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.npsn') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">KEPALA SEKOLAH <span class="text-red-500 text-xs">*</span></label>
                    <input name="nama_kepsek" value="<?= old('nama_kepsek') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Contoh: Budiono Siregar" type="text" />
                    <?php if (session('errors.nama_kepsek')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.nama_kepsek') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">JENJANG <span class="text-red-500 text-xs">*</span></label>
                    <select name="jenjang" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option value="TK" <?= old('jenjang') == 'TK' ? 'selected' : '' ?>>TK</option>
                        <option value="SD" <?= old('jenjang') == 'SD' ? 'selected' : '' ?>>SD</option>
                        <option value="SMP" <?= old('jenjang') == 'SMP' ? 'selected' : '' ?>>SMP</option>
                    </select>
                    <?php if (session('errors.jenjang')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.jenjang') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">STATUS <span class="text-red-500 text-xs">*</span></label>
                    <select name="status" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <!-- Fungsi old() CI4 mengembalikan string, sangat cocok dengan operator ternary -->
                        <option value="Negeri" <?= old('status') === 'Negeri' ? 'selected' : '' ?>>Negeri</option>
                        <option value="Swasta" <?= old('status') === 'Swasta' ? 'selected' : '' ?>>Swasta</option>
                    </select>

                    <?php if (session('errors.status')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.status') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">AKREDITASI</label>
                    <select name="akreditasi" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option value="A" <?= old('akreditasi') === 'A' ? 'selected' : '' ?>>A</option>
                        <option value="B" <?= old('akreditasi') === 'B' ? 'selected' : '' ?>>B</option>
                        <option value="C" <?= old('akreditasi') === 'C' ? 'selected' : '' ?>>C</option>
                        <option value="Belum Terakreditasi" <?= old('akreditasi') === 'Belum Terakreditasi' ? 'selected' : '' ?>>Belum Terakreditasi</option>
                    </select>

                    <?php if (session('errors.akreditasi')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.akreditasi') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">KURIKULUM</label>
                    <select name="kurikulum" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option value="Merdeka" <?= old('kurikulum') === 'Merdeka' ? 'selected' : '' ?>>Merdeka</option>
                        <option value="K13" <?= old('kurikulum') === 'K13' ? 'selected' : '' ?>>K13</option>
                    </select>
                </div>
                <?php
                /*
                
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN BERDIRI</label>
                    <input name="tahun_berdiri" value="<?= old('tahun_berdiri') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Contoh: 1995" type="number" />
                    <?php if (session('errors.tahun_berdiri')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.tahun_berdiri') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">LUAS LAHAN <span class="text-red-500 text-xs">*</span></label>
                    <input name="luas_lahan" value="<?= old('luas_lahan') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Contoh: 4995" type="number" />
                    <?php if (session('errors.luas_lahan')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.luas_lahan') ?></p>
                    <?php endif; ?>
                </div>
                    */
                ?>
                <!-- Foto Sekolah -->
                <div class="lg:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">
                        FOTO SEKOLAH <span class="text-red-500">*</span>
                    </label>

                    <!-- Hidden File Input -->
                    <input
                        id="foto-input"
                        type="file"
                        name="foto"
                        accept="image/*"
                        class="hidden">

                    <!-- Preview -->
                    <label
                        for="foto-input"
                        id="foto-preview-wrapper"
                        class="group relative block w-full aspect-video overflow-hidden rounded-2xl border border-slate-200 bg-slate-100 cursor-pointer">

                        <!-- Placeholder -->
                        <div
                            id="foto-placeholder"
                            class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">

                            <span class="material-symbols-outlined text-5xl text-slate-400">
                                school
                            </span>

                        </div>

                        <!-- Preview Image -->
                        <img
                            id="foto-preview-img"
                            class="hidden w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                            alt="Preview Foto">

                        <!-- Overlay -->
                        <div
                            class="absolute inset-0 bg-black/0 group-hover:bg-black/45 transition-all duration-300 flex items-center justify-center">

                            <div
                                class="text-center text-white opacity-0 group-hover:opacity-100 transition duration-300">

                                <span class="material-symbols-outlined text-5xl">
                                    add_a_photo
                                </span>

                                <p class="mt-3 font-semibold">
                                    Klik untuk memilih foto sekolah
                                </p>

                                <p class="mt-1 text-xs text-white/80">
                                    JPG, PNG, WEBP • Maks. 2 MB
                                </p>

                            </div>

                        </div>

                    </label>

                    <p id="foto-selected-name" class="mt-3 text-sm text-slate-500">
                        Belum ada foto yang dipilih.
                    </p>

                    <?php if (session('errors.foto')): ?>
                        <p class="mt-2 text-xs font-medium text-red-500">
                            <?= session('errors.foto') ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-4.5 md:p-8 rounded-2xl md:rounded-4xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="profile">

            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-xl font-bold">Profil Sekolah</h2>
            </div>

            <div class="grid grid-cols-1 gap-6">

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">
                        VISI
                    </label>

                    <textarea
                        name="visi"
                        rows="4"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Masukkan visi sekolah"><?= old('visi') ?></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">
                        MISI
                    </label>

                    <textarea
                        name="misi"
                        rows="6"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Masukkan misi sekolah"><?= old('misi') ?></textarea>
                </div>

            </div>

        </section>

        <!-- Section 2: Lokasi & Kontak -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-4.5 md:p-8 rounded-2xl md:rounded-4xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="location">
            <div class="flex items-center gap-3 mb-8">

                <h2 class="text-xl font-bold">Lokasi &amp; Kontak</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">ALAMAT LENGKAP <span class="text-red-500 text-xs">*</span></label>
                    <textarea name="alamat" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Jl. Raya Pendidikan No. 123..." rows="3"><?= old('alamat') ?></textarea>
                    <?php if (session('errors.alamat')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.alamat') ?></p>
                    <?php endif; ?>
                </div>
                <div class="md:col-span-2 space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">PENENTUAN LOKASI (MAP)</label>
                    <div class="relative w-full aspect-16/7 bg-slate-100 rounded-4xl border border-slate-200 overflow-hidden flex items-center justify-center group cursor-pointer">
                        <!-- Stylized Map Background (Grid Pattern) -->
                        <div class="absolute inset-0 z-0">

                            <div id="map" class="w-full h-full"></div>
                        </div>
                        <!-- Map Marker -->
                        <!-- <div class="relative flex flex-col z-50 items-center transition-transform group-hover:scale-110">
                            <span class="material-symbols-outlined text-red-500 text-5xl" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            <div class="w-4 h-1 bg-black/10 rounded-full blur-[2px] mt-1"></div>
                        </div> -->
                        <!-- Map Overlay Info -->
                        <div
                            class="absolute bottom-4 left-1/2 -translate-x-1/2 z-[999] cursor-pointer"
                            id="btn-pinpoint">

                            <p
                                id="btn-pinpoint-label"
                                class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm border border-white/50 text-[10px] font-bold text-slate-600 flex items-center gap-2 transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary">

                                <span class="material-symbols-outlined text-sm">
                                    ads_click
                                </span>

                                KLIK UNTUK PIN POINT

                            </p>

                        </div>
                    </div>
                    <p class="text-xs font-medium text-slate-500 italic">Klik pada peta untuk menyesuaikan koordinat secara otomatis</p>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">LATITUDE <span class="text-red-500 text-xs">*</span></label>
                    <input name="latitude" id="lat-input" value="<?= old('latitude') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="-6.12345" type="text" />
                    <?php if (session('errors.latitude')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.latitude') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">LONGITUDE <span class="text-red-500 text-xs">*</span></label>
                    <input name="longitude" id="lng-input" value="<?= old('longitude') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="106.12345" type="text" />
                    <?php if (session('errors.longitude')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.longitude') ?></p>
                    <?php endif; ?>
                </div>
                <!-- <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">KECAMATAN</label>
                    <input class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Masukkan nama kecamatan" type="text" />
                </div> -->

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">KECAMATAN</label>
                    <select name="kecamatan_id" id="kecamatan-select"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium 
                   focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option value="">-- Pilih atau pin lokasi --</option>
                        <?php foreach ($kecamatanList as $kec): ?>
                            <option value="<?= $kec['id'] ?>"
                                data-geojson="<?= $kec['geojson_file'] ?>"
                                data-name="<?= esc($kec['nama_kecamatan']) ?>"
                                <?= old('kecamatan_id') == $kec['id'] ? 'selected' : '' ?>>
                                <?= esc($kec['nama_kecamatan']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (session('errors.kecamatan_id')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.kecamatan_id') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">NOMOR TELEPON</label>
                    <input name="telepon" value="<?= old('telepon') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="(021) 555-0123" type="tel" />
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">EMAIL SEKOLAH</label>
                    <input name="email" value="<?= old('email') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="kontak@sekolah.sch.id" type="email" />
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">WEBSITE</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-slate-400 text-sm font-medium">https://</span>
                        <input name="website" value="<?= old('website') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 pl-16 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="www.sekolah.sch.id" type="text" />
                    </div>
                </div>
            </div>
        </section>
        <?php /*
        <!-- Section 3: Data Statistik -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] h-fit" id="statistics">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-xl font-bold">Data Statistik</h2>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN AJARAN <span class="text-red-500 text-xs">*</span></label>
                    <input name="tahun_ajaran" value="<?= old('tahun_ajaran') ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        placeholder="Contoh: 2024/2025" type="text" />
                    <?php if (session('errors.tahun_ajaran')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.tahun_ajaran') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">SISWA LAKI-LAKI</label>
                    <input name="jumlah_siswa_l" value="<?= old('jumlah_siswa_l', 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">SISWA PEREMPUAN</label>
                    <input name="jumlah_siswa_p" value="<?= old('jumlah_siswa_p', 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">GURU TETAP</label>
                    <input name="jumlah_guru_tetap" value="<?= old('jumlah_guru_tetap', 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">GURU HONOR</label>
                    <input name="jumlah_guru_honor" value="<?= old('jumlah_guru_honor', 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">TENAGA KEPENDIDIKAN</label>
                    <input name="jumlah_tenaga_kependidikan" value="<?= old('jumlah_tenaga_kependidikan', 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">JUMLAH ROMBEL</label>
                    <input name="jumlah_rombel" value="<?= old('jumlah_rombel', 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
            </div>
        </section>
        <div class="grid grid-cols-1 gap-8">

            <!-- Section 4: Fasilitas -->
            <section class="bg-white/80 backdrop-blur-md border h-fit flex flex-col border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="facilities">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-xl font-bold">Fasilitas</h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 w-full gap-3">
                    <?php foreach ($jenisFasilitas as $fasilitas): ?>
                        <?php
                        // Cek apakah fasilitas ini sudah ada di data lama (untuk repopulasi setelah validation error)
                        $oldFasilitas = old('fasilitas') ?? [];
                        $isChecked = in_array((string) $fasilitas['id'], array_column($oldFasilitas, 'jenis_id'));
                        $oldData = [];
                        foreach ($oldFasilitas as $of) {
                            if ((string)$of['jenis_id'] === (string)$fasilitas['id']) {
                                $oldData = $of;
                                break;
                            }
                        }
                        ?>
                        <div class="border border-slate-200 rounded-xl overflow-hidden h-fit">
                            <!-- Checkbox Row -->
                            <label class="flex items-center gap-3 px-4 py-3 cursor-pointer group hover:bg-slate-50 transition-colors">
                                <input
                                    type="checkbox"
                                    class="fasilitas-toggle w-5 h-5 appearance-none rounded border border-slate-300 checked:bg-primary checked:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all flex items-center justify-center after:content-['✓'] after:text-white after:text-xs after:hidden checked:after:block"
                                    data-target="fasilitas-detail-<?= $fasilitas['id'] ?>"
                                    <?= $isChecked ? 'checked' : '' ?> />
                                <span class="text-sm font-semibold text-slate-700 group-hover:text-primary transition-colors flex-1">
                                    <?= esc($fasilitas['nama_fasilitas']) ?>
                                </span>
                                <span class="material-symbols-outlined text-slate-400 text-base fasilitas-chevron transition-transform <?= $isChecked ? 'rotate-180' : '' ?>">
                                    expand_more
                                </span>
                            </label>

                            <!-- Detail Fields (hidden by default) -->
                            <div id="fasilitas-detail-<?= $fasilitas['id'] ?>"
                                class="fasilitas-detail <?= $isChecked ? '' : 'hidden' ?> border-t border-slate-100 bg-slate-50/60 px-4 py-4">
                                <!-- Hidden field untuk jenis_id -->
                                <input type="hidden" name="fasilitas[<?= $fasilitas['id'] ?>][jenis_id]" value="<?= $fasilitas['id'] ?>">

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Jumlah -->
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-500 mb-1">Jumlah</label>
                                        <input
                                            type="number"
                                            name="fasilitas[<?= $fasilitas['id'] ?>][jumlah]"
                                            value="<?= esc($oldData['jumlah'] ?? 1) ?>"
                                            min="1"
                                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white" />
                                    </div>

                                    <!-- Kondisi -->
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-500 mb-1">Kondisi</label>
                                        <select
                                            name="fasilitas[<?= $fasilitas['id'] ?>][kondisi]"
                                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                                            <?php foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k): ?>
                                                <option value="<?= $k ?>" <?= ($oldData['kondisi'] ?? 'Baik') === $k ? 'selected' : '' ?>>
                                                    <?= $k ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Keterangan -->
                                    <div class="col-span-2">
                                        <label class="block text-xs font-semibold text-slate-500 mb-1">Keterangan <span class="font-normal text-slate-400">(opsional)</span></label>
                                        <input
                                            type="text"
                                            name="fasilitas[<?= $fasilitas['id'] ?>][keterangan]"
                                            value="<?= esc($oldData['keterangan'] ?? '') ?>"
                                            placeholder="Contoh: Butuh perbaikan atap"
                                            class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>


        </div>
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-4.5 md:p-8 rounded-2xl md:rounded-4xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="achivment">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
                </div>
                <h2 class="text-xl font-bold">Prestasi</h2>
            </div>

            <div id="prestasi-container" class="flex flex-col gap-6">
                <!-- Mengambil data lama (old input) jika ada, jika tidak, minimal tampilkan 1 baris (index 0) -->
                <?php
                $oldPrestasi = old('prestasi') ?? [[]];
                foreach ($oldPrestasi as $i => $item):
                    $errors = session('errors') ?? [];
                ?>
                    <div class="prestasi-item lg:col-span-4 flex flex-col gap-6 p-6 bg-white/50 rounded-2xl border border-slate-100 relative">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

                            <!-- Nama Prestasi -->
                            <div class="md:col-span-6">
                                <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">NAMA PRESTASI</label>
                                <input name="prestasi[<?= $i ?>][nama_prestasi]"
                                    value="<?= esc($item['nama_prestasi'] ?? '') ?>"
                                    class="w-full bg-slate-50 <?= isset($errors["prestasi.{$i}.nama_prestasi"]) ? 'border-red-500 focus:ring-red-200' : 'border-border' ?> rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                                    placeholder="Masukkan nama prestasi" type="text">

                                <!-- Tampilkan Pesan Error -->
                                <?php if (isset($errors["prestasi.{$i}.nama_prestasi"])): ?>
                                    <p class="text-xs text-red-500 mt-1"><?= $errors["prestasi.{$i}.nama_prestasi"] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Tingkat -->
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">TINGKAT</label>
                                <select name="prestasi[<?= $i ?>][tingkat]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                                    <?php $currTingkat = $item['tingkat'] ?? ''; ?>
                                    <option <?= $currTingkat == 'Sekolah' ? 'selected' : '' ?>>Sekolah</option>
                                    <option <?= $currTingkat == 'Kecamatan' ? 'selected' : '' ?>>Kecamatan</option>
                                    <option <?= $currTingkat == 'Kabupaten' ? 'selected' : '' ?>>Kabupaten</option>
                                    <option <?= $currTingkat == 'Provinsi' ? 'selected' : '' ?>>Provinsi</option>
                                    <option <?= $currTingkat == 'Nasional' ? 'selected' : '' ?>>Nasional</option>
                                    <option <?= $currTingkat == 'Internasional' ? 'selected' : '' ?>>Internasional</option>
                                </select>
                            </div>

                            <!-- Jenis -->
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">JENIS</label>
                                <select name="prestasi[<?= $i ?>][jenis]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                                    <?php $currJenis = $item['jenis'] ?? ''; ?>
                                    <option <?= $currJenis == 'Akademik' ? 'selected' : '' ?>>Akademik</option>
                                    <option <?= $currJenis == 'Non-Akademik' ? 'selected' : '' ?>>Non-Akademik</option>
                                    <option <?= $currJenis == 'Olahraga' ? 'selected' : '' ?>>Olahraga</option>
                                    <option <?= $currJenis == 'Seni' ? 'selected' : '' ?>>Seni</option>
                                </select>
                            </div>

                            <!-- Tahun -->
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN</label>
                                <input name="prestasi[<?= $i ?>][tahun]"
                                    value="<?= esc($item['tahun'] ?? '') ?>"
                                    class="w-full bg-slate-50 <?= isset($errors["prestasi.{$i}.tahun"]) ? 'border-red-500 focus:ring-red-200' : 'border-border' ?> rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                                    placeholder="Contoh: 2023" type="number">

                                <!-- Tampilkan Pesan Error -->
                                <?php if (isset($errors["prestasi.{$i}.tahun"])): ?>
                                    <p class="text-xs text-red-500 mt-1"><?= $errors["prestasi.{$i}.tahun"] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Keterangan -->
                            <div class="md:col-span-7">
                                <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">KETERANGAN</label>
                                <textarea name="prestasi[<?= $i ?>][keterangan]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Tambahkan detail prestasi..." rows="1"><?= esc($item['keterangan'] ?? '') ?></textarea>
                            </div>

                            <!-- Tombol Hapus -->
                            <div class="md:col-span-2 flex items-end justify-end">
                                <button type="button" onclick="removePrestasi(this)" class="flex items-center gap-2 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors text-sm font-bold w-full justify-center border border-transparent hover:border-red-100">
                                    <span class="material-symbols-outlined text-lg">delete</span> Hapus
                                </button>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <div class="mt-8 pt-6 border-t border-slate-100 flex justify-center">
                <button type="button" onclick="addPrestasi()"
                    class="flex items-center gap-2 px-8 py-4 rounded-2xl border-2 border-dashed border-slate-200 text-slate-500 font-bold text-sm hover:border-primary hover:text-primary hover:bg-primary/5 hover:scale-[1.01] transition-all w-full justify-center group">
                    <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">add_circle</span>
                    Tambah Prestasi Baru
                </button>
            </div>
        </section>
         */ ?>
    </form>
    <div class="h-8"></div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const map = L.map('map', {
            zoomControl: false,
            preferCanvas: true,
            minZoom: 10,
            maxZoom: 18
        }).setView([-0.4555, 100.5771], 12);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
        }).addTo(map);

        window.addEventListener('load', () => map.invalidateSize());

        const kecamatanGeojson = <?= json_encode($kecamatan_geojson) ?>;

        const kecamatanSelect = document.getElementById('kecamatan-select');

        let marker = null;
        let pinActive = false;
        let activeLayer = null;

        const polygonLayers = [];

        const btnPin = document.getElementById('btn-pinpoint');
        const btnPinLabel = document.getElementById('btn-pinpoint-label');

        // ── Gambar semua polygon kecamatan langsung ke map ──────────────────────
        kecamatanGeojson.forEach(kec => {

            const layer = L.geoJSON(kec.geojson, {
                style: {
                    color: kec.warna,
                    fillColor: kec.warna,
                    fillOpacity: 0.12,
                    weight: 2
                },
                onEachFeature(feature, l) {
                    l.on('mouseover', function() {
                        this.setStyle({
                            weight: 3,
                            fillOpacity: 0.2
                        });
                        this.bringToFront();
                    });
                    l.on('mouseout', function() {
                        // Jangan reset kalau ini layer yang lagi aktif (terpilih)
                        if (this !== activeLayer) {
                            this.setStyle(this.defaultStyle);
                        }
                    });
                }
            }).addTo(map);

            layer.eachLayer(poly => {
                poly.kecamatan_id = kec.id;
                poly.defaultStyle = {
                    color: kec.warna,
                    fillColor: kec.warna,
                    fillOpacity: 0.12,
                    weight: 2
                };
                polygonLayers.push(poly);
            });

        });

        if (polygonLayers.length) {
            map.fitBounds(L.featureGroup(polygonLayers).getBounds(), {
                padding: [50, 50],
                maxZoom: 16
            });
            map.once('moveend', () => map.setMinZoom(map.getZoom()));
        }

        // ── Ray-casting point-in-polygon ────────────────────────────────────────
        function pointInPolygon(point, geometry) {
            const rings = geometry.type === 'Polygon' ?
                geometry.coordinates :
                geometry.type === 'MultiPolygon' ?
                geometry.coordinates.flat(1) : [];

            let inside = false;
            const [px, py] = point;

            for (const ring of rings) {
                for (let i = 0, j = ring.length - 1; i < ring.length; j = i++) {
                    const [xi, yi] = ring[i];
                    const [xj, yj] = ring[j];
                    const intersect = ((yi > py) !== (yj > py)) &&
                        (px < (xj - xi) * (py - yi) / (yj - yi) + xi);
                    if (intersect) inside = !inside;
                }
            }
            return inside;
        }

        // ── Deteksi kecamatan dari titik (menggantikan detectKecamatan + isInsideKabupaten) ──
        function detectKecamatan(lat, lng) {
            const point = [lng, lat]; // GeoJSON: [lng, lat]

            let ditemukan = false;

            polygonLayers.forEach(poly => {
                if (ditemukan) return;

                const geo = poly.toGeoJSON().geometry;

                if (pointInPolygon(point, geo)) {
                    ditemukan = true;

                    kecamatanSelect.value = poly.kecamatan_id;

                    if (activeLayer) {
                        activeLayer.setStyle(activeLayer.defaultStyle);
                    }

                    poly.setStyle({
                        weight: 4,
                        fillOpacity: 0.35
                    });
                    activeLayer = poly;

                    // Visual feedback pada select (tetap seperti punya kamu)
                    kecamatanSelect.classList.add('!border-green-400', '!bg-green-50');
                    setTimeout(() => kecamatanSelect.classList.remove('!border-green-400', '!bg-green-50'), 1500);
                }
            });

            if (!ditemukan) {
                kecamatanSelect.value = '';

                if (activeLayer) {
                    activeLayer.setStyle(activeLayer.defaultStyle);
                    activeLayer = null;
                }
            }

            return ditemukan;
        }

        // ── Marker & mode pin ────────────────────────────────────────────────
        const pinIcon = L.divIcon({
            className: 'custom-pin',

            html: `
        <div class="relative flex flex-col items-center">

            <span
                class="material-symbols-outlined text-red-500"
                style="
                    font-size:42px;
                    font-variation-settings:'FILL' 1;
                    line-height:1;
                    filter:drop-shadow(0 3px 6px rgba(0,0,0,.35));
                ">
                location_on
            </span>

            <div
                class="absolute rounded-full"
                style="
                    width:14px;
                    height:14px;
                    bottom:-2px;
                    background:rgba(0,0,0,.18);
                    filter:blur(3px);
                ">
            </div>

        </div>
    `,

            iconSize: [42, 42],
            iconAnchor: [21, 42]
        });

        // ── Update tampilan tombol pin ──────────────────────────────────────────
        function updatePinButton() {

            if (pinActive) {

                btnPinLabel.className =
                    "bg-primary backdrop-blur-sm px-4 py-2 rounded-full shadow-lg shadow-primary/30 border border-primary text-[10px] font-bold text-white flex items-center gap-2 transition-all duration-300 scale-105";

                btnPinLabel.innerHTML = `
            <span class="material-symbols-outlined text-sm animate-pulse">
                location_on
            </span>
            MODE PIN AKTIF
        `;

            } else {

                btnPinLabel.className =
                    "bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm border border-white/50 text-[10px] font-bold text-slate-600 flex items-center gap-2 transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary";

                btnPinLabel.innerHTML = `
            <span class="material-symbols-outlined text-sm">
                ads_click
            </span>
            KLIK UNTUK PIN POINT
        `;

            }

        }

        btnPin.addEventListener('click', () => {
            pinActive = !pinActive;
            map.getContainer().style.cursor = pinActive ? 'crosshair' : '';
            updatePinButton();
        });

        updatePinButton();

        map.on('click', function(e) {
            if (!pinActive) return;
            const {
                lat,
                lng
            } = e.latlng;

            const ditemukan = detectKecamatan(lat, lng);

            if (!ditemukan) {
                document.getElementById('lat-input').value = '';
                document.getElementById('lng-input').value = '';

                if (marker) {
                    map.removeLayer(marker);
                    marker = null;
                }

                L.popup({
                        closeButton: false,
                        autoClose: true,
                        closeOnClick: true,
                        className: 'popup-warning'
                    })
                    .setLatLng(e.latlng)
                    .setContent(`
        <div style="text-align:center;min-width:180px;padding:12px;">
            <b style="color:#dc2626;">⚠ Lokasi di luar wilayah</b><br>
            <small>Silakan pilih lokasi di dalam batas kecamatan.</small>
        </div>
    `)
                    .openOn(map);

                return;
            }

            document.getElementById('lat-input').value = lat.toFixed(6);
            document.getElementById('lng-input').value = lng.toFixed(6);

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng, {
                    icon: pinIcon
                }).addTo(map);
            }

            pinActive = false;
            map.getContainer().style.cursor = '';
            updatePinButton();
        });

        // ── Input manual lat/lng ──────────────────────────────────────────────
        function tryDetectFromInputs() {
            const lat = parseFloat(document.getElementById('lat-input').value);
            const lng = parseFloat(document.getElementById('lng-input').value);
            if (isNaN(lat) || isNaN(lng)) return;

            const ditemukan = detectKecamatan(lat, lng);

            if (!ditemukan) {
                L.popup({
                        closeButton: false,
                        autoClose: true,
                        closeOnClick: true,
                        className: 'popup-warning'
                    })
                    .setLatLng([lat, lng])
                    .setContent(`
        <div style="text-align:center;min-width:180px;padding:12px;">
            <b style="color:#dc2626;">⚠ Lokasi di luar wilayah</b><br>
            <small>Silakan pilih lokasi di dalam batas kecamatan.</small>
        </div>
    `)
                    .openOn(map);

                return;
            }

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], {
                    icon: pinIcon
                }).addTo(map);
            }

            map.setView([lat, lng], map.getZoom());
        }

        document.getElementById('lat-input').addEventListener('change', tryDetectFromInputs);
        document.getElementById('lng-input').addEventListener('change', tryDetectFromInputs);


    });
</script>

<script>
    // Dinamis mengambil jumlah baris yang dirender oleh PHP
    let prestasiIndex = document.querySelectorAll('.prestasi-item').length;

    function addPrestasi() {
        const i = prestasiIndex++;
        const html = `
        <div class="prestasi-item lg:col-span-4 flex flex-col gap-6 p-6 bg-white/50 rounded-2xl border border-slate-100 relative">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="md:col-span-6">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">NAMA PRESTASI</label>
                    <input name="prestasi[${i}][nama_prestasi]"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Masukkan nama prestasi" type="text">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">TINGKAT</label>
                    <select name="prestasi[${i}][tingkat]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option>Sekolah</option>
                        <option>Kecamatan</option>
                        <option>Kabupaten</option>
                        <option>Provinsi</option>
                        <option>Nasional</option>
                        <option>Internasional</option>
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">JENIS</label>
                    <select name="prestasi[${i}][jenis]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option>Akademik</option>
                        <option>Non-Akademik</option>
                        <option>Olahraga</option>
                        <option>Seni</option>
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN</label>
                    <input name="prestasi[${i}][tahun]"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Contoh: 2023" type="number">
                </div>
                <div class="md:col-span-7">
                    <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">KETERANGAN</label>
                    <textarea name="prestasi[${i}][keterangan]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Tambahkan detail prestasi..." rows="1"></textarea>
                </div>
                <div class="md:col-span-2 flex items-end justify-end">
                    <button type="button" onclick="removePrestasi(this)" class="flex items-center gap-2 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors text-sm font-bold w-full justify-center border border-transparent hover:border-red-100">
                        <span class="material-symbols-outlined text-lg">delete</span> Hapus
                    </button>
                </div>
            </div>
        </div>`;
        document.getElementById('prestasi-container').insertAdjacentHTML('beforeend', html);
    }

    function removePrestasi(btn) {
        const items = document.querySelectorAll('.prestasi-item');
        if (items.length <= 1) return;
        btn.closest('.prestasi-item').remove();
    }

    document.querySelectorAll('.fasilitas-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const targetId = this.dataset.target;
            const detail = document.getElementById(targetId);
            const chevron = this.closest('label').querySelector('.fasilitas-chevron');

            if (this.checked) {
                detail.classList.remove('hidden');
                chevron?.classList.add('rotate-180');
            } else {
                detail.classList.add('hidden');
                chevron?.classList.remove('rotate-180');
            }
        });
    });

    // Preview foto sebelum submit
    const sekolahFotoInput = document.getElementById('foto-input');
    const sekolahFotoPreview = document.getElementById('foto-preview-img');
    const sekolahFotoPlaceholder = document.getElementById('foto-placeholder');
    const sekolahFotoName = document.getElementById('foto-selected-name');

    sekolahFotoInput.addEventListener('change', function() {

        const selectedFoto = this.files[0];

        if (!selectedFoto) {
            return;
        }

        const sekolahFotoReader = new FileReader();

        sekolahFotoReader.onload = function(e) {

            sekolahFotoPreview.src = e.target.result;
            sekolahFotoPreview.classList.remove('hidden');

            sekolahFotoPlaceholder.classList.add('hidden');

            sekolahFotoName.innerHTML =
                `<span class="font-medium text-green-600">Foto dipilih:</span> ${selectedFoto.name}`;

        };

        sekolahFotoReader.readAsDataURL(selectedFoto);

    });
</script>

<?= $this->endSection(); ?>