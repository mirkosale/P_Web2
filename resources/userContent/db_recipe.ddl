-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Mon Apr 11 14:08:08 2022 
-- * LUN file: F:\01-Projets\040-P_Web2\db_recipe.lun 
-- * Schema: db_recipe/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

drop database if exists db_recipe;
create database db_recipe;
use db_recipe;

-- Tables Section
-- _____________ 

create table t_note (
     idNote int auto_increment not null,
     notStars int(1) not null,
     fkRecipe int not null,
     fkUser int not null,
     constraint ID_t_note_ID primary key (idNote)
	 )ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table t_recipe (
     idRecipe int auto_increment not null,
     recName varchar(30) not null,
     recListOfItems varchar(32767) not null,
     recPreparation varchar(32767) not null,
     recImage varchar(255) not null,
     fkTypeDish int not null,
     constraint ID_t_recipe_ID primary key (idRecipe)
	 )ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table t_typedish (
     idTypeDish  int auto_increment not null,
     typName varchar(30) not null,
     constraint ID_t_typedish_ID primary key (idTypeDish)
	 )ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table t_user (
     idUser int auto_increment not null,
     useLogin varchar(30) not null,
     usePassword varchar(255) not null,
     useAdministrator int(2) not null,
     constraint ID_t_user_ID primary key (idUser)
	 )ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Constraints Section
-- ___________________ 

alter table t_note add constraint REF_t_not_t_rec_FK
     foreign key (fkRecipe)
     references t_recipe (idRecipe)
     on delete cascade;

alter table t_note add constraint REF_t_not_t_use_FK
     foreign key (fkUser)
     references t_user (idUser)
     on delete cascade;

alter table t_recipe add constraint REF_t_rec_t_typ_FK
     foreign key (fkTypeDish)
     references t_typedish (idTypeDish);

-- Index Section
-- _____________ 

create unique index ID_t_note_IND
     on t_note (idNote);

create index REF_t_not_t_rec_IND
     on t_note (fkRecipe);

create index REF_t_not_t_use_IND
     on t_note (fkUser);

create unique index ID_t_recipe_IND
     on t_recipe (idRecipe);

create index REF_t_rec_t_typ_IND
     on t_recipe (fkTypeDish);

create unique index ID_t_typedish_IND
     on t_typedish (idTypeDish);

create unique index ID_t_user_IND
     on t_user (idUser);