<?= $this->extend('layouts/operator-sekolah') ?>

<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Operator</span><span>/</span>
                    <span class="text-primary">Manajemen Prestasi</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Manajemen Prestasi Sekolah</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Kelola daftar prestasi akademik dan non-akademik sekolah Anda.
                </p>
            </div>
            <button type="button"
                class="flex text-sm items-center gap-2 px-6 py-2 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah Prestasi
            </button>
        </header>

        <!-- Search -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
            <div class="flex-1 relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                <input id="search-input"
                    class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                    placeholder="Cari prestasi..."
                    type="text" />
            </div>
        </section>

        <!-- Main Table Section -->
        <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-border">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-16 text-center">No</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Nama Prestasi</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-32">Tingkat</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-24">Tahun</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-36 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        <!-- Row 1 -->
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-5 text-center text-sm text-muted-foreground">1</td>
                            <td class="px-6 py-5 text-sm font-bold text-foreground">Juara 1 OSN Matematika</td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-[#3B82F6]/90 text-white rounded-full text-[10px] font-bold uppercase">Nasional</span>
                            </td>
                            <td class="px-6 py-5 text-sm font-medium text-muted-foreground">2024</td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-all" title="Lihat Bukti">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                    <button class="p-2 hover:bg-slate-100 rounded-lg text-foreground transition-all" title="Edit">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="p-2 hover:bg-rose-50 rounded-lg text-rose-600 transition-all" title="Hapus">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-5 text-center text-sm text-muted-foreground">2</td>
                            <td class="px-6 py-5 text-sm font-bold text-foreground">Juara Harapan 1 Lomba Paduan Suara</td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-[#EAB308]/90 text-foreground rounded-full text-[10px] font-bold uppercase">Provinsi</span>
                            </td>
                            <td class="px-6 py-5 text-sm font-medium text-muted-foreground">2023</td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-all" title="Lihat Bukti">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                    <button class="p-2 hover:bg-slate-100 rounded-lg text-foreground transition-all" title="Edit">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="p-2 hover:bg-rose-50 rounded-lg text-rose-600 transition-all" title="Hapus">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-5 text-center text-sm text-muted-foreground">3</td>
                            <td class="px-6 py-5 text-sm font-bold text-foreground">Sekolah Adiwiyata Mandiri</td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-emerald-500/90 text-white rounded-full text-[10px] font-bold uppercase">Nasional</span>
                            </td>
                            <td class="px-6 py-5 text-sm font-medium text-muted-foreground">2022</td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-all" title="Lihat Bukti">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                    <button class="p-2 hover:bg-slate-100 rounded-lg text-foreground transition-all" title="Edit">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="p-2 hover:bg-rose-50 rounded-lg text-rose-600 transition-all" title="Hapus">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-5 text-center text-sm text-muted-foreground">4</td>
                            <td class="px-6 py-5 text-sm font-bold text-foreground">Medali Emas Pencak Silat O2SN</td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-slate-200 text-slate-700 rounded-full text-[10px] font-bold uppercase">Kabupaten</span>
                            </td>
                            <td class="px-6 py-5 text-sm font-medium text-muted-foreground">2023</td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-all" title="Lihat Bukti">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                    <button class="p-2 hover:bg-slate-100 rounded-lg text-foreground transition-all" title="Edit">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="p-2 hover:bg-rose-50 rounded-lg text-rose-600 transition-all" title="Hapus">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-white/50 border-t border-border flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-xs font-medium text-muted-foreground">Menampilkan 1-4 dari 12 prestasi</p>
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border opacity-30 cursor-not-allowed" disabled>
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold bg-primary text-white shadow-md shadow-primary/20">1</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border hover:bg-slate-50 transition-all">2</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border hover:bg-slate-50 transition-all">3</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border hover:bg-slate-50 transition-all">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>