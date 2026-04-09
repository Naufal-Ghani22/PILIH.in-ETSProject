<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="bg-white/60 backdrop-blur-xl border-b border-white/40 fixed top-0 left-0 right-0 z-50 shadow-sm">
    <div class="container mx-auto px-4 lg:px-12 py-3 flex items-center justify-between">
        
        <a href="index.php" class="hover:opacity-80 transition hover:scale-105 duration-300">
            <img src="img/LOGO PILIH.IN-02.png" alt="PILIH.in Logo" class="h-10 w-auto object-contain rounded-lg">
        </a>

        <div class="hidden md:flex items-center gap-8">
            <a href="kampus.php" class="text-slate-600 hover:text-purple-700 font-semibold text-sm transition">Eksplorasi Kampus</a>
            <a href="roadmap.php" class="text-slate-600 hover:text-purple-700 font-semibold text-sm transition">Roadmap Karir</a>
        </div>

        <div class="flex items-center gap-3">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="flex items-center gap-3 bg-white/80 border border-purple-100 px-4 py-2 rounded-2xl hover:shadow-md transition">
                    <div class="w-8 h-8 bg-gradient-to-tr from-purple-600 to-indigo-500 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md">
                        <?= strtoupper(substr($_SESSION['nama_lengkap'] ?? 'U', 0, 1)) ?>
                    </div>
                    <span class="hidden md:block text-sm font-bold text-slate-700">
                        <?= htmlspecialchars(explode(' ', $_SESSION['nama_lengkap'] ?? 'User')[0]) ?>
                    </span>
                </a>
            <?php else: ?>
                <a href="auth.php" class="text-sm font-bold text-slate-600 hover:text-purple-700 transition mr-2">Login</a>
                <a href="tes.php" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-purple-700 transition shadow-lg">
                    Mulai Tes
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="pt-20"></div>