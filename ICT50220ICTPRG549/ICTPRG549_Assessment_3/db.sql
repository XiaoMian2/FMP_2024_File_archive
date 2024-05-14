drop database if exists `wyz_mp_park`;
create database `wyz_mp_park` charset=utf8;

use `wyz_mp_park`;

drop table if exists `wyz_student`;
create table `wyz_student`
(
  `wyz_stud_id` char(8) NOT NULL primary key,
  `wyz_name` varchar(20) not null
);

drop table if exists `wyz_car`;
create table `wyz_car`
(
  `wyz_rego_number` varchar(20) NOT NULL primary key,
  `wyz_owner` char(8) NOT NULL,
  CONSTRAINT `fk1_car` FOREIGN KEY(`wyz_owner`) REFERENCES `wyz_student` (`wyz_stud_id`)
);

insert into `wyz_student` values ("s8717386", "wyz_1");
insert into `wyz_student` values ("s9466656", "wyz_2");
insert into `wyz_student` values ("s4536889", "wyz_3");
insert into `wyz_student` values ("s2970066", "wyz_4");
insert into `wyz_student` values ("s5685118", "wyz_5");
insert into `wyz_student` values ("s3138609", "wyz_6");
insert into `wyz_student` values ("s2778489", "wyz_7");
