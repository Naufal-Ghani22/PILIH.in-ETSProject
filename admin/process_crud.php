<?php
include '../database/koneksi.php';
session_start();

if ($_SESSION['role'] !== 'admin') { exit; }

// ==========================================
// 1. BLOK LOGIKA HAPUS (DELETE)
// ==========================================
if (isset($_GET['action'])) {
    
    // Hapus Jurusan
    if ($_GET['action'] == 'delete_major') {
        $id = (int)$_GET['id'];
        $query = "DELETE FROM jurusan WHERE id_jurusan = $id";
        if (mysqli_query($koneksi, $query)) {
            header("Location: manage_majors.php?success=Jurusan berhasil dihapus!");
        } else {
            header("Location: manage_majors.php?error=Gagal menghapus jurusan.");
        }
        exit;
    }

    // Hapus Kampus
    if ($_GET['action'] == 'delete_campus') {
        $id = (int)$_GET['id'];
        $query = "DELETE FROM kampus WHERE id_kampus = $id";
        if (mysqli_query($koneksi, $query)) {
            header("Location: manage_campuses.php?success=Kampus berhasil dihapus!");
        } else {
            header("Location: manage_campuses.php?error=Gagal menghapus kampus.");
        }
        exit;
    }
}

// ==========================================
// 2. BLOK LOGIKA TAMBAH (CREATE)
// ==========================================

// Jika Admin submit form tambah jurusan
if (isset($_POST['submit_tambah_jurusan'])) {
    $nama_jurusan = mysqli_real_escape_string($koneksi, $_POST['nama_jurusan']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori_relevan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi_singkat']);

    $query = "INSERT INTO jurusan (nama_jurusan, kategori_relevan, deskripsi_singkat, prospek_karir) 
              VALUES ('$nama_jurusan', '$kategori', '$deskripsi', 'Prospek karir luas di berbagai bidang terkait.')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: manage_majors.php?success=Jurusan baru berhasil ditambahkan!");
    } else {
        header("Location: manage_majors.php?error=Gagal menambah jurusan.");
    }
    exit;
}

// Jika Admin submit form tambah kampus
if (isset($_POST['submit_tambah_kampus'])) {
    $nama_kampus = mysqli_real_escape_string($koneksi, $_POST['nama_kampus']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $akreditasi = mysqli_real_escape_string($koneksi, $_POST['akreditasi']);
    $estimasi_biaya = mysqli_real_escape_string($koneksi, $_POST['estimasi_biaya']);

    $query = "INSERT INTO kampus (nama_kampus, lokasi, akreditasi, estimasi_biaya) 
              VALUES ('$nama_kampus', '$lokasi', '$akreditasi', '$estimasi_biaya')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: manage_campuses.php?success=Kampus baru berhasil ditambahkan!");
    } else {
        header("Location: manage_campuses.php?error=Gagal menambah kampus.");
    }
    exit;
}
?>
