<?= $this->extend('layouts/main-home') ?>
<?= $this->section('content') ?>

<main class="pt-24 grid grid-cols-12 min-h-screen">
    <!-- CSRF carrier (CI4 rotates token tiap request) -->
    <input type="hidden" id="csrf-name" value="<?= csrf_token() ?>">
    <input type="hidden" id="csrf-hash" value="<?= csrf_hash() ?>">

    <!-- Refined Sidebar Filter -->
    <aside class="col-span-3 p-10 overflow-y-auto border-r border-border custom-scrollbar">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-lg font-headline font-bold text-foreground">Filter</h2>
            <button id="reset-filters" class="text-primary font-bold text-[10px] tracking-widest uppercase hover:underline">Reset Semua</button>
        </div>

        <!-- School Type (jenjang) -->
        <div class="mb-10">
            <label class="block font-bold text-[10px] tracking-widest text-muted-foreground uppercase mb-4">Jenjang Pendidikan</label>
            <div class="flex flex-col gap-2" id="jenjang-group">
                <button type="button" data-value="" class="jenjang-btn flex items-center justify-between px-4 py-3 rounded-xl text-xs font-bold border bg-primary/5 text-primary border-primary/20 transition-all">
                    <span>Semua Jenjang</span>
                    <span class="material-symbols-outlined text-[18px] check-icon">check_circle</span>
                </button>
                <button type="button" data-value="SD" class="jenjang-btn flex items-center justify-between px-4 py-3 rounded-xl text-xs font-medium border bg-muted/50 text-muted-foreground border-transparent hover:border-border transition-all">
                    <span>SD</span>
                    <span class="material-symbols-outlined text-[18px] check-icon hidden">check_circle</span>
                </button>
                <button type="button" data-value="SMP" class="jenjang-btn flex items-center justify-between px-4 py-3 rounded-xl text-xs font-medium border bg-muted/50 text-muted-foreground border-transparent hover:border-border transition-all">
                    <span>SMP</span>
                    <span class="material-symbols-outlined text-[18px] check-icon hidden">check_circle</span>
                </button>
            </div>
        </div>

        <!-- Status -->
        <div class="mb-10">
            <label class="block font-bold text-[10px] tracking-widest text-muted-foreground uppercase mb-4">Status Lembaga</label>
            <div class="grid grid-cols-2 gap-3" id="status-group">
                <label class="status-option relative flex items-center justify-center p-3 rounded-xl border-2 border-border bg-background cursor-pointer hover:border-primary/30 transition-all" data-value="Negeri">
                    <input type="checkbox" class="hidden status-checkbox">
                    <span class="text-xs font-semibold text-muted-foreground">Negeri</span>
                </label>
                <label class="status-option relative flex items-center justify-center p-3 rounded-xl border-2 border-border bg-background cursor-pointer hover:border-primary/30 transition-all" data-value="Swasta">
                    <input type="checkbox" class="hidden status-checkbox">
                    <span class="text-xs font-semibold text-muted-foreground">Swasta</span>
                </label>
            </div>
        </div>

        <!-- Accreditation -->
        <div class="mb-10">
            <label class="block font-bold text-[10px] tracking-widest text-muted-foreground uppercase mb-4">Akreditasi</label>
            <div class="grid grid-cols-2 gap-2" id="akreditasi-group">
                <button type="button" data-value="A" class="akreditasi-btn p-3 rounded-xl border font-bold text-xs flex items-center justify-center gap-2 transition-all bg-muted/50 text-muted-foreground border-border">
                    <span class="w-1.5 h-1.5 rounded-full dot bg-muted-foreground"></span> A
                </button>
                <button type="button" data-value="B" class="akreditasi-btn p-3 rounded-xl border font-bold text-xs transition-all bg-muted/50 text-muted-foreground border-border">B</button>
                <button type="button" data-value="C" class="akreditasi-btn p-3 rounded-xl border font-bold text-xs transition-all bg-muted/50 text-muted-foreground border-border">C</button>
                <button type="button" data-value="Baru" class="akreditasi-btn p-3 rounded-xl border font-bold text-xs transition-all bg-muted/50 text-muted-foreground border-border">Baru</button>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <section class="flex-1 p-8 col-span-9 md:p-12">
        <!-- Header & Controls -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12">
            <div>
                <h1 class="text-4xl font-headline font-bold text-foreground mb-3 tracking-tight">Eksplorasi <span class="text-primary">Sekolah</span></h1>
                <p class="text-muted-foreground text-sm font-medium">
                    Menampilkan <span class="text-foreground font-bold" id="total-count"><?= (int) $initialData['total'] ?></span> institusi pendidikan terbaik di zona Anda.
                </p>
            </div>
            <div class="relative min-w-[160px]">

                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none ">sort</span>
                <select id="sort-select" class="w-full appearance-none pl-10 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm font-medium outline-none focus:ring-2 focus:ring-primary/20">
                    <option value="rekomendasi">Rekomendasi</option>
                    <option value="akreditasi">Akreditasi</option>
                </select>
            </div>
        </div>

        <div id="results-container" class="relative">
            <!-- Loading indicator -->
            <div id="loading-overlay" class="hidden absolute inset-0 z-10 flex items-center justify-center bg-background/60 backdrop-blur-sm rounded-2xl">
                <div class="w-10 h-10 border-4 border-primary/20 border-t-primary rounded-full animate-spin"></div>
            </div>

            <!-- Empty state -->
            <div id="empty-state" class="<?= empty($initialData['data']) ? '' : 'hidden' ?> text-center py-20 text-muted-foreground text-sm font-medium">
                Tidak ada sekolah yang cocok dengan filter ini.
            </div>

            <!-- Results Grid -->
            <div id="results-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <?php foreach ($initialData['data'] as $sekolah): ?>
                    <a href="<?= base_url('sekolah') ?>/<?= esc($sekolah['slug']) ?>" class="school-card-vibrant bg-card text-card-foreground rounded-2xl overflow-hidden border border-border/50 cursor-pointer group block">
                        <div class="relative h-44">
                            <?php if (!empty($s['foto_utama'])): ?>
                                <img
                                    alt="<?= esc($sekolah['nama_sekolah']) ?>"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    src="<?= base_url('uploads/sekolah') . '/' . esc($sekolah['foto_utama']) ?>">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-slate-400">school</span>
                                </div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute top-3 left-3 flex gap-2">
                                <span class="text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest <?= $sekolah['status'] === 'Negeri' ? 'bg-primary text-primary-foreground' : 'bg-secondary text-secondary-foreground' ?>">
                                    <?= esc($sekolah['status']) ?>
                                </span>
                            </div>
                            <button class="absolute top-3 right-3 w-8 h-8 glass-effect rounded-full flex items-center justify-center text-foreground hover:text-destructive transition-colors">
                                <span class="material-symbols-outlined text-[18px]">favorite</span>
                            </button>
                            <div class="absolute bottom-3 right-3">
                                <span class="text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg <?= $sekolah['akreditasi'] === 'A' ? 'bg-success' : 'bg-muted-foreground' ?>">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                    <?= $sekolah['akreditasi'] === 'Belum Terakreditasi' ? 'Baru' : esc($sekolah['akreditasi']) ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-headline font-bold text-base group-hover:text-primary transition-colors mb-1"><?= esc($sekolah['nama_sekolah']) ?></h3>
                            <div class="flex items-center gap-1.5 text-muted-foreground mb-4">
                                <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                                <span class="text-[13px] line-clamp-1">
                                    <?= esc($sekolah['alamat']) ?><?= !empty($sekolah['nama_kecamatan']) ? ', Kec. ' . esc($sekolah['nama_kecamatan']) : '' ?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Modern Pagination -->
        <div id="pagination" class="<?= $initialData['total_pages'] <= 1 ? 'hidden' : '' ?> flex justify-center items-center gap-3 mt-20 pb-20"></div>
    </section>
