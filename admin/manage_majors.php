<?php
include '../database/koneksi.php';
session_start();
if ($_SESSION['role'] !== 'admin') { header("Location: ../auth.php"); exit; }

$majors = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY id_jurusan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Jurusan - PILIH.in</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-slate-50 flex min-h-screen relative">
    
    <aside class="w-64 bg-slate-900 text-white p-6 z-10">
        <h2 class="text-2xl font-bold mb-8">PILIH.in <span class="text-purple-400 text-sm">Admin</span></h2>
        <nav class="space-y-2">
            <a href="dashboard.php"           class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">Dashboard</a>
            <a href="manage_majors.php"       class="block px-3 py-2 rounded-lg bg-slate-700 text-purple-400 font-bold">Kelola Jurusan</a>
            <a href="manage_campuses.php"     class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">Kelola Kampus</a>
            <a href="manage_prodi_kampus.php" class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">📌 Prodi per Kampus</a>
            <hr class="border-slate-700 my-2">
            <a href="../logout.php"           class="block px-3 py-2 rounded-lg text-red-400 hover:bg-slate-700 transition">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-10 z-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-slate-800">Manajemen Jurusan</h1>
            <button onclick="toggleModal('modalTambah')" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2.5 rounded-xl font-bold hover:shadow-lg hover:shadow-purple-500/30 hover:-translate-y-0.5 transition duration-300">
                + Tambah Jurusan
            </button>
        </div>

        <?php if(isset($_GET['success'])): ?>
            <div class="bg-emerald-50 text-emerald-600 p-4 rounded-2xl font-bold mb-6 border border-emerald-100 shadow-sm flex items-center justify-between">
                <span>✅ <?= htmlspecialchars($_GET['success']) ?></span>
                <a href="manage_majors.php" class="text-emerald-800 hover:text-emerald-900">✖</a>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="p-4 font-bold text-slate-600">ID</th>
                        <th class="p-4 font-bold text-slate-600">Nama Jurusan</th>
                        <th class="p-4 font-bold text-slate-600">Kategori Minat</th>
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
                            <button class="text-indigo-600 font-bold text-sm hover:underline">Edit</button>
                            <a href="process_crud.php?action=delete_major&id=<?= $row['id_jurusan'] ?>" 
                               onclick="return confirm('Yakin ingin menghapus jurusan ini?')"
                               class="text-red-500 font-bold text-sm hover:underline">Hapus</a>
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
                <h2 class="text-2xl font-extrabold text-slate-800">Tambah Jurusan Baru</h2>
                <button onclick="toggleModal('modalTambah')" class="text-slate-400 hover:text-red-500 text-2xl font-bold transition">&times;</button>
            </div>

            <form action="process_crud.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition font-medium" placeholder="Contoh: Sistem Informasi">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Kategori Minat (Penghubung Tes)</label>
                    <input type="text" name="kategori_relevan" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition font-medium" placeholder="Contoh: Teknologi / Bisnis / Seni">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" rows="3" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition font-medium resize-none" placeholder="Tuliskan prospek singkat jurusan ini..."></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="toggleModal('modalTambah')" class="w-1/3 bg-slate-100 text-slate-600 font-bold py-3.5 rounded-xl hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" name="submit_tambah_jurusan" class="w-2/3 bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-purple-700 shadow-lg transition">Simpan Jurusan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            const content = document.getElementById('modalContent');
            
            if (modal.classList.contains('hidden')) {
                // Buka Modal
                modal.classList.remove('hidden');
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                // Tutup Modal
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300); // Tunggu animasi selesai baru di-hidden
            }
        }
    </script>
</body>
</html>