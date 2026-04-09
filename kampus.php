<?php
require_once 'database/koneksi.php';
$query = "SELECT * FROM kampus ORDER BY nama_kampus ASC";
$result = mysqli_query($koneksi, $query);
$campuses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $campuses[] = [
        "nama" => $row['nama_kampus'],
        "lokasi" => $row['lokasi'],
        "akreditasi" => $row['akreditasi'],
        "biaya" => $row['estimasi_biaya']
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Kampus - PILIH.in</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body class="bg-base font-sans text-slate-800">
    
    <?php include 'components/navbar.php'; ?>

    <main class="pt-32 pb-20 container mx-auto px-4 lg:px-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-800 mb-4">Eksplorasi <span class="text-primary">Kampus Impian</span></h1>
            <p class="text-lg text-slate-500">Temukan universitas terbaik untuk menunjang roadmap karirmu.</p>
        </div>

        <div class="max-w-3xl mx-auto bg-white p-4 rounded-2xl shadow-sm border border-slate-200 flex flex-col md:flex-row gap-4 mb-12">
            <input type="text" id="searchInput" onkeyup="filterKampus()" placeholder="Cari nama kampus atau lokasi..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary">
            <select id="filterAkreditasi" onchange="filterKampus()" class="w-full md:w-48 px-4 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-primary">
                <option value="Semua">Semua Akreditasi</option>
                <option value="Unggul">Unggul</option>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="kampusGrid">
            <?php foreach($campuses as $k): ?>
            <div class="kampus-card bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-lg transition hover:-translate-y-1" data-akreditasi="<?= $k['akreditasi'] ?>">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 bg-secondary/20 rounded-full flex items-center justify-center text-2xl">🏫</div>
                    <div>
                        <h3 class="font-bold text-lg text-slate-800 kampus-nama"><?= $k['nama'] ?></h3>
                        <p class="text-sm text-slate-500 kampus-lokasi">📍 <?= $k['lokasi'] ?></p>
                    </div>
                </div>
                <div class="space-y-2 mb-6">
                    <div class="flex justify-between items-center text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Akreditasi</span>
                        <span class="font-bold text-primary bg-primary/10 px-3 py-1 rounded-full"><?= $k['akreditasi'] ?></span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Estimasi UKT</span>
                        <span class="font-semibold text-slate-700"><?= $k['biaya'] ?></span>
                    </div>
                </div>
                <button class="w-full py-2 bg-slate-50 border border-slate-200 text-slate-950 rounded-xl font-semibold hover:bg-primary hover:text-white transition">Lihat Jurusan Tersedia</button>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

    <script>
        function filterKampus() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let filterAkr = document.getElementById('filterAkreditasi').value;
            let cards = document.querySelectorAll('.kampus-card');

            cards.forEach(card => {
                let nama = card.querySelector('.kampus-nama').innerText.toLowerCase();
                let lokasi = card.querySelector('.kampus-lokasi').innerText.toLowerCase();
                let akr = card.getAttribute('data-akreditasi');

                let matchSearch = nama.includes(input) || lokasi.includes(input);
                let matchAkr = (filterAkr === "Semua") || (akr === filterAkr);

                if (matchSearch && matchAkr) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>