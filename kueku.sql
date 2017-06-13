-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2017 at 05:26 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kueku`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbbeli`
--

CREATE TABLE `tbbeli` (
  `idbeli` int(11) NOT NULL,
  `idpembeli` int(11) NOT NULL,
  `idkue` int(11) NOT NULL,
  `jmlbeli` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tglbeli` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbbuat`
--

CREATE TABLE `tbbuat` (
  `id` int(11) NOT NULL,
  `idpengrajin` int(11) NOT NULL,
  `idkue` int(11) NOT NULL,
  `nmkue` varchar(30) NOT NULL,
  `hrg` int(11) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbbuat`
--

INSERT INTO `tbbuat` (`id`, `idpengrajin`, `idkue`, `nmkue`, `hrg`, `gambar`) VALUES
(1, 2, 1, 'Kue Lapis Coklat Pandan', 1000, '552caf906ea8348f4d8b4567.jpeg'),
(2, 3, 1, 'Kue Lapis', 1500, 'http://localhost/kueku/assets/img/552caf906ea8348f4d8b4567.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbfeedback`
--

CREATE TABLE `tbfeedback` (
  `idfeedback` int(11) NOT NULL,
  `idkue` int(11) NOT NULL,
  `idpembeli` int(11) NOT NULL,
  `ukuran` tinyint(1) NOT NULL,
  `bahan` tinyint(1) NOT NULL,
  `penyajian` tinyint(1) NOT NULL,
  `rasa` tinyint(1) NOT NULL,
  `review` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbkategori`
--

CREATE TABLE `tbkategori` (
  `idkategori` int(11) NOT NULL,
  `idkue` int(11) NOT NULL,
  `ukuran` text NOT NULL,
  `bahan` text NOT NULL,
  `penyajian` text NOT NULL,
  `rasa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbkategori`
--

INSERT INTO `tbkategori` (`idkategori`, `idkue`, `ukuran`, `bahan`, `penyajian`, `rasa`) VALUES
(1, 1, 'Ukuran sedang dengan bentuk persegi panjang dan memiliki tebal yang sama untuk setiap lapisannya.', 'Bahan-bahan yang digunakan harus sama dengan resep yang diberikan dan dengan takaran yang sama', 'Kue disajikan dalam bungkusan plastik rapi dengan plastik menutupi seluruh permukaan kue.', 'Rasa pada kue harus manis namun tidak boleh terlalu manis.');

-- --------------------------------------------------------

--
-- Table structure for table `tbkue`
--

CREATE TABLE `tbkue` (
  `idkue` int(11) NOT NULL,
  `nmkue` varchar(20) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbkue`
--

INSERT INTO `tbkue` (`idkue`, `nmkue`, `gambar`) VALUES
(1, 'Kue Lapis', '/assets/img/552caf906ea8348f4d8b4567.jpeg'),
(2, 'Onde-Onde', '/assets/img/asal-usul-onde-onde-kue-tradisional-khas-kabupaten-mojokerto-160824t.jpg'),
(4, 'Bolu Kukus', '/assets/img/bolu-kukus-mekar-salah-satu-kue-tradisional-yang-kini-_161219131837-834.jpg'),
(5, 'Dadar Gulung', '/assets/img/gambar kue dadar gulung ala bahanresep.jpg'),
(6, 'Serabi Beras', '/assets/img/maxresdefault.jpg'),
(7, 'Kue Lumpur', '/assets/img/Resep Kue Lumpur.jpg'),
(8, 'Kue Cincin', '/assets/img/Resep-Kue-Cincin-Khas-Tanah-Pasundan-Bandung.jpg'),
(9, 'Pandan Ayu', '/assets/img/Resep-Kue-Tradisional1.jpg'),
(10, 'Cucur Manis', '/assets/img/Resep-Kue-Tradisional-Cucur-Manis-Lezat-300x181.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbmember`
--

CREATE TABLE `tbmember` (
  `idmember` int(11) NOT NULL,
  `nmmember` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbmember`
--

INSERT INTO `tbmember` (`idmember`, `nmmember`, `username`, `pass`, `email`, `alamat`, `status`) VALUES
(1, 'Karina Levina', 'karinalevina', 'a37b2a637d2541a600d707648460397e', 'karina_14@kharisma.ac.id', 'Jl. Lompobattang no. 212', 0),
(2, 'Wendy', 'wendy', '2cff03e4b9eb85b3bf5e924ccdc1348d', 'wendy_14@kharisma.ac.id', 'Jl. Satangnga no. 10', 1),
(3, 'Sofyan Thayf', 'sofyanthayf', 'a43ea2f3c29ef3423c48d633d1a1909d', 'sofyanthayf_14@kharisma.ac.id', 'Jl. Baji Ateka No. 20', 1),
(4, 'Vera Tjandra', 'vera', '4341dfaa7259082022147afd371b69c3', 'vera_14@kharisma.ac.id', 'Jl. Bacan no. 13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbpengrajin`
--

CREATE TABLE `tbpengrajin` (
  `idpengrajin` int(11) NOT NULL,
  `nmpengrajin` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpengrajin`
--

INSERT INTO `tbpengrajin` (`idpengrajin`, `nmpengrajin`, `username`, `password`, `alamat`, `email`) VALUES
(1, 'Wendy', 'wendy_14', 'wendy', 'jalan satangnga', 'wendy_14@kharisma.ac.id'),
(2, 'Karina', 'karina_14', 'karina', 'jalan lompobattang', 'karina_14@kharisma.ac.id');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbbeli`
--
ALTER TABLE `tbbeli`
  ADD PRIMARY KEY (`idbeli`);

--
-- Indexes for table `tbbuat`
--
ALTER TABLE `tbbuat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbfeedback`
--
ALTER TABLE `tbfeedback`
  ADD PRIMARY KEY (`idfeedback`);

--
-- Indexes for table `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `tbkue`
--
ALTER TABLE `tbkue`
  ADD PRIMARY KEY (`idkue`);

--
-- Indexes for table `tbmember`
--
ALTER TABLE `tbmember`
  ADD PRIMARY KEY (`idmember`);

--
-- Indexes for table `tbpengrajin`
--
ALTER TABLE `tbpengrajin`
  ADD PRIMARY KEY (`idpengrajin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbbeli`
--
ALTER TABLE `tbbeli`
  MODIFY `idbeli` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbbuat`
--
ALTER TABLE `tbbuat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbfeedback`
--
ALTER TABLE `tbfeedback`
  MODIFY `idfeedback` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbkue`
--
ALTER TABLE `tbkue`
  MODIFY `idkue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbmember`
--
ALTER TABLE `tbmember`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbpengrajin`
--
ALTER TABLE `tbpengrajin`
  MODIFY `idpengrajin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
