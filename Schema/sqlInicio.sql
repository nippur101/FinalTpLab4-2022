

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
viedo varchar(40),
image varchar(100),
ownerId int,
constraint primary key (petsId))engine = InnoDB;

create table _Owner(
ownerId int not null auto_increment,
phone varchar(100),
petsId int,
userId int,
constraint primary key (ownerId),
FOREIGN KEY(petsId )
REFERENCES pethero.Pets(petsId))
engine = InnoDB;

alter table _Owner add column userId int,
add constraint FK_Owner_User foreign key (userId) references pethero._User(userId);


alter table Pets add constraint FKPets__Owner
foreign key Pets (ownerId)
references _Owner(ownerId);

create table Keeper(
keeperId int not null auto_increment,
phone varchar(100),
address varchar(100),
petsize varchar(100),
stayCost double,
freeTimePeriodId int,
reviewsId int,
userId int,
petsId int,
ftpId int,
constraint primary key (keeperId),
FOREIGN KEY(petsId )
REFERENCES pethero.Pets(petsId),
FOREIGN KEY(ftpId )
REFERENCES pethero.FreeTimePeriod(ftpId),
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
REFERENCES pethero.Keeper(keeperId))engine = InnoDB;

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
REFERENCES pethero.Keeper(keeperId))engine = InnoDB;





