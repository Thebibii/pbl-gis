<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Admin</span><span>/</span>
                    <span class="text-primary">Wilayah</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Wilayah</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Kelola dan pantau sebaran <span class="font-bold text-primary">Kecamatan</span> di Kabupaten Tanah Datar.
                </p>
            </div>
            <button type="button" onclick="openAddModal()"
                class="flex text-sm items-center gap-2 px-6 py-2 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Data
            </button>
        </header>

        <!-- Flash messages -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-bold px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">check_circle</span>
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-sm font-bold px-4 py-3 rounded-xl flex items-center gap-2">
                <span class="material-symbols-outlined">error</span>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-sm font-bold px-4 py-3 rounded-xl space-y-1">
                <p class="flex items-center gap-2"><span class="material-symbols-outlined">error</span> Validasi gagal:</p>
                <ul class="list-disc list-inside pl-6 font-normal">
                    <?php foreach (session()->getFlashdata('errors') as $err) : ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Search (button only, server-side) -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
            <form method="get" action="<?= url_to('admin.wilayah') ?>" class="flex gap-3">
                <div class="flex-1 relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <input name="search" value="<?= esc($search) ?>"
                        class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                        placeholder="Cari nama atau kode kecamatan..."
                        type="text" />
                </div>
                <button type="submit"
                    class="px-6 py-3 bg-primary text-white text-sm font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                    Cari
                </button>
                <?php if ($search !== '') : ?>
                    <a href="<?= url_to('admin.wilayah') ?>"
                        class="px-6 py-3 border border-border text-sm font-bold rounded-xl hover:bg-slate-50 transition-all flex items-center">
                        Reset
                    </a>
                <?php endif; ?>
            </form>
        </section>

        <!-- Table -->
        <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-border">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-16 text-center">No</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Nama Kecamatan</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Kode</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Jumlah Sekolah</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">GeoJSON</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Warna</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground text-right w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        <?php if (empty($rows)) : ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-sm text-muted-foreground">
                                    Tidak ada data yang sesuai.
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $no = ($currentPage - 1) * $perPage + 1; ?>
                            <?php foreach ($rows as $item) : ?>
                                <tr class="hover:bg-primary/5 transition-colors group">
                                    <td class="px-6 py-5 text-sm font-bold text-slate-500 text-center"><?= $no++ ?></td>
                                    <td class="px-6 py-5">
                                        <p class="font-bold text-foreground text-sm"><?= esc($item['nama_kecamatan']) ?></p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-xs font-mono bg-slate-100 px-2 py-1 rounded-lg text-slate-600"><?= esc($item['kode_kecamatan'] ?? '—') ?></span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold">
                                            <span class="material-symbols-outlined text-sm">school</span>
                                            <?= (int) $item['jumlah_sekolah'] ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <?php if (!empty($item['geojson_file'])) : ?>
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-medium">
                                                <span class="material-symbols-outlined text-sm">check_circle</span>
                                                <?= esc($item['geojson_file']) ?>
                                            </span>
                                        <?php else : ?>
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-slate-100 text-slate-400 text-xs font-medium">
                                                <span class="material-symbols-outlined text-sm">cancel</span>
                                                Belum diset
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-5">
                                        <?php if (!empty($item['warna'])) : ?>
                                            <div class="flex items-center gap-2">
                                                <span class="w-5 h-5 rounded-md ring-1 ring-black/10 flex-shrink-0" style="background-color:<?= esc($item['warna']) ?>"></span>
                                                <span class="text-xs font-mono text-slate-500"><?= esc($item['warna']) ?></span>
                                            </div>
                                        <?php else : ?>
                                            <span class="text-xs text-slate-400">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                            <button type="button" onclick="openEditModal(this)"
                                                data-id="<?= esc($item['id']) ?>"
                                                data-nama="<?= esc($item['nama_kecamatan'], 'attr') ?>"
                                                data-geojson="<?= esc($item['geojson_file'] ?? '', 'attr') ?>"
                                                data-lat="<?= esc($item['latitude'] ?? '', 'attr') ?>"
                                                data-lng="<?= esc($item['longitude'] ?? '', 'attr') ?>"
                                                data-warna="<?= esc($item['warna'] ?? '', 'attr') ?>"
                                                class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-all">
                                                <span class="material-symbols-outlined">edit</span>
                                            </button>
                                            <button type="button" onclick="openDeleteModal(this)"
                                                data-id="<?= esc($item['id']) ?>"
                                                data-nama="<?= esc($item['nama_kecamatan'], 'attr') ?>"
                                                class="p-2 hover:bg-rose-50 rounded-lg text-rose-600 transition-all">
                                                <span class="material-symbols-outlined">restart_alt</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-white/50 border-t border-border flex flex-col sm:flex-row justify-between items-center gap-4">
                <?php
                $from = $total === 0 ? 0 : ($currentPage - 1) * $perPage + 1;
                $to   = min($currentPage * $perPage, $total);
                ?>
                <p class="text-xs font-medium text-muted-foreground">
                    <?= $total === 0
                        ? 'Tidak ada data'
                        : "Menampilkan {$from} – {$to} dari " . number_format($total, 0, ',', '.') . " kecamatan" ?>
                </p>

                <?php if ($lastPage > 1) : ?>
                    <?php
                    $btnBase     = 'w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold transition-all';
                    $btnActive   = "$btnBase bg-primary text-white shadow-md shadow-primary/20";
                    $btnNormal   = "$btnBase border border-border hover:bg-slate-50";
                    $btnDisabled = "$btnBase border border-border opacity-30 cursor-not-allowed";
                    $qs = $search !== '' ? '&search=' . rawurlencode($search) : '';
                    ?>
                    <div class="flex items-center gap-2">
                        <?php if ($currentPage === 1) : ?>
                            <span class="<?= $btnDisabled ?>"><span class="material-symbols-outlined">chevron_left</span></span>
                        <?php else : ?>
                            <a href="?page=<?= $currentPage - 1 ?><?= $qs ?>" class="<?= $btnNormal ?>"><span class="material-symbols-outlined">chevron_left</span></a>
                        <?php endif; ?>

                        <?php foreach ($pages as $p) : ?>
                            <?php if ($p === '...') : ?>
                                <span class="px-2 text-muted-foreground">...</span>
                            <?php elseif ($p === $currentPage) : ?>
                                <span class="<?= $btnActive ?>"><?= $p ?></span>
                            <?php else : ?>
                                <a href="?page=<?= $p ?><?= $qs ?>" class="<?= $btnNormal ?>"><?= $p ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if ($currentPage === $lastPage) : ?>
                            <span class="<?= $btnDisabled ?>"><span class="material-symbols-outlined">chevron_right</span></span>
                        <?php else : ?>
                            <a href="?page=<?= $currentPage + 1 ?><?= $qs ?>" class="<?= $btnNormal ?>"><span class="material-symbols-outlined">chevron_right</span></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<!-- ══ MODAL TAMBAH ══════════════════════════════════════════════════ -->
