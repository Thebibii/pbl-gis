<?= $this->extend('layouts/main-home') ?>
<?= $this->section('content') ?>
<?php if (!$sekolah): ?>
    <section class="flex-1 h-screen flex items-center justify-center p-8">
        <div class="text-center space-y-6 max-w-md">
            <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto">
                <span class="material-symbols-outlined text-4xl! text-slate-400">school</span>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-foreground mb-2">Sekolah Tidak Ditemukan</h1>
                <p class="text-sm text-muted-foreground">Data sekolah yang Anda cari tidak tersedia atau telah dihapus dari sistem.</p>
            </div>
            <a href="<?= url_to('peta') ?>"
                class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform text-sm">
                <span class="material-symbols-outlined text-base!">arrow_back</span> Kembali ke Peta
            </a>
        </div>
    </section>

<?php else: ?>
    <main class="pt-24">

        <?php /*
            <!-- Stats Section -->
            <section class="max-w-7xl mx-auto px-6 py-20">
                <?php
                $totalSiswa = ($statistik['jumlah_siswa_l'] ?? 0) + ($statistik['jumlah_siswa_p'] ?? 0);
                $totalGuru  = ($statistik['jumlah_guru_tetap'] ?? 0) + ($statistik['jumlah_guru_honor'] ?? 0);
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Main Stat -->
                    <div class="bg-primary text-primary-foreground p-8 rounded-3xl flex flex-col justify-between group overflow-hidden relative shadow-xl shadow-primary/10 min-h-[240px]">
                        <div class="absolute -right-8 -bottom-8 opacity-10 group-hover:scale-110 group-hover:-rotate-12 transition-all duration-700">
                            <span class="material-symbols-outlined text-[240px]">groups</span>
                        </div>
                        <div class="relative z-10">
                            <span class="text-[12px] font-bold opacity-70 tracking-[0.2em] uppercase">Total Siswa</span>
                            <p class="text-7xl font-stat leading-none mt-4 font-black tracking-tighter"><?= number_format($totalSiswa) ?></p>
                        </div>
                        <div class="relative z-10 mt-4">
                            <p class="text-xs text-justify opacity-80 font-medium ">Terdiri dari <?= $statistik['jumlah_rombel'] ?? 0 ?> rombongan belajar aktif dengan standar nasional kependidikan tinggi.</p>
                        </div>
                    </div>
                    <!-- Stat Card 1 -->
                    <div class="bg-card p-8 rounded-3xl flex flex-col justify-between border border-border/50 shadow-sm hover:shadow-md transition-shadow min-h-[240px]">
                        <div class="flex justify-between items-start">
                            <div class="bg-muted p-3 rounded-2xl"><span class="material-symbols-outlined text-primary">person_pin</span></div>
                            <span class="text-[10px] font-bold text-muted-foreground tracking-[0.2em] uppercase">Guru</span>
                        </div>
                        <div class="mt-8">
                            <p class="text-5xl font-stat font-black text-foreground"><?= $totalGuru ?></p>
                            <p class="text-[11px] font-bold text-muted-foreground mt-1 uppercase">Tenaga Pendidik</p>
                        </div>
                    </div>
                    <!-- Stat Card 2 -->
                    <div class="bg-card p-8 rounded-3xl flex flex-col justify-between border border-border/50 shadow-sm hover:shadow-md transition-shadow min-h-[240px]">
                        <div class="flex justify-between items-start">
                            <div class="bg-muted p-3 rounded-2xl"><span class="material-symbols-outlined text-primary">meeting_room</span></div>
                            <span class="text-[10px] font-bold text-muted-foreground tracking-[0.2em] uppercase">Kelas</span>
                        </div>
                        <div class="mt-8">
                            <p class="text-5xl font-stat font-black text-foreground"><?= $statistik['jumlah_rombel'] ?? 0 ?></p>
                            <p class="text-[11px] font-bold text-muted-foreground mt-1 uppercase">Ruang Aktif</p>
                        </div>
                    </div>
                    <!-- Area Stat Card -->
                    <div class="bg-card p-8 rounded-3xl flex flex-col justify-between border border-border/50 shadow-sm hover:shadow-md transition-shadow min-h-[240px] space-y-6">
                        <div class="flex justify-between items-start">
                            <div class="bg-muted p-3 rounded-2xl"><span class="material-symbols-outlined text-primary">square_foot</span></div>
                            <span class="text-[10px] font-bold text-muted-foreground tracking-[0.2em] uppercase">Lahan</span>
                        </div>
                        <div class="space-y-2">
                            <p class="text-4xl font-heading font-black text-foreground leading-none"><?= number_format($sekolah['luas_lahan']) ?> <span class="text-xl">m²</span></p>
                            <p class="text-[11px] font-bold text-muted-foreground  uppercase tracking-widest">Luas Area Sekolah</p>
                        </div>
                        <div class="pt-4 border-t border-border/50">
                            <p class="text-xs text-muted-foreground">Kepemilikan lahan sah milik Pemerintah Daerah.</p>
                        </div>
                    </div>
                </div>
            </section>
            */ ?>
        <!-- Detailed Content -->


        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Hero Section -->
            <?php
            $namaParts = explode(' ', trim($sekolah['nama_sekolah']), 5);

            $baris1 = implode(' ', array_slice($namaParts, 0, 4));
            $baris2 = $namaParts[4] ?? '';
            $fotoUrl   = !empty($sekolah['foto_utama'])
                ? base_url('uploads/sekolah/' . esc($sekolah['foto_utama']))
                : null;
            ?>
            <section class="relative w-full overflow-hidden bg-card rounded-2xl">

                <!-- AREA GAMBAR — aspect-video konsisten di semua ukuran layar -->
                <div class="relative w-full aspect-video overflow-hidden">
                    <?php if ($fotoUrl): ?>
                        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?= $fotoUrl ?>');"></div>
                    <?php else: ?>
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl! md:text-8xl! text-slate-400">school</span>
                        </div>
                    <?php endif; ?>

                    <!-- Overlay HANYA tampil di md ke atas -->
                    <div class="hidden md:block absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-black/10"></div>
                    <div class="hidden md:flex absolute inset-0 flex-col justify-end p-8 lg:p-12 z-10">
                        <div class="space-y-6">
                            <h1 class="text-4xl lg:text-5xl font-heading font-extrabold leading-tight text-white">
                                <?= esc($baris1) ?> <br />
                                <span class="text-white/90"><?= esc($baris2) ?></span>
                            </h1>
                            <div class="flex justify-between">
                                <div class="max-w-md flex items-start gap-4 p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20 w-fit">
                                    <div class="bg-white/15 px-2.5 py-2 rounded-lg flex shrink-0">
                                        <span class="material-symbols-outlined text-white text-xl!">location_on</span>
                                    </div>
                                    <p class="text-sm font-bold leading-snug text-white">
                                        <?= !empty($sekolah['alamat']) ? esc($sekolah['alamat']) . ', ' : '' ?>
                                        <?= !empty($sekolah['nama_kecamatan']) ? "Kec. " . esc($sekolah['nama_kecamatan']) : '' ?>
                                    </p>
                                </div>
                                <button class="h-fit self-end bg-primary text-primary-foreground px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all flex items-center gap-2 shadow-lg shadow-black/30 text-xs uppercase tracking-widest" onclick="switchTab('lokasi')">
                                    <span class="material-symbols-outlined text-xl!">map</span>
                                    Lihat di Peta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFO CARD — HANYA tampil di bawah md, di bawah gambar -->
                <div class="md:hidden p-6 space-y-5">
                    <h1 class="text-2xl sm:text-3xl font-heading font-extrabold leading-tight text-foreground break-words">
                        <?= esc($baris1) ?> <br />
                        <span class="text-foreground/80"><?= esc($baris2) ?></span>
                    </h1>
                    <div class="flex items-start gap-3 p-4 bg-muted/30 rounded-xl border border-border/50">
                        <div class="bg-primary/10 p-2.5 rounded-lg flex shrink-0">
                            <span class="material-symbols-outlined text-primary text-xl!">location_on</span>
                        </div>
                        <p class="text-sm font-bold leading-snug text-foreground">
                            <?= !empty($sekolah['alamat']) ? esc($sekolah['alamat']) . ', ' : '' ?>
                            <?= !empty($sekolah['nama_kecamatan']) ? "Kec. " . esc($sekolah['nama_kecamatan']) : '' ?>
                        </p>
                    </div>
                    <button class="w-full justify-center bg-primary text-primary-foreground px-6 py-3 rounded-xl font-bold hover:opacity-90 transition-all flex items-center gap-2 shadow-lg shadow-black/30 text-xs uppercase tracking-widest" onclick="switchTab('lokasi')">
                        <span class="material-symbols-outlined text-xl!">map</span>
                        Lihat di Peta
                    </button>
                </div>
            </section>
        </section>
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 mb-20" id="tab">

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-8">
                <div class="space-y-12 bg-card p-6 md:p-8 h-fit rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                    <!-- Tabs Navigation -->
                    <div class="flex flex-wrap gap-10 border-b border-border pb-px">
                        <button class="group relative pb-6" onclick="switchTab('profil')">
                            <span class="font-bold text-primary transition-all" id="tab-profil-text">Profil</span>
                            <div class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full transition-all" id="tab-profil-line"></div>
                        </button>
                        <!-- <button class="group relative pb-6" onclick="switchTab('fasilitas')">
                        <span class="font-bold text-muted-foreground hover:text-foreground transition-all" id="tab-fasilitas-text">Fasilitas</span>
                        <div class="absolute bottom-0 left-0 w-0 h-1 bg-primary rounded-full transition-all duration-300" id="tab-fasilitas-line"></div>
                    </button> -->
                        <!-- <button class="group relative pb-6" onclick="switchTab('prestasi')">
                        <span class="font-bold text-muted-foreground hover:text-foreground transition-all" id="tab-prestasi-text">Prestasi</span>
                        <div class="absolute bottom-0 left-0 w-0 h-1 bg-primary rounded-full transition-all duration-300" id="tab-prestasi-line"></div>
                    </button> -->
                        <button class="group relative pb-6" onclick="switchTab('lokasi')">
                            <span class="font-bold text-muted-foreground hover:text-foreground transition-all" id="tab-lokasi-text">Lokasi</span>
                            <div class="absolute bottom-0 left-0 w-0 h-1 bg-primary rounded-full transition-all duration-300" id="tab-lokasi-line"></div>
                        </button>
                    </div>
                    <!-- Tab Content: Profil -->
                    <div class="tab-panel space-y-12 animate-in fade-in slide-in-from-bottom-4 duration-500" id="panel-profil">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div class="space-y-8">
                                <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-primary flex items-center gap-2">
                                    <span class="w-8 h-[1px] bg-primary"></span> Administrasi
                                </h3>
                                <div class="space-y-6">
                                    <div class="flex justify-between items-center group">
                                        <span class="text-sm text-muted-foreground font-medium">NPSN</span>
                                        <span class="text-base text-foreground font-bold group-hover:text-primary transition-colors"><?= esc($sekolah['npsn']) ?></span>
                                    </div>
                                    <div class="flex justify-between items-center group">
                                        <span class="text-sm text-muted-foreground font-medium">Kepala Sekolah</span>
                                        <span class="text-base text-foreground font-bold group-hover:text-primary transition-colors"><?= esc($sekolah['nama_kepsek'] ?? '-') ?></span>
                                    </div>
                                    <div class="flex justify-between items-center group">
                                        <span class="text-sm text-muted-foreground font-medium">Status</span>
                                        <span class="text-base text-foreground font-bold group-hover:text-primary transition-colors"><?= esc($sekolah['status']) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-8">
                                <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-primary flex items-center gap-2">
                                    <span class="w-8 h-[1px] bg-primary"></span> Akademik
                                </h3>
                                <div class="space-y-6">
                                    <div class="flex justify-between items-center group">
                                        <span class="text-sm text-muted-foreground font-medium">Kurikulum</span>
                                        <span class="text-base text-foreground font-bold group-hover:text-primary transition-colors"><?= esc($sekolah['kurikulum']) ?? '-' ?></span>
                                    </div>
                                    <div class="flex justify-between items-center group">
                                        <span class="text-sm text-muted-foreground font-medium">Akreditasi</span>
                                        <span class="text-base text-foreground font-bold group-hover:text-primary transition-colors"><?= esc($sekolah['akreditasi']) ?></span>
                                    </div>
                                    <div class="flex justify-between items-center group">
                                        <span class="text-sm text-muted-foreground font-medium">Jenjang</span>
                                        <span class="text-base text-foreground font-bold group-hover:text-primary transition-colors"><?= esc($sekolah['jenjang']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 md:p-10 bg-muted/30 border border-border/50 rounded-3xl relative overflow-hidden group shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                            <span class="material-symbols-outlined text-[140px]! text-primary/5 absolute -right-4 -top-4 font-bold italic transition-colors group-hover:text-primary/10">format_quote</span>
                            <h3 class="text-sm font-bold text-primary mb-6 uppercase tracking-[0.2em]">Visi</h3>
                            <p class="text-xl md:text-2xl italic font-medium leading-relaxed text-foreground relative z-10 max-w-3xl">
                                "<?= esc($sekolah['visi'] ?? "Belum ada visi yang ditetapkan") ?>"
                            </p>
                        </div>
                        <div class="p-6 md:p-10 bg-muted/30 border border-border/50 rounded-3xl relative overflow-hidden group shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                            <span class="material-symbols-outlined text-[140px]! text-primary/5 absolute -right-4 -top-4 font-bold italic transition-colors group-hover:text-primary/10">format_quote</span>
                            <h3 class="text-sm font-bold text-primary mb-6 uppercase tracking-[0.2em]">Misi</h3>
                            <p class="md:text-xl italic font-medium leading-relaxed text-foreground relative z-10 max-w-3xl">
                                <?= nl2br(esc($sekolah['misi'] ?? "Belum ada misi yang ditetapkan")) ?>
                            </p>
                        </div>
                    </div>
                    <?php /*
                <!-- Tab Content: Fasilitas -->
                <div class="tab-panel hidden grid grid-cols-2 md:grid-cols-3 gap-6" id="panel-fasilitas">
                    <?php foreach ($fasilitas as $f): ?>
                        <div class="p-8 bg-card border border-border/50 rounded-2xl hover:border-primary/50 transition-all shadow-sm">

                            <?php
                            // Lakukan pengecekan apakah ikon merupakan SVG (mengandung karakter '<')
                            $isSvg = !empty($f['ikon']) && str_contains($f['ikon'], '<');
                            ?>

                            <?php if ($isSvg): ?>
                                <!-- Jika SVG, bungkus dengan tag SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-primary mb-4">
                                    <?= $f['ikon'] ?>
                                </svg>
                            <?php else: ?>
                                <!-- Jika bukan SVG, tampilkan sebagai Material Symbol -->
                                <span class="material-symbols-outlined text-primary mb-4" style="font-size: 32px;">
                                    <?= esc($f['ikon']) ?>
                                </span>
                            <?php endif; ?>

                            <p class="font-bold text-lg"><?= esc($f['nama_fasilitas']) ?></p>
                            <p class="text-sm text-muted-foreground mt-1"><?= $f['jumlah'] ?> unit · <?= esc($f['kondisi']) ?></p>
                        </div>
                    <?php endforeach; ?>

                </div>

                <!-- Tab Content: Prestasi -->
                <div class="tab-panel hidden space-y-10" id="panel-prestasi">
                    <?php foreach ($prestasi as $p): ?>
                        <div class="flex gap-12 items-start">
                            <span class="text-6xl italic font-black text-primary/90 w-36 shrink-0 text-right tabular-nums">
                                <?= $p['tahun'] ?>
                            </span>
                            <div class="space-y-2">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 bg-primary/10 text-primary text-[9px] font-bold rounded uppercase tracking-wider"><?= esc($p['tingkat']) ?></span>
                                    <span class="px-2 py-0.5 bg-muted text-muted-foreground text-[9px] font-bold rounded uppercase tracking-wider"><?= esc($p['jenis']) ?></span>
                                </div>
                                <h4 class="text-xl font-bold"><?= esc($p['nama_prestasi']) ?></h4>
                                <p class="text-muted-foreground"><?= esc($p['keterangan']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                */ ?>
                    <!-- Tab Content: Lokasi -->
                    <div class="tab-panel hidden" id="panel-lokasi">
                        <div class="relative w-full h-[480px] rounded-3xl overflow-hidden border border-border/50 bg-muted">
                            <div id="map" class="w-full h-full"></div>
                            <div class="absolute bottom-6 right-6 flex flex-col gap-2 z-[500]">
                                <div class="flex flex-col glass-effect rounded-2xl shadow-2xl overflow-hidden">
                                    <button data-map-action="zoom-in" class="w-10 h-10 flex items-center justify-center text-primary hover:bg-accent transition-colors border-b border-border/50">
                                        <span class="material-symbols-outlined">add</span>
                                    </button>
                                    <button data-map-action="zoom-out" class="w-10 h-10 flex items-center justify-center text-primary hover:bg-accent transition-colors">
                                        <span class="material-symbols-outlined">remove</span>
                                    </button>
                                </div>
                                <button id="btn-layers" class="w-10 h-10 glass-effect rounded-2xl shadow-2xl flex items-center justify-center text-primary hover:bg-accent transition-colors">
                                    <span class="material-symbols-outlined">layers</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <aside class="space-y-12 bg-card p-6 md:p-8 h-fit rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                    <!-- Contact Card -->
                    <div class="bg-primary text-primary-foreground p-10 rounded-[2rem] shadow-2xl shadow-primary/20 space-y-10 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20 blur-2xl"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12 blur-xl"></div>
                        <h3 class="text-2xl font-extrabold leading-tight relative z-10">Punya Pertanyaan <br />Untuk Kami?</h3>
                        <div class="space-y-8 relative z-10">
                            <!-- Item: Telepon -->
                            <div class="flex items-center gap-5">
                                <!-- PERBAIKAN: Ditambahkan shrink-0 agar kotak 12x12 selalu konsisten -->
                                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-md border border-white/20 shrink-0">
                                    <!-- PERBAIKAN: Ditambahkan flex, items-center, justify-center, dan w-full h-full pada ikon -->
                                    <span class="material-symbols-outlined text-xl! flex items-center justify-center">call</span>
                                </div>
                                <div class="flex-1 min-w-0"> <!-- Ditambahkan flex-1 agar teks mengambil sisa ruang -->
                                    <p class="text-[10px] font-bold opacity-70 tracking-widest uppercase">Telepon</p>
                                    <p class="font-bold text-lg"><?= esc($sekolah['telepon'] ?? "-") ?></p>
                                </div>
                            </div>

                            <!-- Item: Email -->
                            <div class="flex items-center gap-5">
                                <!-- PERBAIKAN: Ditambahkan shrink-0 agar kotak 12x12 selalu konsisten -->
                                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-md border border-white/20 shrink-0">
                                    <!-- PERBAIKAN: Ditambahkan flex, items-center, justify-center, dan w-full h-full pada ikon -->
                                    <span class="material-symbols-outlined text-xl! flex items-center justify-center">mail</span>
                                </div>
                                <div class="flex-1 min-w-0"> <!-- Ditambahkan flex-1 dan min-w-0 agar break-all bekerja sempurna -->
                                    <p class="text-[10px] font-bold opacity-70 tracking-widest uppercase">Email</p>
                                    <p class="font-bold text-lg break-all"><?= esc($sekolah['email'] ?? "-") ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- <a href="https://wa.me/<?= esc($sekolah['telepon']) ?>" target="_blank" class="w-full bg-white text-primary py-5 rounded-2xl font-extrabold text-sm hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 relative z-10">
                        <span class="material-symbols-outlined text-lg">chat</span>
                        WhatsApp Admin
                    </a> -->
                    </div>
                    <!-- Related Schools -->
                    <!-- Related Schools -->
                    <div class="space-y-6">
                        <h3 class="text-[11px] font-black text-muted-foreground tracking-[0.2em] uppercase px-2">Sekolah Terdekat</h3>
                        <div class="space-y-4">
                            <?php foreach ($sekolahTerdekat as $s): ?>
                                <?php
                                $jarak = $s['jarak_km'];
                                $jarakLabel = $jarak < 1
                                    ? number_format($jarak * 1000) . ' m'
                                    : number_format($jarak, 1) . ' km';

                                $akreditasiLabel = match ($s['akreditasi']) {
                                    'A' => 'A (Unggul)',
                                    'B' => 'B (Baik)',
                                    'C' => 'C (Cukup)',
                                    default => $s['akreditasi'] ?? '-'
                                };

                                $akreditasiClass = match ($s['akreditasi']) {
                                    'A' => 'badge-A text-white',
                                    'B' => 'badge-B text-foreground',
                                    'C' => 'badge-C text-white',
                                    default => 'bg-muted text-muted-foreground'
                                };
                                ?>
                                <?php $urlSekolah = !empty($s['slug']) ? site_url('sekolah/' . $s['slug']) : '#'; ?>
                                <!-- <a > -->
                                <a class="flex items-center gap-5 group p-3 rounded-2xl hover:bg-muted/50 transition-all border border-transparent hover:border-border/50"
                                    href="<?= $urlSekolah ?>">
                                    <div class="w-20 h-20 rounded-xl shrink-0 border border-border shadow-sm overflow-hidden bg-muted">
                                        <?php if (!empty($s['foto_utama'])): ?>
                                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                                src="<?= base_url('uploads/sekolah/' . esc($s['foto_utama'])) ?>" alt="">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-3xl! text-slate-400">school</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>


                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-foreground text-sm group-hover:text-primary transition-colors truncate">
                                            <?= esc($s['nama_sekolah']) ?>
                                        </h4>
                                        <p class="text-xs text-muted-foreground mt-1">
                                            <?= $jarakLabel ?> <?= !empty($s['jenjang']) ? '· ' . esc($s['jenjang']) . ' ' . esc($s['status']) : '· ' . esc($s['status']) ?>
                                        </p>
                                        <div class="mt-2 flex items-center gap-2">
                                            <span class="px-2 py-0.5 <?= $akreditasiClass ?> text-[9px] font-bold rounded uppercase tracking-wider">
                                                <?= $akreditasiLabel ?>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>

                            <?php if (empty($sekolahTerdekat)): ?>
                                <p class="text-sm text-muted-foreground px-2">Belum ada sekolah lain yang terdaftar.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
<?php endif; ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<?php if ($sekolah): ?>

    <script>
        let map;
        let mapInitialized = false;

        function switchTab(tabName) {
            const panels = document.querySelectorAll('.tab-panel');
            panels.forEach(p => p.classList.add('hidden'));

            document.getElementById('panel-' + tabName).classList.remove('hidden');

            const tabs = ['profil', 'lokasi'];
            // const tabs = ['profil', 'fasilitas', 'prestasi', 'lokasi'];
            tabs.forEach(t => {
                const text = document.getElementById(`tab-${t}-text`);
                const line = document.getElementById(`tab-${t}-line`);

                if (t === tabName) {
                    text.classList.remove('text-muted-foreground');
                    text.classList.add('text-primary');
                    line.classList.remove('w-0');
                    line.classList.add('w-full');
                } else {
                    text.classList.add('text-muted-foreground');
                    text.classList.remove('text-primary');
                    line.classList.remove('w-full');
                    line.classList.add('w-0');
                }
            });

            if (tabName === 'lokasi' && map) {
                setTimeout(() => map.invalidateSize(), 50);
            }

            const tabSection = document.getElementById('tab');
            tabSection.scrollIntoView({
                behavior: 'smooth',

                block: 'start'
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            var lat = <?= ($sekolah['latitude'] ?? '-0.4555') ?>;
            var lng = <?= ($sekolah['longitude'] ?? '100.5771') ?>;
            map = L.map('map', {
                zoomControl: false,
                preferCanvas: true,
                minZoom: 10,
                maxZoom: 18
            }).setView([lat, lng], 12);
            // Tile layers
            const tileLayers = {
                light: L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
                }),
                satellite: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: '&copy; Esri'
                })
            };
            let activeLayer = 'light';
            tileLayers.light.addTo(map);
            // Hubungkan tombol zoom ke map
            // Hubungkan tombol zoom ke map
            document.querySelector('[data-map-action="zoom-in"]').addEventListener('click', () => {
                map.zoomIn();
            });
            document.querySelector('[data-map-action="zoom-out"]').addEventListener('click', () => {
                map.zoomOut();
            });

            document.getElementById('btn-layers').addEventListener('click', () => {
                const next = activeLayer === 'light' ? 'satellite' : 'light';
                map.removeLayer(tileLayers[activeLayer]);
                tileLayers[next].addTo(map);
                activeLayer = next;
            });

            setTimeout(() => map.invalidateSize(), 100);

            <?php if (!empty($sekolah['geojson_file'])): ?>
                fetch("<?= base_url($sekolah['geojson_file']) ?>")
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

                        setTimeout(() => {
                            map.invalidateSize();
                            map.fitBounds(wilayahLayer.getBounds(), {
                                padding: [40, 40],
                                maxZoom: 13
                            });

                            map.once('moveend', function() {
                                map.setMinZoom(map.getZoom());
                                map.setView([lat, lng], map.getZoom(), {
                                    animate: false
                                });
                            });
                        }, 150);
                    })
                    .catch(err => console.error('GeoJSON gagal dimuat:', err));
            <?php endif; ?>

            // ── Marker pin ────────────────────────────────────────────────────────────
            const pinIcon = L.divIcon({
                className: '',
                html: `<div class="flex flex-col items-center" style="transform: translate(-50%, -100%);">
            <span class="material-symbols-outlined text-red-500"
                  style="font-size:2rem; font-variation-settings:'FILL' 1;
                         filter: drop-shadow(0 2px 4px rgba(0,0,0,0.25));">location_on</span>
            <div style="width:1rem; height:4px; background:rgba(0,0,0,0.1);
                        border-radius:9999px; filter:blur(2px); margin-top:2px;"></div>
        </div>`,
                iconSize: [0, 0],
                iconAnchor: [0, 0],
            });

            const marker = L.marker([lat, lng], {
                    icon: pinIcon
                })
                .bindPopup(
                    `
                <div class="font-sans" style="font-family:'Plus Jakarta Sans',sans-serif; min-width:260px;">
                    <div class="relative aspect-video overflow-hidden">
                    <?php if (!empty($sekolah['foto_utama'])) : ?>
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="<?= base_url('uploads/sekolah/' . esc($sekolah['foto_utama'])) ?>" alt="<?= $sekolah['nama_sekolah'] ?? '' ?>">
                    <?php else : ?>
                        <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl! text-slate-400">school</span>
                        </div>
                    <?php endif; ?>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class=" text-[9px] font-bold px-2 py-1 rounded uppercase tracking-widest shadow <?= $sekolah['status'] === 'Negeri' ? 'bg-primary text-white' : 'bg-secondary text-secondary-foreground' ?>">
                               <?= $sekolah['jenjang'] ?> <?= $sekolah['status'] ?>
                            </span>
                        </div>
                        
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-[15px] mb-1 text-slate-800"><?= $sekolah['nama_sekolah'] ?></h3>
                       
                    </div>
                </div>
                `, {
                        maxWidth: 300,
                        offset: L.point(0, 100), // tidak ada offset sama sekali
                        autoPan: false
                        // className:
                    })
                .addTo(map);

            // marker.on('click', () => {
            //     map.panTo([<?= $sekolah['latitude'], $sekolah['longitude'] ?>], {
            //         animate: true,
            //         duration: 0.5
            //     });
            // });
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>