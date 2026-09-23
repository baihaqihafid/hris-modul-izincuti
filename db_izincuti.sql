-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2026 at 10:55 AM
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
-- Database: `db_izincuti`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(11) UNSIGNED NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`, `created_at`, `updated_at`) VALUES
(1, 'Human Resource', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(2, 'Finance', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(3, 'IT', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(4, 'Marketing', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(5, 'Operasional', '2026-06-12 01:05:20', '2026-06-12 01:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `hak_cuti`
--

CREATE TABLE `hak_cuti` (
  `id_hak_cuti` int(11) UNSIGNED NOT NULL,
  `karyawan_id` int(11) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `total_cuti` int(11) NOT NULL DEFAULT 12,
  `sisa_cuti` int(11) NOT NULL DEFAULT 12,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hak_cuti`
--

INSERT INTO `hak_cuti` (`id_hak_cuti`, `karyawan_id`, `tahun`, `total_cuti`, `sisa_cuti`, `created_at`, `updated_at`) VALUES
(1, 1, '2026', 12, 12, '2026-06-12 01:10:03', '2026-06-12 01:10:03'),
(2, 2, '2026', 12, 12, '2026-06-12 01:10:03', '2026-07-20 08:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Manager', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(2, 'Staff HRD', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(3, 'Staff Keuangan', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(4, 'Programmer', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(5, 'Staff Marketing', '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(6, 'Staff Operasional', '2026-06-12 01:05:20', '2026-06-12 01:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) UNSIGNED NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_karyawan` varchar(150) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `departemen_id` int(11) UNSIGNED NOT NULL,
  `jabatan_id` int(11) UNSIGNED NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status_karyawan` enum('Aktif','Tidak Aktif','Resign') NOT NULL DEFAULT 'Aktif',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama_karyawan`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `email`, `departemen_id`, `jabatan_id`, `tanggal_masuk`, `status_karyawan`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'KRY001', 'Bagus Adi ', 'Laki-laki', 'Surabaya', '1990-05-15', 'Jl. Raya No. 1, Sidoarjo', '081234567890', 'bagus@sikaryawan.com', 1, 2, '2020-01-01', 'Aktif', NULL, '2026-06-12 01:05:20', '2026-06-12 01:05:20'),
(2, 'KRY002', 'Budi Santoso', 'Laki-laki', 'Malang', '1995-08-20', 'Jl. Mawar No. 5, Sidoarjo', '082345678901', 'budi@sikaryawan.com', 3, 4, '2021-03-01', 'Aktif', NULL, '2026-06-12 01:05:20', '2026-06-12 01:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-06-12-000001', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1781226276, 1),
(2, '2026-06-12-000002', 'App\\Database\\Migrations\\CreateDepartemenTable', 'default', 'App', 1781226276, 1),
(3, '2026-06-12-000003', 'App\\Database\\Migrations\\CreateJabatanTable', 'default', 'App', 1781226276, 1),
(4, '2026-06-12-000004', 'App\\Database\\Migrations\\CreateKaryawanTable', 'default', 'App', 1781226276, 1),
(5, '2026-06-12-000005', 'App\\Database\\Migrations\\CreateHakCutiTable', 'default', 'App', 1781226276, 1),
(6, '2026-06-12-000006', 'App\\Database\\Migrations\\CreatePengajuanIzinTable', 'default', 'App', 1781226276, 1),
(7, '2026-06-12-000007', 'App\\Database\\Migrations\\CreatePengajuanCutiTable', 'default', 'App', 1781226276, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_cuti`
--

CREATE TABLE `pengajuan_cuti` (
  `id_cuti` int(11) UNSIGNED NOT NULL,
  `karyawan_id` int(11) UNSIGNED NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `lama_cuti` int(11) NOT NULL COMMENT 'Dihitung otomatis dari selisih tanggal_mulai dan tanggal_selesai',
  `alasan` text NOT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu',
  `catatan_hrd` text DEFAULT NULL,
  `approved_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_izin`
--

CREATE TABLE `pengajuan_izin` (
  `id_izin` int(11) UNSIGNED NOT NULL,
  `karyawan_id` int(11) UNSIGNED NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_izin` date NOT NULL,
  `jenis_izin` enum('Sakit','Keperluan Pribadi','Keluarga','Lainnya') NOT NULL,
  `alasan` text NOT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu',
  `catatan_hrd` text DEFAULT NULL,
  `approved_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_izin`
--

INSERT INTO `pengajuan_izin` (`id_izin`, `karyawan_id`, `tanggal_pengajuan`, `tanggal_izin`, `jenis_izin`, `alasan`, `dokumen`, `status`, `catatan_hrd`, `approved_by`, `created_at`, `updated_at`) VALUES
(7, 2, '2026-07-20', '2026-07-21', 'Sakit', 'Periksa', '1784535098_fb2cf03c9a85012b1c3c.png', 'Menunggu', NULL, NULL, '2026-07-20 08:11:38', '2026-07-20 08:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `karyawan_id` int(11) UNSIGNED DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','hrd','karyawan') NOT NULL DEFAULT 'karyawan',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `karyawan_id`, `username`, `password`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', '$2y$12$m5tynZPwiUEUgkB.vImhze985dnrtbN61PF3qW3ncf4DkHdjAmPFW', 'admin', 1, '2026-06-12 01:05:21', '2026-06-12 01:05:21'),
(2, 1, 'hrd01', '$2y$12$/lgu7HFSbjj/q7.a6VKKZe93Iyx5pR6zfKom4rLvMdHtp4K3FGnOq', 'hrd', 1, '2026-06-12 01:05:21', '2026-06-12 01:05:21'),
(3, 2, 'karyawan01', '$2y$12$L2yOuCSSBJapMHbhHazGx.fj4t3Kwv9wq9wk8nbVxRlenpeEUARja', 'karyawan', 1, '2026-06-12 01:05:21', '2026-06-12 01:05:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `hak_cuti`
--
ALTER TABLE `hak_cuti`
  ADD PRIMARY KEY (`id_hak_cuti`),
  ADD KEY `hak_cuti_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `karyawan_departemen_id_foreign` (`departemen_id`),
  ADD KEY `karyawan_jabatan_id_foreign` (`jabatan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_cuti`
--
ALTER TABLE `pengajuan_cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `pengajuan_cuti_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `pengajuan_izin_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hak_cuti`
--
ALTER TABLE `hak_cuti`
  MODIFY `id_hak_cuti` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengajuan_cuti`
--
ALTER TABLE `pengajuan_cuti`
  MODIFY `id_cuti` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  MODIFY `id_izin` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hak_cuti`
--
ALTER TABLE `hak_cuti`
  ADD CONSTRAINT `hak_cuti_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_departemen_id_foreign` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id_departemen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `karyawan_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id_jabatan`) ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_cuti`
--
ALTER TABLE `pengajuan_cuti`
  ADD CONSTRAINT `pengajuan_cuti_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  ADD CONSTRAINT `pengajuan_izin_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
