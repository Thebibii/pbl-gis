<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>

<?php if (!$sekolah): ?>
    <section class="flex-1 flex items-center justify-center p-8">
        <div class="text-center space-y-6 max-w-md">
            <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto">
                <span class="material-symbols-outlined text-4xl! text-slate-400">school</span>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-foreground mb-2">Sekolah Tidak Ditemukan</h1>
                <p class="text-sm text-muted-foreground">Data sekolah yang Anda cari tidak tersedia atau telah dihapus dari sistem.</p>
            </div>
            <a href="<?= url_to('admin.sekolah') ?>"
                class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform text-sm">
                <span class="material-symbols-outlined text-base!">arrow_back</span> Kembali ke Data Sekolah
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

    <section class="flex-1 overflow-y-auto p-6 pt-12 md:p-8 md:pt-12 space-y-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <section class="rounded-2xl md:rounded-3xl overflow-hidden shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] group">

                <!-- AREA GAMBAR -->
                <div class="relative aspect-video">
                    <?php if (!empty($sekolah['foto_utama'])): ?>
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            src="<?= base_url('uploads/sekolah/' . esc($sekolah['foto_utama'])) ?>" alt="">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl! md:text-8xl! text-slate-400">school</span>
                        </div>
                    <?php endif; ?>

                    <!-- Overlay HANYA tampil di lg ke atas -->
                    <div class="hidden xl:block absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="hidden xl:flex absolute bottom-0 left-0 w-full p-8 flex-row justify-between items-end gap-6">
                        <div class="flex items-center gap-6">
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
                                <p class="text-white/80 text-sm flex items-center gap-2 mt-1">
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
                                class="w-fit whitespace-nowrap bg-white text-foreground px-6 py-2 rounded-xl font-bold shadow-xl hover:scale-105 transition-all flex items-center gap-2 text-sm">
                                <span class="material-symbols-outlined">edit</span> Edit Data
                            </a>
                        </div>
                    </div>
                </div>

                <!-- INFO CARD — HANYA tampil di bawah lg -->
                <div class="xl:hidden p-5 bg-white/80 backdrop-blur-md border border-white/30 ">
                    <div class="flex gap-2 mb-3 flex-wrap">
                        <span class="px-3 py-1 <?= $isActive ? 'bg-green-500' : 'bg-slate-500' ?> text-white text-[10px] font-bold rounded-full uppercase tracking-widest">
                            <?= $isActive ? 'Aktif' : 'Nonaktif' ?>
                        </span>
                        <span class="px-3 py-1 <?= $jenjangColor ?> text-white text-[10px] font-bold rounded-full uppercase tracking-widest">
                            <?= esc($sekolah['jenjang']) ?>
                        </span>
                        <span class="px-3 py-1 bg-slate-800 text-white text-[10px] font-bold rounded-full uppercase tracking-widest">
                            <?= esc($sekolah['status']) ?>
                        </span>
                    </div>

                    <h1 class="text-xl font-extrabold tracking-tight text-foreground"><?= esc($sekolah['nama_sekolah']) ?></h1>
                    <p class="text-slate-500 text-sm flex items-start gap-2 mt-1">
                        <span class="material-symbols-outlined text-lg">location_on</span>
                        <span>
                            <?= esc($sekolah['alamat']) ?>
                            <?php if (!empty($sekolah['nama_kecamatan'])): ?>
                                — Kec. <?= esc($sekolah['nama_kecamatan']) ?>
                            <?php endif; ?>
                        </span>
                    </p>

                    <div class="flex gap-3 mt-4">
                        <a href="<?= url_to('admin.sekolah') ?>"
                            class="flex-1 justify-center bg-slate-100 text-foreground px-4 py-2 rounded-xl font-bold hover:bg-slate-200 transition-all flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali
                        </a>
                        <a href="<?= url_to('admin.sekolah.edit', $sekolah['slug']) ?>"
                            class="flex-1 justify-center bg-primary text-white px-4 py-2 rounded-xl font-bold shadow-xl hover:scale-105 transition-all flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-lg">edit</span> Edit Data
                        </a>
                    </div>
                </div>
            </section>

            <!-- <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
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
            </section> -->

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div class="xl:col-span-2 space-y-8">

                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl md:rounded-3xl p-4.5 md:p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
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
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KEPALA SEKOLAH</p>
                                <p class="text-base font-bold text-foreground"><?= esc($sekolah['nama_kepsek'] ?? '—') ?></p>
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
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KURIKULUM</p>
                                <p class="text-base font-bold text-foreground"><?= esc($sekolah['kurikulum'] ?? '—') ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">JENJANG</p>
                                <p class="text-base font-bold text-foreground"><?= esc($sekolah['jenjang'] ?? '—') ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">STATUS</p>
                                <p class="text-base font-bold text-foreground"><?= esc($sekolah['status'] ?? '—') ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-8">
                        <div class="p-6 md:p-8 bg-white/80 backdrop-blur-md border border-border/50 rounded-2xl md:rounded-3xl relative overflow-hidden group shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                            <span class="material-symbols-outlined text-[140px]! text-primary/5 absolute -right-4 -top-4 font-bold italic transition-colors group-hover:text-primary/10">format_quote</span>
                            <h3 class="text-sm font-bold text-primary mb-6 uppercase tracking-[0.2em]">Visi</h3>
                            <p class="text-xl md:text-2xl italic font-medium leading-relaxed text-foreground relative z-10 max-w-3xl">
                                "<?= esc($sekolah['visi'] ?? "Belum ada visi yang ditetapkan") ?>"
                            </p>
                        </div>
                        <div class="p-6 md:p-8 bg-white/80 backdrop-blur-md border border-border/50 rounded-2xl md:rounded-3xl relative overflow-hidden group shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                            <span class="material-symbols-outlined text-[140px]! text-primary/5 absolute -right-4 -top-4 font-bold italic transition-colors group-hover:text-primary/10">format_quote</span>
                            <h3 class="text-sm font-bold text-primary mb-6 uppercase tracking-[0.2em]">Misi</h3>
                            <p class="md:text-xl font-medium leading-relaxed text-foreground relative z-10 max-w-3xl">
                                <?= nl2br(esc($sekolah['misi'] ?? "Belum ada misi yang ditetapkan")) ?>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="space-y-8 xl:col-span-1">
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl md:rounded-3xl p-4.5 md:p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
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
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?= $this->endSection() ?>