<?php
include '../database/koneksi.php';
session_start();

// Keamanan: Hanya Admin yang boleh masuk
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../auth.php?error=Akses ditolak!");
    exit;
}

// Ambil statistik data
$count_users = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_user FROM users WHERE role = 'user'"));
$count_majors = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_jurusan FROM jurusan"));
$count_campuses = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_kampus FROM kampus"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - PILIH.in</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white p-6">
            <h2 class="text-2xl font-bold mb-8">PILIH.in <span class="text-purple-400 text-sm">Admin</span></h2>
            <nav class="space-y-4">
                <a href="dashboard.php" class="block py-2 text-purple-400 font-bold">Dashboard</a>
                <a href="manage_majors.php" class="block py-2 hover:text-purple-400 transition">Kelola Jurusan</a>
                <a href="manage_campuses.php" class="block py-2 hover:text-purple-400 transition">Kelola Kampus</a>
                <hr class="border-slate-700">
                <a href="../logout.php" class="block py-2 text-red-400">Logout</a>
            </nav>
        </aside>

        <main class="flex-1 p-10">
            <h1 class="text-3xl font-extrabold text-slate-800 mb-8">Ringkasan Sistem</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Total Siswa</p>
                    <h3 class="text-4xl font-black mt-2 text-slate-900"><?= $count_users ?></h3>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Data Jurusan</p>
                    <h3 class="text-4xl font-black mt-2 text-purple-600"><?= $count_majors ?></h3>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Data Kampus</p>
                    <h3 class="text-4xl font-black mt-2 text-indigo-600"><?= $count_campuses ?></h3>
                </div>
            </div>
        </main>
    </div>
</body>
</html>