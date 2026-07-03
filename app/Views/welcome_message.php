<?= $this->extend('layouts/main-home') ?>
<?= $this->section('content') ?>
<main class="pt-20 lg:pt-24">
    <!-- Immersive Hero Section -->
    <section class="relative py-16 sm:py-20 lg:py-24 flex items-center">
        <!-- <div class="absolute inset-0 bg-gradient-to-br from-background via-muted to-primary/5 z-0"></div> -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <div class="lg:col-span-7 space-y-6 sm:space-y-8 lg:space-y-10">

                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline font-bold text-foreground leading-[1.1] tracking-tight">
                    Pemetaan <br />
                    <span class="text-primary relative inline-block">
                        Sekolah
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-primary/20" preserveaspectratio="none" viewbox="0 0 100 12">
                            <path d="M0,10 Q50,0 100,10" fill="transparent" stroke="currentColor" stroke-width="4"></path>
                        </svg>
                    </span> <br />
                    TK, SD dan SMP
                </h1>
                <p class="text-base sm:text-lg text-muted-foreground max-w-lg leading-relaxed opacity-90">
                    Menyajikan informasi persebaran sekolah pada tiga kecamatan secara interaktif untuk mendukung akses informasi yang akurat.
                </p>
                <div class="flex flex-wrap gap-4 sm:gap-6 pt-2 sm:pt-4 lg:pt-6">
                    <a href="<?= url_to('peta') ?>" class="group px-6 py-3 sm:px-8 sm:py-4 lg:px-10 lg:py-5 bg-primary text-primary-foreground rounded-2xl font-bold flex items-center justify-center gap-3 shadow-2xl shadow-primary/30 hover:scale-[1.05] transition-all duration-300 uppercase text-xs tracking-wider">
                        Mulai Eksplorasi Peta
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">explore</span>
                    </a>
                    <!-- <button class="px-10 py-5 bg-background text-primary border-2 border-primary/20 rounded-2xl font-bold flex items-center justify-center gap-3 hover:bg-muted hover:border-primary transition-all duration-300 uppercase text-xs tracking-wider">
                        Lihat Statistik
                        <span class="material-symbols-outlined">analytics</span>
                    </button> -->
                </div>
            </div>
            <div class="lg:col-span-5 relative hidden lg:block">
                <div class="floating-3d relative">
                    <div class="absolute -inset-10 bg-primary/5 blur-[100px] rounded-full"></div>
                    <div class="relative glass-effect p-6 rounded-[40px] shadow-[0_32px_64px_-16px_rgba(var(--primary),0.2)] transform perspective-1000 rotate-y-12">
                        <img alt="Map Data Visualization" class="rounded-[28px] w-full object-cover shadow-2xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhYntSYsYQw8N0VTDyIC69MTWDLfdcqgXGFKocJZl5RDg0CmHmHJ3LKneDJSqXg7L2kKnHwk62VrOia-QXGkOpxCXF7N1i5ZRJJa_mXQnVYET4lXpSaCoUVzva4BW81jxhgQeKr0FqxZkP1x__PCaML_Po0qgWGrKMQrBzhjxy87mOi62brgtGTT1Qp4Sn2yAy9Bvk-PlLWMiactHf8K9RuN2q93owBzOQd5TnDkN7U-uNKqRMBZrcLjn__0yqBWmZkPiRy6tjD5E" />
                        <!-- <div class="absolute -bottom-10 -left-12 glass-effect p-5 rounded-3xl shadow-2xl flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-success/10 flex items-center justify-center text-success">
                                <span class="material-symbols-outlined text-[32px]" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest mb-0.5">TINGKAT AKURASI</div>
                                <div class="text-2xl font-stat font-bold text-foreground">98.5%</div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bento Grid Stats -->
    <!-- <section class="py-24 bg-background relative overflow-hidden">
        <div class="absolute inset-0 topo-pattern opacity-30"></div>
        <div class="container mx-auto px-margin-desktop relative z-10">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-3xl font-headline font-bold text-foreground">Statistik Pendidikan Nasional</h2>
                <p class="text-muted-foreground max-w-2xl mx-auto">Pantau perkembangan infrastruktur dan kualitas pendidikan di seluruh provinsi Indonesia secara real-time.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-6 h-auto md:h-[500px]">
                <div class="md:col-span-2 md:row-span-2 bg-primary text-primary-foreground p-10 rounded-3xl flex flex-col justify-between shadow-xl relative overflow-hidden group">
                    <span class="material-symbols-outlined text-[150px] absolute -right-10 -bottom-10 opacity-10 group-hover:scale-110 transition-transform">school</span>
                    <div class="relative z-10">
                        <h3 class="text-xl font-headline font-semibold mb-2 opacity-90">Total Institusi</h3>
                        <p class="opacity-70">Tersebar dari Sabang sampai Merauke</p>
                    </div>
                    <div class="text-[88px] font-bold font-stat leading-none relative z-10">
                        24.8k+
                    </div>
                </div>
                <div class="bg-card p-8 rounded-3xl flex flex-col justify-between shadow-sm border border-border hover:shadow-lg transition-all">
                    <div class="flex justify-between items-start">
                        <span class="material-symbols-outlined text-primary text-[40px]">verified</span>
                        <span class="text-success font-bold text-xs">+12%</span>
                    </div>
                    <div>
                        <div class="text-3xl font-stat font-bold text-foreground">65%</div>
                        <div class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">AKREDITASI A</div>
                    </div>
                </div>
                <div class="bg-secondary text-foreground p-8 rounded-3xl flex flex-col justify-between shadow-sm relative overflow-hidden border border-border/50">
                    <div class="flex justify-between items-start relative z-10">
                        <span class="material-symbols-outlined text-[40px] text-primary">distance</span>
                    </div>
                    <div class="relative z-10">
                        <div class="text-3xl font-stat font-bold">3,204</div>
                        <div class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">SEKOLAH TERPENCIL</div>
                    </div>
                </div>
                <div class="md:col-span-2 bg-card border border-border p-8 rounded-3xl flex items-center justify-between shadow-sm hover:shadow-md transition-all">
                    <div class="space-y-2">
                        <h3 class="text-xl font-headline font-semibold text-foreground">Rasio Guru &amp; Siswa</h3>
                        <p class="text-muted-foreground">Standar ideal untuk efektivitas belajar</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-stat font-bold text-primary">1:18</div>
                        <div class="text-[10px] font-bold text-success uppercase tracking-widest">OPTIMAL</div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Highlight Section - School Cards Updated to Match SCREEN_7 -->
    <section class="py-16 sm:py-20 lg:py-24 bg-background relative border-t border-border/30">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 space-y-10 sm:space-y-12 lg:space-y-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 sm:gap-6">
                <div class="space-y-3 sm:space-y-4">
                    <h2 class="text-2xl sm:text-3xl font-headline font-bold text-foreground">Sekolah Yang Baru Bergabung</h2>
                    <p class="text-muted-foreground">Jelajahi sekolah-sekolah terbaru yang telah bergabung dan tersedia dalam peta interaktif</p>
                </div>
                <a href="<?= url_to('cari') ?>" class="text-primary font-bold flex items-center gap-2 group text-xs uppercase tracking-wider">
                    Lihat Semua Sekolah
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">

                <!-- Card 1 -->
                <?php if (!empty($sekolah)): ?>
                    <?php

                    ?>
                    <?php foreach ($sekolah as $item):
                        // 1. Logika Warna Jenjang menggunakan match
                        $bgJenjang = match (strtoupper($item['jenjang'])) {
                            'TK'          => 'badge-TK text-white',
                            'SD'          => 'badge-SD text-white',
                            'SMP'         => 'badge-SMP text-white',
                            default       => 'bg-gray-500 text-white',
                        };

                        // 2. Logika Warna Akreditasi menggunakan match
                        $bgAkreditasi = match (strtoupper($item['akreditasi'])) {
                            'A'                     => 'badge-A',
                            'B'                     => 'badge-B',
                            'C'                     => 'badge-C',
                            'BELUM TERAKREDITASI'   => 'bg-slate-700',
                            default                 => 'bg-slate-500',
                        };
                    ?>
                        <div class="school-card-vibrant bg-card text-foreground rounded-2xl overflow-hidden border border-border/50 cursor-pointer group">
                            <div class="relative h-44 overflow-hidden">
                                <?php if (!empty($s['foto_utama'])): ?>
                                    <!-- Gambar Sekolah Dinamis -->
                                    <img alt="<?= esc($item['nama_sekolah']) ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="<?= base_url('uploads/sekolah') . '/' . esc($sekolah['foto_utama']) ?>" />
                                <?php else: ?>
                                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-slate-400">school</span>
                                    </div>
                                <?php endif; ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute top-3 left-3 flex gap-2">
                                    <!-- Jenjang Sekolah Dinamis -->
                                    <span class="<?= $bgJenjang ?> text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest">
                                        <?= esc($item['jenjang']) ?> <?= esc($item['status']) ?></span>
                                </div>
                                <div class="absolute bottom-3 right-3">
                                    <!-- Akreditasi Dinamis -->
                                    <span class="<?= $bgAkreditasi ?> text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span> <?= esc($item['akreditasi']) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex flex-col gap-4 sm:gap-6">
                                <div class="flex flex-col gap-0.5">
                                    <!-- Nama Sekolah Dinamis -->
                                    <h3 class="font-headline font-bold text-lg group-hover:text-primary transition-colors truncate"><?= esc($item['nama_sekolah']) ?></h3>
                                    <h3 class="group-hover:text-primary transition-colors">NPSN <?= esc($item['npsn']) ?></h3>
                                </div>
                                <div class="flex items-center gap-1.5 text-muted-foreground">
                                    <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                                    <!-- Alamat Dinamis -->
                                    <span class="text-[13px]"><?= esc($item['alamat']) ?></span>
                                </div>
                                <div class="flex justify-center items-center pt-4 border-t border-dashed border-border">

                                    <!-- Link Detail menggunakan ID Dinamis -->
                                    <a href="<?= site_url('sekolah') ?>/<?= $item['slug'] ?>" class="text-primary hover:opacity-80 text-xs font-bold flex items-center gap-1 group/btn">
                                        DETAIL SEKOLAH <span class="material-symbols-outlined text-[16px]! group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Tampilan pengganti jika data kosong (Kondisi @empty) -->
                    <div class="col-span-full text-center py-12">
                        <p class="text-muted-foreground text-sm">Tidak ada data sekolah terbaru yang ditemukan.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <!-- FAQ Section -->
    <section class="py-16 sm:py-20 lg:py-24 bg-muted/20 relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl space-y-10 sm:space-y-12 lg:space-y-16">
            <div class="text-center space-y-3 sm:space-y-4">
                <h2 class="text-2xl sm:text-3xl font-headline font-bold text-foreground">Pertanyaan Umum</h2>
                <p class="text-muted-foreground">Segala hal yang perlu Anda ketahui tentang SiGIS Sekolah.</p>
            </div>
            <div class="space-y-3 sm:space-y-4">
                <div class="accordion-item bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <button class="w-full px-5 py-4 sm:px-6 sm:py-5 lg:px-8 lg:py-6 flex justify-between items-center text-left gap-4" onclick="toggleAccordion(this)">
                        <span class="font-bold text-foreground">Bagaimana cara kerja sistem zonasi di peta?</span>
                        <span class="material-symbols-outlined accordion-icon transition-transform">expand_more</span>
                    </button>
                    <div class="accordion-content px-5 sm:px-6 lg:px-8 bg-muted/10">
                        <p class="pb-6 text-sm text-muted-foreground leading-relaxed">Peta kami menggunakan API geospasial resmi untuk menghitung radius jarak dari lokasi rumah Anda ke sekolah-sekolah terdekat sesuai regulasi zonasi terbaru.</p>
                    </div>
                </div>
                <div class="accordion-item bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <button class="w-full px-5 py-4 sm:px-6 sm:py-5 lg:px-8 lg:py-6 flex justify-between items-center text-left gap-4" onclick="toggleAccordion(this)">
                        <span class="font-bold text-foreground">Seberapa sering data akreditasi diperbarui?</span>
                        <span class="material-symbols-outlined accordion-icon transition-transform">expand_more</span>
                    </button>
                    <div class="accordion-content px-5 sm:px-6 lg:px-8 bg-muted/10">
                        <p class="pb-6 text-sm text-muted-foreground leading-relaxed">Data kami terhubung langsung dengan basis data nasional dan diperbarui secara otomatis setiap kali ada rilis resmi dari Badan Akreditasi Nasional.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Section -->
    <section class="py-16 sm:py-20 lg:py-24 bg-primary text-primary-foreground relative overflow-hidden">
        <div class="absolute inset-0 topo-pattern opacity-10"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6 sm:space-y-8">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-headline font-bold">Jelajahi Informasi Pendidikan Secara Interaktif</h2>
            <p class="text-base sm:text-lg max-w-2xl mx-auto opacity-90">Temukan lokasi, profil, dan informasi sekolah TK, SD, dan SMP melalui peta digital yang mudah diakses dan informatif.</p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 sm:gap-6">
                <a href="<?= url_to('peta') ?>" class="px-8 py-3 w-fit sm:px-10 sm:py-4 bg-background text-primary rounded-2xl font-bold hover:bg-muted transition-all shadow-2xl uppercase text-xs tracking-widest">Buka Peta Interaktif</a>
                <!-- <button class="px-10 py-4 bg-white/10 border border-white/30 text-primary-foreground rounded-2xl font-bold hover:bg-white/20 transition-all uppercase text-xs tracking-widest">Hubungi Tim Ahli</button> -->
            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    // console.log('a');

    function toggleAccordion(element) {

        const item = element.parentElement;

        const isActive = item.classList.contains('active');

        document.querySelectorAll('.accordion-item').forEach(el => {
            el.classList.remove('active');
        });

        if (!isActive) {
            item.classList.add('active');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('section').forEach(section => {
            if (!section.classList.contains('min-h-screen')) {
                section.classList.add('transition-all', 'duration-1000', 'opacity-0', 'translate-y-8');
                observer.observe(section);
            }
        });
    });
</script>
<?= $this->endSection() ?>