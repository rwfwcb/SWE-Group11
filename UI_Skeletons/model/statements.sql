select * from Profile where id=?

select * from Person where id=?

select * from Education where id=?

select * from Experience where id=?

select * from Skills where id=?

select * from VolunteerWork where id=?

select * from Wallpost where id=?

select * from PersonConnection where id1=? or id2=?

select * from SchoolOrCompany where id=?

select * from SchoolOrCompany where pType="Company"

select * from SchoolOrCompany where pType="School"

select * from SchoolOrCompany where name like '%?%'

select * from Person where firstName like '%?%' or lastName like '%?%'

select * from Wallpost where id=?

select * from CareerPost where jobTitle like '%?%' or description like '%?%' or experience like '%?%' or location like '%?%' or industry like '%?%' or jobTitle like '%?%' or job_function like '%?%'

select * from CareerPost where id=?

insert into Profile (id, email, hashpass) values (?, ?, ?)

insert into Person (id, firstName, lastName, languages, summary) values (?, ?, ?, ?, ?)

insert into PersonConnection (id1, id2) values (? , ?)

insert into SchoolOrCompany (id, name, pType) values (?, ?, ?)

insert into Wallpost (id, postTime, body) values (?, now(), ?)

insert into CareerPost (id, jobID, created_when, jobTitle, location, emp_type, industry, description, experience, job_function) values (?, ?, now(), ?, ?, ?, ?, ?, ?, ?)

insert into Experience (id, companyName, title, location, startDate, endDate) values (?, ?, ?, ?, ?, ?)

insert into VolunteerWork (id, organization, role, vol_when, description) values (?, ?, ?, ?, ?)

insert into Skills (id, areaOfExpertice) values (?, ?)

insert into Causes (id, causeName) values (?, ?)

insert into Education (id, schoolName, degree, fieldOfStudy, gpa, startDate, gradDate, activitiesSocieties, description) values (?, ?, ?, ?, ?, ?, ?, ?, ?)

update Person set firstName=?, lastName=?, languages=?, summary=? where id=?

update SchoolOrPerson set name=? where id=?

update CareerPost set jobID=?, jobTitle=?, location=?, emp_type=?, industry=?, description=?, experience=?, job_function=? where id=? and jobID=?

update Experience set companyName=?, title=?, location=?, startDate=?, endDate=? where id=? and companyName=?

update VolunteerWork set organization=?, role=?, vol_when=?, description=? where id=? and organization=?

update Skills set areaOfExpertice=? where id=? and areaOfExpertice=?

update Causes set causeName=? where id=? and causeName=?

update Education set schoolName=?, degree=?, fieldOfStudy=?, gpa=?, startDate=?, gradDate=?, activitiesSocieties=?, description=? where id=? and schoolName=?

delete from Profile where id=?

delete from Wallpost where id=? and postTime=?

delete from CareerPost where id=? and jobID=?

delete from Experience where id=? and companyName=?

delete from VolunteerWork where id=? and organization=?

delete from Skills where id=? and areaOfExpertice=?

delete from Causes where id=? and causeName=?

delete from Education where id=? and schoolName=?
