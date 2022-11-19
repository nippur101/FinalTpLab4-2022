

create database pethero;
use pethero;

create table _User(
userId int not null auto_increment,
firstName varchar(50),
lastName varchar(50),
email varchar(100),
_password varchar(50),
userType varchar(40),

constraint primary key (userId))
engine = InnoDB;




insert into _User values (default,"Julieta","Macedo","ju@m","1234",2);
insert into _User values (default,"Javier","Macedo","j@m","1234",2);



create table FreeTimePeriod(
ftpId int not null auto_increment,
startDate date,
finalDate date,
constraint primary key (ftpId))
engine = InnoDB;



create table Pets(
petsId int not null auto_increment,
vaccinationPlan varchar(100),
raze varchar(40),
petType varchar(100),
video varchar(40),
image varchar(100),
ownerId int,
constraint primary key (petsId))engine = InnoDB;

create table _Owner(
ownerId int not null auto_increment,
phone varchar(100),

userId int,
constraint primary key (ownerId))
engine = InnoDB;

alter table _Owner add constraint FK_Owner_User foreign key (userId) references pethero._User(userId);


alter table Pets add constraint FKPets__Owner
foreign key Pets (ownerId)
references _Owner(userId);

create table Keeper(
keeperId int not null auto_increment,
phone varchar(100),
address varchar(100),
petsize varchar(100),
stayCost double,
freeTimePeriodId int,
reviewsId int,
userId int,

constraint primary key (keeperId),


FOREIGN KEY(userId )
REFERENCES pethero._User(userId))
engine = InnoDB;


        
create table Reviews(
reviewsId int not null auto_increment,
_description varchar(400),
_date date,
userScore int,
petsId int,
keeperId int,

constraint primary key (reviewsId),
FOREIGN KEY(petsId )
REFERENCES pethero.Pets(petsId),
FOREIGN KEY(keeperId )
REFERENCES pethero.Keeper(userId))engine = InnoDB;

alter table Keeper add constraint FK_Keeper_Reviews foreign key (reviewsId) references pethero.Reviews(reviewsId);

        
create table Reserve(
reserveId int not null auto_increment,
startDate date,
finalDate date,
amountPaid double,
totalCost double,
petsId int,
keeperId int,

constraint primary key (reserveId),
FOREIGN KEY(petsId )
REFERENCES pethero.Pets(petsId),
FOREIGN KEY(keeperId )
REFERENCES pethero.Keeper(userId))engine = InnoDB;


insert into Pets values (default,"https:\/\/t2.ea.ltmcdn.com\/es\/posts\/1\/2\/2\/calendario_de_vacunas_para_perros_20221_orig.jpg","Dalmata","Mediano",
"https:\/\/images.hola.com\/imagenes\/estar-bien\/20200828174216\/razas-perro-dalmata-gt\/0-859-148\/dalmata-t.jpg","Firulais","https:\/\/www.youtube.com\/watch?v=bju7O_qv7l4");

insert into Pets values (default,"https:\/\/t2.ea.ltmcdn.com\/es\/posts\/1\/2\/2\/calendario_de_vacunas_para_perros_20221_orig.jpg","Caniche","Pequenio",
"https:\/\/images.hola.com\/imagenes\/estar-bien\/20200828174216\/razas-perro-dalmata-gt\/0-859-148\/dalmata-t.jpg","Tito","https:\/\/www.youtube.com\/watch?v=bju7O_qv7l4");

insert into Pets values (default,"https:\/\/t2.ea.ltmcdn.com\/es\/posts\/1\/2\/2\/calendario_de_vacunas_para_perros_20221_orig.jpg","Pastor Aleman","Grande",
"https:\/\/images.hola.com\/imagenes\/estar-bien\/20200828174216\/razas-perro-dalmata-gt\/0-859-148\/dalmata-t.jpg","Albondiga","https:\/\/www.youtube.com\/watch?v=bju7O_qv7l4");

/*
update _Owner
set petsId=1
where ownerId =2;
*/

