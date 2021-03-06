-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 31 jan. 2019 à 20:11
-- Version du serveur :  5.7.21
-- Version de PHP :  7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `challengesoyhuce`
--

-- --------------------------------------------------------

--
-- Structure de la table `conditiongenerale`
--

DROP TABLE IF EXISTS `conditiongenerale`;
CREATE TABLE IF NOT EXISTS `conditiongenerale` (
  `idCondition` int(11) NOT NULL AUTO_INCREMENT,
  `nomCondition` varchar(45) COLLATE utf8_bin NOT NULL,
  `idIcone` varchar(6) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idCondition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `refleter`
--

DROP TABLE IF EXISTS `refleter`;
CREATE TABLE IF NOT EXISTS `refleter` (
  `idCondition` int(11) NOT NULL,
  `idRequete` int(11) NOT NULL,
  PRIMARY KEY (`idCondition`,`idRequete`),
  KEY `refleter_requete0_FK` (`idRequete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `requete`
--

DROP TABLE IF EXISTS `requete`;
CREATE TABLE IF NOT EXISTS `requete` (
  `idRequete` int(11) NOT NULL AUTO_INCREMENT,
  `dateRequete` datetime NOT NULL,
  `valeurTemperature` float NOT NULL,
  `valeurPression` int(11) NOT NULL,
  `valeurHumidite` int(11) NOT NULL,
  `valeurVent` float NOT NULL,
  `valeurNuages` int(11) NOT NULL,
  `idVille` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRequete`),
  KEY `requete_ville_FK` (`idVille`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `requete`
--

INSERT INTO `requete` (`idRequete`, `dateRequete`, `valeurTemperature`, `valeurPression`, `valeurHumidite`, `valeurVent`, `valeurNuages`, `idVille`) VALUES
(1, '2019-01-31 11:57:00', 6.59, 996, 87, 5.7, 92, NULL),
(2, '2019-01-31 11:58:00', -1.69, 991, 100, 6.2, 90, NULL),
(3, '2019-01-31 11:59:00', -1.69, 991, 100, 6.2, 90, NULL),
(4, '2019-01-31 12:00:00', -1.69, 991, 100, 6.2, 90, NULL),
(5, '2019-01-31 12:00:00', -1.69, 991, 100, 6.2, 90, NULL),
(6, '2019-01-31 12:01:00', -0.5, 996, 100, 5.1, 90, NULL),
(7, '2019-01-31 12:01:00', 6.58, 996, 87, 7.2, 92, NULL),
(8, '2019-01-31 12:01:00', 6.58, 996, 87, 7.2, 92, NULL),
(9, '2019-01-31 12:13:00', -1.34, 991, 100, 5.7, 90, NULL),
(10, '2019-01-31 15:13:00', 0, 986, 100, 5.7, 75, NULL),
(11, '2019-01-31 15:15:00', 0, 986, 100, 5.7, 75, NULL),
(12, '2019-01-31 15:15:00', 0, 986, 100, 5.7, 75, NULL),
(13, '2019-01-31 15:16:00', 0, 986, 100, 5.7, 75, NULL),
(14, '2019-01-31 15:18:00', 0, 986, 100, 5.7, 75, NULL),
(15, '2019-01-31 15:44:00', 15.37, 1016, 59, 5.1, 40, NULL),
(16, '2019-01-31 15:54:00', 3, 985, 93, 4.1, 92, NULL),
(17, '2019-01-31 15:55:00', 0.31, 985, 100, 6.7, 92, NULL),
(18, '2019-01-31 16:01:00', 7, 991, 70, 7.7, 92, NULL),
(19, '2019-01-31 16:01:00', 4.57, 985, 93, 5.1, 90, NULL),
(20, '2019-01-31 16:02:00', 7, 991, 70, 7.7, 92, NULL),
(21, '2019-01-31 16:02:00', 4.57, 985, 93, 5.1, 90, NULL),
(22, '2019-01-31 16:03:00', -30.83, 1030, 74, 1.5, 1, NULL),
(23, '2019-01-31 16:03:00', 11, 986, 93, 7.2, 90, NULL),
(24, '2019-01-31 16:05:00', 33.18, 971, 50, 1.06, 20, NULL),
(25, '2019-01-31 16:05:00', 33.18, 971, 50, 1.06, 20, NULL),
(26, '2019-01-31 16:06:00', 33.18, 971, 50, 1.06, 20, NULL),
(27, '2019-01-31 16:06:00', 33.18, 971, 50, 1.06, 20, NULL),
(28, '2019-01-31 16:06:00', 33.18, 971, 50, 1.06, 20, NULL),
(29, '2019-01-31 16:06:00', 33.18, 971, 50, 1.06, 20, NULL),
(30, '2019-01-31 16:28:00', 33.18, 971, 50, 1.06, 20, NULL),
(31, '2019-01-31 16:28:00', 33.18, 971, 50, 1.06, 20, NULL),
(32, '2019-01-31 16:29:00', 33.18, 971, 50, 1.06, 20, NULL),
(33, '2019-01-31 16:29:00', 33.18, 971, 50, 1.06, 20, NULL),
(34, '2019-01-31 16:29:00', 0.31, 983, 100, 9.3, 92, NULL),
(35, '2019-01-31 16:30:00', 0.31, 983, 100, 9.3, 92, NULL),
(36, '2019-01-31 16:30:00', 0.31, 983, 100, 9.3, 92, NULL),
(37, '2019-01-31 16:30:00', 0.31, 983, 100, 9.3, 92, NULL),
(38, '2019-01-31 16:31:00', 0.31, 983, 100, 9.3, 92, NULL),
(39, '2019-01-31 16:32:00', 0.31, 983, 100, 9.3, 92, NULL),
(40, '2019-01-31 16:32:00', 0.31, 983, 100, 9.3, 92, NULL),
(41, '2019-01-31 16:32:00', 0.31, 983, 100, 9.3, 92, NULL),
(42, '2019-01-31 16:33:00', 0.31, 983, 100, 9.3, 92, NULL),
(43, '2019-01-31 16:35:00', 0.31, 983, 100, 9.3, 92, NULL),
(44, '2019-01-31 16:35:00', 0.31, 983, 100, 9.3, 92, NULL),
(45, '2019-01-31 16:36:00', 0.31, 983, 100, 9.3, 92, NULL),
(46, '2019-01-31 16:37:00', 0.31, 983, 100, 9.3, 92, NULL),
(47, '2019-01-31 16:38:00', 0.31, 983, 100, 9.3, 92, NULL),
(48, '2019-01-31 16:39:00', 0.31, 983, 100, 9.3, 92, NULL),
(49, '2019-01-31 16:39:00', 0.31, 983, 100, 9.3, 92, NULL),
(50, '2019-01-31 16:39:00', 0.31, 983, 100, 9.3, 92, NULL),
(51, '2019-01-31 16:40:00', 0.31, 983, 100, 9.3, 92, NULL),
(52, '2019-01-31 16:41:00', 0.31, 983, 100, 9.3, 92, NULL),
(53, '2019-01-31 16:42:00', 0.31, 983, 100, 9.3, 92, NULL),
(54, '2019-01-31 16:42:00', 0.31, 983, 100, 9.3, 92, NULL),
(55, '2019-01-31 16:43:00', 0.31, 983, 100, 9.3, 92, NULL),
(56, '2019-01-31 16:44:00', 0.31, 983, 100, 9.3, 92, NULL),
(57, '2019-01-31 16:45:00', 0.31, 983, 100, 9.3, 92, NULL),
(58, '2019-01-31 16:45:00', 0.31, 983, 100, 9.3, 92, NULL),
(59, '2019-01-31 16:47:00', 0.31, 983, 100, 9.3, 92, NULL),
(60, '2019-01-31 16:47:00', 0.31, 983, 100, 9.3, 92, NULL),
(61, '2019-01-31 16:48:00', 0.31, 983, 100, 9.3, 92, NULL),
(62, '2019-01-31 16:48:00', 0.31, 983, 100, 9.3, 92, NULL),
(63, '2019-01-31 16:49:00', 0.31, 983, 100, 9.3, 92, NULL),
(64, '2019-01-31 16:50:00', 0.31, 983, 100, 9.3, 92, NULL),
(65, '2019-01-31 16:50:00', 0.31, 983, 100, 9.3, 92, NULL),
(66, '2019-01-31 16:50:00', 0.31, 983, 100, 9.3, 92, NULL),
(67, '2019-01-31 16:51:00', 0.31, 983, 100, 9.3, 92, NULL),
(68, '2019-01-31 16:51:00', 0.31, 983, 100, 9.3, 92, NULL),
(69, '2019-01-31 16:54:00', 0.31, 983, 100, 9.3, 92, NULL),
(70, '2019-01-31 16:55:00', 0.31, 983, 100, 9.3, 92, NULL),
(71, '2019-01-31 16:55:00', 0.31, 983, 100, 9.3, 92, NULL),
(72, '2019-01-31 16:55:00', 0.31, 983, 100, 9.3, 92, NULL),
(73, '2019-01-31 16:55:00', 0.31, 983, 100, 9.3, 92, NULL),
(74, '2019-01-31 16:56:00', 0.31, 983, 100, 9.3, 92, NULL),
(75, '2019-01-31 16:56:00', 0.31, 983, 100, 9.3, 92, NULL),
(76, '2019-01-31 16:57:00', 0.31, 983, 100, 9.3, 92, NULL),
(77, '2019-01-31 16:59:00', 0.31, 983, 100, 9.3, 92, NULL),
(78, '2019-01-31 16:59:00', 0.31, 983, 100, 9.3, 92, NULL),
(79, '2019-01-31 16:59:00', 0.31, 983, 100, 9.3, 92, NULL),
(80, '2019-01-31 17:00:00', 0.31, 983, 100, 9.3, 92, NULL),
(81, '2019-01-31 17:00:00', 0.31, 983, 100, 9.3, 92, NULL),
(82, '2019-01-31 17:00:00', 0.31, 983, 100, 9.3, 92, NULL),
(83, '2019-01-31 17:01:00', 0.31, 983, 100, 9.3, 92, NULL),
(84, '2019-01-31 17:01:00', 0.32, 984, 100, 10.8, 92, NULL),
(85, '2019-01-31 17:02:00', 0.32, 984, 100, 10.8, 92, NULL),
(86, '2019-01-31 17:02:00', 0.32, 984, 100, 10.8, 92, NULL),
(87, '2019-01-31 17:02:00', 0.32, 984, 100, 10.8, 92, NULL),
(88, '2019-01-31 17:02:00', 0.32, 984, 100, 10.8, 92, NULL),
(89, '2019-01-31 17:03:00', 0.32, 984, 100, 10.8, 92, NULL),
(90, '2019-01-31 17:03:00', 0.32, 984, 100, 10.8, 92, NULL),
(91, '2019-01-31 17:04:00', 0.32, 984, 100, 10.8, 92, NULL),
(92, '2019-01-31 17:04:00', 0.32, 984, 100, 10.8, 92, NULL),
(93, '2019-01-31 17:05:00', 0.32, 984, 100, 10.8, 92, NULL),
(94, '2019-01-31 17:06:00', 0.32, 984, 100, 10.8, 92, NULL),
(95, '2019-01-31 17:06:00', 0.32, 984, 100, 10.8, 92, NULL),
(96, '2019-01-31 17:08:00', 0.32, 984, 100, 10.8, 92, NULL),
(97, '2019-01-31 17:09:00', 0.32, 984, 100, 10.8, 92, NULL),
(98, '2019-01-31 17:09:00', 0.32, 984, 100, 10.8, 92, NULL),
(99, '2019-01-31 17:09:00', 0.32, 984, 100, 10.8, 92, NULL),
(100, '2019-01-31 17:09:00', 0.32, 984, 100, 10.8, 92, NULL),
(101, '2019-01-31 17:09:00', 0.32, 984, 100, 10.8, 92, NULL),
(102, '2019-01-31 17:10:00', 0.32, 984, 100, 10.8, 92, NULL),
(103, '2019-01-31 17:10:00', 0.32, 984, 100, 10.8, 92, NULL),
(104, '2019-01-31 17:11:00', 0.32, 984, 100, 10.8, 92, NULL),
(105, '2019-01-31 17:11:00', 0.32, 984, 100, 10.8, 92, NULL),
(106, '2019-01-31 17:11:00', 0.31, 982, 100, 8.2, 92, NULL),
(107, '2019-01-31 17:11:00', 0.31, 982, 100, 8.2, 92, NULL),
(108, '2019-01-31 17:11:00', 0.31, 982, 100, 8.2, 92, NULL),
(109, '2019-01-31 17:11:00', 0.31, 982, 100, 8.2, 92, NULL),
(110, '2019-01-31 17:12:00', 0.31, 982, 100, 8.2, 92, NULL),
(111, '2019-01-31 17:12:00', 0.31, 982, 100, 8.2, 92, NULL),
(112, '2019-01-31 17:12:00', 0.31, 982, 100, 8.2, 92, NULL),
(113, '2019-01-31 17:12:00', 0.31, 982, 100, 8.2, 92, NULL),
(114, '2019-01-31 17:12:00', 0.31, 982, 100, 8.2, 92, NULL),
(115, '2019-01-31 17:12:00', 0.31, 982, 100, 8.2, 92, NULL),
(116, '2019-01-31 17:12:00', 0.31, 982, 100, 8.2, 92, NULL),
(117, '2019-01-31 17:12:00', 1.37, 988, 80, 5.7, 0, NULL),
(118, '2019-01-31 17:13:00', 1.37, 988, 80, 5.7, 0, NULL),
(119, '2019-01-31 17:14:00', 0.31, 982, 100, 8.2, 92, NULL),
(120, '2019-01-31 17:19:00', 0.31, 982, 100, 8.2, 92, NULL),
(121, '2019-01-31 17:22:00', 1.37, 988, 80, 5.7, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `idVille` int(11) NOT NULL AUTO_INCREMENT,
  `nomVille` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idVille`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `refleter`
--
ALTER TABLE `refleter`
  ADD CONSTRAINT `refleter_conditionGenerale_FK` FOREIGN KEY (`idCondition`) REFERENCES `conditiongenerale` (`idCondition`),
  ADD CONSTRAINT `refleter_requete0_FK` FOREIGN KEY (`idRequete`) REFERENCES `requete` (`idRequete`);

--
-- Contraintes pour la table `requete`
--
ALTER TABLE `requete`
  ADD CONSTRAINT `requete_ville_FK` FOREIGN KEY (`idVille`) REFERENCES `ville` (`idVille`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
