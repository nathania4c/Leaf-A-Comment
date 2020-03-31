drop table if exists comments ;
drop table if exists posts ;
drop table if exists users ;

create table users (
uid int auto_increment,
firstname varchar(100),
lastname varchar(100),
username varchar(100),
password varchar(16),
email varchar(100),
primary key (uid)
);

create table posts (
uid int, 
postDate timestamp not null default current_timestamp,
numComment int,
title varchar(32),
body text,
img varchar(32),
pid int auto_increment,
primary key (pid),
foreign key (uid) references users(uid) on delete cascade
);


create table comments(
body varchar(255),
parent int default 0,
pid int,
uid int,
commentDate timestamp not null default current_timestamp,
depth int default 0,
cid int auto_increment,
primary key (cid),
foreign key (pid) references posts(pid) on delete cascade,
foreign key (uid) references users(uid) on delete cascade
);

create table admins(
	uid int
);

insert into users(firstname, lastname, username, password, email) values ('Ryan', 'Test', 'admin1', '12345', 'ryan@email.com');
insert into users(firstname, lastname, username, password, email) values ('Alpaca', 'Paca', 'RJ', '041220', 'rj@hotmail.com');
insert into users(firstname, lastname, username, password, email) values ('Nat', 'ttt', 'admin0', '000', 'nat@nat.com');

insert into posts(numComment, title, body, uid, img) values (0, 'My first post', 'This is my very first post',1,"leaf2.jpg");