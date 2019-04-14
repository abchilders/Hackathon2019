/* Last modified: 2019/04/14 
*/

-- base table for youth 
drop table youth cascade constraints; 

create table youth
(youth_id	integer,
 name		varchar2(50),
 primary key (youth_id)); 

-- base table for shelter_req 
drop table shelter_req cascade constraints; 

create table shelter_req
(intake_id			integer,
 reason_for_shelter	varchar2(100),
 si_intent			varchar2(3) 	check(si_intent in('yes', 'no')),
 fights				varchar2(3)		check(fights in ('yes_two', 'no_two')),
 fight_factors		varchar2(100), 
 has_social_worker	varchar2(10)	check(has_social_worker in ('yes_three', 'no_three')), 
 soc_worker_name	varchar2(50),
 guardian_contact	varchar2(50), 
 outcome			varchar2(50), 
 arrival_time		varchar2(10), 
 not_coming_reason	varchar2(100),
 primary key (intake_id)
); 

-- base table for report
drop table report cascade constraints; 

create table report
(report_id		integer, 
 date_created	varchar2(50),
 notes			varchar2(400), 
 date_resolved	date,
 primary key (report_id)
);

-- base table for referral
drop table referral cascade constraints; 
 
create table referral
(referral_id				integer, 
 referral_date				varchar2(50), 
 agency					varchar2(50), 
 referral_completion_date	date,
 primary key (referral_id)
); 

 -- base table for inquiry (instances of someone calling YSB. 
 -- think of it like a record for one phone call, one paper form)
drop table inquiry cascade constraints; 

/* currently, todays_date is varchar2 (due to lack of time), ideally we would have 
 input type="date" in the initial form and then todays_date would be of type date.
 
 also, an inquiry can only be associated with one of youth_id, report_id, 
 and intake_id */
create table inquiry
(call_id				integer,
 todays_date			varchar2(50),
 staff					varchar2(50),
 caller_name			varchar2(50), 
 caller_role			varchar2(50),
 caller_contact_info	varchar2(50), 
 reason					varchar2(50), 
 outcome				varchar2(50),
 youth_id				integer, 
 report_id				integer, 
 intake_id				integer,
 primary key (call_id),
 foreign key (youth) references youth,
 foreign key (report_id) references report,
 foreign key (intake_id) references shelter_req); 

-- intersection table for referral and inquiry 
drop table referrals_from_inquiry cascade constraints; 

create table referrals_from_inquiry
(call_id		integer,
 referral_id 	integer, 
 primary key (call_id, referral_id)
);
  