DROP TABLE IF EXISTS Profile;
DROP TABLE IF EXISTS Person;
DROP TABLE IF EXISTS PersonConnection;
DROP TABLE IF EXISTS PType;
DROP TABLE IF EXISTS SchoolOrCompany;
DROP TABLE IF EXISTS Wallpost;
DROP TABLE IF EXISTS CareerPost;
DROP TABLE IF EXISTS Experience;
DROP TABLE IF EXISTS VolunteerWork;
DROP TABLE IF EXISTS Skills;
DROP TABLE IF EXISTS Causes;
DROP TABLE IF EXISTS Education;

create table Profile(
	id int not null auto_increment,
	email varchar(60),
	hashpass varchar(60),
	primary key (id)
);

create table Person(
	id int not null auto_increment,
	firstName varchar(30),
	lastName varchar(30),
	languages varchar(255),
	summary varchar(255),
	foreign key (id) references Profile(id) on delete cascade,
	primary key (id)
);

create table PersonConnection(
	id1 int,
	id2 int,
	since datetime,
	foreign key (id1) references Profile(id) on delete cascade,
	foreign key (id2) references Profile(id) on delete cascade,
	primary key (id1, id2)
);

create table PType(
	pType varchar(7) primary key
);

create table SchoolOrCompany(
	id int not null auto_increment,
	name varchar(60) not null,
	pType varchar(9) not null,
	foreign key (id) references Profile(id) on delete cascade,
	foreign key (pType) references PType(pType) on delete cascade,
	primary key (id)
);

create table Wallpost(
	id int not null auto_increment,
	created_when datetime not null,
	body varchar(255) not null,
	foreign key (id) references Profile(id) on delete cascade,
	primary key (id, created_when)
);

create table CareerPost(
	id int not null auto_increment,
	jobID int,
	created_when datetime,
	jobTitle varchar(30),
	location varchar(60),
	emp_type varchar(30),
	industry varchar(30),
	description varchar(5000),
	experience varchar(2000),
	job_function varchar(60),
	foreign key (id) references Profile(id) on delete cascade,
	primary key (id, jobID)
);

create table Experience(
	id int not null auto_increment,
	companyName varchar(30),
	title varchar(30),
	location varchar(60),
	startDate date,
	endDate date,
	foreign key (id) references Profile(id) on delete cascade,
	primary key (id, companyName)
);

create table VolunteerWork(
	id int not null auto_increment,
	organization varchar(30),
	role varchar(30),
	vol_when date,
	description varchar(255),
	foreign key (id) references Profile(id) on delete cascade,
	primary key (id, organization)
);

create table Skills(
	id int not null auto_increment,
	areaOfExpertise varchar(30),
	foreign key (id) references Profile(id) on delete cascade,
	primary key (id, areaOfExpertise)
);

create table Causes(
	id int not null auto_increment,
	causeName varchar(30),
	foreign key (id) references Profile(id) on delete cascade,
	primary key (id, causeName)
);

create table Education(
	id int not null auto_increment,
	schoolName varchar(30),
	degree varchar(30),
	fieldOfStudy varchar(30),
	gpa decimal,
	stateDate date,
	gradDate date,
	activitiesSocieties varchar(255),
	description varchar(255),
	foreign key (id) references Profile(id) on delete cascade,
	primary key (id, schoolName)
);
