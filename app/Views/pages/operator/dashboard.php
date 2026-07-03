<?= $this->extend('layouts/operator-sekolah') ?>
<?= $this->section('content') ?>

<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">
                    <span class="text-primary">Dashboard</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Dashboard Operator</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Selamat datang, <span class="font-bold text-primary"><?= esc($user->username ?? 'Operator') ?></span>!
                    Kelola data sekolah Anda dengan mudah.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-bold text-foreground"><?= date('l, d F Y') ?></p>
                    <p class="text-xs text-muted-foreground"><?= date('H:i:s') ?> WIB</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-3xl">account_circle</span>
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- Stat Card 1 - Kelengkapan Profil -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">fact_check</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold tracking-tight"><?= (int) ($stats['kelengkapan_persen'] ?? 0) ?>%</p>
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Kelengkapan Profil</p>
                </div>
            </div>

            <!-- Stat Card 2 - Status Akreditasi -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold tracking-tight"><?= esc($stats['akreditasi'] ?? 'Belum Terakreditasi') ?></p>
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Akreditasi</p>
                </div>
            </div>

            <!-- Stat Card 3 - Titik Lokasi Peta -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold tracking-tight"><?= !empty($stats['punya_lokasi']) ? 'Sudah' : 'Belum' ?></p>
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Titik Lokasi Peta</p>
                </div>
            </div>

            <!-- Stat Card 4 - Jenjang & Status -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">school</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold tracking-tight"><?= esc($stats['jenjang'] ?? '-') ?> &middot; <?= esc($stats['status'] ?? '-') ?></p>
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Jenjang &amp; Status</p>
                </div>
            </div>
        </div>

        <!-- Two Columns Layout -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            <!-- Left Column (Alerts) -->
            <div class="xl:col-span-2 flex flex-col gap-8">

                <!-- Alerts Section -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-lg font-bold text-foreground">Perlu Perhatian</h3>

                    <?php if (!empty($alerts)): ?>
                        <?php foreach ($alerts as $alert): ?>
                            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-5 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] border-l-4 border-l-amber-500 flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-xl"><?= esc($alert['icon']) ?></span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-foreground"><?= esc($alert['title']) ?></h4>
                                    <p class="text-xs text-muted-foreground font-medium mt-1"><?= esc($alert['desc']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-5 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] border-l-4 border-l-green-500 flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-xl">check_circle</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-foreground">Semua Data Lengkap</h4>
                                <p class="text-xs text-muted-foreground font-medium mt-1">Profil sekolah Anda sudah lengkap, tidak ada yang perlu ditindaklanjuti</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column (Actions & Activity) -->
            <div class="flex flex-col gap-8">

                <!-- Quick Actions -->
                <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-8 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] flex flex-col gap-6">
                    <h3 class="text-lg font-bold text-foreground">Aksi Cepat</h3>
                    <div class="flex flex-col gap-3">
                        <a href="<?= base_url('operator/sekolah') ?>" class="w-full py-3 px-4 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-transform flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">edit</span>
                            Lengkapi Profil
                        </a>
                        <a href="<?= base_url('operator/sekolah#lokasi') ?>" class="w-full py-3 px-4 bg-slate-50 text-primary border border-border rounded-xl text-sm font-bold hover:bg-slate-100 transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">location_on</span>
                            Update Lokasi Peta
                        </a>
                        <a href="<?= base_url('operator/sekolah#foto') ?>" class="w-full py-3 px-4 bg-slate-50 text-primary border border-border rounded-xl text-sm font-bold hover:bg-slate-100 transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">add_a_photo</span>
                            Unggah Foto Sekolah
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.querySelectorAll('a, button').forEach(el => {
        el.addEventListener('click', function(e) {
            if (this.getAttribute('href') === '#') e.preventDefault();
        });
    });
</script>
<?= $this->endSection() ?>