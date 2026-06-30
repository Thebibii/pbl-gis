<!-- Perubahan: Tambahkan m-4, rounded-2xl, h-[calc(100vh-2rem)], dan hapus border-r -->
<aside class="w-72 bg-white flex flex-col z-50 sticky top-4 m-4 rounded-2xl shadow-sm border border-border">
    <!-- Brand Section -->
    <div class="p-6 mb-2">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-white text-2xl" style="font-variation-settings: 'FILL' 1;">map</span>
            </div>
            <div>
                <h1 class="text-lg font-bold tracking-tight leading-none text-foreground">SiGIS <span class="text-primary">Sekolah</span></h1>
                <p class="text-[10px] text-muted-foreground font-medium uppercase tracking-wider mt-1">Sistem Informasi Geografis</p>
            </div>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        <div class="px-3 py-3 text-[11px] font-semibold uppercase tracking-widest text-muted-foreground/60">Menu Utama</div>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.dashboard') ?> transition-all group" href="<?= url_to('operator.dashboard') ?>">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">dashboard</span>
            Dashboard
        </a>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.sekolah') ?> transition-all group" href="<?= url_to('operator.sekolah') ?>">
            <span class="material-symbols-outlined text-xl">school</span>
            Profil Sekolah
        </a>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.statistik') ?> transition-all group" href="<?= url_to('operator.statistik') ?>">
            <span class="material-symbols-outlined text-xl">bar_chart</span>
            Statistik Sekolah
        </a>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-muted-foreground hover:bg-secondary hover:text-foreground <?= isActiveSidebarRoute('operator.fasilitas') ?>  transition-all group" href="<?= url_to('operator.fasilitas') ?>">
            <span class="material-symbols-outlined text-xl">business_center</span>
            Fasilitas Sekolah
        </a>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.prestasi') ?> transition-all group" href="<?= url_to('operator.prestasi') ?>">
            <span class="material-symbols-outlined text-xl">emoji_events</span>
            Prestasi Sekolah
        </a>
        <div class="px-3 py-5 text-[11px] font-semibold uppercase tracking-widest text-muted-foreground/60">Sistem</div>
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.pengaturan') ?> transition-all group" href="<?= url_to('operator.pengaturan') ?>">
            <span class="material-symbols-outlined text-xl">manage_accounts</span>
            Pengaturan
        </a>
    </nav>
    <!-- Bottom CTA -->
    <div class="p-6 border-t border-border mt-auto flex items-center w-full">

        <a href="<?= url_to('logout') ?>" class="bg-red-500 w-full text-white px-5 py-2 rounded-xl font-bold hover:opacity-90 transition-all flex items-center justify-center gap-2 shadow-lg shadow-red-500/20">
            <span class="text-xs uppercase tracking-wider">Keluar</span>
        </a>
        <!-- <p class="text-xs font-medium text-muted-foreground">Butuh bantuan teknis?</p> -->
    </div>
</aside>