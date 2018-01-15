Create table Utilisateur(
idUtilisateur smallint unsigned not null AUTO_INCREMENT,
nom varchar(50),
prenom varchar(50),
email varchar(255),
adresse varchar(255),
ville varchar(50),
cp varchar(50),
login varchar(255), 
mdp varchar(255),
avatar varchar(255),
PRIMARY KEY (idUtilisateur)
);

create table Article(
codeArticle smallint unsigned not null AUTO_INCREMENT,
titre varchar(255),
article text,
dateArticle date,
idUtilisateur smallint,
PRIMARY KEY (codeArticle),
FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur (idUtilisateur)
);

create table Commentaire(
codeCommentaire smallint unsigned not null AUTO_INCREMENT,
commentaire text,
dateCommentaire date,
idUtilisateur smallint,
PRIMARY KEY (codeCommentaire),
FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur (idUtilisateur)
);