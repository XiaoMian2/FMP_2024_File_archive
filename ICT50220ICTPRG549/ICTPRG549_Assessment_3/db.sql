drop database if exists `wyz_mp_park`;
create database `wyz_mp_park` charset=utf8;

use `wyz_mp_park`;

drop table if exists `wyz_student`;
create table `wyz_student`
(
  `wyz_id` char(8) NOT NULL primary key,
  `wyz_std_name` varchar(20) not null
);

drop table if exists `wyz_car`;
create table `wyz_car`
(
  `wyz_rego_number` varchar(20) NOT NULL primary key,
  `wyz_owner` char(8) NOT NULL,
  CONSTRAINT `fk1_car` FOREIGN KEY(`wyz_owner`) REFERENCES `wyz_student` (`wyz_id`)
);

insert into `wyz_student` values ("s7794540", "wyz_1");
insert into `wyz_student` values ("s6487709", "wyz_2");
insert into `wyz_student` values ("s8431155", "wyz_3");
