-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 06 Mai 2021 à 08:34
-- Version du serveur :  10.1.41-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tp_php2`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `nomCategorie` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Jeux vidéo & consoles'),
(2, 'Informatique & bureau'),
(3, 'Livres'),
(4, 'Musique, DVD & Blu-ray');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `nomClient` varchar(500) NOT NULL,
  `prenomClient` varchar(500) NOT NULL,
  `emailClient` varchar(500) NOT NULL,
  `motDePasseClient` varchar(1000) NOT NULL,
  `rueClient` varchar(1000) NOT NULL,
  `cpClient` varchar(10) NOT NULL,
  `villeClient` varchar(500) NOT NULL,
  `telClient` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `emailClient`, `motDePasseClient`, `rueClient`, `cpClient`, `villeClient`, `telClient`) VALUES
(7, 'Cyril', 'Galaud', 'cyrilgalaud@gmail.com', '$2y$10$o8sBGZvtumzjryUQRzZN/.uFwe9PrjWoAZBZWKwOyyAeJN/ot6q4q', '10 rue des quenouille', '66669', 'Valalala', '0618181818'),
(8, 'Brice', 'Fernansdez', 'fernandez.brice@gmail.com', '$2y$10$BXn/iMsRwm/EA28B1UBZPuRa/HMAkzHqMhTkohLUEP77/4AKjQPoO', '85 Avenue des Bananes', '42666', 'Mehmet', '0572581574'),
(9, 'Baudry', 'Thomas', 'thomasbaudry@gmail.com', '$2y$10$NNVjn1YzWB.gqzPkF6KrvuMUkVJtU3/hopq8QnNmbXSwXPIpkO57.', '85 Avenue des Bananes', '42666', 'Mehmet', '0605040302'),
(10, 'azr', 'azer', 'o@o.o', '$2y$10$36CQxOikRJztpGKNv.dn3uCs/Czq6My/GMtE6pgLueiwtZK04b9Bm', 'sert', '0434', 'trhu', '057573773');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `numeroCommande` int(11) NOT NULL,
  `dateCommande` date NOT NULL,
  `idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`numeroCommande`, `dateCommande`, `idClient`) VALUES
(10, '2020-11-13', 9),
(11, '2020-11-13', 9),
(12, '2020-11-13', 9);

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

CREATE TABLE `commander` (
  `numeroCommande` int(11) NOT NULL,
  `codeProduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commander`
--

INSERT INTO `commander` (`numeroCommande`, `codeProduit`, `quantite`) VALUES
(10, 1, 1),
(11, 6, 4),
(11, 8, 5),
(12, 1, 10),
(12, 11, 3);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `codeProduit` int(11) NOT NULL,
  `designationProduit` varchar(500) NOT NULL,
  `prixProduit` decimal(10,2) NOT NULL,
  `stockProduit` int(11) NOT NULL,
  `photoProduit` varchar(1000) NOT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`codeProduit`, `designationProduit`, `prixProduit`, `stockProduit`, `photoProduit`, `idCategorie`) VALUES
(1, 'Skidamarink (Guillaume Musso)', '19.90', 39, '71aaz7oUpBL._AC._SR360,460.jpg', 3),
(2, 'Le Crépuscule et l\'Aube (Ken FOLLETT)', '24.50', 35, '514fHMab5eL._SX316_BO1,204,203,200_.jpg', 3),
(3, 'D\'un monde à l\'autre: Le temps des consciences (de Frédéric Lenoir, Nicolas Hulot)', '21.50', 64, '41vbzQVGIOL._SX311_BO1,204,203,200_.jpg', 3),
(4, 'SanDisk Carte Mémoire MicroSDHC Ultra 128 Go + Adaptateur SD Classe 10, U1, Homologuée A1', '30.39', 197, '617NtexaW2L._AC_SL1500_.jpg', 2),
(5, 'Logitech Webcam C920 HD Pro, Appels et Enregistrements Vidéo Full HD 1080p, Gaming Stream, Deux Microphones, Petite, Agile, Réglable, Noir', '109.00', 32, '51r+t90LYxL._AC_SL1023_.jpg', 2),
(6, 'Samsung SSD Interne 860 EVO 2.5\" (500 Go) - MZ-76E500B/EU', '70.12', 250, '91JA5-hAnoL._AC_SL1500_.jpg', 2),
(7, 'Corsair HS35 Casque de Gaming Stéréo', '43.65', 20, '619v-GUF7tL._AC._SR360,460.jpg', 1),
(8, 'Razer Wolverine Ultimate for Xbox One - Manette de Jeu pour Xbox One ', '179.99', 230, '618f9UKaVmL._AC._SR360,460.jpg', 1),
(9, 'Sign O’ The Times-Deluxe Edition 3CD', '19.99', 15, 'A1bbWtAHUtL._AC._SR360,460.jpg', 4),
(10, 'Batman - The Dark Knight, le Chevalier Noir - 4K Ultra HD', '20.00', 164, '81jSFtA8LOL._AC._SR360,460.jpg', 4),
(11, 'Game Of Thrones (Le Trône de Fer) - Saison 8', '39.99', 95, '71-we6++h2L._AC._SR360,460.jpg', 4);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`numeroCommande`),
  ADD KEY `commande_client_FK` (`idClient`);

--
-- Index pour la table `commander`
--
ALTER TABLE `commander`
  ADD PRIMARY KEY (`numeroCommande`,`codeProduit`),
  ADD KEY `commander_produit0_FK` (`codeProduit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`codeProduit`),
  ADD KEY `produit_categorie_FK` (`idCategorie`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `numeroCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `codeProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_client_FK` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`);

--
-- Contraintes pour la table `commander`
--
ALTER TABLE `commander`
  ADD CONSTRAINT `commander_commande_FK` FOREIGN KEY (`numeroCommande`) REFERENCES `commande` (`numeroCommande`),
  ADD CONSTRAINT `commander_produit0_FK` FOREIGN KEY (`codeProduit`) REFERENCES `produit` (`codeProduit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie_FK` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
