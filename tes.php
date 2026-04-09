<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php?error=Silakan login terlebih dahulu!&redirect=tes.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Minat - PILIH.in</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body class="bg-base font-sans text-slate-800">
    <?php include 'components/navbar.php'; ?>

    <main class="pt-32 pb-20 container mx-auto px-4 lg:px-12">
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-bold text-slate-800 mb-2">Tes Minat Jurusan</h1>
                <p class="text-slate-500">Jawab pertanyaan berikut untuk mendapatkan rekomendasi jurusan.</p>
            </div>

            <form action="proses_tes.php" method="POST" class="space-y-8">
                <?php
                require_once 'database/koneksi.php';
                $result = mysqli_query($koneksi, "SELECT * FROM questions ORDER BY id_soal ASC");
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)):
                    $id = $row['id_soal'];
                    $text = $row['teks_pertanyaan'];
                ?>
                <div class="rounded-3xl border border-slate-200 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">Pertanyaan <?= $no++ ?></h3>
                    <p class="text-slate-600 mb-4"><?= htmlspecialchars($text) ?></p>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                        <?php for ($score = 1; $score <= 5; $score++): ?>
                            <label class="cursor-pointer rounded-2xl border border-slate-300 p-3 text-center hover:border-primary transition">
                                <input type="radio" name="jawaban[<?= $id ?>]" value="<?= $score ?>" class="mr-2" <?= $score === 3 ? 'checked' : '' ?>>
                                <?= $score ?>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
                <?php endwhile; ?>

                <div class="flex flex-col md:flex-row items-center gap-4">
                    <button type="submit" class="bg-primary text-white font-bold px-6 py-4 rounded-2xl hover:bg-primary/90 transition w-full md:w-auto">Selesai dan Lihat Hasil</button>
                    <a href="dashboard.php" class="text-slate-700 bg-slate-100 border border-slate-200 px-6 py-4 rounded-2xl text-center w-full md:w-auto hover:bg-slate-200 transition">Kembali ke Dashboard</a>
                </div>
            </form>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>
