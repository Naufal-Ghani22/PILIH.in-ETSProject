<?php
session_start();
require_once 'database/koneksi.php';

$query = "SELECT * FROM jurusan ORDER BY nama_jurusan ASC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Jurusan - PILIH.in</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body class="bg-base font-sans text-slate-800">
    
    <?php include 'components/navbar.php'; ?>

    <main class="pt-32 pb-20 container mx-auto px-4 lg:px-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-800 mb-4">Katalog <span class="text-primary">Jurusan</span></h1>
            <p class="text-lg text-slate-500">Jelajahi berbagai program studi dan temukan roadmap karir yang tepat untukmu.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg transition hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-primary/10 text-primary rounded-full flex items-center justify-center text-2xl font-bold">
                            <?= strtoupper(substr($row['nama_jurusan'], 0, 1)) ?>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-slate-800"><?= htmlspecialchars($row['nama_jurusan']) ?></h3>
                            <span class="inline-block mt-1 text-xs font-semibold text-primary bg-primary/10 px-3 py-1 rounded-full"><?= htmlspecialchars($row['kategori_relevan']) ?></span>
                        </div>
                    </div>
                    <p class="text-slate-600 mb-6 leading-relaxed text-sm">
                        <?= htmlspecialchars($row['deskripsi_singkat']) ?>
                    </p>
                </div>
                <div class="border-t border-slate-100 pt-4">
                    <a href="roadmap.php?id_jurusan=<?= $row['id_jurusan'] ?>" class="block w-full py-3 bg-slate-50 border border-slate-200 text-slate-800 rounded-xl font-semibold hover:bg-primary hover:text-white transition text-center shadow-sm">
                        Lihat Roadmap Karir
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>