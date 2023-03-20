-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : lun. 20 mars 2023 à 14:39
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `actor`
--

CREATE TABLE `actor` (
  `id_actor` int NOT NULL,
  `id_person` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `actor`
--

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
(11, 16),
(18, 30),
(19, 31);

-- --------------------------------------------------------

--
-- Structure de la table `casting`
--

CREATE TABLE `casting` (
  `id_film` int NOT NULL,
  `id_actor` int NOT NULL,
  `id_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `casting`
--

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
(5, 11, 10),
(51, 18, 12),
(51, 19, 13);

-- --------------------------------------------------------

--
-- Structure de la table `director`
--

CREATE TABLE `director` (
  `id_director` int NOT NULL,
  `id_person` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `director`
--

INSERT INTO `director` (`id_director`, `id_person`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(13, 28);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id_film` int NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `date_release` date DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `synopsis` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `note` float DEFAULT NULL,
  `picture` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `id_director` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id_film`, `title`, `date_release`, `duration`, `synopsis`, `note`, `picture`, `id_director`) VALUES
(1, 'Un tueur pour cible', '1998-05-27', 87, NULL, 2.5, 'public/img/films/un-tueur-pour-cible.jpeg', 3),
(2, 'Le Roi Arthur', '2004-08-04', 126, NULL, 2.7, 'public/img/films/le-roi-arthur.jpg', 3),
(3, 'La Ligne verte', '2000-03-01', 189, NULL, 4.6, 'public/img/films/la-ligne-verte.jpg', 2),
(4, 'Les Misérables', '2019-11-20', 105, NULL, 4, 'public/img/films/les-miserables.jpg', 1),
(5, 'Batman', '1989-09-13', 125, NULL, 3.9, 'public/img/films/batman.jpg', 4),
(6, 'Batman, le défi', '1992-07-15', 126, NULL, 3.8, 'public/img/films/batman-le-defis.jpg', 4),
(7, 'Batman begins', '2005-06-15', 140, NULL, 4.1, 'public/img/films/batman-begins.jpg', 5),
(51, 'West Side Story', '2021-12-08', 157, 'WEST SIDE STORY raconte l&rsquo;histoire l&eacute;gendaire d&rsquo;un amour naissant sur fond de rixes entre bandes rivales dans le New York de 1957.', 4, 'public/img/uploads/64181d33c7362-81JAW-KrBiL._AC_SL1500_.jpg', 13);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int NOT NULL,
  `label` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `label`) VALUES
(1, 'Drame'),
(2, 'Fantastique'),
(3, 'Policier'),
(4, 'Action'),
(5, 'Aventure'),
(6, 'Historique'),
(7, 'Super-héros'),
(10, 'Romance'),
(11, 'Com&eacute;die Musicale');

-- --------------------------------------------------------

--
-- Structure de la table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `movie_genre`
--

INSERT INTO `movie_genre` (`id_film`, `id_genre`) VALUES
(4, 1),
(3, 2),
(1, 4),
(2, 4),
(5, 7),
(6, 7),
(7, 7),
(51, 10);

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `id_person` int NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `birthDate` date NOT NULL,
  `picture` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `person`
--

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
(16, 'Michelle', 'Pfeiffer', 'F', '1958-04-29', 'public/img/actors/michelle-pfeiffer.jpg'),
(28, 'Steven', 'Spielberg', 'H', '1998-12-26', 'public/img/uploads/641810cc4708b-453609.jpg'),
(30, 'Rachel', 'Zegler', 'F', '2001-05-03', 'public/img/uploads/64181f12b0a52-i1aZ3oM103nADT9vv1wCdFzaYpe.jpg'),
(31, 'Ansel', 'Elgort', 'H', '1994-03-14', 'public/img/uploads/64182059b49bb-da5ce6cfd9543bce03dbdcc52f9d75e3.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int NOT NULL,
  `label` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Déchargement des données de la table `role`
--

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
(10, 'Catwoman'),
(12, 'Maria'),
(13, 'Tony');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id_actor`) USING BTREE,
  ADD UNIQUE KEY `Id_person` (`id_person`) USING BTREE;

--
-- Index pour la table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`id_film`,`id_actor`,`id_role`) USING BTREE,
  ADD KEY `Id_actor` (`id_actor`) USING BTREE,
  ADD KEY `Id_role` (`id_role`) USING BTREE;

--
-- Index pour la table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id_director`) USING BTREE,
  ADD UNIQUE KEY `Id_person` (`id_person`) USING BTREE;

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`) USING BTREE,
  ADD KEY `Id_director` (`id_director`) USING BTREE;

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`) USING BTREE;

--
-- Index pour la table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`id_film`,`id_genre`) USING BTREE,
  ADD KEY `Id_genre` (`id_genre`) USING BTREE;

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id_person`) USING BTREE;

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actor`
--
ALTER TABLE `actor`
  MODIFY `id_actor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `director`
--
ALTER TABLE `director`
  MODIFY `id_director` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id_person` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actor`
--
ALTER TABLE `actor`
  ADD CONSTRAINT `actor_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`);

--
-- Contraintes pour la table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`id_actor`) REFERENCES `actor` (`id_actor`),
  ADD CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Contraintes pour la table `director`
--
ALTER TABLE `director`
  ADD CONSTRAINT `director_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`);

--
-- Contraintes pour la table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_director`) REFERENCES `director` (`id_director`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `movie_genre_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
