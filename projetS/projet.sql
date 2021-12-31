-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 déc. 2021 à 14:46
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
-- Base de données : `projet`
--
CREATE DATABASE IF NOT EXISTS `projet` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projet`;

-- --------------------------------------------------------

--
-- Structure de la table `categoriequestion`
--

DROP TABLE IF EXISTS `categoriequestion`;
CREATE TABLE IF NOT EXISTS `categoriequestion` (
  `idCategorie` int(2) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categoriequestion`
--

INSERT INTO `categoriequestion` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Develppement Web'),
(2, 'Developpement'),
(3, 'Entreprise'),
(4, 'Systemes d\'exploitation'),
(5, 'Design'),
(6, 'Materiels et Logiciels'),
(7, 'Jeux Video'),
(8, 'Sciences'),
(9, 'Communaute des zeros'),
(10, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `nomImage` varchar(50) NOT NULL,
  PRIMARY KEY (`idImage`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`idImage`, `nomImage`) VALUES
(1, 'img1.png'),
(2, 'img2.png'),
(3, 'img3.png'),
(4, 'img4.png'),
(5, 'img5.png'),
(6, 'img6.png'),
(7, 'img7.png'),
(8, 'img8.png'),
(9, 'img9.png'),
(10, 'img10.png'),
(11, 'img11.png'),
(12, 'img12.png'),
(13, 'img13.png'),
(14, 'img14.png'),
(15, 'img15.png'),
(16, 'img16.png'),
(17, 'img17.png'),
(18, 'img18.png'),
(19, 'img19.png'),
(20, 'img20.png'),
(21, 'img21.png'),
(22, 'img22.png'),
(23, 'img23.png'),
(24, 'img24.png'),
(25, 'img25.png'),
(26, 'img26.png'),
(27, 'img27.png'),
(28, 'img28.png'),
(29, 'img29.png'),
(30, 'img30.png'),
(31, 'img31.png'),
(32, 'img32.png'),
(33, 'img33.png'),
(34, 'img34.png'),
(35, 'img35.png'),
(36, 'img36.png'),
(37, 'img37.png'),
(38, 'img38.png'),
(39, 'img39.png'),
(40, 'img40.png'),
(41, 'img41.png'),
(42, 'img42.png'),
(43, 'img43.png'),
(44, 'img44.png'),
(45, 'img45.png'),
(46, 'img46.png'),
(47, 'img47.png'),
(48, 'img48.png'),
(49, 'img49.png'),
(50, 'img50.png'),
(51, 'img51.png');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `idMembre` int(10) NOT NULL AUTO_INCREMENT,
  `pseudoMembre` varchar(50) NOT NULL,
  `emailMembre` varchar(100) NOT NULL,
  `mdpMembre` varchar(8) NOT NULL,
  `jetonRecuperationMdp` varchar(8) DEFAULT NULL,
  `dateDemandeReintialisationMdp` datetime DEFAULT NULL,
  `rangMembre` varchar(1) NOT NULL,
  `nomMembre` varchar(50) NOT NULL,
  `prenomMembre` varchar(50) NOT NULL,
  `ddnMembre` date NOT NULL,
  `pdpMembre` int(3) NOT NULL,
  PRIMARY KEY (`idMembre`),
  UNIQUE KEY `emailMembre` (`emailMembre`),
  UNIQUE KEY `pseudoMembre` (`pseudoMembre`),
  KEY `fk_MembreImage` (`pdpMembre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`idMembre`, `pseudoMembre`, `emailMembre`, `mdpMembre`, `jetonRecuperationMdp`, `dateDemandeReintialisationMdp`, `rangMembre`, `nomMembre`, `prenomMembre`, `ddnMembre`, `pdpMembre`) VALUES
(1, 'admin ', 'admin@gmail.com', 'mdpadmin', NULL, NULL, 'A', 'admin', 'admin', '2001-12-27', 2),
(2, 'fatmaBS', 'fatmaBensalem@gmail.com', '12345678', NULL, NULL, 'C', 'Ben Saleh', 'Fatma', '2000-06-02', 10),
(3, 'SamiA', 'SamiAttaoui5@gmail.com', 'azertyui', NULL, NULL, 'C', 'Attaoui', 'Sami', '2001-11-21', 46),
(4, 'NarjessB', 'narjesBH@gmail.com', 'mdpnarjs', NULL, NULL, 'C', 'Barhoumi', 'Narjess', '1998-08-20', 5),
(6, 'MohamedA', 'Mohamedali02@gmail.com', '13243546', NULL, NULL, 'C', 'Ben Othmen', 'Mohamed Ali', '2002-11-25', 50),
(7, 'TmariemT', 'MariemTT@gmail.com', 'IJNUHBYG', NULL, NULL, 'C', 'Toumi', 'Mariem', '1999-02-10', 27),
(10, 'SamehM', 'MechSameh@gmail.com', 'motdepse', NULL, NULL, 'C', 'Mechmech', 'Sameh', '1975-12-08', 18);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `idQuestion` int(10) NOT NULL AUTO_INCREMENT,
  `idPoserQuestion` int(10) NOT NULL,
  `categorieQuestion` int(2) NOT NULL,
  `objetQuestion` varchar(50) NOT NULL,
  `contenuQuestion` text NOT NULL,
  `dateQuestion` datetime NOT NULL,
  PRIMARY KEY (`idQuestion`),
  KEY `fk_QuestionMembre` (`idPoserQuestion`),
  KEY `fk_QuestionCategorie` (`categorieQuestion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`idQuestion`, `idPoserQuestion`, `categorieQuestion`, `objetQuestion`, `contenuQuestion`, `dateQuestion`) VALUES
(1, 2, 1, 'erreur phpmyadmin', 'bonjour j\'essaye de créer des tables dans ma BD à l\'aide de myPHPAdmin mais depuis cette erreur \'#1215 - Impossible d\'ajouter des contraintes d\'index externe\' est générée. j\'ai l\'impression que c\'est un problème de type car lorsque j\'ai utilisé le type \"integer\" à la place de \"décimal\", je n\'avais pas cette  erreur. Merci de votre aide', '2021-11-26 20:25:34'),
(2, 6, 2, 'question progammation en c', 'Faut-il caster le retour des fonctions d\'allocation dynamique ?\r\nmerci.', '2021-10-12 17:42:13'),
(3, 4, 5, 'objetQ', 'question question question question', '2021-12-22 22:11:29'),
(4, 7, 8, 'objetQS', 'question science ', '2021-12-31 14:24:49'),
(5, 10, 3, 'Objet entreprise', 'comment creer une entreprise?', '2021-12-31 14:38:41');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `idReponse` int(10) NOT NULL AUTO_INCREMENT,
  `idDonnerReponse` int(10) NOT NULL,
  `idQuestion` int(10) NOT NULL,
  `contenuReponse` text NOT NULL,
  `dateReponse` datetime NOT NULL,
  PRIMARY KEY (`idReponse`),
  KEY `fk_ReponseMembre` (`idDonnerReponse`),
  KEY `fk_ReponseQuestion` (`idQuestion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`idReponse`, `idDonnerReponse`, `idQuestion`, `contenuReponse`, `dateReponse`) VALUES
(1, 3, 2, 'On voit beaucoup de programmeurs qui castent la valeur de retour de malloc / calloc / realloc, pourtant en C ce n\'est pas nécessaire. En effet, les fonctions d\'allocation dynamique retournent une valeur de type void*, ce qui fait qu\'elle peut être convertie implicitement dans n\'importe quel type : il n\'est donc pas nécessaire de caster.\r\nSi cependant votre code refuse de compiler en vous sortant une erreur du type \"invalid conversion from \'nom du type\' to \'void*\'\" c\'est que vous compilez en C++, car contrairement au C les conversions implicites du type void* vers un autre type sont interdites.', '2021-11-28 09:52:43'),
(2, 4, 1, 'Bonjour,\r\nL\'erreur 1215 est d\\\'après la doc. : \"Cannot add foreign key constraint\"\r\nDonc en gros tu regardes la création de tes foreign key', '2021-11-27 20:42:43'),
(3, 7, 1, 'reponse reponse reponse', '2021-12-31 14:25:14'),
(5, 1, 3, 'REPONSE ADMIN', '2021-12-31 14:32:08'),
(6, 10, 3, 'reponse de ma part', '2021-12-31 14:39:26');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `question`
--
ALTER TABLE `question` ADD FULLTEXT KEY `fulltextQ` (`objetQuestion`,`contenuQuestion`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse` ADD FULLTEXT KEY `fulltextR` (`contenuReponse`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `fk_MembreImage` FOREIGN KEY (`pdpMembre`) REFERENCES `image` (`idImage`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_QuestionCategorie` FOREIGN KEY (`categorieQuestion`) REFERENCES `categoriequestion` (`idCategorie`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_QuestionMembre` FOREIGN KEY (`idPoserQuestion`) REFERENCES `membre` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `fk_ReponseMembre` FOREIGN KEY (`idDonnerReponse`) REFERENCES `membre` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ReponseQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
