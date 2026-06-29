<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Admin</span><span>/</span>
                    <span class="text-primary">Data Sekolah</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Data Sekolah</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Terdaftar total <span id="info-total" class="font-bold text-primary">—</span> unit sekolah dalam sistem.
                </p>
            </div>
            <a href="<?= url_to('admin.sekolah.create') ?>"
                class="flex text-sm items-center gap-2 px-6 py-2 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                Tambah Data
            </a>
        </header>

        <!-- <section class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <input id="search-input"
                        class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                        placeholder="Cari berdasarkan NPSN atau Nama Sekolah..."
                        type="text" />
                </div>
                <div class="relative min-w-[160px]">
                    <select id="filter-jenjang"
                        class="w-full appearance-none pl-4 pr-10 py-3 bg-slate-100 border-none rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="">Semua Jenjang</option>
                        <option value="TK">TK</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">expand_more</span>
                </div>
            </div>
        </section> -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <input id="search-input"
                        class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                        placeholder="Cari berdasarkan NPSN atau Nama Sekolah..."
                        type="text" />
                </div>
                <div class="relative min-w-[160px]">
                    <select id="filter-jenjang"
                        class="w-full appearance-none pl-4 pr-10 py-3 bg-slate-100 border-none rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="">Semua Jenjang</option>
                        <option value="TK">TK</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">expand_more</span>
                </div>

                <button onclick="document.getElementById('modal-import').classList.remove('hidden')"
                    class="flex items-center gap-2 px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-medium transition-colors whitespace-nowrap">
                    <span class="material-symbols-outlined text-[18px]">upload_file</span>
                    Import CSV
                </button>
            </div>
        </section>



        <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-border">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">NPSN</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Nama Sekolah</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Jenjang</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Status</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Akreditasi</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="divide-y divide-border">
                        <tr id="loading-row">
                            <td colspan="6" class="px-6 py-12 text-center text-sm text-muted-foreground">
                                <span class="material-symbols-outlined animate-spin text-primary">progress_activity</span>
                            </td>
                        </tr>
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

<div id="modal-import" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md mx-4">
        <h2 class="text-base font-semibold text-slate-800 mb-4">Import Data Sekolah</h2>
        <form action="<?= route_to('admin.sekolah.import.store') ?>" method="post" enctype="multipart/form-data" id="form-import-csv">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label class="block text-sm text-slate-600 mb-2">Pilih file CSV</label>
                <input type="file" name="csv_file" accept=".csv"
                    class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
            </div>
            <div class="flex gap-3 justify-end mt-6">
                <button type="button" onclick="document.getElementById('modal-import').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-slate-600 hover:text-slate-800 transition-colors">
                    Batal
                </button>
                <button type="submit" id="btn-import"
                    class="px-5 py-2 bg-primary text-white text-sm rounded-xl hover:bg-primary/90 transition-colors">
                    Upload & Import
                </button>
            </div>
        </form>
    </div>
</div>

<div id="loading-import" class="hidden fixed inset-0 z-[60] flex flex-col items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-xl p-8 flex flex-col items-center gap-4 w-64">
        <div class="w-10 h-10 border-4 border-slate-200 border-t-primary rounded-full animate-spin"></div>
        <div class="text-center">
            <p class="text-sm font-medium text-slate-800">Mengimpor data...</p>
            <p class="text-xs text-slate-500 mt-1">Mohon tunggu, jangan tutup halaman ini</p>
        </div>
    </div>
</div>

