-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `forum`;

-- Listage de la structure de la table forum. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text COLLATE utf8_bin NOT NULL,
  `datecreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visiteur_id` int(11) NOT NULL,
  `sujet_id` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_visiteur` (`visiteur_id`),
  KEY `id_sujet` (`sujet_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`visiteur_id`) REFERENCES `visiteur` (`id_visiteur`),
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`sujet_id`) REFERENCES `sujet` (`id_sujet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.message : ~0 rows (environ)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

-- Listage de la structure de la table forum. sujet
CREATE TABLE IF NOT EXISTS `sujet` (
  `id_sujet` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_bin NOT NULL,
  `datecreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verrouillage` tinyint(1) NOT NULL DEFAULT '0',
  `visiteur_id` int(11) NOT NULL,
  PRIMARY KEY (`id_sujet`),
  KEY `id_visiteur` (`visiteur_id`),
  CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`visiteur_id`) REFERENCES `visiteur` (`id_visiteur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.sujet : ~3 rows (environ)
/*!40000 ALTER TABLE `sujet` DISABLE KEYS */;
INSERT INTO `sujet` (`id_sujet`, `titre`, `datecreation`, `verrouillage`, `visiteur_id`) VALUES
	(3, 'bienvenue dans le cyberespace', '2020-04-17 12:01:45', 0, 4),
	(4, 'Plus vite que la musique il faut aller', '2020-04-17 14:04:23', 0, 4),
	(5, 'Savoir écouter le silence', '2020-04-17 18:37:19', 0, 4);
/*!40000 ALTER TABLE `sujet` ENABLE KEYS */;

-- Listage de la structure de la table forum. visiteur
CREATE TABLE IF NOT EXISTS `visiteur` (
  `id_visiteur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudonyme` varchar(50) COLLATE utf8_bin NOT NULL,
  `adressemail` varchar(60) COLLATE utf8_bin NOT NULL,
  `motdepasse` varchar(255) COLLATE utf8_bin NOT NULL,
  `dateinscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` json DEFAULT NULL,
  PRIMARY KEY (`id_visiteur`),
  UNIQUE KEY `pseudonyme` (`pseudonyme`),
  UNIQUE KEY `adressemail` (`adressemail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.visiteur : ~2 rows (environ)
/*!40000 ALTER TABLE `visiteur` DISABLE KEYS */;
INSERT INTO `visiteur` (`id_visiteur`, `pseudonyme`, `adressemail`, `motdepasse`, `dateinscription`, `role`) VALUES
	(3, 'laurent', 'laurent@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$ejd6WWVNblhLdkd5c09SZA$9KT7UrKcuPCzRnvLFgJd1UxKnIEYNzP+OL2NIsUfyro', '2020-04-14 15:40:14', '["ROLE_USER", "ROLE_ADMIN"]'),
	(4, 'azerty', 'azerty@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$NVp1WmwvdjBWeDBuWUpiVA$Zz7RwqGfoH49CvGOiJ6aHbF4M6/8J14Q3cP93SvrI50', '2020-04-17 09:04:51', '["ROLE_USER"]');
/*!40000 ALTER TABLE `visiteur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
