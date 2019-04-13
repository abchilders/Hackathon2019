/*
Sthephany Ponce
Rawan Almaklhoog
Daysi Hilario
Alex Childers
*/

drop table inquiry cascade constraints;
drop table reasons_for_contact  cascade constraints;

create table inquiry
 (call_id integer not null ,
  staff varchar2(25) not null,  
  primary key (call_id));

create table reasons_for_contact
(call_id integer,
 reason varchar2(25),
 foreign key (call_id) references inquiry);

insert into inquiry
values
(001, 'Alex');

insert into inquiry
values
(002, 'Sthephany');


insert into reasons_for_contact
values
(001, 'General info');

insert into reasons_for_contact
values
(001, 'Report abuse');




