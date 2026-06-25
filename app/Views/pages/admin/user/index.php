<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Admin</span><span>/</span>
                    <span class="text-primary">Manajemen Pengguna</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Manajemen Pengguna</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Terdaftar total <span id="info-total" class="font-bold text-primary">—</span> akun pengguna dalam sistem.
                </p>
            </div>
            <a href="<?= url_to('admin.user.create') ?>"
                class="flex text-sm items-center gap-2 px-6 py-2 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                Tambah Pengguna
            </a>
        </header>

        <section class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    <input id="search-input"
                        class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                        placeholder="Cari berdasarkan nama atau email..."
                        type="text" />
                </div>
                <div class="relative min-w-[180px]">
                    <select id="filter-group"
                        class="w-full appearance-none pl-4 pr-10 py-3 bg-slate-100 border-none rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="">Semua Grup</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="operator_dinas">Operator Dinas</option>
                        <option value="operator_sekolah">Operator Sekolah</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">expand_more</span>
                </div>
            </div>
        </section>

        <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-fixed text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-border">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Nama</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Email</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Sekolah</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Grup</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-muted-foreground">Status</th>
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

<div id="delete-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 space-y-6">
        <div class="flex flex-col items-center gap-3 text-center">
            <div class="w-14 h-14 rounded-full bg-rose-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-rose-500 text-3xl">delete_forever</span>
            </div>
            <h2 class="text-lg font-extrabold text-foreground">Hapus Pengguna?</h2>
            <p class="text-sm text-muted-foreground">
                Anda akan menghapus <span id="modal-user-name" class="font-bold text-foreground"></span>.
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
    const BASE_URL = '<?= base_url('admin/user/data') ?>';
    const DETAIL_SEKOLAH_URL = '<?= base_url('admin/sekolah/') ?>';

    const EDIT_URL = '<?= base_url('admin/user') ?>';
    const DELETE_URL = '<?= base_url('admin/user') ?>';
    const INITIAL_DATA = <?= json_encode($initialData) ?>;

    const GROUP_LABELS = {
        superadmin: {
            label: 'Super Admin',
            cls: 'bg-violet-100 text-violet-700'
        },
        operator_dinas: {
            label: 'Operator Dinas',
            cls: 'bg-sky-100 text-sky-700'
        },
        operator_sekolah: {
            label: 'Operator Sekolah',
            cls: 'bg-teal-100 text-teal-700'
        },
    };

    let currentPage = 1;
    let searchTimer = null;

    function getFilters() {
        return {
            search: document.getElementById('search-input').value.trim(),
            group: document.getElementById('filter-group').value,
            page: currentPage,
        };
    }

    async function fetchData(retryCount = 0) {
        const {
            search,
            group,
            page
        } = getFilters();
        const params = new URLSearchParams({
            search,
            group,
            page
        });

        const tbody = document.getElementById('table-body');
        tbody.innerHTML = `
    <tr id="loading-row">
        <td colspan="6" class="px-6 py-12 text-center text-sm text-muted-foreground">
            <span class="material-symbols-outlined animate-spin text-primary">progress_activity</span>
        </td>
    </tr>`;

        try {
            const res = await fetch(`${BASE_URL}?${params}`);
            if (!res.ok) throw new Error(`HTTP ${res.status}`);

            const json = await res.json();

            renderTable(json);
            renderPagination(json);
            document.getElementById('info-total').textContent = json.total.toLocaleString('id-ID');
        } catch (err) {
            console.error('fetchData error:', err);

            // Retry sekali jika koneksi gagal (transient error saat dev server cold start)
            if (retryCount < 1) {
                setTimeout(() => fetchData(retryCount + 1), 400);
                return;
            }

            tbody.innerHTML = `
        <tr>
            <td colspan="6" class="px-6 py-12 text-center text-sm text-rose-500 font-medium">
                Gagal memuat data. Silakan coba lagi.
            </td>
        </tr>`;
        }
    }

    function renderTable({
        data
    }) {

        const tbody = document.getElementById('table-body');

        if (!data.length) {
            tbody.innerHTML = `
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-sm text-muted-foreground">
                    Tidak ada pengguna ditemukan.
                </td>
            </tr>`;
            return;
        }

        tbody.innerHTML = data.map(user => {
            const grp = GROUP_LABELS[user.group] ?? {
                label: user.group,
                cls: 'bg-slate-100 text-slate-600'
            };
            const active = user.active == 1;
            const statusCls = active ?
                'bg-emerald-100 text-emerald-700' :
                'bg-slate-100 text-slate-500';
            const statusLabel = active ? 'Aktif' : 'Nonaktif';

            return `
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary text-base">person</span>
                                </div>
                                <span class="text-sm font-semibold text-foreground truncate max-w-[160px]" title="${escHtml(user.username ?? '—')}">${escHtml(user.username ?? '—')}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-muted-foreground">
                            <span class="block truncate" title="${escHtml(user.email)}">${escHtml(user.email)}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-foreground">
                            ${user.group === 'operator_sekolah' && user.nama_sekolah
                                ? `<a href="${DETAIL_SEKOLAH_URL}/${user.sekolah_slug}/detail" class="font-medium text-primary hover:underline block truncate" title="${escHtml(user.nama_sekolah)}">${escHtml(user.nama_sekolah)}</a>`
                                : `<span class="text-slate-400">—</span>`}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold ${grp.cls}">
                                ${grp.label}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold ${statusCls}">
                                ${statusLabel}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="${EDIT_URL}/${user.id}/edit"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-primary/10 hover:text-primary text-slate-600 text-xs font-bold transition-colors">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                    Edit
                                </a>
                                <button onclick="openDeleteModal(${user.id}, '${escHtml(user.username ?? user.email)}')"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-rose-50 hover:text-rose-500 text-slate-600 text-xs font-bold transition-colors">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>`;
        }).join('');
    }

    function renderPagination({
        currentPage: cur,
        lastPage,
        total,
        perPage
    }) {
        const start = total === 0 ? 0 : (cur - 1) * perPage + 1;
        const end = Math.min(cur * perPage, total);
        document.getElementById('info-page').textContent =
            total === 0 ? 'Tidak ada data' : `Menampilkan ${start}–${end} dari ${total} pengguna`;

        const container = document.getElementById('pagination-container');
        if (lastPage <= 1) {
            container.innerHTML = '';
            return;
        }

        const btnCls = 'w-8 h-8 flex items-center justify-center rounded-lg text-xs font-bold transition-colors';
        const active = `${btnCls} bg-primary text-white shadow-sm shadow-primary/30`;
        const normal = `${btnCls} bg-slate-100 text-slate-600 hover:bg-primary/10 hover:text-primary`;
        const navBtn = (page, icon, disabled) =>
            `<button ${disabled ? 'disabled' : `onclick="goTo(${page})"`}
            class="${btnCls} ${disabled ? 'opacity-30 cursor-not-allowed bg-slate-100 text-slate-400' : normal}">
            <span class="material-symbols-outlined text-base">${icon}</span>
        </button>`;

        let pages = '';
        for (let i = 1; i <= lastPage; i++) {
            if (i === 1 || i === lastPage || (i >= cur - 1 && i <= cur + 1)) {
                pages += `<button onclick="goTo(${i})" class="${i === cur ? active : normal}">${i}</button>`;
            } else if (i === cur - 2 || i === cur + 2) {
                pages += `<span class="w-8 h-8 flex items-center justify-center text-xs text-slate-400">…</span>`;
            }
        }

        container.innerHTML =
            navBtn(cur - 1, 'chevron_left', cur === 1) +
            pages +
            navBtn(cur + 1, 'chevron_right', cur === lastPage);
    }

    function goTo(page) {
        currentPage = page;
        fetchData();
    }

    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Delete modal
    function openDeleteModal(id, name) {
        document.getElementById('modal-user-name').textContent = name;
        document.getElementById('delete-form').action = `${DELETE_URL}/${id}/delete`;
        const modal = document.getElementById('delete-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Events
    document.getElementById('search-input').addEventListener('input', () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            currentPage = 1;
            fetchData();
        }, 350);
    });
    document.getElementById('filter-group').addEventListener('change', () => {
        currentPage = 1;
        fetchData();
    });



    // Jadi ini:
    renderTable(INITIAL_DATA);
    renderPagination(INITIAL_DATA);
    document.getElementById('info-total').textContent = INITIAL_DATA.total.toLocaleString('id-ID');
</script>
<?= $this->endSection() ?>