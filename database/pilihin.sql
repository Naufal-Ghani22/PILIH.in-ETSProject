-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 12, 2026 at 04:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pilihin`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_tes`
--

CREATE TABLE `hasil_tes` (
  `id_hasil` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `skor_kecocokan` int(11) DEFAULT NULL,
  `tanggal_tes` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_tes`
--

INSERT INTO `hasil_tes` (`id_hasil`, `id_user`, `id_jurusan`, `skor_kecocokan`, `tanggal_tes`) VALUES
(2, 1, 1, 60, '2026-04-11 12:49:46'),
(3, 1, 10, 80, '2026-04-11 13:04:32'),
(4, 2, 10, 80, '2026-04-12 11:03:30'),
(5, 2, 1, 0, '2026-04-12 11:04:39'),
(6, 2, 10, 80, '2026-04-12 11:05:29'),
(7, 2, 10, 80, '2026-04-12 13:17:16'),
(8, 2, 10, 80, '2026-04-12 13:32:38'),
(9, 2, 10, 80, '2026-04-12 13:38:10'),
(10, 2, 10, 60, '2026-04-12 13:56:11'),
(11, 2, 2, 54, '2026-04-12 13:56:38'),
(12, 2, 13, 54, '2026-04-12 13:58:00'),
(13, 2, 7, 38, '2026-04-12 14:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `deskripsi_singkat` text NOT NULL,
  `kategori_relevan` varchar(50) NOT NULL,
  `prospek_karir` text DEFAULT NULL,
  `gambar_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `deskripsi_singkat`, `kategori_relevan`, `prospek_karir`, `gambar_url`) VALUES
