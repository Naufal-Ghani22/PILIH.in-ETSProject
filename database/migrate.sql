-- ============================================================
-- PILIH.in - FULL DATABASE MIGRATION SCRIPT
-- Menyesuaikan schema dari temanmu + mengisi data roadmap
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- -------------------------------------------------------
-- DROP SEMUA TABLE LAMA (Urutan: child dulu, baru parent)
-- -------------------------------------------------------
DROP TABLE IF EXISTS `hasil_tes`;
DROP TABLE IF EXISTS `relasi_kampus_jurusan`;
DROP TABLE IF EXISTS `roadmap`;
DROP TABLE IF EXISTS `jurusan`;
DROP TABLE IF EXISTS `kampus`;
DROP TABLE IF EXISTS `questions`;
DROP TABLE IF EXISTS `users`;

SET FOREIGN_KEY_CHECKS = 1;

-- -------------------------------------------------------
-- TABLE: users
-- -------------------------------------------------------
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------------------
-- TABLE: questions
-- -------------------------------------------------------
CREATE TABLE `questions` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `teks_pertanyaan` text NOT NULL,
  `kategori_minat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `questions` (`id_soal`, `teks_pertanyaan`, `kategori_minat`) VALUES
(1,  'Saya merasa tertarik memahami bagaimana suatu sistem bekerja, seperti program komputer, mesin, atau alur kerja organisasi.', 'IT, Kedokteran, Teknik'),
(2,  'Saya menikmati kegiatan membantu orang lain menyelesaikan masalah pribadi atau emosional mereka.', 'Psikologi, Pendidikan'),
(3,  'Saya tertarik menciptakan sesuatu yang baru, seperti desain, tulisan, atau ide kreatif.', 'Desain, Seni'),
(4,  'Saya merasa nyaman memimpin kelompok dan mengambil keputusan penting dalam suatu tim.', 'Manajemen, Bisnis'),
(5,  'Saya menyukai pekerjaan yang membutuhkan ketelitian tinggi, seperti mengelola data atau membuat laporan.', 'Akuntansi, Administrasi'),
(6,  'Saya tertarik melakukan eksperimen, penelitian, atau analisis untuk menemukan jawaban dari suatu masalah.', 'IT, Kedokteran, Teknik'),
(7,  'Saya menikmati aktivitas yang melibatkan kerja langsung di lapangan atau menggunakan alat dan teknologi.', 'Teknik, Otomotif'),
(8,  'Saya tertarik pada dunia bisnis, seperti menjual produk, membuat strategi pemasaran, atau membangun usaha.', 'Manajemen, Bisnis'),
(9,  'Saya merasa puas ketika bisa mengajarkan sesuatu kepada orang lain atau berbagi ilmu.', 'Psikologi, Pendidikan'),
(10, 'Saya senang mengikuti aturan yang jelas dan bekerja dengan prosedur yang terstruktur.', 'Akuntansi, Administrasi');

-- -------------------------------------------------------
-- TABLE: jurusan
-- -------------------------------------------------------
CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) NOT NULL,
  `deskripsi_singkat` text NOT NULL,
  `kategori_relevan` varchar(50) NOT NULL,
  `prospek_karir` text DEFAULT NULL,
  `gambar_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `deskripsi_singkat`, `kategori_relevan`, `prospek_karir`, `gambar_url`) VALUES
