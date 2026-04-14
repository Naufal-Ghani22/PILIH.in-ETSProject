<?php
session_start();
// Jika user sudah login, langsung lempar ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
$redirect = htmlspecialchars($_GET['redirect'] ?? 'dashboard.php');
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

<body
    class="bg-slate-50 font-sans text-slate-800 min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-secondary/20 rounded-full blur-3xl"></div>

    <div
        class="relative z-10 w-full max-w-md p-8 bg-white/70 backdrop-blur-lg border border-slate-200 rounded-3xl shadow-xl mx-4">
        <div class="text-center mb-8">
            <a href="index.php" class="font-bold text-3xl text-primary block tracking-tight mb-2">PILIH.in</a>
            <p class="text-slate-500 text-sm" id="form-subtitle">Masuk untuk menyimpan roadmap karirmu.</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded-lg text-sm mb-4 text-center font-medium border border-red-200">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <form id="form-login" action="proses_auth.php" method="POST" class="space-y-5 block"
            onsubmit="return validasiLogin()">
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="redirect" value="<?= $redirect ?>">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" id="login-email" name="email"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="contoh@email.com">
                <span id="err-login-email" class="text-red-500 text-xs hidden">Email tidak boleh kosong!</span>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" id="login-password" name="password"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="••••••••">
                <span id="err-login-pass" class="text-red-500 text-xs hidden">Password tidak boleh kosong!</span>
            </div>
            <button type="submit"
                class="w-full bg-purple-600 text-white font-bold py-3 rounded-xl hover:opacity-90 transition shadow-lg shadow-purple-600/30">Masuk
                Sekarang</button>
            <p class="text-center text-sm text-slate-500 mt-4">Belum punya akun? <button type="button"
                    onclick="toggleForm('register')" class="text-purple-600 font-bold hover:underline">Daftar di
                    sini</button></p>
        </form>

        <form id="form-register" action="proses_auth.php" method="POST" class="space-y-4 hidden"
            onsubmit="return validasiRegister()">
            <input type="hidden" name="action" value="register">
            <input type="hidden" name="redirect" value="<?= $redirect ?>">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" id="reg-nama" name="nama_lengkap"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="Nama sesuai ijazah">
                <span id="err-reg-nama" class="text-red-500 text-xs hidden">Nama lengkap tidak boleh kosong!</span>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" id="reg-email" name="email"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="contoh@email.com">
                <span id="err-reg-email" class="text-red-500 text-xs hidden">Email tidak boleh kosong!</span>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" id="reg-password" name="password"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="Minimal 8 karakter">
                <span id="err-reg-pass" class="text-red-500 text-xs hidden">Password minimal 8 karakter!</span>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Asal Sekolah</label>
                <input type="text" id="reg-asal_sekolah" name="asal_sekolah"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="SMAN 2 Bojonegoro">
                <span id="err-reg-asal_sekolah" class="text-red-500 text-xs hidden">Masukkan asal sekolahmu</span>
            </div>
            <button type="submit"
                class="w-full bg-purple-600 text-white font-bold py-3 rounded-xl hover:opacity-90 transition shadow-lg shadow-purple-600/30">Buat
                Akun</button>
            <p class="text-center text-sm text-slate-500 mt-4">Sudah punya akun? <button type="button"
                    onclick="toggleForm('login')" class="text-purple-600 font-bold hover:underline">Masuk</button></p>
        </form>
    </div>

    <script>
        function toggleForm(type) {
            const loginForm = document.getElementById('form-login');
            const regForm = document.getElementById('form-register');
            const subtitle = document.getElementById('form-subtitle');

            if (type === 'register') {
                loginForm.classList.add('hidden');
                regForm.classList.remove('hidden');
                subtitle.innerText = "Mulai petakan masa depanmu bersama kami.";
            } else {
                regForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
                subtitle.innerText = "Masuk untuk menyimpan roadmap karirmu.";
            }
        }

        function validasiRegister() {
            let valid = true;
            let nama = document.getElementById('reg-nama').value;
            let email = document.getElementById('reg-email').value;
            let pass = document.getElementById('reg-password').value;
            let sekolah = document.getElementById('reg-asal_sekolah').value; // Tambahkan ini

            if (nama === "") { document.getElementById('err-reg-nama').classList.remove('hidden'); valid = false; }
            else { document.getElementById('err-reg-nama').classList.add('hidden'); }

            if (email === "") { document.getElementById('err-reg-email').classList.remove('hidden'); valid = false; }
            else { document.getElementById('err-reg-email').classList.add('hidden'); }

            if (pass === "" || pass.length < 8) { document.getElementById('err-reg-pass').classList.remove('hidden'); valid = false; }
            else { document.getElementById('err-reg-pass').classList.add('hidden'); }

            // Tambahkan validasi sekolah di sini
            if (sekolah === "") { document.getElementById('err-reg-asal_sekolah').classList.remove('hidden'); valid = false; }
            else { document.getElementById('err-reg-asal_sekolah').classList.add('hidden'); }

            return valid;
        }
    </script>
</body>

</html>