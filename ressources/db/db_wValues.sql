/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema`;

CREATE TABLE IF NOT EXISTS `actor` (
  `id_actor` int NOT NULL AUTO_INCREMENT,
  `id_person` int NOT NULL,
  PRIMARY KEY (`id_actor`) USING BTREE,
  UNIQUE KEY `Id_person` (`id_person`) USING BTREE,
  CONSTRAINT `actor_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO `actor` (`id_actor`, `id_person`) VALUES
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

CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int NOT NULL,
  `id_actor` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_actor`,`id_role`) USING BTREE,
  KEY `Id_actor` (`id_actor`) USING BTREE,
  KEY `Id_role` (`id_role`) USING BTREE,
  CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`id_actor`) REFERENCES `actor` (`id_actor`),
  CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO `casting` (`id_film`, `id_actor`, `id_role`) VALUES
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

CREATE TABLE IF NOT EXISTS `director` (
  `id_director` int NOT NULL AUTO_INCREMENT,
  `id_person` int NOT NULL,
  PRIMARY KEY (`id_director`) USING BTREE,
  UNIQUE KEY `Id_person` (`id_person`) USING BTREE,
  CONSTRAINT `director_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO `director` (`id_director`, `id_person`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6);

CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `date_release` date NOT NULL,
  `duration` int NOT NULL,
  `synopsis` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `note` int DEFAULT NULL,
  `picture` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `id_director` int NOT NULL,
  PRIMARY KEY (`id_film`) USING BTREE,
  KEY `Id_director` (`id_director`) USING BTREE,
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO `film` (`id_film`, `title`, `date_release`, `duration`, `synopsis`, `note`, `picture`, `id_director`) VALUES
	(1, 'Un tueur pour cible', '1998-05-27', 87, NULL, NULL, 'public/img/films/un-tueur-pour-cible.jpeg', 3),
	(2, 'Le Roi Arthur', '2004-08-04', 126, NULL, NULL, 'public/img/films/le-roi-arthur.jpg', 3),
	(3, 'La Ligne verte', '2000-03-01', 189, NULL, NULL, 'public/img/films/la-ligne-verte.jpg', 2),
	(4, 'Les Misérables', '2019-11-20', 105, NULL, NULL, 'public/img/films/les-miserables.jpg', 1),
	(5, 'Batman', '1989-09-13', 125, NULL, NULL, 'public/img/films/batman.jpg', 4),
	(6, 'Batman, le défi', '1992-07-15', 126, NULL, NULL, 'public/img/films/batman-le-defis.jpg', 4),
	(7, 'Batman begins', '2005-06-15', 140, NULL, NULL, 'public/img/films/batman-begins.jpg', 5);

CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_genre`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO `genre` (`id_genre`, `label`) VALUES
	(1, 'Drame'),
	(2, 'Fantastique'),
	(3, 'Policier'),
	(4, 'Action'),
	(5, 'Aventure'),
	(6, 'Historique'),
	(7, 'Super-héros');

CREATE TABLE IF NOT EXISTS `movie_genre` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`) USING BTREE,
  KEY `Id_genre` (`id_genre`) USING BTREE,
  CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `movie_genre_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO `movie_genre` (`id_film`, `id_genre`) VALUES
	(4, 1),
	(3, 2),
	(1, 4),
	(2, 4),
	(5, 7),
	(6, 7),
	(7, 7);

CREATE TABLE IF NOT EXISTS `person` (
  `id_person` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `birthDate` date NOT NULL,
  `picture` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  PRIMARY KEY (`id_person`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO `person` (`id_person`, `firstname`, `lastname`, `gender`, `birthDate`, `picture`) VALUES
	(1, 'Ly', 'Ladjy', 'H', '1978-01-03', 'public/img/directors/Ladj_Ly.jpg'),
	(2, 'Frank', 'Darabont', 'H', '1959-01-28', 'public/img/directors/Frank_Darabont.jpg'),
	(3, 'Antoine', 'Fuqua', 'H', '1966-01-19', 'public/img/directors/Antoine_Fuqua.jpeg'),
	(4, 'Tim', 'Burton', 'H', '1958-08-25', 'public/img/directors/Tim_Burton.jpg'),
	(5, 'Christopher', 'Nolan', 'H', '1970-07-30', 'public/img/directors/Christopher_Nolan.jpeg'),
	(6, 'Chow', 'Yun-Fat', 'H', '1955-05-18', 'public/img/directors/Chow_Yun-fat.jpeg'),
	(7, 'Michael', 'Rooker', 'H', '1955-04-06', 'public/img/actors/Michael_Rooker.jpeg'),
	(8, 'Clive', 'Owen', 'H', '1964-10-03', 'public/img/actors/Clive_Owen.jpeg'),
	(9, 'Ioan', 'Gruffudd', 'H', '1973-10-06', 'public/img/actors/Ioan_Gruffudd.jpeg'),
	(10, 'Sofia', 'Lesaffre', 'F', '1997-04-01', 'public/img/actors/Sofia_Lesaffre.jpeg'),
	(11, 'Jeanne', 'Balibar', 'F', '1968-04-13', 'public/img/actors/Jeanne_Balibar.jpeg'),
	(12, 'Michael Clarke', 'Duncan', 'H', '1957-12-10', 'public/img/actors/Michael-Clarke_Duncan.jpeg'),
	(13, 'Tom', 'Hanks', 'H', '1956-07-09', 'public/img/actors/Tom_Hanks.jpeg'),
	(14, 'Michael', 'Keaton', 'H', '1951-09-05', 'public/img/actors/michael_keaton.jpeg'),
	(15, 'Christian', 'Bale', 'H', '1974-01-30', 'public/img/actors/christian_bale.jpeg'),
	(16, 'Michelle', 'Pfeiffer', 'F', '1958-04-29', 'public/img/actors/michelle-pfeiffer.jpg');

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_role`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

INSERT INTO `role` (`id_role`, `label`) VALUES
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
