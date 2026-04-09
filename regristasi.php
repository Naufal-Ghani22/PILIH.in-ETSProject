<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Color -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E40AF',
                        secondary: '#0EA5E9'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-r from-primary to-secondary min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-96">

        <h2 class="text-2xl font-bold text-center mb-6 text-primary">
            Registrasi Akun
        </h2>

        <form action="proses_register.php" method="POST" class="space-y-4">

            <!-- Nama Lengkap -->
            <input 
                type="text" 
                name="nama_lengkap"
                placeholder="Nama Lengkap"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"
            />

            <!-- Email -->
            <input 
                type="email" 
                name="email"
                placeholder="Email"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"
            />

            <!-- Password -->
            <input 
                type="password" 
                name="password"
                placeholder="Password"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"
            />

            <!-- Konfirmasi Password -->
            <input 
                type="password" 
                name="confirm_password"
                placeholder="Konfirmasi Password"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"
            />

            <!-- Asal Sekolah -->
            <input 
                type="text" 
                name="asal_sekolah"
                placeholder="Asal Sekolah"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"
            />

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-900 transition duration-300 font-semibold"
            >
                Daftar Sekarang
            </button>
        </form>

        <!-- Link Login -->
        <p class="text-sm text-center mt-4 text-gray-600">
            Sudah punya akun?
            <a href="login.php" class="text-secondary hover:underline">Login</a>
        </p>

    </div>

</body>
</html>