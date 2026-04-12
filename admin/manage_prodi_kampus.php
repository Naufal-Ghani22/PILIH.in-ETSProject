<?php
session_start();
include '../database/koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth.php?error=Akses ditolak!");
    exit;
}

// ============================================================
// LOGIC: Simpan perubahan relasi prodi-kampus
// ============================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_relasi') {
    $id_kampus = (int)$_POST['id_kampus'];

    // Step 1: Hapus semua relasi lama
    mysqli_query($koneksi, "DELETE FROM relasi_kampus_jurusan WHERE id_kampus = $id_kampus");

    // Step 2: Insert ulang yang dicentang
    if (!empty($_POST['jurusan_ids']) && is_array($_POST['jurusan_ids'])) {
        foreach ($_POST['jurusan_ids'] as $id_jur) {
            $id_jur = (int)$id_jur;
            if ($id_jur > 0) {
                mysqli_query($koneksi,
                    "INSERT INTO relasi_kampus_jurusan (id_kampus, id_jurusan) VALUES ($id_kampus, $id_jur)"
                );
            }
        }
    }

    header("Location: manage_prodi_kampus.php?id_kampus=$id_kampus&success=Prodi berhasil diperbarui!");
    exit;
}

// ============================================================
// Ambil semua kampus
// ============================================================
$all_kampus = [];
$q = mysqli_query($koneksi, "SELECT * FROM kampus ORDER BY nama_kampus ASC");
while ($r = mysqli_fetch_assoc($q)) {
    $all_kampus[] = $r;
}

// Kampus yang dipilih — paksa int agar perbandingan aman
$selected_id = isset($_GET['id_kampus']) ? (int)$_GET['id_kampus'] : 0;
if ($selected_id === 0 && !empty($all_kampus)) {
    $selected_id = (int)$all_kampus[0]['id_kampus'];
}

$selected_kampus = null;
foreach ($all_kampus as $k) {
    if ((int)$k['id_kampus'] === $selected_id) {
        $selected_kampus = $k;
        break;
    }
}

// ============================================================
// Ambil semua jurusan
// ============================================================
$all_jurusan = [];
$q2 = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
while ($r = mysqli_fetch_assoc($q2)) {
    $all_jurusan[] = $r;
}

// ID jurusan yang sudah terhubung (array of int)
$terhubung = [];
if ($selected_id > 0) {
    $q3 = mysqli_query($koneksi, "SELECT id_jurusan FROM relasi_kampus_jurusan WHERE id_kampus = $selected_id");
    while ($r = mysqli_fetch_assoc($q3)) {
        $terhubung[] = (int)$r['id_jurusan'];
    }
}

