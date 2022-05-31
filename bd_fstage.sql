-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 31 mai 2022 à 08:20
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_fstage`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_ADMIN`),
  KEY `FK_USER_ADMIN` (`ID_USER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `attente`
--

DROP TABLE IF EXISTS `attente`;
CREATE TABLE IF NOT EXISTS `attente` (
  `ID_ETU` int(11) NOT NULL,
  `ID_OFFRE` int(11) NOT NULL,
  `PRIORITE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ETU`,`ID_OFFRE`),
  KEY `FK_ATTENTE2` (`ID_OFFRE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `ID_DEPART` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_DEPART` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_DEPART`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`ID_DEPART`, `NOM_DEPART`) VALUES
(1, 'INFO'),
(2, 'ELECTRIQUE');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `ID_ENS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DEPART` int(11) NOT NULL,
  `NOM_ENS` varchar(25) DEFAULT NULL,
  `PRENOM_ENS` varchar(25) DEFAULT NULL,
  `CIN_ENS` varchar(15) DEFAULT NULL,
  `DATENAISS_ENS` date DEFAULT NULL,
  `NUMTEL_ENS` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ENS`),
  KEY `FK_FAIRE_PARTIE_DE` (`ID_DEPART`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`ID_ENS`, `ID_DEPART`, `NOM_ENS`, `PRENOM_ENS`, `CIN_ENS`, `DATENAISS_ENS`, `NUMTEL_ENS`) VALUES
(1, 1, 'EN1', 'ENS1', NULL, NULL, NULL),
(2, 2, 'EN2', 'ENS2', NULL, NULL, NULL),
(3, 1, 'EN3', 'ENS3', NULL, NULL, NULL),
(4, 1, 'EN4', 'ENS4', NULL, NULL, NULL),
(5, 1, 'EN5', 'ENS5', NULL, NULL, NULL),
(6, 1, 'EN6', 'ENS6', NULL, NULL, NULL),
(7, 1, 'EN7', 'ENS7', NULL, NULL, NULL),
(8, 1, 'EN8', 'ENS8', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `ID_ENTREP` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_ENTREP` varchar(25) DEFAULT NULL,
  `EMAIL_ENTREP` varchar(50) DEFAULT NULL,
  `VILLE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_ENTREP`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`ID_ENTREP`, `NOM_ENTREP`, `EMAIL_ENTREP`, `VILLE`) VALUES
(1, 'Inwi', NULL, 'Casablanca'),
(2, 'Tesalate', NULL, 'Rabat');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID_ETU` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FORM` int(11) NOT NULL,
  `NOM_ETU` varchar(25) DEFAULT NULL,
  `PRENOM_ETU` varchar(25) DEFAULT NULL,
  `CIN_ETU` varchar(15) DEFAULT NULL,
  `CNE` varchar(15) DEFAULT NULL,
  `NIVEAU` int(11) DEFAULT NULL,
  `PROMOTION` int(11) DEFAULT NULL,
  `DATENAISS_ETU` date DEFAULT NULL,
  `ADRESSE_ETU` varchar(50) DEFAULT NULL,
  `EMAIL_ETU` varchar(50) DEFAULT NULL,
  `NUMTEL_ETU` int(11) DEFAULT NULL,
  `CV` varchar(100) DEFAULT NULL,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_ETU`),
  KEY `FK_APPARTENIR` (`ID_FORM`),
  KEY `FK_USER_ETU` (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`ID_ETU`, `ID_FORM`, `NOM_ETU`, `PRENOM_ETU`, `CIN_ETU`, `CNE`, `NIVEAU`, `PROMOTION`, `DATENAISS_ETU`, `ADRESSE_ETU`, `EMAIL_ETU`, `NUMTEL_ETU`, `CV`, `ID_USER`) VALUES
(1, 1, 'ANAS', 'KABILA', NULL, 'R130073890', 3, 2020, NULL, NULL, NULL, NULL, NULL, 1),
(2, 1, 'ABDO', 'RAIS', NULL, 'R130073880	', 2, 2021, NULL, NULL, NULL, NULL, NULL, 2),
(3, 2, 'YASSINE', 'JRAYFY', NULL, 'R130073870	', 1, 2022, NULL, NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `ID_FORM` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ENS` int(11) NOT NULL,
  `FILIERE` varchar(30) DEFAULT NULL,
  `TYPE_FORM` int(11) DEFAULT NULL,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_FORM`),
  KEY `FK_GERER2` (`ID_ENS`),
  KEY `FK_USER_RESP` (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`ID_FORM`, `ID_ENS`, `FILIERE`, `TYPE_FORM`, `ID_USER`) VALUES
(1, 1, 'ILISI', 1, 4),
(2, 2, 'GET', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `juri`
--

DROP TABLE IF EXISTS `juri`;
CREATE TABLE IF NOT EXISTS `juri` (
  `ID_ENS` int(11) NOT NULL,
  `ID_STAGE` int(11) NOT NULL,
  `NOTE` float DEFAULT NULL,
  PRIMARY KEY (`ID_ENS`,`ID_STAGE`),
  KEY `FK_JURI2` (`ID_STAGE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `juri`
