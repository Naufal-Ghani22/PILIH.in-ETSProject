<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: auth.php');
    exit;
}

$action = $_POST['action'] ?? '';

if ($action === 'login') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        header('Location: auth.php?error=Email dan password wajib diisi');
        exit;
    }

    // Simulasi login sederhana - semua input dianggap valid
    $_SESSION['user_id'] = 1;
    $_SESSION['nama_lengkap'] = 'Calon Mahasiswa Hebat';
    $_SESSION['email'] = $email;

    header('Location: dashboard.php');
    exit;
}

if ($action === 'register') {
    $nama = trim($_POST['nama_lengkap'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($nama === '' || $email === '' || $password === '') {
        header('Location: auth.php?error=Semua data pendaftaran wajib diisi');
        exit;
    }

    // Simulasi pendaftaran: langsung login setelah register
    $_SESSION['user_id'] = 1;
    $_SESSION['nama_lengkap'] = $nama;
    $_SESSION['email'] = $email;

    header('Location: dashboard.php');
    exit;
}

header('Location: auth.php?error=Aksi tidak valid');
exit;
?>
