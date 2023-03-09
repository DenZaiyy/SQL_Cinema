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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.actor : ~0 rows (environ)

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

-- Listage des données de la table cinema.casting : ~0 rows (environ)

-- Listage de la structure de table cinema. director
CREATE TABLE IF NOT EXISTS `director` (
  `Id_director` int NOT NULL AUTO_INCREMENT,
  `Id_person` int NOT NULL,
  PRIMARY KEY (`Id_director`),
  UNIQUE KEY `Id_person` (`Id_person`),
  CONSTRAINT `director_ibfk_1` FOREIGN KEY (`Id_person`) REFERENCES `person` (`Id_person`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.director : ~0 rows (environ)

-- Listage de la structure de table cinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `Id_film` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `date_release` date DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `synopsis` text,
  `note` int DEFAULT NULL,
  `Id_director` int NOT NULL,
  PRIMARY KEY (`Id_film`),
  KEY `Id_director` (`Id_director`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`Id_director`) REFERENCES `director` (`Id_director`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.film : ~0 rows (environ)

-- Listage de la structure de table cinema. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `Id_genre` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.genre : ~0 rows (environ)

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

-- Listage de la structure de table cinema. person
CREATE TABLE IF NOT EXISTS `person` (
  `Id_person` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birthDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_person`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.person : ~0 rows (environ)

-- Listage de la structure de table cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `Id_role` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table cinema.role : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
