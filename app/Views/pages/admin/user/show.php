<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>

<?php if (!$sekolah): ?>
    <section class="flex-1 flex items-center justify-center p-8">
        <div class="text-center space-y-6 max-w-md">
            <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto">
                <span class="material-symbols-outlined text-5xl text-slate-400">school</span>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-foreground mb-2">Sekolah Tidak Ditemukan</h1>
                <p class="text-sm text-muted-foreground">Data sekolah yang Anda cari tidak tersedia atau telah dihapus dari sistem.</p>
            </div>
            <a href="<?= url_to('admin.sekolah') ?>"
                class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform text-sm">
                <span class="material-symbols-outlined">arrow_back</span> Kembali ke Data Sekolah
            </a>
        </div>
    </section>

<?php else: ?>
    <?php
    // Hitung total siswa & guru
    $totalSiswa = ($statistik['jumlah_siswa_l'] ?? 0) + ($statistik['jumlah_siswa_p'] ?? 0);
    $totalGuru  = ($statistik['jumlah_guru_tetap'] ?? 0) + ($statistik['jumlah_guru_honor'] ?? 0);

    // Badge warna jenjang
    $jenjangColor = match (strtoupper($sekolah['jenjang'] ?? '')) {
        'TK'  => 'badge-TK',
        'SD'  => 'bg-[#EF4444]',
        'SMP' => 'bg-[#EAB308]',
        default => 'bg-slate-500',
    };

    // Status aktif
    $isActive = (bool) ($sekolah['is_active'] ?? false);
    ?>

    <section class="flex-1 overflow-y-auto p-8 space-y-8">
        <div class="max-w-7xl mx-auto space-y-8">

            <section class="relative h-[320px] rounded-2xl overflow-hidden shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] group">
                <?php if (!empty($sekolah['foto_utama'])): ?>
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="<?= base_url('uploads/sekolah/' . esc($sekolah['foto_utama'])) ?>" alt="">
                <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-8xl text-slate-400">school</span>
                    </div>
                <?php endif; ?>

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 w-full p-8 flex flex-col md:flex-row justify-between items-end gap-6">
                    <div class="flex items-center gap-6 ">
                        <!-- <div class="w-24 h-24 bg-white p-2 rounded-xl shadow-xl flex items-center justify-center overflow-hidden">
                            <span class="material-symbols-outlined text-5xl text-primary">school</span>
                        </div> -->
                        <div class="text-white">
                            <div class="flex gap-2 mb-2">
                                <span class="px-3 py-1 <?= $isActive ? 'bg-green-500' : 'bg-slate-500' ?> text-white text-[10px] font-bold rounded-full uppercase tracking-widest">
                                    <?= $isActive ? 'Aktif' : 'Nonaktif' ?>
                                </span>
                                <span class="px-3 py-1 <?= $jenjangColor ?> text-white text-[10px] font-bold rounded-full uppercase tracking-widest">
                                    <?= esc($sekolah['jenjang']) ?>
                                </span>
                                <span class="px-3 py-1 bg-white/20 text-white text-[10px] font-bold rounded-full uppercase tracking-widest">
                                    <?= esc($sekolah['status']) ?>
                                </span>
                            </div>
                            <h1 class="text-4xl font-extrabold tracking-tight"><?= esc($sekolah['nama_sekolah']) ?></h1>
                            <p class="text-white/80 text-sm  flex items-center gap-2 mt-1">
                                <span class="material-symbols-outlined text-lg">location_on</span>
                                <?= esc($sekolah['alamat']) ?>
                                <?php if (!empty($sekolah['nama_kecamatan'])): ?>
                                    — Kec. <?= esc($sekolah['nama_kecamatan']) ?>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-3 min-w-fit">
                        <a href="<?= url_to('admin.sekolah') ?>"
                            class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-6 py-2 rounded-xl font-bold hover:bg-white/20 transition-all flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined">arrow_back</span> Kembali
                        </a>
                        <a href="<?= url_to('admin.sekolah.edit', $sekolah['slug']) ?>"
                            class="bg-white text-foreground px-6 py-2 rounded-xl font-bold shadow-xl hover:scale-105 transition-all flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined">edit</span> Edit Data
                        </a>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white/80 backdrop-blur-md border border-white/30 p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] hover:scale-[1.02] transition-transform">
                    <div class="flex items-center justify-between mb-4">
                        <span class="p-2 bg-primary/10 text-primary rounded-lg">
                            <span class="material-symbols-outlined">groups</span>
                        </span>
                        <span class="text-muted-foreground text-[10px] font-bold">
                            <?= !empty($statistik['tahun_ajaran']) ? esc($statistik['tahun_ajaran']) : '—' ?>
                        </span>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">TOTAL SISWA</p>
                    <p class="text-2xl font-extrabold text-foreground">
                        <?= $statistik ? number_format($totalSiswa, 0, ',', '.') : '—' ?>
                    </p>
                    <?php if ($statistik): ?>
                        <p class="text-[10px] text-muted-foreground mt-1">
                            L: <?= $statistik['jumlah_siswa_l'] ?> &nbsp;|&nbsp; P: <?= $statistik['jumlah_siswa_p'] ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="bg-white/80 backdrop-blur-md border border-white/30 p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] hover:scale-[1.02] transition-transform">
                    <div class="flex items-center justify-between mb-4">
                        <span class="p-2 bg-blue-50 text-primary rounded-lg">
                            <span class="material-symbols-outlined">person</span>
                        </span>
                        <span class="text-muted-foreground text-[10px] font-bold">Aktif</span>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">GURU</p>
                    <p class="text-2xl font-extrabold text-foreground">
                        <?= $statistik ? number_format($totalGuru, 0, ',', '.') : '—' ?>
                    </p>
                    <?php if ($statistik): ?>
                        <p class="text-[10px] text-muted-foreground mt-1">
                            Tetap: <?= $statistik['jumlah_guru_tetap'] ?> &nbsp;|&nbsp; Honor: <?= $statistik['jumlah_guru_honor'] ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="bg-white/80 backdrop-blur-md border border-white/30 p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] hover:scale-[1.02] transition-transform">
                    <div class="flex items-center justify-between mb-4">
                        <span class="p-2 bg-slate-100 text-foreground rounded-lg">
                            <span class="material-symbols-outlined">meeting_room</span>
                        </span>
                        <span class="text-muted-foreground text-[10px] font-bold">Rombel</span>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">ROMBONGAN BELAJAR</p>
                    <p class="text-2xl font-extrabold text-foreground">
                        <?= $statistik ? esc($statistik['jumlah_rombel']) : '—' ?>
                    </p>
                </div>

                <div class="bg-white/80 backdrop-blur-md border border-white/30 p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] hover:scale-[1.02] transition-transform">
                    <div class="flex items-center justify-between mb-4">
                        <span class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                            <span class="material-symbols-outlined">straighten</span>
                        </span>
                        <span class="text-muted-foreground text-[10px] font-bold">m²</span>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">LUAS LAHAN</p>
                    <p class="text-2xl font-extrabold text-foreground">
                        <?= !empty($sekolah['luas_lahan']) ? number_format($sekolah['luas_lahan'], 0, ',', '.') : '—' ?>
                    </p>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">

                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                        <div class="flex items-center gap-3 mb-6 border-b border-border pb-4">
                            <span class="material-symbols-outlined text-primary">fingerprint</span>
                            <h3 class="text-xl font-bold tracking-tight">Informasi Identitas</h3>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-8 gap-x-12">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">NPSN</p>
                                <p class="text-base font-bold text-foreground"><?= esc($sekolah['npsn'] ?? '—') ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">NSS</p>
                                <!-- <p class="text-base font-bold text-foreground"><?= esc($sekolah['nss'] ?? '—') ?></p> -->
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">AKREDITASI</p>
                                <?php if (!empty($sekolah['akreditasi'])): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-base font-bold text-primary"><?= esc($sekolah['akreditasi']) ?></span>
                                        <span class="material-symbols-outlined text-amber-500 text-lg" style="font-variation-settings: 'FILL' 1;">verified</span>
                                    </div>
                                <?php else: ?>
                                    <p class="text-base font-bold text-foreground">—</p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">TAHUN BERDIRI</p>
                                <p class="text-base font-bold text-foreground"><?= esc($sekolah['tahun_berdiri'] ?? '—') ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KURIKULUM</p>
                                <p class="text-base font-bold text-foreground"><?= esc($sekolah['kurikulum'] ?? '—') ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KEPALA SEKOLAH</p>
                                <p class="text-base font-bold text-foreground"><?= esc($sekolah['nama_kepsek'] ?? '—') ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                        <div class="flex items-center gap-3 mb-6 border-b border-border pb-4">
                            <span class="material-symbols-outlined text-primary">architecture</span>
                            <h3 class="text-xl font-bold tracking-tight">Fasilitas</h3>
                            <?php if (!empty($fasilitas)): ?>
                                <span class="ml-auto text-[10px] font-bold text-muted-foreground"><?= count($fasilitas) ?> item</span>
                            <?php endif; ?>
                        </div>

                        <?php if (empty($fasilitas)): ?>
                            <p class="text-sm text-muted-foreground text-center py-6">Belum ada data fasilitas.</p>
                        <?php else: ?>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <?php foreach ($fasilitas as $f): ?>
                                    <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl border border-border/50 hover:border-primary/30 hover:bg-primary/5 transition-all group">
                                        <?php
                                        // Lakukan pengecekan apakah ikon merupakan SVG (mengandung karakter '<')
                                        $isSvg = !empty($f['ikon']) && str_contains($f['ikon'], '<');
                                        ?>
                                        <?php if ($isSvg): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="22" height="22" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="text-primary flex-shrink-0">
                                                <?= $f['ikon'] /* SVG path — sudah dari DB, tidak di-escape */ ?>
                                            </svg>
                                        <?php else: ?>
                                            <span class="material-symbols-outlined text-primary text-xl flex-shrink-0"> <?= esc($f['ikon']) ?></span>
                                        <?php endif; ?>
                                        <div class="min-w-0">
                                            <span class="text-sm font-bold block truncate"><?= esc($f['nama_fasilitas']) ?></span>
                                            <?php if (!empty($f['jumlah']) && $f['jumlah'] > 1): ?>
                                                <span class="text-[10px] text-muted-foreground"><?= $f['jumlah'] ?> unit</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                        <div class="flex items-center gap-3 mb-6 border-b border-border pb-4">
                            <span class="material-symbols-outlined text-primary">emoji_events</span>
                            <h3 class="text-xl font-bold tracking-tight">Prestasi Sekolah</h3>
                            <?php if (!empty($prestasi)): ?>
                                <span class="ml-auto text-[10px] font-bold text-muted-foreground"><?= count($prestasi) ?> item</span>
                            <?php endif; ?>
                        </div>

                        <?php if (empty($prestasi)): ?>
                            <div class="space-y-4 flex flex-col">
                                <p class="text-sm text-muted-foreground text-center py-6">Belum ada data prestasi.</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4 flex flex-col">
                                <?php foreach ($prestasi as $p): ?>
                                    <div class="flex flex-col md:flex-row md:items-center justify-between p-4 bg-slate-50 rounded-xl border border-border/50 hover:bg-white hover:shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] transition-all gap-4">
                                        <div class="flex items-start gap-4">
                                            <div class="text-lg font-bold text-primary shrink-0 py-2"><?= $p['tahun'] ?></div>
                                            <div>
                                                <h4 class="text-base font-bold text-primary"><?= $p['nama_prestasi'] ?></h4>
                                                <p class="text-xs text-slate-500 mt-1"><?= $p['keterangan'] ?></p>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="px-2 py-1 bg-blue-50 text-primary text-[9px] font-bold rounded-full uppercase ">Nasional</span>
                                            <span class="px-2 py-1 bg-slate-200 text-slate-600 text-[9px] font-bold rounded-full uppercase ">Akademik</span>

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
                <div class="space-y-8 lg:col-span-1">
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                        <div class="flex items-center gap-3 mb-6 border-b border-border pb-4">
                            <span class="material-symbols-outlined text-primary">alternate_email</span>
                            <h3 class="text-xl font-bold tracking-tight">Detail Kontak</h3>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">TELEPON</p>
                                <p class="text-sm font-bold text-slate-700"><?= esc($sekolah['telepon'] ?? '—') ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">EMAIL</p>
                                <p class="text-sm font-bold text-slate-700"><?= esc($sekolah['email'] ?? '—') ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">WEBSITE</p>
                                <?php if (!empty($sekolah['website'])): ?>
                                    <a class="text-sm font-bold text-primary hover:underline"
                                        href="<?= esc($sekolah['website']) ?>" target="_blank" rel="noopener">
                                        <?= esc($sekolah['website']) ?>
                                    </a>
                                <?php else: ?>
                                    <p class="text-sm font-bold text-slate-700">—</p>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($sekolah['latitude']) && !empty($sekolah['longitude'])): ?>
                                <div class="pt-2">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-3">KOORDINAT GEOGRAFIS</p>
                                    <div class="bg-slate-50 p-4 rounded-xl flex justify-between items-center border border-border/50">
                                        <div>
                                            <p class="text-xs font-bold"><?= esc($sekolah['latitude']) ?>° S</p>
                                            <p class="text-xs font-bold"><?= esc($sekolah['longitude']) ?>° E</p>
                                        </div>
                                        <a href="https://maps.google.com/?q=<?= esc($sekolah['latitude']) ?>,<?= esc($sekolah['longitude']) ?>"
                                            target="_blank" rel="noopener"
                                            class="p-2 bg-white rounded-lg shadow-sm text-primary hover:scale-110 transition-transform">
                                            <span class="material-symbols-outlined">map</span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="bg-foreground p-8 rounded-2xl shadow-xl text-white space-y-3">
                        <button class="w-full bg-white/10 hover:bg-white/20 py-3 rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">download</span> Unduh Laporan Lengkap
                        </button>
                        <button class="w-full bg-white/10 hover:bg-white/20 py-3 rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">share</span> Bagikan Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?= $this->endSection() ?>