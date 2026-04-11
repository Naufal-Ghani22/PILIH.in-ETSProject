<?php
session_start();

require_once 'database/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: auth.php');
    exit;
}

$action = $_POST['action'] ?? '';

// ==========================================
// 1. PROSES LOGIN
// ==========================================
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
        $user = mysqli_fetch_assoc($result); // Data disimpan di $user
        
    // Verifikasi password yang di-hash
        if (password_verify($password, $user['password'])) {
            // PERBAIKAN: Menggunakan $user, bukan $data_user
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // AUTO-REDIRECT CERDAS
            if ($_SESSION['role'] === 'admin') {
                header("Location: admin/dashboard.php");
                exit;
            } else {
                header("Location: dashboard.php");
                exit;
            }
        } else {
            header('Location: auth.php?error=Email atau Password salah');
            exit;
        }
    }
    
    header('Location: auth.php?error=Email atau Password salah');
    exit;
}

// ==========================================
// 2. PROSES REGISTRASI
// ==========================================
if ($action === 'register') {
    $nama      = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap'] ?? ''));
    $email     = mysqli_real_escape_string($koneksi, trim($_POST['email'] ?? ''));
    $password  = $_POST['password'] ?? '';
    $sekolah   = mysqli_real_escape_string($koneksi, trim($_POST['asal_sekolah'] ?? ''));
    $password  = $_POST['password'] ?? '';

    // PERBAIKAN: Hapus pengecekan $sekolah === '' karena di form tidak ada
    if ($nama === '' || $email === '' || $password === '') {
        header('Location: auth.php?error=Semua data pendaftaran wajib diisi');
        exit;
    }

    if (strlen($password) < 6) { // Ubah jadi 6 agar sinkron dengan info placeholder di auth.php
        header('Location: auth.php?error=Password minimal 6 karakter');
        exit;
    }

    // Cek email sudah ada atau belum
    $cek = $koneksi->prepare("SELECT id_user FROM users WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $cek_result = $cek->get_result();

    if ($cek_result->num_rows > 0) {
        header('Location: auth.php?error=Email sudah terdaftar, silakan login!');
        exit;
    }

    // Hash password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Query Insert regist (role default biasanya diset otomatis 'user' dari database)
    $query_ins = "INSERT INTO users (nama_lengkap, email, password, asal_sekolah) 
                  VALUES ('$nama', '$email', '$password_hashed', '$sekolah')";
    
    if (mysqli_query($koneksi, $query_ins)) {
        // Otomatis login setelah berhasil daftar
        $_SESSION['user_id']      = mysqli_insert_id($koneksi);
        $_SESSION['nama_lengkap'] = $nama;
        $_SESSION['email']        = $email;
        $_SESSION['role']         = 'user';

        header("Location: dashboard.php");
        exit;
    } else {
        header('Location: auth.php?error=Sistem sedang sibuk, pendaftaran gagal.');
        exit;
    }
}

header('Location: auth.php?error=Aksi tidak valid');
exit;
?>