(1, 'Sistem Informasi', 'Menggabungkan teknologi informasi dengan kebutuhan bisnis.', 'IT, Bisnis', 'System Analyst, IT Consultant, Business Analyst', NULL),
(2, 'Teknik Informatika', 'Mempelajari pemrograman, pengembangan software, dan teknologi komputer.', 'IT', 'Software Engineer, Web Developer, Data Scientist, AI Engineer', NULL),
(3, 'Teknologi Informasi', 'Fokus pada pengelolaan infrastruktur IT dan jaringan komputer.', 'IT', 'Network Engineer, IT Support, Cybersecurity Analyst', NULL),
(4, 'Kedokteran', 'Mempelajari diagnosis, pengobatan, dan pencegahan penyakit.', 'Kedokteran', 'Dokter Umum, Dokter Spesialis', NULL),
(5, 'Keperawatan', 'Fokus pada perawatan pasien dan pelayanan kesehatan.', 'Kedokteran', 'Perawat, Tenaga Medis', NULL),
(6, 'Psikologi', 'Mempelajari perilaku manusia dan proses mental.', 'Psikologi', 'Psikolog, HRD, Konselor', NULL),
(7, 'Bimbingan Konseling', 'Fokus pada membantu individu dalam masalah pendidikan dan pribadi.', 'Psikologi, Pendidikan', 'Konselor, Guru BK', NULL),
(8, 'Manajemen', 'Mempelajari pengelolaan organisasi dan strategi bisnis.', 'Manajemen, Bisnis', 'Manager, Entrepreneur', NULL),
(9, 'Kewirausahaan', 'Fokus pada membangun dan mengembangkan usaha.', 'Bisnis, Manajemen', 'Pengusaha, Startup Founder', NULL),
(10, 'Akuntansi', 'Berfokus pada laporan dan analisis keuangan.', 'Akuntansi', 'Akuntan, Auditor', NULL),
(11, 'Administrasi Bisnis', 'Mengelola kegiatan operasional dan administrasi bisnis.', 'Administrasi, Bisnis', 'Admin, Office Manager', NULL),
(12, 'Administrasi Publik', 'Mengelola kebijakan dan layanan publik.', 'Administrasi', 'ASN, Staff Pemerintahan', NULL),
(13, 'Desain Komunikasi Visual', 'Menciptakan karya visual untuk komunikasi.', 'Desain, Seni', 'Graphic Designer, UI/UX Designer', NULL),
(14, 'Desain Produk', 'Merancang produk yang fungsional dan estetis.', 'Desain, Teknik', 'Product Designer', NULL),
(15, 'Seni Rupa', 'Mengembangkan karya seni visual.', 'Seni', 'Seniman, Illustrator', NULL),
(16, 'Teknik Mesin', 'Mempelajari mesin dan sistem mekanik.', 'Teknik, Otomotif', 'Mechanical Engineer', NULL),
(17, 'Teknik Sipil', 'Mempelajari pembangunan infrastruktur.', 'Teknik', 'Civil Engineer', NULL),
(18, 'Teknik Elektro', 'Mempelajari sistem kelistrikan dan elektronik.', 'Teknik', 'Electrical Engineer', NULL),
(19, 'Teknik Otomotif', 'Fokus pada kendaraan dan sistem otomotif.', 'Otomotif, Teknik', 'Teknisi, Engineer Otomotif', NULL),
(20, 'Pendidikan', 'Mempelajari metode pengajaran dan pendidikan.', 'Pendidikan', 'Guru, Dosen', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kampus`
--

CREATE TABLE `kampus` (
  `id_kampus` int(11) NOT NULL,
  `nama_kampus` varchar(150) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `akreditasi` varchar(10) DEFAULT NULL,
  `estimasi_biaya` varchar(100) DEFAULT NULL,
  `logo_kampus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kampus`
--

INSERT INTO `kampus` (`id_kampus`, `nama_kampus`, `lokasi`, `akreditasi`, `estimasi_biaya`, `logo_kampus`, `created_at`) VALUES
(1, 'UPN \"Veteran\" Jawa Timur', 'Surabaya', 'A', 'Rp. 1.000.000 - Rp. 7.000.000 / SMT', 'upnvjt.png', '2026-04-11 10:06:48'),
(3, 'Institut Teknologi Bandung', 'Bandung', 'Unggul', 'Rp. 1.000.000 - Rp. 20.000.000 / SMT', 'itb.png', '2026-04-11 11:43:19'),
(4, 'Universitas Indonesia', 'Jakarta', 'Unggul', 'Rp. 1.000.000 - Rp. 25.000.000 / SMT', 'ui.png', '2026-04-11 11:48:43'),
(5, 'Universitas Gadjah Mada', 'Yogyakarta', 'Unggul', 'Rp. 1.000.000 - Rp. 20.000.000 / SMT', 'ugm.jfif', '2026-04-12 14:32:09'),
(6, 'Universitas Diponegoro', 'Semarang', 'Unggul', 'Rp. 1.000.000 - Rp. 15.000.000 / SMT', 'undip.jfif', '2026-04-12 14:32:09'),
(7, 'Universitas Surabaya', 'Surabaya', 'Unggul', 'Rp. 1.000.000 - Rp. 15.000.000 / SMT', 'unesa.jfif', '2026-04-12 14:36:45'),
(8, 'Universitas Brawijaya', 'Malang', 'Unggul', 'Rp. 1.000.000 - Rp. 15.000.000 / SMT', 'ub.jfif', '2026-04-12 14:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id_soal` int(11) NOT NULL,
  `teks_pertanyaan` text NOT NULL,
  `kategori_minat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id_soal`, `teks_pertanyaan`, `kategori_minat`) VALUES
(1, 'Saya merasa tertarik memahami bagaimana suatu sistem bekerja, seperti program komputer, mesin, atau alur kerja organisasi.', 'IT, Kedokteran, Teknik'),
(2, 'Saya menikmati kegiatan membantu orang lain menyelesaikan masalah pribadi atau emosional mereka.', 'Psikologi, Pendidikan'),
(3, 'Saya tertarik menciptakan sesuatu yang baru, seperti desain, tulisan, atau ide kreatif.', 'Desain, Seni'),
(4, 'Saya merasa nyaman memimpin kelompok dan mengambil keputusan penting dalam suatu tim.', 'Manajemen, Bisnis'),
(5, 'Saya menyukai pekerjaan yang membutuhkan ketelitian tinggi, seperti mengelola data atau membuat laporan.', 'Akuntansi, Administrasi'),
(6, 'Saya tertarik melakukan eksperimen, penelitian, atau analisis untuk menemukan jawaban dari suatu masalah.', 'IT, Kedokteran, Teknik'),
(7, 'Saya menikmati aktivitas yang melibatkan kerja langsung di lapangan atau menggunakan alat dan teknologi.', 'Teknik, Otomotif'),
(8, 'Saya tertarik pada dunia bisnis, seperti menjual produk, membuat strategi pemasaran, atau membangun usaha.', 'Manajemen, Bisnis'),
(9, 'Saya merasa puas ketika bisa mengajarkan sesuatu kepada orang lain atau berbagi ilmu.', 'Psikologi, Pendidikan'),
(10, 'Saya senang mengikuti aturan yang jelas dan bekerja dengan prosedur yang terstruktur.', 'Akuntansi, Administrasi');

