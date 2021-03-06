-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 23 sep. 2020 à 14:16
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `anymanga`
--

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_comments`
--

DROP TABLE IF EXISTS `42pmz96_comments`;
CREATE TABLE IF NOT EXISTS `42pmz96_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `postDate` datetime NOT NULL,
  `id_42pmz96_products` int(11) NOT NULL,
  `id_42pmz96_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_comments_42pmz96_products_FK` (`id_42pmz96_products`),
  KEY `42pmz96_comments_42pmz96_users0_FK` (`id_42pmz96_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_genres`
--

DROP TABLE IF EXISTS `42pmz96_genres`;
CREATE TABLE IF NOT EXISTS `42pmz96_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_genres_AK` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_genres`
--

INSERT INTO `42pmz96_genres` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Art martiaux'),
(3, 'Aventure'),
(4, 'Comédie'),
(5, 'Drama'),
(6, 'Ecchi'),
(7, 'Ecole'),
(8, 'Fantastique'),
(9, 'Harem'),
(10, 'Historique'),
(11, 'Horreur'),
(12, 'Magique'),
(13, 'Mecha'),
(14, 'Militaire'),
(15, 'Musique'),
(16, 'Mystère'),
(17, 'Policier'),
(18, 'Psychologique'),
(19, 'Romance'),
(20, 'Science fiction'),
(21, 'Sport'),
(22, 'Super pouvoir'),
(23, 'Thriller'),
(24, 'Tranche de vie'),
(25, 'Yaoi'),
(26, 'Yuri');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_licenses`
--

DROP TABLE IF EXISTS `42pmz96_licenses`;
CREATE TABLE IF NOT EXISTS `42pmz96_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creationDate` date NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_licenses_AK` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_licenses`
--

INSERT INTO `42pmz96_licenses` (`id`, `creationDate`, `name`) VALUES
(1, '1900-01-01', 'pas de license'),
(2, '1963-11-07', '8 Man'),
(3, '2012-08-24', 'Absolute Duo'),
(4, '1997-01-01', 'Air Master'),
(5, '2011-05-19', 'Akiba\'s Trip'),
(6, '1977-01-01', 'Albator'),
(7, '2012-07-02', 'Assassination Classroom'),
(8, '1999-07-01', 'Beyblade'),
(9, '2001-08-07', 'Bleach'),
(10, '1989-09-01', 'Clamp'),
(11, '2010-11-25', 'Danganronpa'),
(12, '1997-06-01', 'Digimon'),
(13, '1984-12-03', 'Dragon Ball'),
(14, '2004-01-01', 'Fate Series'),
(15, '1996-02-01', 'Pokémon'),
(16, '1987-12-18', 'Final Fantasy'),
(17, '2008-08-11', 'Bakuman'),
(18, '1998-10-21', 'Love Hina'),
(19, '1969-08-08', 'Doraemon'),
(20, '1994-01-19', 'Détective Conan'),
(21, '2002-01-01', 'Sword Art Online');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_listemayhaveproducts`
--

DROP TABLE IF EXISTS `42pmz96_listemayhaveproducts`;
CREATE TABLE IF NOT EXISTS `42pmz96_listemayhaveproducts` (
  `id` int(11) NOT NULL,
  `id_42pmz96_products` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_42pmz96_products`),
  KEY `42pmz96_listeMayHaveProducts_42pmz96_products0_FK` (`id_42pmz96_products`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_listes`
--

DROP TABLE IF EXISTS `42pmz96_listes`;
CREATE TABLE IF NOT EXISTS `42pmz96_listes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creationDate` date NOT NULL,
  `name` varchar(150) NOT NULL,
  `id_42pmz96_universes` int(11) NOT NULL,
  `id_42pmz96_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_listes_AK` (`name`),
  KEY `42pmz96_listes_42pmz96_universes_FK` (`id_42pmz96_universes`),
  KEY `42pmz96_listes_42pmz96_users0_FK` (`id_42pmz96_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_marks`
--

DROP TABLE IF EXISTS `42pmz96_marks`;
CREATE TABLE IF NOT EXISTS `42pmz96_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mark` int(11) NOT NULL,
  `id_42pmz96_users` int(11) DEFAULT NULL,
  `id_42pmz96_products` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idusers_marks` (`id_42pmz96_users`),
  KEY `fk_idproducts_marks` (`id_42pmz96_products`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_posts`
--

DROP TABLE IF EXISTS `42pmz96_posts`;
CREATE TABLE IF NOT EXISTS `42pmz96_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `postDate` datetime NOT NULL,
  `lastEditDate` datetime DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `id_42pmz96_universes` int(11) NOT NULL,
  `id_42pmz96_users` int(11) DEFAULT NULL,
  `id_42pmz96_postsTypes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_posts_42pmz96_universes_FK` (`id_42pmz96_universes`),
  KEY `42pmz96_posts_42pmz96_postsTypes1_FK` (`id_42pmz96_postsTypes`),
  KEY `42pmz96_posts_42pmz96_users0_FK` (`id_42pmz96_users`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_posts`
--

INSERT INTO `42pmz96_posts` (`id`, `content`, `image`, `postDate`, `lastEditDate`, `title`, `id_42pmz96_universes`, `id_42pmz96_users`, `id_42pmz96_postsTypes`) VALUES
(1, 'Bienvenue dans l\'univer Mange d\'AnyManga. Vous trouverez ici, tous ce qu\'il y a à savoir sur l\'univer du Manga: suivez l\'actualité, retrouvez vos oeuvres préférées, découvrez-en de nouvelles. N\'hésitez pas à changer d\'univer à tous moment pour découvrir si votre oeuvre favorite a été adapté en Animé. Devenez membre et enregistrer vos lectures passé et les nouvelles et profitez de nos listes découvertes. ', NULL, '2020-07-24 16:00:00', '2020-07-24 16:00:00', 'Bienvenue', 1, 1, 4),
(2, 'Bienvenue dans l\'univers Animés d\'AnyManga. Vous trouverez ici, Tous ce qu\'il y a à savoir sur l\'univer des Animés. Suivez l\'actualité, parcourrez les oeuvres pour les découvrir ou les redécouvrir. N\'hésitez pas à changer d\'univer, et ainsi découvrir le manga à l\'origin de votre oeuvre préférée. Devenez membre epour créer votre liste de lecture passé et à venir mais aussi pour découvrir nos listes découvertes. ', NULL, '2020-07-24 16:00:00', '2020-07-24 16:00:00', 'Bienvenue', 2, 1, 4),
(3, 'Bienvenue sur AnyManga. Vous trouverez ici toutes les oeuvres issues du monde de l\'animation japonaise. Nous vous invitons à vous inscrire ,et ainsi pouvoir profiter des différents outils que nous vous proposons, comme enregistrer une liste des oeuvres qui vous intéresses ou celles que vous avez déjà vus ou lus. Pour poursuivre votre visite veuillez choisir l\'univers de votre choix en cliquant sur l\'une des deux images présentées sur cette page. ', NULL, '2020-07-24 16:00:00', '2020-07-24 16:00:00', 'Bienvenue', 3, 1, 4),
(13, 'test2', 'assets/img/anime/posts/test2_2020-09-16.png', '2020-09-16 10:22:28', '2020-09-16 10:23:04', 'test2', 2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_poststypes`
--

DROP TABLE IF EXISTS `42pmz96_poststypes`;
CREATE TABLE IF NOT EXISTS `42pmz96_poststypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_postsTypes_AK` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_poststypes`
--

INSERT INTO `42pmz96_poststypes` (`id`, `name`) VALUES
(4, 'accueil'),
(2, 'annonce'),
(1, 'évenement'),
(3, 'info');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_presentations`
--

DROP TABLE IF EXISTS `42pmz96_presentations`;
CREATE TABLE IF NOT EXISTS `42pmz96_presentations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `presentation` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_42pmz96_universes` int(11) NOT NULL,
  `id_42pmz96_licenses` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_presentations_42pmz96_universes_FK` (`id_42pmz96_universes`),
  KEY `42pmz96_presentations_42pmz96_licenses0_FK` (`id_42pmz96_licenses`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_presentations`
--

INSERT INTO `42pmz96_presentations` (`id`, `presentation`, `image`, `id_42pmz96_universes`, `id_42pmz96_licenses`) VALUES
(1, 'Assassiné par des criminels, le corps du détective Yokoda est récupéré par le professeur Tani et est conduit dans son laboratoire. Là-bas, Tani effectue une expérience qui a échoué sept fois. Yokoda est le dernier sujet à avoir transféré sa force de vie dans un corps androïde. Pour la première fois, l\'expérience est un succès. Yokoda renaît sous le nom de 8 Man, un homme à la peau blindée, capable de se lancer à des vitesses impossibles et de se transformer en un personnage. Il s\'installe dans Yokoda, en se faisant appeler \"Hachiro Azuma\". Il garde cette identité secrète, connue seulement de Tani et de son chef de police, le chef Tanaka. Même sa petite amie Sachiko et son ami Ichiro ne savent pas qu\'il est un androïde. En tant que 8-Man, Hachiro va combattre le crime.', 'assets/img/manga/licenses/8 Man.jpg', 1, 2),
(2, 'Yokugawa Sachiko est une jeune femme travaillant au sein de l’entreprise Biotechno. Elle est sans nouvelle d’Hazuma, l’homme qu’elle aimait et qui accessoirement est Eight Man. Sachiko est contactée par un jeune détective, Hazama, qui est à la recherche du professeur Schmitt. Cet ancien de Biotechno est recherché pour vol de documents secrets et greffes d’implants cyborgs. Alors que Sachiko accepte d’apporter son secours à Hazama, elle est prise en otage par un cyborg et ne doit son salut qu’à l’intervention désespérée du jeune détective. Intervention au cours de laquelle Hazama fait une chute dont personne ne pourrait se relever… Mais le jeune détective fait son grand retour dans une ville stéréotype du Pandémonium. Un retour qui coïncide avec celui d’Eight Man… ', 'assets/img/anime/licenses/8 Man.jpg', 2, 2),
(3, 'Tôru Kokonoe arrive comme beaucoup étudiants pour s\'inscrire dans une prestigieuse école où l\'on enseigne l\'art d\'utiliser son blaze, le jeune homme fait la conaissance d\'une jeune fille appelée Nagakura Himari. Les deux étudiantqms vont très vite s\'entendre mais lors de la cérémonie d\'entrée, on leur annonce que pour entrer dans l\'académie ils doivent vaincre le voisin de salle, or la jeune fille est assise à coté du jeune homme, ils n\'ont d\'autres choix que de se battrent...', 'assets/img/manga/licenses/Absolute Duo.jpg', 1, 3),
(4, 'En ce monde, il existe des armes qui sont la manifestation de l\'âme humaine. Elles sont appelés \"Blaze\". Tōru Kokonoe a les qualifications requises pour en manier une. Toutefois, pour une étrange raison, son \"Blaze\" n\'est pas une arme, mais un bouclier... Notre héros s\'inscrit un jour dans une école qui enseigne des techniques de combat via un système de partenariat entre élèves appelé \"Duo\". Il aura pour partenaire une belle jeune fille aux cheveux argentés. ', 'assets/img/anime/licenses/Absolute Duo.jpg', 2, 3),
(5, 'Le jour, Maki Aikawa est une lycéenne normale qui forme un groupe très solide avec ses amies Yuu, Michiru, Renge et Mina. La nuit, elle devient \"Airmaster\", une combattante de la nuit réputée et redoutée qui aime particulièrement les défis !', 'assets/img/manga/licenses/Air Master.jpg', 1, 4),
(6, 'Aikawa Maki alias Airmaster est une étudiante de 16 ans vivant a Tokyo. Plutot stupide, elle n\'est douée que pour les street fight nocturnes auxquels elle participe. Associale elle apprendra tout au long de l\'animé a se faire des amis mais que le monde du street fighting est plein de combattant aussi doués que tordus. Humour de dingue et bastons s\'allie avec beaucoup d\'efficacité. C\'est pas la beauté de l\'animé qui retient mais la pêche qui se dégage des combats.\r\nCeux qui ont apprécié Street fighter 2v peuvent se précipité les autres aussi', 'assets/img/anime/licenses/Air Master.jpg', 2, 4),
(7, 'L\'ensemble du quartier commercial d\'Akihabara est envahi par des créatures nommées Synthisters (ou vampires) qui chassent et terrorisent les clients de ce quartier de Tokyo. Ces créatures ne possèdent qu\'un seul point faible : l\'exposition directe aux rayons du soleil. Ce qui signifie que les vêtements de ces Synthisters doivent être arrachés. Ainsi, un groupe d\'adolescents décide de se battre pour éliminer la menace que forment les Synthisters. ', 'assets/img/anime/licenses/Akiba\'s Trip.jpg', 2, 5),
(8, 'En 1977, le peuple des guerrières de l\'espace envahit la terre. Les habitants n\'ont aucunement conscience de l\'importance de cet événement. Sillonnant l\'océan intersidéral, le capitaine Albator et tout son équipage déploient leurs forces pour tenter de stopper leur entreprise.', 'assets/img/manga/licenses/Albator.jpg', 1, 6),
(9, 'Les Terriens ont toutes les satisfactions apportées par le confort. Ils deviennent donc tellement laxistes que seules quelques personnes travaillent encore. Lorsqu’un scientifique suppose l’arrivée prochaine d’extraterrestres, personne ne le croit, chacun préférant la tranquillité à la crainte ! Les Sylvidres, race extraterrestre métamorphe, profitent de cette population fainéante pour infiltrer la Terre afin de la conquérir. Albator, hors-la-loi recherché par les militaires et principalement par leur chef, Vilas, va être le seul à croire le scientifique, que les Sylvidres tueront. Avec l’aide de Ramis, l’assistant du scientifique, il va protéger les Terriens inconscients du danger, malgré l’opposition de l’armée qui posera de nombreux pièges pour les attraper. ', 'assets/img/anime/licenses/Albator.jpg', 2, 6),
(10, 'Au lycée Kunugigaoka se trouve la classe 3-E, exclue dans les montagnes pour étudier et surtout pour assassiner leur professeur, Koro-sensei. En effet, cette étrange créature, ressemblant à un smiley avec des tentacules, a réussi à trouer la lune jusqu\'à ce que celle-ci en devienne un croissant ! Il posa alors ses conditions au gouvernement : devenir le professeur de la classe 3-E. Cependant, si d\'ici une année aucun de ses élèves ne parvient à le tuer, la Terre connaîtra le même sort que celui de la Lune !\r\n\"Si une personne y arrive, elle recevra la somme astronomique de 10 milliards de yens\" !\r\n\r\nC\'est ainsi que ce groupe d\'élèves va apprendre l\'art de tuer de différentes manières mais aussi commencer à s\'attacher à ce drôle de professeur.', 'assets/img/manga/licenses/Assassination Classroom.jpg', 1, 7),
(11, 'La planète Terre est en sursis ! Après avoir partiellement détruit la Lune, un être étrange et surpuissant a décrété que si personne ne parvenait à le tuer dans l\'année à venir, la planète subirait le même sort que son satellite. Durant ce laps de temps, il a également exigé d\'être nommé professeur de la classe 3-E du lycée Kunugigaoka, aussi connue sous le nom de \"Class End\", la classe des cas désespérés.\r\n\r\nLes étudiants sont donc les mieux placés pour tuer cet étrange professeur, baptisé Koro-sensei, et ainsi empocher la somme astronomique de 10 milliards de yens. L\'ennui, c\'est que la majorité des lycéens de cette classe manquent cruellement de confiance en eux, écrasés par un système qui ne leur convient pas.', 'assets/img/anime/licenses/Assassination Classroom.jpg', 2, 7),
(12, 'Tyson Kynomiya est un jeune garçon qui vit au Japon chez son Grand-père. Il est maladroit, impulsif, courageux, têtu et peu réfléchi. Il a une passion : le Beyblade ! Ce jeu de toupie est très populaire et de nombreux blader s\'affronte dans des arènes. Les toupies hébergent en leur centre un spectre, qui lie les blader à leurs toupies. Ces bêtes mystiques sont de précieux allier durant les combats. Chaque blader s\'entraîne et développe une caractéristique dominante : attaque, défense, endurance ou combinaison. Tyson va, par le biais de ce jeu, se faire des amis fidèles, découvrir le monde et affronter de nombreux blader puissant !', 'assets/img/manga/licenses/Beyblade.jpg', 1, 8),
(13, 'Metal Fight Beyblade raconte l\'histoire de Ginga Hagane un jeune Beyblader venant d\'un petit village de montagne \" Koma\". Avec son attitude cool au caractère bien trempé, il vous fera pensé à Tayson, il rencontrera des beybladers qui voudrons le combattre (Face Hunters), voire le tuer (Dark Nebula), plus précisément Ryuga, qui va libérer la toupie interdite à la puissance terrifiante surnommé, L-Drago !\r\n\r\nCependant, son amitié avec son Pegasius l\'esprit de sa beyblade et ses amis Kenta et Madoka l\'aidera à affronter toutes les difficultés, au fil de l\'histoire Ginga se fera de nouveaux alliés tel que Kyouya, Benkei, Tsubasa ou bien Yu !\r\n\r\nIl sera même capable de convertir certains de ses ennemis avec son pur Beyheart.', 'assets/img/anime/licenses/Beyblade.jpg', 2, 8),
(14, 'Ichigo Kurosaki, jeune lycéen de 15 ans dans la ville de Karakura, a l\'étonnante capacité de pouvoir voir et communiquer avec les âmes errantes, suite à l\'accident qui lui enleva sa mère... Vivant désormais avec son père et ses deux soeurs cadettes, Ichigo parvient tant bien que mal à gérer cet aspect de sa vie. Jusqu\'au jour où il croisera le chemin d\'une shinigami (déesse de la mort), Rukia Kuchiki, poursuivant une de ces âmes errantes ayant choisi le mauvais chemin vers l\'éternité...\r\n\r\nDurant le combat qui s\'en suivit, Rukia, à la suite de blessures, se voit obligée de confier une partie de ses pouvoirs à Ichigo afin que la mission puisse être menée à bien. Mais contre toute attente, Ichigo absorbe la totalité des pouvoirs de Rukia et devient à son tour une sorte de shinigami. Une fois cette affaire réglée, il conserve ses nouveaux pouvoirs. Rukia reste alors dans notre monde le temps de se régénérer et lui enseigne les rudiments de la vie de shinigami.\r\n\r\nMais si tout se passe plus ou moins bien sur notre plan d\'existence, de l\'autre côté de la barrière l\'au-delà n\'est pas si tranquille...', 'assets/img/manga/licenses/Bleach.jpg', 1, 9),
(15, 'Kurosaki Ichigo, un étudiant de quinze ans aux cheveux orange qui aime la bagarre (comme son père) a la particularité de voir les fantômes ainsi que de pouvoir les toucher. Cela l\'amène à rencontrer Kuchiki Rukia, un Shinigami (dieu de la mort) qui combat un Hollow. Le déroulement du combat amène Kuchiki à donner ses pouvoirs à Ichigo qui deviens alors lui même un Shinigami. C\'est maintenant à son tour de protéger la ville des Hollows.', 'assets/img/anime/licenses/Bleach.jpg', 2, 9),
(16, 'CLAMP est un cercle de mangaka feminins qui commence son activité en 1989, dans le milieu du fanzinat ou dôjinshi, sous le nom de Amarythia. Originellement, le groupe compte douze membres.\r\nVers 1990, le cercle de magaka diminue de douze membres à sept membres, change de nom, devient CLAMP et se lance dans le milieu professionnel avec la publication de leur premier manga dans le magazine Wings : RG Veda. Le succès est au rendez-vous mais le groupe perd de nouveaux deux membres en cours de production Akiyama Tamayo et Sei Leeza.\r\n\r\nActuellement, CLAMP compte quatre membres officiels. A noter que leurs noms professionnels ont changé en 2004, lors de leur 15 ième anniversaire de carrière professionnel. Dans une interview, Ageha Ohkawa révèle que CLAMP a mûri depuis et que leurs anciens noms ne convenaient plus à leurs personnalités actuelles. En fait, Mick Nekoi n\'aimait pas que l\'on fasse référence à Mick Jagger en parlant d\'elle et Mokona Apapa a décidé laisser tomber son nom de famille parce que cela faisait trop immature. Le reste du groupe a juste suivi la vague de changement. A noter que Satsuki Igarashi a juste décidé d\'écrire son nom avec des kanji différents tout en conservant la même prononciation.', 'assets/img/manga/licenses/Clamp.jpg', 1, 10),
(17, 'CLAMP est un cercle de mangaka feminins qui commence son activité en 1989, dans le milieu du fanzinat ou dôjinshi, sous le nom de Amarythia. Originellement, le groupe compte douze membres.\r\nVers 1990, le cercle de magaka diminue de douze membres à sept membres, change de nom, devient CLAMP et se lance dans le milieu professionnel avec la publication de leur premier manga dans le magazine Wings : RG Veda. Le succès est au rendez-vous mais le groupe perd de nouveaux deux membres en cours de production Akiyama Tamayo et Sei Leeza.\r\n\r\nActuellement, CLAMP compte quatre membres officiels. A noter que leurs noms professionnels ont changé en 2004, lors de leur 15 ième anniversaire de carrière professionnel. Dans une interview, Ageha Ohkawa révèle que CLAMP a mûri depuis et que leurs anciens noms ne convenaient plus à leurs personnalités actuelles. En fait, Mick Nekoi n\'aimait pas que l\'on fasse référence à Mick Jagger en parlant d\'elle et Mokona Apapa a décidé laisser tomber son nom de famille parce que cela faisait trop immature. Le reste du groupe a juste suivi la vague de changement. A noter que Satsuki Igarashi a juste décidé d\'écrire son nom avec des kanji différents tout en conservant la même prononciation.', 'assets/img/anime/licenses/Clamp.jpg', 2, 10),
(18, 'À Kibôgamine, l\'école réservée à l\'élite des lycéens, l\'heure est au voyage scolaire ! Sur l\'île paradisiaque de Jabberwock, Hajime Hinata et ses camarades profitent de la plage et du beau temps... Mais voilà que Monokuma, la peluche psychopathe, est de retour et met en place un nouveau jeu de la mort : quiconque voudra quitter l\'île devra commettre un meurtre ! Qui parmi les élèves sera le premier à mourir ?\r\n\r\nPiégés sur une île tropicale, nos héros ont un seul espoir d\'en sortir vivant : percer le mystère de ce lieu isolé. Mais la vérité peut être pire que la mort.', 'assets/img/manga/licenses/Danganronpa.jpg', 1, 11),
(19, 'L\'histoire se passe dans l\'académie Kibôgamine où seuls les meilleurs dans différents domaines sont acceptés. Chacun d\'entre eux obtient un titre de niveau super lycée lié à leur spécialité. Cependant, chaque année, un élève moyen est accepté. C\'est là que Makoto Naegi, le chanceux de niveau super lycée de cette année, se met à rencontrer les nouveaux super lycéens.\r\n\r\nLes voilà enfermés dans cette école par un ours noir et blanc appelé Monokuma. Ils apprennent qu\'ils ne pourront sortir qu\'en obtenant leur diplôme. Pour cela, un élève doit commettre un meurtre et ne jamais être démasqué. Si celui-ci réussit le meurtre parfait, les autres élèves seront condamnés à mort et lui seul pourra quitter l\'école. Mais dans le cas contraire, le meurtrier reçoit un châtiment pour avoir perturbé l\'ordre publique de la classe.', 'assets/img/anime/licenses/Danganronpa.jpg', 2, 11),
(20, 'Chapitre 1 - COMMENT TOUT A COMMENCE...\r\nSept enfants se trouvent tout à coup transportés dans un autre monde, le Digimonde. Ils y rencontrent d\'étranges monstres digitaux, les Digimon !! Ceux-ci vont les aider à survivre dans ce monde inhospitalier...\r\n\r\nChapitre 2 - LA NAISSANCE DE GREYMON\r\nLes Digi-sauveurs commencent à explorer l\'Île des Fichiers binaires. Mais l\'apparition de Shellmon met Tai dans le pétrin !! Heureusement, pour le sauver, Agumon se digivolve en Greymon et va combattre le titan...\r\n\r\nChapitre 3 - GARURUMON, LE LOUP BLEU !\r\nLes sept amis veulent se reposer, mais ils provoquent la colère de Seadramon !! En aidant son frère T.K., Matt se trouve en mauvaise posture. Pour le protéger, Gabumon se digivolve alors en Garurumon et sauve la situation !!\r\n\r\nChapitre 4 - TOUT FEU, TOUT FLAMME !\r\nAu pied du mont Miharashi, le village des Yokomon est attaqué par le soi-disant paisible Meramon. Celui-ci a été assailli par une étrange Roue Noire. Grâce à Sora, Biyomon se digivolve en Birdramon et terrasse Meramon !!', 'assets/img/manga/licenses/Digimon.jpg', 1, 12),
(21, 'Alors qu\'ils devaient passé l\'été dans un camp de vacance, sept enfants sont transportés dans un monde virtuel : le Digital World. Dans ce monde réside les Digimon, de petits monstres digitaux se répartissant en trois classe : donnés, virus et anti-virus. Après leur arrivé, les enfants se rendent compte qu\'ils ont chacun un digimon chargé de les protéger et de les guider ainsi qu\'un digivice, une sorte de petit ordinateur permettant aux digimons d\'évoluer.\r\n\r\nTaichi, Yamato, Sora, Izumi, Mimi, Joe et Takeru vont alors comprendre qu\'il ont été choisis pour aider ce monde dans lequel des digimons de type virus font la loi et bouleverse l\'équilibre. Mais la survie s\'annonce difficile pour ce groupe d\'adolescent qui, de plus, font parfois face à des tensions à l\'intérieur même de leur groupe.', 'assets/img/anime/licenses/Digimon.jpg', 2, 12),
(22, 'Alors qu\'elle parcourt les routes de montagnes à moto, Bulma fait une bien étrange rencontre en la personne de Sangoku, un petit garçon étonnamment fort, résistant et possédant une queue, comme les singes. Il possède un trésor qu\'elle recherche, une boule de cristal, mais ne veut pas la lui céder, c\'est un cadeaux que lui a laissé son grand-père Sangohan. Ils trouvent finalement un compromis, et Sangoku part avec elle à la recherche des 7 boules de cristal dont on dit qu\'elles exaucent n\'importe quel souhait une fois réunis.', 'assets/img/manga/licenses/Dragon Ball.jpg', 1, 13),
(23, 'Dragon ball raconte les aventures de Son Gôku, un jeune garçon doté d\'une queue de singe.\r\nL\'histoire commence lorsque Son Gokû rencontre Bulma, qui est à la recherche des sept boules de cristal. Ces boules de cristal on un pouvoir qui exaucerait n\'importe quel souhait une fois les 7 d\'entre elles réunies.\r\nAu cours de ses aventures, Son Gôku rencontrera beaucoup d\'amis comme Krillin, Yamsha, kame, mais aussi beaucoup d\'ennemis comme le Red Rubon et Pïccolo...\r\nDragon Ball est l\'un des mangas les plus populaires au monde.', 'assets/img/anime/licenses/Dragon Ball.jpg', 2, 13),
(24, 'Emiya Shirô a tout perdu lors d\'un immense incendie : sa famille, sa maison, ses repères. Il est alors adopté par Emiya Kiritsugu. Quelques années plus tard, alors que son père est décédé, Shirô participe à un important tournoi, réunissant 7 magiciens, dont l\'enjeu est le Saint Graal. Chaque mage invoque pour le tournoi un \"Servant\", un héros ancien qui lui prête sa force durant le tournoi. Shirô invoque une guerrière de la classe la plus puissante : Saber.', 'assets/img/manga/licenses/Fate Series.jpg', 1, 14),
(25, 'Tiré d’un eroge visual novel de Type‑Moon à l’instar de Tsukihime, Fate/stay night nous conte l’histoire d’Emiya, un jeune homme capable d’analyser la structure des objets grâce à la magie. Enfant, Emiya fut témoin du dénouement tragique d’une guerre occulte opposant 7 magiciens et leurs serviteurs et qui détruisit son quartier. Recueilli par un magicien, désormais décédé, Emiya est devenu un jeune homme solitaire doté de pouvoirs limités, capable de réparer les objets d’instinct et de lancer quelques sorts. Au cours d’une nuit tragique où il se retrouve à nouveau confronté à la guerre pour le Saint Graal, Emiya invoque Saber, l’ultime serviteur, et devra affronter les 6 autres magiciens malgré ses limites.Cet anime est suivi par Fate/Zero. Il existe également un spin-off intitulé Fate/Kaleid Liner Prisma☆Illya.Attention, vous avez devant vous une perle de l’animation.Le meilleur animé qu’il m’a été donné de voir.En effet, il fait partis des rares animés, où les personnages évoluent, non pas en puissance, mais en caractère et en relationnel, je ne parle pas évidement d’une relation cucul entre deux être, mais bien d’un lien complexe entre les divers personnages qui se tisse au fur et à mesure tout le long de l’animé.Le caractère désign est superbe, les animations de combats sont très bien réalisé, et l’émotion… aahhh, mais quelle émotion, certaines scènes font tirer la larme, et après avoir vu la fin, on ne peut en être que troublé. ', 'assets/img/anime/licenses/Fate Series.jpg', 2, 14),
(26, 'On retrouve cette série qui a fait le succès de la version télévisé dans ce manga.\r\nNous retrouvons donc nos héros, accompagné de Pikachu, le plus célèbre des Pokémon. Les mêmes méchants, c\'est à dire, la Team Rocket.\r\n\r\nLe but de cette histoire est d\'attraper tout les Pokémon, de les entraîner et de les faire évoluer pour qu\'ils deviennent plus puissant et ainsi remporter de nombreux match pour devenir \"Le Meilleur Dresseur\".\r\n\r\n\"La version manga est un peu moins enfantine que la version télévisé car dans celle-ci, les Pokémon ne peuvent pas ou quasiment pas mourir, alors que celle du manga, les Pokémon peuvent donc mourir, et des fois de bien étrange façon... \"', 'assets/img/manga/licenses/Pokémon.jpg', 1, 15),
(27, 'Sacha 10 ans, habite le Bourg-Palette, dans la région du Kantô et son rêve, est de devenir \"le meilleur dresseur de Pokémon du monde\".\r\n\r\nIl hérite comme premier Pokémon, de Pikachu qui s\'avère au début avoir un tempérament plutôt... électrique !\r\n\r\nNotre jeune héros, rencontrera, dans son voyage, Ondine, une dresseuse de Pokémon Eau, et Pierre, qui veut lui, devenir éleveur de Pokémon.\r\n\r\nNos trois amis, seront confrontés à Jessie, James et Miaouss, membres de la Team Rocket, célèbre gang de malfaiteurs qui n\'auront de cesse de vouloir capturer Pikachu, qu\'ils prennent pour un Pokémon hors normes et puissant.\r\n\r\nLa route pour devenir Dresseur de Pokémon, sera longue et semée d\'embûches.', 'assets/img/anime/licenses/Pokémon.jpg', 2, 15),
(28, 'Employés chez Square Enix, Shogo et sa sœur Yuko n\'ont qu\'un rêve : pouvoir un jour travailler sur un opus de la série Final Fantasy. Mais ce projet va tourner court lorsqu\'un camion les fauche tous les deux. Projetés dans un village peuplé de Mogs et de Chocobos, ils comprennent qu\'ils sont désormais partie intégrante de leur univers favori... Étrangers perdus dans une contrée familière, Shogo et Yuko vont devoir réapprendre tout ce qu\'ils pensaient connaître de l\'univers de Final Fantasy et forger de nouvelles alliances afin de survivre à un monde bien plus dangereux qu\'il n\'en a l\'air. Leur rêve va bientôt tourner au cauchemar...', 'assets/img/manga/licenses/Final Fantasy.jpg', 1, 16),
(29, 'L\'histoire commença lorsque deux créatures divines (Léviathan et Bahamut) menèrent un combat acharné juste au dessus de la ville de Tokyo. La forte intensité de leur lutte créa un pilier obscur sur Terre qui inspira un sentiment de peur et de confusion dans la population. Les scientifiques chargés d\'étudier cette colonne, Joe et Marie Hayakawa, se mirent à faire des recherches sur ce phénomène. Ils partirent explorer une 1ère fois le Pays des Merveilles. En revenant ils décidèrent d\'écrire un livre, mais avant de l\'avoir rédigé ils partirent une deuxième fois et ne revinrent jamais.\r\n\r\nDouze ans plus tard, les enfants des deux scientifiques disparus, Ai et Yu Hayakawa, décident de partir sur les traces de leurs parents avec pour seule information une rumeur donnant le moyen d\'atteindre le pilier et d\'accéder au \"Monde intérieur\". Pour arriver à leurs fins, ils empruntent un métro fantôme où ils rencontrent une jeune fille nommée Lisa, qui est aussi à la recherche de quelqu\'un. Arrivés dans le monde intérieur, ils rencontrent Kaze, personnage mystérieux ayant le pouvoir d\'invoquer des créatures divines. C\'est le début d\'une longue aventure pour cette équipe de choc qui devra affronter les nombreux dangers de ce monde inconnu gouverné par \"Le Comte\".', 'assets/img/anime/licenses/Final Fantasy.jpg', 2, 16),
(30, 'C\'est l\'histoire de deux garçons poursuivant un même rêve : devenir Mangaka.\r\nLe premier, Moritaka Mashiro, est en 3ème année de collège et possède un grand talent de dessinateur. Il est amoureux d\'une fille de sa classe, Azuki, mais il n\'ose pas lui avouer ses sentiments.\r\nLe second, Akito Takagi, l\'élève le plus intelligent de la classe, remarque le talent de Mashiro et lui propose de s\'associer avec lui afin de réaliser un manga dont il serait le scénariste et Mashiro le dessinateur.\r\nMashiro refuse tout d\'abord la proposition jusqu\'au soir où Takagi et lui se retrouvent devant chez Azuki. Celle-ci leur avoue vouloir devenir Seiyû. Mashiro lui dit alors : \"Si nous arrivons à réaliser notre rêve, voudras-tu m\'épouser ? \". Elle accepte mais à condition qu\'ils ne se voient plus jusqu\'à ce que leur rêve soit devenu réalité. Leur unique moyen de communication est l\'envoie d\'e-mail.\r\nMashiro et Takagi se lancent alors dans la folle aventure de créer un manga à succès, sous le pseudonyme de Ashirogi Muto.', 'assets/img/manga/licenses/Bakuman.jpg', 1, 17),
(31, 'Moritaka Mashiro est un étudiant de neuvième année qui a un talent inné pour le dessin et Akito Takagi, le meilleur élève de sa classe veut devenir mangaka.\r\nAprès beaucoup d\'argumentation, Takagi convainc Mashiro de s\'associer pour créer ensemble le meilleur manga que le Japon n\'ait jamais eu.\r\nTakagi avec son don pour l\'écriture espère devenir un très grand mangaka et Mashiro avec son talent pour le dessin espère se marier avec la fille de ses rêves, Azuki Miho.', 'assets/img/anime/licenses/Bakuman.jpg', 2, 17),
(32, 'Keitarô Urashima est un étudiant de 19 ans qui semble avoir tout raté. Peu populaire auprès des filles, il a raté plusieurs fois l\'examen d\'entrée de Tôdai (Tokyo Daigaku, l\'université de Tokyo), au grand dam de ses parents, qui décident de mettre à la porte leur bon à rien de fils. La mine triste et ses rêves d\'avenir brisés, Keitarô décide toutefois de ne pas se laisser abattre : il décide d\'aller rendre visite à sa grand mère, qui tient une pension pour jeunes filles, la pension Hinata.\r\n\r\nAprès un mauvais accueil de la part des pensionnaires et apprenant que sa grand mère est en fait partie faire le tour du monde, Keitarô est désormais obligé de devenir le nouveau gérant de la pension.', 'assets/img/manga/licenses/Love Hina.jpg', 1, 18),
(33, 'A 20 ans, Keitaro s\'accroche et tente d\'entrer à Todai. Il a déjà raté le concours d\'admission par deux fois. Pour l\'instant, le souci de Keitaro est de trouver un logement pour ne pas retourner vivre avec ses parents qui le poussent à abandonner Todai. Il se rend à la pension Hinata la pension de sa grand-mère. Dans cette pension pour jeunes filles, les locataires le prennent pour un voyeur et lui en font voir de toutes les couleurs. Il est sauvé par sa tante, Haruka, qui habite près de la pension et vient voir les pensionnaires, en l\'absence de la grand-mère partie faire le tour du monde.\r\n\r\n', 'assets/img/anime/licenses/Love Hina.jpg', 2, 18),
(34, 'Doraemon est un robot à allure de chat venu du futur pour aider Nobita, un jeune garçon irresponsable et maladroit qui se fait souvent gronder par sa mère ou ses professeurs. En réalité c\'est le petit fils de Nobita qui a envoyé Doraemon dans le passé pour sauver le futur de sa famille. Le destin ne sera pas facile à changer.', 'assets/img/manga/licenses/Doraemon.jpg', 1, 19),
(35, 'Doraemon est un robot-chat bleu envoyé dans le passé par le descendant du jeune Nobi Nobita, afin d\'aider ce dernier à rembourser ses dettes qui se sont accumulées dans le futur et que tous ses descendants doivent, maintenant, payer.\r\n\r\nDoraemon aide le petit garçon en lui prêtant un nombre incalculable de gadgets futuristes (normal, il vient du futur, me direz-vous !).\r\n\r\nMais Nobita, ne se sert pas toujours adroitement de ces objets, ce qui provoque bon nombre de situations farfelues.', 'assets/img/anime/licenses/Doraemon.jpg', 2, 19),
(36, 'Shinichi Kudo est un brillant lycéen promis à un grand avenir. Il vit seul car ses parents vivent aux États-Unis, mais il passe beaucoup de temps avec Ran, son amie d\'enfance qu\'il aime en secret, ou avec le professeur Agasa. C\'est un excellent détective, qui a le sens de l\'observation et un très bon esprit de déduction, mais un jour, il va se faire surprendre alors qu\'il espionnait deux hommes en noir suspects. Ils lui feront alors prendre un médicament censé le tuer, mais qui va le faire rajeunir et il redeviendra un enfant de 6 ans. Coincé dans ce corps, Shinichi se fera alors passer pour Conan Edogawa, neveu du professeur, et se fera \"adopter\" par Ran dont le père est détective privé. Conan espère ainsi retrouver les hommes en noir, et enfin redevenir lui même.', 'assets/img/manga/licenses/Détective Conan.jpg', 1, 20),
(37, 'Shinichi Kudo est élève en première au lycée Tivedétec (Teitan). Pour avoir résolu plusieurs enquêtes difficiles, il est considéré par beaucoup comme l\'aide la plus précieuse que la police japonaise pouvait espérer.\r\n\r\nUn jour, lors d\'une sortie avec son amie Ran Mouri dans un parc d\'attraction après avoir résolu une affaire de meurtre, il fait la rencontre d\'hommes étranges vêtus de noir qu\'il avait vus précédemment sur les lieux d\'un crime. Par curiosité et intuition, Shinichi les suit et comprend que ce sont des maîtres chanteurs. L\'ayant découvert, ils lui font boire un poison expérimental pour le faire taire. L\'effet est inattendu : son corps rajeunit, mais ses facultés de détective restent inchangées. Shinichi, aidé par son voisin le Dr. Agasa, inventeur génial et farfelu, décide de partir à la recherche de l\'organisation secrète dont il a été victime. Shinichi cache sa véritable identité sous le pseudonyme de Conan Edogawa (de Sir Arthur Conan Doyle et d\'Edogawa Ranpo), et se réfugie chez Ran, dont le père encore peu connu, Kogoro Mouri, s\'est mis à son compte en tant que détective privé après avoir quitté la police.\r\n\r\nShinichi trouve vraiment injuste le fait que, adulte, tout le monde l\'écoutait, et que enfant, on ne lui accorde aucun moment où il peut résoudre une affaire. Il résout les affaires bien plus vite que le père de Ran, mais il est obligé d\'attendre le bon moment pour faire en sorte que Mouri comprenne son \"point de vue\" sans attirer l\'attention sur lui...\r\n\r\nDepuis l\'arrivée de Conan, Mouri commence à être de plus en plus célèbre. En effet, régulièrement, lorsque Conan a enfin élucidé le mystère d\'une affaire sur laquelle Mouri travaille, il endort ce dernier avec un gadget fabriqué par Agasa inclus dans sa montre, qui peut tirer un projectile hypodermique. Il se cache ensuite, et, grâce à son nœud papillon (un autre gadget d\'Agasa), prend la voix de Kogoro (Il arrive aussi que Conan soit obligé de prendre la voix de quelqu\'un d\'autre). Kogoro Mouri est donc appelé le \"détective endormi\" (Nemuri no Kogoro en japonais), à cause de son air assoupi pendant qu\'il \"résout\" une affaire. Kogoro et Ran ne connaissent pas la vraie identité de Conan. Aussi, lorsque Conan fait une déduction en public, Ran s\'étonne. Conan s\'en tire souvent par une pirouette, tandis que Mouri s\'énerve car il trouve qu\'un enfant n\'a pas à se trouver sur les lieux d\'un crime ni à essayer de les résoudre...', 'assets/img/anime/licenses/Détective Conan.jpg', 2, 20),
(38, 'En 2022, Kirito, un adolescent sans histoire, se retrouve piégé avec 10 000 autres joueurs dans un jeu en réalité augmentée massivement multijoueurs : Sword Art Online. Pour regagner leur liberté, les joueurs devront compléter les 100 étages qui composent l\'Aincrad, leur prison virtuelle. Mais le moindre faux pas pourrait être fatal, puisqu\'un Game Over dans le jeu entraînera une mort réelle. Kirito, le joueur solo, se lance dans une course effrénée pour sa survie, dans un monde où l\'art de l\'épée dicte la loi des plus forts.', 'assets/img/manga/licenses/Sword Art Online.jpg', 1, 21),
(39, 'Cette série raconte les aventures de Kirito qui se retrouve piégé dans un jeu massivement multi-joueurs, Sword Art Online.\r\n\r\nEn 2022, l\'humanité a réussi à créer une réalité virtuelle. Grâce à un casque, les humains peuvent se plonger entièrement dans le monde virtuel en étant comme déconnectés de la réalité, et Sword Art Online est le premier MMORPG a utiliser ce système. Mais voila que le premier jour de jeu, 10 000 personnes se retrouvent piégées dans cette réalité virtuelle par son créateur : Akihiko Kayaba. Le seul moyen d\'en sortir est de finir le jeu. Mais ce ne sera pas facile de sortir de ce monde virtuel puisque si un joueur perd la partie, il meurt également dans la vraie vie.\r\n\r\nKirito décide alors de partir à la conquête du jeu en solo, avec pour avantage le fait de faire partie des 1 000 ex-bêta-testeurs, mais arrivera-t-il à terminer les 99 donjons et leurs boss ?\r\n\r\n\"Même si cela semble être un jeu vidéo, ce n\'est pas un jeu\r\nAkihiko Kayaba - Créateur de Sword Art Online', 'assets/img/anime/licenses/Sword Art Online.jpg', 2, 21);

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_producerroles`
--

DROP TABLE IF EXISTS `42pmz96_producerroles`;
CREATE TABLE IF NOT EXISTS `42pmz96_producerroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_producerRoles_AK` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_producerroles`
--

INSERT INTO `42pmz96_producerroles` (`id`, `role`) VALUES
(6, 'auteur'),
(2, 'dessinateur'),
(4, 'magazine'),
(3, 'réalisateur'),
(1, 'scénariste'),
(5, 'studio');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_producers`
--

DROP TABLE IF EXISTS `42pmz96_producers`;
CREATE TABLE IF NOT EXISTS `42pmz96_producers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `picture` varchar(255) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `id_42pmz96_producerTypes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_producers_AK` (`name`),
  KEY `42pmz96_producers_42pmz96_producerTypes_FK` (`id_42pmz96_producerTypes`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_producers`
--

INSERT INTO `42pmz96_producers` (`id`, `description`, `picture`, `name`, `id_42pmz96_producerTypes`) VALUES
(2, 'Kazumasa Hirai est un auteur japonais qui écrit des romans et également des mangas. Il est est réputé pour avoir créé le manga de science-fiction : 8 man . On peut également noté qu\'il a aussi écrit l\'adaption en manga de spiderman.', 'assets/img/producers/Kazumasa Hirai.jpg', 'Kazumasa Hirai', 3),
(3, 'Le Weekly Shōnen Magazine, originellement intitulé Shūkan Shōnen Magajin, est un magazine hebdomadaire orienté vers l’action et mettent en scène des protagonistes aux capacités/pouvoirs extraordinaires. Le premier numéro du magazine est publié le 17 mars 1959, une semaine avant le début de la publication du Weekly Shōnen Sunday, l\'un de leurs principaux concurrents. ', 'assets/img/producers/Weekly shônen Magazine.jpg', 'Weekly shônen Magazine', 2),
(4, '', '', 'Kagawa Noriyasu', 4),
(5, '', '', 'takumi hiraboshi', 3),
(6, '', '', 'Shin\'ichirō Nariie', 3),
(7, 'Monthly Comic Alive est un magazine de prépublication de mangas mensuel de type seinen publié par Media Factory lancé en juin 2006.', 'assets/img/producers/monthly comic alive.jpg', 'monthly comic alive', 2),
(8, 'Eiken est un studio d\'animation japonais créé le 10 mars 1969 et anciennement connu sous le nom de Tele-Cartoon Japan. ', 'assets/img/producers/Eiken.jpg', 'Eiken', 1),
(9, '', '', 'Tōru Oiwaka', 3),
(10, '', '', 'Atsushi Nakayama', 4),
(11, '', '', ' 	 Takamitsu Kōno', 4),
(12, '8 Bit était à l\'origine un studio de Satelight et a été impliqué dans la production de plusieurs ouvrages dont Noein, Sousei no Aquarion et Macross F. Il est devenu indépendant en Septembre 2008. Son siège social est situé à Suginami, Tokyo, Japon.', 'assets/img/producers/8-Bit.jpg', '8-Bit', 1),
(13, '', 'assets/img/producers/yokusaru shibata.jpg', 'yokusaru shibata', 3),
(15, 'Né à Tokyo un 11 février, Shun Matsuena fait une école de manga dans laquelle il sera très remarqué avec &quot;Le chevalier et le voyageur&quot;, une œuvre particulièrement originale. Il connaît ses débuts professionnels avec le manga &quot;La porte du Valhalla&quot; dans une édition spéciale du célèbre magazine Sunday. Il connaît enfin le succès avec la série &quot;À l\'attaque Ryôzanpaku! L\'invincible disciple&quot; qui paraît dans le même magazine. Ce titre est tellement populaire qu\'il est interrompu, pour être retravaillé et relancé en gardant les éléments de base sous le titre &quot;Kenichi le disciple ultime&quot;, qui est toujours publié aujourd\'hui dans le Shônen Sunday.', 'assets/img/producers/syun matsuena.jpg', 'syun matsuena', 3),
(16, 'Young Animal est un magazine de prépublication de manga japonais appartenant à la société Hakusensha. Il a été créé en 1989 sous le nom de Animal House.\r\nIl a un rythme de parution bimensuel et produit des mangas pour adulte seinen ou érotique ecchi. Le magazine possède une édition parallèle nommé Young Animal Arachi, qui lui est mensuel, et est publié en format B5 ', 'assets/img/producers/Young Animal.jpg', 'Young Animal', 2),
(17, '', '', 'Daisuke Nishio', 4),
(18, '', '', 'Ikehata hiroshi', 4),
(19, '', '', 'Hyodo kazuho', 4),
(20, 'Gonzo K.K. est un studio de films et séries d\'animation japonais fondé le 11 septembre 1992 par Shōji Murahama, Mahiro Maeda, Hiroshi Yamaguchi et Shinji Higuchi.\r\nLa première production animée du studio est Blue submarine n°6, une série d\'OAV sortie en 1998 remarquée par son utilisation de CG. Gonzo a aussi produit un certain nombre de séries TV comme Full Metal Panic!, Last Exile ou encore Gankutsuō.\r\nDepuis 2006, Gonzo s\'est mis à la production de film d\'animation dont le premier fut Origine. ', 'assets/img/producers/Gonzo.jpg', 'Gonzo', 1),
(21, 'Leiji Matsumoto, né Akira Matsumoto le 25 janvier 1938 à Kurume sur l\'île de Kyūshū dans la préfecture de Fukuoka, est un dessinateur japonais de manga et anime.\r\nIl est principalement connu pour avoir créé un univers de science-fiction où se déroule notamment les manga Yamato Le Cuirassé de l’Espace, les aventures du Capitaine Albator et du Galaxy Express 999, dont les adaptations en série d\'animation ont fait le tour du monde. Considéré au Japon comme un maitre du manga, il a reçu de hautes distinctions et des prix pour ses œuvres. ', 'assets/img/producers/Leiji Matsumoto.jpg', 'Leiji Matsumoto', 3),
(22, '', '', 'Chûkosha', 2),
(23, 'Magazine seinen des éditions Akita shoten, crée en 1968. Il parait deux fois par mois le jeudi (2em et 4em)', 'assets/img/producers/Play Comic.jpg', 'Play Comic', 2),
(24, 'Champion Red est un magazine de prépublication de mangas mensuel édité par Akita Shoten depuis le 19 août 2002. D\'abord magazine shōnen, le magazine a changé de public cible et est devenu un magazine seinen en 20111.\r\nUn magazine dérivé nommé Champion Red Ichigo parait de façon bimestrielle2. ', 'assets/img/producers/Champion RED.jpg', 'Champion RED', 2),
(25, 'Kôichi (Kouiti) Shimahoshi est un dessinateur japonais de manga. Son pseudonyme aurait été choisi par Leiji Matsumoto lui même.\r\nIl débute ses publications avec Captain Harlock - Dimension Voyage. Sous la directive de Matsumoto, il s’applique à dessiner de œuvres qui pourront plaire aux lecteurs du monde entier. ', 'assets/img/producers/Shimaboshi Kouiti .jpg', 'Shimaboshi Kouiti ', 3),
(26, 'Sadayuki Murai, né en 1964, est un scénariste japonais qui exerce dans les séries et longs-métrages d\'animation.\r\nIl a notamment collaboré à Perfect Blue, Millennium Actress, Kino no Tabi, Gilgamesh, Gad Guard (en) et Steamboy. ', 'assets/img/producers/Sadayuki Murai.jpg', 'Sadayuki Murai', 4),
(27, 'Rintarō, de son vrai nom Shigeyuki Hayashi, est un réalisateur de série et de films d\'animation né le 22 janvier 1941 à Tōkyō au Japon. ', 'assets/img/producers/Rintaro.jpg', 'Rintaro', 4),
(28, 'Madhouse Inc. est un studio de films et séries d\'animation japonais fondé le 17 octobre 1972 par d\'anciens employés de Mushi Production dont Masao Maruyama, Osamu Dezaki, Rintaro, et Yoshiaki Kawajiri.\r\nLa première réalisation du studio est l\'adaptation en anime de Ace o Nerae! en collaboration avec TMS. Depuis lors, le studio a travaillé sur de nombreux films à succès comme Ninja Scroll, Vampire Hunter D : Bloodlust, Perfect Blue ou La traversée du temps. Il a également travaillé sur de nombreuses séries télévisées comme Sakura chasseuse de cartes, Trigun, X, Paranoia agent, Death Note, Parasite ou encore le remake de Hunter × Hunter. ', 'assets/img/producers/MadHouse.jpg', 'MadHouse', 1),
(29, 'Né le 11 mars 1961 dans la préfecture de Yamanashi, Masayuki Kojima (小島 正幸) débute sa carrière dans les années 1980, en travaillant en tant que free-lance pour divers studios d\'animation, dont Knack Productions et la Tatsunoko. Il officia même pour quelques séries occidentales, comme et The Real Ghostbusters.\r\nIl rejoint Madhouse au début de la décennie suivante, studio dans lequel il officie encore à l\'heure actuelle. Après quelques travaux d\'animateur ou de storyboarder (notamment sur ), il est à la tête de son premier film d\'animation en 1998.', 'assets/img/producers/Masayuki Kajima.jpg', 'Masayuki Kajima', 4),
(30, '', 'assets/img/producers/tatsuhiko Urahata.jpg', 'tatsuhiko Urahata', 4),
(31, '', '', 'Soichiro Zen', 4),
(32, 'TV Tokyo Corporation (ou TX) est une chaîne de télévision japonaise du réseau TXN, basé au Japon1. ', 'assets/img/producers/TV Tokyo Medianet.png', 'TV Tokyo Medianet', 1),
(33, 'Toei Animation Co., Ltd. est un studio de production de films et séries d\'animation japonais fondé le 23 janvier 1948 sous le nom de Nihon Dōga. C\'est une filiale de la société cinématographique japonaise Toei depuis juillet 1956.\r\nLa première production de Toei Animation est le film Le Serpent blanc, sorti dans les salles nippones en 1958. Depuis, le studio a produit de nombreux films et séries dont plusieurs adaptations des travaux de Go Nagai (Goldorak, Mazinger…), de Leiji Matsumoto (Albator, Galaxy Express 999…), de Masami Kurumada (Saint Seiya, Fūma no Kojirō, Ring ni Kakero…), d\'Akira Toriyama (Docteur Slump, Dragon Ball…), de Naoko Takeuchi (Sailor Moon) et de Eiichiro Oda (One Piece).\r\nLe symbole du studio est le chat Pero, personnage principal du film Le Chat Botté sorti en 1969. ', 'assets/img/producers/Toei animation.png', 'Toei animation', 1),
(34, 'Réalisateur japonais né le 4 février 1938 à Shimoda.', 'assets/img/producers/tomoharu katsumata.jpg', 'tomoharu katsumata', 4),
(35, '', '', 'Hirokazu Onaka', 4),
(36, 'Weekly Shōnen Jump, fréquemment abrégé en Shōnen Jump, est un magazine de prépublication de mangas hebdomadaire de type shōnen créé par l’éditeur Shūeisha le 11 juillet 1968 et toujours en cours de publication. Il fit partie de la gamme de presse « Jump » de l’éditeur, celle-ci étant destinée à un public masculin de tous âges. Le Shōnen Jump réalise un tirage historique à 6,53 millions d\'exemplaires en 19942. Le magazine est mondialement connu pour ses séries comme Dragon Ball, One Piece, Naruto ou encore Bleach.\r\nLa rédaction du Shōnen Jump organise trois prix. Le Prix Tezuka consacré aux récits à intrigues, le Prix Akatsuka pour les récits comiques et le Jump New World Manga Award décerné tous les mois.\r\nDepuis 2014, le magazine dispose de sa propre plateforme de lecture en ligne : Shōnen Jump+3. Fin janvier 2019, une version internationale en anglais de la plateforme est sortie sous le nom de Manga Plus. ', 'assets/img/producers/Weekly shônen JUMP.png', 'Weekly shônen JUMP', 2),
(37, 'Lerche est une marque de production d\'animation japonaise du Studio Hibari créée en 2011.\r\nLa majorité des projets du Studio Hibari ont été réalisés sous cette marque depuis sa création.\r\nLerche est aussi connu pour être le premier studio d\'animation adaptant un manga français, en l\'occurrence Radiant de Tony Valente2. ', 'assets/img/producers/Lerche.jpg', 'Lerche', 1),
(38, 'Brain\'s Base Inc. est un studio d\'animation japonais fondé en juillet 1996. ', 'assets/img/producers/Brains Base.jpg', 'Brains Base', 1),
(39, 'Keiji Gotoh est un réalisateur japonais de dessins animés, créateur de personnages, artiste manga et membre de l\'équipe de production gímik composée de trois personnes dont les œuvres incluent Kiddy Grade et Uta Kata.', 'assets/img/producers/keiji goto.jpg', 'keiji goto', 4),
(40, 'Yūsei Matsui est un mangaka japonais né le 31 janvier 1979 à Saitama.\r\nIl fut l\'assistant de Yoshio Sawai, célèbre pour être l\'auteur du shōnen comique Bobobo-bo Bo-bobo. Matsui est aujourd\'hui connu pour être l\'auteur des mangas Neuro, le mange-mystères et Assassination Classroom. ', 'assets/img/producers/yusei matsui.jpg', 'yusei matsui', 3),
(41, 'Seiji Kishi est un réalisateur d\'anime né au Japon dans la préfecture de Shiga. Il étudiera à la Yoyogi Animation Gakuin avant de devenir réalisateur. ', 'assets/img/producers/kishi seiji.jpg', 'kishi seiji', 4),
(42, 'Makoto Uezu est un scénariste japonais travaillant surtout dans le monde de l\'animation. On peut compter parmi ses œuvres Utawarerumono (Le Chant des rêves), Seto no Hanayome et School Days.', 'assets/img/producers/uezu makoto.jpg', 'uezu makoto', 4),
(43, 'Taito Kubo, de son vrai nom Noriaki Kubo, originaire d\'Hiroshima au Japon, né le 26 juin 1977, est un auteur de manga.', 'assets/img/producers/tite kubo.jpg', 'tite kubo', 3),
(44, '', '', 'Ôba Atsushi', 3),
(45, 'Saikyō Jump est un magazine de prépublication de mangas bimestriel de type shōnen des éditions Shūeisha créé en décembre 2010. D\'abord saisonnier, il devient mensuel en décembre 20111 avant de passe bimestriel en septembre 20142. Il est spécialisé dans les mangas humoristique arborant un graphisme SD. ', 'assets/img/producers/Saikyō Jump.jpg', 'Saikyō Jump', 2),
(46, 'Noriyuki Abe est un réalisateur de série d\'animation (Anime) né dans 19 juillet 1961 au Japon.\r\nSes réalisations sont pour la plupart du type shōnen et plus spécialement du sous-genre Nekketsu comme Yū Yū Hakusho ou Bleach. On notera l\'exception de Tokyo Mew Mew, du genre Magical girl. ', 'assets/img/producers/abe noriyuki.jpg', 'abe noriyuki', 4),
(47, 'Natsuko Takahashi est une scénariste et dessinatrice japonaise.\r\nElle est membre de Nihon Kyakuhonka Renmei, la guilde des écrivains du Japon.\r\nElle a fait ses débuts dans l\'animation en 1988, travaillant comme animatrice pour le long métrage &quot;Akira&quot; et participant l\'année suivante à &quot;Little Nemo - Adventures in Slumberland&quot;.', 'assets/img/producers/takahashi Natsuko.jpg', 'takahashi Natsuko', 4),
(48, 'Pierrot Co.,Ltd. , aussi connu sous le nom de studio Pierrot (studioぴえろ?), est un studio de films et séries d\'animation japonais fondé en mai 1979 par Yūji Nunokawa et d\'anciens membres du studio Tatsunoko dont Hisayuki Toriumi et Mamoru Oshii.\r\nSon nom, Pierrot, vient du japonais ピエロ (Piero) qui signifie Clown. Ce mot est dérivé du français Pierrot, qui est un type de clown de la Commedia dell\'arte.\r\nLe studio Pierrot a été longtemps spécialisé dans le magical girl avec des séries à succès comme Creamy, merveilleuse Creamy, Fancy Lala ou plus récemment Tokyo Mew Mew. Mais depuis le début des années 2000, le studio se tourne davantage vers des productions plus shōnen comme Great Teacher Onizuka, Bleach, Hikaru no go, Beelzebub ou encore Naruto. ', 'assets/img/producers/Pierrot.jpg', 'Pierrot', 1),
(49, 'Takao Aoki fait ses débuts avec La légende de Maga. Depuis, il se consacre aux manga spécialisés dans la jeunesse avec des séries pleines de fraîcheur et de dynamisme.', 'assets/img/producers/Takao Aoki.jpg', 'Takao Aoki', 3),
(50, 'Monthly CoroCoro Comic est un magazine de prépublication de mangas mensuel de type kodomo publié par Shōgakukan depuis le 15 mai 1977. Certaines des séries publiées dans ses pages sont devenues de véritables phénomènes au Japon, tel que Doraemon, mais il est surtout connu pour publier une majorité de mangas adaptés le plus souvent de jeux vidéo, tel que Pokémon, Super Mario, Megaman, Kirby ou encore Crash Bandicoot.\r\nLe magazine a trois dérivés : Bessatsu CoroCoro Comic et CoroCoro Ichiban!, tous deux bimensuels, ainsi que CoroCoro Aniki, publié à un rythme trimestriel. ', 'assets/img/producers/Corocoro Comic.jpg', 'Corocoro Comic', 2),
(51, 'Hiro Morita est un mangaka japonais.', 'assets/img/producers/Morita Hiro.jpg', 'Morita Hiro', 3),
(52, 'Le studio OLM est fondé en juin 1994 par Toshiaki Okuno (ja) et Shūkichi Kanda (ja), respectivement producteur chez O.B Planning et Studio Pastel ainsi qu\'avec les animateurs Kunihiko Yuyama, Naohito Takahashi, Yuriko Chiba, Takaya Mizutani, Kazuaki Mōri et d\'autres. ', 'assets/img/producers/OLM.png', 'OLM', 1),
(53, 'SynergySP est un studio de films et séries d\'animation japonais fondé le 24 septembre 1998. \r\nEn 1998, plusieurs membres du Studio Juno, spécialisé dans la sous-traitance notamment pour Toei Animation, dont Minoru Okazaki et Minoru Maeda partent fonder un nouveau studio, Synergy Japan. Le studio commence en tant que sous-traitants pour d\'autres studios comme Nippon Animation. En 2003, le studio fait sa première coproduction, Mermaid Melody, en partenariat avec le studio Actas.\r\n\r\nEn 2005, le studio forme un partenariat avec l\'éditeur Shōgakukan et change de nom pour SynergySP. Le studio anime essentiellement des mangas issus des magazines de l\'éditeur comme Weekly Shōnen Sunday ou encore Ciao.\r\n\r\nEn avril 2017, le studio devient une filiale de Shin-Ei Animation. Sōjirō Masuko, ancien réalisateur et producteur en chef, est placé à la tête de la société1. ', 'assets/img/producers/SynergySp.jpg', 'SynergySp', 1),
(54, 'Katsuhito Akiyama, né le 29 janvier 1950) est un scénariste et réalisateur japonais. [1] Il travaille souvent avec Shinji Aramaki et Hideki Kakinuma. ', 'assets/img/producers/katsuhito akiyama.jpg', 'katsuhito akiyama', 4),
(55, 'Sugishima a commencé sa carrière sur Sunrise dans les années 1980, [1] ayant travaillé comme cadre producteur pour Heavy Metal L-Gaim \' épisodes de 1 à 18, ainsi que le directeur et storyboarder pour d\' autres épisodes. [2] Un autre travail majeur dans sa première carrière était son implication avec la série Gundam ; il a réalisé quelques épisodes de Mobile Suit Zeta Gundam et Mobile Suit Gundam ZZ . [3] [4] Son premier travail en tant que directeur principal était en 1994 quand il a dirigé à Sunrise un spécial d\'épisode unique intitulé Shinizokonai Kakarichō . [5]Ses œuvres ultérieures n\'étaient pas à Sunrise; il a réalisé Gokudo (1999) à Trans Arts, Yu-Gi-Oh! Duel Monsters (2000–2004) à Gallop , [7] et Speed ​​Grapher (2005) à Gonzo . [1] Pour cette dernière société, il a également dirigé l\' animation vidéo originale Strike Witches en 2007. [8] Après avoir dirigé Nabari no Ou chez JCStaff en 2008, [9] il est allé diriger quatre séries télévisées liées à Beyblade et un film à Tatsunoko Productions et SynergySPentre 2009 et 2012. [10] Il est retourné travailler pour Sunrise où il était le directeur de deux anime Battle Spirits ; Burning Soul (2015) et Double Drive (2016). \r\n', 'assets/img/producers/kunihisa sugishima.jpg', 'kunihisa sugishima', 4),
(56, '', 'assets/img/producers/Kawase toshifumi.jpg', 'Kawase toshifumi', 4),
(57, '', 'assets/img/producers/urahata tatsuhiko.jpg', 'urahata tatsuhiko', 4),
(58, '', 'assets/img/producers/nippon animedia.jpg', 'nippon animedia', 1),
(59, 'Hideki Sonoda est né en 1957 à Tosu, Saga Prefecture au Japon. C\'est un scénariste japonais, actif principalement dans le domaine des animes. Il a fait ses débuts en tant que scénariste en 1982 avec Robotino, suivi de plusieurs autres séries télévisées telles que Mila et Shiro, Magical Magic Emi, Hilary, Kidō senshi Victory Gundam et Holly et Benji. Il a également travaillé sur tous les produits animés de franchises Pokémon depuis la première série de télévision de 1999.', 'assets/img/producers/Sonoda Hideki.jpg', 'Sonoda Hideki', 4);

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_producersproducts`
--

DROP TABLE IF EXISTS `42pmz96_producersproducts`;
CREATE TABLE IF NOT EXISTS `42pmz96_producersproducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_42pmz96_producerRoles` int(11) NOT NULL,
  `id_42pmz96_products` int(11) NOT NULL,
  `id_42pmz96_producers` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_ProducersProducts_42pmz96_producerRoles_FK` (`id_42pmz96_producerRoles`),
  KEY `42pmz96_ProducersProducts_42pmz96_products0_FK` (`id_42pmz96_products`),
  KEY `42pmz96_ProducersProducts_42pmz96_producers1_FK` (`id_42pmz96_producers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_producertypes`
--

DROP TABLE IF EXISTS `42pmz96_producertypes`;
CREATE TABLE IF NOT EXISTS `42pmz96_producertypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_producerTypes_AK` (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_producertypes`
--

INSERT INTO `42pmz96_producertypes` (`id`, `name`) VALUES
(4, 'animateur'),
(2, 'magazine'),
(3, 'mangaka'),
(1, 'studio');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_products`
--

DROP TABLE IF EXISTS `42pmz96_products`;
CREATE TABLE IF NOT EXISTS `42pmz96_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `itemNumber` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `id_42pmz96_licenses` int(11) DEFAULT NULL,
  `id_42pmz96_universes` int(11) NOT NULL,
  `id_42pmz96_productTypes` int(11) NOT NULL,
  `id_42pmz96_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_products_42pmz96_universes0_FK` (`id_42pmz96_universes`),
  KEY `42pmz96_products_42pmz96_productTypes1_FK` (`id_42pmz96_productTypes`),
  KEY `42pmz96_products_42pmz96_status2_FK` (`id_42pmz96_status`),
  KEY `42pmz96_products_42pmz96_licenses_FK` (`id_42pmz96_licenses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_productstargetsgenres`
--

DROP TABLE IF EXISTS `42pmz96_productstargetsgenres`;
CREATE TABLE IF NOT EXISTS `42pmz96_productstargetsgenres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_42pmz96_products` int(11) NOT NULL,
  `id_42pmz96_genres` int(11) NOT NULL,
  `id_42pmz96_targets` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_productsTargetsGenres_42pmz96_products_FK` (`id_42pmz96_products`),
  KEY `42pmz96_productsTargetsGenres_42pmz96_genres0_FK` (`id_42pmz96_genres`),
  KEY `42pmz96_productsTargetsGenres_42pmz96_targets1_FK` (`id_42pmz96_targets`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_producttypes`
--

DROP TABLE IF EXISTS `42pmz96_producttypes`;
CREATE TABLE IF NOT EXISTS `42pmz96_producttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_productTypes_AK` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_producttypes`
--

INSERT INTO `42pmz96_producttypes` (`id`, `name`) VALUES
(4, 'film'),
(3, 'oav'),
(1, 'oneshot'),
(2, 'serie');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_roles`
--

DROP TABLE IF EXISTS `42pmz96_roles`;
CREATE TABLE IF NOT EXISTS `42pmz96_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_roles_AK` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_roles`
--

INSERT INTO `42pmz96_roles` (`id`, `role`) VALUES
(1, 'administrateur'),
(2, 'membre'),
(4, 'modérateur'),
(3, 'rédacteur');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_status`
--

DROP TABLE IF EXISTS `42pmz96_status`;
CREATE TABLE IF NOT EXISTS `42pmz96_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_status_AK` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_status`
--

INSERT INTO `42pmz96_status` (`id`, `name`) VALUES
(3, 'à venir'),
(1, 'en cours'),
(4, 'en pause'),
(2, 'terminé');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_targets`
--

DROP TABLE IF EXISTS `42pmz96_targets`;
CREATE TABLE IF NOT EXISTS `42pmz96_targets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_targets_AK` (`target`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_targets`
--

INSERT INTO `42pmz96_targets` (`id`, `target`) VALUES
(3, 'Jôsei'),
(4, 'Kodomo'),
(1, 'Seinen'),
(5, 'Shôjo'),
(2, 'Shônen');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_universes`
--

DROP TABLE IF EXISTS `42pmz96_universes`;
CREATE TABLE IF NOT EXISTS `42pmz96_universes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `universe` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_universes_AK` (`universe`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_universes`
--

INSERT INTO `42pmz96_universes` (`id`, `universe`) VALUES
(2, 'anime'),
(3, 'global'),
(1, 'manga');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_users`
--

DROP TABLE IF EXISTS `42pmz96_users`;
CREATE TABLE IF NOT EXISTS `42pmz96_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `subscribDate` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `desactivationDate` datetime DEFAULT NULL,
  `statu` tinyint(1) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `id_42pmz96_roles` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `42pmz96_users_AK` (`username`,`mail`),
  KEY `42pmz96_users_42pmz96_roles_FK` (`id_42pmz96_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_users`
--

INSERT INTO `42pmz96_users` (`id`, `password`, `birthdate`, `subscribDate`, `image`, `desactivationDate`, `statu`, `username`, `mail`, `id_42pmz96_roles`) VALUES
(1, '$2y$10$OxB8uUEasuKbudGo.eFOPeKyKLRqU5EcM3Qv4PsKQ1WkKggHuOqbC', '1992-06-18', '2020-08-25 12:12:08', 'assets/img/users/totojo_2020-08-27_11-29-44.jpg', NULL, 1, 'totojo', 'totojo-1@hotmail.fr', 1),
(2, '$2y$10$I1VwApaKWcQ3FteTZcf5p.yosYXFnOMT.rbgnoplHGw2CVMo.PrdK', '2000-03-10', '2020-08-14 16:14:48', '/assets/img/iconUser.png', '2020-09-09 12:44:33', 0, 'test', 'test@hotmail.fr', 2),
(3, '$2y$10$kAW/0Za0GlugYqgKCKeYS.xJfdlE00EaLflXdJ./o9WNhPPNbgFVq', '1996-12-25', '2020-08-26 10:04:22', 'assets/img/users/moderateur_2020-08-26_10-04-22.jpg', NULL, 1, 'moderateur', 'moderateur@gmail.com', 4),
(4, '$2y$10$hVUfyJLXsaI.kopqa6sCU.gAsChCOPEVIFTchRCajhZIuPgMrpkSK', '2000-08-11', '2020-08-27 14:38:27', 'assets/img/iconUser.png', NULL, 1, 'tonyChopper', 'tony@gmail.com', 2),
(5, '$2y$10$kfzLB44fTD7stpYVEI8oEuIPwKp4N6BVtkh1DODaHSK4bKIjwM19W', '1983-09-10', '2020-09-07 12:33:23', 'assets/img/iconUser.png', NULL, 1, 'Jeromeo', 'jeromeoo@yhoo.com', 2),
(6, '$2y$10$IgDugL68U0s6r5IXotKkGOXjBw9KfIxxMGX.8r80hyqK9XnzR88ei', '1995-08-02', '2020-09-08 08:15:38', 'assets/img/iconUser.png', NULL, 1, 'Mealya-Sama', 'matthieugrislin@hotmail.fr', 2),
(12, '$2y$10$G5u.EN8JXEGkkhR8TCO0TeTw8KDb1iJvteFdQidda4YjWWO6E6eMq', '1982-05-07', '2020-09-08 12:13:55', 'assets/img/users/Kamelo_2020-09-08_12-13-55.png', NULL, 1, 'Kamelo', 'kam_7@hotmail.fr', 2),
(13, '$2y$10$NG5mBhsPmfJstLtBXFT3VuhhLE7MwvWUPCma3895Gl.q9gz9uHQD6', '1984-08-11', '2020-09-09 11:29:41', 'assets/img/iconUser.png', '2020-09-22 13:01:40', 0, 'maimounap7', 'maimouna@live.com', 2),
(14, '$2y$10$4EgLnE59AtHnk6wvHNJIOOJVcJ.DzBlk0VBZ.YQzhEFriKP0FBJtC', '1995-08-02', '2020-09-09 14:20:17', 'assets/img/iconUser.png', NULL, 1, 'matthieu', 'moi@moi.moi', 2),
(15, '$2y$10$5IR2030p2n6w0XpGDYfU6OsxBhvA2Btt46znu2HTokghqjWFZSZpO', '1993-09-13', '2020-09-15 12:33:50', 'assets/img/users/Lewis722_2020-09-15_12-33-50.png', NULL, 1, 'Lewis722', 'lamericain@usa.us', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `42pmz96_comments`
--
ALTER TABLE `42pmz96_comments`
  ADD CONSTRAINT `42pmz96_comments_42pmz96_products_FK` FOREIGN KEY (`id_42pmz96_products`) REFERENCES `42pmz96_products` (`id`),
  ADD CONSTRAINT `42pmz96_comments_42pmz96_users0_FK` FOREIGN KEY (`id_42pmz96_users`) REFERENCES `42pmz96_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `42pmz96_listemayhaveproducts`
--
ALTER TABLE `42pmz96_listemayhaveproducts`
  ADD CONSTRAINT `42pmz96_listeMayHaveProducts_42pmz96_listes_FK` FOREIGN KEY (`id`) REFERENCES `42pmz96_listes` (`id`),
  ADD CONSTRAINT `42pmz96_listeMayHaveProducts_42pmz96_products0_FK` FOREIGN KEY (`id_42pmz96_products`) REFERENCES `42pmz96_products` (`id`);

--
-- Contraintes pour la table `42pmz96_listes`
--
ALTER TABLE `42pmz96_listes`
  ADD CONSTRAINT `42pmz96_listes_42pmz96_universes_FK` FOREIGN KEY (`id_42pmz96_universes`) REFERENCES `42pmz96_universes` (`id`),
  ADD CONSTRAINT `42pmz96_listes_42pmz96_users0_FK` FOREIGN KEY (`id_42pmz96_users`) REFERENCES `42pmz96_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `42pmz96_marks`
--
ALTER TABLE `42pmz96_marks`
  ADD CONSTRAINT `fk_idproducts_marks` FOREIGN KEY (`id_42pmz96_products`) REFERENCES `42pmz96_producers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_idusers_marks` FOREIGN KEY (`id_42pmz96_users`) REFERENCES `42pmz96_users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Contraintes pour la table `42pmz96_posts`
--
ALTER TABLE `42pmz96_posts`
  ADD CONSTRAINT `42pmz96_posts_42pmz96_postsTypes1_FK` FOREIGN KEY (`id_42pmz96_postsTypes`) REFERENCES `42pmz96_poststypes` (`id`),
  ADD CONSTRAINT `42pmz96_posts_42pmz96_universes_FK` FOREIGN KEY (`id_42pmz96_universes`) REFERENCES `42pmz96_universes` (`id`),
  ADD CONSTRAINT `42pmz96_posts_42pmz96_users0_FK` FOREIGN KEY (`id_42pmz96_users`) REFERENCES `42pmz96_users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Contraintes pour la table `42pmz96_presentations`
--
ALTER TABLE `42pmz96_presentations`
  ADD CONSTRAINT `42pmz96_presentations_42pmz96_licenses0_FK` FOREIGN KEY (`id_42pmz96_licenses`) REFERENCES `42pmz96_licenses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `42pmz96_presentations_42pmz96_universes_FK` FOREIGN KEY (`id_42pmz96_universes`) REFERENCES `42pmz96_universes` (`id`);

--
-- Contraintes pour la table `42pmz96_producers`
--
ALTER TABLE `42pmz96_producers`
  ADD CONSTRAINT `42pmz96_producers_42pmz96_producerTypes_FK` FOREIGN KEY (`id_42pmz96_producerTypes`) REFERENCES `42pmz96_producertypes` (`id`);

--
-- Contraintes pour la table `42pmz96_producersproducts`
--
ALTER TABLE `42pmz96_producersproducts`
  ADD CONSTRAINT `42pmz96_ProducersProducts_42pmz96_producerRoles_FK` FOREIGN KEY (`id_42pmz96_producerRoles`) REFERENCES `42pmz96_producerroles` (`id`),
  ADD CONSTRAINT `42pmz96_ProducersProducts_42pmz96_producers1_FK` FOREIGN KEY (`id_42pmz96_producers`) REFERENCES `42pmz96_producers` (`id`),
  ADD CONSTRAINT `42pmz96_ProducersProducts_42pmz96_products0_FK` FOREIGN KEY (`id_42pmz96_products`) REFERENCES `42pmz96_products` (`id`);

--
-- Contraintes pour la table `42pmz96_products`
--
ALTER TABLE `42pmz96_products`
  ADD CONSTRAINT `42pmz96_products_42pmz96_licenses_FK` FOREIGN KEY (`id_42pmz96_licenses`) REFERENCES `42pmz96_licenses` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `42pmz96_products_42pmz96_productTypes1_FK` FOREIGN KEY (`id_42pmz96_productTypes`) REFERENCES `42pmz96_producttypes` (`id`),
  ADD CONSTRAINT `42pmz96_products_42pmz96_status2_FK` FOREIGN KEY (`id_42pmz96_status`) REFERENCES `42pmz96_status` (`id`),
  ADD CONSTRAINT `42pmz96_products_42pmz96_universes0_FK` FOREIGN KEY (`id_42pmz96_universes`) REFERENCES `42pmz96_universes` (`id`);

--
-- Contraintes pour la table `42pmz96_productstargetsgenres`
--
ALTER TABLE `42pmz96_productstargetsgenres`
  ADD CONSTRAINT `42pmz96_productsTargetsGenres_42pmz96_genres0_FK` FOREIGN KEY (`id_42pmz96_genres`) REFERENCES `42pmz96_genres` (`id`),
  ADD CONSTRAINT `42pmz96_productsTargetsGenres_42pmz96_products_FK` FOREIGN KEY (`id_42pmz96_products`) REFERENCES `42pmz96_products` (`id`),
  ADD CONSTRAINT `42pmz96_productsTargetsGenres_42pmz96_targets1_FK` FOREIGN KEY (`id_42pmz96_targets`) REFERENCES `42pmz96_targets` (`id`);

--
-- Contraintes pour la table `42pmz96_users`
--
ALTER TABLE `42pmz96_users`
  ADD CONSTRAINT `42pmz96_users_42pmz96_roles_FK` FOREIGN KEY (`id_42pmz96_roles`) REFERENCES `42pmz96_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
