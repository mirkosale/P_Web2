-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Mon Apr  4 14:13:42 2022 
-- * LUN file: F:\01-Projets\040-P_Web2\db_recettes.lun 
-- * Schema: db_recettes/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

drop database if exists db_recettes;
create database db_recettes;
use db_recettes;

-- Tables Section
-- _____________ 

drop table if exists t_note;
drop table if exists t_recette;
drop table if exists t_user;

create table t_note (
     idNote int auto_increment not null,
     notStars int(1) not null,
     fkRecette int not null,
     constraint ID_t_note_ID primary key (idNote)
	 )ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table t_recette (
     idRecette int auto_increment not null,
     recName varchar(50) not null,
     recListOfItems varchar(32767) not null,
     recPreparation varchar(32767) not null,
     recImage blob not null,
     fkNote int default null,
     fkTypeDish int not null,
     constraint ID_t_recette_ID primary key (idRecette)
	 )ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table t_typedish (
     idTypeDish  int auto_increment not null,
     typName varchar(30) not null,
     fkRecette int not null,
     constraint ID_t_typedish_ID primary key (idTypeDish));

create table t_user (
     idUser int auto_increment not null,
     useLogin varchar(30) not null,
     usePassword varchar(255) not null,
     useAdministrator int(2) not null,
     constraint ID_t_user_ID primary key (idUser)
	 )ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Constraints Section
-- ___________________ 

alter table t_recette add constraint REF_t_rec_t_not_FK
     foreign key (fkNote)
     references t_note(idNote);

alter table t_recette add constraint REF_t_rec_t_typ_FK
     foreign key (fkTypeDish)
     references t_typedish(idTypeDish);

-- Index Section
-- _____________ 

create unique index ID_t_note_IND
     on t_note (idNote);

create unique index ID_t_recette_IND
     on t_recette (idRecette);

create index REF_t_rec_t_not_IND
     on t_recette (fkNote);

create index REF_t_rec_t_typ_IND
     on t_recette (fkTypeDish);

create unique index ID_t_typedish_IND
     on t_typedish (idTypeDish);

create unique index ID_t_user_IND
     on t_user (idUser);

-- Utilisateur DB
-- ______________

DROP USER IF EXISTS `dbUser_recette`@`localhost`;
CREATE USER `dbUser_recette`@`localhost` identified by '.Etml-';
GRANT INSERT, SELECT, DELETE, UPDATE ON `db_recettes`.* TO `dbUser_recette`@`localhost`;
FLUSH PRIVILEGES;

-- Utilisateurs site web
-- _____________________

INSERT INTO t_user (useLogin, usePassword, useAdministrator) VALUES 
  ("Admin", '$2y$10$NLsMMb.GmMfpA9MTCHs5qe.FhXfi6Pg7hPY.ClmaS2.huUutTQwWi', 1),
  ("NotAdmin", '$2y$10$B2.pEaUkYgotasrWs7p.AOTJRwdsiOvGtYL738.6TDinnS5CzWfI.', 0);

-- Types de plats
-- ______________

INSERT INTO t_typedish (typName) VALUES ("Entrée"), ("Plat principal"), ("Dessert"), ("Goûter");

-- Recettes
-- ________

INSERT INTO t_recette (recName, fkTypeDish, recListOfItems, recPreparation, recImage) VALUES ("Tartare de crevette",1,"1 jaune d'oeuf frais, 1c.c de moutard, 0.5c.c de jus de citron, 1gousse d'ail pressée, 1dl d'huile de colza non pressée à froid, 0.25c.c de sel, un peu de poivre, 240g de crevette pour cocktail hachée finement, 1.cs de Ketchup,de persil plat coupé finement, d'aneth coupés finement, 6tranches de pain de mie grillées, coupé en quatre, 25g de beurre salé","Bien mélanger au fouet dans un bol jaune d’oeuf, moutarde, jus de citron et ail. Verser l’huile au début goutte à goutte, sans cesser de remuer, puis en filet, saler, poivrer.
Ajouter les crevettes et tous les ingrédients jusqu’aux flocons de piment compris, mélanger.
Beurrer une face du pain de mie. Dresser dessus la masse aux crevettes avec les petits moules à dresser de Betty Bossi.","img.jpg");
INSERT INTO t_recette(recName, fkTypeDish, recListOfItems, recPreparation, recImage) VALUES ("Burrata sur pain grillé",1,"1 baguette ou 200g de pain bis, 3c.s d'huile d'olive, 50g de roquette, 2 burratas(d'environ 150g), 1c.s de mélange d'épices flocons de tomates","Couper le pain en très grandes tranches biseautées. Faire griller les tranches dans la poêle-gril bien chaude ou dans une poêle, dresser sur un plat. Arroser d’un filet d’huile. Effeuiller la roquette, répartir dessus. Prélever la burrata avec une cuillère à soupe, répartir dessus, parsemer du mélange d’épices.","img.jpg");
INSERT INTO t_recette(recName, fkTypeDish, recListOfItems, recPreparation, recImage) VALUES ("Moules gratinées",1,"1c.s d'huile d'olive, 1échalote hachée grossièrement, 500g de moules(brosser soigneusement les moules sous l’eau courante froide, les ébarber, jeter les coquilles ouvertes), 1dl de vin blanc, 80g de crème fraiche, 1 jaune d'oeuf frais, 2c.s de parmesan rapé, 0.25c.c de sel, un peu de poivre, 20g de beurre, une tranche de pain de mie en petit dés, 2c.s d'aneth ciselée, 0.25 c.c de esel ","","img.jpg");
INSERT INTO t_recette(recName, fkTypeDish, recListOfItems, recPreparation, recImage) VALUES ("Flûtes à la tomate",1,"150g de tomates séchées à l'huile,0.25 bouquet de romarin, 0.25 bouquet de sauge, 80g de sbrinz râpé, 0.25c.c de sel, un peu de poivre, 1 abaisse de pâte à pizza, 1 oeuf ","Préchauffer le four à 200°C.
Égoutter les tomates et les tailler en fines lanières. Ciseler le romarin et la sauge, les ajouter avec le sbrinz, mélanger, saler et poivrer la farce.
Dérouler l’abaisse de pâte. Étaler la farce en longueur sur une moitié de pâte, rabattre l’autre moitié, appuyer un peu pour faire adhérer. Couper la pâte dans la largeur en lanières d’env. 2 cm de large, torsader sans trop serrer, disposer sur une plaque chemisée de papier cuisson en espaçant bien. Battre l’œuf, en badigeonner les flûtes.
Cuisson: env. 20 min au milieu du four.","img.jpg");
INSERT INTO t_recette(recName, fkTypeDish, recListOfItems, recPreparation, recImage) VALUES ("Spaghettis Carbonara",2,"500g de spaghettis, eau salée fremissante, 1 oignon, 150g de lard à rôtir en tranche ou de pancetta,1 oeuf frais par personne, 100g de parmesan, nu peu de muscade, 0.25c.c de sel, un peu de poivre","Cuire les spaghettis al dente dans l’eau salée frémissante, égoutter.
Peler et hacher finement l’oignon. Couper le lard en fines lanières et le faire rissoler à sec dans une poêle antiadhésive, retirer. Baisser le feu, faire revenir l’oignon env. 5 min dans la même poêle. Ajouter les spaghettis et le lard et bien réchauffer. Baisser le feu.
Bien mélanger crème, œufs et parmesan, assaisonner, verser sur les spaghettis, mélanger délicatement avec deux fourchettes, le temps de bien faire chauffer (les œufs ne doivent pas coaguler), servir aussitôt.","img.jpg");
