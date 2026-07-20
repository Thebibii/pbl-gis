<?= $this->extend('layouts/operator-sekolah') ?>
<?= $this->section('content') ?>

<section class="flex-1 p-6 pt-12 md:p-8 md:pt-12 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">
                    <span class="hover:text-primary cursor-pointer">Operator</span><span>/</span>
                    <span class="text-primary">Profil Sekolah</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Manajemen Profil Sekolah</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Perbarui informasi, lokasi, dan detail akademik sekolah Anda.
                </p>
            </div>
            <div class="flex gap-3">
                <button
                    type="submit"
                    form="form-sekolah" class="px-6 py-2 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:scale-105 transition-transform flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    SIMPAN
                </button>
            </div>
        </header>

        <form id="form-sekolah" action="<?= route_to('operator.sekolah.update') ?>" method="post" class="space-y-6" enctype="multipart/form-data">
            <?= csrf_field() ?>

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

                        <!-- Nama Sekolah -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                Nama Sekolah
                            </label>

                            <input
                                type="text"
                                name="nama_sekolah"
                                readonly
                                value="<?= esc(old('nama_sekolah', $sekolah['nama_sekolah'])) ?>"
                                class="w-full bg-slate-50 border border-border rounded-xl px-4 py-2.5 text-sm font-medium text-slate-500 cursor-not-allowed focus:ring-0 outline-none">
                        </div>

                        <!-- NPSN -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                NPSN
                            </label>

                            <input
                                type="text"
                                name="npsn"
                                readonly
                                value="<?= esc(old('npsn', $sekolah['npsn'])) ?>"
                                class="w-full bg-slate-50 border border-border rounded-xl px-4 py-2.5 text-sm font-medium text-slate-500 cursor-not-allowed focus:ring-0 outline-none">
                        </div>

                        <!-- Jenjang -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                Jenjang
                            </label>

                            <input
                                type="text"
                                readonly
                                value="<?= esc($sekolah['jenjang']) ?>"
                                class="w-full bg-slate-50 border border-border rounded-xl px-4 py-2.5 text-sm font-medium text-slate-500 cursor-not-allowed focus:ring-0 outline-none">
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
                                Staf & Kepemimpinan
                            </h3>
                        </div>

                        <div class="p-6">

                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                    Nama Kepala Sekolah <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="nama_kepsek"
                                    value="<?= old('nama_kepsek', $sekolah['nama_kepsek']) ?>"
                                    placeholder="Masukkan nama lengkap kepala sekolah"
                                    required
                                    class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all">

                                <?php if (session('validation') && session('validation')->hasError('nama_kepsek')) : ?>
                                    <p class="text-sm text-red-500 mt-1">
                                        <?= session('validation')->getError('nama_kepsek') ?>
                                    </p>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                    <!-- Data Akademik -->
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                        <div class="p-6 border-b border-border">
                            <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">menu_book</span>
                                Data Akademik
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">

                                <!-- Akreditasi -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Status Akreditasi <span class="text-red-500">*</span>
                                    </label>

                                    <select
                                        name="akreditasi"
                                        required
                                        class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all">

                                        <option value="">-- Pilih Akreditasi --</option>
                                        <option value="A" <?= old('akreditasi', $sekolah['akreditasi']) == 'A' ? 'selected' : '' ?>>A</option>
                                        <option value="B" <?= old('akreditasi', $sekolah['akreditasi']) == 'B' ? 'selected' : '' ?>>B</option>
                                        <option value="C" <?= old('akreditasi', $sekolah['akreditasi']) == 'C' ? 'selected' : '' ?>>C</option>
                                        <option value="Belum Terakreditasi" <?= old('akreditasi', $sekolah['akreditasi']) == 'Belum Terakreditasi' ? 'selected' : '' ?>>Belum Terakreditasi</option>

                                    </select>

                                    <?php if (session('validation') && session('validation')->hasError('akreditasi')) : ?>
                                        <p class="text-sm text-red-500">
                                            <?= session('validation')->getError('akreditasi') ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <!-- Kurikulum -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Kurikulum <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="kurikulum"
                                        value="<?= old('kurikulum', $sekolah['kurikulum']) ?>"
                                        placeholder="Contoh: Kurikulum Merdeka"
                                        required
                                        class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all">

                                    <?php if (session('validation') && session('validation')->hasError('kurikulum')) : ?>
                                        <p class="text-sm text-red-500">
                                            <?= session('validation')->getError('kurikulum') ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Contact Digital -->

                </div>

                <!-- Academic & Physical Section -->
                <div class="space-y-6">
                    <!-- Kontak Digital -->
                    <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                        <div class="p-6 border-b border-border">
                            <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">contact_mail</span>
                                Kontak Digital
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">

                                <!-- Telepon -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Telepon
                                    </label>

                                    <input
                                        type="tel"
                                        name="telepon"
                                        value="<?= old('telepon', $sekolah['telepon']) ?>"
                                        placeholder="Contoh: 0751-123456"
                                        class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all">

                                    <?php if (session('validation') && session('validation')->hasError('telepon')) : ?>
                                        <p class="text-sm text-red-500">
                                            <?= session('validation')->getError('telepon') ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Email
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        value="<?= old('email', $sekolah['email']) ?>"
                                        placeholder="sekolah@email.com"
                                        class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all">

                                    <?php if (session('validation') && session('validation')->hasError('email')) : ?>
                                        <p class="text-sm text-red-500">
                                            <?= session('validation')->getError('email') ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <!-- Website -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Website
                                    </label>

                                    <input
                                        type="url"
                                        name="website"
                                        value="<?= old('website', $sekolah['website']) ?>"
                                        placeholder="https://www.sekolah.sch.id"
                                        class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all">

                                    <?php if (session('validation') && session('validation')->hasError('website')) : ?>
                                        <p class="text-sm text-red-500">
                                            <?= session('validation')->getError('website') ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Physical Data -->
                    <!--  <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
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
                                    <input class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 pr-12 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all" placeholder="10000" required type="number" value="12000"/>
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-muted-foreground text-sm font-medium">m²</span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <section class="bg-white/80 backdrop-blur-md border border-white/30 p-4.5 md:p-8 rounded-2xl md:rounded-4xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="profile">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-xl font-bold">Profil Sekolah</h2>
                </div>

                <div class="grid grid-cols-1 gap-6">

                    <!-- Visi -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">
                            VISI
                        </label>

                        <textarea
                            name="visi"
                            rows="4"
                            class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium
                focus:ring-2 focus:ring-primary/50 focus:bg-white
                focus:border-primary outline-none transition-all"
                            placeholder="Masukkan visi sekolah"><?= old('visi', esc($sekolah['visi'])) ?></textarea>

                        <?php if (session('errors.visi')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium">
                                <?= session('errors.visi') ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Misi -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-muted-foreground mb-2">
                            MISI
                        </label>

                        <textarea
                            name="misi"
                            rows="7"
                            class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium
                focus:ring-2 focus:ring-primary/50 focus:bg-white
                focus:border-primary outline-none transition-all"
                            placeholder="Masukkan misi sekolah"><?= old('misi', esc($sekolah['misi'])) ?></textarea>

                        <?php if (session('errors.misi')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium">
                                <?= session('errors.misi') ?>
                            </p>
                        <?php endif; ?>
                    </div>

                </div>
            </section>

            <!-- Location Section -->
            <div id="lokasi" class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">
                <div class="p-6 border-b border-border">
                    <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        Pemetaan Lokasi
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-8">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>

                                <textarea
                                    id="alamat"
                                    name="alamat"
                                    rows="4"
                                    required
                                    placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..."
                                    class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all resize-none"><?= old('alamat', $sekolah['alamat']) ?></textarea>

                                <?php if (session('validation') && session('validation')->hasError('alamat')) : ?>
                                    <p class="text-sm text-red-500">
                                        <?= session('validation')->getError('alamat') ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class="grid grid-cols-2 gap-4">

                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Latitude <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        id="lat-input"
                                        name="latitude"
                                        type="number"
                                        step="any"
                                        value="<?= old('latitude', $sekolah['latitude']) ?>"
                                        class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-wider text-muted-foreground">
                                        Longitude <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        id="lng-input"
                                        name="longitude"
                                        type="number"
                                        step="any"
                                        value="<?= old('longitude', $sekolah['longitude']) ?>"
                                        class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm font-medium text-foreground focus:ring-2 focus:ring-primary/50 focus:bg-white outline-none transition-all">
                                </div>
                            </div>
                            <input
                                type="hidden"
                                id="kecamatan_id"
                                name="kecamatan_id"
                                value="<?= old('kecamatan_id', $sekolah['kecamatan_id']) ?>">
                        </div>
                        <div class="space-y-3 h-full min-h-[240px] flex flex-col">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">PENENTUAN LOKASI (MAP)</label>
                            <div class="relative w-full aspect-square sm:aspect-video md:aspect-16/7 bg-slate-100 rounded-4xl border border-slate-200 overflow-hidden flex items-center justify-center group cursor-pointer">
                                <!-- Stylized Map Background (Grid Pattern) -->
                                <div class="absolute inset-0 z-0">
                                    <div id="map" class="w-full h-full"></div>
                                </div>
                                <!-- Map Overlay Info -->
                                <div
                                    class="absolute bottom-4 left-1/2 -translate-x-1/2 z-[999] cursor-pointer"
                                    id="btn-pinpoint">

                                    <p
                                        id="btn-pinpoint-label"
                                        class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm border border-white/50 text-[10px] font-bold text-slate-600 flex items-center gap-2 transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary whitespace-nowrap">

                                        <span class="material-symbols-outlined text-sm">
                                            ads_click
                                        </span>

                                        KLIK UNTUK PIN POINT

                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Visual -->
            <div id="foto" class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] overflow-hidden">

                <div class="p-6 border-b border-border">
                    <h3 class="text-lg font-bold text-foreground flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">image</span>
                        Media Visual
                        <?php if (empty($sekolah['foto_utama'])): ?><span class="text-red-500 text-sm font-normal">*</span><?php endif; ?>
                    </h3>
                </div>

                <div class="p-6">

                    <label
                        for="foto_utama"
                        class="group block cursor-pointer">

                        <div
                            class="overflow-hidden rounded-2xl border-2 border-dashed border-border bg-slate-50 hover:bg-slate-100 transition">

                            <!-- Preview -->
                            <div class="aspect-video bg-slate-100 flex items-center justify-center overflow-hidden">

                                <?php if (!empty($sekolah['foto_utama'])) : ?>

                                    <img
                                        id="preview-image"
                                        src="<?= base_url('uploads/sekolah/' . $sekolah['foto_utama']) ?>"
                                        alt="<?= esc($sekolah['nama_sekolah']) ?>"
                                        class="w-full h-full object-cover">

                                <?php else : ?>

                                    <img
                                        id="preview-image"
                                        src=""
                                        class="hidden w-full h-full object-cover">

                                    <div
                                        id="empty-preview"
                                        class="text-center">

                                        <span class="material-symbols-outlined text-6xl text-slate-400">
                                            add_photo_alternate
                                        </span>

                                        <p class="mt-3 text-sm text-muted-foreground">
                                            Belum ada foto sekolah
                                        </p>

                                    </div>

                                <?php endif; ?>

                            </div>

                            <!-- Footer -->
                            <div class="p-5 bg-white border-t border-border">

                                <div class="flex items-center justify-between">

                                    <div>

                                        <h4 class="font-bold text-foreground">
                                            Klik untuk memilih gambar
                                        </h4>

                                        <p class="text-sm text-muted-foreground">
                                            PNG, JPG, JPEG, WEBP • Maksimal 2 MB
                                        </p>

                                        <p
                                            id="file-name"
                                            class="mt-2 text-xs text-primary font-medium">
                                            Belum ada file dipilih
                                        </p>

                                    </div>

                                    <span
                                        class="material-symbols-outlined text-4xl text-primary group-hover:scale-110 transition">
                                        upload
                                    </span>

                                </div>

                            </div>

                        </div>

                        <input
                            id="foto_utama"
                            name="foto_utama"
                            type="file"
                            accept="image/png,image/jpeg,image/jpg,image/webp"
                            class="hidden">

                    </label>

                    <?php if (session('validation') && session('validation')->hasError('foto_utama')) : ?>

                        <p class="text-red-500 text-sm mt-3">
                            <?= session('validation')->getError('foto_utama') ?>
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </form>

    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const kecamatanGeojson = <?= json_encode($kecamatan_geojson) ?>;

        const latInput = document.getElementById('lat-input');
        const lngInput = document.getElementById('lng-input');
        const kecamatanInput = document.getElementById('kecamatan_id');

        const btnPin = document.getElementById('btn-pinpoint');
        const btnPinLabel = document.getElementById('btn-pinpoint-label');

        const map = L.map('map', {
            zoomControl: false,
            preferCanvas: true,
            minZoom: 10,
            maxZoom: 18
        });

        L.tileLayer(
            'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);

        window.addEventListener('load', () => map.invalidateSize());

        let marker = null;
        let pinMode = false;
        let activeLayer = null;

        const polygonLayers = [];

        const pinIcon = L.divIcon({
            className: 'custom-pin',

            html: `
        <div class="relative flex flex-col items-center">

            <span
                class="material-symbols-outlined text-red-500"
                style="
                    font-size:42px;
                    font-variation-settings:'FILL' 1;
                    line-height:1;
                    filter:drop-shadow(0 3px 6px rgba(0,0,0,.35));
                ">
                location_on
            </span>

            <div
                class="absolute rounded-full"
                style="
                    width:14px;
                    height:14px;
                    bottom:-2px;
                    background:rgba(0,0,0,.18);
                    filter:blur(3px);
                ">
            </div>

        </div>
    `,

            iconSize: [42, 42],
            iconAnchor: [21, 42]
        });
        // ==========================
        // UPDATE BUTTON PIN
        // ==========================

        function updatePinButton() {

            if (pinMode) {

                btnPinLabel.className =
                    "bg-primary backdrop-blur-sm px-4 py-2 rounded-full shadow-lg shadow-primary/30 border border-primary text-[10px] font-bold text-white flex items-center gap-2 transition-all duration-300 scale-105";

                btnPinLabel.innerHTML = `
            <span class="material-symbols-outlined text-sm animate-pulse">
                location_on
            </span>
            MODE PIN AKTIF
        `;

            } else {

                btnPinLabel.className =
                    "bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm border border-white/50 text-[10px] font-bold text-slate-600 flex items-center gap-2 transition-all duration-300 hover:bg-primary hover:text-white hover:border-primary whitespace-nowrap";

                btnPinLabel.innerHTML = `
            <span class="material-symbols-outlined text-sm">
                ads_click
            </span>
            KLIK UNTUK PIN POINT
        `;

            }

        }

        // ==========================
        // GAMBAR POLYGON
        // ==========================

        kecamatanGeojson.forEach(kec => {

            const layer = L.geoJSON(kec.geojson, {

                style: {
                    color: kec.warna,
                    fillColor: kec.warna,
                    fillOpacity: 0.12,
                    weight: 2
                }

            }).addTo(map);

            layer.eachLayer(poly => {

                poly.kecamatan_id = kec.id;

                poly.defaultStyle = {
                    color: kec.warna,
                    fillColor: kec.warna,
                    fillOpacity: 0.12,
                    weight: 2
                };

                polygonLayers.push(poly);

            });

        });

        map.fitBounds(
            L.featureGroup(polygonLayers).getBounds()
        );

        // ==========================
        // POINT IN POLYGON
        // ==========================

        function pointInPolygon(point, geometry) {

            const rings =
                geometry.type === 'Polygon' ?
                geometry.coordinates :
                geometry.type === 'MultiPolygon' ?
                geometry.coordinates.flat(1) : [];

            let inside = false;

            const [px, py] = point;

            for (const ring of rings) {

                for (let i = 0, j = ring.length - 1; i < ring.length; j = i++) {

                    const [xi, yi] = ring[i];
                    const [xj, yj] = ring[j];

                    const intersect =
                        ((yi > py) !== (yj > py)) &&
                        (px < ((xj - xi) * (py - yi)) / (yj - yi) + xi);

                    if (intersect) {
                        inside = !inside;
                    }

                }

            }

            return inside;

        }

        // ==========================
        // DETEKSI KECAMATAN
        // ==========================

        function detectKecamatan(lat, lng) {

            const point = [lng, lat];

            let ditemukan = false;

            polygonLayers.forEach(poly => {

                if (ditemukan) return;

                const geo = poly.toGeoJSON().geometry;

                if (pointInPolygon(point, geo)) {

                    ditemukan = true;

                    kecamatanInput.value = poly.kecamatan_id;

                    if (activeLayer) {
                        activeLayer.setStyle(activeLayer.defaultStyle);
                    }

                    poly.setStyle({
                        weight: 4,
                        fillOpacity: 0.35
                    });

                    activeLayer = poly;

                }

            });

            if (!ditemukan) {

                kecamatanInput.value = "";

                if (activeLayer) {

                    activeLayer.setStyle(activeLayer.defaultStyle);
                    activeLayer = null;

                }

            }

            return ditemukan;

        }

        // ==========================
        // TOGGLE PIN MODE
        // ==========================

        btnPin.addEventListener('click', () => {

            pinMode = !pinMode;

            map.getContainer().style.cursor =
                pinMode ? 'crosshair' : '';

            updatePinButton();

        });

        updatePinButton();
        // ==========================
        // KLIK PADA MAP
        // ==========================

        map.on('click', function(e) {

            if (!pinMode) return;

            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            // Cek apakah titik berada di dalam polygon
            const ditemukan = detectKecamatan(lat, lng);

            if (!ditemukan) {

                // Reset input
                latInput.value = "";
                lngInput.value = "";
                kecamatanInput.value = "";

                // Hapus marker jika ada
                if (marker) {
                    map.removeLayer(marker);
                    marker = null;
                }

                // Popup peringatan
                L.popup({
                        closeButton: false,
                        autoClose: true,
                        closeOnClick: true,
                        className: 'popup-warning'
                    })
                    .setLatLng(e.latlng)
                    .setContent(`
        <div style="text-align:center;min-width:180px;padding:12px;">
            <b style="color:#dc2626;">⚠ Lokasi di luar wilayah</b><br>
            <small>Silakan pilih lokasi di dalam batas kecamatan.</small>
        </div>
    `)
                    .openOn(map);

                return;
            }

            // Simpan koordinat
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);

            // Marker
            if (marker) {

                marker.setLatLng(e.latlng);

            } else {

                marker = L.marker(e.latlng, {
                    icon: pinIcon
                }).addTo(map);

            }

            // Keluar dari mode pin
            pinMode = false;
            map.getContainer().style.cursor = '';
            updatePinButton();

        });

        // ==========================
        // LOAD DATA LAMA
        // ==========================

        if (latInput.value && lngInput.value) {

            const lat = parseFloat(latInput.value);
            const lng = parseFloat(lngInput.value);

            const ditemukan = detectKecamatan(lat, lng);

            if (ditemukan) {

                marker = L.marker([lat, lng], {
                    icon: pinIcon
                }).addTo(map);
                map.setView([lat, lng], 15);

            } else {

                latInput.value = "";
                lngInput.value = "";
                kecamatanInput.value = "";

            }

        }

    });
</script>

<script>
    const input = document.getElementById('foto_utama');
    const preview = document.getElementById('preview-image');
    const emptyPreview = document.getElementById('empty-preview');
    const fileName = document.getElementById('file-name');

    input.addEventListener('change', function() {

        const file = this.files[0];

        if (!file) return;

        fileName.textContent = file.name;

        const reader = new FileReader();

        reader.onload = function(e) {

            preview.src = e.target.result;

            preview.classList.remove('hidden');

            if (emptyPreview) {
                emptyPreview.classList.add('hidden');
            }

        };

        reader.readAsDataURL(file);

    });

    // Simple Micro-interactions
    document.querySelectorAll('a, button').forEach(el => {
        el.addEventListener('click', function(e) {
            if (this.getAttribute('href') === '#') e.preventDefault();
        });
    });
</script>
<?= $this->endSection() ?>