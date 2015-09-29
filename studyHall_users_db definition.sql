use studyhall_users;

create table registered_users(
password char(32) not null,
 email varchar(50) not null,
first_name varchar(50) not null, 
last_name varchar(50) not null,
state varchar(20), 
city varchar(50), 
role varchar(30) not null,
sign_up date, 
user_name varchar(30) not null primary key
);

create table admins(
	user_name varchar(30) not null primary key,
    admin_id varchar(8),
    admin_since date,
    foreign key(user_name) references registered_users(user_name) on delete cascade
);

create table blocked_users(
user_name varchar(30) not null primary key,
blocked_since date not null,
foreign key(user_name) references registered_users(user_name) on delete cascade
);