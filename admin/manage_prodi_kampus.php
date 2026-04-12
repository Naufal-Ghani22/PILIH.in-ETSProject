<?php
session_start();
include '../database/koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth.php?error=Akses ditolak!");
    exit;
}

// ============================================================
// LOGIC: Tambah relasi (centang prodi baru)
// ============================================================
if (isset($_POST['action']) && $_POST['action'] === 'update_relasi') {
    $id_kampus = (int)$_POST['id_kampus'];

    // 1. Hapus semua relasi lama untuk kampus ini
    mysqli_query($koneksi, "DELETE FROM relasi_kampus_jurusan WHERE id_kampus = $id_kampus");

    // 2. Insert ulang yang dicentang saja
    if (!empty($_POST['jurusan_ids']) && is_array($_POST['jurusan_ids'])) {
        foreach ($_POST['jurusan_ids'] as $id_jurusan) {
            $id_jurusan = (int)$id_jurusan;
            mysqli_query($koneksi,
                "INSERT INTO relasi_kampus_jurusan (id_kampus, id_jurusan)
                 VALUES ($id_kampus, $id_jurusan)"
            );
        }
    }

    header("Location: manage_prodi_kampus.php?id_kampus=$id_kampus&success=Prodi berhasil diperbarui!");
    exit;
}

// ============================================================
// Ambil daftar semua kampus
// ============================================================
$all_kampus = [];
$q_kampus = mysqli_query($koneksi, "SELECT * FROM kampus ORDER BY nama_kampus ASC");
while ($r = mysqli_fetch_assoc($q_kampus)) {
    $all_kampus[] = $r;
}

// Kampus yang sedang dipilih
$selected_kampus_id = isset($_GET['id_kampus']) ? (int)$_GET['id_kampus'] : ($all_kampus[0]['id_kampus'] ?? 0);
$selected_kampus = null;
foreach ($all_kampus as $k) {
    if ($k['id_kampus'] === $selected_kampus_id) {
        $selected_kampus = $k;
        break;
    }
}

// ============================================================
// Ambil semua jurusan dan tandai yang sudah terelasi
// ============================================================
$all_jurusan = [];
$q_jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
while ($r = mysqli_fetch_assoc($q_jurusan)) {
    $all_jurusan[] = $r;
}

// ID jurusan yang sudah terhubung ke kampus ini
$terhubung = [];
if ($selected_kampus_id) {
    $q_relasi = mysqli_query($koneksi,
        "SELECT id_jurusan FROM relasi_kampus_jurusan WHERE id_kampus = $selected_kampus_id"
    );
    while ($r = mysqli_fetch_assoc($q_relasi)) {
        $terhubung[] = (int)$r['id_jurusan'];
    }
}

// Kelompokkan jurusan per kategori untuk tampilan yang rapi
$jurusan_per_kategori = [];
foreach ($all_jurusan as $j) {
    $kat_raw = explode(',', $j['kategori_relevan']);
    $kat = trim($kat_raw[0]); // Ambil kategori utama
    $jurusan_per_kategori[$kat][] = $j;
}
ksort($jurusan_per_kategori);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Prodi Kampus - PILIH.in Admin</title>
    <link href="../src/output.css" rel="stylesheet">
    <style>
        .jurusan-check:checked + label {
            background-color: rgb(238 242 255);
            border-color: rgb(99 102 241);
            color: rgb(67 56 202);
        }
        .jurusan-check:checked + label .check-icon { display: flex; }
        .check-icon { display: none; }
    </style>
