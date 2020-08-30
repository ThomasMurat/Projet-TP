-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 30 août 2020 à 14:19
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

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
(8, 'Enfant'),
(9, 'Fantastique'),
(10, 'Harem'),
(11, 'Historique'),
(12, 'Horreur'),
(13, 'Josei'),
(14, 'Magique'),
(15, 'Mecha'),
(16, 'Militaire'),
(17, 'Musique'),
(18, 'Mystère'),
(19, 'Policier'),
(20, 'Psychologique'),
(21, 'Romance'),
(22, 'Science fiction'),
(23, 'Seinen'),
(24, 'Shôjo'),
(25, 'Shônen'),
(26, 'Sport'),
(27, 'Super pouvoir'),
(28, 'Thriller'),
(29, 'Tranche de vie'),
(30, 'Yaoi'),
(31, 'Yuri');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_genresmayhaveproducts`
--

DROP TABLE IF EXISTS `42pmz96_genresmayhaveproducts`;
CREATE TABLE IF NOT EXISTS `42pmz96_genresmayhaveproducts` (
  `id` int(11) NOT NULL,
  `id_42pmz96_products` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_42pmz96_products`),
  KEY `42pmz96_genresMayHaveProducts_42pmz96_products0_FK` (`id_42pmz96_products`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_licenses`
--

DROP TABLE IF EXISTS `42pmz96_licenses`;
CREATE TABLE IF NOT EXISTS `42pmz96_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `creationDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_licenses`
--

INSERT INTO `42pmz96_licenses` (`id`, `name`, `creationDate`) VALUES
(1, 'Pas de license', '1900-01-01'),
(2, '8 Man', '1963-11-07'),
(3, 'Absolute Duo', '2012-08-24'),
(4, 'Air Master', '1997-01-01'),
(5, 'Akiba\'s Trip', '2011-05-19'),
(6, 'Albator', '1977-01-01'),
(7, 'Assassination Classroom', '2012-07-02'),
(8, 'Beyblade', '1999-07-01'),
(9, 'Bleach', '2001-08-07'),
(10, 'Clamp', '1989-09-01'),
(11, 'Danganronpa', '2010-11-25'),
(12, 'Digimon', '1997-06-01'),
(13, 'Dragon Ball', '1984-12-03'),
(14, 'Fate Series', '2004-01-01'),
(15, 'Pokémon', '1996-02-01'),
(16, 'Final Fantasy', '1987-12-18'),
(17, 'Bakuman', '2008-08-11'),
(18, 'Love Hina', '1998-10-21'),
(19, 'Doraemon', '1969-08-08'),
(20, 'Détective Conan', '1994-01-19'),
(21, 'Sword Art Online', '2002-01-01');

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
  `name` varchar(150) NOT NULL,
  `creationDate` date NOT NULL,
  `id_42pmz96_universes` int(11) NOT NULL,
  `id_42pmz96_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
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
  `id_42pmz96_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_marks_42pmz96_users_FK` (`id_42pmz96_users`)
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
  `id_42pmz96_users` int(11) NOT NULL,
  `id_42pmz96_postsTypes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_posts_42pmz96_universes_FK` (`id_42pmz96_universes`),
  KEY `42pmz96_posts_42pmz96_users0_FK` (`id_42pmz96_users`),
  KEY `42pmz96_posts_42pmz96_postsTypes1_FK` (`id_42pmz96_postsTypes`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_posts`
--

INSERT INTO `42pmz96_posts` (`id`, `content`, `image`, `postDate`, `lastEditDate`, `title`, `id_42pmz96_universes`, `id_42pmz96_users`, `id_42pmz96_postsTypes`) VALUES
(1, 'Bienvenue dans l\'univer Mange d\'AnyManga. Vous trouverez ici, tous ce qu\'il y a à savoir sur l\'univer du Manga: suivez l\'actualité, retrouvez vos oeuvres préférées, découvrez-en de nouvelles. N\'hésitez pas à changer d\'univer à tous moment pour découvrir si votre oeuvre favorite a été adapté en Animé. Devenez membre et enregistrer vos lectures passé et les nouvelles et profitez de nos listes découvertes. ', NULL, '2020-07-24 16:00:00', '2020-07-24 16:00:00', 'Bienvenue', 1, 1, 4),
(2, 'Bienvenue dans l\'univers Animés d\'AnyManga. Vous trouverez ici, Tous ce qu\'il y a à savoir sur l\'univer des Animés. Suivez l\'actualité, parcourrez les oeuvres pour les découvrir ou les redécouvrir. N\'hésitez pas à changer d\'univer, et ainsi découvrir le manga à l\'origin de votre oeuvre préférée. Devenez membre epour créer votre liste de lecture passé et à venir mais aussi pour découvrir nos listes découvertes. ', NULL, '2020-07-24 16:00:00', '2020-07-24 16:00:00', 'Bienvenue', 2, 1, 4),
(3, 'Bienvenue sur AnyManga. Vous trouverez ici toutes les oeuvres issues du monde de l\'animation japonaise. Nous vous invitons à vous inscrire ,et ainsi pouvoir profiter des différents outils que nous vous proposons, comme enregistrer une liste des oeuvres qui vous intéresses ou celles que vous avez déjà vus ou lus. Pour poursuivre votre visite veuillez choisir l\'univers de votre choix en cliquant sur l\'une des deux images présentées sur cette page. ', NULL, '2020-07-24 16:00:00', '2020-07-24 16:00:00', 'Bienvenue', 3, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_poststypes`
--

DROP TABLE IF EXISTS `42pmz96_poststypes`;
CREATE TABLE IF NOT EXISTS `42pmz96_poststypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_poststypes`
--

INSERT INTO `42pmz96_poststypes` (`id`, `name`) VALUES
(1, 'évenement'),
(2, 'annonce'),
(3, 'info'),
(4, 'accueil');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_presentations`
--

INSERT INTO `42pmz96_presentations` (`id`, `presentation`, `image`, `id_42pmz96_universes`, `id_42pmz96_licenses`) VALUES
(1, 'Assassiné par des criminels, le corps du détective Yokoda est récupéré par le professeur Tani et est conduit dans son laboratoire. Là-bas, Tani effectue une expérience qui a échoué sept fois. Yokoda est le dernier sujet à avoir transféré sa force de vie dans un corps androïde. Pour la première fois, l\'expérience est un succès. Yokoda renaît sous le nom de 8 Man, un homme à la peau blindée, capable de se lancer à des vitesses impossibles et de se transformer en un personnage. Il s\'installe dans Yokoda, en se faisant appeler \"Hachiro Azuma\". Il garde cette identité secrète, connue seulement de Tani et de son chef de police, le chef Tanaka. Même sa petite amie Sachiko et son ami Ichiro ne savent pas qu\'il est un androïde. En tant que 8-Man, Hachiro va combattre le crime.', '/assets/manga/licenses/8man.jpg', 1, 2),
(2, 'Yokugawa Sachiko est une jeune femme travaillant au sein de l’entreprise Biotechno. Elle est sans nouvelle d’Hazuma, l’homme qu’elle aimait et qui accessoirement est Eight Man. Sachiko est contactée par un jeune détective, Hazama, qui est à la recherche du professeur Schmitt. Cet ancien de Biotechno est recherché pour vol de documents secrets et greffes d’implants cyborgs. Alors que Sachiko accepte d’apporter son secours à Hazama, elle est prise en otage par un cyborg et ne doit son salut qu’à l’intervention désespérée du jeune détective. Intervention au cours de laquelle Hazama fait une chute dont personne ne pourrait se relever… Mais le jeune détective fait son grand retour dans une ville stéréotype du Pandémonium. Un retour qui coïncide avec celui d’Eight Man… ', '/assets/img/anime/licenses/8man.jpg', 2, 2),
(3, 'Tôru Kokonoe arrive comme beaucoup étudiants pour s\'inscrire dans une prestigieuse école où l\'on enseigne l\'art d\'utiliser son blaze, le jeune homme fait la conaissance d\'une jeune fille appelée Nagakura Himari. Les deux étudiantqms vont très vite s\'entendre mais lors de la cérémonie d\'entrée, on leur annonce que pour entrer dans l\'académie ils doivent vaincre le voisin de salle, or la jeune fille est assise à coté du jeune homme, ils n\'ont d\'autres choix que de se battrent...', '/assets/manga/licenses/absoluteDuo.jpg', 1, 3),
(4, 'En ce monde, il existe des armes qui sont la manifestation de l\'âme humaine. Elles sont appelés \"Blaze\". Tōru Kokonoe a les qualifications requises pour en manier une. Toutefois, pour une étrange raison, son \"Blaze\" n\'est pas une arme, mais un bouclier... Notre héros s\'inscrit un jour dans une école qui enseigne des techniques de combat via un système de partenariat entre élèves appelé \"Duo\". Il aura pour partenaire une belle jeune fille aux cheveux argentés. ', '/assets/anime/licenses/absoluteDuo.jpg', 2, 3),
(5, 'Le jour, Maki Aikawa est une lycéenne normale qui forme un groupe très solide avec ses amies Yuu, Michiru, Renge et Mina. La nuit, elle devient \"Airmaster\", une combattante de la nuit réputée et redoutée qui aime particulièrement les défis !', '/assets/manga/licenses/airMaster.jpg', 1, 4),
(6, 'Aikawa Maki alias Airmaster est une étudiante de 16 ans vivant a Tokyo. Plutot stupide, elle n\'est douée que pour les street fight nocturnes auxquels elle participe. Associale elle apprendra tout au long de l\'animé a se faire des amis mais que le monde du street fighting est plein de combattant aussi doués que tordus. Humour de dingue et bastons s\'allie avec beaucoup d\'efficacité. C\'est pas la beauté de l\'animé qui retient mais la pêche qui se dégage des combats.\r\nCeux qui ont apprécié Street fighter 2v peuvent se précipité les autres aussi', '/assets/anime/licenses/airMaster.jpg', 2, 4),
(7, 'L\'ensemble du quartier commercial d\'Akihabara est envahi par des créatures nommées Synthisters (ou vampires) qui chassent et terrorisent les clients de ce quartier de Tokyo. Ces créatures ne possèdent qu\'un seul point faible : l\'exposition directe aux rayons du soleil. Ce qui signifie que les vêtements de ces Synthisters doivent être arrachés. Ainsi, un groupe d\'adolescents décide de se battre pour éliminer la menace que forment les Synthisters. ', '/assets/anime/lisences/akbasTrip.jpg', 2, 5),
(8, 'En 1977, le peuple des guerrières de l\'espace envahit la terre. Les habitants n\'ont aucunement conscience de l\'importance de cet événement. Sillonnant l\'océan intersidéral, le capitaine Albator et tout son équipage déploient leurs forces pour tenter de stopper leur entreprise.', '/assets/manga/licenses/albator.jpg', 1, 6),
(9, 'Les Terriens ont toutes les satisfactions apportées par le confort. Ils deviennent donc tellement laxistes que seules quelques personnes travaillent encore. Lorsqu’un scientifique suppose l’arrivée prochaine d’extraterrestres, personne ne le croit, chacun préférant la tranquillité à la crainte ! Les Sylvidres, race extraterrestre métamorphe, profitent de cette population fainéante pour infiltrer la Terre afin de la conquérir. Albator, hors-la-loi recherché par les militaires et principalement par leur chef, Vilas, va être le seul à croire le scientifique, que les Sylvidres tueront. Avec l’aide de Ramis, l’assistant du scientifique, il va protéger les Terriens inconscients du danger, malgré l’opposition de l’armée qui posera de nombreux pièges pour les attraper. ', '/assets/anime/licenses/albator.jpg', 2, 6),
(10, 'Au lycée Kunugigaoka se trouve la classe 3-E, exclue dans les montagnes pour étudier et surtout pour assassiner leur professeur, Koro-sensei. En effet, cette étrange créature, ressemblant à un smiley avec des tentacules, a réussi à trouer la lune jusqu\'à ce que celle-ci en devienne un croissant ! Il posa alors ses conditions au gouvernement : devenir le professeur de la classe 3-E. Cependant, si d\'ici une année aucun de ses élèves ne parvient à le tuer, la Terre connaîtra le même sort que celui de la Lune !\r\n\"Si une personne y arrive, elle recevra la somme astronomique de 10 milliards de yens\" !\r\n\r\nC\'est ainsi que ce groupe d\'élèves va apprendre l\'art de tuer de différentes manières mais aussi commencer à s\'attacher à ce drôle de professeur.', '/assets/manga/licenses/assassinationClassroom.jpg', 1, 7),
(11, 'La planète Terre est en sursis ! Après avoir partiellement détruit la Lune, un être étrange et surpuissant a décrété que si personne ne parvenait à le tuer dans l\'année à venir, la planète subirait le même sort que son satellite. Durant ce laps de temps, il a également exigé d\'être nommé professeur de la classe 3-E du lycée Kunugigaoka, aussi connue sous le nom de \"Class End\", la classe des cas désespérés.\r\n\r\nLes étudiants sont donc les mieux placés pour tuer cet étrange professeur, baptisé Koro-sensei, et ainsi empocher la somme astronomique de 10 milliards de yens. L\'ennui, c\'est que la majorité des lycéens de cette classe manquent cruellement de confiance en eux, écrasés par un système qui ne leur convient pas.', '/assets/anime/licenses/assassinationClassroom.jpg', 2, 7),
(12, 'Tyson Kynomiya est un jeune garçon qui vit au Japon chez son Grand-père. Il est maladroit, impulsif, courageux, têtu et peu réfléchi. Il a une passion : le Beyblade ! Ce jeu de toupie est très populaire et de nombreux blader s\'affronte dans des arènes. Les toupies hébergent en leur centre un spectre, qui lie les blader à leurs toupies. Ces bêtes mystiques sont de précieux allier durant les combats. Chaque blader s\'entraîne et développe une caractéristique dominante : attaque, défense, endurance ou combinaison. Tyson va, par le biais de ce jeu, se faire des amis fidèles, découvrir le monde et affronter de nombreux blader puissant !', '/assets/manga/licenses/beyblade.jpg', 1, 8),
(13, 'Metal Fight Beyblade raconte l\'histoire de Ginga Hagane un jeune Beyblader venant d\'un petit village de montagne \" Koma\". Avec son attitude cool au caractère bien trempé, il vous fera pensé à Tayson, il rencontrera des beybladers qui voudrons le combattre (Face Hunters), voire le tuer (Dark Nebula), plus précisément Ryuga, qui va libérer la toupie interdite à la puissance terrifiante surnommé, L-Drago !\r\n\r\nCependant, son amitié avec son Pegasius l\'esprit de sa beyblade et ses amis Kenta et Madoka l\'aidera à affronter toutes les difficultés, au fil de l\'histoire Ginga se fera de nouveaux alliés tel que Kyouya, Benkei, Tsubasa ou bien Yu !\r\n\r\nIl sera même capable de convertir certains de ses ennemis avec son pur Beyheart.', '/assets/anime/licenses/beyblade.jpg', 2, 8),
(14, 'Ichigo Kurosaki, jeune lycéen de 15 ans dans la ville de Karakura, a l\'étonnante capacité de pouvoir voir et communiquer avec les âmes errantes, suite à l\'accident qui lui enleva sa mère... Vivant désormais avec son père et ses deux soeurs cadettes, Ichigo parvient tant bien que mal à gérer cet aspect de sa vie. Jusqu\'au jour où il croisera le chemin d\'une shinigami (déesse de la mort), Rukia Kuchiki, poursuivant une de ces âmes errantes ayant choisi le mauvais chemin vers l\'éternité...\r\n\r\nDurant le combat qui s\'en suivit, Rukia, à la suite de blessures, se voit obligée de confier une partie de ses pouvoirs à Ichigo afin que la mission puisse être menée à bien. Mais contre toute attente, Ichigo absorbe la totalité des pouvoirs de Rukia et devient à son tour une sorte de shinigami. Une fois cette affaire réglée, il conserve ses nouveaux pouvoirs. Rukia reste alors dans notre monde le temps de se régénérer et lui enseigne les rudiments de la vie de shinigami.\r\n\r\nMais si tout se passe plus ou moins bien sur notre plan d\'existence, de l\'autre côté de la barrière l\'au-delà n\'est pas si tranquille...', '/assets/manga/licenses/bleach.jpg', 1, 9),
(15, 'Kurosaki Ichigo, un étudiant de quinze ans aux cheveux orange qui aime la bagarre (comme son père) a la particularité de voir les fantômes ainsi que de pouvoir les toucher. Cela l\'amène à rencontrer Kuchiki Rukia, un Shinigami (dieu de la mort) qui combat un Hollow. Le déroulement du combat amène Kuchiki à donner ses pouvoirs à Ichigo qui deviens alors lui même un Shinigami. C\'est maintenant à son tour de protéger la ville des Hollows.', '/assets/anime/licenses/bleach.jpg', 2, 9),
(16, 'CLAMP est un cercle de mangaka feminins qui commence son activité en 1989, dans le milieu du fanzinat ou dôjinshi, sous le nom de Amarythia. Originellement, le groupe compte douze membres.\r\nVers 1990, le cercle de magaka diminue de douze membres à sept membres, change de nom, devient CLAMP et se lance dans le milieu professionnel avec la publication de leur premier manga dans le magazine Wings : RG Veda. Le succès est au rendez-vous mais le groupe perd de nouveaux deux membres en cours de production Akiyama Tamayo et Sei Leeza.\r\n\r\nActuellement, CLAMP compte quatre membres officiels. A noter que leurs noms professionnels ont changé en 2004, lors de leur 15 ième anniversaire de carrière professionnel. Dans une interview, Ageha Ohkawa révèle que CLAMP a mûri depuis et que leurs anciens noms ne convenaient plus à leurs personnalités actuelles. En fait, Mick Nekoi n\'aimait pas que l\'on fasse référence à Mick Jagger en parlant d\'elle et Mokona Apapa a décidé laisser tomber son nom de famille parce que cela faisait trop immature. Le reste du groupe a juste suivi la vague de changement. A noter que Satsuki Igarashi a juste décidé d\'écrire son nom avec des kanji différents tout en conservant la même prononciation.', '/assets/manga/licenses/clamp.jpg', 1, 10),
(17, 'CLAMP est un cercle de mangaka feminins qui commence son activité en 1989, dans le milieu du fanzinat ou dôjinshi, sous le nom de Amarythia. Originellement, le groupe compte douze membres.\r\nVers 1990, le cercle de magaka diminue de douze membres à sept membres, change de nom, devient CLAMP et se lance dans le milieu professionnel avec la publication de leur premier manga dans le magazine Wings : RG Veda. Le succès est au rendez-vous mais le groupe perd de nouveaux deux membres en cours de production Akiyama Tamayo et Sei Leeza.\r\n\r\nActuellement, CLAMP compte quatre membres officiels. A noter que leurs noms professionnels ont changé en 2004, lors de leur 15 ième anniversaire de carrière professionnel. Dans une interview, Ageha Ohkawa révèle que CLAMP a mûri depuis et que leurs anciens noms ne convenaient plus à leurs personnalités actuelles. En fait, Mick Nekoi n\'aimait pas que l\'on fasse référence à Mick Jagger en parlant d\'elle et Mokona Apapa a décidé laisser tomber son nom de famille parce que cela faisait trop immature. Le reste du groupe a juste suivi la vague de changement. A noter que Satsuki Igarashi a juste décidé d\'écrire son nom avec des kanji différents tout en conservant la même prononciation.', '/assets/anime/licenses/clamp.jpg', 2, 10),
(18, 'À Kibôgamine, l\'école réservée à l\'élite des lycéens, l\'heure est au voyage scolaire ! Sur l\'île paradisiaque de Jabberwock, Hajime Hinata et ses camarades profitent de la plage et du beau temps... Mais voilà que Monokuma, la peluche psychopathe, est de retour et met en place un nouveau jeu de la mort : quiconque voudra quitter l\'île devra commettre un meurtre ! Qui parmi les élèves sera le premier à mourir ?\r\n\r\nPiégés sur une île tropicale, nos héros ont un seul espoir d\'en sortir vivant : percer le mystère de ce lieu isolé. Mais la vérité peut être pire que la mort.', '/assets/manga/licenses/danganronpa.jpg', 1, 11),
(19, 'L\'histoire se passe dans l\'académie Kibôgamine où seuls les meilleurs dans différents domaines sont acceptés. Chacun d\'entre eux obtient un titre de niveau super lycée lié à leur spécialité. Cependant, chaque année, un élève moyen est accepté. C\'est là que Makoto Naegi, le chanceux de niveau super lycée de cette année, se met à rencontrer les nouveaux super lycéens.\r\n\r\nLes voilà enfermés dans cette école par un ours noir et blanc appelé Monokuma. Ils apprennent qu\'ils ne pourront sortir qu\'en obtenant leur diplôme. Pour cela, un élève doit commettre un meurtre et ne jamais être démasqué. Si celui-ci réussit le meurtre parfait, les autres élèves seront condamnés à mort et lui seul pourra quitter l\'école. Mais dans le cas contraire, le meurtrier reçoit un châtiment pour avoir perturbé l\'ordre publique de la classe.', '/assets/anime/licenses/danganronpa.jpg', 2, 11),
(20, 'Chapitre 1 - COMMENT TOUT A COMMENCE...\r\nSept enfants se trouvent tout à coup transportés dans un autre monde, le Digimonde. Ils y rencontrent d\'étranges monstres digitaux, les Digimon !! Ceux-ci vont les aider à survivre dans ce monde inhospitalier...\r\n\r\nChapitre 2 - LA NAISSANCE DE GREYMON\r\nLes Digi-sauveurs commencent à explorer l\'Île des Fichiers binaires. Mais l\'apparition de Shellmon met Tai dans le pétrin !! Heureusement, pour le sauver, Agumon se digivolve en Greymon et va combattre le titan...\r\n\r\nChapitre 3 - GARURUMON, LE LOUP BLEU !\r\nLes sept amis veulent se reposer, mais ils provoquent la colère de Seadramon !! En aidant son frère T.K., Matt se trouve en mauvaise posture. Pour le protéger, Gabumon se digivolve alors en Garurumon et sauve la situation !!\r\n\r\nChapitre 4 - TOUT FEU, TOUT FLAMME !\r\nAu pied du mont Miharashi, le village des Yokomon est attaqué par le soi-disant paisible Meramon. Celui-ci a été assailli par une étrange Roue Noire. Grâce à Sora, Biyomon se digivolve en Birdramon et terrasse Meramon !!', '/assets/manga/licenses/digimon.jpg', 1, 12),
(21, 'Alors qu\'ils devaient passé l\'été dans un camp de vacance, sept enfants sont transportés dans un monde virtuel : le Digital World. Dans ce monde réside les Digimon, de petits monstres digitaux se répartissant en trois classe : donnés, virus et anti-virus. Après leur arrivé, les enfants se rendent compte qu\'ils ont chacun un digimon chargé de les protéger et de les guider ainsi qu\'un digivice, une sorte de petit ordinateur permettant aux digimons d\'évoluer.\r\n\r\nTaichi, Yamato, Sora, Izumi, Mimi, Joe et Takeru vont alors comprendre qu\'il ont été choisis pour aider ce monde dans lequel des digimons de type virus font la loi et bouleverse l\'équilibre. Mais la survie s\'annonce difficile pour ce groupe d\'adolescent qui, de plus, font parfois face à des tensions à l\'intérieur même de leur groupe.', '/assets/anime/licenses/digimon.jpg', 2, 12),
(22, 'Alors qu\'elle parcourt les routes de montagnes à moto, Bulma fait une bien étrange rencontre en la personne de Sangoku, un petit garçon étonnamment fort, résistant et possédant une queue, comme les singes. Il possède un trésor qu\'elle recherche, une boule de cristal, mais ne veut pas la lui céder, c\'est un cadeaux que lui a laissé son grand-père Sangohan. Ils trouvent finalement un compromis, et Sangoku part avec elle à la recherche des 7 boules de cristal dont on dit qu\'elles exaucent n\'importe quel souhait une fois réunis.', '/assets/manga/licenses/dragonball.jpg', 1, 13),
(23, 'Dragon ball raconte les aventures de Son Gôku, un jeune garçon doté d\'une queue de singe.\r\nL\'histoire commence lorsque Son Gokû rencontre Bulma, qui est à la recherche des sept boules de cristal. Ces boules de cristal on un pouvoir qui exaucerait n\'importe quel souhait une fois les 7 d\'entre elles réunies.\r\nAu cours de ses aventures, Son Gôku rencontrera beaucoup d\'amis comme Krillin, Yamsha, kame, mais aussi beaucoup d\'ennemis comme le Red Rubon et Pïccolo...\r\nDragon Ball est l\'un des mangas les plus populaires au monde.', '/assets/anime/licenses/dragonball.jpg', 2, 13),
(24, 'Emiya Shirô a tout perdu lors d\'un immense incendie : sa famille, sa maison, ses repères. Il est alors adopté par Emiya Kiritsugu. Quelques années plus tard, alors que son père est décédé, Shirô participe à un important tournoi, réunissant 7 magiciens, dont l\'enjeu est le Saint Graal. Chaque mage invoque pour le tournoi un \"Servant\", un héros ancien qui lui prête sa force durant le tournoi. Shirô invoque une guerrière de la classe la plus puissante : Saber.', '/assets/manga/licenses/Fateseries.jpg', 1, 14),
(25, 'Tiré d’un eroge visual novel de Type‑Moon à l’instar de Tsukihime, Fate/stay night nous conte l’histoire d’Emiya, un jeune homme capable d’analyser la structure des objets grâce à la magie. Enfant, Emiya fut témoin du dénouement tragique d’une guerre occulte opposant 7 magiciens et leurs serviteurs et qui détruisit son quartier. Recueilli par un magicien, désormais décédé, Emiya est devenu un jeune homme solitaire doté de pouvoirs limités, capable de réparer les objets d’instinct et de lancer quelques sorts. Au cours d’une nuit tragique où il se retrouve à nouveau confronté à la guerre pour le Saint Graal, Emiya invoque Saber, l’ultime serviteur, et devra affronter les 6 autres magiciens malgré ses limites.Cet anime est suivi par Fate/Zero. Il existe également un spin-off intitulé Fate/Kaleid Liner Prisma☆Illya.Attention, vous avez devant vous une perle de l’animation.Le meilleur animé qu’il m’a été donné de voir.En effet, il fait partis des rares animés, où les personnages évoluent, non pas en puissance, mais en caractère et en relationnel, je ne parle pas évidement d’une relation cucul entre deux être, mais bien d’un lien complexe entre les divers personnages qui se tisse au fur et à mesure tout le long de l’animé.Le caractère désign est superbe, les animations de combats sont très bien réalisé, et l’émotion… aahhh, mais quelle émotion, certaines scènes font tirer la larme, et après avoir vu la fin, on ne peut en être que troublé. ', '/assets/anime/licenses/Fateseries.jpg', 2, 14),
(26, 'On retrouve cette série qui a fait le succès de la version télévisé dans ce manga.\r\nNous retrouvons donc nos héros, accompagné de Pikachu, le plus célèbre des Pokémon. Les mêmes méchants, c\'est à dire, la Team Rocket.\r\n\r\nLe but de cette histoire est d\'attraper tout les Pokémon, de les entraîner et de les faire évoluer pour qu\'ils deviennent plus puissant et ainsi remporter de nombreux match pour devenir \"Le Meilleur Dresseur\".\r\n\r\n\"La version manga est un peu moins enfantine que la version télévisé car dans celle-ci, les Pokémon ne peuvent pas ou quasiment pas mourir, alors que celle du manga, les Pokémon peuvent donc mourir, et des fois de bien étrange façon... \"', '/assets/manga/licenses/pokemon.jpg', 1, 15),
(27, 'Sacha 10 ans, habite le Bourg-Palette, dans la région du Kantô et son rêve, est de devenir \"le meilleur dresseur de Pokémon du monde\".\r\n\r\nIl hérite comme premier Pokémon, de Pikachu qui s\'avère au début avoir un tempérament plutôt... électrique !\r\n\r\nNotre jeune héros, rencontrera, dans son voyage, Ondine, une dresseuse de Pokémon Eau, et Pierre, qui veut lui, devenir éleveur de Pokémon.\r\n\r\nNos trois amis, seront confrontés à Jessie, James et Miaouss, membres de la Team Rocket, célèbre gang de malfaiteurs qui n\'auront de cesse de vouloir capturer Pikachu, qu\'ils prennent pour un Pokémon hors normes et puissant.\r\n\r\nLa route pour devenir Dresseur de Pokémon, sera longue et semée d\'embûches.', '/assets/anime/licenses/pokemon.jpg', 2, 15),
(28, 'Employés chez Square Enix, Shogo et sa sœur Yuko n\'ont qu\'un rêve : pouvoir un jour travailler sur un opus de la série Final Fantasy. Mais ce projet va tourner court lorsqu\'un camion les fauche tous les deux. Projetés dans un village peuplé de Mogs et de Chocobos, ils comprennent qu\'ils sont désormais partie intégrante de leur univers favori... Étrangers perdus dans une contrée familière, Shogo et Yuko vont devoir réapprendre tout ce qu\'ils pensaient connaître de l\'univers de Final Fantasy et forger de nouvelles alliances afin de survivre à un monde bien plus dangereux qu\'il n\'en a l\'air. Leur rêve va bientôt tourner au cauchemar...', '/assets/manga/licenses/finalFantasy.jpg', 1, 16),
(29, 'L\'histoire commença lorsque deux créatures divines (Léviathan et Bahamut) menèrent un combat acharné juste au dessus de la ville de Tokyo. La forte intensité de leur lutte créa un pilier obscur sur Terre qui inspira un sentiment de peur et de confusion dans la population. Les scientifiques chargés d\'étudier cette colonne, Joe et Marie Hayakawa, se mirent à faire des recherches sur ce phénomène. Ils partirent explorer une 1ère fois le Pays des Merveilles. En revenant ils décidèrent d\'écrire un livre, mais avant de l\'avoir rédigé ils partirent une deuxième fois et ne revinrent jamais.\r\n\r\nDouze ans plus tard, les enfants des deux scientifiques disparus, Ai et Yu Hayakawa, décident de partir sur les traces de leurs parents avec pour seule information une rumeur donnant le moyen d\'atteindre le pilier et d\'accéder au \"Monde intérieur\". Pour arriver à leurs fins, ils empruntent un métro fantôme où ils rencontrent une jeune fille nommée Lisa, qui est aussi à la recherche de quelqu\'un. Arrivés dans le monde intérieur, ils rencontrent Kaze, personnage mystérieux ayant le pouvoir d\'invoquer des créatures divines. C\'est le début d\'une longue aventure pour cette équipe de choc qui devra affronter les nombreux dangers de ce monde inconnu gouverné par \"Le Comte\".', '/assets/anime/licenses/finalFantasy.jpg', 2, 16),
(30, 'C\'est l\'histoire de deux garçons poursuivant un même rêve : devenir Mangaka.\r\nLe premier, Moritaka Mashiro, est en 3ème année de collège et possède un grand talent de dessinateur. Il est amoureux d\'une fille de sa classe, Azuki, mais il n\'ose pas lui avouer ses sentiments.\r\nLe second, Akito Takagi, l\'élève le plus intelligent de la classe, remarque le talent de Mashiro et lui propose de s\'associer avec lui afin de réaliser un manga dont il serait le scénariste et Mashiro le dessinateur.\r\nMashiro refuse tout d\'abord la proposition jusqu\'au soir où Takagi et lui se retrouvent devant chez Azuki. Celle-ci leur avoue vouloir devenir Seiyû. Mashiro lui dit alors : \"Si nous arrivons à réaliser notre rêve, voudras-tu m\'épouser ? \". Elle accepte mais à condition qu\'ils ne se voient plus jusqu\'à ce que leur rêve soit devenu réalité. Leur unique moyen de communication est l\'envoie d\'e-mail.\r\nMashiro et Takagi se lancent alors dans la folle aventure de créer un manga à succès, sous le pseudonyme de Ashirogi Muto.', '/assets/manga/licenses/bakuman.jpg', 1, 17),
(31, 'Moritaka Mashiro est un étudiant de neuvième année qui a un talent inné pour le dessin et Akito Takagi, le meilleur élève de sa classe veut devenir mangaka.\r\nAprès beaucoup d\'argumentation, Takagi convainc Mashiro de s\'associer pour créer ensemble le meilleur manga que le Japon n\'ait jamais eu.\r\nTakagi avec son don pour l\'écriture espère devenir un très grand mangaka et Mashiro avec son talent pour le dessin espère se marier avec la fille de ses rêves, Azuki Miho.', '/assets/anime/licenses/bakuman.jpg', 2, 17),
(32, 'Keitarô Urashima est un étudiant de 19 ans qui semble avoir tout raté. Peu populaire auprès des filles, il a raté plusieurs fois l\'examen d\'entrée de Tôdai (Tokyo Daigaku, l\'université de Tokyo), au grand dam de ses parents, qui décident de mettre à la porte leur bon à rien de fils. La mine triste et ses rêves d\'avenir brisés, Keitarô décide toutefois de ne pas se laisser abattre : il décide d\'aller rendre visite à sa grand mère, qui tient une pension pour jeunes filles, la pension Hinata.\r\n\r\nAprès un mauvais accueil de la part des pensionnaires et apprenant que sa grand mère est en fait partie faire le tour du monde, Keitarô est désormais obligé de devenir le nouveau gérant de la pension.', '/assets/manga/licenses/loveHina.jpg', 1, 18),
(33, 'A 20 ans, Keitaro s\'accroche et tente d\'entrer à Todai. Il a déjà raté le concours d\'admission par deux fois. Pour l\'instant, le souci de Keitaro est de trouver un logement pour ne pas retourner vivre avec ses parents qui le poussent à abandonner Todai. Il se rend à la pension Hinata la pension de sa grand-mère. Dans cette pension pour jeunes filles, les locataires le prennent pour un voyeur et lui en font voir de toutes les couleurs. Il est sauvé par sa tante, Haruka, qui habite près de la pension et vient voir les pensionnaires, en l\'absence de la grand-mère partie faire le tour du monde.\r\n\r\n', '/assets/anime/licenses/loveHina.jpg', 2, 18),
(34, 'Doraemon est un robot à allure de chat venu du futur pour aider Nobita, un jeune garçon irresponsable et maladroit qui se fait souvent gronder par sa mère ou ses professeurs. En réalité c\'est le petit fils de Nobita qui a envoyé Doraemon dans le passé pour sauver le futur de sa famille. Le destin ne sera pas facile à changer.', '/assets/manga/licenses/doraemon.jpg', 1, 19),
(35, 'Doraemon est un robot-chat bleu envoyé dans le passé par le descendant du jeune Nobi Nobita, afin d\'aider ce dernier à rembourser ses dettes qui se sont accumulées dans le futur et que tous ses descendants doivent, maintenant, payer.\r\n\r\nDoraemon aide le petit garçon en lui prêtant un nombre incalculable de gadgets futuristes (normal, il vient du futur, me direz-vous !).\r\n\r\nMais Nobita, ne se sert pas toujours adroitement de ces objets, ce qui provoque bon nombre de situations farfelues.', '/assets/anime/licenses/doraemon.jpg', 2, 19),
(36, 'Shinichi Kudo est un brillant lycéen promis à un grand avenir. Il vit seul car ses parents vivent aux États-Unis, mais il passe beaucoup de temps avec Ran, son amie d\'enfance qu\'il aime en secret, ou avec le professeur Agasa. C\'est un excellent détective, qui a le sens de l\'observation et un très bon esprit de déduction, mais un jour, il va se faire surprendre alors qu\'il espionnait deux hommes en noir suspects. Ils lui feront alors prendre un médicament censé le tuer, mais qui va le faire rajeunir et il redeviendra un enfant de 6 ans. Coincé dans ce corps, Shinichi se fera alors passer pour Conan Edogawa, neveu du professeur, et se fera \"adopter\" par Ran dont le père est détective privé. Conan espère ainsi retrouver les hommes en noir, et enfin redevenir lui même.', '/assets/manga/licenses/detectiveConan.jpg', 1, 20),
(37, 'Shinichi Kudo est élève en première au lycée Tivedétec (Teitan). Pour avoir résolu plusieurs enquêtes difficiles, il est considéré par beaucoup comme l\'aide la plus précieuse que la police japonaise pouvait espérer.\r\n\r\nUn jour, lors d\'une sortie avec son amie Ran Mouri dans un parc d\'attraction après avoir résolu une affaire de meurtre, il fait la rencontre d\'hommes étranges vêtus de noir qu\'il avait vus précédemment sur les lieux d\'un crime. Par curiosité et intuition, Shinichi les suit et comprend que ce sont des maîtres chanteurs. L\'ayant découvert, ils lui font boire un poison expérimental pour le faire taire. L\'effet est inattendu : son corps rajeunit, mais ses facultés de détective restent inchangées. Shinichi, aidé par son voisin le Dr. Agasa, inventeur génial et farfelu, décide de partir à la recherche de l\'organisation secrète dont il a été victime. Shinichi cache sa véritable identité sous le pseudonyme de Conan Edogawa (de Sir Arthur Conan Doyle et d\'Edogawa Ranpo), et se réfugie chez Ran, dont le père encore peu connu, Kogoro Mouri, s\'est mis à son compte en tant que détective privé après avoir quitté la police.\r\n\r\nShinichi trouve vraiment injuste le fait que, adulte, tout le monde l\'écoutait, et que enfant, on ne lui accorde aucun moment où il peut résoudre une affaire. Il résout les affaires bien plus vite que le père de Ran, mais il est obligé d\'attendre le bon moment pour faire en sorte que Mouri comprenne son \"point de vue\" sans attirer l\'attention sur lui...\r\n\r\nDepuis l\'arrivée de Conan, Mouri commence à être de plus en plus célèbre. En effet, régulièrement, lorsque Conan a enfin élucidé le mystère d\'une affaire sur laquelle Mouri travaille, il endort ce dernier avec un gadget fabriqué par Agasa inclus dans sa montre, qui peut tirer un projectile hypodermique. Il se cache ensuite, et, grâce à son nœud papillon (un autre gadget d\'Agasa), prend la voix de Kogoro (Il arrive aussi que Conan soit obligé de prendre la voix de quelqu\'un d\'autre). Kogoro Mouri est donc appelé le \"détective endormi\" (Nemuri no Kogoro en japonais), à cause de son air assoupi pendant qu\'il \"résout\" une affaire. Kogoro et Ran ne connaissent pas la vraie identité de Conan. Aussi, lorsque Conan fait une déduction en public, Ran s\'étonne. Conan s\'en tire souvent par une pirouette, tandis que Mouri s\'énerve car il trouve qu\'un enfant n\'a pas à se trouver sur les lieux d\'un crime ni à essayer de les résoudre...', '/assets/anime/licenses/detectiveConan.jpg', 2, 20),
(38, 'En 2022, Kirito, un adolescent sans histoire, se retrouve piégé avec 10 000 autres joueurs dans un jeu en réalité augmentée massivement multijoueurs : Sword Art Online. Pour regagner leur liberté, les joueurs devront compléter les 100 étages qui composent l\'Aincrad, leur prison virtuelle. Mais le moindre faux pas pourrait être fatal, puisqu\'un Game Over dans le jeu entraînera une mort réelle. Kirito, le joueur solo, se lance dans une course effrénée pour sa survie, dans un monde où l\'art de l\'épée dicte la loi des plus forts.', '/assets/manga/swordArtOnline.jpg', 1, 21),
(39, 'Cette série raconte les aventures de Kirito qui se retrouve piégé dans un jeu massivement multi-joueurs, Sword Art Online.\r\n\r\nEn 2022, l\'humanité a réussi à créer une réalité virtuelle. Grâce à un casque, les humains peuvent se plonger entièrement dans le monde virtuel en étant comme déconnectés de la réalité, et Sword Art Online est le premier MMORPG a utiliser ce système. Mais voila que le premier jour de jeu, 10 000 personnes se retrouvent piégées dans cette réalité virtuelle par son créateur : Akihiko Kayaba. Le seul moyen d\'en sortir est de finir le jeu. Mais ce ne sera pas facile de sortir de ce monde virtuel puisque si un joueur perd la partie, il meurt également dans la vraie vie.\r\n\r\nKirito décide alors de partir à la conquête du jeu en solo, avec pour avantage le fait de faire partie des 1 000 ex-bêta-testeurs, mais arrivera-t-il à terminer les 99 donjons et leurs boss ?\r\n\r\n\"Même si cela semble être un jeu vidéo, ce n\'est pas un jeu\"\r\nAkihiko Kayaba - Créateur de \"Sword Art Online\"', '/assets/anime/swordArtOnline.jpg', 2, 21),
(40, 'pas de license', '/assets/manga/licenses/nolicense.jpg', 1, 1),
(41, 'pas de license', '/assets/anime/licenses/nolicense.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_producerroles`
--

DROP TABLE IF EXISTS `42pmz96_producerroles`;
CREATE TABLE IF NOT EXISTS `42pmz96_producerroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_producers`
--

DROP TABLE IF EXISTS `42pmz96_producers`;
CREATE TABLE IF NOT EXISTS `42pmz96_producers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `id_42pmz96_producerTypes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_producers_42pmz96_producerTypes_FK` (`id_42pmz96_producerTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_producertypes`
--

INSERT INTO `42pmz96_producertypes` (`id`, `name`) VALUES
(1, 'studio'),
(2, 'magazine'),
(3, 'autheur'),
(4, 'animateur');

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
  `publicationDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `id_42pmz96_licenses` int(11) NOT NULL,
  `id_42pmz96_universes` int(11) NOT NULL,
  `id_42pmz96_productTypes` int(11) NOT NULL,
  `id_42pmz96_status` int(11) NOT NULL,
  `id_42pmz96_marks` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_products_42pmz96_licenses_FK` (`id_42pmz96_licenses`),
  KEY `42pmz96_products_42pmz96_universes0_FK` (`id_42pmz96_universes`),
  KEY `42pmz96_products_42pmz96_productTypes1_FK` (`id_42pmz96_productTypes`),
  KEY `42pmz96_products_42pmz96_status2_FK` (`id_42pmz96_status`),
  KEY `42pmz96_products_42pmz96_marks3_FK` (`id_42pmz96_marks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_producttypes`
--

DROP TABLE IF EXISTS `42pmz96_producttypes`;
CREATE TABLE IF NOT EXISTS `42pmz96_producttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_producttypes`
--

INSERT INTO `42pmz96_producttypes` (`id`, `name`) VALUES
(1, 'oneshot'),
(2, 'serie'),
(3, 'ova'),
(4, 'film');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_roles`
--

DROP TABLE IF EXISTS `42pmz96_roles`;
CREATE TABLE IF NOT EXISTS `42pmz96_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_roles`
--

INSERT INTO `42pmz96_roles` (`id`, `role`) VALUES
(1, 'administrateur'),
(2, 'membre'),
(3, 'rédacteur'),
(4, 'modérateur');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_status`
--

DROP TABLE IF EXISTS `42pmz96_status`;
CREATE TABLE IF NOT EXISTS `42pmz96_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_status`
--

INSERT INTO `42pmz96_status` (`id`, `name`) VALUES
(1, 'en cours'),
(2, 'terminé'),
(3, 'à venir'),
(4, 'en pause');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_universes`
--

DROP TABLE IF EXISTS `42pmz96_universes`;
CREATE TABLE IF NOT EXISTS `42pmz96_universes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `universe` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_universes`
--

INSERT INTO `42pmz96_universes` (`id`, `universe`) VALUES
(1, 'manga'),
(2, 'anime'),
(3, 'global');

-- --------------------------------------------------------

--
-- Structure de la table `42pmz96_users`
--

DROP TABLE IF EXISTS `42pmz96_users`;
CREATE TABLE IF NOT EXISTS `42pmz96_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `subscribDate` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_42pmz96_roles` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `42pmz96_users_42pmz96_roles_FK` (`id_42pmz96_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `42pmz96_users`
--

INSERT INTO `42pmz96_users` (`id`, `username`, `password`, `mail`, `birthdate`, `subscribDate`, `image`, `id_42pmz96_roles`) VALUES
(1, 'totojo', '$2y$10$OxB8uUEasuKbudGo.eFOPeKyKLRqU5EcM3Qv4PsKQ1WkKggHuOqbC', 'totojo-1@hotmail.fr', '1992-06-18', '2020-08-25 12:12:08', 'assets/img/users/totojo_2020-08-27_11-29-44.jpg', 1),
(2, 'test', '$2y$10$I1VwApaKWcQ3FteTZcf5p.yosYXFnOMT.rbgnoplHGw2CVMo.PrdK', 'test@hotmail.fr', '2000-03-10', '2020-08-14 16:14:48', '/assets/img/iconUser.png', 2),
(8, 'moderateur', '$2y$10$kAW/0Za0GlugYqgKCKeYS.xJfdlE00EaLflXdJ./o9WNhPPNbgFVq', 'moderateur@gmail.com', '1996-08-12', '2020-08-26 10:04:22', 'assets/img/users/moderateur_2020-08-26_10-04-22.jpg', 2),
(9, 'tonyChopper', '$2y$10$hVUfyJLXsaI.kopqa6sCU.gAsChCOPEVIFTchRCajhZIuPgMrpkSK', 'tony@gmail.com', '2000-08-11', '2020-08-27 14:38:27', 'assets/img/iconUser.png', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `42pmz96_comments`
--
ALTER TABLE `42pmz96_comments`
  ADD CONSTRAINT `42pmz96_comments_42pmz96_products_FK` FOREIGN KEY (`id_42pmz96_products`) REFERENCES `42pmz96_products` (`id`),
  ADD CONSTRAINT `42pmz96_comments_42pmz96_users0_FK` FOREIGN KEY (`id_42pmz96_users`) REFERENCES `42pmz96_users` (`id`);

--
-- Contraintes pour la table `42pmz96_genresmayhaveproducts`
--
ALTER TABLE `42pmz96_genresmayhaveproducts`
  ADD CONSTRAINT `42pmz96_genresMayHaveProducts_42pmz96_genres_FK` FOREIGN KEY (`id`) REFERENCES `42pmz96_genres` (`id`),
  ADD CONSTRAINT `42pmz96_genresMayHaveProducts_42pmz96_products0_FK` FOREIGN KEY (`id_42pmz96_products`) REFERENCES `42pmz96_products` (`id`);

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
  ADD CONSTRAINT `42pmz96_listes_42pmz96_users0_FK` FOREIGN KEY (`id_42pmz96_users`) REFERENCES `42pmz96_users` (`id`);

--
-- Contraintes pour la table `42pmz96_marks`
--
ALTER TABLE `42pmz96_marks`
  ADD CONSTRAINT `42pmz96_marks_42pmz96_users_FK` FOREIGN KEY (`id_42pmz96_users`) REFERENCES `42pmz96_users` (`id`);

--
-- Contraintes pour la table `42pmz96_posts`
--
ALTER TABLE `42pmz96_posts`
  ADD CONSTRAINT `42pmz96_posts_42pmz96_postsTypes1_FK` FOREIGN KEY (`id_42pmz96_postsTypes`) REFERENCES `42pmz96_poststypes` (`id`),
  ADD CONSTRAINT `42pmz96_posts_42pmz96_universes_FK` FOREIGN KEY (`id_42pmz96_universes`) REFERENCES `42pmz96_universes` (`id`),
  ADD CONSTRAINT `42pmz96_posts_42pmz96_users0_FK` FOREIGN KEY (`id_42pmz96_users`) REFERENCES `42pmz96_users` (`id`);

--
-- Contraintes pour la table `42pmz96_presentations`
--
ALTER TABLE `42pmz96_presentations`
  ADD CONSTRAINT `42pmz96_presentations_42pmz96_licenses0_FK` FOREIGN KEY (`id_42pmz96_licenses`) REFERENCES `42pmz96_licenses` (`id`),
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
  ADD CONSTRAINT `42pmz96_products_42pmz96_licenses_FK` FOREIGN KEY (`id_42pmz96_licenses`) REFERENCES `42pmz96_licenses` (`id`),
  ADD CONSTRAINT `42pmz96_products_42pmz96_marks3_FK` FOREIGN KEY (`id_42pmz96_marks`) REFERENCES `42pmz96_marks` (`id`),
  ADD CONSTRAINT `42pmz96_products_42pmz96_productTypes1_FK` FOREIGN KEY (`id_42pmz96_productTypes`) REFERENCES `42pmz96_producttypes` (`id`),
  ADD CONSTRAINT `42pmz96_products_42pmz96_status2_FK` FOREIGN KEY (`id_42pmz96_status`) REFERENCES `42pmz96_status` (`id`),
  ADD CONSTRAINT `42pmz96_products_42pmz96_universes0_FK` FOREIGN KEY (`id_42pmz96_universes`) REFERENCES `42pmz96_universes` (`id`);

--
-- Contraintes pour la table `42pmz96_users`
--
ALTER TABLE `42pmz96_users`
  ADD CONSTRAINT `42pmz96_users_42pmz96_roles_FK` FOREIGN KEY (`id_42pmz96_roles`) REFERENCES `42pmz96_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
