<?php
// roadmap.php - Menampilkan timeline pembelajaran per semester

require_once 'database/koneksi.php';
$id_jurusan = isset($_GET['id_jurusan']) ? (int)$_GET['id_jurusan'] : 0; 

$jurusan = null;
$roadmap_data = [];

if ($id_jurusan !== 0) {
    // get jurusan
    $q_jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE id_jurusan = $id_jurusan");
    if(mysqli_num_rows($q_jurusan) > 0) {
        $jurusan = mysqli_fetch_assoc($q_jurusan);

        // get roadmap
        $q_roadmap = mysqli_query($koneksi, "SELECT * FROM roadmap WHERE id_jurusan = $id_jurusan ORDER BY semester ASC, kategori_matkul ASC");
        while ($row = mysqli_fetch_assoc($q_roadmap)) {
            $semester = $row['semester'];
            if (!isset($roadmap_data[$semester])) {
                $roadmap_data[$semester] = [];
            }
            $roadmap_data[$semester][] = [
                'nama_matkul' => $row['nama_matkul'],
                'kategori_matkul' => $row['kategori_matkul'],
                'skill_didapat' => $row['skill_didapat']
            ];
        }
    }
}
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($jurusan['nama_jurusan']) ?> - Roadmap - PILIH.in</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body class="bg-base font-sans text-slate-800">
    <?php include 'components/navbar.php'; ?>
    
    <main class="pt-16 pb-20 container mx-auto px-4 lg:px-12">
        <?php if(!$jurusan): ?>
            <div class="bg-white p-12 rounded-3xl shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center gap-4 my-20">
                <div class="text-6xl mb-4">🗺️</div>
                <h1 class="text-3xl font-bold text-slate-800">Roadmap Tidak Tersedia</h1>
                <p class="text-slate-500 max-w-lg mb-4">Kami tidak dapat menemukan roadmap untuk jurusan yang Anda cari. Silakan jelajahi katalog jurusan kami.</p>
                <div class="flex gap-4">
                    <a href="katalog_jurusan.php" class="px-6 py-3 bg-primary text-white font-semibold rounded-full hover:shadow-lg transition">Lihat Katalog Jurusan</a>
                </div>
            </div>
        <?php else: ?>
        
        <!-- Header -->
        <section class="mb-16">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4 gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-slate-800 mb-2">📚 <?= htmlspecialchars($jurusan['nama_jurusan']) ?></h1>
                    <p class="text-slate-600"><?= htmlspecialchars($jurusan['deskripsi_singkat']) ?></p>
                </div>
                <a href="katalog_jurusan.php" class="shrink-0 bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-2.5 rounded-xl font-semibold transition">Katalog Lainnya</a>
            </div>
        </section>

        <!-- Timeline Container -->
        <div class="relative mb-20">
            <!-- Vertical Line -->
            <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-primary to-secondary"></div>

            <!-- Timeline Semesters -->
            <div class="space-y-12">
                <?php foreach($roadmap_data as $semester => $matkuls): ?>
                    <div class="relative">
                        <!-- Connection Dot -->
                        <div class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-6">
                            <div class="w-6 h-6 bg-white border-4 border-primary rounded-full shadow-lg"></div>
                        </div>

                        <!-- Semester Card -->
                        <div class="lg:w-1/2 <?= $semester % 2 === 0 ? 'lg:ml-auto' : '' ?> bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition">
                            
                            <!-- Semester Header -->
                            <div class="flex items-center gap-3 mb-6">
                                <div class="bg-primary/10 text-primary font-bold text-xl w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                                    <?= $semester ?>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800">Semester <?= $semester ?></h3>
                                    <p class="text-xs text-slate-500"><?= $semester <= 4 ? 'Tahun ' . ceil($semester/2) . ' (Ganjil)' : 'Tahun ' . ceil($semester/2) . ' (Genap)' ?></p>
                                </div>
                            </div>

                            <!-- Courses List -->
                            <div class="space-y-3">
                                <?php foreach($matkuls as $matkul): ?>
                                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-100 hover:border-primary transition">
                                        <div class="flex items-start gap-3">
                                            <!-- Category Badge -->
                                            <div class="flex-shrink-0 mt-1">
                                                <?php if($matkul['kategori_matkul'] === 'Fondasi'): ?>
                                                    <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">🔷 Fondasi</span>
                                                <?php else: ?>
                                                    <span class="inline-block bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">🟢 Profesional</span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Course Details -->
                                            <div class="flex-1">
                                                <p class="font-semibold text-slate-800"><?= htmlspecialchars($matkul['nama_matkul']) ?></p>
                                                <p class="text-xs text-slate-600 mt-1">
                                                    <strong>Skill:</strong> <?= htmlspecialchars($matkul['skill_didapat'] ?? 'Skill tidak disebutkan') ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-2xl p-6 border border-slate-100">
                <div class="text-3xl mb-2">📖</div>
                <p class="font-bold text-slate-800">Total Semester</p>
                <p class="text-2xl text-primary font-bold"><?= count($roadmap_data) ?></p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100">
                <div class="text-3xl mb-2">📚</div>
                <p class="font-bold text-slate-800">Total Mata Kuliah</p>
                <p class="text-2xl text-primary font-bold"><?= array_sum(array_map('count', $roadmap_data)) ?></p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100">
                <div class="text-3xl mb-2">🎯</div>
                <p class="font-bold text-slate-800">Kompetensi Inti</p>
                <p class="text-sm text-slate-600 mt-2">Fondasi + Profesional</p>
            </div>
        </div>

        <!-- Action Section -->
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 border border-primary/20 rounded-2xl p-8 text-center">
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Siap Memulai Perjalanan? 🚀</h3>
            <p class="text-slate-600 mb-6">Daftar ke kampus pilihan dan mulai belajar dengan roadmap yang telah kami siapkan.</p>
            <button onclick="alert('Fitur pencarian kampus akan segera hadir!')" class="inline-block bg-primary text-white font-bold py-3 px-8 rounded-xl hover:opacity-90 transition shadow-lg shadow-primary/30 cursor-pointer">
                Cari Kampus Terbaik
            </button>
        </div>
        
        <?php endif; ?>

    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>
