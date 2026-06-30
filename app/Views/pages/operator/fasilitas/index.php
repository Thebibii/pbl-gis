<?= $this->extend('layouts/operator-sekolah') ?>

<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Operator</span><span>/</span>
                    <span class="text-primary">Manajemen Fasilitas</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Manajemen Fasilitas Sekolah</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Kelola daftar sarana dan prasarana sekolah Anda.
                </p>
            </div>
            <button type="button"
                class="flex text-sm items-center gap-2 px-6 py-2 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah Fasilitas
            </button>
        </header>

        <!-- Search -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
            <div class="flex-1 relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                <input id="search-input"
                    class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                    placeholder="Cari fasilitas..."
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
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Nama Fasilitas</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Jumlah / Keterangan</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-32 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        <!-- Row 1 -->
                        <tr class="hover:bg-primary/5 transition-colors group">
                            <td class="px-6 py-5 text-center text-sm text-muted-foreground">1</td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">computer</span>
                                    </div>
                                    <span class="font-bold text-foreground text-sm">Laboratorium Komputer</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-sm text-foreground">2 Unit</span>
                                    <span class="px-3 py-1 bg-emerald-500/90 text-white rounded-full text-[10px] font-bold uppercase">Baik</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
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
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">local_library</span>
                                    </div>
                                    <span class="font-bold text-foreground text-sm">Perpustakaan</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-sm text-foreground">1 Ruang</span>
                                    <span class="px-3 py-1 bg-[#EAB308]/90 text-foreground rounded-full text-[10px] font-bold uppercase">Perlu Perbaikan</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
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
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-500">
                                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">meeting_room</span>
                                    </div>
                                    <span class="font-bold text-foreground text-sm">Ruang Kelas</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-sm text-foreground">36 Ruang</span>
                                    <span class="px-3 py-1 bg-emerald-500/90 text-white rounded-full text-[10px] font-bold uppercase">Aktif</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
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
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">sports_soccer</span>
                                    </div>
                                    <span class="font-bold text-foreground text-sm">Lapangan Olahraga</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-sm text-foreground">2 Lapangan</span>
                                    <span class="px-3 py-1 bg-emerald-500/90 text-white rounded-full text-[10px] font-bold uppercase">Baik</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
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
                <p class="text-xs font-medium text-muted-foreground">Menampilkan 1-4 dari 4 fasilitas</p>
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border opacity-30 cursor-not-allowed" disabled>
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold bg-primary text-white shadow-md shadow-primary/20">1</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border opacity-30 cursor-not-allowed" disabled>
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>