<?php
include '../database/koneksi.php';
session_start();
if ($_SESSION['role'] !== 'admin') { header("Location: ../auth.php"); exit; }

$majors = mysqli_query($koneksi, "SELECT * FROM majors ORDER BY id_jurusan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Jurusan - PILIH.in</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-slate-50 flex">
    <main class="flex-1 p-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-slate-800">Manajemen Jurusan</h1>
            <button class="bg-purple-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-purple-700 transition">
                + Tambah Jurusan
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="p-4 font-bold text-slate-600">ID</th>
                        <th class="p-4 font-bold text-slate-600">Nama Jurusan</th>
                        <th class="p-4 font-bold text-slate-600">Kategori</th>
                        <th class="p-4 font-bold text-slate-600 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($majors)): ?>
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                        <td class="p-4 text-slate-500">#<?= $row['id_jurusan'] ?></td>
                        <td class="p-4 font-bold text-slate-800"><?= $row['nama_jurusan'] ?></td>
                        <td class="p-4"><span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold"><?= $row['kategori_relevan'] ?></span></td>
                        <td class="p-4 text-center space-x-2">
                            <button class="text-indigo-600 font-bold text-sm">Edit</button>
                            <a href="process_crud.php?action=delete_major&id=<?= $row['id_jurusan'] ?>" 
                               onclick="return confirm('Yakin ingin menghapus jurusan ini? Data yang terhapus tidak bisa kembali.')"
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