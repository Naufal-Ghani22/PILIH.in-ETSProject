<?php
session_start();

require_once 'koneksi.php'; //untuk koneksi ke db

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: auth.php');
    exit;
}

$action = $_POST['action'] ?? '';

// LOGIN
if ($action === 'login') {
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        header('Location: auth.php?error=Email dan password wajib diisi');
        exit;
    }

    // Mencari user berdasarkan email
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
    // Verifikasi password yang di-hash
        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id']      = $user['id_user'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['email']        = $user['email'];

            $_SESSION['role']         = $user['role'];

            header('Location: dashboard.php');
            exit;
        }
    }
    
    header('Location: auth.php?error=Email atau Password salah');
    exit;
}

// Registrasi
if ($action === 'register') {
    $nama      = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap'] ?? ''));
    $email     = mysqli_real_escape_string($koneksi, trim($_POST['email'] ?? ''));
    $sekolah   = mysqli_real_escape_string($koneksi, trim($_POST['asal_sekolah'] ?? ''));
    $password  = $_POST['password'] ?? '';

    // Validasi input kosong
    if ($nama === '' || $email === '' || $password === '' || $sekolah === '') {
        header('Location: auth.php?error=Semua data pendaftaran wajib diisi');
        exit;
    }

    // Validasi password
    if (strlen($password) < 8) {
        header('Location: auth.php?error=Password minimal 8 karakter');
        exit;
    }

    // Cek email sudah ada atau belum
    $cek = $koneksi->prepare("SELECT id_user FROM users WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $cek_result = $cek->get_result();

    if ($cek_result->num_rows > 0) {
        header('Location: auth.php?error=Email sudah terdaftar');
        exit;
    }

    // Keamanan: Hash password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Query Insert regist
    $query_ins = "INSERT INTO users (nama_lengkap, email, password, asal_sekolah) 
                  VALUES ('$nama', '$email', '$password_hashed', '$sekolah')";
    
    if (mysqli_query($koneksi, $query_ins)) {
        // Otomatis login setelah berhasil daftar
        $_SESSION['user_id']      = mysqli_insert_id($koneksi);
        $_SESSION['nama_lengkap'] = $nama;
        $_SESSION['email']        = $email;
        $_SESSION['role']         = 'user'; //mengisi sesuai default yg ada di db

        header('Location: dashboard.php');
        exit;
    } else {
        // Jika email sudah ada (unique constraint) atau error lainnya
        header('Location: auth.php?error=Pendaftaran gagal atau email sudah terdaftar');
        exit;
    }
}

header('Location: auth.php?error=Aksi tidak valid');
exit;
?>