alter table Pets add column ownerId int;

alter table Pets add constraint FK_Pets__Owner foreign key (ownerId) references pethero._Owner(ownerId);

ALTER TABLE `pethero`.`_Owner` 
DROP FOREIGN KEY `_Owner_ibfk_1`;

ALTER TABLE `pethero`.`_Owner` 
DROP COLUMN `petsId`,
DROP INDEX `petsId` ;


#AGREGAR OWNER A PET
#===========================================================================================================================================
ALTER TABLE Pets
DROP FOREIGN KEY  FK_Pets__Owner;

update Pets
set ownerId=1
where petsId =4; 

ALTER TABLE Pets ADD CONSTRAINT FK_Pets__Owner FOREIGN KEY Pets (ownerId) REFERENCES _Owner (userId);
#===========================================================================================================================================


#BUSCAR PET POR ID DE USER-OWNER
#======================================
select p.petsId from Pets as p
where p.ownerId=2;

#=====================================





#PROCEDURE
#===================================================
CREATE DEFINER=`root`@`%` PROCEDURE `eliminatePet`(in petId int)
BEGIN
	ALTER TABLE Pets
	DROP FOREIGN KEY  FK_Pets__Owner;
	delete from Pets
	where petsId =petId;
	ALTER TABLE Pets ADD CONSTRAINT FK_Pets__Owner FOREIGN KEY Pets (ownerId) REFERENCES _Owner (userId);
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`%` PROCEDURE `ownerPets`(in oId int)
BEGIN
SELECT * FROM Pets WHERE ownerId=oId;
END
#===========================================================================================================================================
CREATE DEFINER=`root`@`%` PROCEDURE `addOwner`(in uId int,in pho varchar(50))
BEGIN
INSERT INTO _Owner (phone,userId) VALUES (  pho, uId);
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`%` PROCEDURE `addPet`(in _nam varchar(50),in vaccination varchar(200),in raz varchar(100), in pType varchar(50),in pVideo varchar(200), in imag varchar(200),in oId int)
BEGIN
INSERT INTO Pets (vaccinationPlan, raze, petType, image,_name,video,ownerId) VALUES ( vaccination, raz,pType, imag, _nam,  pVideo, oId);
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`%` PROCEDURE `addUser`(in firstName varchar(50),in lastName varchar(50),in email varchar(100), in _password varchar(50),in userType int)
BEGIN
INSERT INTO _User ( firstName, lastName, email, _password, userType) VALUES ( firstName, lastName, email, _password, userType);
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`%` PROCEDURE `eliminateUserOwner`(in uId int)
BEGIN

	ALTER TABLE _Owner
	DROP FOREIGN KEY  FK_Owner__User;
	delete from _User
	where userId =uId;
    delete from _Owner
	where userId =uId;
    
	ALTER TABLE _Owner ADD CONSTRAINT FK_Owner__User FOREIGN KEY _Owner (userId) REFERENCES _User (userId);	
	
END
#===========================================================================================================================================

CREATE DEFINER=`root`@`%` PROCEDURE `retrieveUserId`(in mail varchar(100),in pass varchar(50))
BEGIN
select userId from _User
where email=mail and  _password=pass;
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`%` PROCEDURE `eliminateUserKeeper`(in uId int)
BEGIN

	ALTER TABLE Keeper
	DROP FOREIGN KEY  Keeper_ibfk_3;
	delete from _User
	where userId =uId;
    delete from Keeper
	where userId =uId;
    
	ALTER TABLE Keeper ADD CONSTRAINT Keeper_ibfk_3 FOREIGN KEY Keeper (userId) REFERENCES _User (userId);	
	
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`%` PROCEDURE `keeperFreeTimeperiod`(in oId int)
BEGIN
	SELECT * FROM FreeTimePeriod WHERE keeperId=oId;
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`%` PROCEDURE `addFreeTimePeriod`(in starD date,in finaD date,in keepId int)
BEGIN
	ALTER TABLE FreeTimePeriod
	DROP FOREIGN KEY  FK_FreeTimePeriod_Keeper;
    INSERT INTO FreeTimePeriod ( startDate, finalDate, keeperId) VALUES ( starD, finaD,keepId);
	ALTER TABLE FreeTimePeriod ADD CONSTRAINT FK_FreeTimePeriod_Keeper FOREIGN KEY FreeTimePeriod (keeperId) REFERENCES Keeper (KeeperId);
