<?php
session_start(); // Memulai sesi agar bisa dihapus

// Menghapus semua variabel sesi
$_SESSION = array();

// Menghancurkan sesi secara total
session_destroy();

// Mengarahkan user kembali ke halaman utama (index.php)
header("Location: index.php");
exit;
?>