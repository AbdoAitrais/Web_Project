-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 16 juin 2022 à 15:34
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
  `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_ADMIN`),
  KEY `FK_USER_ADMIN` (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `ID_USER`) VALUES
(1, 15);

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
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

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
  `EMAIL_ENS` varchar(30) DEFAULT NULL,
  `DATENAISS_ENS` date DEFAULT NULL,
  `NUMTEL_ENS` int(11) DEFAULT NULL,
  `ACTIVE_ENS` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_ENS`),
  KEY `FK_FAIRE_PARTIE_DE` (`ID_DEPART`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`ID_ENS`, `ID_DEPART`, `NOM_ENS`, `PRENOM_ENS`, `CIN_ENS`, `EMAIL_ENS`, `DATENAISS_ENS`, `NUMTEL_ENS`, `ACTIVE_ENS`) VALUES
(1, 1, 'EN1', 'ENS1', 'T5653351', 'ENS1@gmail.com', NULL, NULL, 1),
(2, 2, 'EN2', 'ENS2', 'T5653352', 'ENS2@gmail.com', NULL, NULL, 1),
(3, 1, 'EN3', 'ENS3', 'T5653353', 'ENS3@gmail.com', NULL, NULL, 1),
(4, 1, 'EN4', 'ENS4', 'T5653354', 'ENS4@gmail.com', NULL, NULL, 1),
(5, 1, 'EN5', 'ENS5', 'T5653355', 'ENS5@gmail.com', NULL, NULL, 1),
(6, 2, 'EN6', 'ENS6', 'T5653356', 'ENS6@gmail.com', NULL, NULL, 1),
(7, 2, 'EN7', 'ENS7', 'T5653357', 'ENS7@gmail.com', NULL, NULL, 1),
(8, 1, 'EN8', 'ENS8', 'T5653358', 'ENS8@gmail.com', NULL, NULL, 1),
(9, 1, 'EN9', 'ENS9', 'T5653359', 'ENS9@gmail.com', NULL, NULL, 1),
(10, 2, 'EN10', 'ENS10', 'T5653360', 'ENS10@gmail.com', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

DROP TABLE IF EXISTS `enseigner`;
CREATE TABLE IF NOT EXISTS `enseigner` (
  `ID_FORM` int(11) NOT NULL,
  `ID_ENS` int(11) NOT NULL,
  PRIMARY KEY (`ID_FORM`,`ID_ENS`),
  KEY `FK_FORM` (`ID_FORM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseigner`
--

INSERT INTO `enseigner` (`ID_FORM`, `ID_ENS`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(2, 2),
(2, 6),
(2, 7),
(2, 10),
(3, 5),
(3, 8),
(3, 9);

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
  `WEBSITE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_ENTREP`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`ID_ENTREP`, `NOM_ENTREP`, `EMAIL_ENTREP`, `VILLE`, `WEBSITE`) VALUES
(1, 'Inwi', 'inwi@gmail.com', 'Casablanca', 'inwi.com'),
(2, 'Tesalate', 'Tesalate@gmail.com', 'KENITRA', 'Tesalate.com'),
(7, 'ENTREP1', 'HH9@gmail.com', 'KENITRA', ''),
(8, 'ENTREP3', 'HH11@gmail.com', 'SALE', NULL),
(9, 'ENTREP2', 'HH10@gmail.com', 'SALE', NULL),
(10, 'ENTREP4', 'LL9@gmail.com', 'KENITRA', NULL),
(11, 'ONI', 'HH0@gmail.com', 'OUJDA', NULL),
(12, 'MH1', 'MH1@gmail.com', 'TANGER', NULL),
(13, 'ENTREP5', 'ENTREP5@gmail.com', NULL, 'ENTREP5.com');

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`ID_ETU`, `ID_FORM`, `NOM_ETU`, `PRENOM_ETU`, `CIN_ETU`, `CNE`, `NIVEAU`, `PROMOTION`, `DATENAISS_ETU`, `ADRESSE_ETU`, `EMAIL_ETU`, `NUMTEL_ETU`, `CV`, `ID_USER`) VALUES
(1, 1, 'ANAS', 'KABILA', 'AK1', 'R130073870', 3, 2019, '1999-02-01', 'AK1-AK1', 'AK@h', 130073860, 'uploads/cv/defiler (F).pdf', 1),
(2, 1, 'ABDO', 'RAIS', 'AR1', 'R130073880', 3, 2019, '1999-06-18', 'AR1-AR1', 'AR@R', 130073840, '../uploads/cv/defiler (F).pdf', 2),
(3, 2, 'YASSINE', 'JRAYFY', NULL, 'R130073850', 1, 2022, NULL, NULL, NULL, NULL, '../uploads/cv/03-automates.pdf', 3),
(4, 1, 'HAMZA', 'BANA', 'BH1', 'R130073860', 3, 2019, '1999-06-10', 'BH1-BH1', 'BH@B', 130073890, '../uploads/cv/TD1.pdf', 6),
(6, 3, 'KAMAL', 'hassan', 'BB54FF8', 'R130073800	', 0, 2022, '2000-02-02', 'casablanca-sm', NULL, 130073860, '../uploads/cv/010080697.pdf', 13);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `ID_FORM` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ENS` int(11) NOT NULL,
  `FULL_NAME` varchar(100) DEFAULT NULL,
  `FILIERE` varchar(30) DEFAULT NULL,
  `TYPE_FORM` int(11) DEFAULT NULL,
  `ID_USER` int(11) NOT NULL,
  PRIMARY KEY (`ID_FORM`),
  KEY `FK_GERER2` (`ID_ENS`),
  KEY `FK_USER_RESP` (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`ID_FORM`, `ID_ENS`, `FULL_NAME`, `FILIERE`, `TYPE_FORM`, `ID_USER`) VALUES
