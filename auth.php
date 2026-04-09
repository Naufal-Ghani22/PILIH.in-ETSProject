<?php
session_start();
// Jika user sudah login, langsung lempar ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentikasi - PILIH.in</title>
    <link href="./src/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans text-slate-800 min-h-screen flex items-center justify-center relative overflow-hidden">
    
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-secondary/20 rounded-full blur-3xl"></div>

    <div class="relative z-10 w-full max-w-md p-8 bg-white/70 backdrop-blur-lg border border-slate-200 rounded-3xl shadow-xl mx-4">
        <div class="text-center mb-8">
            <a href="index.php" class="font-bold text-3xl text-primary block tracking-tight mb-2">PILIH.in</a>
            <p class="text-slate-500 text-sm" id="form-subtitle">Masuk untuk menyimpan roadmap karirmu.</p>
        </div>

        <?php if(isset($_GET['error'])): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded-lg text-sm mb-4 text-center font-medium border border-red-200">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <form id="form-login" action="proses_auth.php" method="POST" class="space-y-5 block" onsubmit="return validasiLogin()">
            <input type="hidden" name="action" value="login">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" id="login-email" name="email" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" placeholder="contoh@email.com">
                <span id="err-login-email" class="text-red-500 text-xs hidden">Email tidak boleh kosong!</span>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" id="login-password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" placeholder="••••••••">
                <span id="err-login-pass" class="text-red-500 text-xs hidden">Password tidak boleh kosong!</span>
            </div>
            <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:opacity-90 transition shadow-lg shadow-primary/30">Masuk Sekarang</button>
            <p class="text-center text-sm text-slate-500 mt-4">Belum punya akun? <button type="button" onclick="toggleForm('register')" class="text-primary font-bold hover:underline">Daftar di sini</button></p>
        </form>

        <form id="form-register" action="proses_auth.php" method="POST" class="space-y-4 hidden" onsubmit="return validasiRegister()">
            <input type="hidden" name="action" value="register">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" id="reg-nama" name="nama_lengkap" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" placeholder="Nama sesuai ijazah">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" id="reg-email" name="email" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" placeholder="contoh@email.com">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" id="reg-password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" placeholder="Minimal 6 karakter">
            </div>
            <button type="submit" class="w-full bg-secondary text-white font-bold py-3 rounded-xl hover:opacity-90 transition shadow-lg shadow-secondary/30">Buat Akun</button>
            <p class="text-center text-sm text-slate-500 mt-4">Sudah punya akun? <button type="button" onclick="toggleForm('login')" class="text-primary font-bold hover:underline">Masuk</button></p>
        </form>
    </div>

    <script>
        function toggleForm(type) {
            const loginForm = document.getElementById('form-login');
            const regForm = document.getElementById('form-register');
            const subtitle = document.getElementById('form-subtitle');
            
            if(type === 'register') {
                loginForm.classList.add('hidden');
                regForm.classList.remove('hidden');
                subtitle.innerText = "Mulai petakan masa depanmu bersama kami.";
            } else {
                regForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
                subtitle.innerText = "Masuk untuk menyimpan roadmap karirmu.";
            }
        }

        function validasiLogin() {
            let valid = true;
            let email = document.getElementById('login-email').value;
            let pass = document.getElementById('login-password').value;
            
            if(email === "") { document.getElementById('err-login-email').classList.remove('hidden'); valid = false; }
            else { document.getElementById('err-login-email').classList.add('hidden'); }
            
            if(pass === "") { document.getElementById('err-login-pass').classList.remove('hidden'); valid = false; }
            else { document.getElementById('err-login-pass').classList.add('hidden'); }
            
            return valid;
        }
    </script>
</body>
</html>