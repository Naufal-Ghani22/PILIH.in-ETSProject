-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 12, 2026 at 12:43 PM
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
(3, 1, 10, 80, '2026-04-11 13:04:32');

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
(1, 'UPN \"Veteran\" Jawa Timur', 'Jawa Timur', 'A', 'Rp. 1.000.000 - 35.000.000', 'upnvjt.png', '2026-04-11 10:06:48'),
(3, 'Institut Teknologi Bandung', 'Jawa Barat', 'Unggul', 'Rp. 1.000.000 - 45.000.000', 'itb.png', '2026-04-11 11:43:19'),
(4, 'Universitas Indonesia', 'Jakarta', 'Unggul', 'Rp. 1.000.000 - 75.000.000', 'ui.png', '2026-04-11 11:48:43');

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
(4, 4, 1);

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
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kampus`
--
ALTER TABLE `kampus`
  MODIFY `id_kampus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `relasi_kampus_jurusan`
--
ALTER TABLE `relasi_kampus_jurusan`
  MODIFY `id_relasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roadmap`
--
ALTER TABLE `roadmap`
  MODIFY `id_roadmap` int(11) NOT NULL AUTO_INCREMENT;

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
