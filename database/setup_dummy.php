<?php
require_once 'koneksi.php';

// 1. Clear existing data to avoid duplicates
mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 0;");
mysqli_query($koneksi, "TRUNCATE TABLE roadmap;");
mysqli_query($koneksi, "TRUNCATE TABLE relasi_kampus_jurusan;");
mysqli_query($koneksi, "TRUNCATE TABLE hasil_tes;");
mysqli_query($koneksi, "TRUNCATE TABLE questions;");
mysqli_query($koneksi, "TRUNCATE TABLE kampus;");
mysqli_query($koneksi, "TRUNCATE TABLE jurusan;");
mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 1;");

// 2. Insert Jurusan
$query_jurusan = "INSERT INTO jurusan (id_jurusan, nama_jurusan, deskripsi_singkat, kategori_relevan, prospek_karir) VALUES 
(1, 'Sistem Informasi', 'Belajar merancang dan mengembangkan sistem informasi untuk berbagai industri. Program ini fokus pada pemrograman, database, dan teknologi informasi terkini.', 'Teknologi', 'Lulusan Sistem Informasi memiliki prospek karir yang gemilang sebagai Software Developer, Database Administrator, System Analyst, IT Consultant, dan berbagai posisi strategis di perusahaan teknologi global. Gaji rata-rata entry level mencapai 4-6 juta rupiah per bulan.'),
(2, 'Informatika', 'Program studi yang fokus pada ilmu komputer, algoritma, dan pengembangan perangkat lunak.', 'Teknologi', 'Software Engineer, Data Scientist, AI Engineer, Backend/Frontend Developer, Cybersecurity Analyst.')";
mysqli_query($koneksi, $query_jurusan);

// 3. Insert Kampus
$query_kampus = "INSERT INTO kampus (nama_kampus, lokasi, akreditasi, estimasi_biaya) VALUES 
('UPN \"Veteran\" Jawa Timur', 'Surabaya', 'A', 'Rp 3.000.000 - Rp 8.000.000 / SMT'),
('Universitas Airlangga', 'Surabaya', 'Unggul', 'Rp 5.000.000 - Rp 15.000.000 / SMT'),
('Institut Teknologi Sepuluh Nopember', 'Surabaya', 'Unggul', 'Rp 4.000.000 - Rp 12.000.000 / SMT'),
('Universitas Brawijaya', 'Malang', 'A', 'Rp 3.500.000 - Rp 10.000.000 / SMT'),
('Universitas Negeri Surabaya', 'Surabaya', 'A', 'Rp 2.500.000 - Rp 7.000.000 / SMT')
"; 
// wait, we need to alter table 'kampus' to add 'lokasi' if it doesn't exist.
// Let's modify table first just in case.
try {
    mysqli_query($koneksi, "ALTER TABLE kampus ADD COLUMN lokasi VARCHAR(100) AFTER nama_kampus;");
} catch(mysqli_sql_exception $e) {
    // Ignore duplicate column error
}
// Run script anyway to ignore duplicate column error if exists, then execute insert
mysqli_query($koneksi, $query_kampus);

// 4. Insert Questions
$questions = [
    'Saya suka memecahkan masalah logika dengan algoritma.',
    'Saya menikmati bekerja dengan angka dan data.',
    'Saya ingin membuat aplikasi yang membantu banyak orang.',
    'Saya tertarik pada studi bisnis dan pengelolaan perusahaan.',
    'Saya merasa senang merancang desain visual yang menarik.',
    'Saya suka berkomunikasi dan bekerja dalam tim proyek.',
    'Saya ingin memahami bagaimana sistem informasi dibangun.',
    'Saya tertarik belajar tentang keamanan dan jaringan komputer.'
];
foreach($questions as $index => $q) {
    $q = mysqli_real_escape_string($koneksi, $q);
    mysqli_query($koneksi, "INSERT INTO questions (teks_pertanyaan, kategori_minat) VALUES ('$q', 'Teknologi & Bisnis')");
}

