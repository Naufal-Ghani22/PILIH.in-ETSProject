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
            <button onclick="toggleModal('modalTambah')" class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-indigo-700 transition">
                + Tambah Kampus
            </button>
        </div>

        <?php if(isset($_GET['success'])): ?>
            <div class="bg-emerald-100 text-emerald-700 p-4 rounded-xl font-bold mb-6 flex justify-between">
                <span>✅ <?= htmlspecialchars($_GET['success']) ?></span>
                <a href="manage_campuses.php" class="text-emerald-800 hover:text-emerald-900">✖</a>
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

    <div id="modalTambah" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="toggleModal('modalTambah')"></div>
        
        <div class="relative bg-white w-full max-w-lg rounded-[2rem] shadow-2xl p-8 transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
            
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-slate-800">Tambah Kampus Baru</h2>
                <button onclick="toggleModal('modalTambah')" class="text-slate-400 hover:text-red-500 text-2xl font-bold transition">&times;</button>
            </div>

            <form action="process_crud.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Nama Kampus</label>
                    <input type="text" name="nama_kampus" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition font-medium" placeholder="Contoh: Universitas Indonesia">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Lokasi</label>
                    <input type="text" name="lokasi" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition font-medium" placeholder="Contoh: Depok, Jawa Barat">
                </div>
                
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Akreditasi</label>
                        <select name="akreditasi" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 outline-none">
                            <option value="Unggul">Unggul</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="Baik Sekali">Baik Sekali</option>
                            <option value="Baik">Baik</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Estimasi UKT/SMT</label>
                        <input type="text" name="estimasi_biaya" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition font-medium" placeholder="Contoh: Rp 3.000.000">
                    </div>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="toggleModal('modalTambah')" class="w-1/3 bg-slate-100 text-slate-600 font-bold py-3.5 rounded-xl hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" name="submit_tambah_kampus" class="w-2/3 bg-indigo-600 text-white font-bold py-3.5 rounded-xl hover:bg-indigo-700 shadow-lg transition">Simpan Kampus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            const content = document.getElementById('modalContent');
            
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }
    </script>
</body>
</html>