<div class="fixed top-6 left-0 w-full z-[100] px-6 md:px-10">
    <nav class="max-w-7xl mx-auto glass-effect rounded-2xl shadow-lg shadow-primary/5">
        <div class="flex justify-between items-center h-16 px-6">
            <div class="flex items-center gap-8">
                <span class="text-xl font-headline font-extrabold tracking-tight text-primary">SiGIS<span class="text-foreground">Sekolah</span></span>
                <div class="hidden md:flex gap-8">
                    <a class="<?= isActiveRoute('home') ?> transition-colors text-xs uppercase tracking-wider" href="<?= url_to('home') ?>">Beranda</a>
                    <a class="<?= isActiveRoute('peta') ?> transition-colors text-xs uppercase tracking-wider" href="<?= url_to('peta') ?>">Peta</a>
                    <a class="<?= isActiveRoute('cari') ?> transition-colors text-xs uppercase tracking-wider" href="<?= url_to('cari') ?>">Cari Sekolah</a>
                    <!-- <a class="<?= isActiveRoute('bandingkan') ?> transition-colors text-xs uppercase tracking-wider" href="<?= url_to('bandingkan') ?>">Bandingkan</a> -->
                </div>
            </div>

            <div class="flex items-center gap-3">
                <?php if (auth()->loggedIn()): ?>
                    <a href="<?= url_to('admin.dashboard') ?>" class="hidden sm:flex bg-primary text-primary-foreground px-5 py-2 rounded-xl font-bold hover:opacity-90 transition-all items-center gap-2 shadow-lg shadow-primary/20">
                        <span class="text-xs uppercase tracking-wider">Dashboard</span>
                    </a>
                <?php else: ?>
                    <a href="<?= url_to('login') ?>" class="hidden sm:flex bg-primary text-primary-foreground px-5 py-2 rounded-xl font-bold hover:opacity-90 transition-all items-center gap-2 shadow-lg shadow-primary/20">
                        <span class="text-xs uppercase tracking-wider">Masuk</span>
                    </a>
                <?php endif; ?>

                <!-- Tombol hamburger, hanya tampil di bawah lg -->
                <button id="navbar-toggle" type="button" class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl hover:bg-black/5 transition-colors" aria-label="Toggle menu" aria-expanded="false">
                    <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="navbar-menu" class="hidden md:hidden flex flex-col gap-2 px-6 pb-4 pt-2 border-t border-black/5">
            <a class="<?= isActiveRoute('home') ?> transition-colors text-xs uppercase tracking-wider py-2" href="<?= url_to('home') ?>">Beranda</a>
            <a class="<?= isActiveRoute('peta') ?> transition-colors text-xs uppercase tracking-wider py-2" href="<?= url_to('peta') ?>">Peta</a>
            <a class="<?= isActiveRoute('cari') ?> transition-colors text-xs uppercase tracking-wider py-2" href="<?= url_to('cari') ?>">Cari Sekolah</a>
            <!-- <a class="<?= isActiveRoute('bandingkan') ?> transition-colors text-xs uppercase tracking-wider py-2" href="<?= url_to('bandingkan') ?>">Bandingkan</a> -->

            <?php if (auth()->loggedIn()): ?>
                <a href="<?= url_to('admin.dashboard') ?>" class="sm:hidden bg-primary text-primary-foreground px-5 py-2 rounded-xl font-bold text-center mt-2">
                    <span class="text-xs uppercase tracking-wider">Dashboard</span>
                </a>
            <?php else: ?>
                <a href="<?= url_to('login') ?>" class="sm:hidden bg-primary text-primary-foreground px-5 py-2 rounded-xl font-bold text-center mt-2">
                    <span class="text-xs uppercase tracking-wider">Masuk</span>
                </a>
            <?php endif; ?>
        </div>
    </nav>
</div>

<script>
    const navToggle = document.getElementById('navbar-toggle');
    const navMenu = document.getElementById('navbar-menu');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    navToggle.addEventListener('click', () => {
        const isOpen = !navMenu.classList.contains('hidden');
        navMenu.classList.toggle('hidden');
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
        navToggle.setAttribute('aria-expanded', !isOpen);
    });
</script>