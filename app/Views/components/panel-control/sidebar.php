<?php
$user = auth()->user();

$isSuperAdmin = $user->inGroup('superadmin');
$isOperator   = $user->inGroup('operator_sekolah');
?>

<!-- Overlay untuk mobile, tampil saat sidebar terbuka -->
<div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/40 z-40 lg:hidden"></div>

<aside
    id="sidebar"
    class="w-72 bg-white flex flex-col z-50 fixed lg:sticky top-0 lg:top-4 left-0 h-screen lg:h-[calc(100vh-2rem)] rounded-none lg:rounded-2xl shadow-sm border border-border -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

    <!-- Brand -->
    <div class="p-6">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-white text-2xl"
                    style="font-variation-settings:'FILL' 1;">map</span>
            </div>

            <div>
                <h1 class="text-lg font-bold">
                    GIS <span class="text-primary">Sekolah</span>
                </h1>

                <p class="text-[10px] uppercase tracking-wider text-muted-foreground">
                    Sistem Informasi Geografis
                </p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">

        <div class="px-3 py-3 text-[11px] font-semibold uppercase tracking-widest text-muted-foreground/60">
            Menu Utama
        </div>

        <?php if ($isSuperAdmin): ?>

            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('admin.dashboard') ?>"
                href="<?= url_to('admin.dashboard') ?>">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>

            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('admin.sekolah') ?>"
                href="<?= url_to('admin.sekolah') ?>">
                <span class="material-symbols-outlined">database</span>
                Data Sekolah
            </a>
            <?php /*
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('admin.jenis_fasilitas') ?>"
                href="<?= url_to('admin.jenis_fasilitas') ?>">
                <span class="material-symbols-outlined">meeting_room</span>
                Jenis Fasilitas
            </a>
             */ ?>

            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('admin.user') ?>"
                href="<?= url_to('admin.user') ?>">
                <span class="material-symbols-outlined">group</span>
                Manajemen Pengguna
            </a>

            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('admin.wilayah') ?>"
                href="<?= url_to('admin.wilayah') ?>">
                <span class="material-symbols-outlined">map</span>
                Wilayah
            </a>

        <?php endif; ?>


        <?php if ($isOperator): ?>

            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.dashboard') ?>"
                href="<?= url_to('operator.dashboard') ?>">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>

            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.sekolah') ?>"
                href="<?= url_to('operator.sekolah') ?>">
                <span class="material-symbols-outlined">school</span>
                Profil Sekolah
            </a>
            <?php /*
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.statistik') ?>"
                href="<?= url_to('operator.statistik') ?>">
                <span class="material-symbols-outlined">bar_chart</span>
                Statistik Sekolah
            </a>

            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.fasilitas') ?>"
                href="<?= url_to('operator.fasilitas') ?>">
                <span class="material-symbols-outlined">business_center</span>
                Fasilitas Sekolah
            </a>

            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('operator.prestasi') ?>"
                href="<?= url_to('operator.prestasi') ?>">
                <span class="material-symbols-outlined">emoji_events</span>
                Prestasi Sekolah
            </a>
            */ ?>

        <?php endif; ?>


        <div class="px-3 py-5 text-[11px] font-semibold uppercase tracking-widest text-muted-foreground/60">
            Sistem
        </div>

        <?php if ($isSuperAdmin): ?>
            <?php /*
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm">
                <span class="material-symbols-outlined">history_edu</span>
                Log Aktivitas
            </a>
            */ ?>

        <?php endif; ?>

        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm <?= isActiveSidebarRoute('account.settings') ?>"
            href="<?= url_to('account.settings') ?>">
            <span class="material-symbols-outlined">settings</span>
            Pengaturan Akun
        </a>

    </nav>

    <div class="p-6 border-t border-border">
        <a href="<?= url_to('logout') ?>"
            class="bg-red-500 w-full text-white px-5 py-2 rounded-xl text-sm font-bold flex justify-center">
            Keluar
        </a>
    </div>

</aside>