-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 04:26 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atk`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `KODE_BRG` float NOT NULL,
  `KODE_SP` varchar(5) DEFAULT NULL,
  `NAMA_BRG` varchar(65) DEFAULT NULL,
  `Jenis_brg` varchar(20) DEFAULT NULL,
  `STOCK_MIN` float DEFAULT NULL,
  `STOCK_MAX` float DEFAULT NULL,
  `Stock_brg` float DEFAULT NULL,
  `Satuan` varchar(6) DEFAULT NULL,
  `Tanggal_beli` date DEFAULT NULL,
  `Harga` float DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`KODE_BRG`, `KODE_SP`, `NAMA_BRG`, `Jenis_brg`, `STOCK_MIN`, `STOCK_MAX`, `Stock_brg`, `Satuan`, `Tanggal_beli`, `Harga`, `status`) VALUES
(2, '2', 'Stabilo', 'Alat Tulis', 10, 100, 82, 'Pcs', '2021-11-25', 8000, 0),
(3, '2', 'Kertas polio', 'Alat tulis', 10, 150, 50, 'Rim', '2021-11-10', 1200, 0),
(4, '1', 'Spidol', 'Alat tulis', 10, 100, 19, 'Pcs', '2021-11-25', 9000, 0),
(5, '3', 'mouse', 'aksesoris', 5, 100, 15, 'Pcs', '2021-11-18', 5000, 0),
(6, '2', 'Streples x', 'alat tulis', 5, 100, 10, 'Pcs', '2021-11-19', 5000, 0),
(7, '3', 'Pulpen Faster', 'Alat Tulis', 5, 100, 12, 'Pcs', '2021-11-19', 7000, 0),
(8, '1', 'ArtLine', 'Alat tulis', 5, 100, 30, 'Pcs', '2021-11-11', 5000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `NOMOR_SLIP` varchar(10) DEFAULT NULL,
  `KODE_BRG` float DEFAULT NULL,
  `SHIFT` int(11) DEFAULT NULL,
  `POSTING` tinyint(1) DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `TANGGAL_OUT` date DEFAULT NULL,
  `KETERANGAN` longtext DEFAULT NULL,
  `NAMA_USER` varchar(15) DEFAULT NULL,
  `NO_REF` varchar(10) DEFAULT NULL,
  `QUANTITY_MINTA` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`NOMOR_SLIP`, `KODE_BRG`, `SHIFT`, `POSTING`, `KODEF`, `TANGGAL_OUT`, `KETERANGAN`, `NAMA_USER`, `NO_REF`, `QUANTITY_MINTA`) VALUES
('1-K/21', 2, 1, 1, '06', '2021-12-16', '', 'Ikram', '1', 2),
('3-K/21', 2, 2, 2, '06', '2021-12-23', 'nulis', 'Ikram', '2', 150);

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `ambil_stock` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
UPDATE barang SET Stock_brg = Stock_brg - NEW.QUANTITY_MINTA
WHERE KODE_BRG = NEW.KODE_BRG;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_brgklr` AFTER DELETE ON `barang_keluar` FOR EACH ROW BEGIN

UPDATE barang SET Stock_brg = Stock_brg + OLD.QUANTITY_MINTA
WHERE KODE_BRG = OLD.KODE_BRG;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_ambIl` AFTER UPDATE ON `barang_keluar` FOR EACH ROW BEGIN

UPDATE barang SET Stock_brg = Stock_brg + OLD.QUANTITY_MINTA - NEW.QUANTITY_MINTA
WHERE KODE_BRG = NEW.KODE_BRG;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar_tmp`
--

