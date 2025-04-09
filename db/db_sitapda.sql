-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2025 at 05:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sitapda`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan_skpd`
--

CREATE TABLE `tb_permintaan_skpd` (
  `id` int NOT NULL,
  `upt_id` int NOT NULL,
  `jumlah_skpd` int NOT NULL,
  `kasi_lp` enum('BELUM DIVALIDASI','MENUNGGU','TERVALIDASI') COLLATE utf8mb4_general_ci NOT NULL,
  `pengurus_barang` enum('BELUM DIVALIDASI','MENUNGGU','TERVALIDASI') COLLATE utf8mb4_general_ci NOT NULL,
  `ktu` enum('BELUM DIVALIDASI','MENUNGGU','TERVALIDASI') COLLATE utf8mb4_general_ci NOT NULL,
  `kupt` enum('BELUM DIVALIDASI','MENUNGGU','TERVALIDASI') COLLATE utf8mb4_general_ci NOT NULL,
  `gudang` enum('BELUM DIVALIDASI','MENUNGGU','TERVALIDASI') COLLATE utf8mb4_general_ci NOT NULL,
  `surat_permintaan` text COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('AKTIF','TIDAK AKTIF') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `nama`, `status`) VALUES
(1, 'superadmin', 'AKTIF'),
(2, 'UPT', 'AKTIF'),
(3, 'KASI LP 1', 'AKTIF'),
(4, 'PENGURUS BARANG', 'AKTIF'),
(5, 'KTU', 'AKTIF'),
(6, 'KUPT', 'AKTIF'),
(7, 'GUDANG', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `tb_skpd`
--

CREATE TABLE `tb_skpd` (
  `id` int NOT NULL,
  `nomor_skpd` int NOT NULL,
  `nomor_polisi` int NOT NULL,
  `jenis_proses` int NOT NULL,
  `upt_id` int NOT NULL,
  `status` enum('DIGUNAKAN','BATAL','RUSAK') COLLATE utf8mb4_general_ci NOT NULL,
  `masa_aktif` date NOT NULL,
  `upload_bukti` text COLLATE utf8mb4_general_ci NOT NULL,
  `berita_acara` text COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_upt`
--

CREATE TABLE `tb_upt` (
  `id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('AKTIF','TIDAK AKTIF') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_upt`
--

INSERT INTO `tb_upt` (`id`, `nama`, `alamat`, `status`) VALUES
(1, 'UPT Medan Timur', 'Jalan. Pegangsaan Timur', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `nip`, `username`, `password`, `role_id`, `createdAt`, `updatedAt`) VALUES
(1, 'Muhammad Israyuda Fatih Aldandatore', '231232313123113', 'superadmin', '$2a$12$DPXsDkDTyXbrz/OAjYUxGuTmxxh2nzqjri1MK4vaJDmSfgeCK9dJK', 1, '2025-04-07 16:52:56', '2025-04-07 16:52:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_permintaan_skpd`
--
ALTER TABLE `tb_permintaan_skpd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upt_id` (`upt_id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_skpd`
--
ALTER TABLE `tb_skpd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upt_id` (`upt_id`);

--
-- Indexes for table `tb_upt`
--
ALTER TABLE `tb_upt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_permintaan_skpd`
--
ALTER TABLE `tb_permintaan_skpd`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_skpd`
--
ALTER TABLE `tb_skpd`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_upt`
--
ALTER TABLE `tb_upt`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_skpd`
--
ALTER TABLE `tb_skpd`
  ADD CONSTRAINT `tb_skpd_ibfk_1` FOREIGN KEY (`upt_id`) REFERENCES `tb_upt` (`id`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
