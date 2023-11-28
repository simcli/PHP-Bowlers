drop database if exists restaurantdb;
create database restaurantdb;
use restaurantdb;

create table MenuItemCategory
(
    itemCategoryID varchar(3) not null,
    itemCategoryDescription varchar(20) not null,
    primary key (itemCategoryID)
);

create table MenuItem
(
    itemID int not null,
    itemCategoryID varchar(3) not null,
    description varchar(80) not null,
    price int not null,
    vegetarian boolean not null,
    primary key (itemID),
    foreign key (itemCategoryID) references MenuItemCategory(itemCategoryID) on delete cascade
);

-- MenuItemCategory
insert into MenuItemCategory values ('APP', 'Appetizer');
insert into MenuItemCategory values ('BEV', 'Beverage');
insert into MenuItemCategory values ('DES', 'Dessert');
insert into MenuItemCategory values ('ENT', 'Entree');

-- MenuItem
insert into MenuItem values(101,'APP','beet and orange salad',16,true);
insert into MenuItem values(102,'APP','oysters rockefeller',20,false);
insert into MenuItem values(103,'APP','pan seared foie gras',28,false);
insert into MenuItem values(104,'APP','porchini and asparagus risotto',15,true);
insert into MenuItem values(105,'APP','beef carpaccio',18,false);
insert into MenuItem values(106,'APP','diver digby scallops three ways',22,false);
insert into MenuItem values(107,'APP','ahi tuna',24,false);
insert into MenuItem values(108,'APP','calamari',15,false);
insert into MenuItem values(109,'APP','crab cake',13,false);
insert into MenuItem values(110,'APP','caprese salad with pine nuts',16,true);
insert into MenuItem values(111,'APP','braised rabbit canneloni',16,false);
insert into MenuItem values(112,'APP','half moon river clams',20,false);
insert into MenuItem values(113,'APP','black-eyed pea patty with tomato relish',15,false);
insert into MenuItem values(114,'APP','french onion soup',15,true);
insert into MenuItem values(201,'ENT','black cod',28,false);
insert into MenuItem values(202,'ENT','seared digby scallops on leek fettuccine',30,false);
insert into MenuItem values(203,'ENT','duck two ways',28,false);
insert into MenuItem values(204,'ENT','herb crusted rack of lamb',32,false);
insert into MenuItem values(205,'ENT','boneless quails stuffed with foie gras and truffles',32,false);
insert into MenuItem values(206,'ENT','fresh pasta with arugula and cherry tomatoes',22,true);
insert into MenuItem values(207,'ENT','lamb shank nehari',28,false);
insert into MenuItem values(208,'ENT','beef tenderloin',38,false);
insert into MenuItem values(209,'ENT','chicken valdostana',25,false);
insert into MenuItem values(210,'ENT','char grilled AAA tenderloin with grilled shrimp',42,false);
insert into MenuItem values(211,'ENT','ratatouille with garlic beans and saffron rice',27,true);
insert into MenuItem values(212,'ENT','boeuf bourguignon',34,false);
insert into MenuItem values(213,'ENT','sweet potato ravioli with apricot moustarda',30,true);
insert into MenuItem values(214,'ENT','baked sage grits and vegetable hash',28,true);
insert into MenuItem values(215,'ENT','parmesan dusted flounder with spiced quail',30,false);
insert into MenuItem values(301,'DES','lemon tart',12,true);
insert into MenuItem values(302,'DES','une meule',14,true);
insert into MenuItem values(303,'DES','baked alaska',16,true);
insert into MenuItem values(304,'DES','mignardises',9,true);
insert into MenuItem values(305,'DES','house made gelato',9,true);
insert into MenuItem values(306,'DES','creme brulee',13,true);
insert into MenuItem values(307,'DES','seasonal berries with cream',11,true);
insert into MenuItem values(308,'DES','rhubarb trifle with mascarpone',12,true);
insert into MenuItem values(309,'DES','doughnut and jam sampler',13,true);
insert into MenuItem values(310,'DES','chocolate mousse',12,true);
