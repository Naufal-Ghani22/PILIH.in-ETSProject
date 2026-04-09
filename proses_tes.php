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

require_once 'database/koneksi.php';

// Simulasi rekomendasi jurusan berdasarkan skor (skor tinggi = id 1, rendah = id 2 untuk dummy ini)
$id_jurusan_rekomendasi = $skor_kecocokan > 75 ? 1 : 2; 

$user_id = $_SESSION['user_id'];
$query_insert = "INSERT INTO hasil_tes (id_user, id_jurusan_rekomendasi, skor_kecocokan) 
                 VALUES ($user_id, $id_jurusan_rekomendasi, $skor_kecocokan)";

if (mysqli_query($koneksi, $query_insert)) {
    $id_hasil = mysqli_insert_id($koneksi);
    header("Location: hasil.php?id_hasil=$id_hasil");
} else {
    header("Location: tes.php?error=Gagal menyimpan hasil tes");
}
exit;
?>
