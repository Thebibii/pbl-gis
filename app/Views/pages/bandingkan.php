<?= $this->extend('layouts/main-home') ?>
<?= $this->section('content') ?>
<main class="pt-[140px] pb-24">
    <!-- Hero Section -->
    <section class="mb-16 px-6 md:px-10">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-end gap-8">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full glass-effect border border-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    Comparison Engine v2.0
                </div>
                <h1 class="text-4xl md:text-5xl font-headline font-bold text-foreground tracking-tight">Bandingkan Institusi</h1>
                <p class="text-base text-muted-foreground max-w-xl leading-relaxed">Analisis data performa, fasilitas, dan biaya antar sekolah secara real-time untuk keputusan pendidikan yang akurat.</p>
            </div>
            <div class="flex gap-4">
                <button class="flex items-center gap-2 bg-card border border-border text-muted-foreground px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-muted transition-all">
                    <span class="material-symbols-outlined text-lg">share</span>
                    Share
                </button>
                <button class="flex items-center gap-2 bg-primary text-primary-foreground px-8 py-3 rounded-xl text-xs font-bold uppercase tracking-wider shadow-lg shadow-primary/20 hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined text-lg">download</span>
                    Export PDF
                </button>
            </div>
        </div>
    </section>
    <!-- Comparison Table Layout -->
    <section class="px-6 md:px-10">
        <div class="max-w-7xl mx-auto">
            <div class="comparison-grid">
                <!-- Labels Sidebar -->
                <div class="comparison-labels flex flex-col pt-[280px] gap-0">
                    <div class="h-20 flex items-center border-b border-border pr-8"><span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">AKREDITASI</span></div>
                    <div class="h-20 flex items-center border-b border-border pr-8"><span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">JUMLAH SISWA</span></div>
                    <div class="h-20 flex items-center border-b border-border pr-8"><span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">GURU &amp; STAF</span></div>
                    <div class="py-10 border-b border-border pr-8"><span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">FASILITAS</span></div>
                    <div class="h-24 flex items-center border-b border-border pr-8"><span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">PRESTASI</span></div>
                    <div class="h-24 flex items-center border-b border-border pr-8"><span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">ESTIMASI BIAYA</span></div>
                </div>
                <!-- School 1 -->
                <div class="school-card-vibrant bg-card rounded-2xl border border-border overflow-hidden flex flex-col h-full">
                    <div class="relative h-44">
                        <img alt="SMAN 1" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDEdDWWiYqm0mdjQ-u-1YaZgwPBKNp-79YWW2w25XvV6-6-K_O4zqA_NadCqsl9I-lcd0rF91HinCU7e-ZS175GsQqRwAmLHemY8k_JsWKTFgwuAQelornPeYEoR8pmFlyGkFoSGDRwngBTI8qZ0ko4ifeo9DmwIEjQNJd4RHgh7eyem3VadSHQw_1puIqZ0UaYqoihbDjBIgDe5A2Ra8PTjTIczLXT7K7Epp8F_rtYuUAmsktpn2wzMSQjw6QRmVXkn4gy-naG9RI" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 bg-primary text-primary-foreground text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest">Negeri</span>
                        <div class="absolute bottom-3 right-3">
                            <span class="bg-success text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> A
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="font-headline font-bold text-lg text-foreground mb-1">SMAN 1 Jakarta</h3>
                        <p class="text-[13px] text-muted-foreground mb-6">Gambir, Jakarta Pusat</p>
                        <div class="space-y-0 flex-1">
                            <div class="flex items-center border-b border-border h-20">
                                <span class="bg-success/10 text-success px-2 py-0.5 rounded text-[11px] font-bold border border-success/20 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">verified</span> A (Unggul)
                                </span>
                            </div>
                            <div class="flex items-center border-b border-border h-20">
                                <span class="text-2xl font-stat font-bold text-foreground">1.120</span>
                            </div>
                            <div class="flex items-center border-b border-border h-20">
                                <span class="text-sm font-medium text-foreground">85 Guru</span>
                            </div>
                            <div class="py-8 border-b border-border">
                                <ul class="space-y-3">
                                    <li class="flex items-center gap-3 text-xs text-muted-foreground"><span class="w-1.5 h-1.5 rounded-full bg-border"></span> Lab Kimia Modern</li>
                                    <li class="flex items-center gap-3 text-xs text-muted-foreground"><span class="w-1.5 h-1.5 rounded-full bg-border"></span> Lapangan Basket Indoor</li>
                                    <li class="flex items-center gap-3 text-xs text-muted-foreground"><span class="w-1.5 h-1.5 rounded-full bg-border"></span> Perpustakaan Digital</li>
                                </ul>
                            </div>
                            <div class="flex flex-col justify-center border-b border-border h-24">
                                <p class="font-bold text-primary text-[13px]">Juara 1 OSN Nasional 2023</p>
                                <p class="text-[11px] text-muted-foreground uppercase font-semibold">Bidang Fisika</p>
                            </div>
                            <div class="flex flex-col justify-center h-24">
                                <p class="text-foreground font-bold text-lg">Gratis (BOS)</p>
                                <p class="text-[10px] text-muted-foreground uppercase font-bold tracking-wider">OPERATIONAL SUPPORT</p>
                            </div>
                        </div>
                        <button class="w-full mt-6 py-3 bg-secondary text-foreground text-[10px] font-bold uppercase tracking-widest rounded-xl hover:bg-border transition-colors">Lihat Profil</button>
                    </div>
                </div>
                <!-- School 2 - Featured -->
                <div class="school-card-vibrant bg-card rounded-2xl border-2 border-primary overflow-hidden flex flex-col h-full relative">
                    <div class="absolute top-0 right-0 bg-primary text-primary-foreground text-[9px] font-black tracking-widest px-4 py-1.5 rounded-bl-xl uppercase z-10 shadow-lg">Premium</div>
                    <div class="relative h-44">
                        <img alt="SMA Global Mandiri" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAXWmP8l76Hmp33afiPfYQ0WY37B1RZRkl_Plt7PXDnIwLoeb36dFaM-AcyRWZkpE_wIL4oQkG3Sz-mfU0ku4y39P4ogYRlGqpdRHug62eBhBH68TZ66lxRJW7QLpFXdaROIq2QkMaxNkNVq2nssuRoDS_0pdUj0Kqag3fZJrai6He5D2vUXACmQbInfbpJiQ2Wbzv1IbPdhooXGURNz2ayvdORBiQEzGrzGcUj4VfdCAH-9HOEirjXNGdyzFWrWU7d384IBmLqXQA" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 bg-secondary text-secondary-foreground text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest">Swasta</span>
                        <div class="absolute bottom-3 right-3">
                            <span class="bg-success text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> A
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="font-headline font-bold text-lg text-primary mb-1">SMA Global Mandiri</h3>
                        <p class="text-[13px] text-muted-foreground mb-6">Cibubur, Jawa Barat</p>
                        <div class="space-y-0 flex-1">
                            <div class="flex items-center border-b border-border h-20">
                                <span class="bg-primary text-primary-foreground px-2 py-0.5 rounded text-[11px] font-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">verified</span> A (Internasional)
                                </span>
                            </div>
                            <div class="flex items-center border-b border-border h-20">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl font-stat font-bold text-primary">650</span>
                                    <span class="text-[9px] bg-primary/10 text-primary px-2 py-0.5 rounded-full font-black border border-primary/10 tracking-tighter">INTIMATE</span>
                                </div>
                            </div>
                            <div class="flex items-center border-b border-border h-20">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-foreground">110 Guru</span>
                                    <span class="text-[10px] text-primary font-bold uppercase tracking-tight">1:6 Ratio</span>
                                </div>
                            </div>
                            <div class="py-8 border-b border-border">
                                <ul class="space-y-3">
                                    <li class="flex items-center gap-3 text-xs font-semibold text-foreground"><span class="w-1.5 h-1.5 rounded-full bg-primary"></span> Kolam Renang Olympic</li>
                                    <li class="flex items-center gap-3 text-xs font-semibold text-foreground"><span class="w-1.5 h-1.5 rounded-full bg-primary"></span> Studio Seni &amp; Musik</li>
                                    <li class="flex items-center gap-3 text-xs font-semibold text-foreground"><span class="w-1.5 h-1.5 rounded-full bg-primary"></span> Lab Robotika</li>
                                </ul>
                            </div>
                            <div class="flex flex-col justify-center border-b border-border h-24">
                                <p class="font-bold text-foreground text-[13px]">Best Int'l Curriculum</p>
                                <p class="text-[11px] text-muted-foreground uppercase font-semibold">Southeast Asia Region</p>
                            </div>
                            <div class="flex flex-col justify-center h-24">
                                <p class="text-primary font-bold text-lg">Rp 3.500.000 / bln</p>
                                <p class="text-[10px] text-muted-foreground uppercase font-bold tracking-wider">UANG PANGKAL: 45JT</p>
                            </div>
                        </div>
                        <button class="w-full mt-6 py-3 bg-primary text-primary-foreground text-[10px] font-bold uppercase tracking-widest rounded-xl shadow-lg shadow-primary/20 hover:opacity-95 transition-all">Hubungi Admission</button>
                    </div>
                </div>
                <!-- School 3 -->
                <div class="school-card-vibrant bg-card rounded-2xl border border-border overflow-hidden flex flex-col h-full">
                    <div class="relative h-44">
                        <img alt="SMAN 70" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDljp5Qn6ierkmUWkRk9G5oj5qThPBgb9WYP8osMw_0ZTXqU--BNaTQbZuKkP40-R4-DX-zwRhr24AJjUoWOwb5Fg97NTnQxYzza3gVC_bezngzMMdCx6WXK3k3s4pnY-QGIdNrOBqK3A8qKPnhaYBmKjIkC55XSQ-mRsfkCBWD1vMhQjQp8WYLSbqOCvwHycGSUrD7P4S2dE-msbrmnrC2i2qcwvXzlLz6AtLCigeQwpcTZj4bTOD2CG5gMJUyrSBBe2ZAXbznUgA" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute top-3 left-3 bg-primary text-primary-foreground text-[9px] font-bold px-2 py-1 rounded shadow-lg uppercase tracking-widest">Negeri</span>
                        <div class="absolute bottom-3 right-3">
                            <span class="bg-success text-white text-[10px] font-bold px-2 py-1 rounded-full flex items-center gap-1 shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span> A
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="font-headline font-bold text-lg text-foreground mb-1">SMAN 70 Jakarta</h3>
                        <p class="text-[13px] text-muted-foreground mb-6">Kebayoran Baru, Jaksel</p>
                        <div class="space-y-0 flex-1">
                            <div class="flex items-center border-b border-border h-20">
                                <span class="bg-success/10 text-success px-2 py-0.5 rounded text-[11px] font-bold border border-success/20 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">verified</span> A (Unggul)
                                </span>
                            </div>
                            <div class="flex items-center border-b border-border h-20">
                                <span class="text-2xl font-stat font-bold text-foreground">1.240</span>
                            </div>
                            <div class="flex items-center border-b border-border h-20">
                                <span class="text-sm font-medium text-foreground">92 Guru</span>
                            </div>
                            <div class="py-8 border-b border-border">
                                <ul class="space-y-3">
                                    <li class="flex items-center gap-3 text-xs text-muted-foreground"><span class="w-1.5 h-1.5 rounded-full bg-border"></span> Lab Komputer Mac</li>
                                    <li class="flex items-center gap-3 text-xs text-muted-foreground"><span class="w-1.5 h-1.5 rounded-full bg-border"></span> Gedung Serbaguna</li>
                                    <li class="flex items-center gap-3 text-xs text-muted-foreground"><span class="w-1.5 h-1.5 rounded-full bg-border"></span> Kantin Terakreditasi</li>
                                </ul>
                            </div>
                            <div class="flex flex-col justify-center border-b border-border h-24">
                                <p class="font-bold text-primary text-[13px]">Juara 1 Debat Nasional</p>
                                <p class="text-[11px] text-muted-foreground uppercase font-semibold">Bahasa Inggris</p>
                            </div>
                            <div class="flex flex-col justify-center h-24">
                                <p class="text-foreground font-bold text-lg">Gratis (BOS)</p>
                                <p class="text-[10px] text-muted-foreground uppercase font-bold tracking-wider">OPERATIONAL SUPPORT</p>
                            </div>
                        </div>
                        <button class="w-full mt-6 py-3 bg-secondary text-foreground text-[10px] font-bold uppercase tracking-widest rounded-xl hover:bg-border transition-colors">Lihat Profil</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bento Insights -->
    <section class="mt-32 px-6 md:px-10">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-headline font-bold text-foreground mb-10">Geo-Insights</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Spatial Bento -->
                <div class="md:col-span-2 bg-card p-10 rounded-3xl border border-border flex flex-col lg:flex-row gap-12 relative overflow-hidden group hover:shadow-xl transition-all">
                    <div class="flex-1 relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black tracking-widest uppercase mb-4 border border-primary/20">Spatial Analysis</div>
                        <h3 class="text-2xl font-headline font-bold mb-6 leading-tight text-foreground">Aksesibilitas &amp; Analisis Jarak</h3>
                        <p class="text-sm text-muted-foreground mb-10 leading-relaxed max-w-md">Sistem GIS menghitung estimasi jarak tempuh rata-rata dari klaster pemukiman utama ke masing-masing lokasi sekolah.</p>
                        <div class="flex flex-wrap gap-4">
                            <div class="bg-muted p-5 rounded-2xl border border-border min-w-[140px] flex flex-col gap-1">
                                <span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">SMAN 1</span>
                                <span class="text-2xl font-stat font-bold text-primary">2.4 KM</span>
                            </div>
                            <div class="bg-muted p-5 rounded-2xl border border-primary/20 min-w-[140px] flex flex-col gap-1">
                                <span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">Global Mandiri</span>
                                <span class="text-2xl font-stat font-bold text-primary">1.1 KM</span>
                            </div>
                            <div class="bg-muted p-5 rounded-2xl border border-border min-w-[140px] flex flex-col gap-1">
                                <span class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest">SMAN 70</span>
                                <span class="text-2xl font-stat font-bold text-primary">3.8 KM</span>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-80 h-auto rounded-3xl overflow-hidden border border-border grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700 shadow-lg">
                        <img alt="Map" class="w-full h-full object-cover scale-[1.2]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-8OPkAKiUx_PWeNoLuO_T53y3K9NIC6B6qeShPQCrdxLeIzR1w39lyFqw7l--htfew0mDPpDKswu-yfCyaI92R0ooMF_qTj3kGAsxdrT1w3uY-hLfFH4dDw49cQKSPkoraPcNXguzR_jijFaHgXJhebokUC2xrFKMJbI4mzhZn8vug6EXkJisEMPsnVKtaqByzEE0-Ic-ZJmTJt2K6MHSnBXx7pLDhtODePlld3ccvpAeQ1lyNKBCMDwNKtoEJ2w5Pi8_97gQF9U" />
                    </div>
                </div>
                <!-- Guide Bento -->
                <div class="bg-primary p-10 rounded-3xl flex flex-col justify-between relative overflow-hidden group shadow-lg shadow-primary/20">
                    <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-white/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                    <span class="material-symbols-outlined text-white/10 text-[160px] absolute -top-12 -right-12 rotate-12">school</span>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-headline font-bold text-primary-foreground mb-4 leading-snug">Panduan PPDB 2024</h3>
                        <p class="text-sm text-primary-foreground/80 leading-relaxed">Pelajari parameter zonasi, jalur prestasi, dan persyaratan administrasi terbaru untuk pendaftaran sekolah.</p>
                    </div>
                    <a class="mt-12 inline-flex items-center justify-between bg-background text-primary px-8 py-4 rounded-xl text-xs font-bold uppercase tracking-widest hover:shadow-xl hover:scale-[1.02] transition-all relative z-10" href="#">
                        Pelajari Selengkapnya
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>