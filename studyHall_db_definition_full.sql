CREATE TABLE Registered_User(
username varchar(30) primary key,
password char(32) not null,
email varchar(50) not null,
first_name char(30) not null,
last_name char(30) not null,
admin bool not null,
blocked_date timestamp,
state char(2),
city char(30),
sign_up timestamp
);

CREATE TABLE Subject(
subject varchar(30) primary key
);

CREATE TABLE Classes(
class_name varchar(30) primary key,
subject varchar(30) not null,
foreign key (subject) references Subject(subject)
);

CREATE TABLE Document(
doc_id int primary key AUTO_INCREMENT,
username varchar(30) not null,
class_name varchar(30) not null,
subject varchar(30) not null,
doc_name varchar(50) not null,
doc_type varchar(8) not null,
path_to_doc varchar(50) not null,
upvotes int not null,
downvotes int not null,
blocked bool,
foreign key (username) references Registered_User(username) on delete cascade,
foreign key (class_name) references Classes(class_name) on delete cascade,
foreign key (subject) references Subject(subject) on delete cascade
);


CREATE TABLE Forum_Topic(
topic_id varchar(32) not null primary key,
username varchar(30) not null,
topic_name varchar(32) not null,
topic_description varchar(250) not null,
blocked bool,
foreign key (username) references Registered_User(username) on delete cascade
);


CREATE TABLE Forum_Post(
post_id int not null primary key,
topic_id varchar(32) not null,
username varchar(30) not null,
post_content varchar(750) not null,
blocked bool,
foreign key (username) references Registered_User(username) on delete cascade,
foreign key (topic_id) references Forum_Topic(topic_id) on delete cascade
);

CREATE TABLE Comment(
comment_id int not null primary key,
document_id int not null,
username varchar(30) not null,
comment_body varchar(500) not null,
blocked bool,
foreign key (username) references Registered_User(username) on delete cascade,
foreign key (document_id) references Document(doc_id) on delete cascade
);