(1, 1, 'Ingenieurie Logiciel et Integration des Systemes Informatiques', 'ILISI', 1, 4),
(2, 6, NULL, 'MQSE', 2, 5),
(3, 9, NULL, 'IRM', 0, 14);

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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `motcle`
--

INSERT INTO `motcle` (`ID_MOTCLE`, `MOT`, `ID_RAPP`) VALUES
(35, 'JS', 17),
(34, 'PHP', 17),
(33, 'JAVA', 17);

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
(2, 1, 1, 'Nouveau', 10, 'IT SUPPORT', 60, '2022-05-01', '2022-06-27', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 2, 1),
(3, 3, 2, 'Nouveau', 10, 'IT TECHNICIEN', 90, '2022-05-01', '2022-06-27', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 0, 1),
(4, 1, 1, 'Closed', 10, 'Network', 60, '2022-05-24', '2022-06-05', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(5, 1, 1, 'Nouveau', 10, 'Devloppeur Java', 60, '2022-05-24', '2022-06-27', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(6, 1, 2, 'Nouveau', 10, 'UI/UX Designer', 60, '2022-05-24', '2022-06-27', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(7, 1, 1, 'Nouveau', 10, 'Cyber Security', 60, '2022-05-24', '2022-06-27', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(11, 1, 2, 'Nouveau', 2, 'BI', 60, '2022-05-24', '2022-06-27', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 3, 1),
(10, 2, 2, 'Nouveau', 10, 'Cloud', 30, '2022-05-31', '2022-06-27', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl.', 1, 1),
(16, 1, 7, 'Nouveau', 10, 'Hacker', 2700, '2022-06-05', '2022-07-07', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus convallis purus, at elementum ligula egestas quis. Duis sed dolor quam. Vivamus vitae hendrerit magna. Nam lacinia tellus placerat luctus rutrum. Nam consectetur justo velit, ac vulputate justo ultrices eget. Nunc ut convallis tortor, at tempor nisl', 3, 1),
(17, 1, 11, 'Nouveau', 10, 'Engineer', 120, '2022-06-06', '2022-07-07', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem LoremLorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem  Lorem  Lorem', 3, 1),
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
(2, 11, 'Fini', '2022-06-16 03:33:11', '2022-06-16 03:32:43'),
(1, 11, 'Fini', '2022-06-16 02:53:59', '2022-06-16 02:52:10'),
(1, 16, 'Non Acceptée', '2022-06-16 02:16:21', '2022-06-16 02:15:22'),
(1, 17, 'Acceptée', '2022-06-16 02:16:20', '2022-06-16 02:15:13');

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rapport`
--

INSERT INTO `rapport` (`ID_RAPP`, `FICHIER`, `ID_STAGE`) VALUES
(17, '../uploads/rapport/CONDITIONS_D_ADMISSION_EN_CYCLE_INGENIEUR.pdf', 45),
(18, '../uploads/rapport/Partiel   (Mai .2017)..pdf', 46);

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
  `STATUSTG` int(11) NOT NULL DEFAULT '1',
  `DATEDEBUT_STAGE` timestamp NULL DEFAULT NULL,
  `NOTENCAD_ENTREP` float DEFAULT NULL,
  `NOTENCAD` float DEFAULT NULL,
  `CONTRAT` varchar(100) DEFAULT NULL,
  `NIVEAU_STAGE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_STAGE`),
  KEY `FK_ENCADRER` (`ID_ENS`),
  KEY `FK_PEUT_DEVENIR` (`ID_OFFRE`),
  KEY `FK_STAGIER` (`ID_ETU`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`ID_STAGE`, `ID_OFFRE`, `ID_ENS`, `ID_ETU`, `STATUSTG`, `DATEDEBUT_STAGE`, `NOTENCAD_ENTREP`, `NOTENCAD`, `CONTRAT`, `NIVEAU_STAGE`) VALUES
(43, 17, NULL, 1, 1, '2022-06-16 02:16:31', NULL, NULL, '../uploads/Contracts/Contract1-17.pdf', 3),
(45, 11, NULL, 1, 2, '2022-06-16 02:54:08', NULL, NULL, '../uploads/Contracts/Contract1-11.pdf', 3),
(46, 11, NULL, 2, 2, '2022-06-16 03:33:16', NULL, NULL, '../uploads/Contracts/Contract2-11.pdf', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `PICTURE` varchar(250) DEFAULT NULL,
  `ACTIVE` int(11) NOT NULL,
  `VERIFIED` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

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
(13, 'Hassan@gmail.com', 'hehe111', '../uploads/pdp/302340_257908.jpg', 1, 1),
(15, 'admin1', 'admin1123', NULL, 1, 1);

DELIMITER $$
--
-- Évènements
--
DROP EVENT `Closing_Offre`$$
CREATE DEFINER=`root`@`localhost` EVENT `Closing_Offre` ON SCHEDULE EVERY 1 DAY STARTS '2022-05-28 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE offre  SET STATUOFFRE="Closed" WHERE DATEFIN=CURRENT_DATE$$

DROP EVENT `Accept_Delay`$$
CREATE DEFINER=`root`@`localhost` EVENT `Accept_Delay` ON SCHEDULE EVERY 1 DAY STARTS '2022-05-28 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE postuler SET STATU="Non Acceptée" WHERE STATU='Retenue' AND DATE_ADD(DATEREPONS, INTERVAL 10 DAY) =CURRENT_DATE$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
