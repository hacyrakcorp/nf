-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 14 Décembre 2017 à 23:31
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
(2, '2017-12', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(6, '2017-01', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(7, '2017-02', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2),
(8, '2017-03', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL),
(31, '2016-12', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL),
(32, '2017-08', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL);

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

--
-- Index pour les tables exportées
--

--
-- Index pour la table `note_frais`
--
ALTER TABLE `note_frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_note_frais_id_utilisateur` (`id_utilisateur`),
  ADD KEY `FK_note_frais_id_etat` (`id_etat`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `note_frais`
--
ALTER TABLE `note_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `note_frais`
--
ALTER TABLE `note_frais`
  ADD CONSTRAINT `FK_note_frais_id_etat` FOREIGN KEY (`id_etat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `FK_note_frais_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
