-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
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


-- Listage de la structure de la base pour cinema
CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema`;

-- Listage de la structure de table cinema. actor
CREATE TABLE IF NOT EXISTS `actor` (
  `Id_actor` int NOT NULL AUTO_INCREMENT,
  `Id_person` int NOT NULL,
  PRIMARY KEY (`Id_actor`),
  UNIQUE KEY `Id_person` (`Id_person`),
  CONSTRAINT `actor_ibfk_1` FOREIGN KEY (`Id_person`) REFERENCES `person` (`Id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.actor : ~11 rows (environ)
INSERT INTO `actor` (`Id_actor`, `Id_person`) VALUES
	(1, 6),
	(2, 7),
	(3, 8),
	(4, 9),
	(5, 10),
	(6, 11),
	(7, 12),
	(8, 13),
	(9, 14),
	(10, 15),
	(11, 16);

-- Listage de la structure de table cinema. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `Id_film` int NOT NULL,
  `Id_actor` int NOT NULL,
  `Id_role` int NOT NULL,
  PRIMARY KEY (`Id_film`,`Id_actor`,`Id_role`),
  KEY `Id_actor` (`Id_actor`),
  KEY `Id_role` (`Id_role`),
  CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`Id_film`) REFERENCES `film` (`Id_film`),
  CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`Id_actor`) REFERENCES `actor` (`Id_actor`),
  CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`Id_role`) REFERENCES `role` (`Id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.casting : ~14 rows (environ)
INSERT INTO `casting` (`Id_film`, `Id_actor`, `Id_role`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(2, 3, 3),
	(2, 4, 4),
	(4, 5, 5),
	(4, 6, 6),
	(3, 7, 7),
	(3, 8, 8),
	(3, 9, 9),
	(5, 9, 9),
	(6, 9, 9),
	(7, 9, 9),
	(7, 10, 9),
	(5, 11, 10);

-- Listage de la structure de table cinema. director
CREATE TABLE IF NOT EXISTS `director` (
  `Id_director` int NOT NULL AUTO_INCREMENT,
  `Id_person` int NOT NULL,
  PRIMARY KEY (`Id_director`),
  UNIQUE KEY `Id_person` (`Id_person`),
  CONSTRAINT `director_ibfk_1` FOREIGN KEY (`Id_person`) REFERENCES `person` (`Id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.director : ~6 rows (environ)
INSERT INTO `director` (`Id_director`, `Id_person`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6);

-- Listage de la structure de table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `Id_film` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_release` date NOT NULL,
  `duration` int NOT NULL,
  `synopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `note` int DEFAULT NULL,
  `Id_director` int NOT NULL,
  PRIMARY KEY (`Id_film`),
  KEY `Id_director` (`Id_director`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`Id_director`) REFERENCES `director` (`Id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.film : ~7 rows (environ)
INSERT INTO `film` (`Id_film`, `title`, `date_release`, `duration`, `synopsis`, `note`, `Id_director`) VALUES
	(1, 'Un tueur pour cible', '1998-05-27', 87, NULL, NULL, 3),
	(2, 'Le Roi Arthur', '2004-08-04', 126, NULL, NULL, 3),
	(3, 'La Ligne verte', '2000-03-01', 189, NULL, NULL, 2),
	(4, 'Les Misérables', '2019-11-20', 105, NULL, NULL, 1),
	(5, 'Batman', '1989-09-13', 125, NULL, NULL, 4),
	(6, 'Batman, le défi', '1992-07-15', 126, NULL, NULL, 4),
	(7, 'Batman begins', '2005-06-15', 140, NULL, NULL, 5);

-- Listage de la structure de table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `Id_genre` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.genre : ~0 rows (environ)
INSERT INTO `genre` (`Id_genre`, `label`) VALUES
	(1, 'Drame'),
	(2, 'Fantastique'),
	(3, 'Policier'),
	(4, 'Action'),
	(5, 'Aventure'),
	(6, 'Historique'),
	(7, 'Super-héros');

-- Listage de la structure de table cinema. movie_genre
CREATE TABLE IF NOT EXISTS `movie_genre` (
  `Id_film` int NOT NULL,
  `Id_genre` int NOT NULL,
  PRIMARY KEY (`Id_film`,`Id_genre`),
  KEY `Id_genre` (`Id_genre`),
  CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`Id_film`) REFERENCES `film` (`Id_film`),
  CONSTRAINT `movie_genre_ibfk_2` FOREIGN KEY (`Id_genre`) REFERENCES `genre` (`Id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.movie_genre : ~0 rows (environ)
INSERT INTO `movie_genre` (`Id_film`, `Id_genre`) VALUES
	(4, 1),
	(3, 2),
	(1, 4),
	(2, 4),
	(5, 7),
	(6, 7),
	(7, 7);

-- Listage de la structure de table cinema. person
CREATE TABLE IF NOT EXISTS `person` (
  `Id_person` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthDate` date NOT NULL,
  PRIMARY KEY (`Id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.person : ~16 rows (environ)
INSERT INTO `person` (`Id_person`, `firstname`, `lastname`, `gender`, `birthDate`) VALUES
	(1, 'Ly', 'Ladjy', 'H', '1978-01-03'),
	(2, 'Frank', 'Darabont', 'H', '1959-01-28'),
	(3, 'Antoine', 'Fuqua', 'H', '1966-01-19'),
	(4, 'Tim', 'Burton', 'H', '1958-08-25'),
	(5, 'Christopher', 'Nolan', 'H', '1970-07-30'),
	(6, 'Chow', 'Yun-Fat', 'H', '1955-05-18'),
	(7, 'Michael', 'Rooker', 'H', '1955-04-06'),
	(8, 'Clive', 'Owen', 'H', '1964-10-03'),
	(9, 'Ioan', 'Gruffudd', 'H', '1973-10-06'),
	(10, 'Sofia', 'Lesaffre', 'F', '1997-04-01'),
	(11, 'Jeanne', 'Balibar', 'F', '1968-04-13'),
	(12, 'Michael Clarke', 'Duncan', 'H', '1957-12-10'),
	(13, 'Tom', 'Hanks', 'H', '1956-07-09'),
	(14, 'Michael', 'Keaton', 'H', '1951-09-05'),
	(15, 'Christian', 'Bale', 'H', '1974-01-30'),
	(16, 'Michelle', 'Pfeiffer', 'F', '1958-04-29');

-- Listage de la structure de table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `Id_role` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.role : ~10 rows (environ)
INSERT INTO `role` (`Id_role`, `label`) VALUES
	(1, 'John Lee'),
	(2, 'Stan Zedkov'),
	(3, 'le Roi Arthur'),
	(4, 'Lancelot'),
	(5, 'La jeune fille à l\'arrêt de bus'),
	(6, 'La comissaire'),
	(7, 'John Coffey'),
	(8, 'Paul Edgecomb'),
	(9, 'Batman'),
	(10, 'Catwoman');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