</head>
<body class="bg-slate-50 font-sans">
<div class="flex min-h-screen">

    <!-- ===== SIDEBAR ===== -->
    <aside class="w-64 bg-slate-900 text-white p-6 flex-shrink-0">
        <h2 class="text-2xl font-bold mb-8">PILIH.in <span class="text-purple-400 text-sm">Admin</span></h2>
        <nav class="space-y-2">
            <a href="dashboard.php"            class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">Dashboard</a>
            <a href="manage_majors.php"        class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">Kelola Jurusan</a>
            <a href="manage_campuses.php"      class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">Kelola Kampus</a>
            <a href="manage_prodi_kampus.php"  class="block px-3 py-2 rounded-lg bg-purple-700 text-white font-bold">📌 Prodi per Kampus</a>
            <hr class="border-slate-700 my-2">
            <a href="../logout.php"            class="block px-3 py-2 rounded-lg text-red-400 hover:bg-slate-700 transition">Logout</a>
        </nav>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-1 p-8 overflow-auto">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800">Prodi per Kampus</h1>
                <p class="text-slate-500 mt-1">Centang prodi yang tersedia di kampus pilihan, lalu klik Simpan.</p>
            </div>
        </div>

        <!-- Notifikasi sukses -->
        <?php if (isset($_GET['success'])): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl font-semibold mb-6 flex items-center gap-3">
            <span class="text-xl">✅</span>
            <span><?= htmlspecialchars($_GET['success']) ?></span>
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- Kolom kiri: Pilih Kampus -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="bg-slate-800 text-white px-5 py-4">
                        <h3 class="font-bold text-sm uppercase tracking-wider">Pilih Kampus</h3>
                    </div>
                    <ul class="divide-y divide-slate-100">
                        <?php foreach ($all_kampus as $k): ?>
                        <li>
                            <a href="manage_prodi_kampus.php?id_kampus=<?= $k['id_kampus'] ?>"
                               class="flex items-center gap-3 px-5 py-4 hover:bg-slate-50 transition <?= ($k['id_kampus'] === $selected_kampus_id) ? 'bg-indigo-50 border-l-4 border-indigo-500' : '' ?>">
                                <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs flex-shrink-0">
                                    <?= strtoupper(substr($k['nama_kampus'], 0, 2)) ?>
                                </div>
                                <span class="text-sm font-semibold text-slate-700 leading-tight"><?= htmlspecialchars($k['nama_kampus']) ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="p-4 border-t border-slate-100">
                        <a href="manage_campuses.php" class="block w-full text-center text-xs text-indigo-600 font-bold hover:text-indigo-800">
                            + Tambah Kampus Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kolom kanan: Daftar prodi dengan checkbox -->
            <div class="lg:col-span-3">
                <?php if ($selected_kampus): ?>
                <form method="POST" action="manage_prodi_kampus.php">
                    <input type="hidden" name="action" value="update_relasi">
                    <input type="hidden" name="id_kampus" value="<?= $selected_kampus_id ?>">

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-6">
                        <!-- Header kampus -->
                        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                            <div>
                                <h2 class="text-xl font-extrabold text-slate-800"><?= htmlspecialchars($selected_kampus['nama_kampus']) ?></h2>
                                <p class="text-sm text-slate-500">📍 <?= htmlspecialchars($selected_kampus['lokasi']) ?> &nbsp;|&nbsp; Akreditasi: <strong><?= htmlspecialchars($selected_kampus['akreditasi']) ?></strong></p>
                            </div>
                            <span class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                                <?= count($terhubung) ?> prodi aktif
                            </span>
                        </div>

                        <!-- Quick actions -->
                        <div class="flex gap-3 px-6 py-3 bg-slate-50 border-b border-slate-100 text-sm">
                            <button type="button" onclick="checkAll(true)"  class="text-indigo-600 font-semibold hover:underline">Centang Semua</button>
                            <span class="text-slate-300">|</span>
                            <button type="button" onclick="checkAll(false)" class="text-slate-500 font-semibold hover:underline">Hapus Semua Centang</button>
                        </div>

                        <!-- Daftar prodi per kategori -->
                        <div class="p-6 space-y-8">
                            <?php foreach ($jurusan_per_kategori as $kategori => $jurusan_list): ?>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">
                                    <?= htmlspecialchars($kategori) ?>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <?php foreach ($jurusan_list as $j): 
                                        $is_checked = in_array((int)$j['id_jurusan'], $terhubung);
                                    ?>
                                    <div class="relative">
                                        <input 
                                            type="checkbox" 
                                            class="jurusan-check sr-only"
                                            name="jurusan_ids[]" 
                                            value="<?= $j['id_jurusan'] ?>"
                                            id="jurusan_<?= $j['id_jurusan'] ?>"
                                            <?= $is_checked ? 'checked' : '' ?>
                                        >
                                        <label for="jurusan_<?= $j['id_jurusan'] ?>" 
                                               class="flex items-center gap-3 w-full cursor-pointer px-4 py-3 rounded-xl border-2 border-slate-100 bg-slate-50 hover:border-indigo-300 hover:bg-indigo-50/50 transition select-none">
                                            <!-- Checkmark icon -->
                                            <div class="check-icon w-5 h-5 rounded-full bg-indigo-600 text-white items-center justify-center flex-shrink-0">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div class="w-5 h-5 rounded-full border-2 border-slate-300 flex-shrink-0 <?= $is_checked ? 'hidden' : '' ?>" style="<?= $is_checked ? 'display:none' : '' ?>"></div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-slate-700 text-sm leading-tight"><?= htmlspecialchars($j['nama_jurusan']) ?></p>
                                                <p class="text-xs text-slate-400 mt-0.5 truncate"><?= htmlspecialchars($j['kategori_relevan']) ?></p>
                                            </div>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end gap-4">
                        <a href="manage_prodi_kampus.php?id_kampus=<?= $selected_kampus_id ?>" 
                           class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition">
                            Reset
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 transition">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>

                <?php else: ?>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center text-slate-400">
                    <div class="text-5xl mb-4">🏫</div>
                    <p class="font-semibold">Pilih kampus dari daftar sebelah kiri untuk mulai mengatur prodi.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<script>
    function checkAll(state) {
        document.querySelectorAll('.jurusan-check').forEach(cb => {
            cb.checked = state;
            // Trigger perubahan visual CSS (via CSS :checked selector sudah otomatis)
        });
    }
</script>
</body>
</html>
