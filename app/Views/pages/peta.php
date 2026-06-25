<?= $this->extend('layouts/main-home') ?>
<?= $this->section('content') ?>

<main class="flex h-screen overflow-hidden relative">

    <!-- Floating Side Panel -->
    <!-- Floating Side Panel -->
    <aside id="side-panel" class="fixed left-6 top-24 bottom-6 w-1/4 z-40 flex flex-col pointer-events-none">
        <div class="pointer-events-auto flex flex-col glass-effect rounded-2xl shadow-2xl overflow-hidden border-none max-h-full">

            <!-- Header (selalu terlihat) -->
            <div class="p-6 pb-4 shrink-0">
                <div class="flex justify-between items-start mb-2">
                    <h2 class="text-xl font-headline font-bold text-foreground">Eksplorasi</h2>
                    <div class="flex items-center gap-2">
                        <span id="badge-count" class="bg-primary/10 text-primary px-2 py-0.5 rounded text-[10px] font-bold"><?= $totalSekolah ?> DATA</span>

                        <!-- Toggle Button -->
                        <button id="panel-toggle" class="shrink-0 w-7 h-7 flex items-center justify-center rounded-lg bg-secondary hover:bg-background transition-all">
                            <span id="panel-toggle-icon" class="material-symbols-outlined text-[18px] text-foreground transition-transform duration-300">
                                expand_more
                            </span>
                        </button>
                    </div>
                </div>
                <p class="text-sm text-muted-foreground leading-relaxed">Analisis sebaran fasilitas pendidikan secara real-time.</p>
            </div>

            <!-- Collapsible Body -->
            <div id="side-panel-body" class="grid transition-[grid-template-rows] duration-300 ease-in-out" style="grid-template-rows: 1fr;">
                <div class="overflow-hidden min-h-0 flex flex-col px-6">

                    <!-- Search Input -->
                    <div class="relative mb-4">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[18px] text-muted-foreground">search</span>
                        <input
                            id="search-input"
                            type="text"
                            placeholder="Cari sekolah..."
                            class="w-full pl-9 pr-4 py-2 text-sm rounded-xl border border-border bg-secondary/50 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all" />
                    </div>

                    <!-- Filter Tabs -->
                    <div class="flex p-1 bg-secondary rounded-xl gap-1 mb-2">
                        <button data-filter="SEMUA" class="filter-tab flex-1 py-2 rounded-lg bg-primary text-primary-foreground text-[10px] font-bold shadow-sm transition-all">SEMUA</button>
                        <button data-filter="SD" class="filter-tab flex-1 py-2 rounded-lg text-muted-foreground hover:bg-background transition-all text-[10px] font-bold">SD</button>
                        <button data-filter="SMP" class="filter-tab flex-1 py-2 rounded-lg text-muted-foreground hover:bg-background transition-all text-[10px] font-bold">SMP</button>
                    </div>

                    <!-- Scrollable School Cards -->
                    <div id="school-list" class="flex-1 overflow-y-auto custom-scrollbar py-2 space-y-4">
                        <!-- Cards injected by JS -->
                    </div>

                    <!-- Empty State -->
                    <div id="empty-state" class="hidden flex-1 flex flex-col items-center justify-center text-center py-10">
                        <span class="material-symbols-outlined text-[48px] text-muted-foreground/30 mb-3">search_off</span>
                        <p class="text-sm font-bold text-muted-foreground">Tidak ditemukan</p>
                        <p class="text-xs text-muted-foreground/70 mt-1">Coba kata kunci yang berbeda</p>
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
        <div class="absolute right-8 top-1/2 -translate-y-1/2 flex flex-col items-end gap-3 z-10">
            <div class="flex flex-col w-fit  glass-effect rounded-2xl shadow-2xl overflow-hidden">
                <button data-map-action="zoom-in" class="w-12 h-12 flex items-center justify-center text-primary hover:bg-accent transition-colors border-b border-border/50" title="Zoom in">
                    <span class="material-symbols-outlined">add</span>
                </button>
                <button data-map-action="zoom-out" class="w-12 h-12 flex items-center justify-center text-primary hover:bg-accent transition-colors" title="Zoom out">
                    <span class="material-symbols-outlined">remove</span>
                </button>
            </div>
            <button id="btn-locate" class="w-12 h-12 glass-effect rounded-2xl shadow-2xl flex items-center justify-center text-primary hover:bg-accent transition-colors" title="Lokasi saya">
                <span class="material-symbols-outlined">my_location</span>
            </button>
            <button id="btn-layers" class="w-12 h-12 glass-effect rounded-2xl shadow-2xl flex items-center justify-center text-primary hover:bg-accent transition-colors" title="Ganti layer peta">
                <span class="material-symbols-outlined">layers</span>
            </button>

            <div class="w-fit p-3 space-y-1 flex-col glass-effect rounded-2xl shadow-xl flex  text-primary ">
                <h1 class="font-bold text-foreground text-sm">Legenda</h1>
                <div class="">

                    <div class="flex items-center">
                        <span class="w-2 h-2 badge-C rounded-full inline-block mr-2"></span>
                        <span class="text-xs font-bold text-muted-foreground">Sekolah Dasar (SD)</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-2 h-2 bg-primary rounded-full inline-block mr-2"></span>
                        <span class="text-xs font-bold text-muted-foreground">Sekolah Menangah Pertama (SMP)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Stats Bar -->
        <div class="absolute bottom-8 right-16 w-full max-w-4xl px-6 pointer-events-none z-50">
            <div class="pointer-events-auto glass-effect rounded-2xl shadow-2xl px-10 h-20 border-none flex items-center justify-between">
                <div class="flex items-center gap-10">
                    <div class="flex flex-col">
                        <p class="text-[9px] font-bold text-muted-foreground uppercase tracking-widest mb-1">Total Sekolah</p>
                        <div class="flex items-baseline gap-1">
                            <span id="stat-total" class="text-2xl font-stat font-bold text-primary">0</span>
                            <span class="text-[10px] text-success font-bold">+12%</span>
                        </div>
                    </div>
                    <div class="w-[1px] h-10 bg-border"></div>
                    <div class="flex flex-col">
                        <p class="text-[9px] font-bold text-muted-foreground uppercase tracking-widest mb-1">Akreditasi A</p>
                        <div class="flex items-baseline gap-1">
                            <span id="stat-akred-a" class="text-2xl font-stat font-bold text-foreground">0</span>
                            <span class="text-[10px] text-muted-foreground font-medium">UNIT</span>
                        </div>
                    </div>
                    <div class="w-[1px] h-10 bg-border"></div>
                    <div class="flex flex-col">
                        <p class="text-[9px] font-bold text-muted-foreground uppercase tracking-widest mb-1">Butuh Perhatian</p>
                        <div class="flex items-baseline gap-1">
                            <span id="stat-perhatian" class="text-2xl font-stat font-bold text-destructive">0</span>
                            <span class="text-[10px] text-destructive font-bold flex items-center gap-0.5">
                                <span class="material-symbols-outlined text-[12px]">warning</span>
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
    /* Custom Leaflet marker styles */
    .school-marker {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        border: 2px solid white;
        transition: transform 0.2s ease;
        cursor: pointer;
    }

    .school-marker:hover {
        transform: rotate(-45deg) scale(1.15);
    }

    .school-marker .inner {
        transform: rotate(45deg);
        font-size: 14px;
        font-weight: 700;
        color: white;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }







    /* Sidebar card highlight */
    .school-card.active {
        ring: 2px;
        border-color: hsl(221 83% 53%);
        box-shadow: 0 0 0 2px hsl(221 83% 53% / 0.3);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ─── DATA SEKOLAH (Ganti dengan data dari controller nanti) ──────────────
        // Format: { id, nama, jenis, status, akreditasi, lat, lng, alamat, siswa, guru, img }
        const sekolahData = <?= $sekolahData ?>;

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

        // ─── GEOJSON WILAYAH ──────────────────────────────────────────────────────
        fetch("<?= base_url('id1305_tanah_datar.geojson') ?>")
            .then(res => res.json())
            .then(data => {
                const wilayahLayer = L.geoJSON(data, {
                    style: {
                        color: '#2563eb',
                        weight: 1.8,
                        opacity: 0.9,
                        fillColor: '#3b82f6',
                        fillOpacity: 0.06
                    },
                    onEachFeature(feature, layer) {
                        layer.on('mouseover', function() {
                            this.setStyle({
                                weight: 3,
                                color: '#1d4ed8',
                                fillOpacity: 0.15
                            });
                            this.bringToFront();
                        });
                        layer.on('mouseout', function() {
                            wilayahLayer.resetStyle(this);
                        });
                    }
                }).addTo(map);
                map.fitBounds(wilayahLayer.getBounds(), {
                    padding: [50, 50],
                    maxZoom: 14
                });

                map.once('moveend', function() {
                    map.setMinZoom(map.getZoom());
                });
            })
            .catch(err => console.error('GeoJSON gagal dimuat:', err));
        const markerColor = {
            SD: '#EF4444', // Merah cerah modern
            SMP: '#EAB308', // Kuning/Emas modern
            SMA: '#3B82F6' // Biru (sudah benar)

        };
        // ─── CUSTOM MARKER ICON FACTORY ───────────────────────────────────────────
        function createMarkerIcon(sekolah) {
            const isHighlighted = false;
            const color = markerColor[sekolah.jenis] ?? '#64748b';
            return L.divIcon({
                className: '',
                html: `<div style="width:10px;height:10px;border-radius:50%;background:${color};border:2px solid white;box-shadow:0 1px 4px rgba(0,0,0,.3)"></div>`,
                iconSize: [10, 10],
                iconAnchor: [5, 5],
                popupAnchor: [0, -36]
            });
        }

        // ─── POPUP BUILDER ────────────────────────────────────────────────────────
        function buildPopup(s) {
            const badgeClass = `badge-${s.akreditasi}`;
            const statusColor = s.status === 'NEGERI' ? 'bg-primary text-primary' : 'bg-secondary text-secondary-foreground';
            return `
                <div class="font-sans" style="font-family:'Plus Jakarta Sans',sans-serif; min-width:260px;">
                    <div class="relative h-32 overflow-hidden">
                     ${s.img ? `
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="${s.img}" alt="${s.nama || ''}">
                ` : `
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-8xl text-slate-400">school</span>
                    </div>
                `}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="text-white text-[9px] font-bold px-2 py-1 rounded uppercase tracking-widest shadow ${statusColor}">
                                ${s.jenis} ${s.status}
                            </span>
                        </div>
                        <span class="${badgeClass} text-white text-[10px] font-bold px-2 py-1 rounded-full absolute bottom-3 right-3 flex items-center gap-1 shadow">
                            <span class="w-1.5 h-1.5 bg-white rounded-full inline-block"></span>
                            ${s.akreditasi}
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-[15px] mb-1 text-slate-800">${s.nama}</h3>
                        <div class="flex items-center gap-1 text-muted-foreground mb-3">
                            <span class="material-symbols-outlined text-[14px] text-primary self-start">location_on</span>
                            <span class="text-[12px] text-slate-500">${s.alamat}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2.5 border-t border-dashed border-slate-200">
                            <div class="flex items-center gap-3 text-[11px] text-slate-400">
                                <div class="text-center">
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wide">Siswa</p>
                                    <p class="text-base font-bold text-primary">${s.siswa.toLocaleString()}</p>
                                </div>
                                <span class="w-px h-6 bg-slate-200"></span>
                                <div class="text-center">
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wide">Guru</p>
                                    <p class="text-base font-bold text-slate-800">${s.guru}</p>
                                </div>
                            </div>
                            <a href="<?= site_url('sekolah') ?>/${s.slug}"
                            class="text-primary hover:opacity-80 text-[10px] font-bold flex items-center gap-1 no-underline group/btn">
                                DETAIL
                                <span class="material-symbols-outlined text-[14px] group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
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

                const badgeCls = `badge-${s.akreditasi}`;
                const statusLabel = s.jenis === 'SD' ? 'badge-C text-primary-foreground' : 'badge-B text-foreground';
                const card = document.createElement('div');
                card.id = `card-${s.id}`;
                card.className = 'school-card school-card-vibrant bg-card text-card-foreground rounded-2xl overflow-hidden border border-border/50 cursor-pointer group transition-all';
                card.innerHTML = `
                <div class="relative h-32">
                ${s.img ? `
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="${s.img}" alt="${s.nama || ''}">
                ` : `
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-8xl text-slate-400">school</span>
                    </div>
                `}

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <span class="absolute top-3 left-3 ${statusLabel} text-[9px] font-bold px-2 py-1 rounded uppercase tracking-widest shadow">
                        ${s.jenis} ${s.status}
                    </span>
                    <span class="${badgeCls} text-white text-[10px] font-bold px-2 py-1 rounded-full absolute bottom-3 right-3 flex items-center gap-1 shadow">
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span> ${s.akreditasi}
                    </span>
                </div>
                <div class="p-3">
                    <h3 class="font-headline font-bold text-sm group-hover:text-primary transition-colors mb-1 leading-snug">${s.nama}</h3>
                    <div class="flex items-center gap-1 text-muted-foreground mb-3">
                        <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                        <span class="text-[12px] truncate">${s.alamat}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-dashed border-border">
                        <div class="flex items-center gap-3 text-[11px] text-muted-foreground">
                            <span><span class="font-bold text-primary">${s.siswa.toLocaleString()}</span> siswa</span>
                            <span class="w-px h-3 bg-border"></span>
                            <span><span class="font-bold text-foreground">${s.guru}</span> guru</span>
                        </div>
                        <button class="text-primary hover:opacity-80 text-[10px] font-bold flex items-center gap-1 group/btn">
                            LIHAT <span class="material-symbols-outlined text-[13px] group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
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
                const matchSearch = s.nama.toLowerCase().includes(currentSearch.toLowerCase()) ||
                    s.alamat.toLowerCase().includes(currentSearch.toLowerCase());
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
        document.getElementById('btn-locate').addEventListener('click', () => {
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
        map.on('locationerror', () => alert('Lokasi tidak dapat ditemukan.'));

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