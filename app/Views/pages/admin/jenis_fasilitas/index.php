<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Admin</span><span>/</span>
                    <span class="text-primary">Jenis Fasilitas</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Jenis Fasilitas</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Kelola data <span class="font-bold text-primary">Jenis Fasilitas</span> yang tersedia untuk sekolah.
                </p>
            </div>
            <!-- Tombol Tambah Data memicu popup/modal -->
            <button onclick="openAddModal()"
                class="flex text-sm items-center gap-2 px-6 py-2 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Data
            </button>
        </header>

        <section class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <input id="search-input"
                        class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                        placeholder="Cari Nama Fasilitas..."
                        type="text" />
                </div>

            </div>
        </section>

        <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-border">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-16 text-center">No</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Ikon</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Nama Fasilitas</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground text-right w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="divide-y divide-border">
                        <!-- Tampilan dummy row karena backend belum siap -->
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-white/50 border-t border-border flex flex-col sm:flex-row justify-between items-center gap-4">
                <p id="info-page" class="text-xs font-medium text-muted-foreground">—</p>
                <div id="pagination-container" class="flex items-center gap-2"></div>
            </div>
        </div>

    </div>
</section>

<!-- MODAL TAMBAH DATA -->
<div id="add-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 space-y-6">
        <div class="flex items-center justify-between border-b pb-4">
            <h2 class="text-lg font-extrabold text-foreground">Tambah Jenis Fasilitas</h2>
            <button onclick="closeAddModal()" class="text-slate-400 hover:text-rose-500 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="add-form" action="<?= url_to('admin.jenis_fasilitas.store') ?>" class="space-y-4">
            <?= csrf_field() ?>

            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" placeholder="Contoh: Perpustakaan" autocomplete="off"
                    class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                <p id="add-error-nama_fasilitas" class="text-xs text-rose-500 mt-1 hidden"></p>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Ikon (Material Symbols)</label>
                <div class="relative">
                    <!-- Input Teks untuk Ikon -->
                    <input type="text" id="ikon-input" name="ikon" placeholder="Contoh: mosque, wifi, computer" autocomplete="off"
                        class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-border rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-primary/20 transition-all">


                    <!-- Live Preview Ikon di sisi kiri (ditambahkan overflow-hidden agar teks invalid tidak keluar) -->
                    <span id="ikon-preview" class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary pointer-events-none transition-all overflow-hidden whitespace-nowrap max-w-[24px]">style</span>
                </div>
                <p id="add-error-ikon" class="text-xs text-rose-500 hidden"></p>
                <p class="text-[10px] text-muted-foreground">Ketik nama ikon dari <a href="https://fonts.google.com/icons" target="_blank" class="text-primary hover:underline">Google Material Symbols</a>.</p>
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

<!-- MODAL EDIT DATA -->
<div id="edit-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 space-y-6">
        <div class="flex items-center justify-between border-b pb-4">
            <h2 class="text-lg font-extrabold text-foreground">Edit Jenis Fasilitas</h2>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-rose-500 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="edit-form" method="POST" action="">
            <?= csrf_field() ?>
            <input type="hidden" id="edit-id" name="id">
            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Nama Fasilitas</label>
                <input type="text" id="edit-nama" name="nama_fasilitas" class="w-full px-4 py-3 bg-slate-50 border border-border rounded-xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                <p id="edit-error-nama_fasilitas" class="text-xs text-rose-500 mt-1 hidden"></p>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold text-muted-foreground uppercase tracking-wider">Ikon (Material Symbols)</label>
                <div class="relative">
                    <input type="text" id="edit-ikon" name="ikon" placeholder="Contoh: mosque, wifi, computer" autocomplete="off" class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-border rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                    <p id="add-error-ikon" class="text-xs text-rose-500 mt-1 hidden"></p>
                    <span id="edit-ikon-preview" class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary pointer-events-none transition-all overflow-hidden whitespace-nowrap max-w-[24px]">style</span>
                </div>
                <p class="text-[10px] text-muted-foreground">Ketik nama ikon dari <a href="https://fonts.google.com/icons" target="_blank" class="text-primary hover:underline">Google Material Symbols</a>.</p>
            </div>
            <div class="pt-4 flex gap-3">
                <button type="button" onclick="closeEditModal()" class="flex-1 py-3 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-slate-50 transition-all">Batal</button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-primary text-white text-sm font-bold hover:scale-105 transition-transform shadow-lg shadow-primary/20">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL HAPUS DATA -->
