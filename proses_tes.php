<?php
session_start();
require_once 'database/koneksi.php';

$jawaban = $_POST['jawaban'] ?? [];
$skor_kategori = [];
$jumlah_soal_per_kat = []; //Untuk menghitung pembagi rata-rata

// 1. Ambil semua data soal untuk mencocokkan kategori
$res_soal = mysqli_query($koneksi, "SELECT id_soal, kategori_minat FROM questions");
$soal_data = [];
while ($row = mysqli_fetch_assoc($res_soal)) {
    $soal_data[$row['id_soal']] = $row['kategori_minat'];
}

// 2. Hitung poin dan jumlah kemunculan kategori
foreach ($jawaban as $id_soal => $nilai) {
    if (isset($soal_data[$id_soal])) {
        $kategoris = array_map('trim', explode(',', $soal_data[$id_soal]));
        foreach ($kategoris as $kat) {
            if (!isset($skor_kategori[$kat])) {
                $skor_kategori[$kat] = 0;
                $jumlah_soal_per_kat[$kat] = 0;
            }
            $skor_kategori[$kat] += (int)$nilai;
            $jumlah_soal_per_kat[$kat]++; // Hitung berapa kali kategori ini muncul
        }
    }
}

// 3. Hitung Rata-Rata Poin per Kategori
$rata_rata_kategori = [];
foreach ($skor_kategori as $kat => $total_poin) {
    $rata_rata_kategori[$kat] = $total_poin / $jumlah_soal_per_kat[$kat];
}

// 4. Cari kategori dengan rata-rata tertinggi
arsort($rata_rata_kategori);
$kategori_pemenang = key($rata_rata_kategori);

// 5. Cari jurusan secara acak berdasarkan kategori pemenang
$kategori_esc = mysqli_real_escape_string($koneksi, $kategori_pemenang);
$query_rekomendasi = "SELECT id_jurusan FROM jurusan 
                      WHERE kategori_relevan LIKE '%$kategori_esc%' 
                      ORDER BY RAND() 
                      LIMIT 1";
$res_rek = mysqli_query($koneksi, $query_rekomendasi);
$jurusan_final = mysqli_fetch_assoc($res_rek);
$id_jurusan_final = ($jurusan_final) ? $jurusan_final['id_jurusan'] : 1;

// 6. Hitung skor kecocokan global (0-100)
$user_id = $_SESSION['user_id'];
$total_soal = count($jawaban);
$skor_akhir = ($total_soal > 0) ? round((array_sum($jawaban) / ($total_soal * 5)) * 100) : 0;

// 7. Simpan ke database
$query_insert = "INSERT INTO hasil_tes (id_user, id_jurusan, skor_kecocokan) 
                 VALUES ('$user_id', '$id_jurusan_final', '$skor_akhir')";

if (mysqli_query($koneksi, $query_insert)) {
    $id_hasil = mysqli_insert_id($koneksi);
    header("Location: hasil.php?id_hasil=$id_hasil");
    exit;
} else {
    header("Location: tes.php?error=" . urlencode("Gagal menyimpan: " . mysqli_error($koneksi)));
    exit;
}