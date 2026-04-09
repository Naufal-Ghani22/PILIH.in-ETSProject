<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: tes.php");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php?error=Silakan login terlebih dahulu!");
    exit;
}

$jawaban = $_POST['jawaban'] ?? [];
$total = 0;
$count = 0;

foreach ($jawaban as $nilai) {
    $total += (int)$nilai;
    $count++;
}

$skor_kecocokan = $count > 0 ? min(100, max(0, round(($total / ($count * 5)) * 100))) : 0;

// Simulasi hasil rekomendasi berdasarkan skor
$_SESSION['hasil_terakhir'] = [
    'id_hasil' => 1,
    'nama_jurusan' => 'Sistem Informasi',
    'skor_kecocokan' => $skor_kecocokan,
    'tanggal_tes' => date('Y-m-d H:i:s'),
    'deskripsi_singkat' => 'Belajar merancang dan mengembangkan sistem informasi untuk berbagai industri. Program ini fokus pada pemrograman, database, dan teknologi informasi terkini.',
    'prospek_karir' => 'Lulusan Sistem Informasi memiliki prospek karir yang gemilang sebagai Software Developer, Database Administrator, System Analyst, IT Consultant, dan berbagai posisi strategis di perusahaan teknologi global.'
];

header('Location: hasil.php?id_hasil=1');
exit;
?>
