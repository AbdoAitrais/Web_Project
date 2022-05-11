-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 11 mai 2022 à 09:36
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
  `LOGIN_ADMIN` varchar(25) DEFAULT NULL,
  `PASS_ADMIN` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID_ADMIN`)
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
  KEY `FK_ATTENTE2` (`ID_OFFRE`),
  KEY `FK_ATTENTE` (`ID_ETU`)
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `ID_ENS` int(11) NOT NULL,
  `ID_DEPART` int(11) NOT NULL,
  `NOM_ENS` varchar(25) DEFAULT NULL,
  `PRENOM_ENS` varchar(25) DEFAULT NULL,
  `CIN_ENS` varchar(15) DEFAULT NULL,
  `DATENAISS_ENS` date DEFAULT NULL,
  `NUMTEL_ENS` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ENS`),
  KEY `FK_FAIRE_PARTIE_DE` (`ID_DEPART`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `LOGIN_ETU` varchar(25) DEFAULT NULL,
  `PASS_ETU` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID_ETU`),
  KEY `FK_APPARTENIR` (`ID_FORM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `LOGIN_RESP` varchar(25) DEFAULT NULL,
  `PASS_RESP` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID_FORM`),
  KEY `FK_GERER2` (`ID_ENS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  KEY `FK_JURI2` (`ID_STAGE`),
  KEY `FK_JURI1` (`ID_ENS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

DROP TABLE IF EXISTS `motcle`;
CREATE TABLE IF NOT EXISTS `motcle` (
  `id_motcle` int(11) NOT NULL AUTO_INCREMENT,
  `mot` varchar(20) NOT NULL,
  PRIMARY KEY (`id_motcle`)
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
  `DESCRIP` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`ID_OFFRE`),
  KEY `FK_CONCERNER` (`ID_FORM`),
  KEY `FK_PRESENTER` (`ID_ENTREP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  UNIQUE KEY `FK_POSTULER` (`ID_ETU`),
  KEY `FK_POSTULER2` (`ID_OFFRE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

DROP TABLE IF EXISTS `rapport`;
CREATE TABLE IF NOT EXISTS `rapport` (
  `ID_RAPP` int(11) NOT NULL AUTO_INCREMENT,
  `FICHIER` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_RAPP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `referencer`
--

DROP TABLE IF EXISTS `referencer`;
CREATE TABLE IF NOT EXISTS `referencer` (
  `id_motcle` int(11) NOT NULL,
  `id_rapp` int(11) NOT NULL,
  PRIMARY KEY (`id_motcle`,`id_rapp`),
  KEY `FK_REFERENCE1` (`id_motcle`),
  KEY `FK_REFERENCE2` (`id_rapp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `ID_STAGE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ENTREP` int(11) NOT NULL,
  `ID_RAPP` int(11) DEFAULT NULL,
  `ID_ENS` int(11) NOT NULL,
  `ID_ETU` int(11) NOT NULL,
  `POSTE` varchar(30) DEFAULT NULL,
  `DUREE` int(11) DEFAULT NULL,
  `DESCRIP` varchar(300) DEFAULT NULL,
  `DATEREPONS` date DEFAULT NULL,
  `DATEPOST` date DEFAULT NULL,
  `NOTENCAD_ENTREP` float DEFAULT NULL,
  `NOTENCAD` float DEFAULT NULL,
  `CONTRAT` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_STAGE`),
  KEY `FK_CORRESPONDRE2` (`ID_RAPP`),
  KEY `FK_ENCADRER` (`ID_ENS`),
  KEY `FK_PRESENTER_PAR` (`ID_ENTREP`),
  KEY `FK_STAGIER` (`ID_ETU`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
