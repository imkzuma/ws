-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 01:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_searching`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_data`
--

CREATE TABLE `tb_data` (
  `id` int(11) NOT NULL,
  `judul_penelitian` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(10) NOT NULL,
  `ruang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data`
--

INSERT INTO `tb_data` (`id`, `judul_penelitian`, `nama`, `hari`, `tanggal`, `jam`, `ruang`) VALUES
(1, 'penelitian rumah sakit', 'Gus Ari', 'Jumat', '2022-10-02', '10:00', 'BD 1.2'),
(3, 'penelitian suka manis', 'gungkrisna', 'senin', '2022-10-02', '10:00', 'BC 1.2'),
(4, 'Penelitian Website Searhching ', 'Agung Krisna', 'Selasa', '2022-10-08', '00:18', 'BC 1.2'),
(5, 'Penelitian Ramah Lingkungan', 'Agung Mahadana', 'Rabu', '2022-10-14', '12:36', 'BG 1'),
(15, 'Penelitian Laptop Rusak', 'Gung Krisna', 'Rabu', '2022-10-21', '12:51', 'BD 1.2'),
(21, 'Penelitian Sampah Organik', 'Gus Ari', 'Selasa', '2022-10-22', '13:02', 'BF 1.1'),
(27, 'Penelitian Keamanan Jaringan', 'Krisna Astrawan', 'Sabtu', '2022-10-15', '13:26', 'BC 1.1'),
(30, 'Penelitian Masa Depan', 'Mahadana', 'Rabu', '2022-10-08', '02:34', 'BD 1.2'),
(32, 'Penelitian Masa Depan', 'Mahadana', 'Kamis', '2022-10-07', '02:43', 'BD 1.2'),
(34, 'Penelitian Rumah Kaca', 'Gung Krisna', 'Selasa', '2022-10-02', '13:03', 'BD '),
(46, 'Penelitian Kerusakan Laptop', 'Astrawan', 'Jumat', '2022-10-13', '09:07', 'BD 1.2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `password`, `role`, `token`) VALUES
(2, 'admin', '$2y$10$Pt0bxLuIrOvXgbK8Kre4xeIsSH.G9HXTwS0No04M8/voDHiyw/v5e', 'admin', 'YWRtaW5hZG1pbg==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_data`
--
ALTER TABLE `tb_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_data`
--
ALTER TABLE `tb_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