CREATE TABLE `barang_keluar_tmp` (
  `NOMOR_SLIP` varchar(10) NOT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `SHIFT` int(11) DEFAULT NULL,
  `POSTING` tinyint(1) DEFAULT NULL,
  `NO_REF` varchar(10) DEFAULT NULL,
  `NAMA_USER` varchar(15) DEFAULT NULL,
  `TANGGAL_OUT` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar_tmp`
--

INSERT INTO `barang_keluar_tmp` (`NOMOR_SLIP`, `KODEF`, `SHIFT`, `POSTING`, `NO_REF`, `NAMA_USER`, `TANGGAL_OUT`) VALUES
('1-K/21', '06', 1, 1, '1', 'Ikram', '2021-12-18'),
('2-K/21', '06', 1, 1, '1', 'Ikram', '2021-12-16'),
('3-K/21', '06', 2, 2, '2', 'Ikram', '2021-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `berita_acara`
--

CREATE TABLE `berita_acara` (
  `NO_BCRA` varchar(17) DEFAULT NULL,
  `PENERIMA` varchar(50) DEFAULT NULL,
  `TGL_BCRA` date DEFAULT NULL,
  `NO_PO` varchar(17) DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `KODE_SP` varchar(5) DEFAULT NULL,
  `KODE_BRG` float DEFAULT NULL,
  `HARGA_BL` float DEFAULT NULL,
  `QTY_TERIMA` float DEFAULT NULL,
  `NO_SRJLN` float DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita_acara`
--

INSERT INTO `berita_acara` (`NO_BCRA`, `PENERIMA`, `TGL_BCRA`, `NO_PO`, `KODEF`, `KODE_SP`, `KODE_BRG`, `HARGA_BL`, `QTY_TERIMA`, `NO_SRJLN`, `status`) VALUES
('GA-0/21', 'Ikram', '2021-12-16', '001/PROC-U/12/21', '06', '1', 7, 2100, 8, 111, 1),
('GA-0/21', 'Ikram', '2021-12-16', '001/PROC-U/12/21', '06', '1', 2, 3500, 7, 111, 1),
('GA-2/21', 'Ikram', '2021-12-16', '002/PROC-U/12/21', '06', '2', 4, 7500, 4, 123, 0),
('GA-2/21', 'Ikram', '2021-12-16', '002/PROC-U/12/21', '06', '2', 3, 1000, 5, 123, 0),
('GA-3/21', 'Ikram', '2021-12-22', '003/PROC-U/12/21', '06', '2', 2, 4500, 12, 146, 0),
('GA-4/21', 'Ikram', '2021-12-22', '004/PROC-U/12/21', '06', '3', 2, 5000, 5, 168, 0),
('GA-5/21', 'Ikram', '2021-12-22', '005/PROC-U/12/21', '06', '1', 2, 1000, 100, 167, 0),
('GA-7/21', 'Ikram', '2021-12-23', '006/PRC-U/12/21', '06', '1', 2, 2500, 100, 172, 0),
('GA-8/21', 'Ikram', '2021-12-23', '004/PROC-U/12/21', '06', '3', 2, 5000, 5, 122, 0);

--
-- Triggers `berita_acara`
--
DELIMITER $$
CREATE TRIGGER `tambah_stock` AFTER INSERT ON `berita_acara` FOR EACH ROW BEGIN

UPDATE barang SET Stock_brg = Stock_brg + NEW.QTY_TERIMA
WHERE KODE_BRG = NEW.KODE_BRG;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stock2` AFTER UPDATE ON `berita_acara` FOR EACH ROW BEGIN

UPDATE barang SET Stock_brg = Stock_brg - OLD.QTY_TERIMA + NEW.QTY_TERIMA
WHERE KODE_BRG = NEW.KODE_BRG;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_stck` AFTER DELETE ON `berita_acara` FOR EACH ROW BEGIN

UPDATE barang SET Stock_brg = Stock_brg - OLD.QTY_TERIMA
WHERE KODE_BRG = OLD.KODE_BRG;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_stck2` AFTER DELETE ON `berita_acara` FOR EACH ROW BEGIN

UPDATE purchased_order SET QTY_TERIMA = QTY_TERIMA - OLD.QTY_TERIMA
WHERE NO_PO = OLD.NO_PO AND KODE_BRG = OLD.KODE_BRG;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_terima` AFTER UPDATE ON `berita_acara` FOR EACH ROW BEGIN

UPDATE purchased_order SET QTY_TERIMA = QTY_TERIMA - OLD.QTY_TERIMA + NEW.QTY_TERIMA
WHERE NO_PO = NEW.NO_PO AND KODE_BRG = NEW.KODE_BRG;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `berita_acara_tmp`
--

CREATE TABLE `berita_acara_tmp` (
  `NO_BCRA` varchar(17) NOT NULL,
  `NO_PO` varchar(17) DEFAULT NULL,
  `NO_SRJLN` float DEFAULT NULL,
  `KODE_SP` varchar(5) DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `TGL_BCRA` date DEFAULT NULL,
  `PENERIMA` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita_acara_tmp`
--

INSERT INTO `berita_acara_tmp` (`NO_BCRA`, `NO_PO`, `NO_SRJLN`, `KODE_SP`, `KODEF`, `TGL_BCRA`, `PENERIMA`, `status`) VALUES
('GA-0/21', '001/PROC-U/12/21', 111, '1', '06', '2021-12-16', 'Ikram', 1),
('GA-2/21', '002/PROC-U/12/21', 123, '2', '06', '2021-12-16', 'Ikram', 0),
('GA-3/21', '003/PROC-U/12/21', 146, '2', '06', '2021-12-22', 'Ikram', 0),
('GA-4/21', '004/PROC-U/12/21', 168, '3', '06', '2021-12-22', 'Ikram', 0),
('GA-5/21', '005/PROC-U/12/21', 167, '1', '06', '2021-12-22', 'Ikram', 0),
('GA-6/21', '006/PRC-U/12/21', 122, '1', '06', '2021-12-23', 'Ikram', 1),
('GA-7/21', '006/PRC-U/12/21', 172, '1', '06', '2021-12-23', 'Ikram', 0),
('GA-8/21', '004/PROC-U/12/21', 122, '3', '06', '2021-12-23', 'Ikram', 0);

--
-- Triggers `berita_acara_tmp`
--
DELIMITER $$
CREATE TRIGGER `update_sts` AFTER INSERT ON `berita_acara_tmp` FOR EACH ROW BEGIN

UPDATE purchased_order SET status = 0
WHERE NO_PO = NEW.NO_PO AND KODE_SP = NEW.KODE_SP;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updt_ba` AFTER UPDATE ON `berita_acara_tmp` FOR EACH ROW BEGIN

UPDATE berita_acara SET NO_SRJLN = NEW.NO_SRJLN, TGL_BCRA = NEW.TGL_BCRA, PENERIMA = NEW.PENERIMA
WHERE NO_BCRA = NEW.NO_BCRA;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `sr` float NOT NULL,
  `pr` float NOT NULL,
  `po` float NOT NULL,
  `ba` float NOT NULL,
  `klr` float NOT NULL,
  `brg` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`sr`, `pr`, `po`, `ba`, `klr`, `brg`) VALUES
(10, 0, 6, 8, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchased_order`
--

CREATE TABLE `purchased_order` (
  `NO_PO` varchar(17) DEFAULT NULL,
  `PEMESAN` varchar(50) DEFAULT NULL,
  `TGL_PO` date DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `KODE_SP` varchar(5) DEFAULT NULL,
  `KODE_BRG` float DEFAULT NULL,
  `QTY_ORDER` float DEFAULT NULL,
  `HARGA_PO` float DEFAULT NULL,
  `TOT_HARGA` float DEFAULT NULL,
  `QTY_TERIMA` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_order`
--

INSERT INTO `purchased_order` (`NO_PO`, `PEMESAN`, `TGL_PO`, `KODEF`, `KODE_SP`, `KODE_BRG`, `QTY_ORDER`, `HARGA_PO`, `TOT_HARGA`, `QTY_TERIMA`, `status`) VALUES
('001/PROC-U/12/21', 'Ikram', '2021-12-16', '06', '1', 7, 8, 2100, 16800, 8, 0),
('001/PROC-U/12/21', 'Ikram', '2021-12-16', '06', '1', 2, 7, 3500, 24500, 7, 0),
('002/PROC-U/12/21', 'Ikram', '2021-12-16', '06', '2', 4, 4, 7500, 30000, 4, 0),
('002/PROC-U/12/21', 'Ikram', '2021-12-16', '06', '2', 3, 5, 1000, 5000, 5, 0),
('003/PROC-U/12/21', 'Fauzan', '2021-12-22', '10', '2', 2, 12, 4500, 54000, 12, 0),
('004/PROC-U/12/21', 'Fauzan', '2021-12-22', '10', '3', 2, 10, 5000, 50000, 10, 0),
('005/PROC-U/12/21', 'Fauzan', '2021-12-22', '10', '1', 2, 100, 1000, 100000, 100, 0),
('006/PRC-U/12/21', 'Fauzan', '2021-12-23', '10', '1', 2, 100, 2500, 250000, 100, 0);

--
-- Triggers `purchased_order`
--
DELIMITER $$
CREATE TRIGGER `hitung_jml` BEFORE INSERT ON `purchased_order` FOR EACH ROW SET 
NEW.TOT_HARGA = IF(NEW.TOT_HARGA IS NULL, NEW.QTY_ORDER * NEW.HARGA_PO, NEW.TOT_HARGA)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_jml` BEFORE UPDATE ON `purchased_order` FOR EACH ROW SET NEW.TOT_HARGA = IF(NEW.TOT_HARGA <=> OLD.TOT_HARGA, NEW.QTY_ORDER * NEW.HARGA_PO, NEW.TOT_HARGA)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `purchased_order_tmp`
--

CREATE TABLE `purchased_order_tmp` (
  `NO_PO` varchar(17) NOT NULL,
  `TGL_PO` date DEFAULT NULL,
  `PEMESAN` varchar(50) DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `KODE_SP` varchar(5) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_order_tmp`
--

INSERT INTO `purchased_order_tmp` (`NO_PO`, `TGL_PO`, `PEMESAN`, `KODEF`, `KODE_SP`, `status`) VALUES
('001/PROC-U/12/21', '2021-12-16', 'Ikram', '06', '1', 0),
('002/PROC-U/12/21', '2021-12-16', 'Ikram', '06', '2', 0),
('003/PROC-U/12/21', '2021-12-22', 'Fauzan', '10', '2', 0),
('004/PROC-U/12/21', '2021-12-22', 'Fauzan', '10', '3', 0),
('005/PROC-U/12/21', '2021-12-22', 'Fauzan', '10', '1', 0),
('006/PRC-U/12/21', '2021-12-23', 'Fauzan', '10', '1', 0);

--
-- Triggers `purchased_order_tmp`
--
DELIMITER $$
CREATE TRIGGER `upd_sp` AFTER UPDATE ON `purchased_order_tmp` FOR EACH ROW BEGIN

UPDATE surat_request_tmp SET KODE_SP = NEW.KODE_SP WHERE NO_PO = NEW.NO_PO;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_po` AFTER UPDATE ON `purchased_order_tmp` FOR EACH ROW BEGIN

UPDATE purchased_order SET KODE_SP = NEW.KODE_SP, TGL_PO = NEW.TGL_PO, PEMESAN = NEW.PEMESAN

WHERE NO_PO = NEW.NO_PO;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `purchased_requisition`
--

CREATE TABLE `purchased_requisition` (
  `NO_PR` varchar(17) NOT NULL,
  `TGL_PR` date DEFAULT NULL,
  `USER` varchar(50) DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `KODE_SP` varchar(5) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_requisition`
--

INSERT INTO `purchased_requisition` (`NO_PR`, `TGL_PR`, `USER`, `KODEF`, `KODE_SP`, `status`) VALUES
('001/STR-STR/12/21', '2021-12-16', 'Ikram', '06', NULL, 0),
('002/STR-STR/12/21', '2021-12-15', 'Ikram', '06', NULL, 0),
('003/STR-STR/12/21', '2021-12-15', 'Ikram', '06', NULL, 0),
('004/STR-STR/12/21', '2021-12-22', 'Ikram', '06', NULL, 0),
('005/STR-STR/12/21', '2021-12-22', 'Ikram', '06', NULL, 0),
('008/STR-STR/12/21', '2021-12-22', 'Ikram', '06', NULL, 1),
('009/STR-STR/12/21', '2021-12-23', 'Ikram', '06', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `KODE_SP` varchar(5) NOT NULL,
  `NAMA_SP` varchar(35) DEFAULT NULL,
  `ALAMAT_SP` varchar(500) DEFAULT NULL,
  `TELEPON` varchar(60) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `HUBUNGAN` varchar(30) DEFAULT NULL COMMENT 'contact person',
  `npwp` varchar(20) DEFAULT NULL,
  `Tanggal_input` date DEFAULT NULL,
  `Tanggal_update` date DEFAULT NULL,
  `quantity_perbulan` float DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`KODE_SP`, `NAMA_SP`, `ALAMAT_SP`, `TELEPON`, `email`, `HUBUNGAN`, `npwp`, `Tanggal_input`, `Tanggal_update`, `quantity_perbulan`, `status`) VALUES
('1', 'Steadler', '850 Matheson Boulevard West, Unit 4 Mississauga, ON L5V 0B4 Canada', '(905) 501-9008', 'Info_en.CA@staedtler.com', 'Mark', '1', '2021-12-15', '2021-12-16', 10, 0),
('2', 'Faber Castell', 'Komplek Sentra Latumeten AA/10, Jl Prof DR Latumeten No 50\r\nJelambar Baru, Grogol Petamburan, Jakarta Barat 11460, DKI Jakarta Indonesia', '+622156965316 (sales), +622156941790 (non sales)', 'info@faber-castell.co.id', 'Donny', '1', '2021-12-15', '0000-00-00', 15, 0),
('3', 'Kenko', 'Gedung Utanco Lt 4, Jalan Haji R. Rasuna Said Kav B29 RT.5/RW.2, Setia Budi, RT.5/RW.2, Kuningan, Setia Budi, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12910', '08111787899', 'support@kenko.co.id', 'Reza', '3', '2021-12-15', '0000-00-00', 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `surat_request`
--

CREATE TABLE `surat_request` (
  `NO_SR` varchar(17) DEFAULT NULL,
  `TGL_SR` date DEFAULT NULL,
  `PEMINTA` varchar(50) DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `KODE_SP` varchar(5) DEFAULT NULL,
  `KODE_BRG` float DEFAULT NULL,
  `QTY_MINTA` float DEFAULT NULL,
  `QTY_TERIMA` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_request`
--

INSERT INTO `surat_request` (`NO_SR`, `TGL_SR`, `PEMINTA`, `KODEF`, `KODE_SP`, `KODE_BRG`, `QTY_MINTA`, `QTY_TERIMA`, `status`) VALUES
('001/STR/12/21', '2021-12-15', 'Ikram', '06', NULL, 7, 8, 0, 0),
('001/STR/12/21', '2021-12-15', 'Ikram', '06', NULL, 2, 7, 0, 0),
('002/STR/12/21', '2021-12-15', 'Ikram', '06', NULL, 4, 4, 0, 0),
('002/STR/12/21', '2021-12-15', 'Ikram', '06', NULL, 3, 5, 0, 0),
('003/STR/12/21', '2021-12-15', 'Ikram', '06', NULL, 5, 3, 0, 0),
('004/STR/12/21', '2021-12-17', 'Ikram', '06', NULL, 2, 10, 0, 0),
('005/STR/12/21', '2021-12-22', 'Ikram', '06', NULL, 2, 12, 0, 0),
('008/STR/12/21', '2021-12-22', 'Ikram', '06', NULL, 2, 100, 0, 0),
('009/STR/12/21', '2021-12-22', 'Ikram', '06', NULL, 2, 100, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `surat_request_tmp`
--

CREATE TABLE `surat_request_tmp` (
  `NO_SR` varchar(17) NOT NULL,
  `NO_PR` varchar(17) DEFAULT NULL,
  `NO_PO` varchar(17) DEFAULT NULL,
  `TGL_SR` date DEFAULT NULL,
  `PEMINTA` varchar(50) DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `KODE_SP` varchar(5) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_request_tmp`
--

INSERT INTO `surat_request_tmp` (`NO_SR`, `NO_PR`, `NO_PO`, `TGL_SR`, `PEMINTA`, `KODEF`, `KODE_SP`, `status`) VALUES
('001/STR/12/21', '001/STR-STR/12/21', '001/PROC-U/12/21', '2021-12-16', 'Ikram', '06', '1', 0),
('002/STR/12/21', '002/STR-STR/12/21', '002/PROC-U/12/21', '2021-12-15', 'Ikram', '06', '2', 0),
('003/STR/12/21', '003/STR-STR/12/21', NULL, '2021-12-15', 'Ikram', '06', NULL, 0),
('004/STR/12/21', '004/STR-STR/12/21', '004/PROC-U/12/21', '2021-12-17', 'Ikram', '06', '3', 0),
('005/STR/12/21', '005/STR-STR/12/21', '003/PROC-U/12/21', '2021-12-22', 'Ikram', '06', '2', 0),
('006/STR/12/21', NULL, NULL, '2021-12-22', 'Ikram', '06', NULL, 1),
('007/STR/12/21', NULL, NULL, '2021-12-22', 'Ikram', '06', NULL, 1),
('008/STR/12/21', '008/STR-STR/12/21', '005/PROC-U/12/21', '2021-12-22', 'Ikram', '06', '1', 0),
('009/STR/12/21', '009/STR-STR/12/21', '006/PRC-U/12/21', '2021-12-22', 'Ikram', '06', '1', 0),
('010/STR/12/21', NULL, NULL, '2021-12-23', 'Ikram', '06', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `KODEF` varchar(2) NOT NULL,
  `NMDEF` varchar(20) DEFAULT NULL,
  `JML_ORG` float DEFAULT NULL,
  `NM_KAR` varchar(25) DEFAULT NULL,
  `PHONE` varchar(3) DEFAULT NULL,
  `absVersi` varchar(12) DEFAULT NULL,
  `Initial` varchar(10) NOT NULL,
  `gruph` varchar(40) NOT NULL,
  `KADEP` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`KODEF`, `NMDEF`, `JML_ORG`, `NM_KAR`, `PHONE`, `absVersi`, `Initial`, `gruph`, `KADEP`) VALUES
('01', 'PRODUKSI', 100, 'BUDI SANTOSO', 'FK', '2', 'PRD', 'LELA HP', 'SOFYANSYAH'),
('02', 'QUALITY CONTROL', 10, 'AGUS TRI HARJANTO', 'QC', '3', 'QC', 'ARIF WIDAYAT', 'SOFYANSYAH'),
('03', 'MAINTENANCE', 10, 'NURHEDI', 'MT', '2', 'MTC', 'LELA HP', 'SOFYANSYAH'),
('04', 'ENGGINEERING', 9, 'MAESTRO', 'PE', '4', 'ENG', 'ARIF WIDAYAT', 'SOFYANSYAH'),
('05', 'P P I C', 10, 'E KUSMANA', 'PP', '2', 'PPC', 'ROBYANDI', 'SOFYANSYAH'),
('06', 'STORE', 3, 'E KUSMANA', 'ST', '1', 'STR', 'ROBYANDI', 'SOFYANSYAH'),
('07', 'GENERAL SERVICES', 8, 'ARI WIBISONO', 'GA', '3', 'GS', '', 'HARTOTO'),
('08', 'HUMAN CAPITAL', 3, 'DESMIAR SUSANTI', 'HR', '1', 'HC', '', 'HARTOTO'),
('09', 'FINANCE/ ACCOUNTING', 6, 'NURUL HIDAYATI', 'FA', '1', 'FA', '', 'YANTI S'),
('10', 'PROCUREMENT', 3, 'BENNY JS', 'PR', '1', 'PRC', '', 'V B K'),
('11', 'I T', 2, 'ARIF M', 'IT', '1', 'IT', '', 'ARIF M'),
('12', 'MARKETING', 1, 'YETTY', 'MK', '1', 'MKT', '', 'HENDRO SUSILO'),
('13', 'QUALITY ASS.', 3, 'MADRIS', 'QA', '1', 'QA', 'ARIF WIDAYAT', 'SOFYANSYAH'),
('14', 'COMMERCIAL', 6, 'YUL MAULANA N', 'COM', '1', 'COM', '', '0'),
('15', 'MR', 1, 'SATRIJO TEGUH', 'MR', '1', 'MR', '', 'HENDRO SUSILO'),
('16', 'Q I', 2, 'AYDRUS', 'QI', '1', 'QI', '', 'HENDRO SUSILO'),
('18', 'MTS', 2, 'SUS', 'QI', '1', 'MTS', '', '0'),
('19', 'DPS', 2, 'NDAT', 'DPS', '1', 'DPS', '', '0'),
('20', 'Koperasi', 2, 'NDAT', 'DPS', '1', 'KUB', '', '0'),
('29', 'PRODUCTION ENG.', 3, 'M. MARAHALIM', 'PE', '1', 'PE', '', '0'),
('30', 'FACTORY', 3, 'Eddy Sukamtono', 'FA', '1', 'FAC', '', '0'),
('31', 'Megajob', 3, 'Eddy Sukamtono', 'FA', '1', 'MJob', '', '0'),
('32', 'SECURITY', 14, 'ARI W', 'SC', '1', 'SEC', 'HARTOTO', '0'),
('33', 'BTM', 500, 'BOY', 'BTM', '1', 'BTM', '', '0'),
('34', 'TAMU', 500, 'BOY', 'BA', '1', 'TAMU', '', '0'),
('35', 'KOPERASI2', 500, 'BOY', 'BA', '1', 'KUB', '', '0'),
('36', 'CUSTOMER', 500, 'BOY', 'BA', '1', 'CUST', '', '0'),
('37', 'PKL', 500, 'BOY', 'BA', '1', 'PKL', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(6) NOT NULL,
  `USERNAME` varchar(6) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `level` varchar(6) DEFAULT NULL,
  `KODEF` varchar(2) DEFAULT NULL,
  `CREATE_DATE` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_update` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `USERNAME`, `PASSWORD`, `level`, `KODEF`, `CREATE_DATE`, `tanggal_update`, `status`) VALUES
(1318096, 'aldo', '$2y$10$kQ.maY7ZcLW1QmzR44Pto.nYgcT5Ea9vVdrqphGSDbgKnpSsFGwnS', 'admin', '07', '2021-11-15', NULL, 0),
(1318098, 'febi', '$2y$10$MSqD7ziUbsos26xxXoNBSuVaWEIvSMXoE2cg9zaDrhJiKimIcTHJi', 'admin', '05', '2021-11-15', '2021-12-20', 0),
(1318099, 'Ikram', '$2y$10$G/w8vZFPgNWa11HC/4iPduNv5bgSC3ig6Ixr4OTb90lcMkrGSoMX.', 'admin', '06', '2021-11-19', NULL, 0),
(1318100, 'Marduk', '$2y$10$OYGTVQbUoCfEVkHsFrKlrO5DoDOoK/S8zQrVdqmUTbeLtwsu38RQy', 'user', '01', '2021-12-16', NULL, 0),
(1318101, 'Fauzan', '$2y$10$VEXvlteTrqgjt4AMmA9TuO5UPyDFVZoorBoEC1GRjGgPt7Ps5TJJm', 'admin', '10', '2021-12-21', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`KODE_BRG`),
  ADD KEY `No_supplier` (`KODE_SP`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD KEY `KODE_BRG` (`KODE_BRG`),
  ADD KEY `klr_tmp` (`NOMOR_SLIP`);

--
-- Indexes for table `barang_keluar_tmp`
--
ALTER TABLE `barang_keluar_tmp`
  ADD PRIMARY KEY (`NOMOR_SLIP`),
  ADD KEY `klr_dept` (`KODEF`);

--
-- Indexes for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD KEY `KODE_SP` (`KODE_BRG`),
  ADD KEY `NO_BCRA` (`NO_BCRA`);

--
-- Indexes for table `berita_acara_tmp`
--
ALTER TABLE `berita_acara_tmp`
  ADD PRIMARY KEY (`NO_BCRA`),
  ADD KEY `KODE_SP` (`KODE_SP`),
  ADD KEY `NO_PO` (`NO_PO`),
  ADD KEY `KODEF` (`KODEF`);

--
-- Indexes for table `purchased_order`
--
ALTER TABLE `purchased_order`
  ADD KEY `KODE_SP` (`KODE_BRG`),
  ADD KEY `NO_PO` (`NO_PO`);

--
-- Indexes for table `purchased_order_tmp`
--
ALTER TABLE `purchased_order_tmp`
  ADD PRIMARY KEY (`NO_PO`),
  ADD KEY `KODE_SP` (`KODE_SP`),
  ADD KEY `KODEF` (`KODEF`);

--
-- Indexes for table `purchased_requisition`
--
ALTER TABLE `purchased_requisition`
  ADD PRIMARY KEY (`NO_PR`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`KODE_SP`);

--
-- Indexes for table `surat_request`
--
ALTER TABLE `surat_request`
  ADD KEY `NO_SR` (`NO_SR`),
  ADD KEY `KODE_BRG` (`KODE_BRG`);

--
-- Indexes for table `surat_request_tmp`
--
ALTER TABLE `surat_request_tmp`
  ADD PRIMARY KEY (`NO_SR`),
  ADD KEY `KODE_SP` (`KODE_SP`),
  ADD KEY `KODEF` (`KODEF`),
  ADD KEY `NO_PR` (`NO_PR`),
  ADD KEY `NO_PO` (`NO_PO`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`KODEF`),
  ADD UNIQUE KEY `NMDEF` (`NMDEF`),
  ADD KEY `KODEF` (`KODEF`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `KODEF` (`KODEF`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `KODE_BRG` float NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1318102;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `brg_sp` FOREIGN KEY (`KODE_SP`) REFERENCES `supplier` (`KODE_SP`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `klr_brg` FOREIGN KEY (`KODE_BRG`) REFERENCES `barang` (`KODE_BRG`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `klr_tmp` FOREIGN KEY (`NOMOR_SLIP`) REFERENCES `barang_keluar_tmp` (`NOMOR_SLIP`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar_tmp`
--
ALTER TABLE `barang_keluar_tmp`
  ADD CONSTRAINT `klr_dept` FOREIGN KEY (`KODEF`) REFERENCES `tarif` (`KODEF`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD CONSTRAINT `bcra_brg` FOREIGN KEY (`KODE_BRG`) REFERENCES `barang` (`KODE_BRG`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bcra_pr` FOREIGN KEY (`NO_BCRA`) REFERENCES `berita_acara_tmp` (`NO_BCRA`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `berita_acara_tmp`
--
ALTER TABLE `berita_acara_tmp`
  ADD CONSTRAINT `bcra_tmp_po` FOREIGN KEY (`NO_PO`) REFERENCES `purchased_order_tmp` (`NO_PO`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bcra_tmp_sp` FOREIGN KEY (`KODE_SP`) REFERENCES `supplier` (`KODE_SP`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dept_ba` FOREIGN KEY (`KODEF`) REFERENCES `tarif` (`KODEF`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `purchased_order`
--
ALTER TABLE `purchased_order`
  ADD CONSTRAINT `po_brg` FOREIGN KEY (`KODE_BRG`) REFERENCES `barang` (`KODE_BRG`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `po_tmp` FOREIGN KEY (`NO_PO`) REFERENCES `purchased_order_tmp` (`NO_PO`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `purchased_order_tmp`
--
ALTER TABLE `purchased_order_tmp`
  ADD CONSTRAINT `dept_po` FOREIGN KEY (`KODEF`) REFERENCES `tarif` (`KODEF`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `po_tmp_sp` FOREIGN KEY (`KODE_SP`) REFERENCES `supplier` (`KODE_SP`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `surat_request`
--
ALTER TABLE `surat_request`
  ADD CONSTRAINT `sr_brg` FOREIGN KEY (`KODE_BRG`) REFERENCES `barang` (`KODE_BRG`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sr_tmp` FOREIGN KEY (`NO_SR`) REFERENCES `surat_request_tmp` (`NO_SR`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `surat_request_tmp`
--
ALTER TABLE `surat_request_tmp`
  ADD CONSTRAINT `dept_sr` FOREIGN KEY (`KODEF`) REFERENCES `tarif` (`KODEF`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `po_sr` FOREIGN KEY (`NO_PO`) REFERENCES `purchased_order_tmp` (`NO_PO`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pr_sr` FOREIGN KEY (`NO_PR`) REFERENCES `purchased_requisition` (`NO_PR`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sp_sr` FOREIGN KEY (`KODE_SP`) REFERENCES `supplier` (`KODE_SP`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `dept` FOREIGN KEY (`KODEF`) REFERENCES `tarif` (`KODEF`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
