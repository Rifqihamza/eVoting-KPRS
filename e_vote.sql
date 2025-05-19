-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 08:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create the database
CREATE DATABASE IF NOT EXISTS `db_evoteMM2100` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_evoteMM2100`;

-- --------------------------------------------------------
-- Table structure for table `t_admin`
-- --------------------------------------------------------

CREATE TABLE `t_admin` (
  `id_admin` tinyint(3) UNSIGNED NOT NULL,
  `username` varchar(35) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `t_admin`

INSERT INTO `t_admin` (`id_admin`, `username`, `fullname`, `password`) VALUES
(1, 'M Rifqi Hamza', 'M Rifqi Hamza', '$2y$10$5ok3rcIOv/yNIlPIGo49a.cXRAiA5ZsnxbpijFoyy5EuuYyVrZetu');

-- --------------------------------------------------------
-- Table structure for table `t_history`
-- --------------------------------------------------------

CREATE TABLE `t_history` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `nama_calon` varchar(255) NOT NULL,
  `periode` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `t_kandidat`
-- --------------------------------------------------------

CREATE TABLE `t_kandidat` (
  `id_kandidat` smallint(4) UNSIGNED NOT NULL,
  `nama_calon` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `suara` smallint(4) UNSIGNED NOT NULL DEFAULT 0,
  `periode` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `t_kelas`
-- --------------------------------------------------------

CREATE TABLE `t_kelas` (
  `id_kelas` varchar(3) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `t_kelas`

INSERT INTO `t_kelas` (`id_kelas`, `nama_kelas`) VALUES
('K01', 'Warga Mitra 01'),
('K02', 'Warga Mitra 02'),
('K03', 'Warga Mitra 03');

-- --------------------------------------------------------
-- Table structure for table `t_pemilih`
-- --------------------------------------------------------

CREATE TABLE `t_pemilih` (
  `nis` varchar(20) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `periode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `t_user`
-- --------------------------------------------------------

CREATE TABLE `t_user` (
  `id_user` varchar(10) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `id_kelas` varchar(3) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `pemilih` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `t_user`

INSERT INTO `t_user` (`id_user`, `fullname`, `id_kelas`, `jk`, `pemilih`) VALUES
('1', 'John Doe', 'K01', 'L', 'Y'),
('2', 'Jane Doe', 'K02', 'P', 'Y'),
('3', 'Bob Smith', 'K03', 'L', 'Y'),
('4', 'Alice Johnson', 'K01', 'P', 'Y'),
('5', 'Mike Brown', 'K02', 'L', 'Y');

-- --------------------------------------------------------
-- Indexes for tables
-- --------------------------------------------------------

-- Indexes for table `t_admin`
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id_admin`);

-- Indexes for table `t_history`
ALTER TABLE `t_history`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `t_kandidat`
ALTER TABLE `t_kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

-- Indexes for table `t_kelas`
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`id_kelas`);

-- Indexes for table `t_pemilih`
ALTER TABLE `t_pemilih`
  ADD PRIMARY KEY (`nis`,`fullname`,`periode`);

-- Indexes for table `t_user`
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_kelas` (`id_kelas`);

-- --------------------------------------------------------
-- AUTO_INCREMENT for tables
-- --------------------------------------------------------

-- AUTO_INCREMENT for table `t_admin`
ALTER TABLE `t_admin`
  MODIFY `id_admin` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- AUTO_INCREMENT for table `t_history`
ALTER TABLE `t_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT for table `t_kandidat`
ALTER TABLE `t_kandidat`
  MODIFY `id_kandidat` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Constraints for tables
-- --------------------------------------------------------

-- Constraints for table `t_user`
ALTER TABLE `t_user`
  ADD CONSTRAINT `t_user_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `t_kelas` (`id_kelas`) ON DELETE CASCADE;

COMMIT;
