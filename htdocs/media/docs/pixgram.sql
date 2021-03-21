-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.23-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para pixgram
CREATE DATABASE IF NOT EXISTS `pixgram` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pixgram`;

-- Volcando estructura para tabla pixgram.hids
CREATE TABLE IF NOT EXISTS `hids` (
  `hid` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `user` varchar(18) NOT NULL,
  `first_name` varchar(27) NOT NULL,
  `last_name` varchar(27) NOT NULL,
  `password` char(128) NOT NULL,
  PRIMARY KEY (`hid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla pixgram.hids: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `hids` DISABLE KEYS */;
INSERT INTO `hids` (`hid`, `email`, `user`, `first_name`, `last_name`, `password`) VALUES
	(0000000001, 'sciencesapiensnews@gmail.com', 'sciencefile', 'Science', 'Sapiens', 'sha256:1024:eZlDB/bUhD1o6ujOwrXgHTzrrQgNMzR9:BEG32c6L5/VGsJqVfb1e1nc//Ktt52d6');
/*!40000 ALTER TABLE `hids` ENABLE KEYS */;

-- Volcando estructura para tabla pixgram.mids
CREATE TABLE IF NOT EXISTS `mids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mid` varchar(9) NOT NULL,
  `pid` int(10) unsigned zerofill NOT NULL,
  `year_week` varchar(6) NOT NULL,
  `media_type` varchar(18) DEFAULT NULL,
  `extension` varchar(6) DEFAULT NULL,
  `metadata` varchar(256) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla pixgram.mids: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `mids` DISABLE KEYS */;
