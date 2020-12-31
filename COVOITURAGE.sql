-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 31 Décembre 2020 à 14:46
-- Version du serveur :  5.7.32-0ubuntu0.16.04.1
-- Version de PHP :  7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `COVOITURAGE`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `per_num` int(11) NOT NULL,
  `per_per_num` int(11) NOT NULL,
  `par_num` int(11) NOT NULL,
  `avi_comm` varchar(300) COLLATE utf8_bin NOT NULL,
  `avi_note` int(11) NOT NULL,
  `avi_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`per_num`, `per_per_num`, `par_num`, `avi_comm`, `avi_note`, `avi_date`) VALUES
(1, 3, 1, 'Voyage agréable ', 5, '2020-09-29 09:54:52'),
(3, 38, 5, 'Ce conducteur n\'est pas ponctuel ', 1, '2020-10-01 09:54:52'),
(38, 53, 10, 'A recommander', 5, '2020-11-05 09:54:52'),
(39, 1, 4, 'Voyage agréable', 4, '2020-11-06 09:54:52'),
(39, 52, 7, 'On se demande comment il a fait pour avoir son permis. A éviter', 2, '2020-11-06 09:54:52'),
(52, 1, 11, 'Je recommande', 4, '2020-11-19 09:54:52'),
(52, 38, 10, 'Le conducteur ne respecte pas les limitations de vitesse, nous avons été pris en chasse par les CRS', 1, '2020-11-19 09:54:52'),
(53, 3, 4, 'Quel voyage. Personne ponctuelle et agréable', 5, '2020-11-20 09:54:52');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `dep_num` int(11) NOT NULL,
  `dep_nom` varchar(30) NOT NULL,
  `vil_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`dep_num`, `dep_nom`, `vil_num`) VALUES
(1, 'Informatique', 7),
(2, 'GEA', 6),
(3, 'GEA', 7),
(4, 'SRC', 7),
(5, 'HSE', 5),
(6, 'Génie civil', 16);

-- --------------------------------------------------------

--
-- Structure de la table `division`
--

CREATE TABLE `division` (
  `div_num` int(11) NOT NULL,
  `div_nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `division`
--

INSERT INTO `division` (`div_num`, `div_nom`) VALUES
(1, 'Année 1'),
(2, 'Année 2'),
(3, 'Année Spéciale'),
(4, 'Licence Professionnelle');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `per_num` int(11) NOT NULL,
  `dep_num` int(11) NOT NULL,
  `div_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`per_num`, `dep_num`, `div_num`) VALUES
