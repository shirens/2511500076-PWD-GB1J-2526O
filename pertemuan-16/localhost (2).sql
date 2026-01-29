-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2026 at 02:14 AM
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
-- Database: `db_pwd2025`
--
CREATE DATABASE IF NOT EXISTS `db_pwd2025` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_pwd2025`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_julio`
--

CREATE TABLE `tbl_julio` (
  `cid` int NOT NULL,
  `NIM` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Nama_Lengkap` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Tempat_Lahir` varchar(50) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Hobi` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Pasangan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Pekerjaan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Nama_Ortu` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Nama_Kakak` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Nama_Adik` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_julio`
--

INSERT INTO `tbl_julio` (`cid`, `NIM`, `Nama_Lengkap`, `Tempat_Lahir`, `Tanggal_Lahir`, `Hobi`, `Pasangan`, `Pekerjaan`, `Nama_Ortu`, `Nama_Kakak`, `Nama_Adik`, `created_at`) VALUES
(3, '2511500077', 'julio putrawan', 'pangkalpinang', '2006-07-01', 'bermain game', 'tidak ada', 'teknisi', 'yuliana', 'gok gok', 'j', '2026-01-10 21:44:19'),
(4, '2511500076', 'julio putrawan', 'pangkalpinang', '2006-07-01', 'bermain game', 'tidak ada', 'teknisi', 'yuliana', 'gok gok', 'izin', '2026-01-10 22:31:54'),
(5, '2511500076', 'julio putrawan', 'c', '2006-07-01', 'bermain game', 'tidak ada', 'g', 'yuliana', 'gok gok', 'j', '2026-01-10 22:36:30'),
(6, '2511500076', 'b', 'pangkalpinang', '2006-07-01', 'bermain game', 'tidak ada', 'g', 'h', 'gok gok', 'izin', '2026-01-10 22:38:11'),
(8, '2323625365', 'Julio Putrawan', 'pangkalpinang', '2006-07-01', 'Bermain game', '-', 'teknisi', 'lalala', 'kakska', 'dadae', '2026-01-11 13:38:06'),
(9, '2323625365', 'Julio Putrawan', 'pangkalpinang', '2006-07-01', 'Bermain game', '-', 'teknisi', 'lalala', 'kakska', 'dadae', '2026-01-11 13:41:25'),
(10, '2323625365', 'Julio Putrawan', 'pangkalpinang', '3030-04-03', 'Bermain game', '-', 'teknisi', 'lalala', 'kakska', 'dadae', '2026-01-11 13:42:58'),
(13, '2323625365', 'Julio Putrawan', 'pangkalpinang', '2060-03-08', 'Bermain game', '-', 'teknisi', 'lalala', 'kakska', 'dadae', '2026-01-11 13:55:57'),
(14, '251150075', 'Julio Putrawan', 'pangkalpinang', '2006-07-01', 'Bermain game', 'adalah pokoknya', 'teknisi', 'saala', 'kakska', 'dadae', '2026-01-11 19:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shirens`
--

CREATE TABLE `tbl_shirens` (
  `cid` int NOT NULL,
  `kode_pengunjung` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_pengunjung` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat_rumah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal_kunjungan` date DEFAULT NULL,
  `hobi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `asal_slta` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pekerjaan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_ortu` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_pacar` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_mantan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_shirens`
--

INSERT INTO `tbl_shirens` (`cid`, `kode_pengunjung`, `nama_pengunjung`, `alamat_rumah`, `tanggal_kunjungan`, `hobi`, `asal_slta`, `pekerjaan`, `nama_ortu`, `nama_pacar`, `nama_mantan`, `created_at`) VALUES
(18, '21623623623', 'julio putrawan', 'hahahah', '2206-02-10', 'main', 'smk', 'teknisi', 'ahhah', 'adalah', '???', '2026-01-22 18:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tamu`
--

CREATE TABLE `tbl_tamu` (
  `cid` int NOT NULL,
  `cnama` varchar(100) DEFAULT NULL,
  `cemail` varchar(100) DEFAULT NULL,
  `cpesan` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tamu`
--

INSERT INTO `tbl_tamu` (`cid`, `cnama`, `cemail`, `cpesan`, `created_at`) VALUES
(1, 'Julio Putrawan', '2511500076@mahasiswa.atmaluhur.ac.id', 'Saya sangat senang belajar pemrograman web dasar', '2025-12-16 23:23:05'),
(2, 'Ade Putra', 'adeputrapkp@gmail.com', 'saya sangat hebat pada pelajaran kalkulus', '2025-12-16 23:23:05'),
(3, 'Maharani Indah Saputri', 'ranirani@gmail.com', 'saya kadang kurang teliti saat belajar pemrograman web dasar', '2025-12-16 23:23:05'),
(4, 'Julio Putrawan', '2511500076@mahasiswa.atmaluhur.ac.id', 'ernjekjriejfiejfi', '2025-12-16 23:23:05'),
(5, 'jul', 'awiuw8ue@gmail.com', 'aewa', '2025-12-16 23:23:05'),
(6, 'dfdfdsfsxdwki', 'sjdnsjdhjwdhwjdhws@gdyw.com', 'sdsds', '2025-12-16 23:23:05'),
(7, 'jul', 'hahhah@gmail.com', 'add', '2025-12-16 23:23:05'),
(8, 'Julio Putrawan', '2511500076@mahasiswa.atmaluhur.ac.id', 'dwmdkwjkwdw', '2025-12-16 23:23:05'),
(9, 'ju', '2511500076@mahasiswa.atmaluhur.ac.id', 'ase', '2025-12-16 23:23:05'),
(10, 'asasasad', 'jaisuqeuhyu@gmail.com', 'derfwetegtegtreg', '2025-12-16 23:23:05'),
(12, 'rgrrgrgrfd', 'hahhah@gmail.com', 'jdujeidwsdsw', '2026-01-10 09:45:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_julio`
--
ALTER TABLE `tbl_julio`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_shirens`
--
ALTER TABLE `tbl_shirens`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_julio`
--
ALTER TABLE `tbl_julio`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_shirens`
--
ALTER TABLE `tbl_shirens`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
