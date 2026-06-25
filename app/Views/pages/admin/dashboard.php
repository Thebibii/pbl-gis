<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <!-- Hero Welcome Section -->
    <div class="relative rounded-2xl overflow-hidden bg-slate-900 p-10 flex flex-col justify-center min-h-[200px] shadow-lg shadow-slate-900/10">
        <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at 0% 0%, #3B82F6 0%, transparent 50%), radial-gradient(circle at 100% 100%, #6366F1 0%, transparent 50%);"></div>
        <div class="relative z-10 space-y-3">
            <h2 class="text-2xl font-bold text-white tracking-tight">Selamat Datang, Admin!</h2>
            <p class="text-slate-400 max-w-lg text-sm leading-relaxed">Panel kendali SiGIS Sekolah siap membantu Anda memantau distribusi pendidikan nasional secara real-time dan akurat.</p>
            <!-- <div class="flex gap-3 pt-3">
                <button class="bg-primary text-white px-5 py-2 rounded-lg text-xs font-bold hover:opacity-90 transition-opacity">Update Data Peta</button>
                <button class="bg-white/10 text-white border border-white/20 px-5 py-2 rounded-lg text-xs font-bold hover:bg-white/20 transition-all">Lihat Laporan Akhir</button>
            </div> -->
        </div>
        <div class="absolute right-10 top-1/2 -translate-y-1/2 opacity-10 pointer-events-none">
            <span class="material-symbols-outlined text-[160px] text-white">public</span>
        </div>
    </div>

    <!-- Key Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Sekolah -->
        <div class="bg-white/80 backdrop-blur-md border border-white/30 p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">school</span>
                </div>
            </div>
            <div>
                <p class="text-2xl font-extrabold tracking-tight"><?= number_format($stats['total_sekolah']) ?></p>
                <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Total Sekolah</p>
            </div>
        </div>
        <!-- Total Siswa -->
        <div class="bg-white/80 backdrop-blur-md border border-white/30 p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">groups</span>
                </div>
            </div>
            <div>
                <p class="text-2xl font-extrabold tracking-tight"><?= number_format($stats['total_siswa']) ?></p>
                <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Total Siswa</p>
            </div>
        </div>
        <!-- Terakreditasi A -->
        <div class="bg-white/80 backdrop-blur-md border border-white/30 p-6 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                </div>
                <span class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg">Stabil</span>
            </div>
            <div>
                <p class="text-2xl font-extrabold tracking-tight"><?= number_format($stats['persen_akreditasi_a'], 1) ?>%</p>
                <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Terakreditasi A</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid: Map and Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Map -->
        <div class="lg:col-span-2 bg-white/80 backdrop-blur-md border border-white/30 rounded-[2rem] overflow-hidden shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold">Peta Persebaran Sekolah</h3>
                    <p class="text-xs text-muted-foreground font-medium">Visualisasi lokasi sekolah pada tiga kecamatan</p>
                </div>
                <div class="flex bg-slate-100 rounded-lg p-1">
                    <button id="btn-tab-kabupaten" class="px-4 py-1.5 rounded-md text-xs font-bold bg-white shadow-sm">
                        Kab. Tanah Datar
                    </button>
                    <button id="btn-tab-kecamatan" class="px-4 py-1.5 rounded-md text-xs font-bold text-muted-foreground">
                        Kecamatan
                    </button>
                </div>
            </div>
            <div class="relative h-[380px] w-full bg-slate-200">
                <div class="absolute inset-0 z-0">
                    <div id="map" class="w-full h-full"></div>
                </div>
                <div class="absolute bottom-6 right-6 flex flex-col gap-2 z-50">
                    <div class="flex flex-col glass-effect rounded-2xl shadow-2xl overflow-hidden">
                        <button data-map-action="zoom-in" class="w-10 h-10 flex items-center justify-center text-primary hover:bg-accent transition-colors border-b border-border/50">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                        <button data-map-action="zoom-out" class="w-10 h-10 flex items-center justify-center text-primary hover:bg-accent transition-colors">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                    </div>
                    <button id="btn-layers" class="w-10 h-10 glass-effect rounded-2xl shadow-2xl flex items-center justify-center text-primary hover:bg-accent transition-colors">
                        <span class="material-symbols-outlined">layers</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sebaran Akreditasi -->
        <?php
        $akreditasi_map = [
            'A'                   => ['label' => 'Akreditasi A',          'color' => 'bg-primary',     'dot' => 'bg-primary'],
            'B'                   => ['label' => 'Akreditasi B',          'color' => 'bg-primary/60',  'dot' => 'bg-primary/60'],
            'C'                   => ['label' => 'Akreditasi C',          'color' => 'bg-primary/40',  'dot' => 'bg-primary/40'],
            'Tidak Terakreditasi' => ['label' => 'Tidak Terakreditasi',   'color' => 'bg-slate-300',   'dot' => 'bg-slate-300'],
            'Belum'               => ['label' => 'Belum Terakreditasi',   'color' => 'bg-slate-200',   'dot' => 'bg-slate-200'],
        ];
        $total_ak = $stats['total_akreditasi'];
        ?>
        <div class="bg-white/80 backdrop-blur-md border h-fit border-white/30 rounded-[2rem] p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col ">
            <h3 class="text-lg font-bold">Sebaran Akreditasi</h3>
            <p class="text-xs text-muted-foreground font-medium mb-8">Proporsi berdasarkan kategori peringkat akreditasi</p>
            <div class="flex-1 flex flex-col justify-center gap-6">
                <div class="flex items-end gap-3 h-40">
                    <?php foreach ($stats['akreditasi'] as $row):
                        $persen = $total_ak > 0 ? ($row['jumlah'] / $total_ak * 100) : 0;
                        $cfg    = $akreditasi_map[$row['akreditasi']] ?? ['color' => 'bg-slate-200'];
                    ?>
                        <div class="flex-1 <?= $cfg['color'] ?> rounded-t-xl" style="height: <?= number_format($persen, 1) ?>%;"></div>
                    <?php endforeach; ?>
                </div>
                <div class="space-y-4">
                    <?php foreach ($stats['akreditasi'] as $row):
                        $persen = $total_ak > 0 ? ($row['jumlah'] / $total_ak * 100) : 0;
                        $cfg    = $akreditasi_map[$row['akreditasi']] ?? ['label' => $row['akreditasi'], 'dot' => 'bg-slate-200'];
                    ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full <?= $cfg['dot'] ?>"></span>
                                <span class="text-xs font-bold text-slate-700"><?= $cfg['label'] ?></span>
                            </div>
                            <span class="text-xs font-bold"><?= number_format($persen, 1) ?>%</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="h-8"></div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const map = L.map('map', {
            zoomControl: false,
            preferCanvas: true,
            minZoom: 10,
            maxZoom: 18
        }).setView([-0.4555, 100.5771], 12);

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

        // ── Data dari PHP ──────────────────────────────────────────────
        const sekolahData = <?= json_encode(array_map(fn($s) => [
                                'nama'           => $s['nama_sekolah'],
                                'jenis'          => $s['jenjang'],
                                'status'         => $s['status'],
                                'akreditasi'     => $s['akreditasi'],
                                'alamat'         => $s['alamat'],
                                'lat'            => (float) $s['latitude'],
                                'lng'            => (float) $s['longitude'],
                                'slug'           => $s['slug'],
                                'img'            => $s['foto_utama'] ? base_url('uploads/sekolah/' . $s['foto_utama']) : null,
                                'nama_kecamatan' => $s['nama_kecamatan'] ?? '',
                            ], $sekolah_list), JSON_UNESCAPED_UNICODE) ?>;

        const kecamatanList = <?= json_encode(array_map(fn($k) => [
                                    'id'             => $k['id'],
                                    'nama_kecamatan' => $k['nama_kecamatan'],
                                    'geojson_file'   => $k['geojson_file'],
                                    'warna'          => $k['warna'],
                                ], $kecamatan_list), JSON_UNESCAPED_UNICODE) ?>;

        // Data wilayah kabupaten — sudah diambil server-side, tanpa fetch
        const wilayahGeojson = <?= $wilayah_geojson
                                    ? json_encode($wilayah_geojson, JSON_UNESCAPED_UNICODE)
                                    : 'null' ?>;

        const kecamatanGeojsonData = <?= json_encode($kecamatan_geojson, JSON_UNESCAPED_UNICODE) ?>;

        // ── Hitung sekolah per kecamatan (matching by nama_kecamatan) ──
        const sekolahPerKecamatan = {};
        sekolahData.forEach(s => {
            const key = s.nama_kecamatan;
            if (key) sekolahPerKecamatan[key] = (sekolahPerKecamatan[key] ?? 0) + 1;
        });

        // ── Layer groups ───────────────────────────────────────────────
        let wilayahLayer = null; // Tab: Kab. Tanah Datar
        let kecamatanGroup = null; // Tab: Kecamatan
        let markerGroup = L.layerGroup().addTo(map);

        // ── Tab state ─────────────────────────────────────────────────
        let activeTab = 'kabupaten';
        let kecLoaded = false;

        const btnKab = document.getElementById('btn-tab-kabupaten');
        const btnKec = document.getElementById('btn-tab-kecamatan');

        // ── Popup builder ──────────────────────────────────────────────
        function buildPopup(s) {
            const statusBg = s.status === 'Negeri' ? 'bg-primary text-primary' : 'bg-secondary text-secondary-foreground';
            return `
        <div class="font-sans" style="font-family:'Plus Jakarta Sans',sans-serif; min-width:260px;">
            <div class="relative h-32 overflow-hidden">
                ${s.img ? `
                    <img class="w-full h-full object-cover" src="${s.img}" alt="${s.nama}">
                ` : `
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                        <span class="material-symbols-outlined text-8xl text-slate-400">school</span>
                    </div>
                `}
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute top-3 left-3">
                    <span class="text-white text-[9px] font-bold px-2 py-1 rounded uppercase tracking-widest shadow ${statusBg}">
                        ${s.jenis} ${s.status}
                    </span>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-[15px] mb-1 text-slate-800">${s.nama}</h3>
                <div class="flex items-center gap-1 mb-3">
                    <span class="material-symbols-outlined text-[14px] text-primary self-start">location_on</span>
                    <span class="text-[12px] text-slate-500">${s.alamat}</span>
                </div>
            </div>
        </div>`;
        }

        // ── Marker colors ──────────────────────────────────────────────
        const markerColor = {
            SD: '#EF4444',
            SMP: '#EAB308',
            SMA: '#3B82F6'
        };

        function buildMarkers() {
            markerGroup.clearLayers();
            sekolahData.forEach(s => {
                if (!s.lat || !s.lng) return;
                const color = markerColor[s.jenis] ?? '#64748b';
                const icon = L.divIcon({
                    className: '',
                    html: `<div style="width:10px;height:10px;border-radius:50%;background:${color};border:2px solid white;box-shadow:0 1px 4px rgba(0,0,0,.3)"></div>`,
                    iconSize: [10, 10],
                    iconAnchor: [5, 5],
                });
                L.marker([s.lat, s.lng], {
                        icon
                    })
                    .addTo(markerGroup)
                    .bindPopup(buildPopup(s), {
                        maxWidth: 280,
                        minWidth: 260
                    });
            });
        }
        buildMarkers();

        // ── Tab: Kabupaten ─────────────────────────────────────────────
        function loadKabupaten() {
            if (kecamatanGroup) {
                kecamatanGroup.remove();
            }

            if (wilayahLayer) {
                wilayahLayer.addTo(map);
                map.fitBounds(wilayahLayer.getBounds(), {
                    padding: [50, 50],
                    maxZoom: 14
                });
                return;
            }

            if (!wilayahGeojson) {
                console.error('Data GeoJSON kabupaten tidak tersedia dari server.');
                return;
            }

            wilayahLayer = L.geoJSON(wilayahGeojson, {
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
            map.once('moveend', () => map.setMinZoom(map.getZoom()));
        }

        // ── Tab: Kecamatan ─────────────────────────────────────────────
        function loadKecamatan() {
            if (wilayahLayer) wilayahLayer.remove();

            if (kecLoaded && kecamatanGroup) {
                kecamatanGroup.addTo(map);
                return;
            }

            kecamatanGroup = L.layerGroup();

            const tooltip = L.tooltip({
                sticky: true,
                opacity: 1,
                className: 'kec-tooltip'
            });

            kecamatanGeojsonData.forEach(kec => {
                const color = kec.warna ?? '#94a3b8';
                const jumlah = sekolahPerKecamatan[kec.nama_kecamatan] ?? 0;

                const layer = L.geoJSON(kec.geojson, {
                    style: {
                        color: color,
                        weight: 2,
                        opacity: 1,
                        fillColor: color,
                        fillOpacity: 0.15
                    },
                    onEachFeature(feature, lyr) {
                        lyr.on('mouseover', function(e) {
                            this.setStyle({
                                fillOpacity: 0.35,
                                weight: 3
                            });
                            this.bringToFront();
                            tooltip
                                .setContent(`
                        <div style="font-family:'Plus Jakarta Sans',sans-serif;padding:6px 10px;">
                            <div style="font-weight:700;font-size:13px;">${kec.nama_kecamatan}</div>
                            <div style="font-size:11px;color:#64748b;margin-top:2px;">
                                ${jumlah} sekolah
                            </div>
                        </div>`)
                                .setLatLng(e.latlng)
                                .addTo(map);
                        });
                        lyr.on('mousemove', function(e) {
                            tooltip.setLatLng(e.latlng);
                        });
                        lyr.on('mouseout', function() {
                            layer.resetStyle(this);
                            map.removeLayer(tooltip);
                        });
                        lyr.on('click', function() {
                            map.fitBounds(layer.getBounds(), {
                                padding: [40, 40],
                                maxZoom: 14
                            });
                        });
                    }
                });

                kecamatanGroup.addLayer(layer);
            });

            kecamatanGroup.addTo(map);
            kecLoaded = true;
        }

        // ── Init tab kabupaten ─────────────────────────────────────────
        loadKabupaten();

        // ── Tab button handlers ────────────────────────────────────────
        function setActiveTab(tab) {
            activeTab = tab;
            const isKab = tab === 'kabupaten';
            btnKab.classList.toggle('bg-white', isKab);
            btnKab.classList.toggle('shadow-sm', isKab);
            btnKab.classList.toggle('text-muted-foreground', !isKab);
            btnKec.classList.toggle('bg-white', !isKab);
            btnKec.classList.toggle('shadow-sm', !isKab);
            btnKec.classList.toggle('text-muted-foreground', isKab);
            if (isKab) loadKabupaten();
            else loadKecamatan();
        }

        btnKab.addEventListener('click', () => setActiveTab('kabupaten'));
        btnKec.addEventListener('click', () => setActiveTab('kecamatan'));

        // ── Map controls ───────────────────────────────────────────────
        document.querySelector('[data-map-action="zoom-in"]').addEventListener('click', () => map.zoomIn());
        document.querySelector('[data-map-action="zoom-out"]').addEventListener('click', () => map.zoomOut());
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
    });
</script>
<?= $this->endSection() ?>