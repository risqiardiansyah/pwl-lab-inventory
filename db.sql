-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table inventory_lab.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table inventory_lab.kategori: ~2 rows (approximately)
INSERT INTO `kategori` (`id`, `nama_kategori`, `created_at`) VALUES
	(6, 'pop', '2024-07-28 02:54:58'),
	(7, 'xxx', '2024-07-28 04:46:29'),
	(8, 'gaga', '2024-07-28 04:46:32');

-- Dumping structure for table inventory_lab.lokasi
CREATE TABLE IF NOT EXISTS `lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table inventory_lab.lokasi: ~2 rows (approximately)
INSERT INTO `lokasi` (`id`, `nama_lokasi`, `created_at`) VALUES
	(1, 'Gudang', '2024-07-28 03:01:00'),
	(3, 'Gdad', '2024-07-28 04:46:38'),
	(4, 'Qwew', '2024-07-28 04:46:42');

-- Dumping structure for table inventory_lab.inventory
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_inventaris` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `kondisi` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_inventory_kategori` (`kategori_id`),
  KEY `FK_inventory_lokasi` (`lokasi_id`),
  CONSTRAINT `FK_inventory_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_inventory_lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Dumping data for table inventory_lab.inventory: ~0 rows (approximately)
INSERT INTO `inventory` (`id`, `nomor_inventaris`, `nama`, `kategori_id`, `lokasi_id`, `kondisi`, `created_at`) VALUES
	(18, 'xxssww', 'wwssxx', 7, 3, 'Rusak', '2024-07-28 05:11:38'),
	(19, 'X-123', 'Monitor', 6, 3, 'Rusak', '2024-07-31 06:46:19');
  
-- Dumping structure for table inventory_lab.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL DEFAULT 'dipinjam',
  PRIMARY KEY (`id`),
  KEY `FK_peminjaman_inventory` (`inventory_id`),
  CONSTRAINT `FK_peminjaman_inventory` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table inventory_lab.peminjaman: ~4 rows (approximately)
INSERT INTO `peminjaman` (`id`, `inventory_id`, `nama_peminjam`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`) VALUES
	(2, 18, 'Sutarman', '2024-07-31', '2024-07-31', 'dikembalikan'),
	(4, 19, 'abcsadasdsad', '2024-08-02', NULL, 'dipinjam'),
	(5, 18, 'abcsadasdsad', '2024-08-04', '2024-07-31', 'dikembalikan');

-- Dumping structure for table inventory_lab.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table inventory_lab.pengguna: ~1 rows (approximately)
INSERT INTO `pengguna` (`id`, `username`, `password`, `created_at`) VALUES
	(1, 'risqi', '123', '2024-07-28 05:29:34');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