--

INSERT INTO `juri` (`ID_ENS`, `ID_STAGE`, `NOTE`) VALUES
(1, 1, NULL),
(4, 1, NULL),
(1, 2, NULL),
(3, 2, NULL),
(4, 2, NULL),
(3, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

DROP TABLE IF EXISTS `motcle`;
CREATE TABLE IF NOT EXISTS `motcle` (
  `ID_MOTCLE` int(11) NOT NULL AUTO_INCREMENT,
  `MOT` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_MOTCLE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `ID_OFFRE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FORM` int(11) NOT NULL,
  `ID_ENTREP` int(11) NOT NULL,
  `STATUOFFRE` varchar(25) DEFAULT NULL,
  `NBRCANDIDAT` int(11) DEFAULT NULL,
  `POSTE` varchar(30) DEFAULT NULL,
  `DUREE` int(11) DEFAULT NULL,
  `DATEDEBUT` date DEFAULT NULL,
  `DATEFIN` date DEFAULT NULL,
  `DESCRIP` varchar(2000) DEFAULT NULL,
  `NIVEAU_OFFRE` int(11) DEFAULT NULL,
  `SOURCE_OFFRE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_OFFRE`),
  KEY `FK_CONCERNER` (`ID_FORM`),
  KEY `FK_PRESENTER` (`ID_ENTREP`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`ID_OFFRE`, `ID_FORM`, `ID_ENTREP`, `STATUOFFRE`, `NBRCANDIDAT`, `POSTE`, `DUREE`, `DATEDEBUT`, `DATEFIN`, `DESCRIP`, `NIVEAU_OFFRE`, `SOURCE_OFFRE`) VALUES
(1, 1, 1, 'Closed', 0, 'DATA ANALYST', 90, '2022-05-01', '2022-05-26', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 0),
(2, 1, 1, 'Closed', 3, 'IT SUPPORT', 60, '2022-05-01', '2022-05-29', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 2, 1),
(3, 1, 2, 'Closed', 8, 'IT TECHNICIEN', 60, '2022-05-01', '2022-05-31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 2, 1),
(4, 1, 1, 'Closed', 5, 'HH1', 60, '2022-05-24', '2022-05-31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(5, 1, 1, 'Closed', 4, 'HH2', 60, '2022-05-24', '2022-05-31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(6, 1, 2, 'Closed', 5, 'HH3', 60, '2022-05-24', '2022-05-31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(7, 1, 1, 'Closed', 4, 'HH4', 60, '2022-05-24', '2022-05-31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(8, 1, 1, 'Closed', 8, 'HH5', 60, '2022-05-24', '2022-05-31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(11, 1, 2, 'Closed', 1, 'HH6', 60, '2022-05-24', '2022-05-31', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(10, 2, 2, 'Nouveau', 8, 'HAHA', 30, '2022-05-31', '2022-06-10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `postuler`
--

DROP TABLE IF EXISTS `postuler`;
CREATE TABLE IF NOT EXISTS `postuler` (
  `ID_ETU` int(11) NOT NULL,
  `ID_OFFRE` int(11) NOT NULL,
  `STATU` varchar(30) DEFAULT NULL,
  `DATEREPONS` date DEFAULT NULL,
  `DATEPOST` date DEFAULT NULL,
  PRIMARY KEY (`ID_ETU`,`ID_OFFRE`),
  KEY `FK_POSTULER2` (`ID_OFFRE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `postuler`
--

INSERT INTO `postuler` (`ID_ETU`, `ID_OFFRE`, `STATU`, `DATEREPONS`, `DATEPOST`) VALUES
(1, 11, 'Non Acceptée', '2022-05-27', '2022-05-27'),
(3, 10, 'Acceptée', '2022-05-28', '2022-05-28'),
(1, 7, 'Acceptée', '2022-05-27', '2022-05-27'),
(2, 2, 'Acceptée', '2022-05-28', '2022-05-28'),
(2, 3, 'Non Acceptée', '2022-05-28', '2022-05-28');

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

DROP TABLE IF EXISTS `rapport`;
CREATE TABLE IF NOT EXISTS `rapport` (
  `ID_RAPP` int(11) NOT NULL AUTO_INCREMENT,
  `FICHIER` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_RAPP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `referencer`
--

DROP TABLE IF EXISTS `referencer`;
CREATE TABLE IF NOT EXISTS `referencer` (
  `ID_RAPP` int(11) NOT NULL,
  `ID_MOTCLE` int(11) NOT NULL,
  PRIMARY KEY (`ID_RAPP`,`ID_MOTCLE`),
  KEY `FK_REFERENCER2` (`ID_MOTCLE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `ID_STAGE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_OFFRE` int(11) NOT NULL,
  `ID_RAPP` int(11) DEFAULT NULL,
  `ID_ENS` int(11) DEFAULT NULL,
  `ID_ETU` int(11) NOT NULL,
  `DATEDEBUT_STAGE` date DEFAULT NULL,
  `NOTENCAD_ENTREP` float DEFAULT NULL,
  `NOTENCAD` float DEFAULT NULL,
  `CONTRAT` varchar(100) DEFAULT NULL,
  `NIVEAU_STAGE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_STAGE`),
  KEY `FK_CORRESPONDRE2` (`ID_RAPP`),
  KEY `FK_ENCADRER` (`ID_ENS`),
  KEY `FK_PEUT_DEVENIR` (`ID_OFFRE`),
  KEY `FK_STAGIER` (`ID_ETU`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`ID_STAGE`, `ID_OFFRE`, `ID_RAPP`, `ID_ENS`, `ID_ETU`, `DATEDEBUT_STAGE`, `NOTENCAD_ENTREP`, `NOTENCAD`, `CONTRAT`, `NIVEAU_STAGE`) VALUES
(1, 7, NULL, 1, 1, '2022-05-27', 11, 10, NULL, 3),
(2, 2, NULL, 4, 2, '2022-05-28', NULL, NULL, NULL, 2),
(3, 10, NULL, NULL, 3, '2022-05-28', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `ACTIVE` int(11) NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID_USER`, `LOGIN`, `PASSWORD`, `ACTIVE`) VALUES
(1, 'anas123', 'kabila123', 1),
(2, 'abdo123', 'aitrais123', 1),
(3, 'yassine123', 'jrayfy123', 1),
(4, 'hh1123', 'haha1123', 1),
(5, 'hh2123', 'haha2123', 1);

DELIMITER $$
--
-- Évènements
--
DROP EVENT `Closing_Offre`$$
CREATE DEFINER=`root`@`localhost` EVENT `Closing_Offre` ON SCHEDULE EVERY 1 DAY STARTS '2022-05-28 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE offre  SET STATUOFFRE="Closed" WHERE DATEFIN=(SELECT CURRENT_DATE)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
