-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 16 août 2019 à 14:34
-- Version du serveur :  5.7.25
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbPopup`
--

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
  `id` tinyint(3) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Likes`
--

CREATE TABLE `Likes` (
  `id` mediumint(8) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = like ; 0 = unlike',
  `user_Id` tinyint(3) NOT NULL,
  `photo_Id` tinyint(5) NOT NULL,
  `creationTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Photos`
--

CREATE TABLE `Photos` (
  `id` smallint(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT 'Optionnel',
  `type` varchar(10) NOT NULL,
  `size` int(10) NOT NULL,
  `lastModified` bigint(15) NOT NULL,
  `lastModifiedDate` varchar(30) NOT NULL,
  `webkitRelativePath` varchar(255) DEFAULT NULL,
  `creationTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publishDate` datetime DEFAULT NULL,
  `user_Id` tinyint(3) NOT NULL,
  `category_Id` tinyint(3) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Thumbnails`
--

CREATE TABLE `Thumbnails` (
  `id` smallint(5) NOT NULL,
  `150w` varchar(255) NOT NULL,
  `300w` varchar(255) NOT NULL,
  `500w` varchar(255) NOT NULL,
  `768w` varchar(255) NOT NULL,
  `1024w` varchar(255) NOT NULL,
  `creationTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo_Id` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `Id` tinyint(3) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Usermail` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Userpassword` varchar(255) NOT NULL,
  `CreationTimestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Photos`
--
ALTER TABLE `Photos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Thumbnails`
--
ALTER TABLE `Thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Photos`
--
ALTER TABLE `Photos`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Thumbnails`
--
ALTER TABLE `Thumbnails`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` tinyint(3) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
