-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 11 Janvier 2018 à 09:01
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
-- Structure de la table `affaire`
--

CREATE TABLE `affaire` (
  `id` int(11) NOT NULL,
  `libelle` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `code_analytique`
--

CREATE TABLE `code_analytique` (
  `id` int(11) NOT NULL,
  `libelle` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'soumise');

-- --------------------------------------------------------

--
-- Structure de la table `historique_connection`
--

CREATE TABLE `historique_connection` (
  `id` int(11) NOT NULL,
  `date_tentative` date DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `date_note_frais` date DEFAULT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historique_reglement`
--

CREATE TABLE `historique_reglement` (
  `id` int(11) NOT NULL,
  `date_reglement` date NOT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lie_affaire`
--

CREATE TABLE `lie_affaire` (
  `id` int(11) NOT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lie_code_analytique`
--

CREATE TABLE `lie_code_analytique` (
  `id` int(11) NOT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lie_numero_ordre_mission`
--

CREATE TABLE `lie_numero_ordre_mission` (
  `id` int(11) NOT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_frais`
--

CREATE TABLE `ligne_frais` (
  `id` int(11) NOT NULL,
  `date_ligne` date DEFAULT NULL,
  `object` varchar(255) DEFAULT NULL,
  `lieu` varchar(72) DEFAULT NULL,
  `montant` decimal(15,3) DEFAULT NULL,
  `id_note_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ligne_frais`
--

INSERT INTO `ligne_frais` (`id`, `date_ligne`, `object`, `lieu`, `montant`, `id_note_frais`) VALUES
(1, '2017-12-24', 'Autoroute', 'Pertuis', '8.000', 35),
(2, '2017-12-06', 'Repas', 'Pertuis', '25.000', 35),
(3, '2017-12-01', 'Essence', 'Aix-en-Provence', '5.000', 44);

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
(1, 'Restaurant', 'Double', '€'),
(2, 'Hotel', 'Double', '€'),
(3, 'Autoroute', 'Double', '€'),
(4, 'Parking', 'Double', '€'),
(5, 'Divers', 'Double', '€'),
(6, 'Kilomètre', 'Integer', 'Km');

-- --------------------------------------------------------

--
-- Structure de la table `note_frais`
--

CREATE TABLE `note_frais` (
  `id` int(11) NOT NULL,
  `mois_annee` varchar(25) NOT NULL,
  `nb_justificatif` int(11) DEFAULT NULL,
  `prix_km` float DEFAULT NULL,
  `mode_reglement` varchar(72) DEFAULT NULL,
  `banque` varchar(72) DEFAULT NULL,
  `avance` decimal(15,3) DEFAULT NULL,
  `net_a_payer` decimal(15,3) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_etat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note_frais`
--

INSERT INTO `note_frais` (`id`, `mois_annee`, `nb_justificatif`, `prix_km`, `mode_reglement`, `banque`, `avance`, `net_a_payer`, `id_utilisateur`, `id_etat`) VALUES
(35, '2017-06', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(39, '2017-08', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(40, '2017-03', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2),
(42, '2016-02', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(43, '2017-02', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(44, '2017-07', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2),
(46, '2015-02', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1);

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
-- Structure de la table `numero_ordre_mission`
--

CREATE TABLE `numero_ordre_mission` (
  `id` int(11) NOT NULL,
  `libelle` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'test', 'admin', 'c.mollusk@gmail.com', 'a5239517e4715c74276e4b4c8e6bcc7c637a0f27', NULL, NULL, NULL, NULL, NULL, 1, 1),
(2, 'test', 'declarant', 'dtest@gmail.com', '5bb1993e339e52b4ec84f0de2f6c51532ae08883', NULL, NULL, NULL, NULL, 0, 2, 2);

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
  `id` int(11) NOT NULL,
  `id_ligne_frais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `affaire`
--
ALTER TABLE `affaire`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `lie_affaire`
--
ALTER TABLE `lie_affaire`
  ADD PRIMARY KEY (`id`,`id_note_frais`),
  ADD KEY `FK_lie_affaire_id_note_frais` (`id_note_frais`);

--
-- Index pour la table `lie_code_analytique`
--
ALTER TABLE `lie_code_analytique`
  ADD PRIMARY KEY (`id`,`id_note_frais`),
  ADD KEY `FK_lie_code_analytique_id_note_frais` (`id_note_frais`);

--
-- Index pour la table `lie_numero_ordre_mission`
--
ALTER TABLE `lie_numero_ordre_mission`
  ADD PRIMARY KEY (`id`,`id_note_frais`),
  ADD KEY `FK_lie_numero_ordre_mission_id_note_frais` (`id_note_frais`);

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
-- Index pour la table `numero_ordre_mission`
--
ALTER TABLE `numero_ordre_mission`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`,`id_ligne_frais`),
  ADD KEY `FK_valeur_frais_id_ligne_frais` (`id_ligne_frais`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `affaire`
--
ALTER TABLE `affaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `code_analytique`
--
ALTER TABLE `code_analytique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `historique_connection`
--
ALTER TABLE `historique_connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historique_note_frais`
--
ALTER TABLE `historique_note_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historique_reglement`
--
ALTER TABLE `historique_reglement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ligne_frais`
--
ALTER TABLE `ligne_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `nature_frais`
--
ALTER TABLE `nature_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `note_frais`
--
ALTER TABLE `note_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT pour la table `numero_ordre_mission`
--
ALTER TABLE `numero_ordre_mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- Contraintes pour la table `lie_affaire`
--
ALTER TABLE `lie_affaire`
  ADD CONSTRAINT `FK_lie_affaire_id` FOREIGN KEY (`id`) REFERENCES `affaire` (`id`),
  ADD CONSTRAINT `FK_lie_affaire_id_note_frais` FOREIGN KEY (`id_note_frais`) REFERENCES `note_frais` (`id`);

--
-- Contraintes pour la table `lie_code_analytique`
--
ALTER TABLE `lie_code_analytique`
  ADD CONSTRAINT `FK_lie_code_analytique_id` FOREIGN KEY (`id`) REFERENCES `code_analytique` (`id`),
  ADD CONSTRAINT `FK_lie_code_analytique_id_note_frais` FOREIGN KEY (`id_note_frais`) REFERENCES `note_frais` (`id`);

--
-- Contraintes pour la table `lie_numero_ordre_mission`
--
ALTER TABLE `lie_numero_ordre_mission`
  ADD CONSTRAINT `FK_lie_numero_ordre_mission_id` FOREIGN KEY (`id`) REFERENCES `numero_ordre_mission` (`id`),
  ADD CONSTRAINT `FK_lie_numero_ordre_mission_id_note_frais` FOREIGN KEY (`id_note_frais`) REFERENCES `note_frais` (`id`);

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
  ADD CONSTRAINT `FK_valeur_frais_id` FOREIGN KEY (`id`) REFERENCES `nature_frais` (`id`),
  ADD CONSTRAINT `FK_valeur_frais_id_ligne_frais` FOREIGN KEY (`id_ligne_frais`) REFERENCES `ligne_frais` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
