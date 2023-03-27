-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 nov. 2021 à 18:23
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
-- Base de données : `ghhh`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_historique`
--

DROP TABLE IF EXISTS `admin_historique`;
CREATE TABLE IF NOT EXISTS `admin_historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `action` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `apiplus`
--

DROP TABLE IF EXISTS `apiplus`;
CREATE TABLE IF NOT EXISTS `apiplus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `timeapi` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `apikey` varchar(300) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `api_historique`
--

DROP TABLE IF EXISTS `api_historique`;
CREATE TABLE IF NOT EXISTS `api_historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clef` varchar(300) NOT NULL,
  `username` varchar(15) NOT NULL,
  `value` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  `ip` varchar(150) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `blacklist`
--

DROP TABLE IF EXISTS `blacklist`;
CREATE TABLE IF NOT EXISTS `blacklist` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(50) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `code`
--

DROP TABLE IF EXISTS `code`;
CREATE TABLE IF NOT EXISTS `code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(15) NOT NULL,
  `code` varchar(15) NOT NULL,
  `plateforme` text NOT NULL,
  `prix` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `licence` varchar(90) NOT NULL,
  `statut` text NOT NULL,
  `username` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `informations`
--

DROP TABLE IF EXISTS `informations`;
CREATE TABLE IF NOT EXISTS `informations` (
  `nom` text NOT NULL,
  `url` text NOT NULL,
  `icon` text NOT NULL,
  `l7` int(11) NOT NULL,
  `l4` int(11) NOT NULL,
  `API` int(11) NOT NULL,
  `SHOP` int(11) NOT NULL,
  `addons` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `Auth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `informations`
--

INSERT INTO `informations` (`nom`, `url`, `icon`, `l7`, `l4`, `API`, `SHOP`, `addons`, `deposit`, `Auth`) VALUES
('Downthem.in', 'http://localhost.fr/', '/assets/images/favicon.ico', 1, 0, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `sold` double NOT NULL,
  `status` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `ip` varchar(256) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `loginlogs`
--

DROP TABLE IF EXISTS `loginlogs`;
CREATE TABLE IF NOT EXISTS `loginlogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  `ip` text NOT NULL,
  `date` int(11) NOT NULL,
  `country` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(15) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `port` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `timerst` int(11) NOT NULL,
  `method` varchar(15) NOT NULL,
  `serveur` int(11) NOT NULL,
  `note` text NOT NULL,
  `avis` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `ticketid` int(11) NOT NULL,
  `content` text NOT NULL,
  `sender` varchar(30) NOT NULL,
  `view` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`messageid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `methodes`
--

DROP TABLE IF EXISTS `methodes`;
CREATE TABLE IF NOT EXISTS `methodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `method` varchar(15) NOT NULL,
  `classement` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE IF NOT EXISTS `plans` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `mbt` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `length` int(11) NOT NULL,
  `nbr` int(11) NOT NULL,
  `api` int(11) NOT NULL,
  `eur` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `serveurs`
--

DROP TABLE IF EXISTS `serveurs`;
CREATE TABLE IF NOT EXISTS `serveurs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8 NOT NULL,
  `adresse` text NOT NULL,
  `client` int(11) NOT NULL,
  `concurrents` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `status` varchar(90) NOT NULL,
  `username` varchar(15) NOT NULL,
  `view` varchar(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `membership` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  `avatar` varchar(20) NOT NULL,
  `message` int(100) NOT NULL,
  `lastact` int(11) NOT NULL,
  `lastlogin` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `motifban` varchar(50) NOT NULL,
  `google` varchar(200) NOT NULL,
  `ah` int(1) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `secs` int(11) NOT NULL DEFAULT '0',
  `concu` int(11) NOT NULL DEFAULT '0',
  `qs` int(11) NOT NULL,
  `lastip` varchar(30) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
