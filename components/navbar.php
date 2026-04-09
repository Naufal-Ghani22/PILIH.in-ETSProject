<?php
// Validasi session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-lg border-b border-slate-100 z-50 shadow-sm">
    <div class="container mx-auto px-4 lg:px-12 py-4 flex items-center justify-between">
        <a href="dashboard.php" class="font-bold text-2xl text-primary tracking-tight hover:opacity-80 transition">
            PILIH.in
        </a>
        
        <div class="flex items-center gap-6">
            <?php if(isset($_SESSION['user_id'])): ?>
                <span class="text-sm text-slate-600">Halo, <strong><?= htmlspecialchars(substr($_SESSION['nama_lengkap'] ?? 'User', 0, 15)) ?></strong></span>
                <a href="logout.php" class="text-sm font-semibold text-red-600 hover:text-red-700 transition">Logout</a>
            <?php else: ?>
                <a href="auth.php" class="text-sm font-semibold text-primary hover:text-primary/80 transition">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
