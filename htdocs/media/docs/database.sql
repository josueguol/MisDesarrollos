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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla pixgram.mids: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mids` DISABLE KEYS */;
INSERT INTO `mids` (`id`, `mid`, `pid`, `year_week`, `media_type`, `extension`, `metadata`, `date_created`, `date_update`) VALUES
	(1, 'qZHOaxjKb', 0000000001, '201720', 'image/jpeg', '.jpg', 'fnm::Josué.jpg|siz::16.49|img::1|wxh::256x256', '2017-05-19 00:28:11', '2017-05-19 00:28:12'),
	(2, 'Yzjc0RAGg', 0000000001, '201720', 'image/jpeg', '.jpg', 'fnm::Josué.jpg|siz::16.49|img::1|wxh::256x256', '2017-05-19 01:06:59', '2017-05-19 01:06:59'),
	(3, 'ZcYF3ihtH', 0000000001, '201720', 'image/jpeg', '.jpg', 'fnm::Josué.jpg|siz::16.49|img::1|wxh::256x256', '2017-05-19 01:13:46', '2017-05-19 01:13:46'),
	(4, 'WZlJsQ7LM', 0000000001, '201720', 'image/jpeg', '.jpg', 'fnm::Josué.jpg|siz::16.49|img::1|wxh::256x256', '2017-05-19 01:16:17', '2017-05-19 01:16:17'),
	(5, 'OvMXfInuN', 0000000001, '201720', 'image/jpeg', '.jpg', 'fnm::Josué.jpg|siz::16.49|img::1|wxh::256x256', '2017-05-19 01:41:42', '2017-05-19 01:41:42'),
	(6, 'vLQ8YPZwS', 0000000001, '201720', 'image/jpeg', '.jpg', 'fnm::Josué.jpg|siz::16.49|img::1|wxh::256x256', '2017-05-19 01:51:29', '2017-05-19 01:51:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla pixgram.pids: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pids` DISABLE KEYS */;
INSERT INTO `pids` (`pid`, `email`, `user`, `first_name`, `last_name`, `password`) VALUES
	(0000000001, 'sciencesapiensnews@gmail.com', 'sciencemedia', 'Science', 'Sapiens', 'sha256:1024:AIB0bVG9HMy9bdQOfkuoFAYVn67HymY3:N0JLHe5Yl4ahwl4ExhZMCZECRdCYhdn7');
/*!40000 ALTER TABLE `pids` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