(3, 6, 2),
(38, 6, 1),
(39, 2, 4),
(53, 2, 1),
(54, 3, 2),
(57, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE `fonction` (
  `fon_num` int(11) NOT NULL,
  `fon_libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`fon_num`, `fon_libelle`) VALUES
(1, 'Directeur'),
(2, 'Chef de département'),
(3, 'Technicien'),
(4, 'Secrétaire'),
(5, 'Ingénieur'),
(6, 'Imprimeur'),
(7, 'Enseignant'),
(8, 'Chercheur');

-- --------------------------------------------------------

--
-- Structure de la table `parcours`
--

CREATE TABLE `parcours` (
  `par_num` int(11) NOT NULL,
  `par_km` float NOT NULL,
  `vil_num1` int(11) NOT NULL,
  `vil_num2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `parcours`
--

INSERT INTO `parcours` (`par_num`, `par_km`, `vil_num1`, `vil_num2`) VALUES
(1, 500, 10, 11),
(2, 100, 7, 5),
(3, 225, 8, 13),
(4, 300, 5, 13),
(5, 345, 15, 11),
(7, 45, 15, 16),
(8, 0, 15, 5),
(9, 0, 15, 5),
(10, 100, 15, 5),
(11, 12, 10, 6),
(12, 123, 17, 15),
(13, 400, 17, 11),
(14, 200, 17, 16),
(15, 1213, 6, 10),
(16, 123, 10, 6),
(17, 123, 6, 10),
(18, 655, 19, 15);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `per_num` int(11) NOT NULL,
  `per_nom` varchar(30) NOT NULL,
  `per_prenom` varchar(30) NOT NULL,
  `per_tel` char(14) NOT NULL,
  `per_mail` varchar(30) NOT NULL,
  `per_login` varchar(20) NOT NULL,
  `per_pwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`per_num`, `per_nom`, `per_prenom`, `per_tel`, `per_mail`, `per_login`, `per_pwd`) VALUES
(1, 'Marley', 'Bob', '0555555555', 'Bob@unilim.fr', 'Bob', '1743dde44ba119d53b6b154758005009be7f919d'),
(3, 'Duchemin', 'Paul', '0555555555', 'paul@yahoo.fr', 'Paul', '1743dde44ba119d53b6b154758005009be7f919d'),
(38, 'Michu', 'Marcel', '0555555555', 'Michu@sfr.fr', 'Marcel', '1743dde44ba119d53b6b154758005009be7f919d'),
(39, 'Renard', 'Pierrot', '0655555555', 'Pierrot@gmail.fr', 'sql', '1743dde44ba119d53b6b154758005009be7f919d'),
(52, 'Adam', 'Pomme', '0555775555', 'Pomme@apple.com', 'Pomme', '1743dde44ba119d53b6b154758005009be7f919d'),
(53, 'Delmas', 'Sophie', '0789562314', 'Sophie@unilim.fr', 'Soso', '1743dde44ba119d53b6b154758005009be7f919d'),
(54, 'Vupuy', 'Pascale', '0554565859', 'pascale@free.fr', 'Pascale', '91a16865c95ad741e92c3c0339cb84d858228f76'),
(57, 'Bobdf456', 'IIII', '0655555555', 'KKKK@yahoo.fr', 'hjkk', 'a8aaf02198c5eb3852d32b1e817b8a2608ce539c');

-- --------------------------------------------------------

--
-- Structure de la table `propose`
--

CREATE TABLE `propose` (
  `par_num` int(11) NOT NULL,
  `per_num` int(11) NOT NULL,
  `pro_date` date NOT NULL,
  `pro_time` time NOT NULL,
  `pro_place` int(11) NOT NULL,
  `pro_sens` tinyint(1) NOT NULL COMMENT '0 : vil1 -> vil2 1: vil2 -> vil1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `propose`
--

INSERT INTO `propose` (`par_num`, `per_num`, `pro_date`, `pro_time`, `pro_place`, `pro_sens`) VALUES
(1, 1, '2020-10-31', '17:57:00', 4, 0),
(1, 1, '2020-10-31', '17:57:14', 1, 0),
(1, 1, '2020-11-03', '08:15:14', 7, 0),
(1, 1, '2020-11-04', '18:29:43', 3, 1),
(1, 1, '2020-11-06', '15:46:20', 4, 0),
(1, 1, '2020-12-29', '13:14:34', 5, 1),
(1, 1, '2020-12-29', '13:15:11', 100, 0),
(1, 39, '2020-11-04', '21:07:42', 0, 1),
(1, 52, '2020-10-31', '17:57:00', 5, 0),
(1, 52, '2020-10-31', '17:57:14', 2, 0),
(1, 52, '2020-11-03', '08:15:14', 8, 0),
(1, 52, '2020-11-04', '18:29:43', 4, 1),
(1, 52, '2020-11-04', '21:07:42', 1, 1),
(1, 52, '2020-11-06', '15:46:20', 5, 0),
(1, 52, '2020-12-29', '13:14:34', 6, 1),
(1, 52, '2020-12-29', '13:15:11', 101, 0),
(2, 1, '2020-12-29', '09:51:54', 3, 1),
(2, 1, '2020-12-29', '12:18:29', 5, 1),
(2, 1, '2020-12-29', '12:31:09', 9, 0),
(2, 1, '2020-12-29', '13:11:20', 66, 1),
(2, 1, '2020-12-29', '14:01:16', 88, 1),
(2, 1, '2020-12-30', '13:12:18', 1, 1),
(2, 1, '2020-12-30', '13:13:18', 1, 0),
(2, 52, '2020-12-29', '09:51:54', 4, 1),
(2, 52, '2020-12-29', '12:18:29', 6, 1),
(2, 52, '2020-12-29', '12:31:09', 10, 0),
(2, 52, '2020-12-29', '13:11:20', 67, 1),
(2, 52, '2020-12-29', '14:01:16', 89, 1),
(2, 52, '2020-12-30', '13:12:18', 2, 1),
(2, 52, '2020-12-30', '13:13:18', 2, 0),
(3, 1, '2020-10-31', '17:58:53', 4, 1),
(3, 1, '2020-10-31', '17:59:04', 5, 0),
(3, 1, '2020-11-04', '18:38:41', 2, 0),
(3, 52, '2020-10-31', '17:58:53', 5, 1),
(3, 52, '2020-10-31', '17:59:04', 6, 0),
(3, 52, '2020-11-04', '18:38:41', 3, 0),
(4, 1, '2020-11-03', '17:06:51', 3, 0),
(4, 1, '2020-12-28', '14:51:20', 2, 0),
(4, 1, '2020-12-29', '13:22:50', 66, 0),
(4, 52, '2020-11-03', '17:06:51', 4, 0),
(4, 52, '2020-12-28', '14:51:20', 3, 0),
(4, 52, '2020-12-29', '13:22:50', 67, 0),
(5, 1, '2020-01-12', '21:00:54', 3, 0),
(5, 1, '2020-01-13', '21:48:29', 3, 0),
(5, 1, '2020-01-14', '19:19:16', 3, 0),
(5, 1, '2020-11-05', '15:37:00', 3, 0),
(5, 1, '2020-12-21', '10:14:33', 2, 0),
(5, 1, '2020-12-21', '10:18:53', 2, 0),
(5, 52, '2020-01-12', '21:00:54', 4, 0),
(5, 52, '2020-01-13', '21:48:29', 4, 0),
(5, 52, '2020-01-14', '19:19:16', 4, 0),
(5, 52, '2020-11-05', '15:37:00', 4, 0),
(8, 1, '2020-01-23', '16:33:08', 3, 0),
(8, 52, '2020-01-23', '16:33:08', 4, 0),
(11, 1, '2020-12-28', '13:25:36', 4, 1),
(11, 1, '2020-12-29', '09:50:26', 3, 1),
(11, 52, '2020-12-28', '13:25:36', 5, 1),
(11, 52, '2020-12-29', '09:50:26', 4, 1),
(12, 1, '2020-12-21', '08:31:08', 1, 0),
(12, 1, '2020-12-22', '12:14:32', 4, 1),
(14, 1, '2020-12-22', '15:13:52', 2, 1),
(18, 1, '2020-12-23', '22:35:52', 15, 0);

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

CREATE TABLE `salarie` (
  `per_num` int(11) NOT NULL,
  `sal_telprof` varchar(20) NOT NULL,
  `fon_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `salarie`
--

INSERT INTO `salarie` (`per_num`, `sal_telprof`, `fon_num`) VALUES
(1, '0123456978', 4),
(52, '0666666666', 8);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `vil_num` int(11) NOT NULL,
  `vil_nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`vil_num`, `vil_nom`) VALUES
(5, 'Tulle'),
(6, 'Brive'),
(7, 'Limoges'),
(8, 'Guéret'),
(9, 'Périgueux'),
(10, 'Bordeaux'),
(11, 'Paris'),
(12, 'Toulouse'),
(13, 'Lyon'),
(14, 'Poitiers'),
(15, 'Ambazac'),
(16, 'Egletons'),
(17, 'La Rochelle'),
(18, 'Isle'),
(19, 'zekr');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`per_num`,`per_per_num`,`par_num`),
  ADD KEY `FK_PESONNE2_AVIS` (`per_per_num`),
  ADD KEY `FK_PRCOURS_AVIS` (`par_num`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`dep_num`),
  ADD KEY `vil_num` (`vil_num`);

--
-- Index pour la table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`div_num`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`per_num`),
  ADD KEY `dep_num` (`dep_num`),
  ADD KEY `div_num` (`div_num`);

--
-- Index pour la table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`fon_num`);

--
-- Index pour la table `parcours`
--
ALTER TABLE `parcours`
  ADD PRIMARY KEY (`par_num`),
  ADD KEY `vil1` (`vil_num1`),
  ADD KEY `vil2` (`vil_num2`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`per_num`);

--
-- Index pour la table `propose`
--
ALTER TABLE `propose`
  ADD PRIMARY KEY (`par_num`,`per_num`,`pro_date`,`pro_time`),
  ADD KEY `per_num` (`per_num`);

--
-- Index pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD PRIMARY KEY (`per_num`),
  ADD KEY `fon_num` (`fon_num`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`vil_num`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `dep_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `division`
--
ALTER TABLE `division`
  MODIFY `div_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `fon_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `parcours`
--
ALTER TABLE `parcours`
  MODIFY `par_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `per_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `vil_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_PERSONNE_AVIS` FOREIGN KEY (`per_num`) REFERENCES `personne` (`per_num`),
  ADD CONSTRAINT `FK_PESONNE2_AVIS` FOREIGN KEY (`per_per_num`) REFERENCES `personne` (`per_num`),
  ADD CONSTRAINT `FK_PRCOURS_AVIS` FOREIGN KEY (`par_num`) REFERENCES `parcours` (`par_num`);

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`vil_num`) REFERENCES `ville` (`vil_num`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`per_num`) REFERENCES `personne` (`per_num`),
  ADD CONSTRAINT `etudiant_ibfk_2` FOREIGN KEY (`dep_num`) REFERENCES `departement` (`dep_num`),
  ADD CONSTRAINT `etudiant_ibfk_3` FOREIGN KEY (`div_num`) REFERENCES `division` (`div_num`);

--
-- Contraintes pour la table `parcours`
--
ALTER TABLE `parcours`
  ADD CONSTRAINT `parcours_ibfk_2` FOREIGN KEY (`vil_num1`) REFERENCES `ville` (`vil_num`),
  ADD CONSTRAINT `parcours_ibfk_3` FOREIGN KEY (`vil_num2`) REFERENCES `ville` (`vil_num`);

--
-- Contraintes pour la table `propose`
--
ALTER TABLE `propose`
  ADD CONSTRAINT `propose_ibfk_1` FOREIGN KEY (`par_num`) REFERENCES `parcours` (`par_num`),
  ADD CONSTRAINT `propose_ibfk_2` FOREIGN KEY (`per_num`) REFERENCES `personne` (`per_num`);

--
-- Contraintes pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD CONSTRAINT `salarie_ibfk_1` FOREIGN KEY (`per_num`) REFERENCES `personne` (`per_num`),
  ADD CONSTRAINT `salarie_ibfk_2` FOREIGN KEY (`fon_num`) REFERENCES `fonction` (`fon_num`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
