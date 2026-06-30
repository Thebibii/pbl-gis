<!-- Header -->
<header class="h-16 bg-white/70 backdrop-blur-md border-b border-border rounded-2xl px-8 py-4 flex items-center justify-end sticky top-4 z-40">
    <div class="flex items-center gap-4 justify-end">
        <!-- <button class="p-2 text-muted-foreground hover:bg-secondary rounded-lg transition-colors relative">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full border-2 border-white"></span>
        </button>
        <div class="h-8 w-px bg-border mx-1"></div> -->
        <div class="flex items-center gap-3 pl-2 group">
            <div class="text-right">
                <p class="text-[13px] font-bold text-foreground capitalize"><?= auth()->user()->username ?></p>
                <p class="text-[11px] text-muted-foreground leading-none capitalize"><?= auth()->user()->getGroups()[0] ?></p>
            </div>
            <div class="w-9 h-9 flex items-center justify-center uppercase rounded-full bg-secondary border border-border overflow-hidden ring-2 ring-transparent group-hover:ring-primary/20 transition-all text-sm font-bold text-muted-foreground">
                <?= mb_substr(auth()->user()->username, 0, 1) ?>
            </div>

        </div>
    </div>
</header>