</main>

<button class="lg:hidden fixed bottom-8 right-8 h-14 px-6 bg-primary text-primary-foreground rounded-full shadow-2xl flex items-center gap-3 hover:scale-105 active:scale-95 transition-all">
    <span class="material-symbols-outlined">tune</span>
    <span class="font-bold text-xs uppercase tracking-wider">Filter</span>
</button>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    (function() {
        const state = {
            jenjang: '',
            status: [],
            akreditasi: [],
            sort: 'rekomendasi',
            page: <?= (int) $initialData['page'] ?>,
            totalPages: <?= (int) $initialData['total_pages'] ?>
        };

        const csrfNameInput = document.getElementById('csrf-name');
        const csrfHashInput = document.getElementById('csrf-hash');

        const grid = document.getElementById('results-grid');
        const emptyState = document.getElementById('empty-state');
        const loadingOverlay = document.getElementById('loading-overlay');
        const totalCount = document.getElementById('total-count');
        const pagination = document.getElementById('pagination');
        const sortSelect = document.getElementById('sort-select');


        function escapeHtml(str) {
            if (str === null || str === undefined) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function cardHtml(school) {
            const statusBadgeClass = school.status === 'Negeri' ?
                'bg-primary text-primary-foreground' :
                'bg-secondary text-secondary-foreground';

            const akreditasiDotClass = school.akreditasi === 'A' ? 'bg-success' : 'bg-muted-foreground';
            const akreditasiLabel = school.akreditasi === 'Belum Terakreditasi' ? 'Baru' : school.akreditasi;

            const fotoSrc =
                '<?= base_url('uploads/sekolah') ?>/' + encodeURIComponent(school.foto_utama);

            const alamat = escapeHtml(school.alamat || '');
            const kecamatan = school.nama_kecamatan ? ', Kec. ' + escapeHtml(school.nama_kecamatan) : '';

            return `
            <a href="<?= base_url('sekolah') ?>/${encodeURIComponent(school.slug)}" class="school-card-vibrant bg-card text-card-foreground rounded-2xl overflow-hidden border border-border/50 cursor-pointer group block">
                <div class="relative h-44">
                 ${school.img ? `
                    <img
                        alt="${escapeHtml(school.nama_sekolah)}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="${fotoSrc}"
                    >
                    ` : `
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-8xl text-slate-400">school</span>
                    </div>
                `}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-3 left-3 flex gap-2">
                        <span class="text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest ${statusBadgeClass}">${escapeHtml(school.status)}</span>
                    </div>
                    <button class="absolute top-3 right-3 w-8 h-8 glass-effect rounded-full flex items-center justify-center text-foreground hover:text-destructive transition-colors">
                        <span class="material-symbols-outlined text-[18px]">favorite</span>
                    </button>
                    <div class="absolute bottom-3 right-3">
                        <span class="text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg ${akreditasiDotClass}">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            ${escapeHtml(akreditasiLabel)}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-headline font-bold text-base group-hover:text-primary transition-colors mb-1">${escapeHtml(school.nama_sekolah)}</h3>
                    <div class="flex items-center gap-1.5 text-muted-foreground mb-4">
                        <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                        <span class="text-[13px] line-clamp-1">${alamat}${kecamatan}</span>
                    </div>
                </div>
            </a>
        `;
        }

        function renderGrid(schools) {
            if (!schools || schools.length === 0) {
                grid.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }
            emptyState.classList.add('hidden');
            grid.innerHTML = schools.map(cardHtml).join('');
        }

        function renderPagination() {
            const {
                page,
                totalPages
            } = state;

            if (totalPages <= 1) {
                pagination.classList.add('hidden');
                pagination.innerHTML = '';
                return;
            }
            pagination.classList.remove('hidden');

            let pages = [];
            if (totalPages <= 7) {
                for (let i = 1; i <= totalPages; i++) pages.push(i);
            } else {
                pages.push(1);
                if (page > 3) pages.push('...');
                const start = Math.max(2, page - 1);
                const end = Math.min(totalPages - 1, page + 1);
                for (let i = start; i <= end; i++) pages.push(i);
                if (page < totalPages - 2) pages.push('...');
                pages.push(totalPages);
            }

            let html = `
            <button data-page="${page - 1}" ${page <= 1 ? 'disabled' : ''} class="page-btn w-10 h-10 rounded-xl border border-border bg-card hover:border-primary hover:text-primary transition-all flex items-center justify-center disabled:opacity-40 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-[20px]">chevron_left</span>
            </button>
        `;

            pages.forEach(p => {
                if (p === '...') {
                    html += `<span class="px-2 text-muted-foreground/30 text-xs font-bold">...</span>`;
                } else {
                    const active = p === page;
                    html += `
                    <button data-page="${p}" class="page-btn w-10 h-10 rounded-xl font-bold text-xs transition-all ${active
                        ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20'
                        : 'border border-border bg-card text-muted-foreground hover:border-primary hover:text-primary'}">
                        ${p}
                    </button>
                `;
                }
            });

            html += `
            <button data-page="${page + 1}" ${page >= totalPages ? 'disabled' : ''} class="page-btn w-10 h-10 rounded-xl border border-border bg-card hover:border-primary hover:text-primary transition-all flex items-center justify-center disabled:opacity-40 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </button>
        `;

            pagination.innerHTML = html;
        }

        let currentController = null;

        async function fetchData(page) {
            // batalkan request sebelumnya kalau masih jalan
            if (currentController) currentController.abort();
            currentController = new AbortController();

            loadingOverlay.classList.remove('hidden');
            grid.classList.add('opacity-40');

            const body = {
                jenjang: state.jenjang,
                status: state.status,
                akreditasi: state.akreditasi,
                sort: state.sort,
                page: page
            };
            body[csrfNameInput.value] = csrfHashInput.value;

            try {
                const res = await fetch('<?= site_url('cari/filter') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(body),
                    signal: currentController.signal
                });

                if (!res.ok) throw new Error('Request gagal: ' + res.status);

                const data = await res.json();

                state.page = data.page;
                state.totalPages = data.total_pages;

                totalCount.textContent = data.total;
                renderGrid(data.data);
                renderPagination();

                if (data.csrf_token) {
                    csrfHashInput.value = data.csrf_token;
                }
            } catch (e) {
                if (e.name !== 'AbortError') {
                    console.error('Gagal memuat data sekolah:', e);
                }
                return; // jangan hilangkan overlay kalau request ini sudah dibatalkan
            } finally {
                loadingOverlay.classList.add('hidden');
                grid.classList.remove('opacity-40');
            }
        }


        // --- Jenjang ---
        const jenjangGroup = document.getElementById('jenjang-group');
        jenjangGroup.addEventListener('click', (e) => {
            const btn = e.target.closest('.jenjang-btn');
            if (!btn) return;

            state.jenjang = btn.dataset.value;

            jenjangGroup.querySelectorAll('.jenjang-btn').forEach(b => {
                const isActive = b === btn;
                b.classList.toggle('bg-primary/5', isActive);
                b.classList.toggle('text-primary', isActive);
                b.classList.toggle('border-primary/20', isActive);
                b.classList.toggle('font-bold', isActive);
                b.classList.toggle('bg-muted/50', !isActive);
                b.classList.toggle('text-muted-foreground', !isActive);
                b.classList.toggle('border-transparent', !isActive);
                b.classList.toggle('font-medium', !isActive);
                b.querySelector('.check-icon').classList.toggle('hidden', !isActive);
            });

            fetchData(1);
        });

        // --- Status ---
        const statusGroup = document.getElementById('status-group');
        statusGroup.addEventListener('click', (e) => {
            const label = e.target.closest('.status-option');
            if (!label) return;

            e.preventDefault(); // <-- tambahan: cegah browser toggle checkbox secara native

            const value = label.dataset.value;
            const checkbox = label.querySelector('.status-checkbox');
            const idx = state.status.indexOf(value);

            if (idx > -1) {
                state.status.splice(idx, 1);
                checkbox.checked = false;
            } else {
                state.status.push(value);
                checkbox.checked = true;
            }

            label.classList.toggle('border-primary', checkbox.checked);
            label.classList.toggle('bg-primary/5', checkbox.checked);
            label.classList.toggle('border-border', !checkbox.checked);
            label.classList.toggle('bg-background', !checkbox.checked);

            const span = label.querySelector('span:not(.material-symbols-outlined)');
            span.classList.toggle('text-primary', checkbox.checked);
            span.classList.toggle('text-muted-foreground', !checkbox.checked);

            fetchData(1);
        });

        // --- Akreditasi ---
        const akreditasiGroup = document.getElementById('akreditasi-group');
        akreditasiGroup.addEventListener('click', (e) => {
            const btn = e.target.closest('.akreditasi-btn');
            if (!btn) return;

            const value = btn.dataset.value;
            const idx = state.akreditasi.indexOf(value);
            const active = idx === -1;

            if (active) state.akreditasi.push(value);
            else state.akreditasi.splice(idx, 1);

            btn.classList.toggle('bg-success/10', active);
            btn.classList.toggle('text-success', active);
            btn.classList.toggle('border-success/20', active);
            btn.classList.toggle('bg-muted/50', !active);
            btn.classList.toggle('text-muted-foreground', !active);
            btn.classList.toggle('border-border', !active);

            const dot = btn.querySelector('.dot');
            if (dot) {
                dot.classList.toggle('bg-success', active);
                dot.classList.toggle('bg-muted-foreground', !active);
            }

            fetchData(1);
        });

        // --- Sort ---
        sortSelect.addEventListener('change', () => {
            state.sort = sortSelect.value;
            fetchData(1);
        });

        // --- Reset ---
        document.getElementById('reset-filters').addEventListener('click', () => {
            state.jenjang = '';
            state.status = [];
            state.akreditasi = [];
            state.sort = 'rekomendasi';
            sortSelect.value = 'rekomendasi';

            jenjangGroup.querySelectorAll('.jenjang-btn').forEach(b => {
                const isActive = b.dataset.value === '';
                b.classList.toggle('bg-primary/5', isActive);
                b.classList.toggle('text-primary', isActive);
                b.classList.toggle('border-primary/20', isActive);
                b.classList.toggle('font-bold', isActive);
                b.classList.toggle('bg-muted/50', !isActive);
                b.classList.toggle('text-muted-foreground', !isActive);
                b.classList.toggle('border-transparent', !isActive);
                b.classList.toggle('font-medium', !isActive);
                b.querySelector('.check-icon').classList.toggle('hidden', !isActive);
            });

            statusGroup.querySelectorAll('.status-option').forEach(label => {
                const checkbox = label.querySelector('.status-checkbox');
                checkbox.checked = false;
                label.classList.remove('border-primary', 'bg-primary/5');
                label.classList.add('border-border', 'bg-background');
                const span = label.querySelector('span:not(.material-symbols-outlined)');
                span.classList.remove('text-primary');
                span.classList.add('text-muted-foreground');
            });

            akreditasiGroup.querySelectorAll('.akreditasi-btn').forEach(btn => {
                btn.classList.remove('bg-success/10', 'text-success', 'border-success/20');
                btn.classList.add('bg-muted/50', 'text-muted-foreground', 'border-border');
                const dot = btn.querySelector('.dot');
                if (dot) {
                    dot.classList.remove('bg-success');
                    dot.classList.add('bg-muted-foreground');
                }
            });

            fetchData(1);
        });

        // --- Pagination ---
        pagination.addEventListener('click', (e) => {
            const btn = e.target.closest('.page-btn');
            if (!btn || btn.disabled) return;

            const targetPage = parseInt(btn.dataset.page, 10);
            if (!targetPage || targetPage < 1 || targetPage > state.totalPages || targetPage === state.page) return;

            fetchData(targetPage);
        });
    })();
</script>
<?= $this->endSection() ?>