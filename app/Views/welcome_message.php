<?= $this->extend('layouts/main-home') ?>
<?= $this->section('content') ?>
<main class="pt-24">
    <!-- Immersive Hero Section -->
    <section class="relative py-24 flex items-center">
        <!-- <div class="absolute inset-0 bg-gradient-to-br from-background via-muted to-primary/5 z-0"></div> -->
        <div class="container mx-auto px-2 relative z-10 grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-10">

                <h1 class="text-5xl md:text-7xl font-headline font-bold text-foreground leading-[1.1] tracking-tight">
                    Pemetaan <br />
                    <span class="text-primary relative inline-block">
                        Sekolah
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-primary/20" preserveaspectratio="none" viewbox="0 0 100 12">
                            <path d="M0,10 Q50,0 100,10" fill="transparent" stroke="currentColor" stroke-width="4"></path>
                        </svg>
                    </span> <br />
                    TK, SD dan SMP
                </h1>
                <p class="text-lg text-muted-foreground max-w-lg leading-relaxed opacity-90">
                    Menyajikan informasi persebaran sekolah pada tiga kecamatan secara interaktif untuk mendukung akses informasi yang akurat.
                </p>
                <div class="flex flex-wrap gap-6 pt-6">
                    <a href="<?= url_to('peta') ?>" class="group px-10 py-5 bg-primary text-primary-foreground rounded-2xl font-bold flex items-center justify-center gap-3 shadow-2xl shadow-primary/30 hover:scale-[1.05] transition-all duration-300 uppercase text-xs tracking-wider">
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
    <section class="py-24 bg-background relative border-t border-border/30">
        <div class="container mx-auto px-margin-desktop">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="space-y-4">
                    <h2 class="text-3xl font-headline font-bold text-foreground">Sekolah Yang Baru Bergabung</h2>
                    <p class="text-muted-foreground">Jelajahi sekolah-sekolah terbaru yang telah bergabung dan tersedia dalam peta interaktif</p>
                </div>
                <button class="text-primary font-bold flex items-center gap-2 group text-xs uppercase tracking-wider">
                    Lihat Semua Sekolah
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="school-card-vibrant bg-card text-card-foreground rounded-2xl overflow-hidden border border-border/50 cursor-pointer group">
                    <div class="relative h-44">
                        <img alt="SMA Negeri 8 Jakarta" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCgo6javCPxIdPMSdG42bT3B3PL2t8VYDS3cRiFyNIv3z99yIqFxkXz9cO1QVLk6A5G2lzEnrdWk_Kp4v_fpJJr-Z5jMFsUXnvLGK67_nJup1Ut2NdIYbkKcdCvXcKS-fkjvZ_gFGSyvDrbdQOdo-HkIBe3T3ZoviCJT51t8EVodySk_XJSY1fGtCkqDJot1_WQp0viRIH_ulPKx3afdwWbItP8kgH8FtOpPENYzubR6ZdDtTSwImRHbLEN6FAB1wWHTgaGGrAuLaY" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="bg-primary text-primary-foreground text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest">SMA NEGERI</span>
                        </div>
                        <div class="absolute bottom-3 right-3">
                            <span class="bg-success text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> A
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-headline font-bold text-lg group-hover:text-primary transition-colors mb-1">SMA Negeri 8 Jakarta</h3>
                        <div class="flex items-center gap-1.5 text-muted-foreground mb-6">
                            <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                            <span class="text-[13px]">Tebet, Jakarta Selatan</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-dashed border-border">
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-success">near_me</span>
                                <span class="text-primary font-bold text-[12px]">0.8 km</span>
                            </div>
                            <button class="text-primary hover:opacity-80 text-[10px] font-bold flex items-center gap-1 group/btn">
                                DETAIL <span class="material-symbols-outlined text-[14px] group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="school-card-vibrant bg-card text-card-foreground rounded-2xl overflow-hidden border border-border/50 cursor-pointer group">
                    <div class="relative h-44">
                        <img alt="SMP Global Mandiri" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBG2D2u9hLmjRLdejnHVJfa-q6kN8_Cl-3p6tQdrnKcADFWGhL7KRLyWlrSBW2MRwlHNc5aQfVkJEYMAF60w-xu-OafkQBR4LZbBT_i0Z8ycy5dracQg1FDONPloawic3yDzXT-LTLSPTXhs0DW44HjUA_Cw9cEMYprIc3GfGKYvEiucZEd5vozZZ-k2ptaJO8Y8WDScHo50WwYa6StP3CrLzi3BC91m1bSD1T7751tVsKrDfEY2wj-S8zXKtHneEVLUB9LTL9MZ0s" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="bg-secondary text-secondary-foreground text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest">SMP SWASTA</span>
                        </div>
                        <div class="absolute bottom-3 right-3">
                            <span class="bg-success text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> A
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-headline font-bold text-lg group-hover:text-primary transition-colors mb-1">SMP Global Mandiri</h3>
                        <div class="flex items-center gap-1.5 text-muted-foreground mb-6">
                            <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                            <span class="text-[13px]">Bogor, Jawa Barat</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-dashed border-border">
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-success">near_me</span>
                                <span class="text-primary font-bold text-[12px]">1.2 km</span>
                            </div>
                            <button class="text-primary hover:opacity-80 text-[10px] font-bold flex items-center gap-1 group/btn">
                                DETAIL <span class="material-symbols-outlined text-[14px] group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="school-card-vibrant bg-card text-card-foreground rounded-2xl overflow-hidden border border-border/50 cursor-pointer group">
                    <div class="relative h-44">
                        <img alt="SMA Negeri 3 Bandung" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCseA0QFq_J4rtkpZt9h11G2WbGlCbl_h5mxI9QULuicuI7c9bumIf-qviF5uMcXprkUtmcnuiZzggdsHo-q8MSzUM0JlJrrDkAUTb9J5xvNS9WMLnNzd-SrmXI_G0uTsQ8XvYR8ctGN28CgsAeDNw2qG_L_hBpouHH3kBw-n1JyFW5cORsFhA3pXL6JvxoB9F2FrC-1gbG8UytDFK2oodI3-c9gYGrZ3rcuk1iFH9bdxU5DzmppftbnBhRq4XHgfGpbZpOVtEYTrE" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="bg-primary text-primary-foreground text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest">SMA NEGERI</span>
                        </div>
                        <div class="absolute bottom-3 right-3">
                            <span class="bg-success text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> A
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-headline font-bold text-lg group-hover:text-primary transition-colors mb-1">SMA Negeri 3 Bandung</h3>
                        <div class="flex items-center gap-1.5 text-muted-foreground mb-6">
                            <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                            <span class="text-[13px]">Bandung, Jawa Barat</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-dashed border-border">
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-success">near_me</span>
                                <span class="text-primary font-bold text-[12px]">2.1 km</span>
                            </div>
                            <button class="text-primary hover:opacity-80 text-[10px] font-bold flex items-center gap-1 group/btn">
                                DETAIL <span class="material-symbols-outlined text-[14px] group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ Section -->
    <section class="py-24 bg-muted/20 relative">
        <div class="container mx-auto px-margin-desktop max-w-4xl">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-3xl font-headline font-bold text-foreground">Pertanyaan Umum</h2>
                <p class="text-muted-foreground">Segala hal yang perlu Anda ketahui tentang SiGIS Sekolah.</p>
            </div>
            <div class="space-y-4">
                <div class="accordion-item bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <button class="w-full px-8 py-6 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                        <span class="font-bold text-foreground">Bagaimana cara kerja sistem zonasi di peta?</span>
                        <span class="material-symbols-outlined accordion-icon transition-transform">expand_more</span>
                    </button>
                    <div class="accordion-content px-8 bg-muted/10">
                        <p class="pb-6 text-sm text-muted-foreground leading-relaxed">Peta kami menggunakan API geospasial resmi untuk menghitung radius jarak dari lokasi rumah Anda ke sekolah-sekolah terdekat sesuai regulasi zonasi terbaru.</p>
                    </div>
                </div>
                <div class="accordion-item bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <button class="w-full px-8 py-6 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                        <span class="font-bold text-foreground">Seberapa sering data akreditasi diperbarui?</span>
                        <span class="material-symbols-outlined accordion-icon transition-transform">expand_more</span>
                    </button>
                    <div class="accordion-content px-8 bg-muted/10">
                        <p class="pb-6 text-sm text-muted-foreground leading-relaxed">Data kami terhubung langsung dengan basis data nasional dan diperbarui secara otomatis setiap kali ada rilis resmi dari Badan Akreditasi Nasional.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Section -->
    <section class="py-24 bg-primary text-primary-foreground relative overflow-hidden">
        <div class="absolute inset-0 topo-pattern opacity-10"></div>
        <div class="container mx-auto px-margin-desktop text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-headline font-bold mb-6">Jelajahi Informasi Pendidikan Secara Interaktif</h2>
            <p class="text-lg mb-10 max-w-2xl mx-auto opacity-90">Temukan lokasi, profil, dan informasi sekolah TK, SD, dan SMP melalui peta digital yang mudah diakses dan informatif.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="<?= url_to('peta') ?>" class="px-10 py-4 bg-background text-primary rounded-2xl font-bold hover:bg-muted transition-all shadow-2xl uppercase text-xs tracking-widest">Buka Peta Interaktif</a>
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