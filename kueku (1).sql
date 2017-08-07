-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2017 at 03:32 AM
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
  `tglbeli` date NOT NULL,
  `proses` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbbeli`
--

INSERT INTO `tbbeli` (`idbeli`, `idpembeli`, `tglbeli`, `proses`) VALUES
(1, 1, '2017-07-18', 3),
(3, 5, '2017-07-24', 2),
(4, 1, '2017-08-04', 3),
(5, 8, '2017-08-04', 3);

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
(1, 2, 1, 'Kue Lapis Coklat Pandan', 1500, '552caf906ea8348f4d8b4567.jpeg'),
(2, 3, 1, 'Kue Lapis', 1500, '552caf906ea8348f4d8b4567.jpeg'),
(3, 2, 2, 'Onde-Onde Padang Pasir', 3000, 'asal-usul-onde-onde-kue-tradisional-khas-kabupaten-mojokerto-160824t.jpg'),
(6, 1, 7, 'Kue Lumpur Coklat', 1300, 'Resep-Kue-Tradisional11.jpg'),
(7, 8, 6, 'Serabi Pandan', 1300, 'maxresdefault1.jpg'),
(8, 8, 9, 'Pandan Lapis', 2000, 'maxresdefault2.jpg'),
(9, 5, 10, 'Cucur Coklat', 2300, 'Resep-Kue-Tradisional-Cucur-Manis-Lezat-300x18111.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbdetbeli`
--

