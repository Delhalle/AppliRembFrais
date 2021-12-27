-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 déc. 2021 à 19:12
-- Version du serveur :  5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rembours_frais`
--

-- --------------------------------------------------------

--
-- Structure de la table `demande_remboursement`
--

DROP TABLE IF EXISTS `demande_remboursement`;
CREATE TABLE IF NOT EXISTS `demande_remboursement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_saisie` datetime DEFAULT NULL,
  `montant` decimal(10,0) NOT NULL,
  `commentaire` varchar(200) NOT NULL,
  `id_type_frais` int(11) NOT NULL,
  `id_delegue` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande_remboursement`
--

INSERT INTO `demande_remboursement` (`id`, `date_saisie`, `montant`, `commentaire`, `id_type_frais`, `id_delegue`) VALUES
(1, '2021-07-06 16:17:34', '12', 'frais de repas', 1, 4),
(2, '2021-07-08 11:04:28', '500', 'Invitation du responsable du CHU d\'Amiens', 3, 1),
(3, '2021-07-08 11:16:46', '650', '3 nuits lors du colloque de Nice sur les addictions', 2, 1),
(4, '2021-11-16 20:57:08', '502', 'Nuit d\'hôtel lors de la conférence du 05/05/2020', 2, 4),
(5, '2021-11-16 20:57:28', '125', 'Invitation de la secrétaire médical du Dr Virtigo', 3, 4),
(6, NULL, '987', 'Invitation de Mr.Hollande', 3, 1),
(7, '2021-12-10 11:27:51', '99', '|-__You\'v been hacked by Boosted__-|___', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnalite`
--

DROP TABLE IF EXISTS `fonctionnalite`;
CREATE TABLE IF NOT EXISTS `fonctionnalite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(75) NOT NULL,
  `libelle_menu_parent` varchar(50) NOT NULL,
  `libelle_menu_enfant` varchar(50) NOT NULL,
  `lien_menu` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fonctionnalite`
--

INSERT INTO `fonctionnalite` (`id`, `libelle`, `libelle_menu_parent`, `libelle_menu_enfant`, `lien_menu`) VALUES
(1, 'Modification du mot de passe', 'Utilisateur', 'Changer mot de passe', 'modifMdp'),
(2, 'Consultation des demandes de remboursement', 'Demande Remboursement', 'Voir demandes', 'consultTousRembour'),
(3, 'Modification d\'une demande de remboursement', 'Demande Remboursement', 'Modifier une demande', 'modifDemRembListeForm'),
(4, 'Ajout d\'un utilisateur', 'Utilisateur', 'Ajouter utilisateur', 'ajoutUtilisateurForm'),
(5, 'Saisie d\'une demande de remboursement de frais', 'Demande Remboursement', 'Ajouter demande', 'ajoutDemRembForm'),
(6, 'Consultation de son profil', 'Utilisateur', 'Voir mon profil', 'consultProfil'),
(7, 'Consultation des demandes de l\'utilisateur connecté', 'Demande Remboursement', 'Voir mes demandes', 'consultMesDemRemb'),
(8, 'Saisie d\'une formation suivie', 'Formation', 'Ajouter formation suivi', 'ajoutFormSuivi'),
(9, 'Consultation des formation suivi', 'Formation', 'Consultation formation suivi', 'consulFormSuiviList'),
(10, 'Modification d\'une formation suivi', 'Formation', 'Modification formation suivi', 'modifFormSuiviListeForm');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `formation`) VALUES
(1, 'formation en communication'),
(2, 'formation en anglais'),
(3, 'formation sur la gestion du stress');

-- --------------------------------------------------------

--
-- Structure de la table `formation_suivi`
--

DROP TABLE IF EXISTS `formation_suivi`;
CREATE TABLE IF NOT EXISTS `formation_suivi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_saisie` date NOT NULL,
  `commentaire` varchar(600) NOT NULL,
  `id_formation` int(11) NOT NULL,
  `id_delegue` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_formation` (`id_formation`),
  KEY `delegue_ibfk_2` (`id_delegue`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formation_suivi`
--

INSERT INTO `formation_suivi` (`id`, `date_saisie`, `commentaire`, `id_formation`, `id_delegue`) VALUES
(1, '2021-07-06', 'test modif 1', 2, 1),
(2, '2020-07-06', 'Test modif3', 3, 1),
(3, '2002-04-06', 'C\'est vraiment l\'une des meilleur formation que j\'ai effectué ! Surtout que je stress pour rien donc cette formation m\'a apporté que du bien !', 3, 4),
(4, '2021-12-20', 'test 4', 1, 1),
(5, '2021-12-26', 'C\'est trop nazzze', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `libelle`) VALUES
(1, 'Délégué'),
(2, 'Responsable comptabilité'),
(3, 'Responsable délégué'),
(4, 'Administrateur'),
(5, 'Responsable informatique');

-- --------------------------------------------------------

--
-- Structure de la table `profil_fonct`
--

DROP TABLE IF EXISTS `profil_fonct`;
CREATE TABLE IF NOT EXISTS `profil_fonct` (
  `id_profil` int(11) NOT NULL,
  `id_fonct` int(11) NOT NULL,
  PRIMARY KEY (`id_profil`,`id_fonct`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profil_fonct`
--

INSERT INTO `profil_fonct` (`id_profil`, `id_fonct`) VALUES
(1, 1),
(1, 3),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 10),
(2, 1),
(2, 2),
(2, 6),
(2, 9),
(3, 1),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `type_frais`
--

DROP TABLE IF EXISTS `type_frais`;
CREATE TABLE IF NOT EXISTS `type_frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_frais`
--

INSERT INTO `type_frais` (`id`, `libelle`) VALUES
(1, 'repas'),
(2, 'nuit d\'hôtel'),
(3, 'repas (invitation client)');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) NOT NULL,
  `prenom` varchar(35) NOT NULL,
  `pseudo` varchar(35) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `id_dern_util_modif` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `pseudo`, `mot_de_passe`, `id_profil`, `id_dern_util_modif`) VALUES
(1, 'Aressi', 'Yvan', 'rbtay562', '$2y$10$D0xfm7DFo1IaM0QRUy4aaegu8EoOIdrcVtmwQP0gjHUIhLPqcErnq', 1, 3),
(2, 'Lisilon', 'Pierre', 'rbtlp788', '$2y$10$UviHJr/38HipyN86Ph8SM.BPhsmTGY4qbHUac35B7c9QqxWWRHtoG', 2, 3),
(3, 'Lebos', 'Jade', 'rbtlj621', '$2y$10$GouM0EjMMp4B67B8DQEVEu6yxItMwFKzFb5y8r3i0EiwoTH0FvS/6', 4, 3),
(4, 'Lejaune', 'Paul', 'rbtio150', '$2y$10$i6lJb3qhPCuxLwht6FgRr.AZZ1qxfdyLHWU.WbHVE0mb4JP75XwmW', 1, 3),
(5, 'Agathe', 'Kisay', 'ag21ki', '$2y$10$U2.Ayu/Ks/Szsvj29R1RxeMw3xpTd3UiN6ynrcUHg0SWkz2FS3oEK', 4, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formation_suivi`
--
ALTER TABLE `formation_suivi`
  ADD CONSTRAINT `delegue_ibfk_2` FOREIGN KEY (`id_delegue`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `formation_suivi_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
