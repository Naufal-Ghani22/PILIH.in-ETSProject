<?php
$host = "127.0.0.1:3307";
$user = "root";
$password = "";
$database = "pilihin";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");

// Koneksi berhasil - siap digunakan
?>