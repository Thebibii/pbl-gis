<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>

<section class="flex-1 p-6 space-y-6 bg-background">
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- PAGE HEADER - Pengaturan Profil -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Admin</span><span>/</span>
                    <span class="text-primary">Pengaturan</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Pengaturan Profil</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Kelola informasi akun dan tingkatkan keamanan data Anda untuk menjaga integritas sistem.
                </p>
            </div>
        </header>

        <!-- ALERT SUCCESS -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                <p class="text-sm font-medium"><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <!-- ALERT ERROR -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl flex items-center gap-3">
                <span class="material-symbols-outlined text-red-600">error</span>
                <div>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p class="text-sm font-medium"><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- FORM PENGATURAN -->
        <form action="<?= base_url('admin/setting/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- ========================================== -->
            <!-- INFORMASI PROFIL - DENGAN FORM INPUT      -->
            <!-- ========================================== -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-accent">person</span>
                    Informasi Profil
                </h3>

                <div class="space-y-4">
                    <!-- NAMA LENGKAP -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">NAMA LENGKAP</p>
                        <input type="text" 
                               name="nama" 
                               value="<?= session()->get('nama') ?? 'Ahmad Administrator' ?>"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none text-sm font-medium transition-all"
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <!-- ALAMAT EMAIL -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">ALAMAT EMAIL</p>
                        <input type="email" 
                               name="email" 
                               value="<?= session()->get('email') ?? 'ahmad.admin@sigis.go.id' ?>"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white outline-none text-sm font-medium transition-all"
                               placeholder="Masukkan alamat email">
                    </div>

                    <!-- ROLE (Readonly - Tidak Bisa Diubah) -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">ROLE</p>
                        <p class="text-[15px] font-bold text-blue-600 mt-1"><?= session()->get('role') ?? 'Super Administrator' ?></p>
                        <input type="hidden" name="role" value="<?= session()->get('role') ?? 'Super Administrator' ?>">
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- PERBARUI KATA SANDI                       -->
            <!-- ========================================== -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-rose-500">security</span>
                    Perbarui Kata Sandi
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- PASSWORD SEKARANG -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Password Sekarang</p>
                        <div class="relative mt-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock_open</span>
                            <input class="w-full pl-12 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none text-sm font-medium transition-all" 
                                   name="current_password" placeholder="********" type="password"/>
                            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- PASSWORD BARU -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Password Baru</p>
                        <div class="relative mt-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                            <input class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none text-sm font-medium transition-all" 
                                   name="new_password" placeholder="Min. 8 karakter" type="password"/>
                        </div>
                    </div>

                    <!-- KONFIRMASI PASSWORD -->
                    <div class="md:col-span-2">
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Konfirmasi Password</p>
                        <div class="relative mt-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">verified_user</span>
                            <input class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none text-sm font-medium transition-all" 
                                   name="confirm_password" placeholder="Ulangi password" type="password"/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- FORM ACTIONS                              -->
            <!-- ========================================== -->
            <div class="flex items-center justify-end gap-4 pb-8">
                <a href="<?= base_url('admin/dashboard') ?>" class="px-8 py-3 rounded-xl text-sm font-bold text-secondary hover:bg-slate-100 transition-all active:scale-95">Batal</a>
                <button type="submit" class="px-10 py-3 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-600 hover:shadow-primary/30 transition-all active:scale-95 flex items-center gap-2" id="save-btn">
                    <span class="material-symbols-outlined text-[20px]">save</span> Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</section>

<!-- CSS Tambahan -->
<style>
    .shadow-soft {
        box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Toggle Password Visibility
        document.querySelectorAll('.relative button').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.closest('.relative').querySelector('input');
                if (input) {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.querySelector('span').textContent = type === 'password' ? 'visibility' : 'visibility_off';
                }
            });
        });

        // Save Button Animation
        const saveBtn = document.getElementById('save-btn');
        if (saveBtn) {
            saveBtn.addEventListener('click', function(e) {
                const originalContent = this.innerHTML;
                this.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Menyimpan...</span>
                `;
                this.disabled = true;
            });
        }
    });
</script>

<?= $this->endSection() ?>