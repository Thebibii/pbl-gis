<!-- Header -->
<header class="h-14 lg:h-16 bg-white/70 backdrop-blur-md border border-white/30 rounded-2xl px-4 sm:px-6 lg:px-8 mx-6 py-3 lg:py-4 flex items-center justify-between lg:justify-end sticky top-4 z-40 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">

    <!-- Tombol menu, hanya tampil di bawah breakpoint lg -->
    <button
        id="btn-sidebar-toggle"
        type="button"
        class="lg:hidden flex items-center h-fit p-2 text-muted-foreground hover:bg-secondary rounded-lg transition-colors"
        aria-label="Buka menu">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <div class="flex items-center gap-3 sm:gap-4 justify-end">
        <!-- <button class="p-2 text-muted-foreground hover:bg-secondary rounded-lg transition-colors relative">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full border-2 border-white"></span>
        </button>
        <div class="h-8 w-px bg-border"></div> -->
        <div class="flex items-center gap-3 pl-2 group">
            <div class="text-right hidden sm:block">
                <p class="text-[13px] font-bold text-foreground capitalize"><?= auth()->user()->username ?></p>
                <p class="text-[11px] text-muted-foreground leading-none capitalize"><?= auth()->user()->getGroups()[0] ?></p>
            </div>
            <div class="w-9 h-9 flex items-center justify-center uppercase rounded-full bg-secondary border border-border overflow-hidden ring-2 ring-transparent group-hover:ring-primary/20 transition-all text-sm font-bold text-muted-foreground">
                <?= mb_substr(auth()->user()->username, 0, 1) ?>
            </div>

        </div>
    </div>
</header>