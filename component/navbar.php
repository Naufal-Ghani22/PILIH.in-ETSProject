<?php
// Mencegah error jika session belum dimulai di file utama
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="bg-white/95 backdrop-blur-sm border-b border-slate-100 fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4 lg:px-12 py-3 flex items-center justify-between">
        
        <a href="index.php" class="flex items-center gap-1 hover:opacity-90 transition">
            <span class="font-bold text-2xl tracking-tighter" style="color: #1E40AF;">PILIH</span>
            <div class="relative font-bold text-2xl tracking-tighter" style="color: #0EA5E9;">
                <span class="absolute top-[-3px] left-[1px] text-xs" style="color: #EF4444;">●</span>
                <span>in</span>
            </div>
        </a>

        <div class="hidden md:flex items-center gap-8">
            <a href="kampus.php" class="text-slate-700 hover:text-blue-800 font-medium text-sm flex items-center gap-1.5 transition">
                <span>🏫</span> Eksplorasi Kampus
            </a>
            <a href="roadmap.php" class="text-slate-700 hover:text-blue-800 font-medium text-sm flex items-center gap-1.5 transition">
                <span>🧭</span> Roadmap Karir
            </a>
            <a href="tentang.php" class="text-slate-700 hover:text-blue-800 font-medium text-sm transition hover:scale-105">
                Tentang Kami
            </a>
        </div>

        <div class="flex items-center gap-3">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="flex items-center gap-3 bg-slate-50 border border-slate-100 px-4 py-2 rounded-xl hover:shadow-md transition">
                    <div class="w-9 h-9 flex items-center justify-center rounded-full text-white font-bold text-sm shadow-md" style="background-color: #0EA5E9;">
                        <?= strtoupper(substr($_SESSION['nama_lengkap'] ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="hidden md:block text-left">
                        <span class="block text-xs text-slate-400">Selamat datang,</span>
                        <span class="block text-sm font-semibold text-slate-800 -mt-0.5">
                            <?= htmlspecialchars(explode(' ', $_SESSION['nama_lengkap'] ?? 'User')[0]) ?>
                        </span>
                    </div>
                </a>
            <?php else: ?>
                <a href="auth.php" class="text-sm font-semibold hover:opacity-80 transition" style="color: #1E40AF;">Login</a>
                <a href="tes.php" class="text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition hover:-translate-y-0.5 shadow-lg shadow-sky-500/20" style="background-color: #0EA5E9;">
                    Mulai Tes Sekarang
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="pt-20"></div>