<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php?error=Silakan login terlebih dahulu!");
    exit;
}

$nama_user = $_SESSION['nama_lengkap'] ?? "Calon Mahasiswa Hebat";
$email_user = $_SESSION['email'] ?? "user@pilihin.com";
$user_id = $_SESSION['user_id'];

require_once 'database/koneksi.php';

// JOIN menggunakan kolom id_jurusan (skema baru)
$query_riwayat = "SELECT h.id_hasil, h.skor_kecocokan, h.tanggal_tes, 
                         j.nama_jurusan, j.kategori_relevan, j.id_jurusan 
                  FROM hasil_tes h 
                  JOIN jurusan j ON h.id_jurusan = j.id_jurusan 
                  WHERE h.id_user = $user_id 
                  ORDER BY h.tanggal_tes DESC";
$riwayat_result = mysqli_query($koneksi, $query_riwayat);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PILIH.in</title>
    <link href="./src/output.css" rel="stylesheet">
</head>

<body class="bg-base font-sans text-slate-800">

    <?php include 'components/navbar.php'; ?>

    <main class="pt-32 pb-20 container mx-auto px-4 lg:px-12 flex flex-col lg:flex-row gap-8">

        <aside class="w-full lg:w-1/3">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 text-center sticky top-32">
                <div
                    class="w-24 h-24 bg-primary text-white text-3xl flex items-center justify-center rounded-full mx-auto mb-4 font-bold shadow-lg shadow-primary/30">
                    <?= strtoupper(substr($nama_user, 0, 1)) ?>
                </div>
                <h2 class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($nama_user) ?></h2>
                <p class="text-slate-500 mb-6"><?= htmlspecialchars($email_user) ?></p>
                <div class="border-t border-slate-100 pt-6 space-y-3">
                    <a href="tes.php"
                        class="block w-full py-3 bg-secondary/10 text-secondary font-semibold rounded-xl hover:bg-secondary hover:text-white transition">Ambil
                        Tes Baru</a>
                    <a href="kampus.php"
                        class="block w-full py-3 bg-primary/10 text-primary font-semibold rounded-xl hover:bg-primary hover:text-white transition">Eksplorasi
                        Kampus</a>
                    <a href="logout.php" onclick="return confirm('Yakin ingin keluar?')"
                        class="block w-full py-3 bg-red-50 text-red-600 font-semibold rounded-xl hover:bg-red-500 hover:text-white transition">Logout</a>
                </div>
            </div>
        </aside>

        <section class="w-full lg:w-2/3 space-y-6">
            <h3 class="text-2xl font-bold text-slate-800 mb-6">Riwayat Rekomendasimu</h3>

            <?php if ($riwayat_result && mysqli_num_rows($riwayat_result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($riwayat_result)): ?>
                    <div
                        class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="bg-green-100 text-green-600 p-4 rounded-2xl font-bold text-xl">
                                <?= (int) $row['skor_kecocokan'] ?>%
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Tes:
                                    <?= date('d M Y', strtotime($row['tanggal_tes'])) ?>
                                </p>
                                <h4 class="text-xl font-bold text-primary"><?= htmlspecialchars($row['nama_jurusan']) ?></h4>
                                <p class="text-sm text-slate-500">Minat dominan:
                                    <?= htmlspecialchars($row['kategori_relevan'] ?? 'Teknologi') ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 shrink-0">
                            <a href="hasil.php?id_hasil=<?= $row['id_hasil'] ?>"
                                class="px-6 py-2 bg-slate-100 text-slate-700 font-semibold rounded-full hover:bg-slate-200 transition text-center">Detail
                                Hasil</a>
                            <a href="roadmap.php?id_jurusan=<?= urlencode($row['id_jurusan']) ?>"
                                class="px-6 py-2 bg-primary text-white font-semibold rounded-full hover:shadow-lg transition text-center">Lihat
                                Roadmap</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div
                    class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center gap-4">
                    <div class="text-5xl">🤷‍♂️</div>
                    <p class="text-slate-500">Belum ada riwayat tes minat.<br>Mulai tes pertamamu sekarang!</p>
                    <a href="tes.php"
                        class="mt-2 px-6 py-2 bg-primary text-white font-semibold rounded-full hover:shadow-lg transition">Mulai
                        Tes Minat</a>
                </div>
            <?php endif; ?>

        </section>

    </main>

    <?php include 'components/footer.php'; ?>
</body>

</html>