<div id="delete-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 space-y-6">
        <div class="flex flex-col items-center gap-3 text-center">
            <div class="w-14 h-14 rounded-full bg-rose-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-rose-500 text-3xl">delete_forever</span>
            </div>
            <h2 class="text-lg font-extrabold text-foreground">Hapus Data Sekolah?</h2>
            <p class="text-sm text-muted-foreground">
                Anda akan menghapus <span id="modal-school-name" class="font-bold text-foreground"></span>.
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
    const DATA_URL = '<?= url_to('admin.sekolah.data') ?>';
    const DELETE_BASE = '<?= base_url('admin/sekolah') ?>';
    const INITIAL_DATA = <?= json_encode($initialData) ?>;

    let currentPage = 1;
    let debounceTimer;

    // ── Fetch & render ───────────────────────────────────────────────
    function fetchData(page = 1, retryCount = 0) {
        currentPage = page;
        const search = document.getElementById('search-input').value.trim();
        const jenjang = document.getElementById('filter-jenjang').value;

        const params = new URLSearchParams({
            search,
            jenjang,
            page
        });

        document.getElementById('table-body').innerHTML = `
        <tr><td colspan="6" class="px-6 py-12 text-center text-sm text-muted-foreground">
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
                renderTable(res.data);
                renderPagination(res);
                renderInfo(res);
            })
            .catch(() => {
                if (retryCount < 1) {
                    setTimeout(() => fetchData(retryCount + 1), 400);
                    return;
                }
                document.getElementById('table-body').innerHTML =
                    `<tr><td colspan="6" class="px-6 py-12 text-center text-sm text-rose-500">Gagal memuat data.</td></tr>`;
            });
    }

    function renderTable(rows) {
        const tbody = document.getElementById('table-body');

        if (!rows || rows.length === 0) {
            tbody.innerHTML = `
            <tr><td colspan="6" class="px-6 py-12 text-center text-sm text-muted-foreground">
                Tidak ada data yang sesuai.
            </td></tr>`;
            return;
        }

        const jenjangColor = {
            SD: 'bg-error/90 text-white',
            SMP: 'bg-warning/90 text-forground',
            TK: 'bg-purple-600/90 text-white',
        };
        const statusColor = (s) => s.toLowerCase() === 'negeri' ? 'bg-primary text-white' : 'bg-secondary text-secondary-foreground';

        tbody.innerHTML = rows.map(s => `
        <tr class="hover:bg-primary/5 transition-colors group">
            <td class="px-6 py-5 text-sm font-bold text-primary">${escHtml(s.npsn ?? '—')}</td>
            <td class="px-6 py-5">
                <div class="flex flex-col">
                    <span class="font-bold text-foreground text-sm">${escHtml(s.nama_sekolah)}</span>
                    <span class="text-xs text-muted-foreground font-medium">${escHtml(s.alamat ?? '')}</span>
                </div>
            </td>
            <td class="px-6 py-5">
                <span class="px-3 py-1 ${jenjangColor[s.jenjang] ?? 'bg-slate-100 text-slate-600'} rounded-full text-[10px] font-bold uppercase">
                    ${escHtml(s.jenjang)}
                </span>
            </td>
            <td class="px-6 py-5">
                <span class="px-3 py-1 ${statusColor(s.status)} rounded-full text-[10px] font-bold uppercase">
                    ${escHtml(s.status)}
                </span>
            </td>
            <td class="px-6 py-5">
                ${s.akreditasi
                    ? `<div class="flex items-center gap-1 text-${s.akreditasi}">
                           <span class="font-bold text-sm">${escHtml(s.akreditasi)}</span>
                       </div>`
                    : `<span class="text-xs text-muted-foreground">—</span>`
                }
            </td>
            <td class="px-6 py-5">
                <div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                    <a href="${DELETE_BASE}/${encodeURIComponent(s.slug)}/detail"
                       class="p-2 hover:bg-primary/10 rounded-lg text-primary transition-all">
                        <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <a href="${DELETE_BASE}/${encodeURIComponent(s.slug)}/edit"
                       class="p-2 hover:bg-slate-100 rounded-lg text-foreground transition-all">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <button onclick="openDeleteModal('${escAttr(s.slug)}', '${escAttr(s.nama_sekolah)}')"
                            class="p-2 hover:bg-rose-50 rounded-lg text-rose-600 transition-all">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </td>
        </tr>`).join('');
    }

    function renderInfo(res) {
        const from = res.total === 0 ? 0 : (res.currentPage - 1) * res.perPage + 1;
        const to = Math.min(res.currentPage * res.perPage, res.total);
        document.getElementById('info-total').textContent = res.total.toLocaleString('id-ID');
        document.getElementById('info-page').textContent =
            res.total === 0 ?
            'Tidak ada data' :
            `Menampilkan ${from} – ${to} dari ${res.total.toLocaleString('id-ID')} sekolah`;
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

        // Prev
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

        // Next
        html += currentPage === lastPage ?
            `<button class="${btnDisabled}" disabled><span class="material-symbols-outlined">chevron_right</span></button>` :
            `<button class="${btnNormal}" onclick="fetchData(${currentPage + 1})"><span class="material-symbols-outlined">chevron_right</span></button>`;

        container.innerHTML = html;
    }

    // Buat list nomor halaman dengan ellipsis
    function buildPageList(current, last) {
        if (last <= 7) return Array.from({
            length: last
        }, (_, i) => i + 1);
        if (current <= 4) return [1, 2, 3, 4, 5, '...', last];
        if (current >= last - 3) return [1, '...', last - 4, last - 3, last - 2, last - 1, last];
        return [1, '...', current - 1, current, current + 1, '...', last];
    }

    // ── Delete modal ─────────────────────────────────────────────────
    function openDeleteModal(slug, nama) {
        document.getElementById('modal-school-name').textContent = nama;
        document.getElementById('delete-form').action = `${DELETE_BASE}/${encodeURIComponent(slug)}/delete`;
        const modal = document.getElementById('delete-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Tutup modal saat klik backdrop
    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // Handle submit delete → AJAX, lalu refresh tabel
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
                closeDeleteModal();
                if (res.success) {
                    fetchData(currentPage);
                } else {
                    alert(res.message ?? 'Gagal menghapus data.');
                }
            })
            .catch(() => alert('Terjadi kesalahan, coba lagi.'));
    });

    // ── Helper XSS escape ────────────────────────────────────────────
    function escHtml(str) {
        return String(str ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function escAttr(str) {
        return String(str ?? '').replace(/'/g, "\\'").replace(/"/g, '&quot;');
    }

    // ── Event listeners ──────────────────────────────────────────────
    document.getElementById('search-input').addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => fetchData(1), 400); // debounce 400ms
    });

    document.getElementById('filter-jenjang').addEventListener('change', () => fetchData(1));

    // Load awal
    // fetchData(1);
    renderTable(INITIAL_DATA.data);
    renderPagination(INITIAL_DATA);
    renderInfo(INITIAL_DATA);
</script>
<script>
    document.getElementById('form-import-csv').addEventListener('submit', function(e) {
        const fileInput = this.querySelector('input[type="file"]');
        if (!fileInput.files.length) return;

        document.getElementById('modal-import').classList.add('hidden');
        document.getElementById('loading-import').classList.remove('hidden');
        document.getElementById('btn-import').disabled = true;
    });
</script>
<?= $this->endSection() ?>