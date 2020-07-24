-- Requête pour afficher les posts pour l'univer Manga
USE `anymanga`;
SELECT `pos`.`title`, `pos`.`image`, `pos`.`content`, `pos`.`postDate`, `pos`.`lastEditDate`, `posTy`.`name`, `uni`.`universe`, `use`.`pseudo`
FROM `42pmz96_posts` AS `pos`
INNER JOIN `42pmz96_postTypes` AS `posTy` ON `posTy`.`id` = `pos` . `id_42pmz96_postsTypes`
INNER JOIN `42pmz96_universes` AS `uni` ON `uni`.`id` = `pos` . `id_42pmz96_universes`
INNER JOIN `42pmz96_users` AS `use` on `use`.`id` = `pos` . `id_42pmz96_users`
HAVING `uni`.`universe` = 'manga'
ORDER BY `pos`.`lastEditDate`DESC;

-- Requête pour afficher les posts pour l'univer anime
USE `anymanga`;
SELECT `pos`.`title`, `pos`.`image`, `pos`.`content`, `use`.`username`, `posTy`.`name`, `uni`.`universe`, `pos`.`postDate`, `pos`.`lastEditDate`
FROM `42pmz96_posts` AS `pos`
INNER JOIN `42pmz96_postType` AS `posTy` ON `posTy`.`id` = `pos` . `id_42pmz96_postsTypes`
INNER JOIN `42pmz96_universes` AS `uni` ON `uni`.`id` = `pos` . `id_42pmz96_universes`
INNER JOIN `42pmz96_users` AS `use` on `use`.`id` = `pos` . `id_42pmz96_users`
HAVING `uni`.`universe` = 'anime'
ORDER BY `pos`.`lastEditDate` DESC;

-- Requête pour le planning des sortie de manga
USE `anymanga`;
SELECT `pro`.`title`, `pro`.`cover`, `pro`.`description`, `pro`.`publicationDate`, `uni`.`universe`
FROM `42pmz96_products` AS `pro`
INNER JOIN `42pmz96_universes` AS `uni` ON `uni`.`id` = `pro`.`id_42pmz96_universes`
HAVING `pro`.`publicationDate` >= CURDATE() AND `uni`.`universe` = 'anime'
ORDER BY `pro`.`publicationDate` ASC;

-- Requête pour le planning des sortie d'anime
USE `anymanga`;
SELECT `pro`.`title`, `pro`.`cover`, `pro`.`description`, `pro`.`publicationDate`, `uni`.`universe`
FROM `42pmz96_products` AS `pro`
INNER JOIN `42pmz96_universes` AS `uni` ON `uni`.`id` = `pro`.`id_42pmz96_universes`
HAVING `pro`.`publicationDate` CURDATE() AND `uni`.`universe` = 'anime'
ORDER BY `pro`.`publicationDate` ASC;

-- Requête pour affiché les listes découvertes
