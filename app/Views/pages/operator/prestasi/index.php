<?= $this->extend('layouts/operator-sekolah') ?>

<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">
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
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-32">Jenis</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-24">Tahun</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground w-36 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="table-body" class="divide-y divide-border">
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-white/50 border-t border-border flex flex-col sm:flex-row justify-between items-center gap-4">
                <p id="info-page"
                    class="text-xs font-medium text-muted-foreground">
                </p>

                <div id="pagination-container"
                    class="flex items-center gap-2">
                </div>
                <!-- <div class="flex items-center gap-2">
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border opacity-30 cursor-not-allowed" disabled>
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold bg-primary text-white shadow-md shadow-primary/20">1</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border hover:bg-slate-50 transition-all">2</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border hover:bg-slate-50 transition-all">3</button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold border border-border hover:bg-slate-50 transition-all">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div> -->
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const DATA_URL = '<?= url_to('operator.prestasi.data') ?>';

    const INITIAL_DATA = <?= json_encode($initialData) ?>;

    let currentPage = 1;
    let debounceTimer;

    fetchData = (page = 1, retryCount = 0) => {

        currentPage = page;

        const search = document.getElementById('search-input').value.trim();

        const params = new URLSearchParams({
            search,
            page
        });

        document.getElementById('table-body').innerHTML = `
        <tr>
            <td colspan="6"
                class="py-10 text-center">
                <span class="material-symbols-outlined animate-spin text-primary">
                    progress_activity
                </span>
            </td>
        </tr>`;

        fetch(`${DATA_URL}?${params}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => r.json())
            .then(res => {

                renderTable(
                    res.data,
                    (page - 1) * res.perPage + 1
                );

                renderPagination(res);

                renderInfo(res);

            })
            .catch(() => {

                if (retryCount < 1) {
                    setTimeout(() => fetchData(page, retryCount + 1), 400);
                    return;
                }

                document.getElementById('table-body').innerHTML =
                    `<tr>
            <td colspan="6"
                class="text-center py-10 text-rose-500">
                Gagal memuat data.
            </td>
        </tr>`;

            });

    };

    function renderTable(rows, startNumber) {

        const tbody = document.getElementById('table-body');

        if (!rows.length) {

            tbody.innerHTML = `
        <tr>
            <td colspan="6"
                class="py-10 text-center text-muted-foreground">
                Tidak ada data prestasi.
            </td>
        </tr>`;

            return;
        }

        tbody.innerHTML = rows.map((item, index) => `

<tr class="hover:bg-primary/5 transition-colors group">

<td class="px-6 py-5 text-center text-sm">
${startNumber+index}
</td>

<td class="px-6 py-5 text-sm font-bold">
${escHtml(item.nama_prestasi)}
</td>

<td class="px-6 py-5">
<span class="px-3 py-1 bg-blue-500 text-white rounded-full text-[10px] font-bold uppercase">
${escHtml(item.tingkat)}
</span>
</td>

<td class="px-6 py-5">
<span class="px-3 py-1 bg-slate-200 rounded-full text-[10px] font-bold uppercase">
${escHtml(item.jenis)}
</span>
</td>

<td class="px-6 py-5 text-sm">
${escHtml(item.tahun)}
</td>

<td class="px-6 py-5">
<div class="flex justify-end gap-2 opacity-60 group-hover:opacity-100">

<button class="p-2 hover:bg-primary/10 rounded-lg">
<span class="material-symbols-outlined">
visibility
</span>
</button>

<button class="p-2 hover:bg-slate-100 rounded-lg">
<span class="material-symbols-outlined">
edit
</span>
</button>

<button class="p-2 hover:bg-rose-50 rounded-lg text-rose-600">
<span class="material-symbols-outlined">
delete
</span>
</button>

</div>
</td>

</tr>

`).join('');

    }

    function renderInfo(res) {

        const from = res.total === 0 ?
            0 :
            (res.currentPage - 1) * res.perPage + 1;

        const to = Math.min(
            res.currentPage * res.perPage,
            res.total
        );

        document.getElementById('info-page').textContent =
            res.total === 0 ?
            'Tidak ada data' :
            `Menampilkan ${from} – ${to} dari ${res.total} prestasi`;

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
        const btnActive = `${btnBase} bg-primary text-white`;
        const btnNormal = `${btnBase} border border-border hover:bg-slate-50`;
        const btnDisabled = `${btnBase} border border-border opacity-30 cursor-not-allowed`;

        let pages = buildPageList(currentPage, lastPage);

        let html = '';

        html += currentPage === 1 ?
            `<button class="${btnDisabled}" disabled>
        <span class="material-symbols-outlined">chevron_left</span>
      </button>` :
            `<button class="${btnNormal}" onclick="fetchData(${currentPage-1})">
        <span class="material-symbols-outlined">chevron_left</span>
      </button>`;

        pages.forEach(p => {

            if (p === '...') {
                html += `<span>...</span>`;
            } else {

                html += p === currentPage ?
                    `<button class="${btnActive}">
                ${p}
              </button>` :
                    `<button class="${btnNormal}"
                onclick="fetchData(${p})">
                ${p}
              </button>`;

            }

        });

        html += currentPage === lastPage ?
            `<button class="${btnDisabled}" disabled>
        <span class="material-symbols-outlined">chevron_right</span>
      </button>` :
            `<button class="${btnNormal}" onclick="fetchData(${currentPage+1})">
        <span class="material-symbols-outlined">chevron_right</span>
      </button>`;

        container.innerHTML = html;

    }

    function buildPageList(current, last) {

        if (last <= 7)
            return Array.from({
                length: last
            }, (_, i) => i + 1);

        if (current <= 4)
            return [1, 2, 3, 4, 5, '...', last];

        if (current >= last - 3)
            return [1, '...', last - 4, last - 3, last - 2, last - 1, last];

        return [1, '...', current - 1, current, current + 1, '...', last];

    }

    document.getElementById('search-input')
        .addEventListener('input', () => {

            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(() => {
                fetchData(1);
            }, 400);

        });

    function escHtml(str) {
        return String(str ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    renderTable(INITIAL_DATA.data, 1);
    renderPagination(INITIAL_DATA);
    renderInfo(INITIAL_DATA);
</script>
<?= $this->endSection() ?>