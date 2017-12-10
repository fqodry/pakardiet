-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for pakardietdb
CREATE DATABASE IF NOT EXISTS `pakardietdb` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;
USE `pakardietdb`;

-- Dumping structure for table pakardietdb.m_aktifitas
CREATE TABLE IF NOT EXISTS `m_aktifitas` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `act_id` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `act_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'system',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `act_id` (`act_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pakardietdb.m_aktifitas: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_aktifitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_aktifitas` ENABLE KEYS */;

-- Dumping structure for table pakardietdb.m_bahan_golongan
CREATE TABLE IF NOT EXISTS `m_bahan_golongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gol_id` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `gol_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `gol_description` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'system',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `gol_id` (`gol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pakardietdb.m_bahan_golongan: ~7 rows (approximately)
/*!40000 ALTER TABLE `m_bahan_golongan` DISABLE KEYS */;
INSERT INTO `m_bahan_golongan` (`id`, `gol_id`, `gol_name`, `gol_description`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_enabled`) VALUES
	(1, 'GOL01', 'Golongan I - Karbohidrat', 'Bahan makanan ini umumnya digunakan sebagai makanan pokok', 'system', '2017-11-25 05:58:52', NULL, NULL, 1),
	(2, 'GOL02', 'Golongan II - Protein Hewani', 'Umumnya digunakan sebagai lauk', 'system', '2017-11-25 06:01:41', NULL, NULL, 1),
	(3, 'GOL03', 'Golongan III - Protein Nabati', 'Umumnya digunakan sebagai lauk', 'system', '2017-11-25 06:02:47', NULL, NULL, 1),
	(4, 'GOL04', 'Golongan IV - Sayuran', 'Merupakan sumber vitamin dan mineral, terutama karoten, vitamin C, zat kapur, zat besi, dan fosfor. ', 'system', '2017-11-25 06:03:06', NULL, NULL, 1),
	(5, 'GOL05', 'Golongan V - Buah-buahan dan Gula', 'Merupakan sumber vitamin terutama karoten, Vit B1, B6, dan Vit C. Juga merupakan sumber mineral', 'system', '2017-11-25 06:07:08', NULL, NULL, 1),
	(6, 'GOL06', 'Golongan VI - Susu', 'Merupakan sumber protein , lemak, karbohidrat, dan vitamin (terutama vitamin A dan Niacin), serta mi', 'system', '2017-11-25 06:08:18', NULL, NULL, 1),
	(7, 'GOL07', 'Golongan VII - Minyak/Lemak', 'Bahan makanan ini hampir seluruhnya terdiri dari lemak. Menurut kandungan asam lemaknya, minyak diba', 'system', '2017-11-25 06:09:54', NULL, NULL, 1),
	(8, 'GOL08', 'Golongan VIII - Makanan Tanpa Kalori', 'Mengandung kurang dari 5gr karbohidrat, dan kurang dari 20 kalori tiap penukarnya. Bahan makanan yan', 'system', '2017-11-25 06:12:31', NULL, NULL, 1);
/*!40000 ALTER TABLE `m_bahan_golongan` ENABLE KEYS */;

-- Dumping structure for table pakardietdb.m_bahan_kategori
CREATE TABLE IF NOT EXISTS `m_bahan_kategori` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `kategori_id` varchar(3) COLLATE latin1_general_ci NOT NULL,
  `kategori_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'system',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pakardietdb.m_bahan_kategori: ~2 rows (approximately)
/*!40000 ALTER TABLE `m_bahan_kategori` DISABLE KEYS */;
INSERT INTO `m_bahan_kategori` (`id`, `kategori_id`, `kategori_name`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_enabled`) VALUES
	(1, 'K01', 'Bahan Mentah', 'system', '2017-11-25 06:24:40', NULL, NULL, 1),
	(2, 'K02', 'Bahan Olahan (Makanan Siap Santap)', 'system', '2017-11-25 06:25:20', NULL, NULL, 1);
/*!40000 ALTER TABLE `m_bahan_kategori` ENABLE KEYS */;

-- Dumping structure for table pakardietdb.m_user_role
CREATE TABLE IF NOT EXISTS `m_user_role` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `role_code` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `role_name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'system',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(20) COLLATE latin1_general_ci DEFAULT 'none',
  `modified_date` datetime DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `role_code` (`role_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table pakardietdb.m_user_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `m_user_role` DISABLE KEYS */;
