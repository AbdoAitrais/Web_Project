-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 11 juin 2022 à 00:13
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
  `PRIORITE` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_ETU`,`ID_OFFRE`),
  UNIQUE KEY `PR` (`PRIORITE`),
  KEY `FK_ATTENTE2` (`ID_OFFRE`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

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
  `ACTIVE_ENS` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_ENS`),
  KEY `FK_FAIRE_PARTIE_DE` (`ID_DEPART`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`ID_ENS`, `ID_DEPART`, `NOM_ENS`, `PRENOM_ENS`, `CIN_ENS`, `DATENAISS_ENS`, `NUMTEL_ENS`, `ACTIVE_ENS`) VALUES
(1, 1, 'EN1', 'ENS1', NULL, NULL, NULL, 1),
(2, 2, 'EN2', 'ENS2', NULL, NULL, NULL, 1),
(3, 1, 'EN3', 'ENS3', NULL, NULL, NULL, 1),
(4, 1, 'EN4', 'ENS4', NULL, NULL, NULL, 1),
(5, 1, 'EN5', 'ENS5', NULL, NULL, NULL, 1),
(6, 2, 'EN6', 'ENS6', NULL, NULL, NULL, 1),
(7, 2, 'EN7', 'ENS7', NULL, NULL, NULL, 1),
(8, 1, 'EN8', 'ENS8', NULL, NULL, NULL, 1),
(9, 1, 'EN9', 'ENS9', NULL, NULL, NULL, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`ID_ENTREP`, `NOM_ENTREP`, `EMAIL_ENTREP`, `VILLE`) VALUES
(1, 'Inwi', NULL, 'Casablanca'),
(2, 'Tesalate', 'Tesalate@gmail.com', 'KENITRA'),
(7, 'ENTREP1', 'HH9@gmail.com', 'KENITRA'),
(8, 'ENTREP3', 'HH11@gmail.com', 'SALE'),
(9, 'ENTREP2', 'HH10@gmail.com', 'SALE'),
(10, 'ENTREP4', 'LL9@gmail.com', 'KENITRA'),
(11, 'ONI', 'HH0@gmail.com', 'OUJDA'),
(12, 'MH1', 'MH1@gmail.com', 'TANGER');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`ID_ETU`, `ID_FORM`, `NOM_ETU`, `PRENOM_ETU`, `CIN_ETU`, `CNE`, `NIVEAU`, `PROMOTION`, `DATENAISS_ETU`, `ADRESSE_ETU`, `EMAIL_ETU`, `NUMTEL_ETU`, `CV`, `ID_USER`) VALUES
(1, 1, 'ANAS', 'KABILA', 'AK1', 'R130073870', 3, 2019, '1999-02-01', 'AK1-AK1', 'AK@h', 130073860, 'uploads/cv/defiler (F).pdf', 1),
(2, 1, 'ABDO', 'RAIS', 'AR1', 'R130073880', 3, 2019, '1999-06-18', 'AR1-AR1', 'AR@R', 130073840, '../uploads/cv/defiler (F).pdf', 2),
(3, 2, 'YASSINE', 'JRAYFY', NULL, 'R130073850', 1, 2022, NULL, NULL, NULL, NULL, '../uploads/cv/03-automates.pdf', 3),
(4, 1, 'HAMZA', 'BANA', 'BH1', 'R130073860', 3, 2019, '1999-06-10', 'BH1-BH1', 'BH@B', 130073890, '../uploads/cv/TD1.pdf', 6),
(6, 3, 'KAMAL', 'hassan', 'BB54FF8', 'R130073800	', 0, 2022, '2000-02-02', 'casablanca-sm', NULL, 130073860, '../uploads/cv/Lutopisme_postcolonial_chez_Fouad_Laroui_La_Vieil.pdf', 13);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`ID_FORM`, `ID_ENS`, `FILIERE`, `TYPE_FORM`, `ID_USER`) VALUES
(1, 1, 'ILISI', 1, 4),
(2, 6, 'MQSE', 2, 5),
(3, 9, 'IRM', 0, 14);

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
(1, 24, NULL),
(5, 24, NULL),
(3, 24, NULL),
(1, 15, 12),
(3, 15, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

DROP TABLE IF EXISTS `motcle`;
CREATE TABLE IF NOT EXISTS `motcle` (
  `ID_MOTCLE` int(11) NOT NULL AUTO_INCREMENT,
  `MOT` varchar(20) DEFAULT NULL,
  `ID_RAPP` int(11) NOT NULL,
  PRIMARY KEY (`ID_MOTCLE`),
  KEY `FK_RAPPORT` (`ID_RAPP`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`ID_OFFRE`, `ID_FORM`, `ID_ENTREP`, `STATUOFFRE`, `NBRCANDIDAT`, `POSTE`, `DUREE`, `DATEDEBUT`, `DATEFIN`, `DESCRIP`, `NIVEAU_OFFRE`, `SOURCE_OFFRE`) VALUES
(1, 1, 1, 'Closed', 10, 'DATA ANALYST', 90, '2022-05-01', '2022-05-26', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(2, 1, 1, 'Nouveau', 10, 'IT SUPPORT', 60, '2022-05-01', '2022-06-21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 2, 1),
(3, 3, 2, 'Nouveau', 10, 'IT TECHNICIEN', 90, '2022-05-01', '2022-06-21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 0, 1),
(4, 1, 1, 'Closed', 10, 'Network', 60, '2022-05-24', '2022-06-05', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(5, 1, 1, 'Nouveau', 10, 'Devloppeur Java', 60, '2022-05-24', '2022-06-21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(6, 1, 2, 'Nouveau', 10, 'UI/UX Designer', 60, '2022-05-24', '2022-06-21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(7, 1, 1, 'Nouveau', 10, 'Cyber Security', 60, '2022-05-24', '2022-06-21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(8, 1, 1, 'Completée', 1, 'Full-Stack (Java)', 60, '2022-05-24', '2022-06-21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 0),
(11, 1, 2, 'Completée', 2, 'BI', 60, '2022-05-24', '2022-06-21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(10, 2, 2, 'Nouveau', 10, 'Cloud', 30, '2022-05-31', '2022-06-21', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 1, 1),
(16, 1, 7, 'Nouveau', 10, 'Hacker', 2700, '2022-06-05', '2022-07-07', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl', 3, 1),
(17, 1, 11, 'Nouveau', 10, 'Engineer', 81000, '2022-06-06', '2022-07-07', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem LoremLorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem  Lorem  Lorem', 3, 1),
(18, 2, 12, 'Nouveau', 14, 'MH1', 90, '2022-06-10', '2023-01-01', 'LOREM LOREM LOREM', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `postuler`
--

DROP TABLE IF EXISTS `postuler`;
CREATE TABLE IF NOT EXISTS `postuler` (
  `ID_ETU` int(11) NOT NULL,
  `ID_OFFRE` int(11) NOT NULL,
  `STATU` varchar(30) DEFAULT NULL,
  `DATEREPONS` timestamp NULL DEFAULT NULL,
  `DATEPOST` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_ETU`,`ID_OFFRE`),
  KEY `FK_POSTULER2` (`ID_OFFRE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `postuler`
--

INSERT INTO `postuler` (`ID_ETU`, `ID_OFFRE`, `STATU`, `DATEREPONS`, `DATEPOST`) VALUES
(2, 7, 'Postulée', '2022-06-10 07:20:31', '2022-06-10 01:29:43'),
(2, 16, 'Non Acceptée', '2022-06-10 07:20:27', '2022-06-10 01:29:41'),
(2, 17, 'Postulée', '2022-06-10 07:20:26', '2022-06-10 01:29:40'),
(4, 17, 'Postulée', NULL, '2022-06-11 11:47:15'),
(6, 3, 'Acceptée', '2022-06-10 10:34:01', '2022-06-10 10:33:52'),
(3, 10, 'Acceptée', '2022-06-10 09:42:15', '2022-06-10 09:42:01'),
(1, 17, 'Acceptée', '2022-06-09 07:55:35', '2022-06-09 07:55:31');

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

DROP TABLE IF EXISTS `rapport`;
CREATE TABLE IF NOT EXISTS `rapport` (
  `ID_RAPP` int(11) NOT NULL AUTO_INCREMENT,
  `FICHIER` varchar(100) DEFAULT NULL,
  `ID_STAGE` int(11) NOT NULL,
  PRIMARY KEY (`ID_RAPP`),
  KEY `FK_STAGE` (`ID_STAGE`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

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
  `ID_ENS` int(11) DEFAULT NULL,
  `ID_ETU` int(11) NOT NULL,
  `DATEDEBUT_STAGE` timestamp NULL DEFAULT NULL,
  `NOTENCAD_ENTREP` float DEFAULT NULL,
  `NOTENCAD` float DEFAULT NULL,
  `CONTRAT` varchar(100) DEFAULT NULL,
  `NIVEAU_STAGE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_STAGE`),
  KEY `FK_ENCADRER` (`ID_ENS`),
  KEY `FK_PEUT_DEVENIR` (`ID_OFFRE`),
  KEY `FK_STAGIER` (`ID_ETU`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`ID_STAGE`, `ID_OFFRE`, `ID_ENS`, `ID_ETU`, `DATEDEBUT_STAGE`, `NOTENCAD_ENTREP`, `NOTENCAD`, `CONTRAT`, `NIVEAU_STAGE`) VALUES
(15, 17, 5, 1, '2022-06-09 07:55:38', 13, 14, NULL, 3),
(23, 10, NULL, 3, '2022-06-10 09:42:19', NULL, NULL, 'uploads/Contracts/Contract10-3.pdf', 1),
(24, 3, NULL, 6, '2022-06-10 10:34:06', NULL, NULL, 'uploads/Contracts/Contract3-6.pdf', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `PICTURE` varchar(50) DEFAULT NULL,
  `ACTIVE` int(11) NOT NULL,
  `VERIFIED` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID_USER`, `LOGIN`, `PASSWORD`, `PICTURE`, `ACTIVE`, `VERIFIED`) VALUES
(1, 'anas123', 'kabila123', NULL, 1, 1),
(2, 'abdo123', 'aitrais123', NULL, 1, 1),
(3, 'yassine123', 'jrayfy123', NULL, 1, 1),
(4, 'hh1123', 'haha1123', NULL, 1, 1),
(5, 'hh2123', 'haha2123', NULL, 1, 1),
(6, 'hamza123', 'bana123', NULL, 1, 1),
(14, 'hh3123', 'haha3123', NULL, 1, 1),
(13, 'Hassan@gmail.com', 'hehe111', '../uploads/pdp/302340_257908.jpg', 1, 1);

DELIMITER $$
--
-- Évènements
--
DROP EVENT `Closing_Offre`$$
CREATE DEFINER=`root`@`localhost` EVENT `Closing_Offre` ON SCHEDULE EVERY 1 DAY STARTS '2022-05-28 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE offre  SET STATUOFFRE="Closed" WHERE DATEFIN=CURRENT_DATE$$

DROP EVENT `Accept_Delay`$$
CREATE DEFINER=`root`@`localhost` EVENT `Accept_Delay` ON SCHEDULE EVERY 1 DAY STARTS '2022-05-28 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE postuler SET STATU="Non acceptée" WHERE STATU='Retenue' AND DATE_ADD(DATEREPONS, INTERVAL 10 DAY) =CURRENT_DATE$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
