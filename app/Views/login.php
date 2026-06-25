<?= $this->extend('layouts/login-layout') ?>
<?= $this->section('content') ?>

<main class="flex-grow h-screen flex items-center justify-center p-6 relative z-10">
    <div class="w-full max-w-[440px] login-card glass-effect rounded-3xl p-8 md:p-12 shadow-2xl shadow-primary/5">

        <div class="text-center mb-10">
            <h1 class="font-headline text-3xl font-bold tracking-tight text-foreground mb-3">
                Selamat Datang
            </h1>
            <p class="text-sm text-muted-foreground leading-relaxed">
                Silakan masuk ke akun SiGIS Sekolah Anda untuk mengelola data geospasial.
            </p>
        </div>

        <?php if (session('error') !== null) : ?>
            <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-600">
                <?= session('error') ?>
            </div>
        <?php endif ?>

        <?php if (session('message') !== null) : ?>
            <div class="mb-4 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-600">
                <?= session('message') ?>
            </div>
        <?php endif ?>

        <form action="<?= url_to('login') ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>

            <!-- INPUT EMAIL -->
            <div class="space-y-2">
                <label
                    class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground px-1"
                    for="email">
                    Email
                </label>

                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">
                            alternate_email
                        </span>
                    </div>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="<?= old('email') ?>"
                        required
                        placeholder="user@sekolah.sch.id"
                        class="w-full pl-12 pr-4 py-4 bg-muted/30 border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-all text-sm font-medium placeholder:text-muted-foreground/60 border-transparent">
                </div>

                <!-- Tampilan Error Email Spesifik -->
                <?php if (session('errors.email')) : ?>
                    <p class="text-xs text-red-500 mt-1 px-1">
                        <?= session('errors.email') ?>
                    </p>
                <?php endif ?>
            </div>

            <!-- INPUT KATA SANDI -->
            <div class="space-y-2">
                <label
                    class="text-[10px] font-bold uppercase tracking-widest text-muted-foreground px-1"
                    for="password">
                    Kata Sandi
                </label>

                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">
                            lock
                        </span>
                    </div>

                    <input
                        id="password"
                        name="password"
                        required
                        type="password"
                        placeholder="••••••••"
                        class="w-full pl-12 pr-12 py-4 bg-muted/30 border rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-all text-sm font-medium placeholder:text-muted-foreground/60 border-transparent ?>">

                    <button
                        type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-muted-foreground hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]" id="password-toggle-icon">
                            visibility
                        </span>
                    </button>
                </div>

                <!-- Tampilan Error Password Spesifik -->
                <?php if (session('errors.password')) : ?>
                    <p class="text-xs text-red-500 mt-1 px-1">
                        <?= session('errors.password') ?>
                    </p>
                <?php endif ?>
            </div>

            <?php if (setting('Auth.sessionConfig')['allowRemembering'] ?? false) : ?>
                <div class="flex items-center">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-border text-primary">
                        <span class="text-xs text-muted-foreground">
                            Ingat saya
                        </span>
                    </label>
                </div>
            <?php endif ?>

            <button
                type="submit"
                class="w-full py-4 bg-primary text-primary-foreground rounded-2xl font-bold shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3 uppercase text-xs tracking-widest mt-2">
                <span>Masuk Sekarang</span>
                <span class="material-symbols-outlined text-[18px]">login</span>
            </button>

        </form>
    </div>
</main>

<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('password-toggle-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.textContent = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            toggleIcon.textContent = 'visibility';
        }
    }
</script>
<?= $this->endSection(); ?>