INSERT INTO `m_user_role` (`id`, `role_code`, `role_name`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_enabled`) VALUES
	(1, 'ROLE_ADMIN', 'Administrator', 'system', '2017-11-18 14:26:13', 'none', NULL, 1),
	(2, 'ROLE_USER', 'User', 'system', '2017-11-25 15:02:20', 'none', NULL, 1);
/*!40000 ALTER TABLE `m_user_role` ENABLE KEYS */;

-- Dumping structure for table pakardietdb.tb_bahan
CREATE TABLE IF NOT EXISTS `tb_bahan` (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `bahan_code` varchar(7) COLLATE latin1_general_ci NOT NULL,
  `bahan_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `urt` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `weight` double NOT NULL,
  `calories` double NOT NULL,
  `notes` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `bahan_golongan` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `bahan_kategori` varchar(3) COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'system',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `bahan_code` (`bahan_code`),
  KEY `bahan_golongan` (`bahan_golongan`),
  KEY `bahan_kategori` (`bahan_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pakardietdb.tb_bahan: ~33 rows (approximately)
/*!40000 ALTER TABLE `tb_bahan` DISABLE KEYS */;
INSERT INTO `tb_bahan` (`id`, `bahan_code`, `bahan_name`, `urt`, `weight`, `calories`, `notes`, `bahan_golongan`, `bahan_kategori`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_enabled`) VALUES
	(1, 'BAH0001', 'Bengkoang', '1/2 bj besar', 80, 43.75, 'S++', 'GOL01', 'K01', 'system', '2017-12-04 08:00:00', 'none', '0000-00-00 00:00:00', 1),
	(2, 'BAH0002', 'Bihun', '1/2 gelas', 50, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 08:00:00', 'none', '0000-00-00 00:00:00', 1),
	(3, 'BAH0003', 'Biskuit', '1 bh besar', 10, 43.75, 'Na++', 'GOL01', 'K01', 'system', '2017-12-04 08:00:00', 'none', '0000-00-00 00:00:00', 1),
	(4, 'BAH0004', 'Gadung', '1 ptg', 175, 175, 'S++', 'GOL01', 'K01', 'system', '2017-12-04 08:00:00', 'none', '0000-00-00 00:00:00', 1),
	(5, 'BAH0005', 'Ganyong', '1 ptg', 185, 175, 'S++', 'GOL01', 'K01', 'system', '2017-12-04 08:00:00', 'none', '0000-00-00 00:00:00', 1),
	(6, 'BAH0006', 'Gembili', '1 ptg', 185, 175, 'S++', 'GOL01', 'K01', 'system', '2017-12-04 08:00:00', 'none', '0000-00-00 00:00:00', 1),
	(7, 'BAH0007', 'Havermuut', '5 1/2 sdm', 45, 175, 'S+', 'GOL01', 'K01', 'system', '2017-12-04 08:00:00', 'none', '0000-00-00 00:00:00', 1),
	(8, 'BAH0008', 'Jagung Segar', '1 bj sedang', 41.67, 58.33, 'S++', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(9, 'BAH0009', 'Kentang', '1 bh', 105, 87.5, 'K+', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(10, 'BAH0010', 'Kentang Hitam', '6 bj', 62.5, 87.5, 'P-', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(11, 'BAH0012', 'Makaroni', '1/2 gelas', 50, 175, 'P-', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(12, 'BAH0013', 'Mi Basah', '1 gelas', 100, 87.5, 'Na+, P-', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(13, 'BAH0014', 'Mi Kering', '1 gelas', 50, 175, 'Na+', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(14, 'BAH0015', 'Nasi Beras Giling', '3/4 gelas', 100, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(15, 'BAH0016', 'Nasi Beras 1/2 Giling', '3/4 gelas', 100, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(16, 'BAH0017', 'Nasi Ketan Hitam', '3/4 gelas', 100, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(17, 'BAH0018', 'Nasi Ketan Putih', '3/4 gelas', 100, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(18, 'BAH0019', 'Roti Putih', '2 iris', 46.67, 116.67, 'Na++', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(19, 'BAH0020', 'Roti Warna Coklat', '2 iris', 46.67, 116.67, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(20, 'BAH0021', 'Singkong', '1 1/2 gelas', 120, 175, 'K+, P-, S+', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(21, 'BAH0022', 'Sukun', '1 ptg sedang', 50, 58.33, 'S++', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(22, 'BAH0023', 'Talas', '1/2 bj sedang', 125, 175, 'S+', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(23, 'BAH0024', 'Tape Beras Ketan', '5 sdm', 100, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(24, 'BAH0025', 'Tape Singkong', '1 ptg sedang', 100, 175, 'S++, P-', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(25, 'BAH0026', 'Tepung Tapioka', '8 sdm', 50, 175, 'K+, P-', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(26, 'BAH0027', 'Tepung Beras', '8 sdm', 50, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(27, 'BAH0028', 'Tepung Hunkwee', '10 sdm', 50, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(28, 'BAH0029', 'Tepung Sagu', '8 sdm', 50, 175, 'P-', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(29, 'BAH0030', 'Tepung Singkong', '5 sdm', 50, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(30, 'BAH0031', 'Tepung Terigu', '5 sdm', 50, 175, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(31, 'BAH0032', 'Ubi Jalar Kuning', '1 bj sedang', 135, 175, 'S++, P-', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(32, 'BAH0033', 'Kerupuk Udang/Ikan', '1 bj sedang', 10, 58.33, '', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1),
	(33, 'BAH0011', 'Maizena', '5 sdm', 25, 87.5, 'P-', 'GOL01', 'K01', 'system', '2017-12-04 06:25:17', NULL, NULL, 1);
/*!40000 ALTER TABLE `tb_bahan` ENABLE KEYS */;

-- Dumping structure for table pakardietdb.tb_hist_formpakar
CREATE TABLE IF NOT EXISTS `tb_hist_formpakar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `berat_badan` double NOT NULL,
  `tinggi_badan` double NOT NULL,
  `usia` tinyint(4) NOT NULL,
  `jenis_kelamin` varchar(1) COLLATE latin1_general_ci NOT NULL,
  `aktifitas` varchar(5) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pakardietdb.tb_hist_formpakar: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_hist_formpakar` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_hist_formpakar` ENABLE KEYS */;

-- Dumping structure for table pakardietdb.tb_ref_user_role
CREATE TABLE IF NOT EXISTS `tb_ref_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `role_code` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'system',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(20) COLLATE latin1_general_ci DEFAULT 'none',
  `modified_date` datetime DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_code` (`role_code`),
  CONSTRAINT `fk_rolecode` FOREIGN KEY (`role_code`) REFERENCES `m_user_role` (`role_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_userid` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pakardietdb.tb_ref_user_role: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_ref_user_role` DISABLE KEYS */;
INSERT INTO `tb_ref_user_role` (`id`, `user_id`, `role_code`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_enabled`) VALUES
	(1, 'DU0001', 'ROLE_ADMIN', 'system', '2017-11-25 15:08:42', 'none', NULL, 1),
	(2, 'DU0002', 'ROLE_USER', 'system', '2017-11-25 15:10:03', 'none', NULL, 1),
	(3, 'DU0003', 'ROLE_USER', 'system', '2017-12-04 06:53:24', 'none', NULL, 1);
/*!40000 ALTER TABLE `tb_ref_user_role` ENABLE KEYS */;

-- Dumping structure for table pakardietdb.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `first_name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `created_by` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'system',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(20) COLLATE latin1_general_ci DEFAULT 'none',
  `modified_date` datetime DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT;

-- Dumping data for table pakardietdb.tb_user: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id`, `user_id`, `username`, `password`, `first_name`, `last_name`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_enabled`) VALUES
	(1, 'DU0001', 'admin', '$2b$10$JA7iVvx4cFVaETtnSqcCIulEtVOtg1QbAYd3LIK6Q/Jjyvi9dbwHK', 'Admin', 'Pakar Diet', 'system', '2017-11-18 15:01:33', 'none', NULL, 1),
	(2, 'DU0002', 'firmanqodry', '$2a$08$yc97NOrGTplE9oCpRPLZZulPeV/l91ZcvoEKphs6kh/SYeoo48gzi', 'Firman', 'Qodry', 'system', '2017-11-25 15:10:03', 'none', NULL, 1),
	(3, 'DU0003', 'nisahaps', '$2a$08$TbRhOJBEISqLRd.CTK8aYewrJ5I1VUm2jCmx.t6cljxrhJotEa0za', 'Annisa', 'Hapsari', 'system', '2017-12-04 06:53:24', 'none', NULL, 1);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
