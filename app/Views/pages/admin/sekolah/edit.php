<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 overflow-y-auto p-8 space-y-8">
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-extrabold text-foreground">Edit Data Sekolah</h1>
            <p class="text-sm font-medium text-muted-foreground mt-1">Perbarui informasi institusi yang sudah terdaftar di sistem.</p>
        </div>
        <div class="flex gap-3">
            <a href="<?= url_to('admin.sekolah.show', $sekolah['slug']) ?>"
                class="px-6 py-2.5 rounded-xl border border-border text-slate-600 font-bold text-sm hover:bg-slate-50 transition-all">
                Batal
            </a>
            <button form="form-sekolah" type="submit"
                class="px-6 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                Simpan Perubahan
            </button>
        </div>
    </div>

    <form id="form-sekolah"
        action="<?= url_to('admin.sekolah.update', $sekolah['slug']) ?>"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-8">
        <?= csrf_field() ?>
        <!-- <input type="hidden" name="_method" value="PUT"> -->

        <!-- ── Konfigurasi Awal ──────────────────────────────────────────── -->
        <div class="bg-white/80 backdrop-blur-md border border-white/30 p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-60 leading-none mb-1">KONFIGURASI AWAL</p>
                    <h2 class="text-lg font-bold">Status Keaktifan Sekolah</h2>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-slate-600">Status Aktif</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input name="is_active"
                        class="sr-only peer"
                        type="checkbox"
                        <?= (old('is_active', $sekolah['is_active']) ? 'checked' : '') ?> />
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </label>
            </div>
        </div>

        <!-- ── Section 1: Identitas Sekolah ─────────────────────────────── -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="identity">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-xl font-bold">Identitas Sekolah</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="lg:col-span-2">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">NAMA SEKOLAH <span class="text-red-500 text-xs">*</span></label>
                    <input name="nama_sekolah"
                        value="<?= old('nama_sekolah', $sekolah['nama_sekolah']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Masukkan nama resmi sekolah" type="text" />
                    <?php if (session('errors.nama_sekolah')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.nama_sekolah') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">NPSN (8 DIGIT) <span class="text-red-500 text-xs">*</span></label>
                    <input name="npsn"
                        value="<?= old('npsn', $sekolah['npsn']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Contoh: 12345678" type="number" />
                    <?php if (session('errors.npsn')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.npsn') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">NSS (12 DIGIT)</label>
                    <input name="nama_kepsek"
                        value="<?= old('nama_kepsek', $sekolah['nama_kepsek']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Contoh: Budiono Siregar" type="text" />
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">JENJANG <span class="text-red-500 text-xs">*</span></label>
                    <select name="jenjang" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <?php foreach (['TK', 'SD', 'SMP'] as $j): ?>
                            <option value="<?= $j ?>" <?= old('jenjang', $sekolah['jenjang']) === $j ? 'selected' : '' ?>><?= $j ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (session('errors.jenjang')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.jenjang') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">STATUS <span class="text-red-500 text-xs">*</span></label>
                    <select name="status" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <?php foreach (['Negeri', 'Swasta'] as $s): ?>
                            <option value="<?= $s ?>" <?= old('status', $sekolah['status']) === $s ? 'selected' : '' ?>><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (session('errors.status')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.status') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">AKREDITASI</label>
                    <select name="akreditasi" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <?php foreach (['A', 'B', 'C', 'Belum Terakreditasi'] as $ak): ?>
                            <option value="<?= $ak ?>" <?= old('akreditasi', $sekolah['akreditasi']) === $ak ? 'selected' : '' ?>><?= $ak ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KURIKULUM</label>
                    <select name="kurikulum" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <?php foreach (['Merdeka', 'K13'] as $kur): ?>
                            <option value="<?= $kur ?>" <?= old('kurikulum', $sekolah['kurikulum']) === $kur ? 'selected' : '' ?>><?= $kur ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN BERDIRI</label>
                    <input name="tahun_berdiri"
                        value="<?= old('tahun_berdiri', $sekolah['tahun_berdiri']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Contoh: 1995" type="number" />
                    <?php if (session('errors.tahun_berdiri')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.tahun_berdiri') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">LUAS LAHAN <span class="text-red-500 text-xs">*</span></label>
                    <input name="luas_lahan"
                        value="<?= old('luas_lahan', $sekolah['luas_lahan']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Contoh: 4995" type="number" />
                    <?php if (session('errors.luas_lahan')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.luas_lahan') ?></p>
                    <?php endif; ?>
                </div>

                <!-- Foto Sekolah -->
                <div class="lg:col-span-2">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">FOTO SEKOLAH</label>

                    <?php if (!empty($sekolah['foto'])): ?>
                        <!-- Preview foto saat ini -->
                        <div class="mb-3 flex items-center gap-4 p-3 bg-slate-50 rounded-xl border border-slate-200" id="foto-preview-wrapper">
                            <img src="<?= base_url('uploads/sekolah/' . $sekolah['foto']) ?>"
                                alt="Foto saat ini"
                                class="w-20 h-16 object-cover rounded-lg border border-slate-200"
                                id="foto-preview-img" />
                            <div>
                                <p class="text-xs font-semibold text-slate-600">Foto saat ini</p>
                                <p class="text-xs text-slate-400 mt-0.5"><?= esc($sekolah['foto']) ?></p>
                                <p class="text-xs text-slate-400 mt-1 italic">Upload foto baru untuk mengganti</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <input name="foto"
                        id="foto-input"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20"
                        type="file"
                        accept="image/*" />
                    <p class="mt-1 text-xs text-slate-400">Format: JPG, PNG, WEBP. Maks 2MB. Kosongkan jika tidak ingin mengganti foto.</p>

                    <?php if (session('errors.foto')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.foto') ?></p>
                    <?php endif; ?>
                </div>

            </div>
        </section>

        <!-- ── Section 2: Lokasi & Kontak ────────────────────────────────── -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="location">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-xl font-bold">Lokasi &amp; Kontak</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">ALAMAT LENGKAP <span class="text-red-500 text-xs">*</span></label>
                    <textarea name="alamat"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Jl. Raya Pendidikan No. 123..."
                        rows="3"><?= old('alamat', $sekolah['alamat']) ?></textarea>
                    <?php if (session('errors.alamat')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.alamat') ?></p>
                    <?php endif; ?>
                </div>

                <div class="md:col-span-2 space-y-3">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">PENENTUAN LOKASI (MAP)</label>
                    <div class="relative w-full h-96 bg-slate-100 rounded-4xl border border-slate-200 overflow-hidden">
                        <div id="map" class="w-full h-full"></div>
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-[999] cursor-pointer" id="btn-pinpoint">
                            <p class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm border border-white/50
                                      text-[10px] font-bold text-slate-600 flex items-center gap-2 transition-all
                                      hover:bg-primary hover:text-white hover:border-primary select-none">
                                <span class="material-symbols-outlined text-sm">ads_click</span>
                                KLIK UNTUK PIN POINT
                            </p>
                        </div>
                    </div>
                    <p class="text-xs font-medium text-slate-500 italic">Klik pada peta untuk menyesuaikan koordinat secara otomatis</p>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">LATITUDE <span class="text-red-500 text-xs">*</span></label>
                    <input name="latitude" id="lat-input"
                        value="<?= old('latitude', $sekolah['latitude']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="-6.12345" type="text" />
                    <?php if (session('errors.latitude')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.latitude') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">LONGITUDE <span class="text-red-500 text-xs">*</span></label>
                    <input name="longitude" id="lng-input"
                        value="<?= old('longitude', $sekolah['longitude']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="106.12345" type="text" />
                    <?php if (session('errors.longitude')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.longitude') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KECAMATAN</label>
                    <select name="kecamatan_id" id="kecamatan-select"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium
                                   focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option value="">-- Pilih atau pin lokasi --</option>
                        <?php foreach ($kecamatanList as $kec): ?>
                            <option value="<?= $kec['id'] ?>"
                                data-geojson="<?= $kec['geojson_file'] ?>"
                                data-name="<?= esc($kec['nama_kecamatan']) ?>"
                                <?= old('kecamatan_id', $sekolah['kecamatan_id']) == $kec['id'] ? 'selected' : '' ?>>
                                <?= esc($kec['nama_kecamatan']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">NOMOR TELEPON</label>
                    <input name="telepon"
                        value="<?= old('telepon', $sekolah['telepon']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="(021) 555-0123" type="tel" />
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">EMAIL SEKOLAH</label>
                    <input name="email"
                        value="<?= old('email', $sekolah['email']) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="kontak@sekolah.sch.id" type="email" />
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">WEBSITE</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-slate-400 text-sm font-medium">https://</span>
                        <input name="website"
                            value="<?= old('website', $sekolah['website']) ?>"
                            class="w-full bg-slate-50 border-border rounded-xl p-3 pl-16 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                            placeholder="www.sekolah.sch.id" type="text" />
                    </div>
                </div>

            </div>
        </section>

        <!-- ── Section 3: Data Statistik ─────────────────────────────────── -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="statistics">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-xl font-bold">Data Statistik</h2>
            </div>
            <?php
            // Prioritas: old() dulu (setelah validation error), lalu dari DB
            $st = $statistik ?? [];
            ?>
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN AJARAN</label>
                    <input name="tahun_ajaran"
                        value="<?= old('tahun_ajaran', $st['tahun_ajaran'] ?? '') ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        placeholder="Contoh: 2024/2025" type="text" />
                    <?php if (session('errors.tahun_ajaran')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.tahun_ajaran') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">SISWA LAKI-LAKI</label>
                    <input name="jumlah_siswa_l"
                        value="<?= old('jumlah_siswa_l', $st['jumlah_siswa_l'] ?? 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">SISWA PEREMPUAN</label>
                    <input name="jumlah_siswa_p"
                        value="<?= old('jumlah_siswa_p', $st['jumlah_siswa_p'] ?? 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">GURU TETAP</label>
                    <input name="jumlah_guru_tetap"
                        value="<?= old('jumlah_guru_tetap', $st['jumlah_guru_tetap'] ?? 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">GURU HONOR</label>
                    <input name="jumlah_guru_honor"
                        value="<?= old('jumlah_guru_honor', $st['jumlah_guru_honor'] ?? 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">TENAGA KEPENDIDIKAN</label>
                    <input name="jumlah_tenaga_kependidikan"
                        value="<?= old('jumlah_tenaga_kependidikan', $st['jumlah_tenaga_kependidikan'] ?? 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">JUMLAH ROMBEL</label>
                    <input name="jumlah_rombel"
                        value="<?= old('jumlah_rombel', $st['jumlah_rombel'] ?? 0) ?>"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all"
                        type="number" min="0" />
                </div>
            </div>
        </section>

        <!-- ── Section 4: Fasilitas ───────────────────────────────────────── -->
        <section class="bg-white/80 backdrop-blur-md border h-fit flex flex-col border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="facilities">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-xl font-bold">Fasilitas</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 w-full gap-3">
                <?php foreach ($jenisFasilitas as $fasilitas):
                    // Cek dari old() dulu (setelah validation error), lalu dari DB
                    $oldFasilitas = old('fasilitas') ?? null;

                    if ($oldFasilitas !== null) {
                        // Kita sedang dalam kondisi redirect after validation error
                        $isChecked = in_array((string) $fasilitas['id'], array_column($oldFasilitas, 'jenis_id'));
                        $currentData = [];
                        foreach ($oldFasilitas as $of) {
                            if ((string)$of['jenis_id'] === (string)$fasilitas['id']) {
                                $currentData = $of;
                                break;
                            }
                        }
                    } else {
                        // Load dari DB (fasilitasMap dari controller)
                        $isChecked   = isset($fasilitasMap[$fasilitas['id']]);
                        $currentData = $fasilitasMap[$fasilitas['id']] ?? [];
                    }
                ?>
                    <div class="border border-slate-200 rounded-xl overflow-hidden h-fit">
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

                        <div id="fasilitas-detail-<?= $fasilitas['id'] ?>"
                            class="fasilitas-detail <?= $isChecked ? '' : 'hidden' ?> border-t border-slate-100 bg-slate-50/60 px-4 py-4">
                            <input type="hidden" name="fasilitas[<?= $fasilitas['id'] ?>][jenis_id]" value="<?= $fasilitas['id'] ?>">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 mb-1">Jumlah</label>
                                    <input type="number"
                                        name="fasilitas[<?= $fasilitas['id'] ?>][jumlah]"
                                        value="<?= esc($currentData['jumlah'] ?? 1) ?>"
                                        min="1"
                                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 mb-1">Kondisi</label>
                                    <select name="fasilitas[<?= $fasilitas['id'] ?>][kondisi]"
                                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                                        <?php foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k): ?>
                                            <option value="<?= $k ?>" <?= ($currentData['kondisi'] ?? 'Baik') === $k ? 'selected' : '' ?>>
                                                <?= $k ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-xs font-semibold text-slate-500 mb-1">Keterangan <span class="font-normal text-slate-400">(opsional)</span></label>
                                    <input type="text"
                                        name="fasilitas[<?= $fasilitas['id'] ?>][keterangan]"
                                        value="<?= esc($currentData['keterangan'] ?? '') ?>"
                                        placeholder="Contoh: Butuh perbaikan atap"
                                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white" />
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ── Section 5: Prestasi ────────────────────────────────────────── -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="achievement">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
                </div>
                <h2 class="text-xl font-bold">Prestasi</h2>
            </div>

            <div id="prestasi-container" class="flex flex-col gap-6">
                <?php
                // Prioritas: old() setelah validation error, lalu dari DB
                $displayPrestasi = old('prestasi') ?? (count($prestasiList) > 0 ? $prestasiList : [[]]);
                $errors          = session('errors') ?? [];
                ?>
                <?php foreach ($displayPrestasi as $i => $item): ?>
                    <div class="prestasi-item lg:col-span-4 flex flex-col gap-6 p-6 bg-white/50 rounded-2xl border border-slate-100 relative">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

                            <div class="md:col-span-6">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">NAMA PRESTASI</label>
                                <input name="prestasi[<?= $i ?>][nama_prestasi]"
                                    value="<?= esc($item['nama_prestasi'] ?? '') ?>"
                                    class="w-full bg-slate-50 <?= isset($errors["prestasi.{$i}.nama_prestasi"]) ? 'border-red-500 focus:ring-red-200' : 'border-border' ?> rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                                    placeholder="Masukkan nama prestasi" type="text">
                                <?php if (isset($errors["prestasi.{$i}.nama_prestasi"])): ?>
                                    <p class="text-xs text-red-500 mt-1"><?= $errors["prestasi.{$i}.nama_prestasi"] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="md:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">TINGKAT</label>
                                <select name="prestasi[<?= $i ?>][tingkat]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                                    <?php $currTingkat = $item['tingkat'] ?? 'Sekolah'; ?>
                                    <?php foreach (['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'] as $t): ?>
                                        <option value="<?= $t ?>" <?= $currTingkat === $t ? 'selected' : '' ?>><?= $t ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">JENIS</label>
                                <select name="prestasi[<?= $i ?>][jenis]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                                    <?php $currJenis = $item['jenis'] ?? 'Akademik'; ?>
                                    <?php foreach (['Akademik', 'Non-Akademik', 'Olahraga', 'Seni'] as $j): ?>
                                        <option value="<?= $j ?>" <?= $currJenis === $j ? 'selected' : '' ?>><?= $j ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN</label>
                                <input name="prestasi[<?= $i ?>][tahun]"
                                    value="<?= esc($item['tahun'] ?? '') ?>"
                                    class="w-full bg-slate-50 <?= isset($errors["prestasi.{$i}.tahun"]) ? 'border-red-500 focus:ring-red-200' : 'border-border' ?> rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                                    placeholder="Contoh: 2023" type="number">
                                <?php if (isset($errors["prestasi.{$i}.tahun"])): ?>
                                    <p class="text-xs text-red-500 mt-1"><?= $errors["prestasi.{$i}.tahun"] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="md:col-span-7">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KETERANGAN</label>
                                <textarea name="prestasi[<?= $i ?>][keterangan]"
                                    class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                                    placeholder="Tambahkan detail prestasi..." rows="2"><?= esc($item['keterangan'] ?? '') ?></textarea>
                            </div>

                            <div class="md:col-span-2 flex items-end justify-end">
                                <button type="button" onclick="removePrestasi(this)"
                                    class="flex items-center gap-2 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors text-sm font-bold w-full justify-center border border-transparent hover:border-red-100">
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

    </form>
    <div class="h-8"></div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ── Koordinat awal dari DB (atau old() setelah error) ────────────────────
        const initLat = parseFloat(document.getElementById('lat-input').value) || -0.4555;
        const initLng = parseFloat(document.getElementById('lng-input').value) || 100.5771;
        const hasCoord = document.getElementById('lat-input').value !== '';

        const map = L.map('map', {
            zoomControl: false,
            preferCanvas: true,
            minZoom: 10,
            maxZoom: 16
        }).setView([initLat, initLng], hasCoord ? 13 : 12);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
        }).addTo(map);

        window.addEventListener('load', () => map.invalidateSize());

        let kabupatenGeometries = [];

        fetch("<?= base_url('id1305_tanah_datar.geojson') ?>")
            .then(res => res.json())
            .then(data => {
                const wilayahLayer = L.geoJSON(data, {
                    style: {
                        color: '#2563eb',
                        weight: 1.8,
                        opacity: 0.9,
                        fillColor: '#3b82f6',
                        fillOpacity: 0.06
                    },
                    onEachFeature(feature, layer) {
                        layer.on('mouseover', function() {
                            this.setStyle({
                                weight: 3,
                                color: '#1d4ed8',
                                fillOpacity: 0.15
                            });
                            this.bringToFront();
                        });
                        layer.on('mouseout', function() {
                            wilayahLayer.resetStyle(this);
                        });
                    }
                }).addTo(map);

                // Hanya fitBounds jika belum ada koordinat sekolah
                if (!hasCoord) {
                    map.fitBounds(wilayahLayer.getBounds(), {
                        padding: [50, 50],
                        maxZoom: 16
                    });
                    map.once('moveend', () => map.setMinZoom(map.getZoom()));
                } else {
                    map.setMinZoom(map.getZoom() - 2);
                }

                kabupatenGeometries = data.features.map(f => f.geometry);
            });

        // ── Bangun kecamatan index ────────────────────────────────────────────────
        const kecamatanSelect = document.getElementById('kecamatan-select');
        const options = [...kecamatanSelect.querySelectorAll('option[data-geojson]')];
        let kecamatanIndex = [];

        Promise.all(
            options.map(opt =>
                fetch(`<?= base_url() ?>${opt.dataset.geojson}`)
                .then(r => r.json())
                .then(geojson => ({
                    id: opt.value,
                    name: opt.dataset.name,
                    geometries: geojson.features.map(f => f.geometry)
                }))
                .catch(() => null)
            )
        ).then(results => {
            kecamatanIndex = results.filter(Boolean);
        });

        // ── Ray-casting ───────────────────────────────────────────────────────────
        function pointInPolygon(point, geometry) {
            const rings = geometry.type === 'Polygon' ?
                geometry.coordinates :
                geometry.type === 'MultiPolygon' ?
                geometry.coordinates.flat(1) : [];
            let inside = false;
            const [px, py] = point;
            for (const ring of rings) {
                for (let i = 0, j = ring.length - 1; i < ring.length; j = i++) {
                    const [xi, yi] = ring[i], [xj, yj] = ring[j];
                    const intersect = ((yi > py) !== (yj > py)) &&
                        (px < (xj - xi) * (py - yi) / (yj - yi) + xi);
                    if (intersect) inside = !inside;
                }
            }
            return inside;
        }

        function isInsideKabupaten(lat, lng) {
            if (!kabupatenGeometries.length) return true;
            return kabupatenGeometries.some(geom => pointInPolygon([lng, lat], geom));
        }

        function detectKecamatan(lat, lng) {
            if (!kecamatanIndex.length) return;
            const found = kecamatanIndex.find(kec =>
                kec.geometries.some(geom => pointInPolygon([lng, lat], geom))
            );
            if (found) {
                kecamatanSelect.value = found.id;
                kecamatanSelect.classList.add('!border-green-400', '!bg-green-50');
                setTimeout(() => kecamatanSelect.classList.remove('!border-green-400', '!bg-green-50'), 1500);
            } else {
                kecamatanSelect.value = '';
            }
        }

        // ── Marker pin ────────────────────────────────────────────────────────────
        const pinIcon = L.divIcon({
            className: '',
            html: `<div class="flex flex-col items-center" style="transform: translate(-50%, -100%);">
            <span class="material-symbols-outlined text-red-500"
                  style="font-size:3rem; font-variation-settings:'FILL' 1;
                         filter: drop-shadow(0 2px 4px rgba(0,0,0,0.25));">location_on</span>
            <div style="width:1rem; height:4px; background:rgba(0,0,0,0.1);
                        border-radius:9999px; filter:blur(2px); margin-top:2px;"></div>
        </div>`,
            iconSize: [0, 0],
            iconAnchor: [0, 0],
        });

        // Tampilkan marker di koordinat sekolah yang sudah ada
        let marker = null;
        if (hasCoord) {
            marker = L.marker([initLat, initLng], {
                icon: pinIcon
            }).addTo(map);
        }

        let pinActive = false;
        const btnPinpoint = document.getElementById('btn-pinpoint');

        btnPinpoint.addEventListener('click', () => {
            pinActive = !pinActive;
            const p = btnPinpoint.querySelector('p');
            if (pinActive) {
                p.classList.add('bg-primary', 'text-white', 'border-primary');
                p.classList.remove('bg-white/90', 'text-slate-600', 'border-white/50');
                map.getContainer().style.cursor = 'crosshair';
            } else {
                p.classList.remove('bg-primary', 'text-white', 'border-primary');
                p.classList.add('bg-white/90', 'text-slate-600', 'border-white/50');
                map.getContainer().style.cursor = '';
            }
        });


        map.on('click', function(e) {
            if (!pinActive) return;
            const {
                lat,
                lng
            } = e.latlng;

            if (!isInsideKabupaten(lat, lng)) {
                showToast('Lokasi di luar wilayah Kabupaten Tanah Datar', 'error');
                return;
            }

            document.getElementById('lat-input').value = lat.toFixed(6);
            document.getElementById('lng-input').value = lng.toFixed(6);
            detectKecamatan(lat, lng);

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng, {
                    icon: pinIcon
                }).addTo(map);
            }

            pinActive = false;
            const p = btnPinpoint.querySelector('p');
            p.classList.remove('bg-primary', 'text-white', 'border-primary');
            p.classList.add('bg-white/90', 'text-slate-600', 'border-white/50');
            map.getContainer().style.cursor = '';
        });

        // ── Auto-render marker jika pre-fill dari server (mode edit) ──────────
        // const existingLat = parseFloat(document.getElementById('lat-input').value);
        // const existingLng = parseFloat(document.getElementById('lng-input').value);

        // if (!isNaN(existingLat) && !isNaN(existingLng)) {
        //     marker = L.marker([existingLat, existingLng], {
        //         icon: pinIcon
        //     }).addTo(map);
        //     map.setView([existingLat, existingLng], 14);
        // }

        // ── Sync marker saat input manual ────────────────────────────────────
        function tryDetectFromInputs() {
            const lat = parseFloat(document.getElementById('lat-input').value);
            const lng = parseFloat(document.getElementById('lng-input').value);
            if (isNaN(lat) || isNaN(lng)) return;

            if (!isInsideKabupaten(lat, lng)) {
                showToast('Koordinat di luar wilayah Kabupaten Tanah Datar', 'error');
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
            detectKecamatan(lat, lng);
        }

        document.getElementById('lat-input').addEventListener('change', tryDetectFromInputs);
        document.getElementById('lng-input').addEventListener('change', tryDetectFromInputs);

        function showToast(message, type = 'error') {
            const colors = {
                error: 'bg-red-500',
                success: 'bg-green-500'
            };
            const toast = document.createElement('div');
            toast.className = `fixed bottom-6 left-1/2 -translate-x-1/2 z-[9999]
            flex items-center gap-2 px-5 py-3 rounded-2xl shadow-xl
            text-white text-sm font-semibold transition-all duration-300
            opacity-0 translate-y-2 ${colors[type]}`;
            toast.innerHTML = `<span class="material-symbols-outlined text-base">
            ${type === 'error' ? 'location_off' : 'check_circle'}</span>${message}`;
            document.body.appendChild(toast);
            requestAnimationFrame(() => toast.classList.remove('opacity-0', 'translate-y-2'));
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                toast.addEventListener('transitionend', () => toast.remove());
            }, 3000);
        }

        // ── Preview foto baru sebelum submit ─────────────────────────────────────
        document.getElementById('foto-input').addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                const wrapper = document.getElementById('foto-preview-wrapper');
                const img = document.getElementById('foto-preview-img');
                if (img) {
                    img.src = e.target.result;
                } else if (wrapper) {
                    // Jika belum ada preview (foto lama kosong), buat preview baru
                    wrapper.innerHTML = `
                    <img src="${e.target.result}" alt="Preview foto baru"
                         class="w-20 h-16 object-cover rounded-lg border border-slate-200" />
                    <div>
                        <p class="text-xs font-semibold text-green-600">Foto baru dipilih</p>
                        <p class="text-xs text-slate-400 mt-0.5">${file.name}</p>
                    </div>`;
                }
            };
            reader.readAsDataURL(file);
        });
    });
</script>

<script>
    let prestasiIndex = document.querySelectorAll('.prestasi-item').length;

    function addPrestasi() {
        const i = prestasiIndex++;
        const html = `
        <div class="prestasi-item lg:col-span-4 flex flex-col gap-6 p-6 bg-white/50 rounded-2xl border border-slate-100 relative">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="md:col-span-6">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">NAMA PRESTASI</label>
                    <input name="prestasi[${i}][nama_prestasi]"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Masukkan nama prestasi" type="text">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">TINGKAT</label>
                    <select name="prestasi[${i}][tingkat]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option>Sekolah</option><option>Kecamatan</option><option>Kabupaten</option>
                        <option>Provinsi</option><option>Nasional</option><option>Internasional</option>
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">JENIS</label>
                    <select name="prestasi[${i}][jenis]" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option>Akademik</option><option>Non-Akademik</option><option>Olahraga</option><option>Seni</option>
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN</label>
                    <input name="prestasi[${i}][tahun]"
                        class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                        placeholder="Contoh: 2023" type="number">
                </div>
                <div class="md:col-span-7">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KETERANGAN</label>
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
            const detail = document.getElementById(this.dataset.target);
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
</script>
<?= $this->endSection(); ?>