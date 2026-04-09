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

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8">
            <a href="kampus.php" class="text-slate-600 hover:text-purple-700 font-semibold text-sm transition">Eksplorasi Kampus</a>
            <a href="katalog_jurusan.php" class="text-slate-600 hover:text-purple-700 font-semibold text-sm transition">Katalog Jurusan</a>
        </div>

        <div class="flex items-center gap-3">
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="relative">
                    <button onclick="document.getElementById('profileDropdown').classList.toggle('hidden')" class="flex items-center gap-3 bg-white/80 border border-purple-100 px-4 py-2 rounded-2xl hover:shadow-md transition cursor-pointer">
                        <div class="w-8 h-8 bg-gradient-to-tr from-purple-600 to-indigo-500 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md">
                            <?= strtoupper(substr($_SESSION['nama_lengkap'] ?? 'U', 0, 1)) ?>
                        </div>
                        <span class="hidden md:block text-sm font-bold text-slate-700">
                            <?= htmlspecialchars(explode(' ', $_SESSION['nama_lengkap'] ?? 'User')[0]) ?>
                        </span>
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <!-- Dropdown -->
                    <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-2xl shadow-xl overflow-hidden py-2">
                        <a href="dashboard.php" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">👤 Dashboard Saya</a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">🚪 Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="auth.php" class="hidden md:block text-sm font-bold text-slate-600 hover:text-purple-700 transition mr-2">Login</a>
                <a href="tes.php" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-purple-700 transition shadow-lg">
                    Mulai Tes
                </a>
            <?php endif; ?>

            <!-- Mobile Menu Toggle -->
            <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="md:hidden ml-2 text-slate-600 hover:text-purple-700 focus:outline-none cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Container -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-slate-100">
        <div class="px-4 pt-2 pb-4 space-y-1 shadow-inner">
            <a href="kampus.php" class="block px-3 py-3 rounded-xl text-base font-medium text-slate-700 hover:bg-purple-50">Eksplorasi Kampus</a>
            <a href="katalog_jurusan.php" class="block px-3 py-3 rounded-xl text-base font-medium text-slate-700 hover:bg-purple-50">Katalog Jurusan</a>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="auth.php" class="block px-3 py-3 rounded-xl text-base font-medium text-purple-600 hover:bg-purple-50">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="pt-20"></div>

<!-- Close dropdown when clicking outside -->
<script>
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('profileDropdown');
        var button = dropdown?.previousElementSibling;
        if (dropdown && button && !dropdown.contains(event.target) && !button.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>