// Kelompokkan per kategori utama
$per_kategori = [];
foreach ($all_jurusan as $j) {
    $kat = trim(explode(',', $j['kategori_relevan'])[0]);
    $per_kategori[$kat][] = $j;
}
ksort($per_kategori);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodi per Kampus - PILIH.in Admin</title>
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans">
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white p-6 flex-shrink-0">
        <h2 class="text-2xl font-bold mb-8">PILIH.in <span class="text-purple-400 text-sm">Admin</span></h2>
        <nav class="space-y-2">
            <a href="dashboard.php"           class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">Dashboard</a>
            <a href="manage_majors.php"       class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">Kelola Jurusan</a>
            <a href="manage_campuses.php"     class="block px-3 py-2 rounded-lg hover:bg-slate-700 hover:text-purple-400 transition">Kelola Kampus</a>
            <a href="manage_prodi_kampus.php" class="block px-3 py-2 rounded-lg bg-purple-700 text-white font-bold">📌 Prodi per Kampus</a>
            <hr class="border-slate-700 my-2">
            <a href="../logout.php"           class="block px-3 py-2 rounded-lg text-red-400 hover:bg-slate-700 transition">Logout</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8 overflow-auto">

        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-800">Prodi per Kampus</h1>
            <p class="text-slate-500 mt-1">Pilih kampus, centang prodi yang tersedia, lalu klik Simpan.</p>
        </div>

        <?php if (isset($_GET['success'])): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl font-semibold mb-6 flex items-center gap-3">
            <span>✅</span>
            <span><?= htmlspecialchars($_GET['success']) ?></span>
        </div>
        <?php endif; ?>

        <div class="flex gap-6">

            <!-- Kolom kiri: daftar kampus -->
            <div class="w-60 flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="bg-slate-800 text-white px-4 py-3">
                        <h3 class="font-bold text-xs uppercase tracking-widest">Pilih Kampus</h3>
                    </div>
                    <ul class="divide-y divide-slate-100">
                        <?php foreach ($all_kampus as $k): 
                            $is_active = ((int)$k['id_kampus'] === $selected_id);
                        ?>
                        <li>
                            <a href="manage_prodi_kampus.php?id_kampus=<?= (int)$k['id_kampus'] ?>"
                               class="flex items-center gap-3 px-4 py-3 transition
                                      <?= $is_active
                                          ? 'bg-indigo-50 border-l-4 border-indigo-500 font-bold text-indigo-700'
                                          : 'hover:bg-slate-50 text-slate-700 border-l-4 border-transparent' ?>">
                                <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 font-bold text-xs flex items-center justify-center flex-shrink-0">
                                    <?= strtoupper(substr($k['nama_kampus'], 0, 2)) ?>
                                </div>
                                <span class="text-sm leading-tight"><?= htmlspecialchars($k['nama_kampus']) ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="px-4 py-3 border-t border-slate-100">
                        <a href="manage_campuses.php" class="text-xs text-indigo-600 font-bold hover:underline block text-center">
                            + Tambah Kampus Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kolom kanan: checkbox prodi -->
            <div class="flex-1">
                <?php if ($selected_kampus): ?>
                <form method="POST" action="manage_prodi_kampus.php">
                    <input type="hidden" name="action" value="update_relasi">
                    <input type="hidden" name="id_kampus" value="<?= $selected_id ?>">

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 mb-5">

                        <!-- Header kampus -->
                        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                            <div>
                                <h2 class="text-lg font-extrabold text-slate-800"><?= htmlspecialchars($selected_kampus['nama_kampus']) ?></h2>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    📍 <?= htmlspecialchars($selected_kampus['lokasi']) ?>
                                    &nbsp;·&nbsp; Akreditasi <strong><?= htmlspecialchars($selected_kampus['akreditasi']) ?></strong>
                                </p>
                            </div>
                            <span id="counter" class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                                <?= count($terhubung) ?> aktif
                            </span>
                        </div>

                        <!-- Quick actions -->
                        <div class="flex gap-4 px-6 py-2 bg-slate-50 border-b border-slate-100 text-xs">
                            <button type="button" onclick="setAll(true)"  class="text-indigo-600 font-semibold hover:underline">✔ Centang Semua</button>
                            <button type="button" onclick="setAll(false)" class="text-slate-500 font-semibold hover:underline">✖ Hapus Semua</button>
                        </div>

                        <!-- List prodi per kategori -->
                        <div class="p-6 space-y-7">
                            <?php foreach ($per_kategori as $kat => $jurusan_list): ?>
                            <div>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3 pb-1 border-b border-slate-100">
                                    <?= htmlspecialchars($kat) ?>
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-2">
                                    <?php foreach ($jurusan_list as $j):
                                        $checked = in_array((int)$j['id_jurusan'], $terhubung);
                                    ?>
                                    <label class="prodi-label flex items-center gap-3 px-4 py-3 rounded-xl border-2 cursor-pointer select-none transition
                                                  <?= $checked
                                                      ? 'border-indigo-400 bg-indigo-50'
                                                      : 'border-slate-100 bg-slate-50 hover:border-slate-200' ?>">
                                        <input
                                            type="checkbox"
                                            name="jurusan_ids[]"
                                            value="<?= (int)$j['id_jurusan'] ?>"
                                            class="prodi-cb"
                                            <?= $checked ? 'checked' : '' ?>
                                        >
                                        <!-- Custom checkmark -->
                                        <span class="prodi-box flex-shrink-0 w-5 h-5 rounded border-2 flex items-center justify-center transition
                                                     <?= $checked
                                                         ? 'bg-indigo-600 border-indigo-600'
                                                         : 'bg-white border-slate-300' ?>">
                                            <svg class="w-3 h-3 text-white <?= $checked ? '' : 'opacity-0' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </span>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-slate-800 leading-tight truncate"><?= htmlspecialchars($j['nama_jurusan']) ?></p>
                                            <p class="text-xs text-slate-400 truncate"><?= htmlspecialchars($j['kategori_relevan']) ?></p>
                                        </div>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex justify-end gap-3">
                        <a href="manage_prodi_kampus.php?id_kampus=<?= $selected_id ?>"
                           class="px-6 py-3 rounded-xl bg-slate-100 text-slate-600 font-bold hover:bg-slate-200 transition">
                            Reset
                        </a>
                        <button type="submit"
                                class="px-8 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 transition">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>

                <?php else: ?>
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center text-slate-400">
                    <div class="text-5xl mb-4">🏫</div>
                    <p class="font-semibold">Pilih kampus dari daftar sebelah kiri.</p>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </main>
</div>

<script>
// Update visual label + counter setiap kali checkbox berubah
document.querySelectorAll('.prodi-cb').forEach(cb => {
    cb.addEventListener('change', function () {
        updateLabel(this);
        updateCounter();
    });
});

function updateLabel(cb) {
    const label = cb.closest('.prodi-label');
    const box   = label.querySelector('.prodi-box');
    const svg   = box.querySelector('svg');

    if (cb.checked) {
        label.classList.add('border-indigo-400', 'bg-indigo-50');
        label.classList.remove('border-slate-100', 'bg-slate-50');
        box.classList.add('bg-indigo-600', 'border-indigo-600');
        box.classList.remove('bg-white', 'border-slate-300');
        svg.classList.remove('opacity-0');
    } else {
        label.classList.remove('border-indigo-400', 'bg-indigo-50');
        label.classList.add('border-slate-100', 'bg-slate-50');
        box.classList.remove('bg-indigo-600', 'border-indigo-600');
        box.classList.add('bg-white', 'border-slate-300');
        svg.classList.add('opacity-0');
    }
}

function updateCounter() {
    const count = document.querySelectorAll('.prodi-cb:checked').length;
    document.getElementById('counter').textContent = count + ' aktif';
}

function setAll(state) {
    document.querySelectorAll('.prodi-cb').forEach(cb => {
        cb.checked = state;
        updateLabel(cb);
    });
    updateCounter();
}
</script>
</body>
</html>