(1,  'Sistem Informasi',        'Menggabungkan teknologi informasi dengan kebutuhan bisnis untuk menciptakan solusi digital yang efektif.', 'IT, Bisnis',           'System Analyst, IT Consultant, Business Analyst, ERP Consultant, Project Manager IT', NULL),
(2,  'Teknik Informatika',      'Mempelajari pemrograman, pengembangan software, kecerdasan buatan, dan teknologi komputer mutakhir.', 'IT',                   'Software Engineer, Web Developer, Data Scientist, AI/ML Engineer, DevOps Engineer', NULL),
(3,  'Teknologi Informasi',     'Fokus pada pengelolaan infrastruktur IT, keamanan jaringan, dan sistem komunikasi data.', 'IT',                   'Network Engineer, IT Support, Cybersecurity Analyst, Cloud Engineer', NULL),
(4,  'Kedokteran',              'Mempelajari ilmu kesehatan manusia, diagnosis penyakit, dan metode pengobatan secara komprehensif.', 'Kedokteran',           'Dokter Umum, Dokter Spesialis, Peneliti Medis', NULL),
(5,  'Keperawatan',             'Fokus pada perawatan pasien holistic dan pelayanan kesehatan berbasis bukti ilmiah.', 'Kedokteran',           'Perawat Profesional, Tenaga Medis, Manajer Keperawatan', NULL),
(6,  'Psikologi',               'Mempelajari perilaku manusia, proses mental, dan faktor yang membentuk kepribadian individu.', 'Psikologi',            'Psikolog, HRD Manager, Konselor, Psikolog Klinis', NULL),
(7,  'Bimbingan Konseling',     'Fokus pada membantu individu berkembang dalam aspek pendidikan, karir, dan kehidupan pribadi.', 'Psikologi, Pendidikan', 'Konselor Sekolah, Guru BK, Fasilitator Pengembangan Diri', NULL),
(8,  'Manajemen',               'Mempelajari pengelolaan organisasi, strategi bisnis, sumber daya manusia, dan kepemimpinan.', 'Manajemen, Bisnis',    'Manager, Entrepreneur, Konsultan Bisnis, Manajer HR', NULL),
(9,  'Kewirausahaan',           'Fokus membangun dan mengembangkan usaha dari nol dengan pendekatan inovatif dan data-driven.', 'Bisnis, Manajemen',    'Pengusaha, Startup Founder, Venture Capitalist, Business Developer', NULL),
(10, 'Akuntansi',               'Berfokus pada pencatatan, pelaporan, dan analisis keuangan untuk mendukung pengambilan keputusan.', 'Akuntansi',            'Akuntan Publik, Auditor, Finance Analyst, Controller', NULL),
(11, 'Administrasi Bisnis',     'Mengelola kegiatan operasional, administrasi, dan tata kelola bisnis modern.', 'Administrasi, Bisnis',  'Admin Manager, Office Manager, Business Coordinator', NULL),
(12, 'Administrasi Publik',     'Mengelola kebijakan, program, dan layanan publik untuk kepentingan masyarakat.', 'Administrasi',         'ASN, Staff Pemerintahan, Policy Analyst', NULL),
(13, 'Desain Komunikasi Visual','Menciptakan karya visual strategis untuk komunikasi merek, produk, dan pesan sosial.', 'Desain, Seni',          'Graphic Designer, UI/UX Designer, Brand Strategist, Creative Director', NULL),
(14, 'Desain Produk',           'Merancang produk fisik maupun digital yang fungsional, estetis, dan berorientasi pengguna.', 'Desain, Teknik',       'Product Designer, Industrial Designer, UX Researcher', NULL),
(15, 'Seni Rupa',               'Mengembangkan ekspresi artistik melalui berbagai medium seperti lukisan, patung, dan instalasi.', 'Seni',                 'Seniman Profesional, Illustrator, Art Director, Kurator', NULL),
(16, 'Teknik Mesin',            'Mempelajari perancangan, manufacture, dan pemeliharaan mesin serta sistem mekanik.', 'Teknik, Otomotif',     'Mechanical Engineer, Manufacturing Engineer, Maintenance Engineer', NULL),
(17, 'Teknik Sipil',            'Mempelajari perancangan dan pembangunan infrastruktur seperti gedung, jalan, dan jembatan.', 'Teknik',               'Civil Engineer, Structural Engineer, Project Manager Konstruksi', NULL),
(18, 'Teknik Elektro',          'Mempelajari sistem kelistrikan, elektronik, dan kendali untuk berbagai applikasi industri.', 'Teknik',               'Electrical Engineer, Automation Engineer, Power Systems Engineer', NULL),
(19, 'Teknik Otomotif',         'Fokus pada rekayasa kendaraan bermotor, sistem propulsi, dan teknologi transportasi masa depan.', 'Otomotif, Teknik',     'Automotive Engineer, Teknisi Senior, Vehicle Development Engineer', NULL),
(20, 'Pendidikan',              'Mempelajari teori belajar, metode pengajaran, dan pengembangan kurikulum pendidikan modern.', 'Pendidikan',           'Guru Profesional, Dosen, Instruktur Training, Educational Consultant', NULL);