// 5. Insert Roadmap
$roadmap_data = [
    1 => [
        1 => [
            ['Dasar Pemrograman', 'Fondasi', 'Logic, Syntax, Problem Solving'],
            ['Pengantar Sistem Informasi', 'Fondasi', 'Konsep SI, Enterprise Systems, ERP']
        ],
        2 => [
            ['Web Development', 'Profesional', 'HTML, CSS, JavaScript, Responsive Design'],
            ['Database Management', 'Fondasi', 'SQL, Normalisasi, Query Optimization']
        ],
        3 => [
            ['Object Oriented Programming', 'Profesional', 'OOP, Design Patterns, SOLID Principles'],
            ['Sistem Basis Data Lanjut', 'Profesional', 'Advanced SQL, Indexing, Tuning']
        ],
        4 => [
            ['Software Engineering', 'Profesional', 'SDLC, Agile, Testing, Documentation'],
            ['Jaringan Komputer', 'Fondasi', 'Networking, TCP/IP, Security']
        ],
        5 => [
            ['Mobile App Development', 'Profesional', 'Android, iOS, Flutter, React Native'],
            ['Business Process Analysis', 'Profesional', 'BPM, Process Mapping, Optimization']
        ],
        6 => [
            ['Cloud Computing & DevOps', 'Profesional', 'AWS, Docker, CI/CD, Kubernetes'],
            ['Information Security', 'Profesional', 'Cryptography, Threat Analysis, Compliance']
        ],
        7 => [
            ['Data Analytics & Big Data', 'Profesional', 'Python, R, Hadoop, Spark, Visualization'],
            ['Manajemen Proyek IT', 'Profesional', 'Project Management, Risk Assessment, Stakeholder']
        ],
        8 => [
            ['AI & Machine Learning', 'Profesional', 'ML Algorithms, Deep Learning, TensorFlow'],
            ['Skripsi/Capstone Project', 'Profesional', 'Research, Implementation, Presentation']
        ]
    ],
    2 => [
        1 => [
            ['Algoritma dan Pemrograman', 'Fondasi', 'Algorithm, Programming Logic'],
            ['Matematika Diskrit', 'Fondasi', 'Discrete Math, Logic']
        ],
        2 => [
            ['Struktur Data', 'Fondasi', 'Data Structures, Complexity'],
            ['Sistem Operasi', 'Fondasi', 'OS Concepts, Process Management']
        ],
        3 => [
            ['Basis Data', 'Fondasi', 'Database Design, SQL'],
            ['Pemrograman Web', 'Profesional', 'Web Development, Frameworks']
        ],
        4 => [
            ['Jaringan Komputer', 'Fondasi', 'Networking, Protocols'],
            ['Kecerdasan Buatan', 'Profesional', 'AI, Machine Learning Basics']
        ],
        5 => [
            ['Rekayasa Perangkat Lunak', 'Profesional', 'Software Engineering, SDLC'],
            ['Keamanan Informasi', 'Profesional', 'Security, Cryptography']
        ],
        6 => [
            ['Komputasi Awan', 'Profesional', 'Cloud Computing, DevOps'],
            ['Data Mining', 'Profesional', 'Data Analysis, Mining Techniques']
        ],
        7 => [
            ['Sistem Terdistribusi', 'Profesional', 'Distributed Systems, Scalability'],
            ['Proyek Akhir', 'Profesional', 'Project Development, Research']
        ],
        8 => [
            ['Magang Industri', 'Profesional', 'Industry Experience, Real-world Application']
        ]
    ]
];

foreach ($roadmap_data as $id_jurusan => $semesters) {
    foreach ($semesters as $semester => $matkuls) {
        foreach ($matkuls as $m) {
            $nama = mysqli_real_escape_string($koneksi, $m[0]);
            $kategori = mysqli_real_escape_string($koneksi, $m[1]);
            $skill = mysqli_real_escape_string($koneksi, $m[2]);
            mysqli_query($koneksi, "INSERT INTO roadmap (id_jurusan, semester, nama_matkul, kategori_matkul, skill_didapat) 
            VALUES ($id_jurusan, $semester, '$nama', '$kategori', '$skill')");
        }
    }
}

echo "Database seeded successfully!";
?>
