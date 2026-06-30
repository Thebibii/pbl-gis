<?= $this->extend('layouts/operator-sekolah') ?>
<?= $this->section('content') ?>

<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="text-primary">Dashboard</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Dashboard Operator</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Selamat datang, <span class="font-bold text-primary"><?= $user->username ?? 'Operator' ?></span>! 
                    Kelola data sekolah Anda dengan mudah.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-bold text-foreground"><?= date('l, d F Y') ?></p>
                    <p class="text-xs text-muted-foreground"><?= date('H:i:s') ?> WIB</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-3xl">account_circle</span>
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stat Card 1 - Total Siswa -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">group</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold tracking-tight">1,240</p>
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Total Siswa</p>
                </div>
            </div>

            <!-- Stat Card 2 - Total Guru -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">person_apron</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold tracking-tight">64</p>
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Total Guru</p>
                </div>
            </div>

            <!-- Stat Card 3 - Jumlah Fasilitas -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">business_center</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold tracking-tight">32</p>
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Jumlah Fasilitas</p>
                </div>
            </div>

            <!-- Stat Card 4 - Jumlah Prestasi -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold tracking-tight">12</p>
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Jumlah Prestasi</p>
                </div>
            </div>
        </div>

        <!-- Two Columns Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column (Alerts) -->
            <div class="lg:col-span-2 flex flex-col gap-8">

                <!-- Alerts Section -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-lg font-bold text-foreground">Perlu Perhatian</h3>
                    
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-5 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] border-l-4 border-l-amber-500 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">warning</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-foreground">Lengkapi Koordinat</h4>
                            <p class="text-xs text-muted-foreground font-medium mt-1">Titik lokasi sekolah Anda belum ditentukan pada peta</p>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-5 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] border-l-4 border-l-amber-500 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-xl">image</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-foreground">Foto Utama Kosong</h4>
                            <p class="text-xs text-muted-foreground font-medium mt-1">Unggah foto depan sekolah untuk ditampilkan di profil publik</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (Actions & Activity) -->
            <div class="flex flex-col gap-8">

                <!-- Quick Actions -->
                <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-6">
                    <h3 class="text-lg font-bold text-foreground">Aksi Cepat</h3>
                    <div class="flex flex-col gap-3">
                        <a href="<?= base_url('operator/sekolah/edit') ?>" class="w-full py-3 px-4 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-transform flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">edit</span>
                            Lengkapi Profil
                        </a>
                        <a href="<?= base_url('operator/statistik') ?>" class="w-full py-3 px-4 bg-slate-50 text-primary border border-border rounded-xl text-sm font-bold hover:bg-slate-100 transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">bar_chart</span>
                            Input Statistik
                        </a>
                        <a href="<?= base_url('operator/fasilitas') ?>" class="w-full py-3 px-4 bg-slate-50 text-primary border border-border rounded-xl text-sm font-bold hover:bg-slate-100 transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">add_circle</span>
                            Tambah Fasilitas
                        </a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex-1">
                    <h3 class="text-lg font-bold text-foreground mb-6">Aktivitas Terakhir</h3>
                    <div class="space-y-0">
                        <div class="flex items-start gap-4 py-4 border-b border-border group">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-1">
                                <span class="w-2.5 h-2.5 bg-primary rounded-full"></span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-foreground">Profil diupdate</p>
                                <p class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider mt-1">2 jam lalu</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 py-4 border-b border-border group">
                            <div class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center shrink-0 mt-1">
                                <span class="w-2.5 h-2.5 bg-slate-300 rounded-full"></span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-foreground">Prestasi baru ditambahkan</p>
                                <p class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider mt-1">Kemarin</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 py-4 border-b border-border group">
                            <div class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center shrink-0 mt-1">
                                <span class="w-2.5 h-2.5 bg-slate-300 rounded-full"></span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-foreground">Data fasilitas diperbarui</p>
                                <p class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider mt-1">3 hari lalu</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 py-4 border-b border-border group">
                            <div class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center shrink-0 mt-1">
                                <span class="w-2.5 h-2.5 bg-slate-300 rounded-full"></span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-foreground">Statistik siswa tahun 2024 diinput</p>
                                <p class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider mt-1">1 minggu lalu</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 py-4 group">
                            <div class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center shrink-0 mt-1">
                                <span class="w-2.5 h-2.5 bg-slate-300 rounded-full"></span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-foreground">Koordinat diperbarui</p>
                                <p class="text-[10px] font-bold text-muted-foreground uppercase tracking-wider mt-1">2 minggu lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Simple Micro-interactions
    document.querySelectorAll('a, button').forEach(el => {
        el.addEventListener('click', function(e) {
            if (this.getAttribute('href') === '#') e.preventDefault();
        });
    });
</script>
<?= $this->endSection() ?>