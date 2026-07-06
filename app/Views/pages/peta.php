<?= $this->extend('layouts/main-home') ?>
<?= $this->section('content') ?>

<main class="flex h-screen overflow-hidden relative">

    <!-- Backdrop (mobile only, muncul saat drawer terbuka) -->
    <div id="panel-backdrop" class="hidden fixed inset-0 bg-black/40 z-40 lg:hidden"></div>

    <!-- Tombol hamburger untuk buka drawer (mobile only) -->
    <button id="mobile-panel-open" class="lg:hidden fixed left-4 top-24 z-30 w-12 h-12 glass-effect rounded-2xl shadow-2xl flex items-center justify-center text-primary">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <!-- Floating Side Panel / Drawer di mobile -->
    <aside id="side-panel" class="fixed inset-y-0 left-0 z-99999 w-[85%] max-w-sm -translate-x-full transition-transform duration-300 ease-in-out pointer-events-none flex flex-col lg:translate-x-0 lg:z-40 lg:inset-y-auto lg:left-6 lg:top-24 lg:bottom-6 lg:w-1/3 xl:w-1/4 lg:max-w-none">
        <div class="pointer-events-auto flex flex-col glass-effect shadow-2xl overflow-hidden border-none max-h-full h-full lg:h-auto lg:rounded-2xl">

            <!-- Header (selalu terlihat) -->
            <div class="p-6 pb-4 shrink-0 space-y-2">
                <div class="flex justify-between items-start">
                    <h2 class="text-xl font-headline font-bold text-foreground">Eksplorasi</h2>
                    <div class="flex items-center gap-2">
                        <span id="badge-count" class="bg-primary/10 text-primary px-2 py-0.5 rounded text-[10px] font-bold"><?= (int) $totalSekolah ?> DATA</span>

                        <!-- Toggle Button (desktop: collapse body) -->
                        <button id="panel-toggle" class="hidden lg:flex shrink-0 w-7 h-7 items-center justify-center rounded-lg bg-secondary hover:bg-background transition-all">
                            <span id="panel-toggle-icon" class="material-symbols-outlined text-[18px]! text-foreground transition-transform duration-300">
                                expand_more
                            </span>
                        </button>

                        <!-- Close Button (mobile: tutup drawer) -->
                        <button id="mobile-panel-close" class="lg:hidden shrink-0 w-7 h-7 flex items-center justify-center rounded-lg bg-secondary hover:bg-background transition-all">
                            <span class="material-symbols-outlined text-[18px]! text-foreground">close</span>
                        </button>
                    </div>
                </div>
                <p class="text-sm text-muted-foreground leading-relaxed">Analisis sebaran fasilitas pendidikan secara real-time.</p>
            </div>

            <!-- Collapsible Body -->
            <div id="side-panel-body" class="grid transition-[grid-template-rows] duration-300 ease-in-out min-h-0 flex-1" style="grid-template-rows: 1fr;">
                <div class="overflow-hidden min-h-0 flex flex-col flex-1 px-6 gap-4">

                    <!-- Search Input -->
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[18px]! text-muted-foreground">search</span>
                        <input
                            id="search-input"
                            type="text"
                            placeholder="Cari sekolah..."
                            class="w-full pl-9 pr-4 py-2 text-sm rounded-xl border border-border bg-secondary/50 focus:outline-none  focus:border-primary transition-all" />
                    </div>

                    <!-- Filter Tabs -->
                    <div class="flex p-1 bg-secondary rounded-xl gap-1">
                        <button data-filter="SEMUA" class="filter-tab flex-1 py-2 rounded-lg bg-primary text-primary-foreground text-[10px] font-bold shadow-sm transition-all">SEMUA</button>
                        <button data-filter="TK" class="filter-tab flex-1 py-2 rounded-lg text-muted-foreground hover:bg-background transition-all text-[10px] font-bold">TK</button>
                        <button data-filter="SD" class="filter-tab flex-1 py-2 rounded-lg text-muted-foreground hover:bg-background transition-all text-[10px] font-bold">SD</button>
                        <button data-filter="SMP" class="filter-tab flex-1 py-2 rounded-lg text-muted-foreground hover:bg-background transition-all text-[10px] font-bold">SMP</button>
                    </div>

                    <!-- Scrollable School Cards -->
                    <div id="school-list" class="flex-1 overflow-y-auto custom-scrollbar py-2 space-y-4">
                        <!-- Cards injected by JS -->
                    </div>

                    <!-- Empty State -->
                    <div id="empty-state" class="hidden flex-1 flex flex-col items-center justify-center text-center py-10 gap-2">
                        <span class="material-symbols-outlined text-[48px]! text-muted-foreground/30">search_off</span>
                        <p class="text-sm font-bold text-muted-foreground">Tidak ditemukan</p>
                        <p class="text-xs text-muted-foreground/70">Coba kata kunci yang berbeda</p>
                    </div>

                </div>
            </div>

        </div>
    </aside>

    <!-- Map Section -->
    <section class="flex-1 relative">
        <div class="absolute inset-0 z-0">
            <div id="map" class="w-full h-full"></div>
        </div>

        <!-- Map Controls -->
        <div class="absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 flex flex-col items-end gap-3 z-10">
            <div class="flex flex-col w-fit glass-effect rounded-2xl shadow-2xl overflow-hidden">
                <button data-map-action="zoom-in" class="w-12 h-12 flex items-center justify-center text-primary hover:bg-accent transition-colors border-b border-border/50" title="Zoom in">
                    <span class="material-symbols-outlined">add</span>
                </button>
                <button data-map-action="zoom-out" class="w-12 h-12 flex items-center justify-center text-primary hover:bg-accent transition-colors" title="Zoom out">
                    <span class="material-symbols-outlined">remove</span>
                </button>
            </div>
            <!-- <button id="btn-locate" class="w-12 h-12 glass-effect rounded-2xl shadow-2xl flex items-center justify-center text-primary hover:bg-accent transition-colors" title="Lokasi saya">
                <span class="material-symbols-outlined">my_location</span>
            </button> -->
            <button id="btn-layers" class="w-12 h-12 glass-effect rounded-2xl shadow-2xl flex items-center justify-center text-primary hover:bg-accent transition-colors" title="Ganti layer peta">
                <span class="material-symbols-outlined">layers</span>
            </button>

            <!-- Legenda & Kecamatan disembunyikan di mobile, fokus ke peta + panel -->
            <div class="hidden lg:flex lg:w-full w-fit lg:min-w-70 py-3 px-3.5 space-y-1 flex-col glass-effect rounded-2xl shadow-xl text-primary">
                <h1 class="font-bold text-foreground text-sm">Legenda</h1>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 badge-TK rounded-full inline-block"></span>
                        <span class="text-xs font-bold text-muted-foreground">Taman Kanak-Kanak (TK)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 badge-SD rounded-full inline-block"></span>
                        <span class="text-xs font-bold text-muted-foreground">Sekolah Dasar (SD)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-primary rounded-full inline-block"></span>
                        <span class="text-xs font-bold text-muted-foreground">Sekolah Menangah Pertama (SMP)</span>
                    </div>
                </div>
            </div>

            <div id="kecamatan-legend" class="hidden lg:flex lg:w-full w-fit lg:min-w-70 py-3 px-3.5 space-y-1 flex-col glass-effect rounded-2xl shadow-xl text-primary">
                <h1 class="font-bold text-foreground text-sm">Kecamatan</h1>
                <div id="kecamatan-toggle-list" class="space-y-1">
                    <!-- diisi oleh JS -->
                </div>
            </div>
        </div>

        <!-- Bottom Stats Bar (disembunyikan di mobile) -->
        <div class="hidden lg:block absolute bottom-8 right-16 w-full max-w-4xl px-6 pointer-events-none z-50">
            <div class="pointer-events-auto glass-effect rounded-2xl shadow-2xl px-10 h-20 border-none flex items-center justify-between">
                <div class="flex items-center gap-10">
                    <div class="flex flex-col gap-1">
                        <p class="text-[9px] font-bold text-muted-foreground uppercase tracking-widest">Total Sekolah</p>
                        <div class="flex items-baseline gap-1">
                            <span id="stat-total" class="text-2xl font-stat font-bold text-primary">0</span>
                            <span class="text-[10px] text-success font-bold">+12%</span>
                        </div>
                    </div>
                    <div class="w-[1px] h-10 bg-border"></div>
                    <div class="flex flex-col gap-1">
                        <p class="text-[9px] font-bold text-muted-foreground uppercase tracking-widest">Akreditasi A</p>
                        <div class="flex items-baseline gap-1">
                            <span id="stat-akred-a" class="text-2xl font-stat font-bold text-foreground">0</span>
                            <span class="text-[10px] text-muted-foreground font-medium">UNIT</span>
                        </div>
                    </div>
                    <div class="w-[1px] h-10 bg-border"></div>
                    <div class="flex flex-col gap-1">
                        <p class="text-[9px] font-bold text-muted-foreground uppercase tracking-widest">Butuh Perhatian</p>
                        <div class="flex items-baseline gap-1">
                            <span id="stat-perhatian" class="text-2xl font-stat font-bold text-destructive">0</span>
                            <span class="text-[10px] text-destructive font-bold flex items-center gap-0.5">
                                <span class="material-symbols-outlined text-[12px]!">warning</span>
                            </span>
                        </div>
                    </div>
                </div>
                <button class="bg-primary/10 text-primary h-12 w-12 rounded-xl hover:bg-primary/20 transition-all flex items-center justify-center shadow-sm" title="Analisis data">
                    <span class="material-symbols-outlined font-bold">insights</span>
                </button>
            </div>
        </div>
    </section>
