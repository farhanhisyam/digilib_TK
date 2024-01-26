-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2023 at 01:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digilib_tk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nip` char(18) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` char(18) NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `alamat`, `telp`) VALUES
('196005101984031000', 'Ir. SLAMET WIDODO, M.Eng.', 'Jln. Bendungan Payung Mas G 43 RT. 05/10 Pudakpayung, Banyumanik, Semarang\r\n', '082225913375'),
('196008241988031000', 'AGUS ROCHADI, S.T., M.M.', 'Jl. Sekip IV/9 RT.02/06, Tembalang, Semarang\r\n', '08122901427'),
('196104241989031000', 'ENDRO WASITO, Ir., M.Kom.', 'JI. Bukit Kelapa Kopyor XI/ B1-03 RT. 06/14 Meteseh Tembalang Semarang\r\n', '081390919839'),
('196107171986031000', 'ARIF NURSYAHID, Drs., M.T.', 'Jln. Sekip III/12 Tembalang Semarang\r\n', '08122974761'),
('196209111989031000', 'BUDI BASUKI S., S.T., M.Eng.', 'JI. Tembalang Pesona Asri  G/3 RT. 02/04 Kramas Tembalang Semarang\r\n', '08156531499'),
('196301251991031000', 'SINDUNG H. W. S., BSEE., M.Eng.Sc.', 'Jl. Telaga B/68 Payung Mas, Pudak Payung, Semarang\r\n', '08157731763'),
('196403091991031000', 'SARONO WIDODO, S.T., M.Kom. ', 'Pondok Bukit Agung Blok O No. 3 RT. 3/4 Sumurboto, Banyumanik, Semarang', '08882701081'),
('196506071990031000', 'ABU HASAN, S.T., M.T.', 'Jl. Dinar Mas Utara IV/39 RT.03/18 Perum Dinar Mas, Tembalang, Semarang\r\n', '081326146799'),
('196710171997022000', 'SRI ANGGRAENI KADIRAN, S.T., M.Eng', 'Jln. Bendungan Payung Mas G 43 RT. 05/10 Pudakpayung, Banyumanik, Semarang\r\n', '081329096217'),
('196902012000121000', 'EKO SUPRIYANTO, S.T., M.T.', 'Jl. Subali Utara No. 1 Semarang\r\n', '0813266621058'),
('197203112000031000', 'Dr. Eng. SIDIQ S. H., S.T., M.T.', 'JI. Suropati 54, Sapuran, Wonosobo\r\n', '081391737108'),
('197203292000031000', 'THOMAS AGUNG S., S.T., M.T.', 'Jln. Palebon Raya No. 16 RT. 04/03 Palebon, Pedurungan, Semarang\r\n', '087838132548'),
('197210271999031000', 'Dr. AMIN SUHARJONO, S.T., M.T.', 'JI. Galungan II/65 Rt. 02/06 Krapyak, Semarang\r\n', '08164254883'),
('197409042005011000', 'ARI SRIYANTO N., S.T., M.T., M.Sc.', 'Jl. Kresno Nol. 9 Sendang Gede, Banyumanik RT 09/11 Banyumanik\r\n', '08122974761'),
('197409282000032000', 'ENI DWI WARDIHANI, S.T., M.T., Dr.', 'Jl. Gondang Raya 17, Bulusan Semarang\r\n', '08164258957'),
('197908102006041000', 'HELMY, S.T., M.Eng.', 'JI. Raden Patah (Kp. Bedug 176 C) Semarang\r\n', '08112708186'),
('197911252006042000', 'MUHLASAH NOVITASARI MARA,S.Si,M.S', 'Arteri Sukarno Hatta JI. Palebon Tengah Raya No 18 8277 RT 4 RW 11 Kel. Palebon Kec. Pedurungan, Semarang\r\n', '085650958277'),
('199112292020121000', 'HUTAMA ARIF BRAMANTYO, S.T., M.T.', 'JI. Raden Patah (Kp. Bedug 187 ) Semarang\r\n', '08118842929'),
('199404112020122000', 'EFRILIA MARIFATUL KHUSNA, S.ST., M.T.', '', '081334093439'),
('199407312019032000', 'RIZKHA AJENG R., S.T., M.T.', 'Pondok Bukit Agung Blok O No. 5 RT. 3/4 Sumurboto, Banyumanik, Semarang\r\n\r\n', '085641107335');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `create_login` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `create_login`, `last_login`) VALUES
('admin', '$2y$10$TiM7kKTXugx72FfrYV0XgeMlqAd82sMAy9zRvfOp59MWORiIGPjhW', '2023-06-05 08:08:44', '2023-06-05 08:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `nim` char(12) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `kelas` char(5) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `telp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`nim`, `nama`, `kelas`, `jurusan`, `prodi`, `alamat`, `kota`, `telp`) VALUES
('3.33.17.0.01', 'Amalia Sari Nur Azizah', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.02', 'Anita Nur Widdia Saputri', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.03', 'Annisa Ayuningtyas', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.04', 'Athadhia Febyana', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.05', 'Attar Diansyah Pangestu', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.06', 'Choirul Roziq ', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.07', 'Galih Bahtera', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.08', 'Hanif Nur Azizah', 'TK-3A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.09', 'Innaya Maulida ', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.10', 'Kensi Nurul Hayuputri S', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.11', 'M. Fani Zuhri', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.12', 'Meilani Rahayuningrum', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.13', 'Moch Rizky', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.14', 'M. Hubaeybul H', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.16', 'Putri Desi Agustina', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.17', 'Rizkiawan Nur Ubaidillah', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.18', 'Rudy Hendriyanto', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.19', 'Satrio Prosysman ', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.20', 'Seviani Desta Azzahra', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.21', 'Syarief Fadhlirahman H', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.22', 'Yety Menik Anjarwati', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.23', 'Yunita Fitriyani', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.17.0.24', 'Zahratul Farida', 'TK-3A', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.01', 'Adinda Natasha Putri', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.02', 'Agustina Dewi Puspitasari ', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.03', 'Ailsa Nafa Devina', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.04', 'Amalia Rahmawati', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.05', 'Anugerah Dixto Maleachi ', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.06', 'Aulia Muthia Dewi', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.07', 'Beniah Misael', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.08', 'Betha Olievia Iswardani', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.09', 'Bima Naufal Lesmana', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.10', 'Diana Tri Awanda', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.11', ' Fery Firdaus', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.12', 'Intan Indita Cahyaningtias', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.13', 'Iwan Setiawan', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.14', 'Leni Viati ', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.16', 'Muhammad Iqbal Erwin Putra', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.17', 'Mukhammad Safii ', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.18', 'Nur Afifah', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.19', 'Nuriyana Rohmah ', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.20', 'Nurul  Hidayah', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.21', 'Rahma Ainun Nisa', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.22', 'Rr. Ina Afidah Sekarsari', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.23', 'Rut Megaria Siahaan ', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('3.33.20.1.24', 'Stevanus Aria Putra', 'TK-3B', 'Teknik Elektro', 'D3 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.01', 'Achmad Faris Rahman', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.02', 'Andina Seliasari', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.04', 'Azzah Yumnabila', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.06', 'Christian Giovanni Rilson W', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.07', 'Dewi Setiyaningsih', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.08', 'Dita Aprilia', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.10', 'Gayuh Pangestu Putri', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.11', 'Ima Awalia Hasna', 'TE-4A', 'Teknik Mesin', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.12', 'Irvan Fikri Umar', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.13', 'Karina Laras Novitasari', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.14', 'Khodijah Fathin Nabila', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.15', 'Mardian Sundaynur', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.19', 'Nursia Tae Yuniarum Putri', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.20', 'Requistian Hakem HPP', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.21', 'Rizal Priyambudi', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.22', 'Rizky Fauzi Rahman', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'q', 'q'),
('4.31.15.0.23', 'Tholud Aprilian', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.0.24', 'Wilda Puspa Pratiwi', 'TE-4A', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.01', 'Aji Aristia', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.02', 'Annissa Mahardika', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.03', 'Ariaji Prichi Gamayuda', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.04', 'Ayu Permatasari Puteri', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.05', 'Diaz Kanzi Mazaya', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.06', 'Dini Setiawati', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.07', 'Galih Prasetyo Ridho Mukti', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.08', 'Hany Windri Astuti', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.09', 'Hartisa Mufuda', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.10', 'Irfan Muhana', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.11', 'Isnatul Amanah', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.12', 'Mohammad Imadudin', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.13', 'Mohammad Prabowo Cahyo Rahmandani', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.14', 'Muhammad Bima Augzhardena', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.15', 'Nurul Khotimah', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.16', 'Okki Nur Athifah', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.17', 'Rizka Dwiannisa', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.18', 'Rizki Aditya Chrisdiyono', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.19', 'Rizma Vania R', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.20', 'Rizqi Nur Salam', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.21', 'Siti Harlina', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.22', 'Ulfatul Khasanah', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.23', 'Umar Fachri Abdillah', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a'),
('4.31.15.1.24', 'Wimba Zainrona', 'TE-4B', 'Teknik Elektro', 'D4 - Teknik Telekomunikasi', 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `pustaka1`
--

CREATE TABLE `pustaka1` (
  `id` int(16) NOT NULL,
  `judul` text NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `tahun` char(4) NOT NULL,
  `pembimbing_1` varchar(250) NOT NULL,
  `pembimbing_2` varchar(250) NOT NULL,
  `ketua_penguji` varchar(255) NOT NULL,
  `penguji_1` varchar(255) NOT NULL,
  `penguji_2` varchar(255) NOT NULL,
  `penguji_3` varchar(255) NOT NULL,
  `sekretaris` varchar(255) NOT NULL,
  `nama_file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pustaka1`
--

INSERT INTO `pustaka1` (`id`, `judul`, `tipe`, `tahun`, `pembimbing_1`, `pembimbing_2`, `ketua_penguji`, `penguji_1`, `penguji_2`, `penguji_3`, `sekretaris`, `nama_file`) VALUES
(2, 'test', 'TA', '2019', '196506071990031000', '197409042005011000', '196506071990031000', '196107171986031000', '196209111989031000', '197210271999031000', '197203112000031000', 'CV.png'),
(5, 'coba', 'Magang', '2023', '197203292000031000', 'Pilih', '', 'Pilih', 'Pilih', 'Pilih', 'Pilih', 'laporan job8.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `pustaka2`
--

CREATE TABLE `pustaka2` (
  `id` int(16) NOT NULL,
  `id_judul` int(16) NOT NULL,
  `nim` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pustaka2`
--

INSERT INTO `pustaka2` (`id`, `id_judul`, `nim`) VALUES
(23, 2, '4.31.15.1.08'),
(24, 2, '3.33.17.0.08'),
(25, 2, '3.33.17.0.01'),
(26, 5, '4.31.15.1.01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `pustaka1`
--
ALTER TABLE `pustaka1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pustaka2`
--
ALTER TABLE `pustaka2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pustaka1`
--
ALTER TABLE `pustaka1`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pustaka2`
--
ALTER TABLE `pustaka2`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
