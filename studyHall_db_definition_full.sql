CREATE TABLE Registered_User(
primary key username varchar(30) not null,
password char(32) not null,
email varchar(50) not null,
first_name char(30) not null,
last_name char(30) not null,
admin bool not null,
blocked bool not null,
blocked_date date,
state char(2),
city char(30),
sign_up date
);

CREATE TABLE Subject(
primary key subject varchar(30) not null,
number_of_classes int not null
);

CREATE TABLE Classes(
primary key class_name varchar(30) not null,
foreign key subject not null
);

CREATE TABLE Document(
primary key doc_id int not null,
foreign key username varchar(30) not null,
foreign key class_name varchar(30) not null,
foreign key subject varchar(30) not null,
doc_name varchar(50) not null,
doc_type varchar(8) not null,
upvotes int not null,
downvotes int not null,
blocked bool
);

CREATE TABLE Forum_Topic(
primary key topic_id varchar(32) not null,
foreign key username varchar(30) not null,
topic_name varchar(32) not null,
topic_description varchar(250) not null,
blocked bool
);

CREATE TABLE Forum_Post(
primary key post_id int not null,
foreign key topic_id varchar(32) not null,
foreign key username varchar(30) not null,
blocked bool
);

CREATE TABLE Comment(
primary key comment_id int not null,
foreign key document_id int not null,
foreign key username varchar(30) not null,
blocked bool
);

