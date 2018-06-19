DROP TABLE IF EXISTS keyword ;

CREATE TABLE keyword (
  'id' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  'name' varchar (255) NOT NULL UNIQUE );

INSERT INTO keyword VALUES (1,'Success');
INSERT INTO keyword VALUES (2,'Technology');

DROP TABLE IF EXISTS users ;

CREATE TABLE "users" (
  "id" varchar PRIMARY KEY ASC,
  "firstname" varchar(255) NOT NULL,
  "lastname" varchar(255) NOT NULL,
  "email" varchar(255) NOT NULL,
  "password" varchar(255) NOT NULL,
  "is_confirmed" boolean
);
--
-- Contenu de la table "users"
--

-- User 1, valide, pwd jano
INSERT INTO "users" VALUES (1,'Jano','Lapin','jano@lapin.net', '$2y$10$x4KDo1NWZA3n8jm8RnpG5OgDG2mIEianft602fLawel1yzsgt9hx2',1);
-- User 2, not finished, pwd guest
INSERT INTO "users" VALUES (2,'Guest','Lapin','guest@lapin.net', '$2y$10$zKOT1Ihgj97y0XEt3UDJueK7cyEpVPGgIw.BZNhM0TFDWWbsJ9tiG',0);

DROP TABLE IF EXISTS auth_tokens ;

CREATE TABLE "auth_tokens" (
  "id" integer PRIMARY KEY ASC,
  "user_id" integer NOT NULL,
  "auth_token" varchar(255) NOT NULL,
  "expiration" timestamp NOT NULL
);

--- this token is always valid for user 1, expiration in 2069
INSERT INTO auth_tokens (user_id,auth_token,expiration) VALUES (1,'ABCDEF0123456789','2069-22-09 18:00:00');
--- this token is always old for user 1, expiration in 1969
INSERT INTO auth_tokens (user_id,auth_token,expiration) VALUES (1,'0123456789ABCDEF','1969-22-09 18:00:00');


DROP TABLE IF EXISTS company ;

--Contenu de la table "company"

CREATE TABLE company (
id varchar NOT NULL PRIMARY KEY,
siret  varchar (255),
name varchar (255) NOT NULL,
creation_date  Date,
people varchar (255),
addr varchar (255),
city varchar (255) NOT NULL,
zip_code varchar (255),
department varchar (255) NOT NULL,
scope  varchar (255),
website  varchar (255),
presentation varchar (255),
logo varchar
);

-- company 1,
INSERT INTO company (id,siret,name,creation_date,people,addr,city,zip_code,department,scope,website,presentation)
VALUES (1,'1475286391247544','Orange','1992-07-22','01 - 1 ou 2 salariés','6 avenue de westphalie','Montigny le Bretonneux','78180','Yvelines','Ile de france','orange.com','Orange Blabla presentation');
-- company 2,
INSERT INTO company (id,siret,name,creation_date,people,addr,city,zip_code,department,scope,website,presentation)
VALUES (2,'1479865464853798','Options','1997-08-12','01 - 1 ou 2 salariés','10 domaine du val hubert','Longnes','78980','Yvelines','Ile de france','options.com','Options Blabla presentation');


DROP TABLE IF EXISTS company_keyword ;

CREATE TABLE "company_keyword" (
  "id" varchar PRIMARY KEY ASC,
  "company_id" integer NOT NULL,
  "keyword_id" integer NOT NULL
);

INSERT INTO company_keyword (id,company_id,keyword_id) VALUES (1,1,1);
INSERT INTO company_keyword (id,company_id,keyword_id) VALUES (2,1,2);

DROP TABLE IF EXISTS confirm_tokens ;

CREATE TABLE confirm_tokens (
id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
user_id  INTEGER NOT NULL,
token  varchar ( 255 ) NOT NULL,
expiration timestamp,
type_confirm varchar ( 255 )
);

--- this token is always valid for user 1, expiration in 2069
INSERT INTO confirm_tokens (user_id,token,expiration,type_confirm) VALUES (1,'RESETNOEXPI0123','2069-22-09 18:00:00','reset');
--- this token is always old for user 1, expiration in 1969
INSERT INTO confirm_tokens (user_id,token,expiration,type_confirm) VALUES (1,'3210EXPIRESET','1969-22-09 18:00:00','reset');
--- this token is always valid for user 1, expiration in 2069
INSERT INTO confirm_tokens (user_id,token,expiration,type_confirm) VALUES (3,'ABCDEF0123456789','2069-22-09 18:00:00','init');

 