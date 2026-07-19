<?= $this->extend('layouts/main-home') ?>
<?= $this->section('content') ?>
<section class="flex-1 h-screen flex items-center justify-center p-8">
    <div class="text-center space-y-6 max-w-md">
        <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto">
            <span class="material-symbols-outlined text-4xl! text-slate-400">search_off</span>
        </div>
        <div>
            <h1 class="text-2xl font-extrabold text-foreground mb-2">Halaman Tidak Ditemukan</h1>
            <p class="text-sm text-muted-foreground">Halaman yang Anda cari tidak tersedia atau telah dipindahkan. Periksa kembali URL atau kembali ke beranda.</p>
        </div>
        <a href="<?= url_to('home') ?>"
            class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-transform text-sm">
            <span class="material-symbols-outlined text-base!">arrow_back</span> Kembali ke Beranda
        </a>
    </div>
</section>
<?= $this->endSection() ?>
