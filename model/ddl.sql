create table Profile(
	id int not null auto_increment,
	email varchar(60),
	hashpass varchar(60),
	primary key (id)
);

create table Person(
	id int,
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
	foreign key id1 references Profile(id) on delete cascade,
	foreign key id2 references Profile(id) on delete cascade,
	primary key (id1, id2)
)

create table Type(
	type varchar(9) primary key
);

create table SchoolOrCompany(
	id int,
	name varchar(60) not null,
	type varchar(9) not null,
	foreign key id references Profile(id) on delete cascade,
	foreign key type references Type(type) on delete cascade,
	primary key id
);

create table Wallpost(
	id int,
	when datetime not null,
	body varchar(255) not null,
	foreign key id references Profile(id) on delete cascade,
	primary key (id, when)
);

create table CareerPost(
	id int,
	jobID int,
	created_when datetime,
	jobTitle varchar(30),
	location varchar(60),
	emp_type varchar(30),
	industry varchar(30),
	description varchar(5000),
	experience varchar(2000),
	job_function(60),
	foreign key id references Profile(id) on delete cascade,
	primary key (id, jobID)
);

create table Experience(
	id int,
	companyName varchar(30),
	title varchar(30),
	location varchar(60),
	startDate date,
	endDate date,
	foreign key id references Profile(id) on delete cascade,
	primary key (id, companyName)
);

create table VolunteerWork(
	id int,
	organization varchar(30),
	role varchar(30),
	when date,
	description varchar(255)
	foreign key id references Profile(id) on delete cascade,
	primary key (id, organization)
)

create table Skills(
	id int,
	areaOfExpertise varchar(30),
	foreign key id references Profile(id) on delete cascade,
	primary key (id, areaOfExpertise)
);

create table Causes(
	id int,
	causeName varchar(30),
	foreign key id references Profile(id) on delete cascade,
	primary key (id, causeName)
);

create table Education(
	id int,
	schoolName varchar(30),
	degree varchar(30),
	fieldOfStudy varchar(30),
	gpa decimal,
	stateDate date,
	gradDate date,
	activitiesSocieties varchar(255),
	description varchar(255),
	foreign key id references Profile(id) on delete cascade,
	primary key (id, schoolName)
);