END
#===========================================================================================================================================

#===========================================================================================================================================
#LOCALHOST
#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminatePet`(in petId int)
BEGIN
	ALTER TABLE Pets
	DROP FOREIGN KEY  FK_Pets__Owner;
	delete from Pets
	where petsId =petId;
	ALTER TABLE Pets ADD CONSTRAINT FK_Pets__Owner FOREIGN KEY Pets (ownerId) REFERENCES _Owner (userId);
END
#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost` PROCEDURE `ownerPets`(in oId int)
BEGIN
SELECT * FROM Pets WHERE ownerId=oId;
END
#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost` PROCEDURE `addOwner`(in uId int,in pho varchar(50))
BEGIN
INSERT INTO _Owner (phone,userId) VALUES (  pho, uId);
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost`  PROCEDURE `addPet`(in _nam varchar(50),in vaccination varchar(200),in raz varchar(100), in pType varchar(50),in pVideo varchar(200), in imag varchar(200),in oId int)
BEGIN
INSERT INTO Pets (vaccinationPlan, raze, petType, image,_name,video,ownerId) VALUES ( vaccination, raz,pType, imag, _nam,  pVideo, oId);
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost`  PROCEDURE `addUser`(in firstName varchar(50),in lastName varchar(50),in email varchar(100), in _password varchar(50),in userType int)
BEGIN
INSERT INTO _User ( firstName, lastName, email, _password, userType) VALUES ( firstName, lastName, email, _password, userType);
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost`  PROCEDURE `eliminateUserOwner`(in uId int)
BEGIN

	ALTER TABLE _Owner
	DROP FOREIGN KEY  FK_Owner__User;
	delete from _User
	where userId =uId;
    delete from _Owner
	where userId =uId;
    
	ALTER TABLE _Owner ADD CONSTRAINT FK_Owner__User FOREIGN KEY _Owner (userId) REFERENCES _User (userId);	
	
END
#===========================================================================================================================================

CREATE DEFINER=`root`@`localhost`  PROCEDURE `retrieveUserId`(in mail varchar(100),in pass varchar(50))
BEGIN
select userId from _User
where email=mail and  _password=pass;
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost`  PROCEDURE `eliminateUserKeeper`(in uId int)
BEGIN

	ALTER TABLE Keeper
	DROP FOREIGN KEY  Keeper_ibfk_3;
	delete from _User
	where userId =uId;
    delete from Keeper
	where userId =uId;
    
	ALTER TABLE Keeper ADD CONSTRAINT Keeper_ibfk_3 FOREIGN KEY Keeper (userId) REFERENCES _User (userId);	
	
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost`  PROCEDURE `keeperFreeTimeperiod`(in oId int)
BEGIN
	SELECT * FROM FreeTimePeriod WHERE keeperId=oId;
END

#===========================================================================================================================================
CREATE DEFINER=`root`@`localhost`  PROCEDURE `addFreeTimePeriod`(in starD date,in finaD date,in keepId int)
BEGIN
	ALTER TABLE FreeTimePeriod
	DROP FOREIGN KEY  FK_FreeTimePeriod_Keeper;
    INSERT INTO FreeTimePeriod ( startDate, finalDate, keeperId) VALUES ( starD, finaD,keepId);
	ALTER TABLE FreeTimePeriod ADD CONSTRAINT FK_FreeTimePeriod_Keeper FOREIGN KEY FreeTimePeriod (keeperId) REFERENCES Keeper (KeeperId);
END
#===========================================================================================================================================