<?php
include '../database/koneksi.php';
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { 
    header("Location: ../auth.php"); 
    exit; 
}

$campuses = mysqli_query($koneksi, "SELECT * FROM kampus ORDER BY id_kampus DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kampus - PILIH.in Admin</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-slate-50 flex min-h-screen">
    
    <aside class="w-64 bg-slate-900 text-white p-6">
        <h2 class="text-2xl font-bold mb-8">PILIH.in <span class="text-purple-400 text-sm">Admin</span></h2>
        <nav class="space-y-4">
            <a href="dashboard.php" class="block py-2 hover:text-purple-400 transition">Dashboard</a>
            <a href="manage_majors.php" class="block py-2 hover:text-purple-400 transition">Kelola Jurusan</a>
            <a href="manage_campuses.php" class="block py-2 text-purple-400 font-bold">Kelola Kampus</a>
            <hr class="border-slate-700">
            <a href="../logout.php" class="block py-2 text-red-400">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-slate-800">Manajemen Kampus</h1>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-indigo-700 transition">
                + Tambah Kampus
            </button>
        </div>

        <?php if(isset($_GET['success'])): ?>
            <div class="bg-emerald-100 text-emerald-700 p-4 rounded-xl font-bold mb-6">
                ✅ <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="p-4 font-bold text-slate-600">ID</th>
                        <th class="p-4 font-bold text-slate-600">Nama Kampus</th>
                        <th class="p-4 font-bold text-slate-600">Akreditasi</th>
                        <th class="p-4 font-bold text-slate-600 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($campuses)): ?>
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                        <td class="p-4 text-slate-500">#<?= $row['id_kampus'] ?></td>
                        <td class="p-4 font-bold text-slate-800"><?= $row['nama_kampus'] ?></td>
                        <td class="p-4">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                <?= $row['akreditasi'] ?>
                            </span>
                        </td>
                        <td class="p-4 text-center space-x-3">
                            <button class="text-indigo-600 font-bold text-sm">Edit</button>
                            <a href="process_crud.php?action=delete_campus&id=<?= $row['id_kampus'] ?>" 
                               onclick="return confirm('Hapus kampus ini dari sistem?')"
                               class="text-red-500 font-bold text-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>