</main>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<style>
    /* Sidebar card highlight */
    .school-card.active {
        border-color: hsl(221 83% 53%);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ─── DATA SEKOLAH (Ganti dengan data dari controller nanti) ──────────────
        // Format: { id, nama, jenis, status, akreditasi, lat, lng, alamat, siswa, guru, img }
        const sekolahData = <?= json_encode(json_decode($sekolahData), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

        // ─── HTML ESCAPE HELPER (mencegah XSS dari data sekolah/kecamatan) ────────
        function escapeHtml(value) {
            if (value === null || value === undefined) return '';
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // ─── MAP INIT ─────────────────────────────────────────────────────────────
        const map = L.map('map', {
            zoomControl: false,
            preferCanvas: true,
            minZoom: 10,
            maxZoom: 18
        }).setView([-0.4555, 100.5771], 12);

        // Tile layers
        const tileLayers = {
            light: L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
            }),
            satellite: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: '&copy; Esri'
            })
        };
        let activeLayer = 'light';
        tileLayers.light.addTo(map);

        window.addEventListener('load', () => map.invalidateSize());

        const panelToggle = document.getElementById('panel-toggle');
        const panelBody = document.getElementById('side-panel-body');
        const panelIcon = document.getElementById('panel-toggle-icon');

        panelToggle.addEventListener('click', () => {
            const isClosed = panelBody.classList.toggle('panel-closed');
            panelIcon.classList.toggle('rotate-180', isClosed);

            setTimeout(() => {
                if (typeof map !== 'undefined') {
                    map.invalidateSize();
                }
            }, 300);
        });

        // ─── DRAWER PANEL DI MOBILE ─────────────────────────────────────────────
        const sidePanel = document.getElementById('side-panel');
        const panelBackdrop = document.getElementById('panel-backdrop');
        const mobilePanelOpen = document.getElementById('mobile-panel-open');
        const mobilePanelClose = document.getElementById('mobile-panel-close');

        function openMobilePanel() {
            sidePanel.classList.remove('-translate-x-full');
            panelBackdrop.classList.remove('hidden');
        }

        function closeMobilePanel() {
            sidePanel.classList.add('-translate-x-full');
            panelBackdrop.classList.add('hidden');
        }

        mobilePanelOpen?.addEventListener('click', openMobilePanel);
        mobilePanelClose?.addEventListener('click', closeMobilePanel);
        panelBackdrop?.addEventListener('click', closeMobilePanel);

        // Tutup drawer otomatis saat resize ke layar besar (lg ke atas)
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeMobilePanel();
            }
        });

        // ─── DATA KECAMATAN (GeoJSON per kecamatan dari database) ────────────────
        const kecamatanGeojsonData = <?= json_encode(json_decode($kecamatanGeojson), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

        // ─── GEOJSON WILAYAH (multi-kecamatan) ────────────────────────────────────
        const kecamatanLayers = {}; // id -> L.GeoJSON layer
        const boundsGroup = L.featureGroup();

        kecamatanGeojsonData.forEach(kec => {
            const color = kec.warna || '#2563eb';

            const layer = L.geoJSON(kec.geojson, {
                style: {
                    color: color,
                    weight: 1.8,
                    opacity: 0.9,
                    fillColor: color,
                    fillOpacity: 0.12
                },
                onEachFeature(feature, featLayer) {
                    featLayer.on('mouseover', function() {
                        this.setStyle({
                            weight: 3,
                            fillOpacity: 0.25
                        });
                        this.bringToFront();
                    });
                    featLayer.on('mouseout', function() {
                        layer.resetStyle(this);
                    });
                }
            }).addTo(map);

            kecamatanLayers[kec.id] = layer;
            boundsGroup.addLayer(layer);
        });

        if (Object.keys(kecamatanLayers).length > 0) {
            map.fitBounds(boundsGroup.getBounds(), {
                padding: [50, 50],
                maxZoom: 18
            });

            map.once('moveend', function() {
                map.setMinZoom(map.getZoom());
            });
        } else {
            log_message; // (hapus baris ini, hanya placeholder) — kalau kosong, minZoom biarkan default
        }

        // ─── TOGGLE PER KECAMATAN (sidebar checkbox) ──────────────────────────────
        function renderKecamatanToggles() {
            const container = document.getElementById('kecamatan-toggle-list');
            if (!container) return;

            container.innerHTML = '';

            kecamatanGeojsonData.forEach(kec => {
                const color = kec.warna || '#2563eb';
                const row = document.createElement('button');
                row.type = 'button';
                row.className = 'kecamatan-toggle flex items-center justify-between gap-3 w-full cursor-pointer';
                row.dataset.kecId = kec.id;
                row.setAttribute('aria-pressed', 'true');
                row.innerHTML = `
            <span class="flex items-center gap-2">
                <span class="kec-dot w-2 h-2 rounded-full inline-block ring-1 ring-black/10" style="background:${escapeHtml(color)}"></span>
                <span class="kec-label text-xs font-bold text-muted-foreground">${escapeHtml(kec.nama_kecamatan)}</span>
            </span>
            <span class="kec-switch relative inline-flex h-4 w-7 shrink-0 items-center rounded-full transition-colors duration-200" style="background:${escapeHtml(color)}" data-color="${escapeHtml(color)}">
                <span class="kec-thumb inline-block h-3 w-3 transform rounded-full bg-white shadow-sm transition-transform duration-200 translate-x-3.5"></span>
            </span>
        `;
                container.appendChild(row);
            });

            container.querySelectorAll('.kecamatan-toggle').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.kecId;
                    const layer = kecamatanLayers[id];
                    if (!layer) return;

                    const isActive = btn.getAttribute('aria-pressed') === 'true';
                    const track = btn.querySelector('.kec-switch');
                    const thumb = btn.querySelector('.kec-thumb');
                    const label = btn.querySelector('.kec-label');

                    if (isActive) {
                        map.removeLayer(layer);
                        btn.setAttribute('aria-pressed', 'false');
                        track.style.background = '#cbd5e1'; // slate-300, track mati
                        thumb.classList.remove('translate-x-3.5');
                        thumb.classList.add('translate-x-0.5');
                        label.classList.add('opacity-50');
                    } else {
                        map.addLayer(layer);
                        btn.setAttribute('aria-pressed', 'true');
                        track.style.background = track.dataset.color; // sekarang terisi dengan benar
                        thumb.classList.remove('translate-x-0.5');
                        thumb.classList.add('translate-x-3.5');
                        label.classList.remove('opacity-50');
                    }
                });
            });
        }

        renderKecamatanToggles();

        // ─── CUSTOM MARKER ICON FACTORY ───────────────────────────────────────────
        function createMarkerIcon(sekolah) {
            const isHighlighted = false;
            return L.divIcon({
                className: '',
                html: `
                <div class="
                w-2.5 h-2.5
                badge-${escapeHtml(sekolah.jenis)}
                rounded-full
                border-2 border-white
                shadow-md
            "></div>
                `,
                iconSize: [10, 10],
                iconAnchor: [5, 5],
                popupAnchor: [0, -36]
            });
        }

        // ─── POPUP BUILDER ────────────────────────────────────────────────────────
        function buildPopup(s) {
            const badgeClass = `badge-${escapeHtml(s.akreditasi)}`;
            const statusColor = s.status === 'NEGERI' ? 'bg-primary text-primary' : 'bg-secondary text-secondary-foreground';
            const alamat = s.alamat ? `${escapeHtml(s.alamat)}, ` : '';
            const kecamatan = s.nama_kecamatan ? `Kec. ${escapeHtml(s.nama_kecamatan)}` : '';

            return `
                <div class="font-sans" style="font-family:'Plus Jakarta Sans',sans-serif; min-width:260px;">
                    <div class="relative aspect-video overflow-hidden">
                     ${s.img ? `
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="${encodeURI(s.img)}" alt="${escapeHtml(s.nama || '')}">
                ` : `
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl! text-slate-400">school</span>
                    </div>
                `}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="text-white text-[9px] font-bold px-2 py-1 rounded uppercase tracking-widest shadow ${statusColor}">
                                ${escapeHtml(s.jenis)} ${escapeHtml(s.status)}
                            </span>
                        </div>
                        <span class="${badgeClass} text-white text-[10px] font-bold px-2 py-1 rounded-full absolute bottom-3 right-3 flex items-center gap-1 shadow">
                            <span class="w-1.5 h-1.5 bg-white rounded-full inline-block"></span>
                            ${escapeHtml(s.akreditasi)}
                        </span>
                    </div>
                    <div class="p-4 flex flex-col gap-3">
                        <h3 class="font-bold text-[15px] text-slate-800">${escapeHtml(s.nama)}</h3>
                        <div class="flex items-center gap-1 text-muted-foreground">
                            <span class="material-symbols-outlined text-[18px]! text-primary self-start">location_on</span>
                            <span class="text-[12px] text-slate-500">${alamat}${kecamatan}</span>
                        </div>
                        <div class="flex justify-center items-center pt-2.5 border-t border-dashed border-slate-200">
                            <a href="<?= site_url('sekolah') ?>/${encodeURIComponent(s.slug)}"
                            class="text-primary hover:opacity-80 text-xs font-bold flex items-center gap-1 no-underline group/btn">
                                DETAIL SEKOLAH
                                <span class="material-symbols-outlined text-[14px]! group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>`;
        }

        // ─── MARKER MANAGEMENT ────────────────────────────────────────────────────
        const markerMap = {}; // id → L.Marker
        let activeCardId = null;

        function addMarkers(list) {
            // Clear existing
            Object.values(markerMap).forEach(m => map.removeLayer(m));
            Object.keys(markerMap).forEach(k => delete markerMap[k]);

            list.forEach(s => {
                const marker = L.marker([s.lat, s.lng], {
                        icon: createMarkerIcon(s)
                    })
                    .bindPopup(buildPopup(s), {
                        maxWidth: 300,
                        offset: L.point(0, 100), // tidak ada offset sama sekali
                        autoPan: false
                        // className:
                    })
                    .addTo(map);

                marker.on('click', () => {
                    highlightCard(s.id);
                    map.panTo([s.lat, s.lng], {
                        animate: true,
                        duration: 0.5
                    });
                });

                markerMap[s.id] = marker;
            });
        }

        function highlightCard(id) {
            // Remove previous highlight
            document.querySelectorAll('.school-card').forEach(c => c.classList.remove('active'));
            const card = document.getElementById(`card-${id}`);
            if (card) {
                card.classList.add('active');
                card.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }
            activeCardId = id;
        }

        // ─── SIDEBAR CARD RENDERER ────────────────────────────────────────────────
        function renderCards(list) {
            const container = document.getElementById('school-list');
            const emptyState = document.getElementById('empty-state');

            container.innerHTML = '';

            if (list.length === 0) {
                container.classList.add('hidden');
                emptyState.classList.remove('hidden');
                return;
            }

            container.classList.remove('hidden');
            emptyState.classList.add('hidden');

            list.forEach(s => {

                const badgeCls = `badge-${escapeHtml(s.akreditasi)}`;
                // const statusLabel = s.jenis === 'SD' ? 'badge-C text-primary-foreground' : 'badge-B text-foreground';
                const statusLabel = `badge-${escapeHtml(s.jenis)} text-white`;
                const card = document.createElement('div');
                const alamat = s.alamat ? `${escapeHtml(s.alamat)}, ` : '';
                const kecamatan = s.nama_kecamatan ? `Kec. ${escapeHtml(s.nama_kecamatan)}` : '';

                card.id = `card-${s.id}`;
                card.className = 'school-card school-card-vibrant bg-card text-card-foreground rounded-2xl overflow-hidden border border-border/50 cursor-pointer group transition-all';
                card.innerHTML = `
                <div class="relative aspect-video overflow-hidden">
                ${s.img ? `
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="${encodeURI(s.img)}" alt="${escapeHtml(s.nama || '')}">
                ` : `
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-4xl! text-slate-400">school</span>
                    </div>
                `}

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <span class="absolute top-3 left-3 ${statusLabel} text-[9px] font-bold px-2 py-1 rounded uppercase tracking-widest shadow">
                        ${escapeHtml(s.jenis)} ${escapeHtml(s.status)}
                    </span>
                    <span class="${badgeCls} text-white text-[10px] font-bold px-2 py-1 rounded-full absolute bottom-3 right-3 flex items-center gap-1 shadow">
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span> ${escapeHtml(s.akreditasi)}
                    </span>
                </div>
                <div class="p-3 flex flex-col gap-2">
                    <h3 class="font-headline font-bold text-sm group-hover:text-primary transition-colors leading-snug">${escapeHtml(s.nama)}</h3>
                    <div class="flex items-center gap-1 text-muted-foreground">
                        <span class="material-symbols-outlined text-[18px]! text-primary">location_on</span>
                        <span class="text-[12px] truncate">${alamat}${kecamatan}</span>
                    </div>
                    <div class="flex justify-center items-center pt-2 border-t border-dashed border-border">
                        <button class="text-primary hover:opacity-80 text-xs font-bold flex items-center gap-1 group/btn">
                            LIHAT SEKOLAH <span class="material-symbols-outlined text-[16px]! group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                    </div>
                </div>`;

                // Click → pan map & open popup
                card.addEventListener('click', () => {
                    const marker = markerMap[s.id];
                    if (marker) {
                        map.panTo([s.lat, s.lng], {
                            animate: true,
                            duration: 0.6
                        });
                        setTimeout(() => marker.openPopup(), 400);
                    }
                    highlightCard(s.id);
                    closeMobilePanel();
                });

                container.appendChild(card);
            });
        }

        // ─── STATS UPDATE ─────────────────────────────────────────────────────────
        function updateStats(list) {
            document.getElementById('stat-total').textContent = list.length.toLocaleString();
            document.getElementById('stat-akred-a').textContent = list.filter(s => s.akreditasi === 'A').length;
            document.getElementById('stat-perhatian').textContent = list.filter(s => s.akreditasi === 'C').length;
        }

        // ─── FILTER & SEARCH LOGIC ───────────────────────────────────────────────
        let currentFilter = 'SEMUA';
        let currentSearch = '';

        function getFiltered() {
            return sekolahData.filter(s => {
                const matchJenis = currentFilter === 'SEMUA' || s.jenis === currentFilter;
                const nama = (s.nama || '').toLowerCase();
                const alamat = (s.alamat || '').toLowerCase();
                const matchSearch = nama.includes(currentSearch.toLowerCase()) ||
                    alamat.includes(currentSearch.toLowerCase());
                return matchJenis && matchSearch;
            });
        }

        function applyFilter() {
            const filtered = getFiltered();
            renderCards(filtered);
            addMarkers(filtered);
            updateStats(filtered);
        }

        // Filter tabs
        document.querySelectorAll('.filter-tab').forEach(btn => {
            btn.addEventListener('click', () => {
                currentFilter = btn.dataset.filter;
                document.querySelectorAll('.filter-tab').forEach(t => {
                    t.classList.remove('bg-primary', 'text-primary-foreground', 'shadow-sm');
                    t.classList.add('text-muted-foreground', 'hover:bg-background');
                });
                btn.classList.add('bg-primary', 'text-primary-foreground', 'shadow-sm');
                btn.classList.remove('text-muted-foreground', 'hover:bg-background');
                applyFilter();
            });
        });

        // Search input
        let searchDebounce;
        document.getElementById('search-input').addEventListener('input', e => {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => {
                currentSearch = e.target.value;
                applyFilter();
            }, 300);
        });

        // ─── MAP CONTROLS ─────────────────────────────────────────────────────────
        document.querySelector('[data-map-action="zoom-in"]').addEventListener('click', () => map.zoomIn());
        document.querySelector('[data-map-action="zoom-out"]').addEventListener('click', () => map.zoomOut());

        // Locate me
        /* document.getElementById('btn-locate').addEventListener('click', () => {
            map.locate({
                setView: true,
                maxZoom: 15
            });
        });
        map.on('locationfound', e => {
            L.circleMarker(e.latlng, {
                radius: 8,
                color: '#2563eb',
                fillColor: '#3b82f6',
                fillOpacity: 0.7,
                weight: 2
            }).addTo(map).bindPopup('Lokasi Anda').openPopup();
        });
        map.on('locationerror', () => alert('Lokasi tidak dapat ditemukan.')); */

        // Layer switcher
        document.getElementById('btn-layers').addEventListener('click', () => {
            if (activeLayer === 'light') {
                tileLayers.light.remove();
                tileLayers.satellite.addTo(map);
                activeLayer = 'satellite';
            } else {
                tileLayers.satellite.remove();
                tileLayers.light.addTo(map);
                activeLayer = 'light';
            }
        });

        // ─── INITIAL RENDER ───────────────────────────────────────────────────────
        applyFilter();
    });
</script>
<?= $this->endSection() ?>