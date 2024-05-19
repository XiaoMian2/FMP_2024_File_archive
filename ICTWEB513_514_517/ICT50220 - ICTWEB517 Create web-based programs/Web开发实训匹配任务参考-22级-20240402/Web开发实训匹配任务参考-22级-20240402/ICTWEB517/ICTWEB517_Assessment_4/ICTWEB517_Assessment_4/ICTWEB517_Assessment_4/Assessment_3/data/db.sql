drop database if exists `wangyizhuo`;
create database `wangyizhuo` charset=utf8;

use `wangyizhuo`;

drop table if exists `wangyizhuo_accounts`;
create table `wangyizhuo_accounts`
(
  `userId` int(10) unsigned primary key auto_increment,
  `user_email` varchar(24) not null,
  `userPassword` varchar(25) not null,
  `is_admin` varchar(8) not null
);

drop table if exists `wangyizhuo_products`;
create table `wangyizhuo_products`
(
  `id` int unsigned primary key auto_increment,
  `book_title` varchar(51) not null,
  `bookPrice` double not null,
  `image` varchar(65) not null
);

drop table if exists `wangyizhuo_tracking`;
create table `wangyizhuo_tracking`
(
  `trackingId` int(10) unsigned primary key auto_increment,
  `tracking_data` varchar(85) not null
);


insert into `wangyizhuo_accounts` values(null, 'wangyizhuo@qq.com', 'pass', 'no'),
                        (null, 'library@mp.com', 'admin123', 'yes');

insert into `wangyizhuo_products` values(null, 'A Tale of Two Cities', 34.56, 'images/book_1.jpeg'),
						(null, 'The Little Prince', 78.21, 'images/book_2.jpeg'),
						(null, 'The Alchemist', 45.89, 'images/book_3.jpeg'),
						(null, 'Harry Potter and the Philosophers Stone', 12.34, 'images/book_4.jpeg'),
						(null, 'And Then There Were None', 56.78, 'images/book_5.jpeg'),
						(null, 'Dream of the Red Chamber', 23.45, 'images/book_6.jpeg'),
						(null, 'The Hobbit', 67.89, 'images/book_7.jpeg'),
						(null, 'She: A History of Adventure', 89.12, 'images/book_8.jpeg'),
						(null, 'The Da Vinci Code ', 43.21, 'images/book_9.jpeg'),
						(null, 'Harry Potter and the Chamber of Secrets', 98.76, 'images/book_10.jpeg'),
						(null, 'Harry Potter and the Prisoner of Azkaban', 54.32, 'images/book_11.jpeg'),
						(null, 'Harry Potter and the Goblet of Fire', 21.98, 'images/book_12.jpeg');

