<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun</title>

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

<body class="bg-linear-to-r from-primary to-secondary min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-80">
        
        <h3 class="text-2xl font-bold text-center mb-6 text-primary">
            LOGIN AKUN
        </h3>

        <form action="proses_login.php" method="POST" class="space-y-4">
            
            <input 
                type="text" 
                name="username" 
                placeholder="Username"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"
            />

            <input 
                type="password" 
                name="password" 
                placeholder="Password"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary"
            />

            <button 
                type="submit"
                class="w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-900 transition duration-300 font-semibold"
            >
                Masuk Sekarang
            </button>
        </form>

        <p class="text-sm text-center mt-4 text-gray-600">
            Belum punya akun? 
            <a href="#" class="text-secondary hover:underline">Daftar</a>
        </p>

    </div>

</body>
</html>