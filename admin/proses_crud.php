<?php
include '../database/koneksi.php';
session_start();

if ($_SESSION['role'] !== 'admin') { exit; }

// LOGIKA HAPUS JURUSAN
if (isset($_GET['action']) && $_GET['action'] == 'delete_major') {
    $id = $_GET['id'];
    
    $query = "DELETE FROM majors WHERE id_jurusan = $id";
    $exec = mysqli_query($koneksi, $query);

    if ($exec) {
        header("Location: manage_majors.php?success=Data berhasil dihapus");
    } else {
        header("Location: manage_majors.php?error=Gagal menghapus data");
    }
}

// ==========================================
// 1. BLOK LOGIKA HAPUS (DELETE)
// ==========================================
if (isset($_GET['action'])) {
    
    // Hapus Jurusan
    if ($_GET['action'] == 'delete_major') {
        $id = (int)$_GET['id']; // Pastikan jadi integer agar aman dari injeksi
        $query = "DELETE FROM majors WHERE id_jurusan = $id";
        if (mysqli_query($koneksi, $query)) {
            header("Location: manage_majors.php?success=Jurusan berhasil dihapus!");
        } else {
            header("Location: manage_majors.php?error=Gagal menghapus jurusan.");
        }
    }

    // Hapus Kampus
    if ($_GET['action'] == 'delete_campus') {
        $id = (int)$_GET['id'];
        $query = "DELETE FROM campuses WHERE id_kampus = $id";
        if (mysqli_query($koneksi, $query)) {
            header("Location: manage_campuses.php?success=Kampus berhasil dihapus!");
        }
    }
}

// ==========================================
// 2. BLOK LOGIKA TAMBAH (CREATE)
// ==========================================

// Jika Admin submit form tambah jurusan
if (isset($_POST['submit_tambah_jurusan'])) {
    // Tangkap data dari form (gunakan real_escape_string agar aman dari kutip error)
    $nama_jurusan = mysqli_real_escape_string($koneksi, $_POST['nama_jurusan']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori_relevan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi_singkat']);

    $query = "INSERT INTO majors (nama_jurusan, kategori_relevan, deskripsi_singkat) 
              VALUES ('$nama_jurusan', '$kategori', '$deskripsi')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: manage_majors.php?success=Jurusan baru berhasil ditambahkan!");
    } else {
        header("Location: manage_majors.php?error=Gagal menambah jurusan.");
    }
}
?>