-- --------------------------------------------------------

--
-- Table structure for table `relasi_kampus_jurusan`
--

CREATE TABLE `relasi_kampus_jurusan` (
  `id_relasi` int(11) NOT NULL,
  `id_kampus` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relasi_kampus_jurusan`
--

INSERT INTO `relasi_kampus_jurusan` (`id_relasi`, `id_kampus`, `id_jurusan`) VALUES
(2, 1, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 2),
(6, 1, 3),
(7, 1, 4),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 16),
(15, 1, 17),
(16, 1, 18),
(17, 4, 3),
(18, 4, 4),
(19, 4, 5),
(20, 4, 6),
(21, 4, 7),
(22, 4, 8),
(23, 4, 9),
(24, 4, 10),
(25, 4, 11),
(26, 4, 12),
(27, 4, 13),
(28, 4, 14),
(29, 4, 15),
(30, 4, 16),
(31, 4, 17),
(32, 4, 18),
(33, 4, 20);

-- --------------------------------------------------------

--
-- Table structure for table `roadmap`
--

CREATE TABLE `roadmap` (
  `id_roadmap` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `nama_matkul` varchar(100) NOT NULL,
  `kategori_matkul` enum('Fondasi','Profesional') NOT NULL,
  `skill_didapat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roadmap`
--

INSERT INTO `roadmap` (`id_roadmap`, `id_jurusan`, `semester`, `nama_matkul`, `kategori_matkul`, `skill_didapat`) VALUES
(1, 1, 1, 'Pengantar SI', '', 'Sistem bisnis'),
(2, 1, 2, 'Analisis Sistem', '', 'Analisis'),
(3, 1, 3, 'Basis Data', '', 'Database'),
(4, 1, 4, 'Manajemen Proyek', '', 'Project'),
(5, 1, 5, 'ERP', '', 'Enterprise'),
(6, 1, 6, 'Audit SI', '', 'Evaluasi'),
(7, 1, 7, 'Business Intelligence', '', 'Data bisnis'),
(8, 1, 8, 'Proyek Akhir', '', 'Implementasi'),
(9, 2, 1, 'Logika Pemrograman', '', 'Problem solving'),
(10, 2, 2, 'Pemrograman Dasar', '', 'Coding'),
(11, 2, 3, 'Struktur Data', '', 'Manajemen data'),
(12, 2, 4, 'Basis Data', '', 'SQL'),
(13, 2, 5, 'Pemrograman Web', '', 'Fullstack'),
(14, 2, 6, 'Jaringan Komputer', '', 'Networking'),
(15, 2, 7, 'Machine Learning', '', 'AI dasar'),
(16, 2, 8, 'Proyek Akhir', '', 'Project real'),
(17, 3, 1, 'Dasar IT', '', 'IT basic'),
(18, 3, 2, 'Jaringan Komputer', '', 'Networking'),
(19, 3, 3, 'Sistem Operasi', '', 'OS'),
(20, 3, 4, 'Keamanan Sistem', '', 'Security'),
(21, 3, 5, 'Cloud Computing', '', 'Cloud'),
(22, 3, 6, 'DevOps', '', 'Deployment'),
(23, 3, 7, 'Virtualisasi', '', 'Server'),
(24, 3, 8, 'Proyek Akhir', '', 'Infra IT'),
(25, 4, 1, 'Anatomi', '', 'Tubuh manusia'),
(26, 4, 2, 'Fisiologi', '', 'Fungsi organ'),
(27, 4, 3, 'Biokimia', '', 'Kimia tubuh'),
(28, 4, 4, 'Patologi', '', 'Penyakit'),
(29, 4, 5, 'Farmakologi', '', 'Obat'),
(30, 4, 6, 'Diagnostik', '', 'Analisis'),
(31, 4, 7, 'Koas', '', 'Klinik'),
(32, 4, 8, 'Ujian Profesi', '', 'Lisensi'),
(33, 5, 1, 'Dasar Keperawatan', '', 'Perawatan'),
(34, 5, 2, 'Kebutuhan Dasar', '', 'Empati'),
(35, 5, 3, 'Keperawatan Medikal', '', 'Pasien'),
(36, 5, 4, 'Keperawatan Anak', '', 'Spesialis'),
(37, 5, 5, 'Keperawatan Jiwa', '', 'Mental'),
(38, 5, 6, 'Keperawatan Komunitas', '', 'Masyarakat'),
(39, 5, 7, 'Praktik Klinik', '', 'Lapangan'),
(40, 5, 8, 'Ujian Kompetensi', '', 'Profesional'),
(41, 6, 1, 'Psikologi Umum', '', 'Perilaku'),
(42, 6, 2, 'Psikologi Perkembangan', '', 'Manusia'),
(43, 6, 3, 'Psikologi Sosial', '', 'Interaksi'),
(44, 6, 4, 'Psikologi Klinis', '', 'Mental'),
(45, 6, 5, 'Psikometri', '', 'Tes'),
(46, 6, 6, 'Konseling', '', 'Komunikasi'),
(47, 6, 7, 'Praktik Psikologi', '', 'Observasi'),
(48, 6, 8, 'Skripsi', '', 'Riset'),
(49, 7, 1, 'Dasar BK', '', 'Konseling'),
(50, 7, 2, 'Psikologi Pendidikan', '', 'Siswa'),
(51, 7, 3, 'Teknik Konseling', '', 'Komunikasi'),
(52, 7, 4, 'Evaluasi BK', '', 'Analisis'),
(53, 7, 5, 'BK Individu', '', 'Pendampingan'),
(54, 7, 6, 'BK Kelompok', '', 'Fasilitasi'),
(55, 7, 7, 'Praktik BK', '', 'Sekolah'),
(56, 7, 8, 'Skripsi', '', 'Riset'),
(57, 8, 1, 'Pengantar Manajemen', '', 'Organisasi'),
(58, 8, 2, 'Ekonomi', '', 'Ekonomi'),
(59, 8, 3, 'Manajemen SDM', '', 'SDM'),
(60, 8, 4, 'Manajemen Pemasaran', '', 'Marketing'),
(61, 8, 5, 'Manajemen Keuangan', '', 'Finance'),
(62, 8, 6, 'Perilaku Organisasi', '', 'Psikologi kerja'),
(63, 8, 7, 'Kewirausahaan', '', 'Bisnis'),
(64, 8, 8, 'Skripsi', '', 'Analisis'),
(65, 9, 1, 'Dasar Bisnis', '', 'Bisnis'),
(66, 9, 2, 'Inovasi', '', 'Ide'),
(67, 9, 3, 'Digital Marketing', '', 'Online'),
(68, 9, 4, 'Manajemen Startup', '', 'Startup'),
(69, 9, 5, 'Branding', '', 'Brand'),
(70, 9, 6, 'Keuangan Bisnis', '', 'Finance'),
(71, 9, 7, 'Proyek Bisnis', '', 'Eksekusi'),
(72, 9, 8, 'Pitching', '', 'Presentasi'),
(73, 10, 1, 'Pengantar Akuntansi', '', 'Keuangan'),
(74, 10, 2, 'Akuntansi Keuangan', '', 'Laporan'),
(75, 10, 3, 'Akuntansi Biaya', '', 'Biaya'),
(76, 10, 4, 'Perpajakan', '', 'Pajak'),
(77, 10, 5, 'Audit', '', 'Pemeriksaan'),
(78, 10, 6, 'SIA', '', 'Sistem'),
(79, 10, 7, 'Magang', '', 'Kerja'),
(80, 10, 8, 'Skripsi', '', 'Analisis'),
(81, 11, 1, 'Dasar Administrasi', '', 'Admin'),
(82, 11, 2, 'Manajemen Kantor', '', 'Operasional'),
(83, 11, 3, 'Komunikasi Bisnis', '', 'Komunikasi'),
(84, 11, 4, 'Arsip', '', 'Dokumen'),
(85, 11, 5, 'Etika Bisnis', '', 'Etika'),
(86, 11, 6, 'Pelayanan', '', 'Service'),
(87, 11, 7, 'Magang', '', 'Kerja'),
(88, 11, 8, 'Laporan Akhir', '', 'Evaluasi'),
(89, 12, 1, 'Pengantar Publik', '', 'Pemerintah'),
(90, 12, 2, 'Kebijakan Publik', '', 'Analisis'),
(91, 12, 3, 'Manajemen Publik', '', 'Layanan'),
(92, 12, 4, 'Hukum', '', 'Regulasi'),
(93, 12, 5, 'Etika Publik', '', 'Integritas'),
(94, 12, 6, 'Perencanaan', '', 'Strategi'),
(95, 12, 7, 'Magang', '', 'Lapangan'),
(96, 12, 8, 'Skripsi', '', 'Riset'),
(97, 13, 1, 'Dasar Desain', '', 'Visual'),
(98, 13, 2, 'Tipografi', '', 'Teks'),
(99, 13, 3, 'Desain Digital', '', 'Software'),
(100, 13, 4, 'Ilustrasi', '', 'Gambar'),
(101, 13, 5, 'UI/UX', '', 'App'),
(102, 13, 6, 'Branding', '', 'Identitas'),
(103, 13, 7, 'Proyek', '', 'Portofolio'),
(104, 13, 8, 'Tugas Akhir', '', 'Karya'),
(105, 14, 1, 'Dasar Desain', '', 'Desain'),
(106, 14, 2, 'Material', '', 'Bahan'),
(107, 14, 3, 'Desain 3D', '', 'Model'),
(108, 14, 4, 'Ergonomi', '', 'User'),
(109, 14, 5, 'CAD', '', 'Software'),
(110, 14, 6, 'Prototyping', '', 'Produk'),
(111, 14, 7, 'Proyek', '', 'Implementasi'),
(112, 14, 8, 'Tugas Akhir', '', 'Karya'),
(113, 15, 1, 'Dasar Seni', '', 'Seni'),
(114, 15, 2, 'Menggambar', '', 'Visual'),
(115, 15, 3, 'Melukis', '', 'Kreativitas'),
(116, 15, 4, 'Seni Patung', '', '3D'),
(117, 15, 5, 'Seni Modern', '', 'Eksplorasi'),
(118, 15, 6, 'Kritik Seni', '', 'Analisis'),
(119, 15, 7, 'Pameran', '', 'Presentasi'),
(120, 15, 8, 'Tugas Akhir', '', 'Karya'),
(121, 16, 1, 'Fisika', '', 'Energi'),
(122, 16, 2, 'Gambar Teknik', '', 'Desain'),
(123, 16, 3, 'Material', '', 'Bahan'),
(124, 16, 4, 'Termodinamika', '', 'Panas'),
(125, 16, 5, 'Fluida', '', 'Aliran'),
(126, 16, 6, 'Perancangan', '', 'Design'),
(127, 16, 7, 'Manufaktur', '', 'Produksi'),
(128, 16, 8, 'Skripsi', '', 'Riset'),
(129, 17, 1, 'Matematika', '', 'Hitung'),
(130, 17, 2, 'Struktur', '', 'Bangunan'),
(131, 17, 3, 'Material', '', 'Bahan'),
(132, 17, 4, 'Geoteknik', '', 'Tanah'),
(133, 17, 5, 'Manajemen Proyek', '', 'Proyek'),
(134, 17, 6, 'Transportasi', '', 'Infrastruktur'),
(135, 17, 7, 'Konstruksi', '', 'Lapangan'),
(136, 17, 8, 'Skripsi', '', 'Riset'),
(137, 18, 1, 'Dasar Elektro', '', 'Listrik'),
(138, 18, 2, 'Rangkaian', '', 'Analisis'),
(139, 18, 3, 'Elektronika', '', 'Komponen'),
(140, 18, 4, 'Digital', '', 'Logika'),
(141, 18, 5, 'Kontrol', '', 'Otomasi'),
(142, 18, 6, 'Telekomunikasi', '', 'Sinyal'),
(143, 18, 7, 'Praktikum', '', 'Implementasi'),
(144, 18, 8, 'Skripsi', '', 'Riset'),
(145, 19, 1, 'Dasar Otomotif', '', 'Mesin'),
(146, 19, 2, 'Engine', '', 'Mesin'),
(147, 19, 3, 'Kelistrikan', '', 'Listrik'),
(148, 19, 4, 'Chassis', '', 'Rangka'),
(149, 19, 5, 'Diagnostik', '', 'Analisis'),
(150, 19, 6, 'Service', '', 'Perbaikan'),
(151, 19, 7, 'Bengkel', '', 'Skill'),
(152, 19, 8, 'Ujian', '', 'Profesional'),
(153, 20, 1, 'Pengantar Pendidikan', '', 'Edukasi'),
(154, 20, 2, 'Psikologi Pendidikan', '', 'Siswa'),
(155, 20, 3, 'Metode Mengajar', '', 'Teaching'),
(156, 20, 4, 'Kurikulum', '', 'Perencanaan'),
(157, 20, 5, 'Media Pembelajaran', '', 'Tools'),
(158, 20, 6, 'Evaluasi', '', 'Penilaian'),
(159, 20, 7, 'Micro Teaching', '', 'Praktek'),
(160, 20, 8, 'Skripsi', '', 'Riset');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `email`, `password`, `asal_sekolah`, `role`, `created_at`) VALUES
(1, 'faiz', 'faiz@gmail.com', '$2y$10$Fkij2fJRS3c/EYYoH8sEhO9F/5vN62zkifZ.yb.llUgo4lc6dXNyS', 'SMAN 2 BOJONEGORO', 'user', '2026-04-09 12:11:03'),
(2, 'uji coba', 'ujicoba@gmail.com', '$2y$10$HLzyx8akYJABHApdV/8qcezWa5qTkT0b4FakQcEEhXSxB2uHof9YW', 'SMAN 1 SURABAYA', 'user', '2026-04-12 10:42:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `fk_hasil_user` (`id_user`),
  ADD KEY `fk_hasil_jurusan` (`id_jurusan`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kampus`
--
ALTER TABLE `kampus`
  ADD PRIMARY KEY (`id_kampus`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `relasi_kampus_jurusan`
--
ALTER TABLE `relasi_kampus_jurusan`
  ADD PRIMARY KEY (`id_relasi`),
  ADD KEY `fk_relasi_kampus` (`id_kampus`),
  ADD KEY `fk_relasi_jurusan` (`id_jurusan`);

--
-- Indexes for table `roadmap`
--
ALTER TABLE `roadmap`
  ADD PRIMARY KEY (`id_roadmap`),
  ADD KEY `fk_jurusan_roadmap` (`id_jurusan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kampus`
--
ALTER TABLE `kampus`
  MODIFY `id_kampus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `relasi_kampus_jurusan`
--
ALTER TABLE `relasi_kampus_jurusan`
  MODIFY `id_relasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `roadmap`
--
ALTER TABLE `roadmap`
  MODIFY `id_roadmap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_tes`
--
ALTER TABLE `hasil_tes`
  ADD CONSTRAINT `fk_hasil_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_hasil_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `relasi_kampus_jurusan`
--
ALTER TABLE `relasi_kampus_jurusan`
  ADD CONSTRAINT `fk_relasi_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_relasi_kampus` FOREIGN KEY (`id_kampus`) REFERENCES `kampus` (`id_kampus`) ON DELETE CASCADE;

--
-- Constraints for table `roadmap`
--
ALTER TABLE `roadmap`
  ADD CONSTRAINT `fk_jurusan_roadmap` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
