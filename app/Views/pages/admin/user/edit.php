<?= $this->extend('layouts/admin-dashboard') ?>
<?= $this->section('content') ?>
<section class="flex-1 overflow-y-auto p-8 space-y-8">
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-extrabold text-foreground">Edit Pengguna</h1>
            <p class="text-sm font-medium text-muted-foreground mt-1">Perbarui informasi akun pengguna.</p>
        </div>
        <div class="flex gap-3">
            <a href="<?= url_to('admin.user') ?>" class="px-6 py-2.5 rounded-xl border border-border text-slate-600 font-bold text-sm hover:bg-slate-50 transition-all">
                Batal
            </a>
            <?php if ($role !== 'operator_sekolah'): ?>
                <button form="form-user" type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                    Simpan Perubahan
                </button>
            <?php endif; ?>
        </div>
    </div>

    <?php if (session('success')): ?>
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm font-medium text-green-700">
            <?= session('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session('error')): ?>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm font-medium text-red-700">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <?php if ($role === 'operator_sekolah'): ?>

        <!-- ============================================= -->
        <!-- TAMPILAN KHUSUS OPERATOR SEKOLAH (READ-ONLY)   -->
        <!-- ============================================= -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] space-y-6">
            <div>
                <h2 class="text-xl font-bold">Informasi Akun Operator Sekolah</h2>
                <p class="text-sm text-muted-foreground mt-1">Akun ini dibuat otomatis dan terikat pada satu sekolah.</p>
            </div>

            <!-- Sekolah terkait -->
            <div class="bg-slate-50 border border-border rounded-xl p-4">
                <p class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-1">SEKOLAH TERKAIT</p>
                <p class="text-sm font-bold"><?= esc($sekolah['nama_sekolah'] ?? '-') ?></p>
                <p class="text-xs text-slate-400">NPSN: <?= esc($sekolah['npsn'] ?? '-') ?> · <?= esc($sekolah['jenjang'] ?? '-') ?></p>
            </div>

            <!-- Username & Email (read-only) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">USERNAME</label>
                    <input value="<?= esc($user->username) ?>" disabled class="w-full bg-slate-100 border-border rounded-xl p-3 text-sm font-medium text-slate-500 cursor-not-allowed" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">EMAIL SAAT INI</label>
                    <input value="<?= esc($email) ?>" disabled class="w-full bg-slate-100 border-border rounded-xl p-3 text-sm font-medium text-slate-500 cursor-not-allowed" />
                </div>
            </div>

            <!-- Status profil -->
            <div class="p-4 rounded-xl <?= $mustUpdate ? 'bg-amber-50 border border-amber-200' : 'bg-green-50 border border-green-200' ?>">
                <p class="text-sm font-bold <?= $mustUpdate ? 'text-amber-700' : 'text-green-700' ?>">
                    <?= $mustUpdate
                        ? 'Operator belum mengganti email & password dari kondisi default.'
                        : 'Operator sudah memperbarui email & password sendiri.' ?>
                </p>
            </div>

            <!-- Aksi reset -->
            <div class="border-t border-border pt-6">
                <p class="text-sm font-bold text-slate-700 mb-1">Reset Akun ke Default</p>
                <p class="text-xs text-muted-foreground mb-4">
                    Email akan dikembalikan ke <span class="font-mono"><?= esc($defaultEmail) ?></span> dan password
                    akan dikembalikan ke NPSN sekolah (<span class="font-mono"><?= esc($sekolah['npsn'] ?? '-') ?></span>).
                    Gunakan ini jika operator lupa kredensial.
                </p>
                <form action="<?= url_to('admin.user.resetDefault', $user->id) ?>" method="POST" onsubmit="return confirm('Yakin reset akun ini ke kredensial default? Email & password saat ini akan diganti.')">
                    <?= csrf_field() ?>
                    <button type="submit" class="px-6 py-2.5 rounded-xl border border-red-200 text-red-600 font-bold text-sm hover:bg-red-50 transition-all">
                        Reset ke Default
                    </button>
                </form>
            </div>
        </section>

    <?php else: ?>

        <!-- ============================================= -->
        <!-- FORM EDIT NORMAL (SUPERADMIN / OPERATOR DINAS) -->
        <!-- ============================================= -->
        <form id="form-user" action="<?= url_to('admin.user.update', $user->id) ?>" method="POST" class="space-y-8">
            <?= csrf_field() ?>

            <section class="bg-white/80 backdrop-blur-md border border-white/30 p-8 rounded-[2rem] shadow-[0_8px_32px_0_rgba(31,38,135,0.07)]">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-xl font-bold">Informasi Akun</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">USERNAME <span class="text-red-500 text-xs">*</span></label>
                        <input name="username" value="<?= old('username', $user->username) ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" type="text" />
                        <?php if (session('errors.username')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.username') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">EMAIL <span class="text-red-500 text-xs">*</span></label>
                        <input name="email" value="<?= old('email', $email) ?>" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" type="email" />
                        <?php if (session('errors.email')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.email') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">PASSWORD BARU</label>
                        <input name="password" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Kosongkan jika tidak diubah" type="password" />
                        <?php if (session('errors.password')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.password') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">KONFIRMASI PASSWORD BARU</label>
                        <input name="pass_confirm" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all" placeholder="Ulangi password baru" type="password" />
                        <?php if (session('errors.pass_confirm')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.pass_confirm') ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2">ROLE <span class="text-red-500 text-xs">*</span></label>
                        <select name="role" class="w-full bg-slate-50 border-border rounded-xl p-3 text-sm font-medium focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all">
                            <option value="superadmin" <?= old('role', $role) === 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
                            <option value="operator_dinas" <?= old('role', $role) === 'operator_dinas' ? 'selected' : '' ?>>Operator Dinas</option>
                        </select>
                        <?php if (session('errors.role')): ?>
                            <p class="mt-1 text-xs text-red-500 font-medium"><?= session('errors.role') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </form>

    <?php endif; ?>
</section>
<?= $this->endSection() ?>