<div id="delete-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 space-y-6">
        <div class="flex flex-col items-center gap-3 text-center">
            <div class="w-14 h-14 rounded-full bg-rose-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-rose-500 text-3xl">delete_forever</span>
            </div>
            <h2 class="text-lg font-extrabold text-foreground">Hapus Fasilitas?</h2>
            <p class="text-sm text-muted-foreground">
                Anda akan menghapus <span id="modal-fasilitas-name" class="font-bold text-foreground"></span>.
                Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>
        <form id="delete-form" method="POST" action="">
            <?= csrf_field() ?>
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="flex-1 py-3 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-slate-50 transition-all">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-rose-500 text-white text-sm font-bold hover:bg-rose-600 transition-all shadow-lg shadow-rose-500/20">
                    Ya, Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const DATA_URL = '<?= url_to('admin.jenis_fasilitas.data') ?>';
    const STORE_URL = '<?= url_to('admin.jenis_fasilitas.store') ?>';
    const DELETE_BASE = '<?= base_url('admin/jenis_fasilitas') ?>';
    const UPDATE_URL = DELETE_BASE; // base URL, will be appended with /{id}/update dynamically
    const INITIAL_DATA = <?= json_encode($initialData) ?>;


    // Open Edit Modal
    function openEditModal(id, nama, ikon) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nama').value = nama;

        const ikonInput = document.getElementById('edit-ikon');
        const preview = document.getElementById('edit-ikon-preview');

        // Simpan raw ikon ke dataset untuk fallback
        ikonInput.dataset.originalIkon = ikon;

        if (ikon && ikon.includes('<')) {
            // Jika ikon adalah SVG, kosongkan input agar tidak menampilkan tag path yang panjang
            ikonInput.value = '';
            ikonInput.placeholder = 'Contoh: mosque, wifi, computer';
            ikonInput.removeAttribute('required'); // Boleh kosong, nanti diisi ulang oleh JS saat disubmit

            const svgHtml = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">${ikon}</svg>`;
            preview.innerHTML = svgHtml;
            preview.classList.remove('material-symbols-outlined');
        } else {
            // Jika Material Symbols
            ikonInput.value = ikon;
            ikonInput.placeholder = 'Contoh: mosque, wifi, computer';
            ikonInput.setAttribute('required', 'required');

            preview.textContent = ikon || 'style';
            preview.classList.add('material-symbols-outlined');
            preview.classList.replace('text-slate-400', 'text-primary');
        }

        const form = document.getElementById('edit-form');
        form.action = `${UPDATE_URL}/${id}/update`;
        const modal = document.getElementById('edit-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('edit-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Submit Edit Form via AJAX
    document.getElementById('edit-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        // Jika input dikosongkan dan sebelumnya adalah SVG, kembalikan nilai SVG-nya
        const ikonInput = document.getElementById('edit-ikon');
        if (!ikonInput.value.trim() && ikonInput.dataset.originalIkon && ikonInput.dataset.originalIkon.includes('<')) {
            formData.set('ikon', ikonInput.dataset.originalIkon);
        }

        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => r.json())
            .then(res => {
                if (res.csrf_token) {
                    document.querySelectorAll('input[name="<?= csrf_token() ?>"]').forEach(el => el.value = res.csrf_token);
                }
                if (res.success) {
                    closeEditModal();
                    fetchData(currentPage);
                } else {
                    showErrors(res.errors ?? {}, 'edit');
                }
            })
            .catch(() => alert('Terjadi kesalahan saat memperbarui data.'));
    });

    // Edit Icon Live Preview
    const editIconInput = document.getElementById('edit-ikon');
    const editIconPreview = document.getElementById('edit-ikon-preview');
    let editIconDebounceTimer;
    editIconInput.addEventListener('input', function() {
        const valRaw = this.value.trim();
        // Reset to spinner while loading
        editIconPreview.textContent = 'progress_activity';
        editIconPreview.classList.add('animate-spin');
        editIconPreview.classList.replace('text-slate-400', 'text-primary');
        clearTimeout(editIconDebounceTimer);
        editIconDebounceTimer = setTimeout(() => {
            editIconPreview.classList.remove('animate-spin');
            if (!valRaw) {
                editIconPreview.textContent = 'style';
                editIconPreview.classList.replace('text-primary', 'text-slate-400');
            } else if (valRaw.includes('<')) {
                // Render raw SVG path inside an <svg> element
                const svgHtml = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">${valRaw}</svg>`;
                editIconPreview.innerHTML = svgHtml;
                // Ensure preview size matches other icons
                editIconPreview.classList.remove('material-symbols-outlined');
            } else {
                editIconPreview.innerHTML = ''; // Clear any SVG first
                editIconPreview.textContent = valRaw;
                editIconPreview.classList.add('material-symbols-outlined');
            }
        }, 600);
    });

    let currentPage = 1;
    let debounceTimer;

    // ── Fetch & render ───────────────────────────────────────────────
    function fetchData(page = 1, retryCount = 0) {
        currentPage = page;
        const search = document.getElementById('search-input').value.trim();

        const params = new URLSearchParams({
            search,
            page
        });

        document.getElementById('table-body').innerHTML = `
        <tr><td colspan="4" class="px-6 py-12 text-center text-sm text-muted-foreground">
            <span class="material-symbols-outlined animate-spin text-primary">progress_activity</span>
        </td></tr>`;
        document.getElementById('pagination-container').innerHTML = '';

        fetch(`${DATA_URL}?${params}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => r.json())
            .then(res => {
                renderTable(res.data, (page - 1) * res.perPage + 1);
                renderPagination(res);
                renderInfo(res);
            })
            .catch(() => {
                if (retryCount < 1) {
                    setTimeout(() => fetchData(retryCount + 1), 400);
                    return;
                }
                document.getElementById('table-body').innerHTML =
                    `<tr><td colspan="4" class="px-6 py-12 text-center text-sm text-rose-500">Gagal memuat data.</td></tr>`;
            });
    }

    function renderTable(rows, startNumber) {
        const tbody = document.getElementById('table-body');

        if (!rows || rows.length === 0) {
            tbody.innerHTML = `
            <tr><td colspan="4" class="px-6 py-12 text-center text-sm text-muted-foreground">
                Tidak ada data yang sesuai.
            </td></tr>`;
            return;
        }

        tbody.innerHTML = rows.map((item, index) => {
            const isSvg = item.ikon && item.ikon.includes('<');
            const iconHtml = isSvg ?
                `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">${item.ikon}</svg>` :
                `<span class="material-symbols-outlined">${escHtml(item.ikon)}</span>`;

            return `
            <tr class="hover:bg-primary/5 transition-colors group">
                <td class="px-6 py-5 text-sm font-bold text-slate-500 text-center">${startNumber + index}</td>
                <td class="px-6 py-5">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                        ${iconHtml}
                    </div>
                </td>
                <td class="px-6 py-5">
                    <span class="font-bold text-foreground text-sm">${escHtml(item.nama_fasilitas)}</span>
                </td>
                <td class="px-6 py-5">
                    <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                        <!-- Tombol Edit -->
                        <button onclick="openEditModal('${item.id}', '${escAttr(item.nama_fasilitas)}', '${escAttr(item.ikon)}')"
                                class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-all">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                        <!-- Tombol Delete -->
                        <button onclick="openDeleteModal('${item.id}', '${escAttr(item.nama_fasilitas)}')"
                                class="p-2 hover:bg-rose-50 rounded-lg text-rose-600 transition-all">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                </td>
            </tr>`;
        }).join('');
    }

    function renderInfo(res) {
        const from = res.total === 0 ? 0 : (res.currentPage - 1) * res.perPage + 1;
        const to = Math.min(res.currentPage * res.perPage, res.total);
        document.getElementById('info-page').textContent =
            res.total === 0 ?
            'Tidak ada data' :
            `Menampilkan ${from} – ${to} dari ${res.total.toLocaleString('id-ID')} fasilitas`;
    }

    function renderPagination(res) {
        const {
            currentPage,
            lastPage
        } = res;
        const container = document.getElementById('pagination-container');
        if (lastPage <= 1) {
            container.innerHTML = '';
            return;
        }

        const btnBase = 'w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold transition-all';
        const btnActive = `${btnBase} bg-primary text-white shadow-md shadow-primary/20`;
        const btnNormal = `${btnBase} border border-border hover:bg-slate-50`;
        const btnDisabled = `${btnBase} border border-border opacity-30 cursor-not-allowed`;

        let pages = buildPageList(currentPage, lastPage);
        let html = '';

        html += currentPage === 1 ?
            `<button class="${btnDisabled}" disabled><span class="material-symbols-outlined">chevron_left</span></button>` :
            `<button class="${btnNormal}" onclick="fetchData(${currentPage - 1})"><span class="material-symbols-outlined">chevron_left</span></button>`;

        pages.forEach(p => {
            if (p === '...') {
                html += `<span class="px-2 text-muted-foreground">...</span>`;
            } else {
                html += p === currentPage ?
                    `<button class="${btnActive}">${p}</button>` :
                    `<button class="${btnNormal}" onclick="fetchData(${p})">${p}</button>`;
            }
        });

        html += currentPage === lastPage ?
            `<button class="${btnDisabled}" disabled><span class="material-symbols-outlined">chevron_right</span></button>` :
            `<button class="${btnNormal}" onclick="fetchData(${currentPage + 1})"><span class="material-symbols-outlined">chevron_right</span></button>`;

        container.innerHTML = html;
    }

    function buildPageList(current, last) {
        if (last <= 7) return Array.from({
            length: last
        }, (_, i) => i + 1);
        if (current <= 4) return [1, 2, 3, 4, 5, '...', last];
        if (current >= last - 3) return [1, '...', last - 4, last - 3, last - 2, last - 1, last];
        return [1, '...', current - 1, current, current + 1, '...', last];
    }

    // ── Pencarian ────────────────────────────────────────────────────
    document.getElementById('search-input').addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => fetchData(1), 400); // debounce 400ms
    });

    // ── Submit Add Form via AJAX ─────────────────────────────────────
    document.getElementById('add-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => r.json())
            .then(res => {
                if (res.csrf_token) {
                    document.querySelectorAll('input[name="<?= csrf_token() ?>"]').forEach(el => el.value = res.csrf_token);
                }

                if (res.success) {
                    closeAddModal();
                    form.reset();
                    document.getElementById('ikon-preview').textContent = 'style';
                    document.getElementById('ikon-preview').classList.replace('text-primary', 'text-slate-400');
                    fetchData(1);
                } else {
                    showErrors(res.errors ?? {}, 'add');
                }
            })
            .catch(() => alert('Terjadi kesalahan saat menyimpan data.'));
    });

    // ── Delete modal ─────────────────────────────────────────────────
    function openDeleteModal(id, nama) {
        document.getElementById('modal-fasilitas-name').textContent = nama;
        document.getElementById('delete-form').action = `${DELETE_BASE}/${id}/delete`;
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

    document.getElementById('delete-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => r.json())
            .then(res => {
                if (res.csrf_token) {
                    document.querySelectorAll('input[name="<?= csrf_token() ?>"]').forEach(el => el.value = res.csrf_token);
                }

                closeDeleteModal();
                if (res.success) {
                    fetchData(currentPage);
                } else {
                    alert(res.message ?? 'Gagal menghapus data.');
                }
            })
            .catch(() => alert('Terjadi kesalahan, coba lagi.'));
    });

    // ── Modal Tambah ─────────────────────────────────────────────────
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

    // ── Live Preview Ikon ────────────────────────────────────────────
    const ikonInput = document.getElementById('ikon-input');
    const ikonPreview = document.getElementById('ikon-preview');
    let ikonDebounceTimer;

    ikonInput.addEventListener('input', function() {
        const val = this.value.trim().toLowerCase();

        ikonPreview.textContent = 'progress_activity';
        ikonPreview.classList.add('animate-spin');
        ikonPreview.classList.replace('text-slate-400', 'text-primary');

        clearTimeout(ikonDebounceTimer);

        ikonDebounceTimer = setTimeout(() => {
            ikonPreview.classList.remove('animate-spin');
            if (!val) {
                ikonPreview.textContent = 'style';
                ikonPreview.classList.replace('text-primary', 'text-slate-400');
            } else {
                ikonPreview.textContent = val;
            }
        }, 600);
    });

    function showErrors(errors, prefix) {
        clearErrors(prefix);
        Object.entries(errors).forEach(([field, message]) => {
            const el = document.getElementById(`${prefix}-error-${field}`);
            if (el) {
                el.textContent = message;
                el.classList.remove('hidden');
            }
        });
    }

    function clearErrors(prefix) {
        document.querySelectorAll(`[id^="${prefix}-error-"]`).forEach(el => {
            el.textContent = '';
            el.classList.add('hidden');
        });
    }

    // Helper XSS
    function escHtml(str) {
        return String(str ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function escAttr(str) {
        return String(str ?? '').replace(/'/g, "\\'").replace(/"/g, '&quot;');
    }

    // Load awal
    renderTable(INITIAL_DATA.data, 1);
    renderPagination(INITIAL_DATA);
    renderInfo(INITIAL_DATA);
</script>
<?= $this->endSection() ?>