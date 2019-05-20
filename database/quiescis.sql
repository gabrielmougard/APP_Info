-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 20 mai 2019 à 08:01
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `quiescis`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartement`
--

CREATE TABLE `appartement` (
  `idAppartement` int(10) UNSIGNED NOT NULL,
  `adresse` longtext NOT NULL,
  `superficie` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `appartement`
--

INSERT INTO `appartement` (`idAppartement`, `adresse`, `superficie`) VALUES
(1, 'DFGH', 233),
(2, 'adresse 0', 107),
(3, 'adresse 0', 49),
(4, 'adresse 0', 99),
(5, 'adresse 0', 71),
(6, 'adresse 0', 123);



--
-- Table structure for table `messagerie`
--

CREATE TABLE `messagerie` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idTicket` int(11) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `contenu` longtext NOT NULL,
  `emailUser` varchar(50) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `diem` varchar(255) NOT NULL,
  `tempus` int(11) NOT NULL,
  `ouvert` int(11) NOT NULL,
  `reply` int(11) NOT NULL
  PRIMARY  KEY (`idMessage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

CREATE TABLE `catalogue` (
  `idCatalogue` int(10) UNSIGNED NOT NULL,
  `datasheet` longtext NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prix` int(10) UNSIGNED NOT NULL,
  `reference` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(10) UNSIGNED NOT NULL,
  `categorie` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cemac`
--

CREATE TABLE `cemac` (
  `idCemac` int(11) NOT NULL,
  `numeroSerie` int(11) DEFAULT NULL,
  `idPiece` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cemac`
--

INSERT INTO `cemac` (`idCemac`, `numeroSerie`, `idPiece`) VALUES
(1, 50, 1),
(2, 51, 0);

-- --------------------------------------------------------

--
-- Structure de la table `composant`
--

CREATE TABLE `composant` (
  `idComposant` int(11) NOT NULL,
  `etatComposant` tinyint(1) DEFAULT '0',
  `numComposant` int(11) DEFAULT NULL,
  `idCemac` int(11) DEFAULT NULL,
  `idCatalogue` int(11) DEFAULT NULL,
  `idTypeCapteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `composant`
--

INSERT INTO `composant` (`idComposant`, `etatComposant`, `numComposant`, `idCemac`, `idCatalogue`, `idTypeCapteur`) VALUES
(0, 1, 10, 1, 1, 1),
(1, 0, 1, 1, 1, 2),
(2, 1, 11, 1, 1, 0),
(3, 0, 12, 1, 1, 2),
(9, 0, 51, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `controlechauffage`
--

CREATE TABLE `controlechauffage` (
  `idUser` int(11) NOT NULL,
  `idChauffage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `parametre du site`
--

CREATE TABLE `parametre du site` (
  `idParametre` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `valeur` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE `piece` (
  `idPiece` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `idAppart` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`idPiece`, `nom`, `idAppart`) VALUES
(1, 'Cuisine', 1),
(2, 'Salle de concert', 2),
(4, 'Salle du trone', 3),
(5, 'Salle de sport', 3),
(6, 'Piece à la con', 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `idRole` int(11) NOT NULL,
  `principal` tinyint(1) DEFAULT '1',
  `secondaire` tinyint(1) DEFAULT '0',
  `idAppart` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idRole`, `principal`, `secondaire`, `idAppart`, `idUser`) VALUES
(8, 1, 0, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `systeme chauffage`
--

CREATE TABLE `systeme chauffage` (
  `idChauffage` int(10) UNSIGNED NOT NULL,
  `tempMaxGestionnaire` int(10) UNSIGNED NOT NULL,
  `tempMaxUtilisateur` int(10) UNSIGNED NOT NULL,
  `droitActivation` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `trameenvoi`
--

CREATE TABLE `trameenvoi` (
  `idEnvoi` int(11) NOT NULL,
  `val` int(11) DEFAULT NULL,
  `tim` int(11) DEFAULT NULL,
  `req` varchar(50) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `chk` varchar(20) DEFAULT NULL,
  `idComposant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trameenvoi`
--

INSERT INTO `trameenvoi` (`idEnvoi`, `val`, `tim`, `req`, `num`, `chk`, `idComposant`) VALUES
(1, 21, 50, NULL, NULL, NULL, 1),
(2, 23, 50, NULL, NULL, NULL, 2),
(3, 23, 50, NULL, NULL, NULL, 3),
(5, 23, 50, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `trameretour`
--

CREATE TABLE `trameretour` (
  `idRetour` int(11) NOT NULL,
  `ans` int(11) DEFAULT NULL,
  `req` varchar(50) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `chk` varchar(20) DEFAULT NULL,
  `idComposant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trameretour`
--

INSERT INTO `trameretour` (`idRetour`, `ans`, `req`, `num`, `chk`, `idComposant`) VALUES
(1, 30, NULL, 1, NULL, 0),
(2, 30, NULL, 1, NULL, 0),
(3, 31, NULL, 1, NULL, 0),
(4, 31, NULL, 1, NULL, 0),
(5, 31, NULL, 1, NULL, 0),
(6, 31, NULL, 1, NULL, 0),
(7, 31, NULL, 1, NULL, 0),
(8, 31, NULL, 1, NULL, 0),
(9, 31, NULL, 1, NULL, 0),
(10, 31, NULL, 1, NULL, 0),
(11, 30, NULL, 1, NULL, 0),
(12, 32, NULL, 12, NULL, 3),
(13, 30, NULL, 12, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `typecapteur`
--

CREATE TABLE `typecapteur` (
  `idTypeCapteur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `valeur` varchar(10) DEFAULT NULL,
  `grandeurPhysique` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typecapteur`
--

INSERT INTO `typecapteur` (`idTypeCapteur`, `nom`, `valeur`, `grandeurPhysique`) VALUES
(0, 'capteur_luminosite1', 'a1', 'lux'),
(1, 'capteur_temperature', 'b2', '°C'),
(2, 'Store', 'd4', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type utilisateur`
--

CREATE TABLE `type utilisateur` (
  `idType` int(10) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type utilisateur`
--

INSERT INTO `type utilisateur` (`idType`, `type`) VALUES
(1, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
  `idSession` int(11) DEFAULT NULL,
  `tokenCookie` varchar(100) DEFAULT NULL,
  `passwordHash` varchar(60) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `emailActive` tinyint(1) DEFAULT NULL,
  `emailToken` varchar(50) DEFAULT NULL,
  `derniereVerificationEmail` int(11) DEFAULT NULL,
  `emailTemporaire` varchar(50) DEFAULT NULL,
  `tokenEmailTemporaire` varchar(50) DEFAULT NULL,
  `photoProfil` varchar(100) DEFAULT NULL,
  `idType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `idSession`, `tokenCookie`, `passwordHash`, `nom`, `prenom`, `email`, `role`, `emailActive`, `emailToken`, `derniereVerificationEmail`, `emailTemporaire`, `tokenEmailTemporaire`, `photoProfil`, `idType`) VALUES
(0, NULL, NULL, '$2y$10$PE2XoK9RGav7gRuOu8oD5ebSRcEtckhPHyxAi7WO8paY5Wy8CG0iq', 'Gabriel', NULL, 'gabriel.mougard@gmail.com', 'user', 1, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartement`
--
ALTER TABLE `appartement`
  ADD PRIMARY KEY (`idAppartement`);

--
-- Index pour la table `catalogue`
--
ALTER TABLE `catalogue`
  ADD PRIMARY KEY (`idCatalogue`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `cemac`
--
ALTER TABLE `cemac`
  ADD PRIMARY KEY (`idCemac`);

--
-- Index pour la table `composant`
--
ALTER TABLE `composant`
  ADD PRIMARY KEY (`idComposant`);

--
-- Index pour la table `controlechauffage`
--
ALTER TABLE `controlechauffage`
  ADD PRIMARY KEY (`idUser`,`idChauffage`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appartement`
--
ALTER TABLE `appartement`
  MODIFY `idAppartement` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `trameenvoi`
  CHANGE COLUMN `tim` `tim` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;   

ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`idMessage`);
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
