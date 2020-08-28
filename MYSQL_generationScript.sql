#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: 42pmz96_universes
#------------------------------------------------------------

CREATE TABLE `42pmz96_universes`(
        `id`       Int  Auto_increment  NOT NULL ,
        `universe` Varchar (100) NOT NULL
	,CONSTRAINT 42pmz96_universes_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_licenses
#------------------------------------------------------------

CREATE TABLE `42pmz96_licenses`(
        `id`           Int  Auto_increment  NOT NULL ,
        `name`         Varchar (255) NOT NULL ,
        `creationDate` Date NOT NULL
	,CONSTRAINT 42pmz96_licenses_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_presentations
#------------------------------------------------------------

CREATE TABLE `42pmz96_presentations`(
        `id`                   Int  Auto_increment  NOT NULL ,
        `presentation`         Text NOT NULL ,
        `image`                Varchar (255) NOT NULL ,
        `id_42pmz96_universes` Int NOT NULL ,
        `id_42pmz96_licenses`  Int NOT NULL
	,CONSTRAINT 42pmz96_presentations_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_presentations_42pmz96_universes_FK FOREIGN KEY (`id_42pmz96_universes`) REFERENCES 42pmz96_universes(`id`)
	,CONSTRAINT 42pmz96_presentations_42pmz96_licenses0_FK FOREIGN KEY (`id_42pmz96_licenses`) REFERENCES 42pmz96_licenses(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_producerTypes
#------------------------------------------------------------

CREATE TABLE `42pmz96_producerTypes`(
        `id`   Int  Auto_increment  NOT NULL ,
        `name` Varchar (20) NOT NULL
	,CONSTRAINT 42pmz96_producerTypes_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_producers
#------------------------------------------------------------

CREATE TABLE `42pmz96_producers`(
        `id`                       Int  Auto_increment  NOT NULL ,
        `name`                     Varchar (150) NOT NULL ,
        `description`              Text NOT NULL ,
        `picture`                  Varchar (255) ,
        `id_42pmz96_producerTypes` Int NOT NULL
	,CONSTRAINT 42pmz96_producers_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_producers_42pmz96_producerTypes_FK FOREIGN KEY (`id_42pmz96_producerTypes`) REFERENCES 42pmz96_producerTypes(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_roles
#------------------------------------------------------------

CREATE TABLE `42pmz96_roles`(
        `id`   Int  Auto_increment  NOT NULL ,
        `role` Varchar (100) NOT NULL
	,CONSTRAINT 42pmz96_roles_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_users
#------------------------------------------------------------

CREATE TABLE `42pmz96_users`(
        `id`               Int  Auto_increment  NOT NULL ,
        `username`         Varchar (100) NOT NULL ,
        `password`         Varchar (255) ,
        `mail`             Varchar (255) ,
        `birthdate`        Date ,
        `subscribDate`     Datetime NOT NULL ,
        `image`            Varchar (255) ,
        `id_42pmz96_roles` Int NOT NULL
	,CONSTRAINT 42pmz96_users_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_users_42pmz96_roles_FK FOREIGN KEY (`id_42pmz96_roles`) REFERENCES 42pmz96_roles(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_listes
#------------------------------------------------------------

CREATE TABLE `42pmz96_listes`(
        `id`                   Int  Auto_increment  NOT NULL ,
        `name`                 Varchar (150) NOT NULL ,
        `creationDate`         Date NOT NULL ,
        `id_42pmz96_universes` Int NOT NULL ,
        `id_42pmz96_users`     Int NOT NULL
	,CONSTRAINT 42pmz96_listes_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_listes_42pmz96_universes_FK FOREIGN KEY (`id_42pmz96_universes`) REFERENCES 42pmz96_universes(`id`)
	,CONSTRAINT 42pmz96_listes_42pmz96_users0_FK FOREIGN KEY (`id_42pmz96_users`) REFERENCES 42pmz96_users(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_genres
#------------------------------------------------------------

CREATE TABLE `42pmz96_genres`(
        `id`   Int  Auto_increment  NOT NULL ,
        `name` Varchar (100) NOT NULL
	,CONSTRAINT 42pmz96_genres_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_productTypes
#------------------------------------------------------------

CREATE TABLE `42pmz96_productTypes`(
        `id`   Int  Auto_increment  NOT NULL ,
        `name` Varchar (100) NOT NULL
	,CONSTRAINT 42pmz96_productTypes_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_status
#------------------------------------------------------------

CREATE TABLE `42pmz96_status`(
        `id`   Int  Auto_increment  NOT NULL ,
        `name` Varchar (100) NOT NULL
	,CONSTRAINT 42pmz96_status_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_marks
#------------------------------------------------------------

CREATE TABLE `42pmz96_marks`(
        `id`               Int  Auto_increment  NOT NULL ,
        `mark`             Int NOT NULL ,
        `id_42pmz96_users` Int NOT NULL
	,CONSTRAINT 42pmz96_marks_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_marks_42pmz96_users_FK FOREIGN KEY (`id_42pmz96_users`) REFERENCES 42pmz96_users(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_products
#------------------------------------------------------------

CREATE TABLE `42pmz96_products`(
        `id`                      Int  Auto_increment  NOT NULL ,
        `title`                   Varchar (255) NOT NULL ,
        `cover`                   Varchar (255) ,
        `description`             Text NOT NULL ,
        `itemNumber`              Int ,
        `publicationDate`         Date ,
        `endDate`                 Date ,
        `id_42pmz96_licenses`     Int NOT NULL ,
        `id_42pmz96_universes`    Int NOT NULL ,
        `id_42pmz96_productTypes` Int NOT NULL ,
        `id_42pmz96_status`       Int NOT NULL ,
        `id_42pmz96_marks`        Int NOT NULL
	,CONSTRAINT 42pmz96_products_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_products_42pmz96_licenses_FK FOREIGN KEY (`id_42pmz96_licenses`) REFERENCES 42pmz96_licenses(`id`)
	,CONSTRAINT 42pmz96_products_42pmz96_universes0_FK FOREIGN KEY (`id_42pmz96_universes`) REFERENCES 42pmz96_universes(`id`)
	,CONSTRAINT 42pmz96_products_42pmz96_productTypes1_FK FOREIGN KEY (`id_42pmz96_productTypes`) REFERENCES 42pmz96_productTypes(`id`)
	,CONSTRAINT 42pmz96_products_42pmz96_status2_FK FOREIGN KEY (`id_42pmz96_status`) REFERENCES 42pmz96_status(`id`)
	,CONSTRAINT 42pmz96_products_42pmz96_marks3_FK FOREIGN KEY (`id_42pmz96_marks`) REFERENCES 42pmz96_marks(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_comments
#------------------------------------------------------------

CREATE TABLE `42pmz96_comments`(
        `id`                  Int  Auto_increment  NOT NULL ,
        `comment`             Text NOT NULL ,
        `postDate`            Datetime NOT NULL ,
        `id_42pmz96_products` Int NOT NULL ,
        `id_42pmz96_users`    Int NOT NULL
	,CONSTRAINT 42pmz96_comments_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_comments_42pmz96_products_FK FOREIGN KEY (`id_42pmz96_products`) REFERENCES 42pmz96_products(`id`)
	,CONSTRAINT 42pmz96_comments_42pmz96_users0_FK FOREIGN KEY (`id_42pmz96_users`) REFERENCES 42pmz96_users(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_postsTypes
#------------------------------------------------------------

CREATE TABLE `42pmz96_postsTypes`(
        `id`   Int  Auto_increment  NOT NULL ,
        `name` Varchar (100) NOT NULL
	,CONSTRAINT 42pmz96_postsTypes_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_posts
#------------------------------------------------------------

CREATE TABLE `42pmz96_posts`(
        `id`                    Int  Auto_increment  NOT NULL ,
        `content`               Text NOT NULL ,
        `image`                 Varchar (255) ,
        `postDate`              Datetime NOT NULL ,
        `lastEditDate`          Datetime ,
        `title`                 Varchar (100) NOT NULL ,
        `id_42pmz96_universes`  Int NOT NULL ,
        `id_42pmz96_users`      Int NOT NULL ,
        `id_42pmz96_postsTypes` Int NOT NULL
	,CONSTRAINT 42pmz96_posts_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_posts_42pmz96_universes_FK FOREIGN KEY (`id_42pmz96_universes`) REFERENCES 42pmz96_universes(`id`)
	,CONSTRAINT 42pmz96_posts_42pmz96_users0_FK FOREIGN KEY (`id_42pmz96_users`) REFERENCES 42pmz96_users(`id`)
	,CONSTRAINT 42pmz96_posts_42pmz96_postsTypes1_FK FOREIGN KEY (`id_42pmz96_postsTypes`) REFERENCES 42pmz96_postsTypes(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_producerRoles
#------------------------------------------------------------

CREATE TABLE `42pmz96_producerRoles`(
        `id`   Int  Auto_increment  NOT NULL ,
        `role` Varchar (100) NOT NULL
	,CONSTRAINT 42pmz96_producerRoles_PK PRIMARY KEY (`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_ProducersProducts
#------------------------------------------------------------

CREATE TABLE `42pmz96_ProducersProducts`(
        `id`                       Int  Auto_increment  NOT NULL ,
        `id_42pmz96_producerRoles` Int NOT NULL ,
        `id_42pmz96_products`      Int NOT NULL ,
        `id_42pmz96_producers`     Int NOT NULL
	,CONSTRAINT 42pmz96_ProducersProducts_PK PRIMARY KEY (`id`)

	,CONSTRAINT 42pmz96_ProducersProducts_42pmz96_producerRoles_FK FOREIGN KEY (`id_42pmz96_producerRoles`) REFERENCES 42pmz96_producerRoles(`id`)
	,CONSTRAINT 42pmz96_ProducersProducts_42pmz96_products0_FK FOREIGN KEY (`id_42pmz96_products`) REFERENCES 42pmz96_products(`id`)
	,CONSTRAINT 42pmz96_ProducersProducts_42pmz96_producers1_FK FOREIGN KEY (`id_42pmz96_producers`) REFERENCES 42pmz96_producers(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_listeMayHaveProducts
#------------------------------------------------------------

CREATE TABLE `42pmz96_listeMayHaveProducts`(
        `id`                  Int NOT NULL ,
        `id_42pmz96_products` Int NOT NULL
	,CONSTRAINT 42pmz96_listeMayHaveProducts_PK PRIMARY KEY (`id`,`id_42pmz96_products`)

	,CONSTRAINT 42pmz96_listeMayHaveProducts_42pmz96_listes_FK FOREIGN KEY (`id`) REFERENCES 42pmz96_listes(`id`)
	,CONSTRAINT 42pmz96_listeMayHaveProducts_42pmz96_products0_FK FOREIGN KEY (`id_42pmz96_products`) REFERENCES 42pmz96_products(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: 42pmz96_genresMayHaveProducts
#------------------------------------------------------------

CREATE TABLE `42pmz96_genresMayHaveProducts`(
        `id`                  Int NOT NULL ,
        `id_42pmz96_products` Int NOT NULL
	,CONSTRAINT 42pmz96_genresMayHaveProducts_PK PRIMARY KEY (`id`,`id_42pmz96_products`)

	,CONSTRAINT 42pmz96_genresMayHaveProducts_42pmz96_genres_FK FOREIGN KEY (`id`) REFERENCES 42pmz96_genres(`id`)
	,CONSTRAINT 42pmz96_genresMayHaveProducts_42pmz96_products0_FK FOREIGN KEY (`id_42pmz96_products`) REFERENCES 42pmz96_products(`id`)
)ENGINE=InnoDB;

