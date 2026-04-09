<?php
// roadmap.php - Menampilkan timeline pembelajaran per semester
// Fungsi: Query data dari tabel roadmap, tampilkan per semester dengan skill
// MODE DEBUG: Menggunakan data dummy untuk testing UI

// Simulasi data jurusan
$jurusan = [
    'id_jurusan' => 1,
    'nama_jurusan' => 'Sistem Informasi',
    'deskripsi_singkat' => 'Program studi yang mempelajari perancangan, pengembangan, dan pengelolaan sistem informasi untuk mendukung operasional bisnis modern.'
];

// Simulasi data roadmap per semester
$roadmap_data = [
    1 => [
        ['nama_matkul' => 'Dasar Pemrograman', 'kategori_matkul' => 'Fondasi', 'skill_didapat' => 'Logic, Syntax, Problem Solving'],
        ['nama_matkul' => 'Pengantar Sistem Informasi', 'kategori_matkul' => 'Fondasi', 'skill_didapat' => 'Konsep SI, Enterprise Systems, ERP']
    ],
    2 => [
        ['nama_matkul' => 'Web Development', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'HTML, CSS, JavaScript, Responsive Design'],
        ['nama_matkul' => 'Database Management', 'kategori_matkul' => 'Fondasi', 'skill_didapat' => 'SQL, Normalisasi, Query Optimization']
    ],
    3 => [
        ['nama_matkul' => 'Object Oriented Programming', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'OOP, Design Patterns, SOLID Principles'],
        ['nama_matkul' => 'Sistem Basis Data Lanjut', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'Advanced SQL, Indexing, Tuning']
    ],
    4 => [
        ['nama_matkul' => 'Software Engineering', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'SDLC, Agile, Testing, Documentation'],
        ['nama_matkul' => 'Jaringan Komputer', 'kategori_matkul' => 'Fondasi', 'skill_didapat' => 'Networking, TCP/IP, Security']
    ],
    5 => [
        ['nama_matkul' => 'Mobile App Development', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'Android, iOS, Flutter, React Native'],
        ['nama_matkul' => 'Business Process Analysis', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'BPM, Process Mapping, Optimization']
    ],
    6 => [
        ['nama_matkul' => 'Cloud Computing & DevOps', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'AWS, Docker, CI/CD, Kubernetes'],
        ['nama_matkul' => 'Information Security', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'Cryptography, Threat Analysis, Compliance']
    ],
    7 => [
        ['nama_matkul' => 'Data Analytics & Big Data', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'Python, R, Hadoop, Spark, Visualization'],
        ['nama_matkul' => 'Manajemen Proyek IT', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'Project Management, Risk Assessment, Stakeholder']
    ],
    8 => [
        ['nama_matkul' => 'AI & Machine Learning', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'ML Algorithms, Deep Learning, TensorFlow'],
        ['nama_matkul' => 'Skripsi/Capstone Project', 'kategori_matkul' => 'Profesional', 'skill_didapat' => 'Research, Implementation, Presentation']
    ]
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
    <title><?= htmlspecialchars($jurusan['nama_jurusan']) ?> - Roadmap - PILIH.in</title>
    <link href="./src/output.css" rel="stylesheet">
</head>
<body class="bg-base font-sans text-slate-800">
    <?php include 'components/navbar.php'; ?>
    
    <main class="pt-16 pb-20 container mx-auto px-4 lg:px-12">
        
        <!-- Header -->
        <section class="mb-16">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-4xl font-bold text-slate-800 mb-2">📚 <?= htmlspecialchars($jurusan['nama_jurusan']) ?></h1>
                    <p class="text-slate-600"><?= htmlspecialchars($jurusan['deskripsi_singkat']) ?></p>
                </div>
            </div>
        </section>

        <!-- Timeline Container -->
        <div class="relative mb-20">
            <!-- Vertical Line -->
            <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-primary to-secondary"></div>

            <!-- Timeline Semesters -->
            <div class="space-y-12">
                <?php foreach($roadmap_data as $semester => $matkuls): ?>
                    <div class="relative">
                        <!-- Connection Dot -->
                        <div class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-6">
                            <div class="w-6 h-6 bg-white border-4 border-primary rounded-full shadow-lg"></div>
                        </div>

                        <!-- Semester Card -->
                        <div class="lg:w-1/2 <?= $semester % 2 === 0 ? 'lg:ml-auto' : '' ?> bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition">
                            
                            <!-- Semester Header -->
                            <div class="flex items-center gap-3 mb-6">
                                <div class="bg-primary/10 text-primary font-bold text-xl w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                                    <?= $semester ?>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800">Semester <?= $semester ?></h3>
                                    <p class="text-xs text-slate-500"><?= $semester <= 4 ? 'Tahun ' . ceil($semester/2) . ' (Ganjil)' : 'Tahun ' . ceil($semester/2) . ' (Genap)' ?></p>
                                </div>
                            </div>

                            <!-- Courses List -->
                            <div class="space-y-3">
                                <?php foreach($matkuls as $matkul): ?>
                                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-100 hover:border-primary transition">
                                        <div class="flex items-start gap-3">
                                            <!-- Category Badge -->
                                            <div class="flex-shrink-0 mt-1">
                                                <?php if($matkul['kategori_matkul'] === 'Fondasi'): ?>
                                                    <span class="inline-block bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">🔷 Fondasi</span>
                                                <?php else: ?>
                                                    <span class="inline-block bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">🟢 Profesional</span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Course Details -->
                                            <div class="flex-1">
                                                <p class="font-semibold text-slate-800"><?= htmlspecialchars($matkul['nama_matkul']) ?></p>
                                                <p class="text-xs text-slate-600 mt-1">
                                                    <strong>Skill:</strong> <?= htmlspecialchars($matkul['skill_didapat'] ?? 'Skill tidak disebutkan') ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-2xl p-6 border border-slate-100">
                <div class="text-3xl mb-2">📖</div>
                <p class="font-bold text-slate-800">Total Semester</p>
                <p class="text-2xl text-primary font-bold"><?= count($roadmap_data) ?></p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100">
                <div class="text-3xl mb-2">📚</div>
                <p class="font-bold text-slate-800">Total Mata Kuliah</p>
                <p class="text-2xl text-primary font-bold"><?= array_sum(array_map('count', $roadmap_data)) ?></p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100">
                <div class="text-3xl mb-2">🎯</div>
                <p class="font-bold text-slate-800">Kompetensi Inti</p>
                <p class="text-sm text-slate-600 mt-2">Fondasi + Profesional</p>
            </div>
        </div>

        <!-- Action Section -->
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 border border-primary/20 rounded-2xl p-8 text-center">
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Siap Memulai Perjalanan? 🚀</h3>
            <p class="text-slate-600 mb-6">Daftar ke kampus pilihan dan mulai belajar dengan roadmap yang telah kami siapkan.</p>
            <button onclick="alert('Fitur pencarian kampus akan segera hadir!')" class="inline-block bg-primary text-white font-bold py-3 px-8 rounded-xl hover:opacity-90 transition shadow-lg shadow-primary/30 cursor-pointer">
                Cari Kampus Terbaik
            </button>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>
