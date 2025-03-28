-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2024 at 05:33 PM
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
-- Database: `db_pemesanan_material`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id`, `name`, `description`) VALUES
(1, 'Kayu', 'Kategori untuk berbagai jenis kayu dan produk kayu lainnya'),
(2, 'Perangkat Keras', 'Kategori untuk barang-barang perangkat keras seperti paku, sekrup, dan baut'),
(3, 'Listrik', 'Kategori untuk perlengkapan listrik seperti kabel dan saklar'),
(4, 'Cat', 'Kategori untuk cat dan perlengkapan melukis'),
(5, 'Pipa', 'Kategori untuk bahan bangunan pipa termasuk pipa PVC dan aksesorisnya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `items` text COLLATE utf8mb4_general_ci NOT NULL,
  `grand_total` float NOT NULL,
  `status_order` enum('ORDERED','PROCESSED','DONE','CANCELLED') COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id`, `name`, `phone_number`, `items`, `grand_total`, `status_order`, `createdAt`, `updatedAt`) VALUES
(28, 'Isramiraza', '089636685605', '[{\"id\":\"26\",\"code\":\"GNC0001\",\"name\":\"Gancu\",\"m_category_id\":\"2\",\"m_unit_id\":\"1\",\"price\":\"25000\",\"stock\":\"100\",\"quantity\":1},{\"id\":\"14\",\"code\":\"TGG015\",\"name\":\"Tangga Lipat Aluminium\",\"m_category_id\":\"3\",\"m_unit_id\":\"1\",\"price\":\"300000\",\"stock\":\"150\",\"quantity\":1},{\"id\":\"25\",\"code\":\"TBB026\",\"name\":\"Tembok Batu Bata\",\"m_category_id\":\"1\",\"m_unit_id\":\"1\",\"price\":\"25000\",\"stock\":\"500\",\"quantity\":1}]', 350000, 'PROCESSED', '2024-07-22 04:21:19', '2024-07-22 04:21:19'),
(29, 'Isramiraza', '089636685605', '[{\"id\":\"12\",\"code\":\"SPL013\",\"name\":\"Spandek (Meter)\",\"m_category_id\":\"1\",\"m_unit_id\":\"5\",\"price\":\"125000\",\"stock\":\"600\",\"quantity\":1},{\"id\":\"16\",\"code\":\"BLO017\",\"name\":\"Blok Beton (Meter Kubik)\",\"m_category_id\":\"1\",\"m_unit_id\":\"4\",\"price\":\"1500000\",\"stock\":\"80\",\"quantity\":1}]', 1625000, 'DONE', '2024-07-22 08:49:59', '2024-07-22 08:49:59'),
(30, 'Reva', '081273151439', '[{\"id\":\"9\",\"code\":\"RTR009\",\"name\":\"Rantai Besi (Meter)\",\"m_category_id\":\"2\",\"m_unit_id\":\"3\",\"price\":\"50000\",\"stock\":\"1000\",\"quantity\":1},{\"id\":\"19\",\"code\":\"WRC020\",\"name\":\"Wiremesh (Meter Persegi)\",\"m_category_id\":\"3\",\"m_unit_id\":\"3\",\"price\":\"120000\",\"stock\":\"200\",\"quantity\":1},{\"id\":\"6\",\"code\":\"BTK006\",\"name\":\"Baut dan Mur (Set)\",\"m_category_id\":\"2\",\"m_unit_id\":\"1\",\"price\":\"120000\",\"stock\":\"8000\",\"quantity\":1}]', 290000, 'ORDERED', '2024-07-22 14:20:38', '2024-07-22 14:20:38'),
(31, 'Reva', '081273151439', '[{\"id\":\"9\",\"code\":\"RTR009\",\"name\":\"Rantai Besi (Meter)\",\"m_category_id\":\"2\",\"m_unit_id\":\"3\",\"price\":\"50000\",\"stock\":\"1000\",\"quantity\":1},{\"id\":\"19\",\"code\":\"WRC020\",\"name\":\"Wiremesh (Meter Persegi)\",\"m_category_id\":\"3\",\"m_unit_id\":\"3\",\"price\":\"120000\",\"stock\":\"200\",\"quantity\":1},{\"id\":\"6\",\"code\":\"BTK006\",\"name\":\"Baut dan Mur (Set)\",\"m_category_id\":\"2\",\"m_unit_id\":\"1\",\"price\":\"120000\",\"stock\":\"8000\",\"quantity\":1}]', 290000, 'PROCESSED', '2024-07-22 14:21:25', '2024-07-22 14:21:25'),
(32, 'Isra', '089636685605', '[{\"id\":\"1\",\"code\":\"KD001\",\"name\":\"Papan Kayu Meranti\",\"m_category_id\":\"1\",\"m_unit_id\":\"1\",\"price\":\"250000\",\"stock\":\"200\",\"quantity\":1},{\"id\":\"23\",\"code\":\"FBR024\",\"name\":\"Fiberglass (Meter)\",\"m_category_id\":\"1\",\"m_unit_id\":\"3\",\"price\":\"110000\",\"stock\":\"350\",\"quantity\":1}]', 360000, 'PROCESSED', '2024-07-22 14:22:35', '2024-07-22 14:22:35'),
(33, 'Reva', '081273151439', '[{\"id\":\"2\",\"code\":\"PK002\",\"name\":\"Paku Baja (Kotak)\",\"m_category_id\":\"2\",\"m_unit_id\":\"2\",\"price\":\"50000\",\"stock\":\"5000\",\"quantity\":1},{\"id\":\"26\",\"code\":\"GNC0001\",\"name\":\"Gancu\",\"m_category_id\":\"2\",\"m_unit_id\":\"1\",\"price\":\"25000\",\"stock\":\"99\",\"quantity\":1}]', 75000, 'PROCESSED', '2024-07-22 14:23:28', '2024-07-22 14:23:28'),
(34, 'Israzz', '089636685605', '[{\"id\":\"7\",\"code\":\"ASB007\",\"name\":\"Asbes Lembaran (Meter)\",\"m_category_id\":\"1\",\"m_unit_id\":\"3\",\"price\":\"30000\",\"stock\":\"300\",\"quantity\":1},{\"id\":\"21\",\"code\":\"KRC022\",\"name\":\"Kran Air Kamar Mandi\",\"m_category_id\":\"5\",\"m_unit_id\":\"1\",\"price\":\"95000\",\"stock\":\"300\",\"quantity\":1},{\"id\":\"22\",\"code\":\"RCR023\",\"name\":\"Roofing Cermin\",\"m_category_id\":\"1\",\"m_unit_id\":\"5\",\"price\":\"135000\",\"stock\":\"250\",\"quantity\":1},{\"id\":\"26\",\"code\":\"GNC0001\",\"name\":\"Gancu\",\"m_category_id\":\"2\",\"m_unit_id\":\"1\",\"price\":\"25000\",\"stock\":\"99\",\"quantity\":2}]', 310000, 'DONE', '2024-07-22 14:45:13', '2024-07-22 14:45:13'),
(35, 'Efrhillia Windy', '082225510565', '[{\"id\":\"11\",\"code\":\"KB012\",\"name\":\"Kaca Bangunan (Meter Persegi)\",\"m_category_id\":\"1\",\"m_unit_id\":\"3\",\"price\":\"200000\",\"stock\":\"400\",\"quantity\":2},{\"id\":\"24\",\"code\":\"MLM025\",\"name\":\"Mika Lembaran\",\"m_category_id\":\"4\",\"m_unit_id\":\"1\",\"price\":\"70000\",\"stock\":\"180\",\"quantity\":3},{\"id\":\"6\",\"code\":\"BTK006\",\"name\":\"Baut dan Mur (Set)\",\"m_category_id\":\"2\",\"m_unit_id\":\"1\",\"price\":\"120000\",\"stock\":\"8000\",\"quantity\":1}]', 730000, 'PROCESSED', '2024-07-22 14:52:44', '2024-07-22 14:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `id` int NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `m_category_id` int NOT NULL,
  `m_unit_id` int NOT NULL,
  `stock` int NOT NULL,
  `price` float NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `m_supplier_id` int NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`id`, `code`, `name`, `m_category_id`, `m_unit_id`, `stock`, `price`, `description`, `m_supplier_id`, `createdAt`, `updatedAt`) VALUES
