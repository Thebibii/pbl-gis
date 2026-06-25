<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 overflow-y-auto p-8 space-y-8">
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-extrabold text-foreground">Tambah Pengguna</h1>
            <p class="text-sm font-medium text-muted-foreground mt-1">Lengkapi formulir di bawah ini untuk menambahkan akun pengguna baru ke sistem.</p>
        </div>
        <div class="flex gap-3">
            <a href="<?= url_to('admin.user') ?>" class="px-6 py-2.5 rounded-xl border border-border text-slate-600 font-bold text-sm hover:bg-slate-50 transition-all">
                Batal
            </a>
            <button form="form-user" type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                Simpan Data
            </button>
        </div>
    </div>

    <form id="form-user" action="<?= url_to('admin.user.store') ?>" method="POST" class="space-y-8">
        <?= csrf_field() ?>

        <!-- Section: Informasi Akun -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="account-info">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-xl font-bold">Informasi Akun</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">USERNAME <span class="text-red-500 text-xs">*</span></label>
                    <input name="username" value="<?= old('username') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Contoh: operator_smkn1" type="text" />
                    <?php if (session('errors.username')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.username') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">EMAIL <span class="text-red-500 text-xs">*</span></label>
                    <input name="email" value="<?= old('email') ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="nama@contoh.com" type="email" />
                    <?php if (session('errors.email')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.email') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">PASSWORD <span class="text-red-500 text-xs">*</span></label>
                    <input name="password" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Minimal 8 karakter" type="password" />
                    <?php if (session('errors.password')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.password') ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KONFIRMASI PASSWORD <span class="text-red-500 text-xs">*</span></label>
                    <input name="pass_confirm" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Ulangi password" type="password" />
                    <?php if (session('errors.pass_confirm')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.pass_confirm') ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Section: Role & Akses -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]" id="role-info">
            <div class="flex items-center gap-3 mb-8">
                <div>
                    <h2 class="text-xl font-bold">Role & Akses</h2>
                    <p class="text-sm text-muted-foreground mt-1">Tentukan peran pengguna ini di dalam sistem.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">ROLE <span class="text-red-500 text-xs">*</span></label>
                    <select name="role" id="role-select" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                        <option value="">-- Pilih Role --</option>
                        <option value="superadmin" <?= old('role') === 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
                        <option value="operator_dinas" <?= old('role') === 'operator_dinas' ? 'selected' : '' ?>>Operator Dinas</option>
                    </select>
                    <?php if (session('errors.role')): ?>
                        <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.role') ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Notice khusus operator sekolah -->
            <div id="operator-sekolah-notice" class="hidden mt-6 p-4 bg-amber-50 border border-amber-200 rounded-xl flex gap-3 items-start">
                <div class="text-amber-500 text-lg leading-none">&#9432;</div>
                <div>
                    <p class="text-sm font-bold text-amber-700">Penugasan sekolah belum dilakukan</p>
                    <p class="text-xs text-amber-600 mt-1">
                        Akun ini akan dibuat tanpa sekolah terkait terlebih dahulu. Silakan tautkan akun ke sekolah melalui menu
                        <span class="font-semibold">Edit Pengguna</span> setelah data sekolah tersedia.
                    </p>
                </div>
            </div>
        </section>
    </form>
</section>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>

<script>
    const roleSelect = document.getElementById('role-select');
    const operatorNote = document.getElementById('operator-sekolah-notice');

    function toggleOperatorNotice() {
        if (roleSelect.value === 'operator_sekolah') {
            operatorNote.classList.remove('hidden');
        } else {
            operatorNote.classList.add('hidden');
        }
    }

    roleSelect.addEventListener('change', toggleOperatorNotice);
    toggleOperatorNotice(); // jalankan saat load (untuk handle old('role'))
</script>
<?= $this->endSection() ?>