-- -------------------------------------------------------
-- TABLE: kampus (kolom logo: logo_kampus)
-- -------------------------------------------------------
CREATE TABLE `kampus` (
  `id_kampus` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kampus` varchar(150) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `akreditasi` varchar(10) DEFAULT NULL,
  `estimasi_biaya` varchar(100) DEFAULT NULL,
  `logo_kampus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_kampus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `kampus` (`id_kampus`, `nama_kampus`, `lokasi`, `akreditasi`, `estimasi_biaya`, `logo_kampus`) VALUES
(1, 'UPN "Veteran" Jawa Timur',  'Jawa Timur', 'A',      'Rp 1.000.000 - Rp 35.000.000',  'upnvjt.png'),
(3, 'Institut Teknologi Bandung', 'Jawa Barat',  'Unggul', 'Rp 1.000.000 - Rp 45.000.000',  'itb.png'),
(4, 'Universitas Indonesia',      'Jakarta',     'Unggul', 'Rp 1.000.000 - Rp 75.000.000',  'ui.png');

-- -------------------------------------------------------
-- TABLE: relasi_kampus_jurusan
-- -------------------------------------------------------
CREATE TABLE `relasi_kampus_jurusan` (
  `id_relasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_kampus` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  PRIMARY KEY (`id_relasi`),
  KEY `fk_relasi_kampus` (`id_kampus`),
  KEY `fk_relasi_jurusan` (`id_jurusan`),
  CONSTRAINT `fk_relasi_kampus` FOREIGN KEY (`id_kampus`) REFERENCES `kampus` (`id_kampus`) ON DELETE CASCADE,
  CONSTRAINT `fk_relasi_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- UPNVJT (id_kampus=1): SI, TI, Teknologi Informasi, Manajemen, Akuntansi, Adm Bisnis, DKV, Ilmu Komunikasi
INSERT INTO `relasi_kampus_jurusan` (`id_kampus`, `id_jurusan`) VALUES
(1, 1), (1, 2), (1, 3), (1, 8), (1, 10), (1, 11), (1, 13), (1, 17),
-- ITB (id_kampus=3): TI, Teknologi Informasi, Teknik Mesin, Teknik Sipil, Teknik Elektro, Desain Produk
(3, 2), (3, 3), (3, 14), (3, 16), (3, 17), (3, 18),
-- UI (id_kampus=4): SI, TI, Kedokteran, Keperawatan, Psikologi, Manajemen, Akuntansi, Hukum
(4, 1), (4, 2), (4, 4), (4, 5), (4, 6), (4, 8), (4, 10);

-- -------------------------------------------------------
-- TABLE: roadmap
-- -------------------------------------------------------
CREATE TABLE `roadmap` (
  `id_roadmap` int(11) NOT NULL AUTO_INCREMENT,
  `id_jurusan` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `nama_matkul` varchar(100) NOT NULL,
  `kategori_matkul` enum('Fondasi','Profesional') NOT NULL,
  `skill_didapat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_roadmap`),
  KEY `fk_jurusan_roadmap` (`id_jurusan`),
  CONSTRAINT `fk_jurusan_roadmap` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- === ROADMAP: Sistem Informasi (id=1) ===
INSERT INTO `roadmap` (`id_jurusan`, `semester`, `nama_matkul`, `kategori_matkul`, `skill_didapat`) VALUES
(1, 1, 'Pengantar Sistem Informasi',     'Fondasi',      'Konsep dasar SI, Analytical Thinking'),
(1, 1, 'Dasar Pemrograman',              'Fondasi',      'Logika pemrograman, Python/Java dasar'),
(1, 1, 'Matematika Diskrit',             'Fondasi',      'Logika matematika, Set Theory'),
(1, 2, 'Basis Data',                     'Fondasi',      'SQL, ERD, Database Design'),
(1, 2, 'Algoritma & Struktur Data',      'Fondasi',      'Problem Solving, Algorithm Design'),
(1, 2, 'Analisis & Desain Sistem',       'Fondasi',      'UML, SDLC, Requirements Analysis'),
(1, 3, 'Pemrograman Web',                'Profesional',  'HTML, CSS, JavaScript, PHP'),
(1, 3, 'Jaringan Komputer',              'Profesional',  'TCP/IP, Networking Fundamentals'),
(1, 3, 'Manajemen Proyek IT',            'Profesional',  'Project Management, Agile, Scrum'),
(1, 4, 'Enterprise Resource Planning',   'Profesional',  'SAP, ERP Systems, Business Process'),
(1, 4, 'Business Intelligence',          'Profesional',  'Data Visualization, Reporting, ETL'),
(1, 4, 'Audit Sistem Informasi',         'Profesional',  'IT Audit, Risk Management'),
(1, 5, 'Keamanan Sistem Informasi',      'Profesional',  'Cybersecurity, Data Protection'),
(1, 5, 'Cloud Computing',               'Profesional',  'AWS/GCP/Azure, Virtualisasi'),
(1, 6, 'Pengembangan Aplikasi Mobile',   'Profesional',  'Android/iOS Development, Flutter'),
(1, 6, 'Analisis Big Data',              'Profesional',  'Data Analytics, Hadoop, Spark'),
(1, 7, 'Tata Kelola IT',                'Profesional',  'COBIT, IT Governance, ITIL'),
(1, 7, 'Sistem Pendukung Keputusan',     'Profesional',  'Decision Support, Data-driven Decision'),
(1, 8, 'Tugas Akhir / Skripsi',          'Profesional',  'Research, Technical Writing, Presentation');

-- === ROADMAP: Teknik Informatika (id=2) ===
INSERT INTO `roadmap` (`id_jurusan`, `semester`, `nama_matkul`, `kategori_matkul`, `skill_didapat`) VALUES
(2, 1, 'Algoritma & Pemrograman',        'Fondasi',      'C++/Python, Problem Solving'),
(2, 1, 'Matematika Dasar',               'Fondasi',      'Kalkulus, Linear Algebra'),
(2, 1, 'Logika Informatika',             'Fondasi',      'Boolean Logic, Propositional Logic'),
(2, 2, 'Struktur Data',                  'Fondasi',      'Array, Tree, Graph, Queue, Stack'),
(2, 2, 'Basis Data',                     'Fondasi',      'SQL, Database Modeling'),
(2, 2, 'Matematika Diskrit',             'Fondasi',      'Kombinatorik, Graph Theory'),
(2, 3, 'Pemrograman Berorientasi Objek', 'Fondasi',      'OOP, Design Patterns, Java/C#'),
(2, 3, 'Pemrograman Web',                'Profesional',  'HTML, CSS, JS, React/Vue'),
(2, 3, 'Sistem Operasi',                 'Fondasi',      'Linux, Process Management, OS Concepts'),
(2, 4, 'Jaringan Komputer',              'Fondasi',      'TCP/IP, Routing, Switching'),
(2, 4, 'Rekayasa Perangkat Lunak',       'Profesional',  'Software Architecture, Design Patterns'),
(2, 4, 'Kecerdasan Buatan',              'Profesional',  'AI Fundamentals, Search Algorithms'),
(2, 5, 'Machine Learning',               'Profesional',  'Supervised/Unsupervised Learning, Scikit-learn'),
(2, 5, 'Pengembangan Aplikasi Mobile',   'Profesional',  'Flutter/React Native, Mobile UX'),
(2, 6, 'Deep Learning & Neural Network', 'Profesional',  'TensorFlow, PyTorch, CNN, RNN'),
(2, 6, 'Keamanan Jaringan',              'Profesional',  'Cybersecurity, Ethical Hacking'),
(2, 6, 'Cloud Computing',               'Profesional',  'AWS, Microservices, Docker, K8s'),
(2, 7, 'Pengembangan Game',              'Profesional',  'Unity, Game Design, C# Scripting'),
(2, 7, 'Topik Khusus Informatika',       'Profesional',  'IoT, Blockchain, Emerging Tech'),
(2, 8, 'Skripsi',                        'Profesional',  'Research, Innovation, Technical Writing');

-- === ROADMAP: Akuntansi (id=10) ===
INSERT INTO `roadmap` (`id_jurusan`, `semester`, `nama_matkul`, `kategori_matkul`, `skill_didapat`) VALUES
(10, 1, 'Pengantar Akuntansi',           'Fondasi',      'Persamaan Akuntansi, Jurnal Umum'),
(10, 1, 'Matematika Ekonomi',            'Fondasi',      'Matematika Keuangan, Bunga Majemuk'),
(10, 2, 'Akuntansi Keuangan Menengah',   'Fondasi',      'Penyajian Laporan Keuangan, PSAK'),
(10, 2, 'Akuntansi Biaya',               'Fondasi',      'Cost Accounting, HPP Calculation'),
(10, 3, 'Akuntansi Manajemen',           'Profesional',  'Budgeting, Variance Analysis, KPI'),
(10, 3, 'Sistem Informasi Akuntansi',    'Profesional',  'ERP, AIS Design, Internal Control'),
(10, 4, 'Auditing',                      'Profesional',  'Audit Procedures, Sampling, Evidence'),
(10, 4, 'Perpajakan',                    'Profesional',  'PPh, PPN, Tax Planning, NPWP'),
(10, 5, 'Akuntansi Sektor Publik',       'Profesional',  'Government Accounting, SAP'),
(10, 5, 'Analisis Laporan Keuangan',     'Profesional',  'Ratio Analysis, Financial Modeling'),
(10, 6, 'Akuntansi Keuangan Lanjutan',   'Profesional',  'Konsolidasi, IFRS, Translasi Valuta'),
(10, 7, 'Audit Kinerja',                 'Profesional',  'Performance Audit, Value for Money'),
(10, 8, 'Skripsi',                       'Profesional',  'Research, Data Analysis, Reporting');

-- === ROADMAP: Manajemen (id=8) ===
INSERT INTO `roadmap` (`id_jurusan`, `semester`, `nama_matkul`, `kategori_matkul`, `skill_didapat`) VALUES
(8, 1, 'Pengantar Manajemen',            'Fondasi',      'Fungsi Manajemen, POAC'),
(8, 1, 'Ekonomi Mikro',                  'Fondasi',      'Supply-Demand, Market Structure'),
(8, 2, 'Manajemen SDM',                  'Fondasi',      'Rekrutmen, Pelatihan, Kompensasi'),
(8, 2, 'Akuntansi Dasar',                'Fondasi',      'Laporan Keuangan, Jurnal, Neraca'),
(8, 3, 'Manajemen Pemasaran',            'Profesional',  'Marketing Mix, Segmentasi, Branding'),
(8, 3, 'Manajemen Operasi',              'Profesional',  'Supply Chain, Quality Control, Lean'),
(8, 4, 'Manajemen Keuangan',             'Profesional',  'NPV, IRR, Capital Budgeting'),
(8, 4, 'Perilaku Organisasi',            'Profesional',  'Leadership, Team Dynamics, Motivation'),
(8, 5, 'Manajemen Strategik',            'Profesional',  'SWOT, Porter 5 Forces, Blue Ocean'),
(8, 5, 'Kewirausahaan',                  'Profesional',  'Business Model Canvas, Startup Thinking'),
(8, 6, 'Manajemen Proyek',               'Profesional',  'Gantt Chart, Risk Management, CPM'),
(8, 7, 'Bisnis Internasional',           'Profesional',  'Global Trade, Export-Import, ASEAN'),
(8, 8, 'Skripsi',                        'Profesional',  'Business Research, Data Analysis');

-- === ROADMAP: Psikologi (id=6) ===
INSERT INTO `roadmap` (`id_jurusan`, `semester`, `nama_matkul`, `kategori_matkul`, `skill_didapat`) VALUES
(6, 1, 'Pengantar Psikologi',            'Fondasi',      'Teori Dasar Psikologi, Sejarah'),
(6, 1, 'Biologi Dasar',                  'Fondasi',      'Biologi Perilaku, Neuroanatomi Dasar'),
(6, 2, 'Psikologi Perkembangan',         'Fondasi',      'Teori Piaget, Erikson, Life-Span Dev.'),
(6, 2, 'Teori Kepribadian',              'Fondasi',      'Big Five, MBTI, Psikoanalisis'),
(6, 3, 'Psikologi Klinis',               'Profesional',  'Psikopatologi, Assessment Psikologis'),
(6, 3, 'Psikologi Industri & Organisasi','Profesional',  'Rekrutmen, Training Need Analysis'),
(6, 4, 'Psikodiagnostik',               'Profesional',  'Tes Psikologi, Wawancara Klinis'),
(6, 4, 'Statistik Psikologi',            'Profesional',  'SPSS, Analisis Data Kuantitatif'),
(6, 5, 'Konseling & Psikoterapi',        'Profesional',  'CBT, Person-Centered, Gestalt'),
(6, 6, 'Psikologi Sosial',               'Profesional',  'Group Dynamics, Attitude Change'),
(6, 7, 'Psikologi Pendidikan',           'Profesional',  'Learning Theory, Instructional Design'),
(6, 8, 'Skripsi',                        'Profesional',  'Penelitian Psikologis, Laporan Ilmiah');

-- === ROADMAP: Teknik Sipil (id=17) ===
INSERT INTO `roadmap` (`id_jurusan`, `semester`, `nama_matkul`, `kategori_matkul`, `skill_didapat`) VALUES
(17, 1, 'Matematika Teknik I',           'Fondasi',      'Kalkulus, Diferensial Integral'),
(17, 1, 'Gambar Teknik',                 'Fondasi',      'AutoCAD, Proyeksi Orthogonal'),
(17, 2, 'Mekanika Teknik',               'Fondasi',      'Statika, Dinamika, Free Body Diagram'),
(17, 2, 'Material Konstruksi',           'Fondasi',      'Sifat Material, Uji Beton, Baja'),
(17, 3, 'Struktur Beton',                'Profesional',  'Analisis Beton Bertulang, SNI'),
(17, 3, 'Mekanika Tanah',                'Fondasi',      'Klasifikasi Tanah, Daya Dukung'),
(17, 4, 'Struktur Baja',                 'Profesional',  'Profil Baja, Sambungan, AISC'),
(17, 4, 'Rekayasa Pondasi',              'Profesional',  'Pondasi Dangkal, Tiang Pancang'),
(17, 5, 'Manajemen Konstruksi',          'Profesional',  'Estimasi Biaya, Scheduling, RAB'),
(17, 5, 'Teknik Jalan Raya',             'Profesional',  'Perencanaan Geometri, Perkerasan'),
(17, 6, 'Rekayasa Gempa',                'Profesional',  'Analisis Dinamik, SNI Gempa'),
(17, 7, 'Bangunan Tinggi',               'Profesional',  'High-Rise Structure, SAP2000'),
(17, 8, 'Tugas Akhir',                   'Profesional',  'Perancangan Konstruksi, Laporan Teknis');

-- === ROADMAP: Desain Komunikasi Visual (id=13) ===
INSERT INTO `roadmap` (`id_jurusan`, `semester`, `nama_matkul`, `kategori_matkul`, `skill_didapat`) VALUES
(13, 1, 'Nirmana Dasar',                 'Fondasi',      'Prinsip Desain, Komposisi Visual'),
(13, 1, 'Tipografi Dasar',               'Fondasi',      'Pemilihan Font, Typesetting'),
(13, 2, 'Ilustrasi Digital',             'Fondasi',      'Adobe Illustrator, Vector Illustration'),
(13, 2, 'Fotografi Dasar',               'Fondasi',      'Komposisi, Lighting, Editing Foto'),
(13, 3, 'Desain Grafis',                 'Profesional',  'Branding, Layout, Adobe InDesign'),
(13, 3, 'Motion Graphics',               'Profesional',  'After Effects, Cinema 4D, Animasi'),
(13, 4, 'UI/UX Design',                  'Profesional',  'Figma, Wireframing, Prototyping'),
(13, 4, 'Desain Kemasan',                'Profesional',  'Packaging Design, 3D Mockup'),
(13, 5, 'Strategi Komunikasi Merek',     'Profesional',  'Brand Strategy, Campaign Planning'),
(13, 6, 'Desain Media Interaktif',       'Profesional',  'Web Design, Interactive Media'),
(13, 7, 'Portofolio & Presentasi',       'Profesional',  'Portfolio Building, Client Presentation'),
(13, 8, 'Tugas Akhir',                   'Profesional',  'Proyek Desain Komprehensif');

-- -------------------------------------------------------
-- TABLE: hasil_tes (nama kolom BARU: id_jurusan)
-- -------------------------------------------------------
CREATE TABLE `hasil_tes` (
  `id_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `skor_kecocokan` int(11) DEFAULT NULL,
  `tanggal_tes` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_hasil`),
  KEY `fk_hasil_user` (`id_user`),
  KEY `fk_hasil_jurusan` (`id_jurusan`),
  CONSTRAINT `fk_hasil_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE,
  CONSTRAINT `fk_hasil_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data (user faiz dari DB lama)
INSERT INTO `users` (`id_user`, `nama_lengkap`, `email`, `password`, `asal_sekolah`, `role`) VALUES
(1, 'faiz', 'faiz@gmail.com', '$2y$10$Fkij2fJRS3c/EYYoH8sEhO9F/5vN62zkifZ.yb.llUgo4lc6dXNyS', 'SMAN 2 BOJONEGORO', 'user');

INSERT INTO `hasil_tes` (`id_hasil`, `id_user`, `id_jurusan`, `skor_kecocokan`, `tanggal_tes`) VALUES
(2, 1, 1, 60, '2026-04-11 12:49:46'),
(3, 1, 10, 80, '2026-04-11 13:04:32');
