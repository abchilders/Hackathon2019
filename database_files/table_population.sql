/* Last modified: 2019/04/14
	Populates tables for RCAA YSB database.
*/

delete from referrals_from_inquiry;
delete from inquiry; 
delete from referral;
delete from report; 
delete from shelter_req; 
delete from youth; 

-- sequence to generate youth IDs
drop sequence youth_id_seq;
create sequence youth_id_seq
start with 100000;

-- sequence to generate intake IDs
drop sequence intake_id_seq;
create sequence intake_id_seq
start with 200000;

-- sequence to generate report IDs
drop sequence report_id;
create sequence report_id_seq
start with 300000;

-- sequence to generate referral IDs
drop sequence referral_id_seq;
create sequence referral_id_seq
start with 400000;

-- sequence to generate call IDs
drop sequence call_id_seq;
create sequence call_id_seq
start with 500000;

--insert sample rows into youth 
insert into youth
values
(youth_id_seq.nextval, 'Sthephany Ponce'); 

insert into youth
values
(youth_id_seq.nextval, 'Daysi Hilario'); 

insert into youth
values
(youth_id_seq.nextval, 'Alex Childers'); 

insert into youth
values
(youth_id_seq.nextval, 'Rawan Almakhloog'); 

insert into youth
values
(youth_id_seq.nextval, 'Shmalex Shmilders'); 

-- insert rows into shelter_req

insert into shelter_req (intake_id, reason_for_shelter, si_intent, fights, 
	has_social_worker, guardian_contact, outcome, arrival_time)
values
(intake_id_seq.nextval, 'parents kicked them out', 'no', 'no_two', 
	'no_three', 'may contact', 'will_stay', '22:30'); 
	
--insert rows into inquiry
insert into inquiry (call_id, todays_date, staff, caller_name, caller_role, 
	caller_contact_info, reason, outcome, youth_id, intake_id)
values
(call_id_seq.nextval, to_char(sysdate), 'Mina Nisch', 'Joe Shmoe', 'friend', 
	'011-899-9881', 'shelter', '