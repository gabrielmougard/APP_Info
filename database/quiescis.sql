-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 21 mai 2019 à 16:08
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.1

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
(6, 'adresse 0', 123),
(8, 'adresse 2', 102),
(9, 'adresse 4', 163),
(10, 'adresse 4', 198),
(433732247, 'efz', 0),
(2053000746, 'efz', 0),
(10004649, 'efz', 0),
(1293611345, 'efz', 0),
(1603130036, 'efz', 0),
(1731645722, 'efz', 0),
(979531906, 'efz', 0),
(1368272483, 'efz', 0),
(994119077, 'efz', 0),
(595853817, 'efz', 0),
(9453696, 'adresse 5', 54),
(476658401, 'adresse 5', 54),
(2053000747, 'adresse 5', 173),
(2053000748, 'adresse 6', 182);

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

CREATE TABLE `catalogue` (
  `idCatalogue` int(10) NOT NULL,
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
(2, 51, 0),
(3, 12345, 2049881344),
(4, 0, 1779740570);

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
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `idMessage` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `contenu` longtext NOT NULL,
  `emailUser` varchar(50) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `ouvert` int(11) NOT NULL,
  `reply` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `parametre_du_site`
--

CREATE TABLE `parametre_du_site` (
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
(6, 'Piece à la con', 1),
(1779740570, 'gabriel', 9),
(2049881344, 'Cuisine', 8);

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
(8, 1, 0, 4, 0),
(10, 1, 0, 8, 2),
(11, 1, 0, 9, 4),
(12, 1, 0, 10, 4),
(13, 1, 0, 433732247, 1),
(14, 1, 0, 2053000746, 1),
(15, 1, 0, 10004649, 1),
(16, 1, 0, 1293611345, 1),
(17, 1, 0, 1603130036, 1),
(18, 1, 0, 1731645722, 1),
(19, 1, 0, 979531906, 1),
(20, 1, 0, 1368272483, 1),
(21, 1, 0, 994119077, 1),
(22, 1, 0, 595853817, 1),
(23, 1, 0, 9453696, 1),
(24, 1, 0, 476658401, 1),
(25, 1, 0, 2053000747, 5),
(26, 1, 0, 2053000748, 6);

-- --------------------------------------------------------

--
-- Structure de la table `systeme_chauffage`
--

CREATE TABLE `systeme_chauffage` (
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
  `tim` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `req` varchar(50) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `chk` varchar(20) DEFAULT NULL,
  `idComposant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trameenvoi`
--

INSERT INTO `trameenvoi` (`idEnvoi`, `val`, `tim`, `req`, `num`, `chk`, `idComposant`) VALUES
(1, 21, '0000-00-00 00:00:00', NULL, NULL, NULL, 1),
(2, 23, '0000-00-00 00:00:00', NULL, NULL, NULL, 2),
(3, 23, '0000-00-00 00:00:00', NULL, NULL, NULL, 3),
(5, 23, '0000-00-00 00:00:00', NULL, NULL, NULL, 0);

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
-- Structure de la table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `idType` int(10) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`idType`, `type`) VALUES
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
(4, NULL, NULL, '$2y$10$wDIGNH6cVrXzIb.z/Lx7oO9wlyWV4aPnqNXQvSGjNzyUUQ8TKoLOW', 'Test', NULL, 'vicosinge@gmail.com', 'user', 1, '97d1d035ff4851a458789c5877200b1a10316fd4', NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, '$2y$10$QQCEd0v2/NVEf563ROMVuem0x/3SGk06z8xwEH6M3y.o/jVNF7jhq', 'gab', NULL, 'gabriel.mougard@gmail.com', 'user', 1, NULL, NULL, NULL, NULL, NULL, NULL);

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
  ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `parametre_du_site`
--
ALTER TABLE `parametre_du_site`
  ADD PRIMARY KEY (`idParametre`);

--
-- Index pour la table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`idPiece`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `systeme_chauffage`
--
ALTER TABLE `systeme_chauffage`
  ADD PRIMARY KEY (`idChauffage`);

--
-- Index pour la table `trameenvoi`
--
ALTER TABLE `trameenvoi`
  ADD PRIMARY KEY (`idEnvoi`);

--
-- Index pour la table `trameretour`
--
ALTER TABLE `trameretour`
  ADD PRIMARY KEY (`idRetour`);

--
-- Index pour la table `typecapteur`
--
ALTER TABLE `typecapteur`
  ADD PRIMARY KEY (`idTypeCapteur`);

--
-- Index pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`idType`);

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
  MODIFY `idAppartement` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2053000749;

--
-- AUTO_INCREMENT pour la table `catalogue`
--
ALTER TABLE `catalogue`
  MODIFY `idCatalogue` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cemac`
--
ALTER TABLE `cemac`
  MODIFY `idCemac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `composant`
--
ALTER TABLE `composant`
  MODIFY `idComposant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `controlechauffage`
--
ALTER TABLE `controlechauffage`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parametre_du_site`
--
ALTER TABLE `parametre_du_site`
  MODIFY `idParametre` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `piece`
--
ALTER TABLE `piece`
  MODIFY `idPiece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2049881345;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `systeme_chauffage`
--
ALTER TABLE `systeme_chauffage`
  MODIFY `idChauffage` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `trameenvoi`
--
ALTER TABLE `trameenvoi`
  MODIFY `idEnvoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `trameretour`
--
ALTER TABLE `trameretour`
  MODIFY `idRetour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `typecapteur`
--
ALTER TABLE `typecapteur`
  MODIFY `idTypeCapteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `idType` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE utilisateurs ADD hashCookie VARCHAR(60)

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