<div id="add-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-lg mx-4 space-y-6">
        <div class="flex items-center justify-between border-b pb-4">
            <h2 class="text-lg font-extrabold text-foreground">Tambah Data Wilayah</h2>
            <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-rose-500 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form method="post" action="<?= url_to('admin.wilayah.store') ?>" class="space-y-4">
            <?= csrf_field() ?>

            <!-- Kecamatan -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Kecamatan</label>
                <select name="kecamatan_id"
                    class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    <?php foreach ($kecamatanList as $k) : ?>
                        <option value="<?= esc($k['id']) ?>" <?= old('kecamatan_id') == $k['id'] ? 'selected' : '' ?>>
                            <?= esc($k['nama_kecamatan']) ?> (<?= esc($k['kode_kecamatan']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- GeoJSON -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">File GeoJSON</label>
                <select name="geojson_file"
                    class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    <option value="">-- Tidak Ada / Pilih File --</option>
                    <?php foreach ($geojsonFiles as $f) : ?>
                        <option value="<?= esc($f) ?>" <?= old('geojson_file') === $f ? 'selected' : '' ?>><?= esc($f) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Koordinat -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Latitude</label>
                    <input type="text" name="latitude" value="<?= old('latitude') ?>" placeholder="-0.456789"
                        class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Longitude</label>
                    <input type="text" name="longitude" value="<?= old('longitude') ?>" placeholder="100.456789"
                        class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
            </div>

            <!-- Warna -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Warna Wilayah</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="warna" id="add-warna" value="<?= old('warna') ?: '#3b82f6' ?>"
                        class="w-12 h-10 rounded-lg border border-border cursor-pointer bg-slate-50 p-1">
                    <span id="add-warna-hex" class="text-sm font-mono text-slate-500"><?= old('warna') ?: '#3b82f6' ?></span>
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="closeAddModal()"
                    class="flex-1 py-3 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-slate-50 transition-all">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-primary text-white text-sm font-bold hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ══ MODAL EDIT ════════════════════════════════════════════════════ -->
<div id="edit-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-lg mx-4 space-y-6">
        <div class="flex items-center justify-between border-b pb-4">
            <h2 class="text-lg font-extrabold text-foreground">Edit Data Wilayah</h2>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-rose-500 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="edit-form" method="post" action="" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" id="edit-id" name="id">

            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Kecamatan</label>
                <div id="edit-nama-display"
                    class="w-full px-4 py-3 bg-slate-100 border border-border rounded-xl text-sm font-bold text-foreground cursor-not-allowed">
                    —
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">File GeoJSON</label>
                <select name="geojson_file" id="edit-geojson-select"
                    class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    <option value="">-- Tidak Ada / Pilih File --</option>
                    <?php foreach ($geojsonFiles as $f) : ?>
                        <option value="<?= esc($f) ?>"><?= esc($f) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Latitude</label>
                    <input type="text" name="latitude" id="edit-latitude" placeholder="-0.456789"
                        class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Longitude</label>
                    <input type="text" name="longitude" id="edit-longitude" placeholder="100.456789"
                        class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Warna Wilayah</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="warna" id="edit-warna" value="#3b82f6"
                        class="w-12 h-10 rounded-lg border border-border cursor-pointer bg-slate-50 p-1">
                    <span id="edit-warna-hex" class="text-sm font-mono text-slate-500">#3b82f6</span>
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="closeEditModal()"
                    class="flex-1 py-3 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-slate-50 transition-all">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-primary text-white text-sm font-bold hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ══ MODAL RESET/HAPUS ═════════════════════════════════════════════ -->
<div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 space-y-6">
        <div class="flex flex-col items-center gap-3 text-center">
            <div class="w-14 h-14 rounded-full bg-rose-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-rose-500 text-3xl">restart_alt</span>
            </div>
            <h2 class="text-lg font-extrabold text-foreground">Reset Data Wilayah?</h2>
            <p class="text-sm text-muted-foreground">
                GeoJSON dan koordinat <span id="modal-wilayah-name" class="font-bold text-foreground"></span>
                akan direset ke kosong. Data kecamatan tidak akan dihapus.
            </p>
        </div>
        <form id="delete-form" method="post" action="">
            <?= csrf_field() ?>
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 py-3 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-slate-50 transition-all">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-rose-500 text-white text-sm font-bold hover:bg-rose-600 transition-all shadow-lg shadow-rose-500/20">
                    Ya, Reset
                </button>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>


<?= $this->section('scripts') ?>
<script>
    const BASE_URL = '<?= base_url('admin/wilayah') ?>';

    // ── Modal Tambah ──────────────────────────────────────────────────
    function openAddModal() {
        const modal = document.getElementById('add-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeAddModal() {
        const modal = document.getElementById('add-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('add-modal').addEventListener('click', function(e) {
        if (e.target === this) closeAddModal();
    });

    document.getElementById('add-warna').addEventListener('input', function() {
        document.getElementById('add-warna-hex').textContent = this.value;
    });

    // ── Modal Edit ────────────────────────────────────────────────────
    function openEditModal(btn) {
        const {
            id,
            nama,
            geojson,
            lat,
            lng,
            warna
        } = btn.dataset;

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nama-display').textContent = nama;
        document.getElementById('edit-latitude').value = lat;
        document.getElementById('edit-longitude').value = lng;
        document.getElementById('edit-geojson-select').value = geojson;

        const warnaInput = document.getElementById('edit-warna');
        const warnaHex = document.getElementById('edit-warna-hex');
        warnaInput.value = warna || '#3b82f6';
        warnaHex.textContent = warna || '#3b82f6';

        document.getElementById('edit-form').action = `${BASE_URL}/${id}/update`;

        const modal = document.getElementById('edit-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('edit-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('edit-modal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    document.getElementById('edit-warna').addEventListener('input', function() {
        document.getElementById('edit-warna-hex').textContent = this.value;
    });

    // ── Modal Reset ───────────────────────────────────────────────────
    function openDeleteModal(btn) {
        const {
            id,
            nama
        } = btn.dataset;
        document.getElementById('modal-wilayah-name').textContent = nama;
        document.getElementById('delete-form').action = `${BASE_URL}/${id}/delete`;

        const modal = document.getElementById('delete-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
<?= $this->endSection() ?>