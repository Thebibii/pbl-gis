<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>

<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Admin</span><span>/</span>
                    <span class="text-primary">Pengaturan</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Pengaturan Akun</h1>
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
                        <p class="text-sm font-medium"><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- FORM PENGATURAN -->
        <form action="<?= route_to('account.settings.update') ?>" method="post" class="space-y-8">
            <?= csrf_field() ?>

            <!-- INFORMASI PROFIL -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2 mb-4">
                    Informasi Profil
                </h3>

                <div class="space-y-4">
                    <!-- NAMA LENGKAP -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">
                            Nama Lengkap <span class="text-red-500 text-xs">*</span>
                        </label>
                        <input
                            name="username"
                            value="<?= esc(old('username', $user->username)) ?>"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                            placeholder="Masukkan nama lengkap"
                            type="text" />
                        <?php if (session('errors.username')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= esc(session('errors.username')) ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- ALAMAT EMAIL -->
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">
                            Alamat Email <span class="text-red-500 text-xs">*</span>
                        </label>
                        <input
                            name="email"
                            value="<?= esc(old('email', $user->email)) ?>"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all"
                            placeholder="Contoh: admin@example.com"
                            type="email" />
                        <?php if (session('errors.email')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= esc(session('errors.email')) ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- ROLE (Readonly) -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Role</p>
                        <p class="text-[15px] font-bold text-blue-600 mt-1 capitalize">
                            <?= esc($user->getGroups()[0] ?? 'Super Administrator') ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- PERBARUI KATA SANDI -->
            <div class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl p-6 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2 mb-1">
                    Perbarui Kata Sandi
                </h3>
                <p class="text-xs text-slate-400 font-medium mb-4">Kosongkan semua field password jika tidak ingin mengubah kata sandi.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- PASSWORD SEKARANG -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Password Sekarang</p>
                        <div class="relative mt-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock_open</span>
                            <input
                                class="w-full pl-12 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none text-sm font-medium transition-all"
                                name="current_password"
                                id="current_password"
                                placeholder="********"
                                type="password"
                                autocomplete="current-password" />
                            <button type="button" onclick="togglePassword('current_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                        <?php if (session('errors.current_password')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= esc(session('errors.current_password')) ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- PASSWORD BARU -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Password Baru</p>
                        <div class="relative mt-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                            <input
                                class="w-full pl-12 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none text-sm font-medium transition-all"
                                name="new_password"
                                id="new_password"
                                placeholder="Min. 8 karakter"
                                type="password"
                                autocomplete="new-password" />
                            <button type="button" onclick="togglePassword('new_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                        <?php if (session('errors.new_password')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= esc(session('errors.new_password')) ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- KONFIRMASI PASSWORD -->
                    <div class="md:col-span-2">
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Konfirmasi Password</p>
                        <div class="relative mt-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">verified_user</span>
                            <input
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none text-sm font-medium transition-all"
                                name="confirm_password"
                                placeholder="Ulangi password baru"
                                type="password"
                                autocomplete="new-password" />
                        </div>
                        <?php if (session('errors.confirm_password')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= esc(session('errors.confirm_password')) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex items-center justify-end gap-4 pb-8">
                <a href="<?= route_to('account.settings') ?>" class="px-8 py-3 rounded-xl text-sm font-bold text-secondary hover:bg-slate-100 transition-all active:scale-95">
                    Batal
                </a>
                <button type="submit" class="px-10 py-3 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-600 hover:shadow-primary/30 transition-all active:scale-95 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span> Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</section>

<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('.material-symbols-outlined');

        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>

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