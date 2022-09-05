create table membre(Idmembre int primary key AUTO_INCREMENT,
                    nom varchar(100) NOT null,
                    prenom varchar(100) NOT null,
                    login varchar(100) NOT null,
                    sexe varchar(15),
                    mdpasse varchar(100) NOT null,
                    photo varchar(100),
                    statut varchar(100)
                   );
                           
            create table message (Idmessage int primary key AUTO_INCREMENT,
                 contenu varchar(255),
                 dateHeur datetime,
                 emetteur int,
                 destinataire int ,
                 CONSTRAINT FK_emett FOREIGN KEY (emetteur) references membre(Idmembre),
                 CONSTRAINT FK_dest FOREIGN key (destinataire) references membre(Idmembre)
                                                );
                                                
                                                
                     create table amitie(
                                  demendeur int,
                                  cible int ,
                                   etat enum ('0','1','-1','-2'),
                                  datedebut DATE DEFAULT CURRENT_DATE,
                                  Constraint FK_demend foreign key  (demendeur) references membre(Idmembre),
                                  Constraint FK_cible  foreign key (cible) references membre(Idmembre),
                                  Constraint PK_pkey   primary key (demendeur,cible)
                                  );
                                                                        
-- INSERT INTO membre(`Idmembre`, `nom`, `prenom`, `login`, `sexe`, `mdpasse`, `photo`, `statut`) VALUES ('3', 'Gaye', 'Bousso', 'Diarra24', 'Feminin', 'gaye', NULL, NULL);
-- INSERT INTO `membre` (`Idmembre`, `nom`, `prenom`, `login`, `sexe`, `mdpasse`, `photo`, `statut`) VALUES ('4', 'Mbacke', 'Lahad', 'Lahad23', 'Masculin', 'Mbacke', NULL, NULL);