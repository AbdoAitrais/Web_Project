/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     5/9/2022 5:01:15 PM                          */
/*==============================================================*/


drop table if exists ADMIN;

drop table if exists ATTENTE;

drop table if exists DEPARTEMENT;

drop table if exists ENSEIGNANT;

drop table if exists ENTREPRISE;

drop table if exists ETUDIANT;

drop table if exists FORMATION;

drop table if exists JURI;

drop table if exists OFFRE;

drop table if exists POSTULER;

drop table if exists RAPPORT;

drop table if exists STAGE;

/*==============================================================*/
/* Table: ADMIN                                                 */
/*==============================================================*/
create table ADMIN
(
   ID_ADMIN             int not null,
   LOGIN_ADMIN          varchar(25),
   PASS_ADMIN           varchar(25),
   primary key (ID_ADMIN)
);

/*==============================================================*/
/* Table: ATTENTE                                               */
/*==============================================================*/
create table ATTENTE
(
   ID_ETU               int not null,
   ID_OFFRE             int not null,
   PRIORITE             int,
   primary key (ID_ETU, ID_OFFRE)
);

/*==============================================================*/
/* Table: DEPARTEMENT                                           */
/*==============================================================*/
create table DEPARTEMENT
(
   ID_DEPART            int not null auto_increment,
   NOM_DEPART           varchar(30),
   primary key (ID_DEPART)
);

/*==============================================================*/
/* Table: ENSEIGNANT                                            */
/*==============================================================*/
create table ENSEIGNANT
(
   ID_ENS               int not null,
   ID_DEPART            int not null,
   NOM_ENS              varchar(25),
   PRENOM_ENS           varchar(25),
   CIN_ENS              varchar(15),
   DATENAISS_ENS        date,
   NUMTEL_ENS           int,
   primary key (ID_ENS)
);

/*==============================================================*/
/* Table:                                              */
/*==============================================================*/
create table ENTREPRISE
(
   ID_ENTREP            int not null auto_increment,
   NOM_ENTREP           varchar(25),
   EMAIL_ENTREP         varchar(50),
   VILLE                varchar(30),
   primary key (ID_ENTREP)
);

/*==============================================================*/
/* Table: ETUDIANT                                              */
/*==============================================================*/
create table ETUDIANT
(
   ID_ETU               int not null auto_increment,
   ID_FORM              int not null,
   NOM_ETU              varchar(25),
   PRENOM_ETU           varchar(25),
   CIN_ETU              varchar(15),
   CNE                  varchar(15),
   NIVEAU               int,
   PROMOTION            int,
   DATENAISS_ETU        date,
   ADRESSE_ETU          varchar(50),
   EMAIL_ETU            varchar(50),
   NUMTEL_ETU           int,
   LOGIN_ETU            varchar(25),
   PASS_ETU             varchar(25),
   primary key (ID_ETU)
);

/*==============================================================*/
/* Table: FORMATION                                             */
/*==============================================================*/
create table FORMATION
(
   ID_FORM              int not null auto_increment,
   ID_ENS               int not null,
   FILIERE              varchar(30),
   TYPE_FORM                 int,
   LOGIN_RESP           varchar(25),
   PASS_RESP            varchar(25),
   primary key (ID_FORM)
);

/*==============================================================*/
/* Table: JURI                                                  */
/*==============================================================*/
create table JURI
(
   ID_ENS               int not null,
   ID_STAGE             int not null,
   NOTE                 float,
   primary key (ID_ENS, ID_STAGE)
);

/*==============================================================*/
/* Table: OFFRE                                                 */
/*==============================================================*/
create table OFFRE
(
   ID_OFFRE             int not null auto_increment,
   ID_FORM              int not null,
   ID_ENTREP            int not null,
   STATUOFFRE           varchar(25),
   NBRCANDIDAT          int,
   POSTE                varchar(30),
   DUREE                int,
   DATEDEBUT            date,
   DATEFIN              date,
   DESCRIP          varchar(300),
   primary key (ID_OFFRE)
);

/*==============================================================*/
/* Table: POSTULER                                              */
/*==============================================================*/
create table POSTULER
(
   ID_ETU               int not null,
   ID_OFFRE             int not null,
   STATU                varchar(30),
   DATEREPONS           date,
   DATEPOST             date,
   primary key (ID_ETU, ID_OFFRE)
);

/*==============================================================*/
/* Table: RAPPORT                                               */
/*==============================================================*/
create table RAPPORT
(
   ID_RAPP              int not null auto_increment,
   MOTCLE               varchar(100),
   FICHIER              varchar(50),
   primary key (ID_RAPP)
);

/*==============================================================*/
/* Table: STAGE                                                 */
/*==============================================================*/
create table STAGE
(
   ID_STAGE             int not null auto_increment,
   ID_ENTREP            int not null,
   ID_RAPP              int,
   ID_ENS               int not null,
   ID_ETU               int not null,
   POSTE                varchar(30),
   DUREE                int,
   DESCRIP          varchar(300),
   DATEREPONS           date,
   DATEPOST             date,
   NOTENCAD_ENTREP      float,
   NOTENCAD             float,
   CONTRAT              varchar(50),
   primary key (ID_STAGE)
);

alter table ATTENTE add constraint FK_ATTENTE foreign key (ID_ETU)
      references ETUDIANT (ID_ETU) on delete restrict on update restrict;

alter table ATTENTE add constraint FK_ATTENTE2 foreign key (ID_OFFRE)
      references OFFRE (ID_OFFRE) on delete restrict on update restrict;

alter table ENSEIGNANT add constraint FK_FAIRE_PARTIE_DE foreign key (ID_DEPART)
      references DEPARTEMENT (ID_DEPART) on delete restrict on update restrict;

alter table ETUDIANT add constraint FK_APPARTENIR foreign key (ID_FORM)
      references FORMATION (ID_FORM) on delete restrict on update restrict;

alter table FORMATION add constraint FK_GERER2 foreign key (ID_ENS)
      references ENSEIGNANT (ID_ENS) on delete restrict on update restrict;

alter table JURI add constraint FK_JURI foreign key (ID_ENS)
      references ENSEIGNANT (ID_ENS) on delete restrict on update restrict;

alter table JURI add constraint FK_JURI2 foreign key (ID_STAGE)
      references STAGE (ID_STAGE) on delete restrict on update restrict;

alter table OFFRE add constraint FK_CONCERNER foreign key (ID_FORM)
      references FORMATION (ID_FORM) on delete restrict on update restrict;

alter table OFFRE add constraint FK_PRESENTER foreign key (ID_ENTREP)
      references ENTREPRISE (ID_ENTREP) on delete restrict on update restrict;

alter table POSTULER add constraint FK_POSTULER foreign key (ID_ETU)
      references ETUDIANT (ID_ETU) on delete restrict on update restrict;

alter table POSTULER add constraint FK_POSTULER2 foreign key (ID_OFFRE)
      references OFFRE (ID_OFFRE) on delete restrict on update restrict;

alter table STAGE add constraint FK_CORRESPONDRE2 foreign key (ID_RAPP)
      references RAPPORT (ID_RAPP) on delete restrict on update restrict;

alter table STAGE add constraint FK_ENCADRER foreign key (ID_ENS)
      references ENSEIGNANT (ID_ENS) on delete restrict on update restrict;

alter table STAGE add constraint FK_PRESENTER_PAR foreign key (ID_ENTREP)
      references ENTREPRISE (ID_ENTREP) on delete restrict on update restrict;

alter table STAGE add constraint FK_STAGIER foreign key (ID_ETU)
      references ETUDIANT (ID_ETU) on delete restrict on update restrict;