INSERT INTO `mids` (`id`, `mid`, `pid`, `year_week`, `media_type`, `extension`, `metadata`, `date_created`, `date_update`) VALUES
	(1, 'MamSczXGc', 0000000001, '201723', 'image/jpeg', '.jpg', 'fnm::Las-bacterias-Gram-positivas.jpg|siz::18.85|wxh::630x419', '2017-06-11 22:36:20', '2017-06-11 22:36:20'),
	(2, 'qMjV58Zsf', 0000000001, '201725', 'image/jpeg', '.jpg', 'fnm::sss800x422.jpg|siz::45.5|wxh::800x422', '2017-06-24 17:39:00', '2017-06-24 17:39:00'),
	(3, 'j3s4Cqkqo', 0000000001, '201726', 'image/png', '.png', 'fnm::ScienceSapiensSquare.png|siz::24.38|wxh::357x357', '2017-06-26 23:38:28', '2017-06-26 23:38:28'),
	(4, 'gv3fP8f7F', 0000000001, '201726', 'image/jpeg', '.jpg', 'fnm::encelao.jpg|siz::156.75|wxh::1022x1024', '2017-06-26 23:48:49', '2017-06-26 23:48:49'),
	(5, 'yM6Q8dmtX', 0000000001, '201726', 'image/jpeg', '.jpg', 'fnm::encelao2.jpg|siz::5.52|wxh::240x180', '2017-06-27 00:00:22', '2017-06-27 00:00:22'),
	(6, 'ij2ZN5VUq', 0000000001, '201726', 'image/jpeg', '.jpg', 'fnm::encelao2.jpg|siz::5.52|wxh::240x180', '2017-06-27 00:13:31', '2017-06-27 00:13:31'),
	(7, 'ghs8gnP52', 0000000001, '201726', 'image/jpeg', '.jpg', 'fnm::pezabisalabismalx.jpg|siz::12.32|wxh::400x274', '2017-06-27 12:05:31', '2017-06-27 12:05:31'),
	(8, 'kxbt7Bm7A', 0000000001, '201726', 'image/jpeg', '.JPG', 'fnm::foton__3.JPG|siz::33.01|wxh::1024x983', '2017-06-27 13:06:21', '2017-06-27 13:06:21'),
	(9, 'qg0GDcvny', 0000000001, '201726', 'image/jpeg', '.JPG', 'fnm::foton3.JPG|siz::33.01|wxh::1024x983', '2017-06-27 13:07:32', '2017-06-27 13:07:32'),
	(10, 'fXpeEgiSl', 0000000001, '201726', 'image/jpeg', '.jpg', 'fnm::foton3.jpg|siz::33.01|wxh::1024x983', '2017-06-27 13:08:52', '2017-06-27 13:08:52'),
	(11, 'OOLJNRtSs', 0000000001, '201727', 'image/jpeg', '.jpg', 'fnm::seraphinanus.jpg|siz::479.78|wxh::1440x973', '2017-07-05 00:12:15', '2017-07-05 00:12:16'),
	(12, 'AAGbMcZL2', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::ciudad de mexicozombie cut.jpg|siz::305.92|wxh::865x671', '2017-07-13 02:01:25', '2017-07-13 02:01:26'),
	(13, 'JxHsG9kEn', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::twitter-zombies.jpg|siz::298.98|wxh::480x587', '2017-07-13 02:05:48', '2017-07-13 02:05:49'),
	(14, 'KtVQP4gL1', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::El-copetes-Zombie.jpg|siz::36.04|wxh::456x630', '2017-07-13 02:07:54', '2017-07-13 02:07:54'),
	(15, 'u9WzLcpzc', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::cth20150222_robos3.jpg|siz::431.72|wxh::1034x903', '2017-07-13 02:38:30', '2017-07-13 02:38:30'),
	(16, 'EEE6snS7i', 0000000002, '201728', 'image/png', '.png', 'fnm::faro.png|siz::78.19|wxh::334x441', '2017-07-13 02:40:57', '2017-07-13 02:40:58'),
	(17, 'ok8p49EaU', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::faro.jpg|siz::140.59|wxh::768x1024', '2017-07-13 02:42:56', '2017-07-13 02:42:56'),
	(18, 'eHtv6cl6u', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::burrows2HR.jpg|siz::81.7|wxh::611x396', '2017-07-13 07:54:14', '2017-07-13 07:54:14'),
	(19, 'IaUeQvonC', 0000000002, '201728', 'image/png', '.png', 'fnm::robal.png|siz::125.88|wxh::500x347', '2017-07-13 07:56:41', '2017-07-13 07:56:41'),
	(20, 'kBLcc4iOO', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::issus-coleoptratus-engrane.jpg|siz::6.23|wxh::331x152', '2017-07-13 08:01:30', '2017-07-13 08:01:31'),
	(21, 'WbZbo1yLf', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::escarabajo_pelotero.jpg|siz::81.74|wxh::600x399', '2017-07-13 08:04:20', '2017-07-13 08:04:20'),
	(22, 'jYcJpIDhH', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::termita_brujula.jpg|siz::11.97|wxh::183x275', '2017-07-13 08:07:34', '2017-07-13 08:07:34'),
	(23, 'gjBZW8xKO', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::termita_brujula_nido.jpg|siz::92.61|wxh::1024x402', '2017-07-13 08:07:34', '2017-07-13 08:07:34'),
	(24, 'x5CZARjRp', 0000000002, '201728', 'image/jpeg', '.jpg', 'fnm::exposicion-de-brujas-en-coyoacan-habra-objetos-originales-y-danza-04.jpg|siz::56.63|wxh::1140x854', '2017-07-13 08:17:36', '2017-07-13 08:17:36'),
	(25, '3VqiA4tMZ', 0000000002, '201728', 'image/png', '.png', 'fnm::comic.png|siz::492.13|wxh::716x2059', '2017-07-13 08:26:27', '2017-07-13 08:26:28');
/*!40000 ALTER TABLE `mids` ENABLE KEYS */;

-- Volcando estructura para tabla pixgram.pids
CREATE TABLE IF NOT EXISTS `pids` (
  `pid` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `user` varchar(18) NOT NULL,
  `first_name` varchar(27) NOT NULL,
  `last_name` varchar(27) NOT NULL,
  `password` char(128) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla pixgram.pids: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pids` DISABLE KEYS */;
INSERT INTO `pids` (`pid`, `email`, `user`, `first_name`, `last_name`, `password`) VALUES
	(0000000001, 'sciencesapiensnews@gmail.com', 'sciencemedia', 'Science', 'Sapiens', 'sha256:1024:AIB0bVG9HMy9bdQOfkuoFAYVn67HymY3:N0JLHe5Yl4ahwl4ExhZMCZECRdCYhdn7'),
	(0000000002, 'dongutyblog@pixcan.com', 'dongutymedia', 'Don', 'Guty', 'sha256:1024:UC2wbT/c8ORZt9ox0DkKouW6fxHnDSSc:GEzKpMy84ZQ2Jc3RScHgOM75IS4QgM/Z');
/*!40000 ALTER TABLE `pids` ENABLE KEYS */;

-- Volcando estructura para tabla pixgram.sids
CREATE TABLE IF NOT EXISTS `sids` (
  `sid` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `hid` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000',
  `flowpath` varchar(254) NOT NULL,
  `storage_path` varchar(254) NOT NULL,
  PRIMARY KEY (`sid`),
  UNIQUE KEY `flowpath` (`flowpath`),
  UNIQUE KEY `storage_path` (`storage_path`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla pixgram.sids: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `sids` DISABLE KEYS */;
INSERT INTO `sids` (`sid`, `hid`, `flowpath`, `storage_path`) VALUES
	(0000000001, 0000000001, '\\sciencesapiens\\borrador', 'C:\\wamp64\\www\\sciencesapiens');
/*!40000 ALTER TABLE `sids` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