CREATE TABLE `tbdetbeli` (
  `idbeli` int(11) NOT NULL,
  `idkue` int(11) NOT NULL,
  `jmlh` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tglkirim` date NOT NULL,
  `proses` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbdetbeli`
--

INSERT INTO `tbdetbeli` (`idbeli`, `idkue`, `jmlh`, `subtotal`, `tglkirim`, `proses`) VALUES
(1, 3, 20, 50000, '2017-07-31', 2),
(1, 1, 2, 2000, '2017-07-31', 4),
(3, 1, 13, 19500, '2017-07-30', 2),
(5, 1, 10, 15000, '2017-08-15', 4),
(5, 2, 3, 4500, '2017-08-16', 0),
(4, 7, 19, 24700, '2017-08-16', 2),
(4, 8, 3, 6000, '2017-08-14', 4),
(4, 3, 30, 90000, '2017-08-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbdetkeranjang`
--

CREATE TABLE `tbdetkeranjang` (
  `idbeli` int(11) NOT NULL,
  `idkue` int(11) NOT NULL,
  `jmlh` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tglkirim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbdetkeranjang`
--

INSERT INTO `tbdetkeranjang` (`idbeli`, `idkue`, `jmlh`, `subtotal`, `tglkirim`) VALUES
(1, 3, 20, 50000, '2017-07-31'),
(1, 1, 2, 2000, '2017-07-31'),
(2, 3, 23, 57500, '0000-00-00'),
(2, 1, 13, 13000, '0000-00-00'),
(2, 2, 15, 22500, '0000-00-00'),
(3, 1, 13, 19500, '2017-07-30'),
(5, 1, 10, 15000, '2017-08-15'),
(5, 2, 3, 4500, '2017-08-16'),
(4, 7, 19, 24700, '2017-08-16'),
(4, 8, 3, 6000, '2017-08-14'),
(4, 3, 30, 90000, '2017-08-22'),
(6, 1, 13, 19500, '2017-08-17');

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
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbfeedback`
--

INSERT INTO `tbfeedback` (`idfeedback`, `idkue`, `idpembeli`, `ukuran`, `bahan`, `penyajian`, `rasa`, `review`, `waktu`) VALUES
(1, 1, 2, 5, 5, 5, 5, 'Ciri khas kue sangat terlihat dan benar-benar memenuhi standar!', '2017-06-28'),
(7, 1, 1, 4, 5, 4, 5, 'Enak sekali! Pandannya benar-benar terasa', '2017-07-27'),
(8, 1, 8, 4, 5, 3, 5, 'Cukup enak.', '2017-08-04'),
(9, 8, 1, 1, 1, 1, 1, 'Sangat tidak enak', '2017-08-04'),
(10, 1, 1, 5, 5, 5, 5, 'Enak Sekali', '2017-08-04');

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
(1, 1, 'Ukuran sedang dengan bentuk persegi panjang dan memiliki tebal yang sama untuk setiap lapisannya.', 'Bahan-bahan yang digunakan harus sama dengan resep yang diberikan dan dengan takaran yang sama', 'Kue disajikan dalam bungkusan plastik rapi dengan plastik menutupi seluruh permukaan kue.', 'Rasa pada kue harus manis namun tidak boleh terlalu manis.'),
(2, 5, 'Ukuran bulat dengan struktur menggulung dan memanjang', 'Dibuat dengan daun pandan asli tanpa pewarna dengan ciri khas warna hijau pucat dan harum pandan', 'Disajikan dengan plastik yang membungkus sisi kue', 'Rasa harus memiliki ciri khas pandan');

-- --------------------------------------------------------

--
-- Table structure for table `tbkeranjang`
--

CREATE TABLE `tbkeranjang` (
  `idbeli` int(11) NOT NULL,
  `idpembeli` int(11) NOT NULL,
  `tglbeli` date NOT NULL,
  `proses` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbkeranjang`
--

INSERT INTO `tbkeranjang` (`idbeli`, `idpembeli`, `tglbeli`, `proses`) VALUES
(1, 1, '2017-07-15', 2),
(2, 4, '2017-07-24', 1),
(3, 5, '2017-07-24', 2),
(4, 1, '2017-07-28', 2),
(5, 8, '2017-08-04', 2),
(6, 12, '2017-08-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbkue`
--

CREATE TABLE `tbkue` (
  `idkue` int(11) NOT NULL,
  `namakue` varchar(20) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbkue`
--

INSERT INTO `tbkue` (`idkue`, `namakue`, `gambar`) VALUES
(1, 'Kue Lapis', '552caf906ea8348f4d8b4567.jpeg'),
(2, 'Onde-Onde', 'asal-usul-onde-onde-kue-tradisional-khas-kabupaten-mojokerto-160824t.jpg'),
(4, 'Bolu Kukus', 'bolu-kukus-mekar-salah-satu-kue-tradisional-yang-kini-_161219131837-834.jpg'),
(5, 'Dadar Gulung', 'gambar kue dadar gulung ala bahanresep.jpg'),
(6, 'Serabi Beras', 'maxresdefault.jpg'),
(7, 'Kue Lumpur', 'Resep Kue Lumpur.jpg'),
(8, 'Kue Cincin', 'Resep-Kue-Cincin-Khas-Tanah-Pasundan-Bandung.jpg'),
(9, 'Pandan Ayu', 'Resep-Kue-Tradisional1.jpg'),
(10, 'Cucur Manis', 'Resep-Kue-Tradisional-Cucur-Manis-Lezat-300x181.png');

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
  `status` tinyint(4) NOT NULL,
  `setujusyarat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbmember`
--

INSERT INTO `tbmember` (`idmember`, `nmmember`, `username`, `pass`, `email`, `alamat`, `status`, `setujusyarat`) VALUES
(1, 'Karina Levina', 'karinalevina', 'a37b2a637d2541a600d707648460397e', 'karina_14@kharisma.ac.id', 'Jl. Lompobattang no. 212', 1, '2017-07-28'),
(2, 'Wendy', 'wendy', '2cff03e4b9eb85b3bf5e924ccdc1348d', 'wendy_14@kharisma.ac.id', 'Jl. Satangnga no. 10', 1, '0000-00-00'),
(3, 'Sofyan Thayf', 'sofyanthayf', 'a43ea2f3c29ef3423c48d633d1a1909d', 'sofyanthayf_14@kharisma.ac.id', 'Jl. Baji Ateka No. 20', 1, '0000-00-00'),
(4, 'Vera Tjandra', 'vera', '4341dfaa7259082022147afd371b69c3', 'vera_14@kharisma.ac.id', 'Jl. Bacan no. 13', 0, '0000-00-00'),
(5, 'Happy Christin', 'happy', '56ab24c15b72a457069c5ea42fcfc640', 'happy_14@kharisma.ac.id', 'Jl. Mappaodang no. 230', 1, '2017-08-05'),
(6, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', 2, '0000-00-00'),
(7, 'Inri Winardy', 'inri', '892c8664fdeddeaaa41d2c7d2b8ebcc2', 'inri_14@kharisma.ac.id', 'Jl. SOmba Opu no. 35', 0, '2017-07-31'),
(8, 'Laila Inayatul', 'laila', 'f30618ed64655812746272636a992b95', 'laila_14@kharisma.ac.id', 'Jl. Abu Bakar Lambogo no.78', 1, '2017-08-04'),
(9, 'Alvin Lijaya', 'alvin', '9573534ee6a886f4831ac5bcdfe85565', 'alvin_14@kharisma.ac.id', 'Jl. G. Bawakaraeng no. 18', 0, '2017-07-31'),
(10, 'Christopher Kwangdarsono', 'christopher', '0a909ffe7be1ffe2ec130aa243a64c26', 'christopher_14@kharisma.ac.id', 'Jl. Sungguminasa no. 49', 0, '2017-07-31'),
(11, 'Rezky Abadi', 'rezky', '061e7f6083e4287185043b9ac0e8dcf0', 'rezky_14@kharisma.ac.id', 'Jl. Singa no.90', 0, '2017-07-29'),
(12, 'Helen Loardi', 'helen', '7a2eb41a38a8f4e39c1586649da21e5f', 'helen_14@kharisma.ac.id', 'Jl. G. Merapi no.101', 0, '2017-07-29'),
(13, 'Abdiel Bimasakti', 'abdiel', 'c17cd5937d40e3614210dec1aec5c584', 'abdiel_14@kharisma.ac.id', 'Jl. Tallasalapang no.3', 0, '2017-07-01'),
(14, 'Husni Angriani', 'husni', '143196712ca8d8714a875522c5957a6d', 'husni@kharisma.ac.id', 'Jl. Baji Ateka no. 80', 0, '0000-00-00');

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
-- Indexes for table `tbkeranjang`
--
ALTER TABLE `tbkeranjang`
  ADD PRIMARY KEY (`idbeli`);

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
-- AUTO_INCREMENT for table `tbbuat`
--
ALTER TABLE `tbbuat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbfeedback`
--
ALTER TABLE `tbfeedback`
  MODIFY `idfeedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbkeranjang`
--
ALTER TABLE `tbkeranjang`
  MODIFY `idbeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbkue`
--
ALTER TABLE `tbkue`
  MODIFY `idkue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbmember`
--
ALTER TABLE `tbmember`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbpengrajin`
--
ALTER TABLE `tbpengrajin`
  MODIFY `idpengrajin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
