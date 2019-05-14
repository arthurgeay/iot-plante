-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 14 Mai 2019 à 23:53
-- Version du serveur :  5.6.34
-- Version de PHP :  7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `iot-plante`
--

-- --------------------------------------------------------

--
-- Structure de la table `flower`
--

CREATE TABLE `flower` (
  `id_flower` int(11) NOT NULL,
  `name_flower` varchar(50) DEFAULT NULL,
  `category_flower` varchar(44) DEFAULT NULL,
  `description_flower` varchar(255) DEFAULT NULL,
  `picture_flower` varchar(255) DEFAULT NULL,
  `humidity_flower` varchar(117) DEFAULT NULL,
  `temperature_flower` varchar(113) DEFAULT NULL,
  `brightness_flower` varchar(80) DEFAULT NULL,
  `flowering_period` varchar(51) DEFAULT NULL,
  `date_start_flower` date NOT NULL,
  `date_end_flower` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `flower`
--

INSERT INTO `flower` (`id_flower`, `name_flower`, `category_flower`, `description_flower`, `picture_flower`, `humidity_flower`, `temperature_flower`, `brightness_flower`, `flowering_period`, `date_start_flower`, `date_end_flower`) VALUES
(1, 'Capucines', 'Tropaeolaceae', '→ plante grimpante annuelle\\n→ vertus médicinales dans de très nombreux \\n→ traitements homéopathiques\\n→ fleurs vivement colorées : jaune, orange et rouge\\n→ Luttent contre les pucerons', 'https://api.tela-botanica.org/img:000243652L.jpg', '50', '20', '100', 'Juin à Septembre', '2019-06-01', '2019-09-30'),
(2, 'Muguet', 'Solanaceae', '→ fleurs sont toutes disposées en grappe \\n    (20 clochettes maximum par brin)\\n→ tige de 15 à 25 cm\\n→ fleurs blanche\\n', 'https://api.tela-botanica.org/img:000092046L.jpg', '80', '18', '100', 'Avril à mai', '2019-04-01', '2019-05-31'),
(3, 'Hortensia', 'Hydrangeaceae', '→ Plante de 1 à 2 mètres de hauteur\\n→ Les fleurs fertiles sont situés au centre \\net celle stériles sur la périphéries', 'https://api.tela-botanica.org/img:001911140L.jpg', '65', '15', '100', 'Juin - Octobre', '2019-06-01', '2019-10-31'),
(4, 'Lila', 'Apiaceae', '→ Plante de 2 à 5mètres\\n→ Feuilles ovales\\n→ Fleurs violette ou roses avec de l\'odeur', '', '50', '16', '100', 'Avril à Juin', '2019-04-01', '2019-06-30'),
(5, 'Pensée sauvage', 'Violaceae', '→ Plante de 30 cm \\n→ Aussi nomée violette des champs\\n→', 'https://api.tela-botanica.org/img:000204501L.jpg', '65', '17', '100', 'Mars à Juillet', '2019-03-01', '2019-07-31');

-- --------------------------------------------------------

--
-- Structure de la table `measures`
--

CREATE TABLE `measures` (
  `id_measures` int(11) NOT NULL,
  `temperature_measures` float NOT NULL,
  `brightness_measures` float NOT NULL,
  `humidity_measures` float NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `flower_id` int(11) DEFAULT NULL,
  `date_measures` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `flower`
--
ALTER TABLE `flower`
  ADD PRIMARY KEY (`id_flower`);

--
-- Index pour la table `measures`
--
ALTER TABLE `measures`
  ADD PRIMARY KEY (`id_measures`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_flower_id` (`flower_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `flower`
--
ALTER TABLE `flower`
  MODIFY `id_flower` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `measures`
--
ALTER TABLE `measures`
  MODIFY `id_measures` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `measures`
--
ALTER TABLE `measures`
  ADD CONSTRAINT `fk_flower_id` FOREIGN KEY (`flower_id`) REFERENCES `flower` (`id_flower`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
