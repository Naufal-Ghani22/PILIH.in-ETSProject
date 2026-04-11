<?php
session_start();
require_once 'database/koneksi.php';

$jawaban = $_POST['jawaban'] ?? [];
$skor_kategori = []; // Tempat menampung poin per kategori

// 1. Ambil semua data soal untuk mencocokkan kategori
$res_soal = mysqli_query($koneksi, "SELECT id_soal, kategori_minat FROM questions");
$soal_data = [];
while ($row = mysqli_fetch_assoc($res_soal)) {
    $soal_data[$row['id_soal']] = $row['kategori_minat'];
}

// 2. Hitung poin untuk setiap kategori
foreach ($jawaban as $id_soal => $nilai) {
    if (isset($soal_data[$id_soal])) {
        // Pecah string "IT, Kedokteran, Teknik" menjadi array
        $kategoris = explode(', ', $soal_data[$id_soal]);
        
        foreach ($kategoris as $kat) {
            if (!isset($skor_kategori[$kat])) $skor_kategori[$kat] = 0;
            $skor_kategori[$kat] += (int)$nilai;
        }
    }
}

// 3. Cari kategori dengan poin tertinggi
arsort($skor_kategori); // Urutkan dari yang terbesar
$kategori_pemenang = key($skor_kategori); // Ambil nama kategori teratas (misal: "IT")

// 4. Cari Jurusan di database yang cocok dengan kategori pemenang
$query_rekomendasi = "SELECT id_jurusan FROM jurusan 
                      WHERE kategori_relevan LIKE '%$kategori_pemenang%' 
                      LIMIT 1";
$res_rek = mysqli_query($koneksi, $query_rekomendasi);
$jurusan_final = mysqli_fetch_assoc($res_rek);

// Jika ketemu, gunakan ID tersebut. Jika tidak, gunakan fallback (ID 1)
$id_jurusan_final = ($jurusan_final) ? $jurusan_final['id_jurusan'] : 1;

// 5. Simpan ke hasil_tes
$user_id = $_SESSION['user_id'];
$total_soal = count($jawaban);
$skor_akhir = ($total_soal > 0) ? round((array_sum($jawaban) / ($total_soal * 5)) * 100) : 0;

$query_insert = "INSERT INTO hasil_tes (id_user, id_jurusan, skor_kecocokan) 
                 VALUES ('$user_id', '$id_jurusan_final', '$skor_akhir')";

if (mysqli_query($koneksi, $query_insert)) {
    $id_hasil = mysqli_insert_id($koneksi);
    header("Location: hasil.php?id_hasil=$id_hasil");
}