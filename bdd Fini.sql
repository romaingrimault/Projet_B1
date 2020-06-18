-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 02 avr. 2019 à 08:22
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `bijou`
--

DROP TABLE IF EXISTS `bijou`;
CREATE TABLE IF NOT EXISTS `bijou` (
  `idBijou` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `etat` tinyint(2) NOT NULL,
  `estimationTravail` int(50) NOT NULL,
  `estimationPrix` float NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`idBijou`),
  KEY `fk_Bijou_client1_idx` (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bijou`
--

INSERT INTO `bijou` (`idBijou`, `titre`, `etat`, `estimationTravail`, `estimationPrix`, `image`, `idclient`) VALUES
(18, 'Colier en or', 0, 500, 700, 'Montagne.jpg', 2),
(19, 'Bracelet en Argent', 0, 150, 16, '1.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `choixmetal`
--

DROP TABLE IF EXISTS `choixmetal`;
CREATE TABLE IF NOT EXISTS `choixmetal` (
  `nbCarat` float NOT NULL,
  `Prix` int(40) DEFAULT NULL,
  `Tache_idTache` int(11) NOT NULL,
  `Metal_idMetal` int(11) NOT NULL,
  PRIMARY KEY (`Tache_idTache`,`Metal_idMetal`),
  KEY `fk_ChoixMetal_Tache1_idx` (`Tache_idTache`),
  KEY `fk_ChoixMetal_Metal1_idx` (`Metal_idMetal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `choixpierre`
--

DROP TABLE IF EXISTS `choixpierre`;
CREATE TABLE IF NOT EXISTS `choixpierre` (
  `nbCarat` float NOT NULL,
  `Prix` float DEFAULT NULL,
  `Tache_idTache` int(11) NOT NULL,
  `Pierre_idPierre` int(11) NOT NULL,
  PRIMARY KEY (`Tache_idTache`,`Pierre_idPierre`),
  KEY `fk_ChoixPierre_Tache1_idx` (`Tache_idTache`),
  KEY `fk_ChoixPierre_Pierre1_idx` (`Pierre_idPierre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idclient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `ville` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idclient`, `nom`, `prenom`, `tel`, `adresse`, `ville`, `mail`) VALUES
(2, 'Delarue', 'Jean', '0240208554', '4 rue ichel', 'nantes', 'delarue@gmail.com'),
(4, 'Covert', 'Hari', '06402800545', '4 rue legume', 'Nantes', 'haricovert@gmeil.com'),
(6, 'Cocaud', 'Martial', '0675848585', '4 rue alain ', 'Nantes', 'martial.cocaud@epsi.fr'),
(7, 'Ploteau', 'Jean', '0240280550', '4 rue jean', 'Nantes', 'Jean.pl@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `idEmployee` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(50) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `motDePasse` varchar(45) NOT NULL,
  `etat` tinyint(4) NOT NULL,
  `dateCreation` date NOT NULL,
  `Metier_idMetier` int(11) NOT NULL,
  PRIMARY KEY (`idEmployee`),
  KEY `fk_Employee_Metier1_idx` (`Metier_idMetier`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employee`
--

INSERT INTO `employee` (`idEmployee`, `identifiant`, `nom`, `prenom`, `motDePasse`, `etat`, `dateCreation`, `Metier_idMetier`) VALUES
(0, 'null', 'null', 'null', 'null', 0, '2019-03-19', 1),
(1, 'Michel1', 'Delarue', 'Michel', '395df8f7c51f007019cb30201c49e884b46b92fa', 1, '2019-03-09', 1),
(2, 'Claude1', 'Paulin', 'Claude', '395df8f7c51f007019cb30201c49e884b46b92fa', 1, '2019-03-13', 2),
(3, 'Dominique1', 'Grimault', 'Dominique', '395df8f7c51f007019cb30201c49e884b46b92fa', 1, '2019-04-02', 3),
(4, 'JeanLoulou1', 'Delatour', 'Jean-Louis', '395df8f7c51f007019cb30201c49e884b46b92fa', 1, '2019-03-27', 4),
(5, 'Cedric1', 'VallÃ©e', 'CÃ©dric', '395df8f7c51f007019cb30201c49e884b46b92fa', 1, '2019-04-01', 5);

-- --------------------------------------------------------

--
-- Structure de la table `metal`
--

DROP TABLE IF EXISTS `metal`;
CREATE TABLE IF NOT EXISTS `metal` (
  `idMetal` int(11) NOT NULL AUTO_INCREMENT,
  `typeMetal` varchar(45) NOT NULL,
  PRIMARY KEY (`idMetal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `metal`
--

INSERT INTO `metal` (`idMetal`, `typeMetal`) VALUES
(1, 'Or');

-- --------------------------------------------------------

--
-- Structure de la table `metier`
--

DROP TABLE IF EXISTS `metier`;
CREATE TABLE IF NOT EXISTS `metier` (
  `idMetier` int(11) NOT NULL,
  `nomMetier` varchar(45) NOT NULL,
  PRIMARY KEY (`idMetier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `metier`
--

INSERT INTO `metier` (`idMetier`, `nomMetier`) VALUES
(1, 'ChefAtelier'),
(2, 'Sertisseur'),
(3, 'Tailleur'),
(4, 'Polisseur'),
(5, 'Fondeur');

-- --------------------------------------------------------

--
-- Structure de la table `pierre`
--

DROP TABLE IF EXISTS `pierre`;
CREATE TABLE IF NOT EXISTS `pierre` (
  `idPierre` int(11) NOT NULL AUTO_INCREMENT,
  `typePierre` varchar(45) NOT NULL,
  PRIMARY KEY (`idPierre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pierre`
--

INSERT INTO `pierre` (`idPierre`, `typePierre`) VALUES
(1, 'Ruby Magenta'),
(2, 'Quartz pur'),
(3, 'Quartz violet');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `idTache` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `heureTravail` float DEFAULT NULL,
  `controleQualite` tinyint(4) DEFAULT NULL,
  `idBijou` int(11) NOT NULL,
  `idEmployee` int(11) NOT NULL,
  `idMetier` int(11) NOT NULL,
  PRIMARY KEY (`idTache`),
  KEY `fk_Tache_Bijou_idx` (`idBijou`),
  KEY `fk_Tache_Employee1_idx` (`idEmployee`),
  KEY `fk_Tache_Metier1_idx` (`idMetier`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`idTache`, `titre`, `commentaire`, `heureTravail`, `controleQualite`, `idBijou`, `idEmployee`, `idMetier`) VALUES
(26, 'Fondre l\'or', NULL, NULL, NULL, 18, 0, 5),
(27, 'Fondre l\'argent', NULL, NULL, NULL, 19, 0, 5);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bijou`
--
ALTER TABLE `bijou`
  ADD CONSTRAINT `fk_Bijou_client1` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `choixmetal`
--
ALTER TABLE `choixmetal`
  ADD CONSTRAINT `fk_ChoixMetal_Metal1` FOREIGN KEY (`Metal_idMetal`) REFERENCES `metal` (`idMetal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ChoixMetal_Tache1` FOREIGN KEY (`Tache_idTache`) REFERENCES `tache` (`idTache`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `choixpierre`
--
ALTER TABLE `choixpierre`
  ADD CONSTRAINT `fk_ChoixPierre_Pierre1` FOREIGN KEY (`Pierre_idPierre`) REFERENCES `pierre` (`idPierre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ChoixPierre_Tache1` FOREIGN KEY (`Tache_idTache`) REFERENCES `tache` (`idTache`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_Employee_Metier1` FOREIGN KEY (`Metier_idMetier`) REFERENCES `metier` (`idMetier`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `fk_Tache_Bijou` FOREIGN KEY (`idBijou`) REFERENCES `bijou` (`idBijou`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tache_Employee1` FOREIGN KEY (`idEmployee`) REFERENCES `employee` (`idEmployee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tache_Metier1` FOREIGN KEY (`idMetier`) REFERENCES `metier` (`idMetier`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
