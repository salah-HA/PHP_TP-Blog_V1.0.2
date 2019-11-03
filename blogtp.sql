-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mariadb
-- Généré le :  Dim 27 oct. 2019 à 20:33
-- Version du serveur :  10.4.8-MariaDB-1:10.4.8+maria~bionic
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blogTP`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
                              `id_cat` int(11) NOT NULL,
                              `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `name`) VALUES
(1, 'disque de platine'),
(2, 'disque d or'),
(3, 'disque dur'),
(4, 'disque crotte');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
                            `id` int(11) NOT NULL,
                            `author` varchar(255) NOT NULL,
                            `comment` text DEFAULT NULL,
                            `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `author`, `comment`, `post_id`) VALUES
(1, 'admin', 'test', 4);

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
                         `id` int(11) NOT NULL,
                         `img_posting` varchar(255) DEFAULT NULL,
                         `title` varchar(255) NOT NULL,
                         `author` varchar(255) NOT NULL,
                         `content` text(255) NOT NULL,
                         `idCategory` int(11) DEFAULT NULL,
                         `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO articles (`id`, `img_posting`, `title`, `author`, `content`, `idCategory`, `idUser`) VALUES
(1, 'public/img/my-world.jpg', 'My World', 'admin', 'Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo)', 1, NULL ),
(2, 'public/img/Inspi-d-ailleurs.jpg', 'Inspi d ailleurs', 'admin', 'Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo)', 1, NULL ),
(3, 'public/img/La-Tete-dans-les-nuages.jpg', 'La Tete dans les nuages', 'admin', 'Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo)', 1, NULL ),
(4, 'public/img/La-Zone-en-personne.jpg', 'La Zone en personne', 'admin', 'Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo)', 1, NULL ),
(5, 'public/img/L-ovni.jpg', 'L ovni', 'admin', 'Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo)', 1, NULL ),
(6, 'public/img/Rien-100-rien.jpg', 'Rien 100 rien', 'admin', 'Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo) Jujujul (popopopo),Jujujul (popopopo)', 1, NULL );

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `username` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail`) VALUES
(1, 'admin', '$2y$10$KoRgZ.cbiAHqdaiwtSusH.Z.NovZtS7QsLyt0o1YCz.OaE/17gUaa', 'admin@admin.jul');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
    ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`),
    ADD KEY `idPost` (`post_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE articles
    ADD PRIMARY KEY (`id`),
    ADD KEY `idCategory` (`idCategory`),
    ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
    MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE articles
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
    ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES articles (`id`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE articles
    ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`id_cat`),
    ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
