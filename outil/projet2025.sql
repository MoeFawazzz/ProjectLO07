-- =================================================================
-- Base SOUTENANCES version 4
-- Marc LEMERCIER, le 3-25 avril 2025
-- =================================================================


-- =================================================================
-- table personne
-- =================================================================

create table if not exists personne (
 id integer unsigned not null,
 nom varchar(40) not null,
 prenom varchar(40) not null,
 role_responsable boolean,
 role_examinateur boolean,
 role_etudiant boolean,
 login varchar(20) unique not null,
 password varchar(20) not null,
 primary key (id) 
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


-- =================================================================
-- table projet
-- =================================================================

create table if not exists projet (
 id integer unsigned not null,
 label varchar(60) not null,
 responsable integer unsigned not null,
 groupe integer unsigned not null,  
 primary key (id),
 foreign key (responsable) references personne(id) on delete cascade 
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

-- =================================================================
-- table creneaux
-- =================================================================

create table if not exists creneau (
 id integer unsigned not null,
 projet integer unsigned not null,
 examinateur integer unsigned not null,
 creneau datetime,
 primary key (id),
 foreign key (projet) references projet(id) on delete cascade,
 foreign key (examinateur) references personne(id) on delete cascade 
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

-- format de la date : '2000Ò-01-01 00:00:00'

-- =================================================================
-- table des rdv
-- =================================================================

create table if not exists rdv (
id integer unsigned not null,
creneau  integer unsigned not null,
etudiant integer unsigned not null, 
primary key (id),
foreign key (creneau) references creneau(id) on delete cascade, 
foreign key (etudiant) references personne(id) on delete cascade 
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

-- =================================================================
-- 2 petites views
-- Vous pouvez utiliser les deux vues suivantes dans votre projet.
-- Chut. Ne pas en parler si vous avez vu que je vous offre 2 cadeaux ...
-- C'est un test !
-- =================================================================

create or replace view infocreneaux as
select CR.id as creneau_id, PJ.id as projet_id, PJ.label, EX.id as examinateur_id, EX.nom, EX.prenom, CR.creneau, PJ.groupe
from creneau CR, projet PJ, personne EX
where CR.projet = PJ.id and CR.examinateur = EX.id;


create or replace view infordv as
select R.ID as rdv_id, P.id as projet_id, P.label as projet_label, 
       EX.ID as examinateur_id, EX.nom as examinateur_nom, EX.prenom as examinateur_prenom, 
       R.creneau as creneau_id, ET.ID as etudiant_id, ET.nom as etudiant_nom, ET.prenom as etudiant_prenom, 
       C.creneau 
from rdv R, creneau C, personne ET, projet P, personne EX
where R.creneau = C.id and R.etudiant = ET.id and C.projet = P.id and C.examinateur = EX.id;


-- =================================================================
-- Les data
-- =================================================================

-- ============== PERSONNES


insert into personne values (1000, 'BOSS', 'boss',  true, true, true, 'boss', 'secret');

insert into personne values (1, 'LEMERCIER', 'marc',  true, true, false, 'lemercier', 'secret');
insert into personne values (2, 'CORPEL', 'alain', true, true, false, 'corpel', 'secret');
insert into personne values (3, 'PLOIX', 'alain', false, true, false, 'ploix', 'secret');
insert into personne values (4, 'NIGRO', 'jean_marc', false, true, false, 'nigro', 'secret');
insert into personne values (5, 'BENEL', 'aurélien', false, true, false, 'benel', 'secret');

insert into personne values (11, 'GLOUX', 'alexis',  false, true, false, 'gloux', 'secret');
insert into personne values (12, 'PEREZ', 'charles', false, true, false, 'perez', 'secret');
insert into personne values (13, 'SOKOLOVA', 'karina',  false, true, false, 'sokolova', 'secret');


insert into personne values (101, 'ADJANI', 'isabelle', false, false, true, 'adjani', 'secret');
insert into personne values (102, 'AUTEUIL', 'daniel', false, false, true, 'auteuil', 'secret');
insert into personne values (103, 'BLANC', 'michel', false, false, true, 'blanc', 'secret');
insert into personne values (104, 'BINOCHE', 'juliette', false, false, true, 'binoche', 'secret');
insert into personne values (105, 'CASSEL', 'vincent', false, false, true, 'cassel', 'secret');
insert into personne values (106, 'COTTIN', 'camille', false, false, true, 'COTTIN', 'secret');
insert into personne values (107, 'CLAVIER', 'christian', false, false, true, 'clavier', 'secret');
insert into personne values (108, 'DELON', 'alain', false, false, true, 'delon', 'secret');
insert into personne values (109, 'FLEUROT', 'audrey', false, false, true, 'FLEUROT', 'secret');
insert into personne values (110, 'GABIN', 'jean', false, false, true, 'gabin', 'secret');
insert into personne values (111, 'ROCHEFORT', 'jean', false, false, true, 'rochefort', 'secret');

-- ============== PROJETS

insert into projet values (101, 'LO07 Projet 2021 COVID 2021', 1, 1);
insert into projet values (102, 'LO07 Projet 2022 GENEALOGIE', 1, 2);
insert into projet values (103, 'LO07 Projet 2023 DOCTOLIB'  , 1, 3);
insert into projet values (104, 'LO07 Projet 2024 PATRIMOINE', 1, 4);

insert into projet values (201, 'IF03 Projet 2025', 2, 2);
insert into projet values (301, 'RE20 Projet 2025', 3, 5);


-- ============== CRENEAUX

-- PJ1
insert into creneau values (11, 101, 11, '2025-07-10 09:00:00');
insert into creneau values (12, 101, 12, '2025-07-10 10:00:00');
insert into creneau values (13, 101, 12, '2025-07-10 11:00:00');
insert into creneau values (14, 101, 11, '2025-07-10 12:00:00');

-- PJ2
insert into creneau values (21, 102, 11, '2025-05-14 09:00:00');
insert into creneau values (22, 102, 12, '2025-07-10 09:00:00');
insert into creneau values (23, 102, 13, '2025-07-10 09:00:00');
insert into creneau values (24, 102, 13, '2025-07-10 10:00:00');

-- PJ3
insert into creneau values (31, 103, 11, '2025-05-14 09:00:00');

-- PJ4
insert into creneau values (41, 104, 13, '2025-05-14 09:00:00');


-- ============== RDV

-- PJ1
insert into rdv values (11, 11, 101);
insert into rdv values (12, 12, 102);
insert into rdv values (13, 13, 103);

-- PJ2

insert into rdv values (21, 21, 104);
insert into rdv values (22, 21, 105);

insert into rdv values (23, 22, 106);
insert into rdv values (24, 22, 107);
insert into rdv values (25, 22, 108);

-- PJ3
insert into rdv values (31, 31, 101);
insert into rdv values (32, 31, 102);


-- PJ4
insert into rdv values (41, 41, 110);

--User Table
CREATE TABLE IF NOT EXISTS user (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(40) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;