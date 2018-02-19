-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 19 Février 2018 à 09:38
-- Version du serveur :  5.7.11
-- Version de PHP :  7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `nf`
--

-- --------------------------------------------------------

--
-- Structure de la table `code_analytique`
--

CREATE TABLE `code_analytique` (
  `id` int(11) NOT NULL,
  `libelle` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `code_analytique`
--

INSERT INTO `code_analytique` (`id`, `libelle`) VALUES
(100, 'F.G 100'),
(200, 'BTS CPI'),
(500, 'BTS TC');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `libelle` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
(1, 'brouillon'),
(2, 'soumise'),
(3, 'prise en charge'),
(4, 'traitée');

-- --------------------------------------------------------

--
-- Structure de la table `historique_connection`
--

CREATE TABLE `historique_connection` (
  `id` int(11) NOT NULL,
  `date_tentative` date DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `historique_connection`
--

INSERT INTO `historique_connection` (`id`, `date_tentative`, `id_utilisateur`) VALUES
(1, '2018-01-25', 5);

-- --------------------------------------------------------

--
-- Structure de la table `historique_etat`
--

CREATE TABLE `historique_etat` (
  `id` int(11) NOT NULL,
  `date_etat` date NOT NULL,
  `id_etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historique_note_frais`
--

CREATE TABLE `historique_note_frais` (
  `id` int(11) NOT NULL,
  `date_note_frais` varchar(25) DEFAULT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `historique_note_frais`
--

INSERT INTO `historique_note_frais` (`id`, `date_note_frais`, `id_note_frais`) VALUES
(1, '2018-01-28 08:41:16', 63);

-- --------------------------------------------------------

--
-- Structure de la table `historique_reglement`
--

CREATE TABLE `historique_reglement` (
  `id` int(11) NOT NULL,
  `date_reglement` date NOT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `historique_reglement`
--

INSERT INTO `historique_reglement` (`id`, `date_reglement`, `id_note_frais`) VALUES
(1, '2018-01-01', 44);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_frais`
--

CREATE TABLE `ligne_frais` (
  `id` int(11) NOT NULL,
  `date_ligne` date DEFAULT NULL,
  `object` varchar(255) DEFAULT NULL,
  `lieu` varchar(72) DEFAULT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ligne_frais`
--

INSERT INTO `ligne_frais` (`id`, `date_ligne`, `object`, `lieu`, `id_note_frais`) VALUES
(1, '2017-12-24', 'Autoroute', 'Pertuis', 35),
(2, '2017-12-06', 'Repas', 'Pertuis', 35),
(3, '2017-12-01', 'Essence', 'Aix-en-Provence', 44),
(10, '2017-08-05', 'test', 'Vitrolles', 39),
(13, '2017-08-08', 'test', 'Rognac', 39),
(14, '2017-08-09', 'test2', 'Plan d\'Orgon', 39),
(17, '2018-01-02', 'TEST2', 'Pertuis', 39),
(18, '2018-01-01', 'TEST', 'Cavaillon', 39);

-- --------------------------------------------------------

--
-- Structure de la table `nature_frais`
--

CREATE TABLE `nature_frais` (
  `id` int(11) NOT NULL,
  `libelle` varchar(72) DEFAULT NULL,
  `type_valeur` varchar(72) DEFAULT NULL,
  `unite` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `nature_frais`
--

INSERT INTO `nature_frais` (`id`, `libelle`, `type_valeur`, `unite`) VALUES
(1, 'Restaurant', '1', '€'),
(2, 'Hotel', '1', '€'),
(3, 'Autoroute', '1', '€'),
(4, 'Parking', '1', '€'),
(5, 'Divers', '1', '€'),
(6, 'Kilomètre', '2', 'Km');

-- --------------------------------------------------------

--
-- Structure de la table `note_frais`
--

CREATE TABLE `note_frais` (
  `id` int(11) NOT NULL,
  `mois_annee` varchar(25) NOT NULL,
  `mode_reglement` varchar(72) DEFAULT NULL,
  `numero_cheque` varchar(25) NOT NULL,
  `banque` varchar(72) DEFAULT NULL,
  `avance` decimal(15,3) DEFAULT NULL,
  `net_a_payer` decimal(15,3) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_etat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note_frais`
--

INSERT INTO `note_frais` (`id`, `mois_annee`, `mode_reglement`, `numero_cheque`, `banque`, `avance`, `net_a_payer`, `id_utilisateur`, `id_etat`) VALUES
(35, '2017-06', NULL, '', NULL, NULL, NULL, 2, 1),
(39, '2017-09', NULL, '', NULL, NULL, NULL, 2, 1),
(40, '2017-03', NULL, '', NULL, NULL, NULL, 2, 2),
(43, '2017-02', NULL, '', NULL, NULL, NULL, 2, 2),
(44, '2017-07', 'Cheque', '12345', 'LaPoste', NULL, NULL, 2, 3),
(63, '2016-10', NULL, '', NULL, NULL, NULL, 2, 1);

--
-- Déclencheurs `note_frais`
--
DELIMITER $$
CREATE TRIGGER `before_insert_nf` BEFORE INSERT ON `note_frais` FOR EACH ROW BEGIN
    IF (STR_TO_DATE(NEW.mois_annee,'%Y-%m') > sysdate())
      THEN
        signal sqlstate '45000' set message_text = 'Impossible d'enregistrer une date avenir.';   
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_nf` BEFORE UPDATE ON `note_frais` FOR EACH ROW BEGIN
    IF (STR_TO_DATE(NEW.mois_annee,'%Y-%m') > sysdate())
      THEN
        signal sqlstate '45000' set message_text = 'Impossible d'enregistrer une date avenir.';   
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `libelle` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `libelle`) VALUES
(1, 'pédagogie'),
(2, 'administratif'),
(3, 'CID');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id` int(11) NOT NULL,
  `libelle` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`id`, `libelle`) VALUES
(1, 'administrateur'),
(2, 'salarié'),
(3, 'externe'),
(4, 'comptabilité');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(72) DEFAULT NULL,
  `prenom` varchar(72) DEFAULT NULL,
  `login` varchar(72) DEFAULT NULL,
  `mdp` varchar(72) DEFAULT NULL,
  `tentative_connection` int(11) DEFAULT NULL,
  `code_mdp_oublie` varchar(25) DEFAULT NULL,
  `confirme_code` tinyint(1) DEFAULT NULL,
  `date_expiration_code` date DEFAULT NULL,
  `bloque` tinyint(1) DEFAULT '0',
  `id_statut` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `login`, `mdp`, `tentative_connection`, `code_mdp_oublie`, `confirme_code`, `date_expiration_code`, `bloque`, `id_statut`, `id_service`) VALUES
(1, 'test', 'admin', 'c.mollusk@gmail.com', 'a5239517e4715c74276e4b4c8e6bcc7c637a0f27', NULL, NULL, NULL, NULL, 0, 1, 1),
(2, 'test', 'declarant', 'dtest@gmail.com', '5bb1993e339e52b4ec84f0de2f6c51532ae08883', NULL, NULL, NULL, NULL, 0, 2, 2),
(3, 'test', 'compta', 'ctest@gmail.com', '014b4d83fe9ef4e5b47da5675a2ba52e71210a2a', NULL, NULL, NULL, NULL, 0, 4, 2),
(5, 'test2', 'externe', 'etest2@gmail.com', 'bcbb8733a4b206ec25c0cffc9289388788e7afdf', NULL, NULL, NULL, NULL, NULL, 3, 2),
(7, 'test2', 'salarie', 'stest2@gmail.com', '7c38f604c01aee817d54510529c47e1e535d1994', NULL, NULL, NULL, NULL, NULL, 2, 1),
(8, 'test2', 'compta', 'ctest2@gmailcom', '3e63a3a8a35ec0e8d4763d02ea9657bcf9282d2f', NULL, NULL, NULL, NULL, 0, 4, 2),
(9, 'Aliaga', 'cecile', 'cecile.aliaga@gmail.com', '64c304dd89e6d3ce0c1a46e081ad6b6b3f83df5a', NULL, NULL, NULL, NULL, NULL, 1, 1);

--
-- Déclencheurs `utilisateur`
--
DELIMITER $$
CREATE TRIGGER `before_insert_utilisateur` BEFORE INSERT ON `utilisateur` FOR EACH ROW BEGIN
    IF (NEW.bloque IS NULL)
      THEN
        SET NEW.bloque = 0;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_blocage` BEFORE UPDATE ON `utilisateur` FOR EACH ROW BEGIN
    IF NEW.tentative_connection = 4
      THEN
        SET NEW.bloque = 1;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `valeur_frais`
--

CREATE TABLE `valeur_frais` (
  `valeur` float DEFAULT NULL,
  `id_nature_frais` int(11) NOT NULL,
  `id_ligne_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `valeur_frais`
--

INSERT INTO `valeur_frais` (`valeur`, `id_nature_frais`, `id_ligne_frais`) VALUES
(20, 1, 13),
(10, 1, 14),
(18, 1, 18),
(25, 2, 17),
(10, 3, 10),
(1.8, 3, 13),
(4.2, 3, 14),
(4, 3, 18),
(7.8, 4, 14),
(8.75, 4, 17),
(15, 5, 10),
(5, 5, 14),
(2, 6, 18);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `code_analytique`
--
ALTER TABLE `code_analytique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique_connection`
--
ALTER TABLE `historique_connection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_historique_connection_id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_historique_etat_id_etat` (`id_etat`);

--
-- Index pour la table `historique_note_frais`
--
ALTER TABLE `historique_note_frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_historique_note_frais_id_note_frais` (`id_note_frais`);

--
-- Index pour la table `historique_reglement`
--
ALTER TABLE `historique_reglement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_historique_reglement_id_note_frais` (`id_note_frais`);

--
-- Index pour la table `ligne_frais`
--
ALTER TABLE `ligne_frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ligne_frais_id_note_frais` (`id_note_frais`);

--
-- Index pour la table `nature_frais`
--
ALTER TABLE `nature_frais`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note_frais`
--
ALTER TABLE `note_frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_note_frais_id_utilisateur` (`id_utilisateur`),
  ADD KEY `FK_note_frais_id_etat` (`id_etat`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_utilisateur_id_statut` (`id_statut`),
  ADD KEY `FK_utilisateur_id_service` (`id_service`);

--
-- Index pour la table `valeur_frais`
--
ALTER TABLE `valeur_frais`
  ADD PRIMARY KEY (`id_nature_frais`,`id_ligne_frais`),
  ADD KEY `FK_valeur_frais_id_ligne_frais` (`id_ligne_frais`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `code_analytique`
--
ALTER TABLE `code_analytique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;
--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `historique_connection`
--
ALTER TABLE `historique_connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historique_note_frais`
--
ALTER TABLE `historique_note_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `historique_reglement`
--
ALTER TABLE `historique_reglement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ligne_frais`
--
ALTER TABLE `ligne_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `nature_frais`
--
ALTER TABLE `nature_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `note_frais`
--
ALTER TABLE `note_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `historique_connection`
--
ALTER TABLE `historique_connection`
  ADD CONSTRAINT `FK_historique_connection_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  ADD CONSTRAINT `FK_historique_etat_id_etat` FOREIGN KEY (`id_etat`) REFERENCES `etat` (`id`);

--
-- Contraintes pour la table `historique_note_frais`
--
ALTER TABLE `historique_note_frais`
  ADD CONSTRAINT `FK_historique_note_frais_id_note_frais` FOREIGN KEY (`id_note_frais`) REFERENCES `note_frais` (`id`);

--
-- Contraintes pour la table `historique_reglement`
--
ALTER TABLE `historique_reglement`
  ADD CONSTRAINT `FK_historique_reglement_id_note_frais` FOREIGN KEY (`id_note_frais`) REFERENCES `note_frais` (`id`);

--
-- Contraintes pour la table `ligne_frais`
--
ALTER TABLE `ligne_frais`
  ADD CONSTRAINT `FK_ligne_frais_id_note_frais` FOREIGN KEY (`id_note_frais`) REFERENCES `note_frais` (`id`);

--
-- Contraintes pour la table `note_frais`
--
ALTER TABLE `note_frais`
  ADD CONSTRAINT `FK_note_frais_id_etat` FOREIGN KEY (`id_etat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `FK_note_frais_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_utilisateur_id_service` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `FK_utilisateur_id_statut` FOREIGN KEY (`id_statut`) REFERENCES `statut` (`id`);

--
-- Contraintes pour la table `valeur_frais`
--
ALTER TABLE `valeur_frais`
  ADD CONSTRAINT `FK_valeur_frais_id_ligne_frais` FOREIGN KEY (`id_ligne_frais`) REFERENCES `ligne_frais` (`id`),
  ADD CONSTRAINT `FK_valeur_frais_id_nature_frais` FOREIGN KEY (`id_nature_frais`) REFERENCES `nature_frais` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
