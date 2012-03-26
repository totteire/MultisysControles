-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 23 Mars 2012 à 15:27
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `multisys`
--

-- --------------------------------------------------------

--
-- Structure de la table `APPAREIL`
--

CREATE TABLE IF NOT EXISTS `APPAREIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESIGNATION` varchar(60) DEFAULT NULL,
  `MARQUE` varchar(30) DEFAULT NULL,
  `TYPE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `APPAREIL`
--

INSERT INTO `APPAREIL` (`ID`, `DESIGNATION`, `MARQUE`, `TYPE`) VALUES
(1, 'qsdf', 'qdsf', 'qsdf');

-- --------------------------------------------------------

--
-- Structure de la table `AVOIRPARDEFAUT`
--

CREATE TABLE IF NOT EXISTS `AVOIRPARDEFAUT` (
  `ID` int(11) NOT NULL,
  `ID_1` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ID_1`),
  KEY `I_FK_AVOIRPARDEFAUT_MOYEN_MESURE` (`ID`),
  KEY `I_FK_AVOIRPARDEFAUT_PARAMETRE` (`ID_1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `AVOIRPARDEFAUT`
--

INSERT INTO `AVOIRPARDEFAUT` (`ID`, `ID_1`) VALUES
(4, 4),
(6, 4),
(7, 4),
(8, 4);

-- --------------------------------------------------------

--
-- Structure de la table `CLIENT`
--

CREATE TABLE IF NOT EXISTS `CLIENT` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(60) NOT NULL,
  `ADRESSE` varchar(60) DEFAULT NULL,
  `AD_VILLE` varchar(60) NOT NULL,
  `AD_CP` varchar(5) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOM` (`NOM`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Contenu de la table `CLIENT`
--

INSERT INTO `CLIENT` (`ID`, `NOM`, `ADRESSE`, `AD_VILLE`, `AD_CP`) VALUES
(30, '3 L FOUDRE', '8 CHEMIN DE LA GRAVIERE$', 'TOULOUSE', '31500'),
(31, 'ACEMIS France', '36, Rue ARISTIDE BERGES$', 'CUGNAUX', '31270'),
(33, 'CAP INGELEC', '11, ALLÃ‰E OLYMPE DE GOUGES$ZAC DES RAMASSIERS', 'COLOMIERS', '31770'),
(34, 'CAPTOMED', 'RUE DU CHENE VERT$ZI BOURGADE', 'LABEGE CEDEX', '31682'),
(39, 'CARTELEC', '1055 AVENUE GEORGES POMPIDOU$Z.I. DES CAZES', 'ST AFFRIQUE', '12400'),
(44, 'ARIA ELECTRONIQUE', 'ZONE INDUSTRIELLE$', 'ASTON', '09310'),
(45, 'CEGELEC ENTREPRISE SUD-OUEST DIRECTION REGIONALE', '11 IMPASSE DES ARENES$', 'TOULOUSE CEDEX 1', '31082'),
(46, 'CEGELEC ENTREPRISE SUD-OUEST AGENCE DE PAU', '21 RUE ROGER SALENGRO$BP 9029', 'PAU CEDEX 9', '64050'),
(47, 'CEGELEC ENTREPRISE SUD-OUEST AGENCE DE RODEZ', 'ZA LE PUECH$BP 10', 'RODEZ CEDEX 9', '12034'),
(49, 'CELIANS', '65 AVENUE DU Portugal$ALBASUD', 'MONTAUBAN CEDEX', '82006');

-- --------------------------------------------------------

--
-- Structure de la table `CONTROLE`
--

CREATE TABLE IF NOT EXISTS `CONTROLE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NUM` int(8) NOT NULL,
  `ID_CONCERNER` int(11) NOT NULL,
  `ID_AVOIR` int(11) NOT NULL,
  `TYPE_CTRL` varchar(4) NOT NULL,
  `DATE` date DEFAULT NULL,
  `TECHNICIEN` varchar(32) DEFAULT NULL,
  `LIEU` varchar(1) DEFAULT NULL,
  `JUGEMENT` int(1) DEFAULT NULL,
  `OBSERVATION` varchar(600) NOT NULL,
  `NUM_SERIE` varchar(20) DEFAULT NULL,
  `NUM_CHASSIS` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `I_FK_CONTROLE_APPAREIL` (`ID_CONCERNER`),
  KEY `I_FK_CONTROLE_CLIENT` (`ID_AVOIR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `MOYEN_MESURE`
--

CREATE TABLE IF NOT EXISTS `MOYEN_MESURE` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(70) NOT NULL,
  `NOM_VERIF` varchar(30) DEFAULT NULL,
  `NUM_DATE_VERIF` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `MOYEN_MESURE`
--

INSERT INTO `MOYEN_MESURE` (`ID`, `LIBELLE`, `NOM_VERIF`, `NUM_DATE_VERIF`) VALUES
(2, 'Cales Ã©talons 20mm NÂ°02197', 'COFRAC', 'NÂ°11081696 du 03/11'),
(3, 'Cales Ã©talons 100mm NÂ°03029', 'COFRAC', 'NÂ°11081696 du 03/11'),
(4, 'Calibrateur FLUKE 5500A NÂ° de sÃ©rie 8675008', 'COFRAC', 'NÂ° E12-057 du 02/12'),
(5, 'Calibrateur FLUKE 5500A NÂ° de sÃ©rie 8675008', 'COFRAC', 'NÂ° F12-016 du 02/12'),
(6, 'ChaÃ®ne de temp.COLE PARMER DIGI sense 92800', 'COFRAC', 'NÂ° 11.09.106T du 09/11'),
(7, 'FrÃ©quencemÃ¨tre RACAL DANA 9919 NÂ°de sÃ©rie 10446', 'COFRAC', 'NÂ° F11-112 du 08/11'),
(8, 'GÃ©nÃ©rateur ROHDE &SCHWARZ - SMT02', 'COFRAC', 'NÂ° E11-252 du 08/11'),
(9, 'GÃ©nÃ©rateur ROHDE &SCHWARZ - SMT02', 'COFRAC', 'NÂ° F11-111 du 08/11');

-- --------------------------------------------------------

--
-- Structure de la table `PARAMETRE`
--

CREATE TABLE IF NOT EXISTS `PARAMETRE` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `PARAMETRE`
--

INSERT INTO `PARAMETRE` (`ID`, `LIBELLE`) VALUES
(4, 'Amplitudes'),
(5, 'Bandes passantes'),
(6, 'CapacitÃ©s'),
(7, 'Compensations'),
(8, 'Comptage'),
(9, 'ContinuitÃ©'),
(10, 'Courants'),
(11, 'Dimensionnel'),
(12, 'Distorsion'),
(13, 'Eclairement'),
(14, 'Facteur de puissance'),
(15, 'FrÃ©quences'),
(16, 'Inductances');

-- --------------------------------------------------------

--
-- Structure de la table `UTILISER`
--

CREATE TABLE IF NOT EXISTS `UTILISER` (
  `ID` int(11) NOT NULL,
  `ID_1` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ID_1`),
  KEY `I_FK_UTILISER_CONTROLE` (`ID`),
  KEY `I_FK_UTILISER_MOYEN_MESURE` (`ID_1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `VERIFIER`
--

CREATE TABLE IF NOT EXISTS `VERIFIER` (
  `ID` int(11) NOT NULL,
  `ID_1` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ID_1`),
  KEY `I_FK_VERIFIER_CONTROLE` (`ID`),
  KEY `I_FK_VERIFIER_PARAMETRE` (`ID_1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `AVOIRPARDEFAUT`
--
ALTER TABLE `AVOIRPARDEFAUT`
  ADD CONSTRAINT `AVOIRPARDEFAUT_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `MOYEN_MESURE` (`ID`),
  ADD CONSTRAINT `AVOIRPARDEFAUT_ibfk_2` FOREIGN KEY (`ID_1`) REFERENCES `PARAMETRE` (`ID`);

--
-- Contraintes pour la table `CONTROLE`
--
ALTER TABLE `CONTROLE`
  ADD CONSTRAINT `CONTROLE_ibfk_1` FOREIGN KEY (`ID_CONCERNER`) REFERENCES `APPAREIL` (`ID`),
  ADD CONSTRAINT `CONTROLE_ibfk_2` FOREIGN KEY (`ID_AVOIR`) REFERENCES `CLIENT` (`ID`);

--
-- Contraintes pour la table `UTILISER`
--
ALTER TABLE `UTILISER`
  ADD CONSTRAINT `UTILISER_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `CONTROLE` (`ID`),
  ADD CONSTRAINT `UTILISER_ibfk_2` FOREIGN KEY (`ID_1`) REFERENCES `MOYEN_MESURE` (`ID`);

--
-- Contraintes pour la table `VERIFIER`
--
ALTER TABLE `VERIFIER`
  ADD CONSTRAINT `VERIFIER_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `CONTROLE` (`ID`),
  ADD CONSTRAINT `VERIFIER_ibfk_2` FOREIGN KEY (`ID_1`) REFERENCES `PARAMETRE` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
