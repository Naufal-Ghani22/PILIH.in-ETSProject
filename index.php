<?php
session_start();
require_once 'database/koneksi.php';

// Ambil TOP 5 kampus dinamis dari DB (urutkan berdasarkan jumlah prodi terbanyak)
$q_kampus = mysqli_query(
    $koneksi,
    "SELECT k.id_kampus, k.nama_kampus, k.lokasi, k.akreditasi, k.estimasi_biaya, k.logo_kampus,
            COUNT(r.id_jurusan) as jumlah_prodi
     FROM kampus k
     LEFT JOIN relasi_kampus_jurusan r ON k.id_kampus = r.id_kampus
     GROUP BY k.id_kampus
     ORDER BY jumlah_prodi DESC, k.nama_kampus ASC
     LIMIT 5"
);
$top_kampus = [];
while ($r = mysqli_fetch_assoc($q_kampus))
    $top_kampus[] = $r;
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PILIH.in - Navigasi Masa Depanmu</title>
    <meta name="description"
        content="PILIH.in membantu kamu menemukan jurusan dan kampus terbaik berdasarkan minat bakat. Dapatkan roadmap karir semester 1-8 secara instan.">
    <link href="./src/output.css" rel="stylesheet">
    <link href="./src/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        /* ── Slider kampus ── */
        .campus-track {
            display: flex;
            gap: 1.5rem;
            transition: transform 0.5s cubic-bezier(.4, 0, .2, 1);
        }

        .campus-slide {
            flex: 0 0 320px;
            transition: transform 0.4s, box-shadow 0.4s, opacity 0.4s;
            opacity: 0.6;
            transform: scale(0.93);
        }

        .campus-slide.active {
            opacity: 1;
            transform: scale(1.04);
        }

        /* ── Tutorial connector line ── */
        .step-connector {
            position: absolute;
            top: 2.5rem;
            left: calc(50% + 2.5rem);
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #a855f7, #6366f1);
        }

        .step-connector:last-child {
            display: none;
        }

        /* ── FAQ accordion ── */
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
        }

        .faq-answer.open {
            max-height: 400px;
        }

        .faq-icon {
            transition: transform 0.3s;
        }

        .faq-item.open .faq-icon {
            transform: rotate(45deg);
        }

        /* ── Scroll reveal ── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .6s ease, transform .6s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }
    </style>
</head>

<body
    class="font-sans text-slate-800 bg-slate-50 flex flex-col min-h-screen overflow-x-hidden selection:bg-purple-200 selection:text-purple-900">

    <?php include 'components/navbar.php'; ?>

    <main class="flex-grow relative">

        <!-- ══════════════════════════════════════════ -->
        <!--  HERO SECTION                              -->
        <!-- ══════════════════════════════════════════ -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-purple-300/40 rounded-full blur-[100px]">
            </div>
            <div
                class="absolute bottom-[20%] right-[-10%] w-[400px] h-[400px] bg-indigo-300/40 rounded-full blur-[100px]">
            </div>
        </div>

        <section class="pt-16 pb-20 lg:pt-24 lg:pb-32 px-4">
            <div class="container mx-auto max-w-6xl">
                <div
                    class="relative bg-white/40 backdrop-blur-2xl border border-white/60 shadow-2xl rounded-[3rem] p-8 md:p-16 lg:p-20 text-center overflow-hidden">
                    <div
                        class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-32 bg-gradient-to-b from-purple-100/50 to-transparent rounded-full blur-2xl">
                    </div>

                    <div class="relative z-10 max-w-3xl mx-auto">
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 border border-purple-100 shadow-sm mb-8">
                            <span class="flex h-2 w-2 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-600"></span>
                            </span>
                            <span class="text-xs font-bold tracking-wide text-purple-700 uppercase">Akurasi Algoritma
                                95%</span>
                        </div>

                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-8 text-slate-900">
                            Navigasi Masa Depan <br class="hidden md:block">
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-500">Bukan
                                Sekadar Tebakan.</span>
                        </h1>

                        <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed font-medium">
                            Tinggalkan kebingungan. PILIH.in memetakan minat bakatmu menjadi <strong
                                class="text-slate-800">Roadmap Karir Semester 1-8</strong> secara instan dengan data
                            terstandarisasi DIKTI.
                        </p>

                        <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="dashboard.php"
                                    class="w-full sm:w-auto px-8 py-4 bg-slate-900 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                                    Buka Dashboard Saya
                                </a>
                            <?php else: ?>
                                <a href="tes.php"
                                    class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-purple-500/30 hover:shadow-2xl hover:shadow-purple-500/50 hover:-translate-y-1 transition duration-300">
                                    Mulai Assessment Gratis
                                </a>
                                <a href="kampus.php"
                                    class="w-full sm:w-auto px-8 py-4 bg-white/80 backdrop-blur-md text-slate-700 font-bold rounded-2xl hover:bg-white transition duration-300 border border-slate-200 shadow-sm hover:shadow-md">
                                    Eksplorasi Kampus
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Mock preview -->
                <div class="mt-[-4rem] md:mt-[10rem] relative z-20 max-w-5xl mx-auto px-4">
                    <div class="bg-white/80 backdrop-blur-xl border border-white/50 p-2 rounded-3xl shadow-2xl">
                        <div
                            class="bg-slate-50 border border-slate-100 rounded-2xl h-48 md:h-80 overflow-hidden relative flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-50 opacity-50"></div>
                            <div class="text-center z-10 opacity-40">
                                <span class="text-6xl block mb-2">📊</span>
                                <p class="font-bold text-slate-400 font-mono text-sm tracking-widest uppercase">
                                    Visualisasi Roadmap Interactive</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════ -->
        <!--  FITUR UNGGULAN (3 cards)                  -->
        <!-- ══════════════════════════════════════════ -->
        <section class="py-20 relative z-10">
            <div class="container mx-auto px-4 lg:px-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10">
                    <?php
                    $features = [
                        [
                            'icon' => 'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99',
                            'title' => 'Analisis Instan',
                            'desc' => 'Algoritma cerdas memproses jawabanmu dalam hitungan milidetik untuk hasil yang sangat presisi.'
                        ],
                        [
                            'icon' => 'M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9',
                            'title' => 'Roadmap Terstruktur',
                            'desc' => 'Peta jalan akademik lengkap dengan rincian mata kuliah krusial dari semester pertama hingga lulus.'
                        ],
                        [
                            'icon' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z',
                            'title' => 'Prospek Industri 4.0',
                            'desc' => 'Rekomendasi yang diselaraskan langsung dengan kebutuhan skill industri dan peluang karir masa depan.'
                        ],
                    ];
                    foreach ($features as $f): ?>
                        <div
                            class="reveal bg-white/60 backdrop-blur-lg p-8 rounded-[2rem] border border-white/60 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300">
                            <div
                                class="w-14 h-14 bg-white border border-purple-100 shadow-sm text-purple-600 flex items-center justify-center rounded-2xl mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="<?= $f['icon'] ?>" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-xl mb-3 text-slate-800"><?= $f['title'] ?></h3>
                            <p class="text-slate-500 text-sm leading-relaxed"><?= $f['desc'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════ -->
        <!--  ALUR TUTORIAL                             -->
        <!-- ══════════════════════════════════════════ -->
        <section class="py-24 bg-white relative overflow-hidden">
            <!-- Background accent -->
            <div class="absolute inset-0 -z-0 pointer-events-none">
                <div
                    class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-purple-50 rounded-full blur-3xl opacity-60">
                </div>
            </div>
            <div class="container mx-auto px-4 lg:px-12 relative z-10">
                <div class="text-center mb-16 reveal">
                    <span
                        class="inline-block text-2xl font-bold uppercase tracking-widest text-purple-600 bg-purple-50 px-4 py-2 rounded-full mb-4">Cara
                        Kerja</span>
                    <h2 class="text-6xl font-extrabold text-slate-900 mb-4">Mulai dalam <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-500">4
                            Langkah Mudah</span></h2>
                    <p class="text-slate-500 max-w-3xl mx-auto">Dari mendaftar hingga mendapatkan roadmap karir lengkap
                        —
                        semuanya cepat dan gratis.</p>
                </div>

                <!-- 5 langkah sejajar horizontal -->
                <?php
                $svg1 = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>';
                $svg2 = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" /></svg>';
                $svg3 = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>';
                $svg4 = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>';
                $svg5 = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>';

                $steps = [
                    ['emoji' => $svg1, 'color' => 'from-purple-500 to-purple-600', 'title' => 'Daftar Akun', 'desc' => 'Buat akun gratis dalam 30 detik. Tidak perlu kartu kredit.'],
                    ['emoji' => $svg2, 'color' => 'from-indigo-500 to-indigo-600', 'title' => 'Jawab Assessment', 'desc' => 'Ikuti 10 pertanyaan minat bakat yang dirancang psikolog profesional.'],
                    ['emoji' => $svg3, 'color' => 'from-violet-500 to-violet-600', 'title' => 'Lihat Hasil', 'desc' => 'Dapatkan rekomendasi jurusan dengan skor kecocokan dan analisis mendalam.'],
                    ['emoji' => $svg4, 'color' => 'from-purple-600 to-indigo-600', 'title' => 'Eksplorasi Roadmap', 'desc' => 'Akses roadmap semester 1-8 dan temukan kampus terbaik untukmu.'],
                    ['emoji' => $svg5, 'color' => 'from-fuchsia-500 to-purple-600', 'title' => 'Pertimbangkan Pilihanmu', 'desc' => 'Pilih jurusan dan kampus yang paling sesuai dengan minat dan bakatmu.'],
                ];
                ?>

                <div class="relative">
                    <!-- Garis horizontal di balik semua ikon -->
                    <div
                        class="absolute top-9 left-[5%] right-[5%] h-0.5 bg-gradient-to-r from-purple-300 via-indigo-300 to-fuchsia-300 z-0">
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1.5rem;"
                        class="relative z-10 overflow-x-auto pb-4">
                        <?php foreach ($steps as $i => $s): ?>
                            <div class="reveal flex flex-col items-center text-center px-2"
                                style="transition-delay: <?= $i * 100 ?>ms">
                                <!-- Ikon -->
                                <div class="relative mb-4 shrink-0">
                                    <div
                                        class="w-16 h-16 sm:w-[4.5rem] sm:h-[4.5rem] rounded-full bg-gradient-to-br <?= $s['color'] ?> flex items-center justify-center shadow-lg hover:scale-110 transition duration-300 ring-4 ring-white z-10 relative">
                                        <?= $s['emoji'] ?>
                                    </div>
                                </div>
                                <!-- Teks -->
                                <h3 class="font-bold text-slate-800 text-xl sm:text-sm mb-1"><?= $s['title'] ?></h3>
                                <p class="text-slate-500 text-[10px] sm:text-xs leading-relaxed"><?= $s['desc'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>


                <!-- CTA di bawah tutorial -->
                <div class="text-center mt-16 reveal">
                    <a href="tes.php"
                        class="inline-flex items-center gap-3 px-10 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-purple-500/30 hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                        <span>Coba Sekarang</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════ -->
        <!--  TOP 5 KAMPUS — AUTO SLIDER                -->
        <!-- ══════════════════════════════════════════ -->
        <section class="py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 overflow-hidden">
            <!-- Heading tetap dalam container -->
            <div class="container mx-auto px-4 lg:px-12">
                <div class="text-center mb-14 reveal">
                    <span
                        class="inline-block text-xs font-bold uppercase tracking-widest text-purple-400 bg-purple-900/40 px-4 py-2 rounded-full mb-4">Kampus
                        Terbaik</span>
                    <h2 class="text-4xl font-extrabold text-white mb-4">Top Kampus <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-indigo-400">PILIH.in</span>
                    </h2>
                    <p class="text-slate-400 max-w-md mx-auto">Universitas-universitas ini memiliki program studi
                        terlengkap dalam platform kami.</p>
                </div>
            </div>

            <?php if (!empty($top_kampus)): ?>
                <!-- Slider full-width di luar container agar fade edge mentok ke tepi section -->
                <div class="relative" id="sliderContainer">
                    <!-- Fade edges mentok ke tepi kiri/kanan section -->
                    <div
                        class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-slate-900 to-transparent z-10 pointer-events-none">
                    </div>
                    <div
                        class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-slate-900 to-transparent z-10 pointer-events-none">
                    </div>

                    <div class="overflow-hidden">
                        <div id="campusTrack" class="campus-track">
                            <?php foreach ($top_kampus as $idx => $k): ?>
                                <div class="campus-slide <?= $idx === 0 ? 'active' : '' ?>" data-index="<?= $idx ?>">
                                    <div
                                        class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition duration-300 h-full">
                                        <!-- Logo & nama -->
                                        <div class="flex items-center gap-4 mb-6">
                                            <div
                                                class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center overflow-hidden shadow-lg flex-shrink-0">
                                                <?php if (!empty($k['logo_kampus'])): ?>
                                                    <img src="img/<?= htmlspecialchars($k['logo_kampus']) ?>"
                                                        alt="Logo <?= htmlspecialchars($k['nama_kampus']) ?>"
                                                        class="w-full h-full object-contain p-1">
                                                <?php else: ?>
                                                    <span
                                                        class="text-2xl font-black text-purple-600"><?= strtoupper(substr($k['nama_kampus'], 0, 2)) ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-white text-lg leading-tight">
                                                    <?= htmlspecialchars($k['nama_kampus']) ?>
                                                </h3>
                                                <p class="text-slate-400 text-sm">📍 <?= htmlspecialchars($k['lokasi']) ?></p>
                                            </div>
                                        </div>
                                        <!-- Badge akreditasi -->
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span
                                                class="bg-purple-500/20 text-purple-300 border border-purple-500/30 text-xs font-bold px-3 py-1 rounded-full">
                                                Akreditasi <?= htmlspecialchars($k['akreditasi']) ?>
                                            </span>
                                            <span
                                                class="bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 text-xs font-bold px-3 py-1 rounded-full">
                                                <?= (int) $k['jumlah_prodi'] ?> Prodi
                                            </span>
                                        </div>
                                        <!-- Estimasi biaya -->
                                        <p class="text-slate-400 text-xs mb-6">💰 <?= htmlspecialchars($k['estimasi_biaya']) ?>
                                        </p>
                                        <a href="kampus.php"
                                            class="block w-full text-center py-2.5 rounded-xl border border-white/20 text-white text-sm font-semibold hover:bg-white/10 transition">
                                            Lihat Detail →
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Dot indicators -->
                    <div class="flex justify-center gap-2 mt-8" id="sliderDots">
                        <?php foreach ($top_kampus as $idx => $k): ?>
                            <button onclick="goToSlide(<?= $idx ?>)"
                                class="dot w-2.5 h-2.5 rounded-full transition-all duration-300 <?= $idx === 0 ? 'bg-purple-400 w-6' : 'bg-slate-600' ?>">
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Prev / Next arrows -->
                    <button onclick="prevSlide()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">‹</button>
                    <button onclick="nextSlide()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition">›</button>
                </div>
            <?php else: ?>
                <div class="container mx-auto px-4 lg:px-12">
                    <p class="text-center text-slate-500">Belum ada data kampus.</p>
                </div>
            <?php endif; ?>
        </section>

        <!-- ══════════════════════════════════════════ -->
        <!--  FAQ                                       -->
        <!-- ══════════════════════════════════════════ -->
        <section class="py-24 bg-white">
            <div class="container mx-auto px-4 lg:px-12 max-w-3xl">
                <div class="text-center mb-14 reveal">
                    <span
                        class="inline-block text-xs font-bold uppercase tracking-widest text-purple-600 bg-purple-50 px-4 py-2 rounded-full mb-4">FAQ</span>
                    <h2 class="text-4xl font-extrabold text-slate-900 mb-4">Pertanyaan <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-500">yang
                            Sering Ditanya</span></h2>
                    <p class="text-slate-500">Semua yang perlu kamu tahu sebelum mulai.</p>
                </div>

                <div class="space-y-3 reveal">
                    <?php
                    $faqs = [
                        [
                            'q' => 'Apakah PILIH.in gratis digunakan?',
                            'a' => 'Ya, 100% gratis! Kamu bisa mendaftar, mengerjakan tes minat bakat, dan mendapatkan rekomendasi jurusan beserta roadmap lengkapnya tanpa biaya apapun.'
                        ],
                        [
                            'q' => 'Berapa lama waktu mengerjakan tes?',
                            'a' => 'Tes terdiri dari 10 pertanyaan dan rata-rata selesai dalam 3–5 menit. Tidak ada batas waktu, jadi kamu bisa menjawab dengan tenang dan jujur.'
                        ],
                        [
                            'q' => 'Seberapa akurat rekomendasinya?',
                            'a' => 'Algoritma kami memiliki tingkat akurasi 95% berdasarkan pemetaan kategori minat terhadap data jurusan terstandarisasi DIKTI. Semakin jujur jawabanmu, semakin tepat rekomendasinya.'
                        ],
                        [
                            'q' => 'Apakah saya bisa mengerjakan tes lebih dari sekali?',
                            'a' => 'Bisa! Kamu bisa mengambil tes ulang kapan saja dan semua riwayat hasil tersimpan di dashboard-mu untuk dibandingkan.'
                        ],
                        [
                            'q' => 'Apakah roadmap bisa digunakan untuk semua jurusan?',
                            'a' => 'Saat ini roadmap tersedia untuk 7 jurusan populer (Teknik Informatika, Sistem Informasi, Akuntansi, Manajemen, Psikologi, Teknik Sipil, Desain Komunikasi Visual) dan terus dikembangkan.'
                        ],
                        [
                            'q' => 'Data saya aman?',
                            'a' => 'Keamanan data adalah prioritas kami. Password disimpan dengan enkripsi bcrypt dan kami tidak pernah membagikan data pribadimu ke pihak ketiga.'
                        ],
                    ];
                    foreach ($faqs as $i => $faq): ?>
                        <div
                            class="faq-item border border-slate-100 rounded-2xl overflow-hidden hover:border-purple-100 transition">
                            <button class="faq-trigger w-full flex items-center justify-between px-6 py-5 text-left"
                                onclick="toggleFAQ(this)">
                                <span class="font-semibold text-slate-800 pr-4"><?= $faq['q'] ?></span>
                                <span
                                    class="faq-icon flex-shrink-0 w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-lg">+</span>
                            </button>
                            <div class="faq-answer">
                                <p class="px-6 pb-5 text-slate-500 text-sm leading-relaxed"><?= $faq['a'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </main>

    <?php include 'components/footer.php'; ?>

    <!-- ══════════════════════════════════════════ -->
    <!--  JAVASCRIPT                                -->
    <!-- ══════════════════════════════════════════ -->
    <script>
        // ── FAQ ──────────────────────────────────────
        function toggleFAQ(btn) {
            const item = btn.closest('.faq-item');
            const answer = item.querySelector('.faq-answer');
            const isOpen = item.classList.contains('open');

            // Tutup semua
            document.querySelectorAll('.faq-item.open').forEach(el => {
                el.classList.remove('open');
                el.querySelector('.faq-answer').classList.remove('open');
            });

            // Buka yang diklik (jika sebelumnya tertutup)
            if (!isOpen) {
                item.classList.add('open');
                answer.classList.add('open');
            }
        }

        // ── CAMPUS SLIDER ────────────────────────────
        const slides = document.querySelectorAll('.campus-slide');
        const track = document.getElementById('campusTrack');
        const dots = document.querySelectorAll('.dot');
        const total = slides.length;
        let current = 0;
        let autoTimer = null;

        function getOffset() {
            // Tengah-kan slide aktif di viewport
            const container = document.getElementById('sliderContainer');
            const cw = container.offsetWidth;
            const sw = 320 + 24; // slide width + gap
            const center = cw / 2 - sw / 2;
            return center - current * sw;
        }

        function goToSlide(idx) {
            slides[current].classList.remove('active');
            dots[current].classList.remove('bg-purple-400', 'w-6');
            dots[current].classList.add('bg-slate-600');

            current = (idx + total) % total;

            slides[current].classList.add('active');
            dots[current].classList.add('bg-purple-400', 'w-6');
            dots[current].classList.remove('bg-slate-600');

            track.style.transform = `translateX(${getOffset()}px)`;
        }

        function nextSlide() { resetAuto(); goToSlide(current + 1); }
        function prevSlide() { resetAuto(); goToSlide(current - 1); }

        function resetAuto() {
            clearInterval(autoTimer);
            autoTimer = setInterval(() => goToSlide(current + 1), 3500);
        }

        // Init posisi & auto slide
        if (total > 0) {
            goToSlide(0);
            resetAuto();
            window.addEventListener('resize', () => goToSlide(current));
        }

        // ── SCROLL REVEAL ────────────────────────────
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>

</html>