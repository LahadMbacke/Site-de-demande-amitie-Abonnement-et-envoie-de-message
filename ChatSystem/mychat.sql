-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 01 nov. 2021 à 15:06
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mychat`
--

-- --------------------------------------------------------

--
-- Structure de la table `amitie`
--

CREATE TABLE `amitie` (
  `id` int(11) NOT NULL,
  `demendeur` int(11) DEFAULT NULL,
  `cible` int(11) DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `datedebut` date DEFAULT curdate(),
  `id_bloquee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `amitie`
--

INSERT INTO `amitie` (`id`, `demendeur`, `cible`, `etat`, `datedebut`, `id_bloquee`) VALUES
(207, 5, 9, 1, '2021-11-01', NULL),
(211, 5, 7, 0, '2021-11-01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `Idmembre` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `sexe` varchar(15) DEFAULT NULL,
  `mdpasse` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `statut` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`Idmembre`, `nom`, `prenom`, `login`, `sexe`, `mdpasse`, `photo`, `statut`) VALUES
(5, 'Mbacke', 'Lahad', 'lahad@', 'Masculin', '123', 'MesPhotos/13092021_134230_profil.jpeg', NULL),
(6, 'fall', 'fallou', 'fallou@', 'Masculin', '123', 'MesPhotos/13092021_135215_ucad.png', NULL),
(7, 'Aidarra', 'marieme', 'Mariem@', 'Feminin', '321', 'MesPhotos/13092021_135259_virgil-van-dijk-.jpg', NULL),
(8, 'mbacke', 'saliou', 'saliou@', 'Masculin', '1234', 'MesPhotos/13092021_194705_inff.jpg', NULL),
(9, 'Mbaye', 'Malcom', 'malcom@', 'Masculin', '321', 'MesPhotos/29102021_143507_ucad.png', NULL),
(10, 'Seck', 'Baye', 'seck@', 'Masculin', '321', 'MesPhotos/31102021_155308_cv.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `Idmessage` int(11) NOT NULL,
  `contenu` varchar(255) DEFAULT NULL,
  `dateHeur` datetime DEFAULT NULL,
  `emetteur` int(11) DEFAULT NULL,
  `destinataire` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`Idmessage`, `contenu`, `dateHeur`, `emetteur`, `destinataire`, `photo`) VALUES
(33, 'lahad', '2021-10-31 05:32:09', 10, 5, NULL),
(34, 'salau', '2021-10-31 05:32:14', 10, 5, NULL),
(35, '', '2021-10-31 05:32:23', 10, 5, 'mesphotosMsg/311021_053223_virgil-van-dijk-.jpg'),
(36, 'lahad', '2021-10-31 05:32:35', 10, 5, 'mesphotosMsg/311021_053235_cv.png'),
(37, 'cvvv', '2021-10-31 05:35:36', 5, 10, NULL),
(38, 'xlolal photo bii', '2021-10-31 05:36:06', 5, 10, 'mesphotosMsg/311021_053606_inff.jpg'),
(39, 'ay wway rafetna d', '2021-10-31 05:36:37', 10, 5, NULL),
(40, 'merciii', '2021-10-31 05:36:47', 5, 10, NULL),
(41, 'ggg', '2021-10-31 06:57:51', 10, 6, NULL),
(42, 'ggg', '2021-10-31 06:58:37', 10, 6, NULL),
(43, 'ggg', '2021-10-31 07:01:28', 10, 6, NULL),
(44, 'cva', '2021-11-01 12:40:53', 10, 9, NULL),
(45, 'silone', '2021-11-01 12:41:20', 10, 9, NULL),
(46, 'c lahad', '2021-11-01 12:42:04', 9, 10, 'mesphotosMsg/011121_124204_profil.jpeg'),
(47, 'oui cmt tu vaa', '2021-11-01 12:42:26', 10, 9, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amitie`
--
ALTER TABLE `amitie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_demend` (`demendeur`),
  ADD KEY `FK_cible` (`cible`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`Idmembre`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Idmessage`),
  ADD KEY `FK_emett` (`emetteur`),
  ADD KEY `FK_dest` (`destinataire`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amitie`
--
ALTER TABLE `amitie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `Idmembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `Idmessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amitie`
--
ALTER TABLE `amitie`
  ADD CONSTRAINT `FK_cible` FOREIGN KEY (`cible`) REFERENCES `membre` (`Idmembre`),
  ADD CONSTRAINT `FK_demend` FOREIGN KEY (`demendeur`) REFERENCES `membre` (`Idmembre`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_dest` FOREIGN KEY (`destinataire`) REFERENCES `membre` (`Idmembre`),
  ADD CONSTRAINT `FK_emett` FOREIGN KEY (`emetteur`) REFERENCES `membre` (`Idmembre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
