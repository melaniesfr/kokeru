-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 10:38 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kokeru`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti_kebersihan`
--

CREATE TABLE `bukti_kebersihan` (
  `id_bukti` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bukti_kebersihan`
--

INSERT INTO `bukti_kebersihan` (`id_bukti`, `id_ruang`, `tanggal`) VALUES
(1, 7, '2020-11-12 07:11:00'),
(2, 8, '2020-11-12 07:11:00'),
(3, 9, '2020-11-12 07:11:00'),
(4, 12, '2020-11-12 07:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `cs`
--

CREATE TABLE `cs` (
  `id_cs` int(11) NOT NULL,
  `nama_cs` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cs`
--

INSERT INTO `cs` (`id_cs`, `nama_cs`) VALUES
(1, 'Doni Kusumah'),
(2, 'Roni Sandria Kalalo'),
(3, 'Devi Desvinta Sari');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id_media` int(11) NOT NULL,
  `id_bukti` int(11) NOT NULL,
  `media` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id_media`, `id_bukti`, `media`) VALUES
(1, 1, 'photo'),
(2, 1, 'photo'),
(3, 1, 'video'),
(4, 2, 'photo'),
(5, 2, 'video'),
(6, 3, 'photo'),
(7, 3, 'photo'),
(8, 3, 'photo'),
(9, 4, 'photo'),
(10, 4, 'video');

-- --------------------------------------------------------

--
-- Table structure for table `pembersihan`
--

CREATE TABLE `pembersihan` (
  `id_pembersihan` int(11) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `id_cs` int(11) NOT NULL,
  `id_bukti` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembersihan`
--

INSERT INTO `pembersihan` (`id_pembersihan`, `id_ruang`, `id_cs`, `id_bukti`, `status`) VALUES
(1, 7, 1, 1, 'SUDAH'),
(2, 8, 1, 2, 'SUDAH'),
(3, 9, 1, 3, 'SUDAH'),
(4, 12, 3, 4, 'SUDAH');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL,
  `id_cs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `id_cs`) VALUES
(1, 'R.123', 1),
(2, 'R.122', 1),
(3, 'R.121', 1),
(4, 'R.143', 2),
(5, 'R.132', 2),
(6, 'R.113', 2),
(7, 'R.183', 1),
(8, 'R.163', 1),
(9, 'R.153', 1),
(10, 'R.129', 3),
(11, 'R.149', 3),
(12, 'R.139', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti_kebersihan`
--
ALTER TABLE `bukti_kebersihan`
  ADD PRIMARY KEY (`id_bukti`),
  ADD KEY `id_ruang` (`id_ruang`);

--
-- Indexes for table `cs`
--
ALTER TABLE `cs`
  ADD PRIMARY KEY (`id_cs`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `id_bukti` (`id_bukti`);

--
-- Indexes for table `pembersihan`
--
ALTER TABLE `pembersihan`
  ADD PRIMARY KEY (`id_pembersihan`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `id_cs` (`id_cs`),
  ADD KEY `id_bukti` (`id_bukti`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`),
  ADD KEY `id_cs` (`id_cs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti_kebersihan`
--
ALTER TABLE `bukti_kebersihan`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cs`
--
ALTER TABLE `cs`
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembersihan`
--
ALTER TABLE `pembersihan`
  MODIFY `id_pembersihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukti_kebersihan`
--
ALTER TABLE `bukti_kebersihan`
  ADD CONSTRAINT `bukti_kebersihan_ibfk_1` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`id_bukti`) REFERENCES `bukti_kebersihan` (`id_bukti`);

--
-- Constraints for table `pembersihan`
--
ALTER TABLE `pembersihan`
  ADD CONSTRAINT `pembersihan_ibfk_1` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`),
  ADD CONSTRAINT `pembersihan_ibfk_2` FOREIGN KEY (`id_cs`) REFERENCES `cs` (`id_cs`),
  ADD CONSTRAINT `pembersihan_ibfk_3` FOREIGN KEY (`id_bukti`) REFERENCES `bukti_kebersihan` (`id_bukti`);

--
-- Constraints for table `ruang`
--
ALTER TABLE `ruang`
  ADD CONSTRAINT `ruang_ibfk_1` FOREIGN KEY (`id_cs`) REFERENCES `cs` (`id_cs`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
