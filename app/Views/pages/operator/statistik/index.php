<?= $this->extend('layouts/operator-sekolah') ?>
<?= $this->section('content') ?>

<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Operator</span><span>/</span>
                    <span class="text-primary">Statistik Sekolah</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Manajemen Statistik Sekolah</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Perbarui dan kelola data demografi siswa dan tenaga pendidik.
                </p>
            </div>
            <div class="flex gap-3">
                <button class="px-4 py-2 rounded-xl border border-border text-muted-foreground font-bold text-xs uppercase tracking-wider hover:bg-slate-50 transition-colors">
                    BATAL
                </button>
                <button class="px-6 py-2 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:scale-105 transition-transform flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    SIMPAN STATISTIK
                </button>
            </div>
        </header>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total Siswa Card -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex items-center gap-5 hover:shadow-soft transition-shadow">
                <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center shrink-0 text-primary">
                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">groups</span>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-muted-foreground mb-1">Total Siswa Aktif</p>
                    <p class="text-3xl text-foreground font-bold">1,245</p>
                </div>
            </div>

            <!-- Total Guru Card -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex items-center gap-5 hover:shadow-soft transition-shadow">
                <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center shrink-0 text-primary">
                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">engineering</span>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-muted-foreground mb-1">Total Tenaga Pendidik</p>
                    <p class="text-3xl text-foreground font-bold">84</p>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <form class="space-y-6">

            <!-- Data Siswa Section -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                <div class="p-6 border-b border-border">
                    <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">person</span>
                        Data Siswa
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground" for="siswa_laki">
                                Jumlah Siswa Laki-laki
                            </label>
                            <input 
                                class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" 
                                id="siswa_laki" 
                                name="siswa_laki" 
                                placeholder="0" 
                                type="number" 
                                value="620"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground" for="siswa_perempuan">
                                Jumlah Siswa Perempuan
                            </label>
                            <input 
                                class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" 
                                id="siswa_perempuan" 
                                name="siswa_perempuan" 
                                placeholder="0" 
                                type="number" 
                                value="625"/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Tenaga Pendidik Section -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                <div class="p-6 border-b border-border">
                    <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">badge</span>
                        Data Tenaga Pendidik
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground" for="guru_tetap">
                                Jumlah Guru Tetap
                            </label>
                            <input 
                                class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" 
                                id="guru_tetap" 
                                name="guru_tetap" 
                                placeholder="0" 
                                type="number" 
                                value="60"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground" for="guru_honorer">
                                Jumlah Guru Honorer
                            </label>
                            <input 
                                class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" 
                                id="guru_honorer" 
                                name="guru_honorer" 
                                placeholder="0" 
                                type="number" 
                                value="24"/>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
</section>

<?= $this->endSection() ?>