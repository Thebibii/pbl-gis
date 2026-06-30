<?= $this->extend('layouts/operator-sekolah') ?>
<?= $this->section('content') ?>

<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Operator</span><span>/</span>
                    <span class="text-primary">Profil Sekolah</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Manajemen Profil Sekolah</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Perbarui informasi, lokasi, dan detail akademik sekolah Anda.
                </p>
            </div>
            <div class="flex gap-3">
                <button class="px-4 py-2 rounded-xl border border-border text-muted-foreground font-bold text-xs uppercase tracking-wider hover:bg-slate-50 transition-colors">
                    BATAL
                </button>
                <button class="px-6 py-2 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:scale-105 transition-transform flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    SIMPAN
                </button>
            </div>
        </header>

        <form class="space-y-6">

            <!-- Identity Section (Readonly) -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                <div class="p-6 border-b border-border">
                    <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">badge</span>
                        Identitas Sekolah
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Nama Sekolah</label>
                            <input class="w-full bg-slate-50 border border-border rounded-xl px-4 py-2.5 text-sm font-medium text-slate-500 cursor-not-allowed focus:ring-0 outline-none" readonly type="text" value="SMA Negeri 1 Contoh"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">NPSN</label>
                            <input class="w-full bg-slate-50 border border-border rounded-xl px-4 py-2.5 text-sm font-medium text-slate-500 cursor-not-allowed focus:ring-0 outline-none" readonly type="text" value="20123456"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Jenjang</label>
                            <select class="w-full bg-slate-50 border border-border rounded-xl px-4 py-2.5 text-sm font-medium text-slate-500 cursor-not-allowed focus:ring-0 outline-none appearance-none" disabled>
                                <option selected>SMA</option>
                                <option>SMK</option>
                                <option>SMP</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Columns Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Staff & Contact Section -->
                <div class="space-y-6">
                    <!-- Staff & Leadership -->
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                        <div class="p-6 border-b border-border">
                            <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">person</span>
                                Staf &amp; Kepemimpinan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                    Nama Kepala Sekolah <span class="text-red-500">*</span>
                                </label>
                                <input class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" placeholder="Masukkan nama lengkap" required type="text" value="Dr. H. Ahmad Fauzi, M.Pd"/>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Digital -->
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                        <div class="p-6 border-b border-border">
                            <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">contact_mail</span>
                                Kontak Digital
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Telepon <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" pattern="[0-9]*" placeholder="021-xxxxxxx" required type="tel" value="0751-12345"/>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" placeholder="sekolah@contoh.sch.id" required type="email" value="sman1contoh@sch.id"/>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Website
                                    </label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-border bg-slate-50 text-muted-foreground text-sm font-medium">https://</span>
                                        <input class="flex-1 bg-slate-100 border-none rounded-r-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" placeholder="www.sekolah.sch.id" type="url" value="www.sman1contoh.sch.id"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic & Physical Section -->
                <div class="space-y-6">
                    <!-- Academic Data -->
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                        <div class="p-6 border-b border-border">
                            <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">menu_book</span>
                                Data Akademik
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Status Akreditasi <span class="text-red-500">*</span>
                                    </label>
                                    <select class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" required>
                                        <option value="A" selected>A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="NA">Tidak Terakreditasi</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Kurikulum <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" placeholder="Contoh: Kurikulum Merdeka" required type="text" value="Kurikulum Merdeka"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Physical Data -->
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                        <div class="p-6 border-b border-border">
                            <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">architecture</span>
                                Data Fisik
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                    Luas Lahan (m²) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 pr-12 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" placeholder="10000" required type="number" value="12000"/>
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-muted-foreground text-sm font-medium">m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location Section -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                <div class="p-6 border-b border-border">
                    <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        Pemetaan Lokasi
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all resize-none" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..." required rows="4">Jl. Pendidikan No. 123, Kelurahan Padang Panjang, Kecamatan Padang Panjang Timur</textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Latitude <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" placeholder="-6.200000" required step="any" type="number" value="-0.4637"/>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Longitude <span class="text-red-500">*</span>
                                    </label>
                                    <input class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all" placeholder="106.816666" required step="any" type="number" value="100.4000"/>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 h-full min-h-[240px] flex flex-col">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Pilih di Peta</label>
                            <div class="flex-1 w-full bg-slate-100 rounded-xl border border-border relative overflow-hidden group">
                                <!-- Map Placeholder -->
                                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CjxyZWN0IHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgZmlsbD0iI2YwZjRmOCI+PC9yZWN0Pgo8cGF0aCBkPSJNMCAwbDQwIDQwbS00MCAwaDQwbS00MCAwdjQwbS00MC00MGg0MCIgc3Ryb2tlPSIjZTJlOGYwIiBzdHJva2Utd2lkdGg9IjEiPjwvcGF0aD4KPC9zdmc+')] opacity-60"></div>
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="w-12 h-12 relative animate-bounce">
                                        <span class="material-symbols-outlined text-primary text-[48px] absolute drop-shadow-md">location_on</span>
                                    </div>
                                </div>
                                <div class="absolute bottom-3 left-3 right-3 bg-white/90 backdrop-blur-sm p-2.5 rounded-lg border border-white/50 text-center text-xs font-medium text-muted-foreground shadow-sm">
                                    Klik dan geser pin untuk mengatur koordinat
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Section -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                <div class="p-6 border-b border-border">
                    <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">image</span>
                        Media Visual
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Foto Utama Sekolah (Max 2MB)</label>
                        <div class="mt-2 flex justify-center rounded-2xl border-2 border-dashed border-border px-6 py-12 bg-slate-50/50 hover:bg-slate-100/50 transition-colors cursor-pointer group">
                            <div class="text-center">
                                <span class="material-symbols-outlined text-[48px] text-slate-400 group-hover:text-primary transition-colors mb-3">add_photo_alternate</span>
                                <div class="mt-2 flex text-sm leading-6 text-muted-foreground justify-center font-medium">
                                    <label class="relative cursor-pointer rounded-md bg-transparent font-bold text-primary focus-within:outline-none hover:text-blue-700 transition-colors" for="file-upload">
                                        <span>Upload a file</span>
                                        <input accept="image/*" class="sr-only" id="file-upload" name="file-upload" type="file"/>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs font-medium text-slate-400 mt-1">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

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

    // Save button
    document.querySelector('.bg-primary').addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Simpan perubahan data sekolah?')) {
            alert('Data sekolah berhasil disimpan! (Simulasi)');
        }
    });

    // Cancel button
    document.querySelector('.border-border').addEventListener('click', function(e) {
        if (confirm('Yakin ingin membatalkan perubahan?')) {
            location.reload();
        }
    });

    // File upload preview
    document.getElementById('file-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            alert('File "' + file.name + '" siap diupload!');
        }
    });
</script>
<?= $this->endSection() ?>