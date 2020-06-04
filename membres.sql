-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 04 juin 2020 à 17:07
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `membres`
--

-- --------------------------------------------------------

--
-- Structure de la table `table_membres`
--

CREATE TABLE "table_membres" (
  "id" int(11) NOT NULL,
  "username" varchar(255) NOT NULL,
  "email" varchar(255) NOT NULL,
  "password" text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `table_membres`
--

INSERT INTO "table_membres" ("id", "username", "email", "password") VALUES
(17, 'GUI35', 'mae@gmail.com', '$2y$10$fpDdGvx6DjAshVv/mIDpI..0GbcN0fPUrLOavLkH8xFKHXcCndHl6'),
(18, 'test2', 'david@david.com', '$2y$10$7YMI/bP.2O4gClNojVEZ7uFGIim4SFPqON/M7jmXl/SXsLdvfw2NC'),
(19, 'robert', 'mae@gmail.com', '$2y$10$f7nKk0HKF7mlGrF3XOcWbORmTF.594Wcp7fXAnXuBPDb8uTNNdNR.'),
(20, 'aaeze', 'mae@gmail.com', '$2y$10$gio6my0YzaDMgmVMHh.FNuZB5.pxn2Q4gwKPdNbAO.C/mq.3regTm'),
(21, 'david', 'test2@test.com', '$2y$10$zS48OFUAFOqFLSMZM8XNI.gU2MtmForUM2ug8QiJtTxdPt8ldKufO'),
(22, 'utilisateur1', 'utilisateur1@gmail.com', '$2y$10$opoXWO.fDylv518u2vsloubESqJo/lFZ6/zrX3WYXvZu.uKOhPCU6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `table_membres`
--
ALTER TABLE "table_membres"
  ADD PRIMARY KEY ("id");

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `table_membres`
--
ALTER TABLE "table_membres"
  MODIFY "id" int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
