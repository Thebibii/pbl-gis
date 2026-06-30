<?= $this->extend('layouts/operator-sekolah') ?>

<?= $this->section('content') ?>
<section class="flex-1 p-8 space-y-8">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Page Header -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex gap-2 text-[10px] font-bold uppercase tracking-widest text-muted-foreground opacity-50 mb-2">
                    <span class="hover:text-primary cursor-pointer">Operator</span><span>/</span>
                    <span class="text-primary">Account Settings</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-foreground tracking-tight">Account Settings</h1>
                <p class="text-sm font-medium text-muted-foreground">
                    Kelola keamanan akun dan ubah password Anda secara berkala.
                </p>
            </div>
        </header>

        <!-- Password Change Form Card -->
        <section class="bg-white/80 backdrop-blur-md border border-white/30 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] p-8">
            <div class="flex items-center gap-2 mb-6 border-b border-border pb-4">
                <span class="material-symbols-outlined text-primary">lock</span>
                <h3 class="text-lg font-extrabold text-foreground">Ubah Password</h3>
            </div>

                <!-- Old Password -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2" for="old-password">
                        Password Lama <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">lock</span>
                        <input
                            class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                            id="old-password" name="old_password" type="password"
                            placeholder="Masukkan password lama" required>
                    </div>
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2" for="new-password">
                        Password Baru <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">vpn_key</span>
                        <input
                            class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                            id="new-password" name="new_password" type="password" minlength="8"
                            placeholder="Masukkan password baru" required>
                    </div>
                    <p class="mt-2 text-xs font-medium text-muted-foreground flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">info</span>
                        Minimal 8 karakter.
                    </p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-muted-foreground mb-2" for="confirm-password">
                        Konfirmasi Password <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">check_circle</span>
                        <input
                            class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 focus:bg-white outline-none transition-all"
                            id="confirm-password" name="new_password_confirm" type="password"
                            placeholder="Ulangi password baru" required>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-6 border-t border-border flex justify-end gap-3 mt-8">
                    <button type="button" onclick="window.location.reload()"
                        class="px-6 py-2.5 rounded-xl border border-border text-sm font-bold text-foreground hover:bg-slate-50 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </section>

    </div>
</section>
<?= $this->endSection() ?>