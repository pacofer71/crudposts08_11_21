drop table posts;
drop table users;

create table users(
	id int auto_increment primary key,
	username varchar(40) unique not null,
	email varchar(80) unique not null,
	password varchar(120) not null,
	img varchar(100)
);

create table posts(
	id int auto_increment primary key,
	titulo varchar(60) not null,
	body text not null,
	post_id int,
	constraint fk_post_user foreign key(post_id) references users(id) 
	on delete cascade on update cascade
);