(1, 'KD001', 'Papan Kayu Meranti', 1, 1, 200, 250000, 'Papan kayu meranti berkualitas tinggi untuk konstruksi dan mebel', 1, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(2, 'PK002', 'Paku Baja (Kotak)', 2, 2, 5000, 50000, 'Kotak paku baja untuk berbagai keperluan konstruksi', 2, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(3, 'LS003', 'Kabel Listrik (Roll)', 3, 3, 100, 150000, 'Roll kabel listrik cocok untuk instalasi listrik rumah tangga', 3, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(4, 'CT004', 'Cat Interior (Galon)', 4, 4, 300, 100000, 'Galon cat interior dalam berbagai warna', 4, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(5, 'PP005', 'Pipa PVC (10 kaki)', 5, 5, 150, 75000, 'Pipa PVC 10 kaki untuk instalasi pipa', 5, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(6, 'BTK006', 'Baut dan Mur (Set)', 2, 1, 8000, 120000, 'Set baut dan mur lengkap untuk konstruksi', 2, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(7, 'ASB007', 'Asbes Lembaran (Meter)', 1, 3, 299, 30000, 'Lembaran asbes untuk atap dan dinding', 1, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(8, 'KC008', 'Kran Air', 5, 1, 500, 80000, 'Kran air untuk keperluan plumbing', 5, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(9, 'RTR009', 'Rantai Besi (Meter)', 2, 3, 1000, 50000, 'Rantai besi berbahan kuat untuk berbagai keperluan', 4, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(10, 'SD011', 'Semen (Sak)', 4, 2, 200, 75000, 'Semen untuk konstruksi bangunan', 3, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(11, 'KB012', 'Kaca Bangunan (Meter Persegi)', 1, 3, 400, 200000, 'Kaca bangunan berkualitas tinggi', 1, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(12, 'SPL013', 'Spandek (Meter)', 1, 5, 599, 125000, 'Spandek untuk atap bangunan', 2, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(13, 'BPU014', 'Besi Beton Polos (Batang)', 2, 5, 300, 90000, 'Besi beton polos untuk struktur bangunan', 4, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(14, 'TGG015', 'Tangga Lipat Aluminium', 3, 1, 149, 300000, 'Tangga lipat aluminium untuk keperluan rumah tangga', 3, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(15, 'SB016', 'Sikat Cat (Set)', 4, 1, 400, 50000, 'Set sikat cat untuk melukis', 5, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(16, 'BLO017', 'Blok Beton (Meter Kubik)', 1, 4, 79, 1500000, 'Blok beton untuk konstruksi bangunan', 2, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(17, 'DLB018', 'Dinding Bata (Per Bungkus)', 1, 1, 1000, 30000, 'Bata merah untuk pembangunan dinding', 1, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(18, 'PLL019', 'Plywood Lembaran (Meter)', 1, 3, 500, 180000, 'Plywood untuk lantai dan dinding', 3, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(19, 'WRC020', 'Wiremesh (Meter Persegi)', 3, 3, 200, 120000, 'Wiremesh untuk struktur beton', 4, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(20, 'BLP021', 'Baja Ringan (Batang)', 2, 5, 400, 60000, 'Baja ringan untuk atap bangunan', 5, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(21, 'KRC022', 'Kran Air Kamar Mandi', 5, 1, 299, 95000, 'Kran air khusus untuk kamar mandi', 5, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(22, 'RCR023', 'Roofing Cermin', 1, 5, 249, 135000, 'Atap cermin untuk perlindungan bangunan', 2, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(23, 'FBR024', 'Fiberglass (Meter)', 1, 3, 350, 110000, 'Fiberglass untuk penutup dan panel bangunan', 1, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(24, 'MLM025', 'Mika Lembaran', 4, 1, 180, 70000, 'Mika lembaran untuk pelapis dan penutup', 4, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(25, 'TBB026', 'Tembok Batu Bata', 1, 1, 499, 25000, 'Tembok batu bata untuk dinding bangunan', 3, '2024-06-27 00:16:17', '2024-06-27 00:16:17'),
(26, 'GNC0001', 'Gancu', 2, 1, 97, 25000, 'Gancu for living', 2, '2024-07-20 08:11:50', '2024-07-20 16:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` int NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id`, `company_name`, `email`, `address`, `phone_number`, `description`) VALUES
(1, 'PT. Perkayuan Jaya', 'perkayuanjaya@gmail.com', 'Jl. Perkayuan No. 123, Kota Perkayuan', '081234567890', 'Pemasok kayu dan produk kayu berkualitas'),
(2, 'PT. Pabrik Paku', 'pabrikpaku@gmail.com', 'Jl. Paku No. 456, Kota Paku', '089876543210', 'Produsen paku dan bahan pengunci'),
(3, 'PT. Listrik Maju', 'listrikmaju@gmail.com', 'Jl. Listrik No. 789, Kota Listrik', '08567890123', 'Distributor komponen listrik'),
(4, 'PT. Cat Indah', 'catindah@gmail.com', 'Jl. Cat No. 101, Kota Cat', '087890123456', 'Pemasok cat dan pelapis'),
(5, 'PT. Solusi Pipa', 'solusipipa@gmail.com', 'Jl. Pipa No. 234, Kota Pipa', '08216549870', 'Pemasok material pipa dan aksesori');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaction`
--

CREATE TABLE `tb_transaction` (
  `id` int NOT NULL,
  `transaction_no` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `m_order_id` int NOT NULL,
  `payment_amount` float DEFAULT NULL,
  `payment_change` float DEFAULT NULL,
  `payment_status` enum('PAID','UNPAID') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaction`
--

INSERT INTO `tb_transaction` (`id`, `transaction_no`, `m_order_id`, `payment_amount`, `payment_change`, `payment_status`, `createdAt`, `updatedAt`) VALUES
(11, 'TBA9CC460', 29, 2000000, 375000, 'PAID', '2024-07-22 14:00:46', '2024-07-22 14:00:46'),
(12, 'TBA6B01B7', 28, NULL, NULL, 'UNPAID', '2024-07-22 14:09:14', '2024-07-22 14:09:14'),
(13, 'TBAA0C71E', 33, NULL, NULL, 'UNPAID', '2024-07-22 14:39:00', '2024-07-22 14:39:00'),
(14, 'TBA83FD0F', 32, NULL, NULL, 'UNPAID', '2024-07-22 14:40:15', '2024-07-22 14:40:15'),
(15, 'TBA2D4DD8', 31, NULL, NULL, 'UNPAID', '2024-07-22 14:42:14', '2024-07-22 14:42:14'),
(16, 'TBA50B5E6', 34, 350000, 40000, 'PAID', '2024-07-22 14:45:42', '2024-07-22 14:45:42'),
(17, 'TBA786B9B', 35, NULL, NULL, 'UNPAID', '2024-07-23 15:13:54', '2024-07-23 15:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id` int NOT NULL,
  `code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id`, `code`, `name`) VALUES
(1, 'Pcs', 'Buah'),
(2, 'BOX', 'Kotak'),
(3, 'ROLL', 'Roll'),
(4, 'GAL', 'Galon'),
(5, 'FT', 'Kaki');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('SUPER-ADMIN','ADMIN') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `role`, `createdAt`, `updatedAt`) VALUES
(1, 'superadmin', '$2y$10$ty568YKGtZz9D5DqPNF/eO4aEsvNv85ulCmh0JNBrfXdnvZg7ORrG', 'SUPER-ADMIN', '2024-06-27 00:35:07', '2024-06-27 00:35:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_category_id` (`m_category_id`),
  ADD KEY `m_unit_id` (`m_unit_id`),
  ADD KEY `m_supplier_id` (`m_supplier_id`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaction`
--
ALTER TABLE `tb_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_order_id` (`m_order_id`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_transaction`
--
ALTER TABLE `tb_transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `tb_product_ibfk_1` FOREIGN KEY (`m_category_id`) REFERENCES `tb_category` (`id`),
  ADD CONSTRAINT `tb_product_ibfk_2` FOREIGN KEY (`m_unit_id`) REFERENCES `tb_unit` (`id`),
  ADD CONSTRAINT `tb_product_ibfk_3` FOREIGN KEY (`m_supplier_id`) REFERENCES `tb_supplier` (`id`);

--
-- Constraints for table `tb_transaction`
--
ALTER TABLE `tb_transaction`
  ADD CONSTRAINT `tb_transaction_ibfk_1` FOREIGN KEY (`m_order_id`) REFERENCES `tb_order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
