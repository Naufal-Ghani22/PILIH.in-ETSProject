<?php
// hasil.php - Halaman Read Only untuk menampilkan hasil tes
// Pattern: PRG (Post/Redirect/Get) - Hanya baca data, tidak proses ulang
// MODE DEBUG: Menggunakan data dummy untuk testing UI

// Simulasi data hasil tes (Ganti dengan query DB nanti)
$hasil = [
    'id_hasil' => 1,
    'nama_jurusan' => 'Sistem Informasi',
    'skor_kecocokan' => 92,
    'tanggal_tes' => '2026-04-09 14:30:00',
    'deskripsi_singkat' => 'Belajar merancang dan mengembangkan sistem informasi untuk berbagai industri. Program ini fokus pada pemrograman, database, dan teknologi informasi terkini.',
    'prospek_karir' => 'Lulusan Sistem Informasi memiliki prospek karir yang gemilang sebagai Software Developer, Database Administrator, System Analyst, IT Consultant, dan berbagai posisi strategis di perusahaan teknologi global. Gaji rata-rata entry level mencapai 4-6 juta rupiah per bulan.'
];
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes - PILIH.in</title>
    <link href="./src/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="bg-base font-sans text-slate-800">
    <?php include 'components/navbar.php'; ?>
    
    <main class="pt-32 pb-20 container mx-auto px-4 lg:px-12">
        
        <!-- Header Section -->
        <section class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-800 mb-2">Hasil Tes Minatmu 🎯</h1>
            <p class="text-slate-500">Dibuat pada: <?= date('d F Y H:i', strtotime($hasil['tanggal_tes'])) ?></p>
        </section>

        <!-- Main Result Card -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 mb-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Left: Rekomendasi Utama -->
                <div class="flex flex-col justify-center">
                    <div class="mb-6">
                        <div class="inline-block bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-semibold mb-4">
                            ✓ REKOMENDASI UTAMA
                        </div>
                        <h2 class="text-4xl font-bold text-slate-800 mb-4"><?= htmlspecialchars($hasil['nama_jurusan']) ?></h2>
                        <p class="text-slate-600 leading-relaxed mb-6"><?= htmlspecialchars($hasil['deskripsi_singkat']) ?></p>
                    </div>

                    <!-- Score Circle -->
                    <div class="flex items-end gap-6">
                        <div class="relative w-32 h-32">
                            <svg class="transform -rotate-90 w-32 h-32" viewBox="0 0 120 120">
                                <!-- Background circle -->
                                <circle cx="60" cy="60" r="54" fill="none" stroke="#e2e8f0" stroke-width="8"/>
                                <!-- Progress circle -->
                                <circle cx="60" cy="60" r="54" fill="none" stroke="#3b82f6" stroke-width="8"
                                    stroke-dasharray="<?= (340 * $hasil['skor_kecocokan'] / 100) ?> 340"
                                    stroke-linecap="round" stroke-dashoffset="0"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-3xl font-bold text-primary"><?= (int)$hasil['skor_kecocokan'] ?></span>
                                <span class="text-xs text-slate-500">%</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-slate-600 text-sm mb-2">Tingkat <br> Kecocokan</p>
                            <p class="text-xs text-slate-400">Berdasarkan jawaban tes</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Radar Chart -->
                <div>
                    <h3 class="text-lg font-bold text-slate-800 mb-4">Profil Kompetensimu</h3>
                    <canvas id="radarChart" width="300" height="300"></canvas>
                </div>

            </div>
        </div>

        <!-- Info Box: Prospek Karir -->
        <div class="bg-gradient-to-br from-primary/10 to-secondary/10 border border-primary/20 rounded-3xl p-8 mb-12">
            <h3 class="text-xl font-bold text-slate-800 mb-4">💼 Prospek Karir</h3>
            <p class="text-slate-700 leading-relaxed"><?= htmlspecialchars($hasil['prospek_karir'] ?? 'Prospek karir gemilang menanti di bidang ini!') ?></p>
        </div>

        <!-- Action Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            
            <a href="roadmap.php?jurusan=sistem_informasi" 
               class="bg-primary text-white font-semibold py-4 px-6 rounded-2xl hover:opacity-90 transition text-center shadow-lg shadow-primary/30 flex items-center justify-center gap-3">
                <span>📚 Lihat Roadmap Pembelajaran</span>
            </a>

            <button onclick="history.back()" 
               class="bg-slate-100 text-slate-800 font-semibold py-4 px-6 rounded-2xl hover:bg-slate-200 transition text-center flex items-center justify-center gap-3 cursor-pointer">
                <span>← Kembali</span>
            </button>

        </div>

        <!-- Additional Benefits -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Keuntungan Memilih Paket Tes</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex gap-4">
                    <div class="text-2xl">📖</div>
                    <div>
                        <p class="font-semibold text-slate-800">Roadmap Lengkap</p>
                        <p class="text-sm text-slate-500">Panduan semester demi semester</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="text-2xl">🎓</div>
                    <div>
                        <p class="font-semibold text-slate-800">Skill yang Dibutuhkan</p>
                        <p class="text-sm text-slate-500">List kompetensi per semester</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="text-2xl">🏆</div>
                    <div>
                        <p class="font-semibold text-slate-800">Saran Kampus Terbaik</p>
                        <p class="text-sm text-slate-500">Update rekomendasi kampus</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <!-- Chart.js Configuration -->
    <script>
        // Radar Chart Data
        const ctx = document.getElementById('radarChart').getContext('2d');
        const radarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: [
                    'Teknik & IT',
                    'Analisis & Bisnis',
                    'Kreativitas',
                    'Komunikasi',
                    'Problem Solving'
                ],
                datasets: [{
                    label: 'Skor Kompetensi',
                    data: [
                        <?= (int)$hasil['skor_kecocokan'] ?>,
                        <?= (int)($hasil['skor_kecocokan'] * 0.85) ?>,
                        <?= (int)($hasil['skor_kecocokan'] * 0.75) ?>,
                        <?= (int)($hasil['skor_kecocokan'] * 0.80) ?>,
                        <?= (int)($hasil['skor_kecocokan'] * 0.90) ?>
                    ],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 20
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
