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

insert into `wangyizhuo_products` values(null, '书籍1', 10.8, 'images/book_1.jpeg'),
						(null, '书籍2', 21, 'images/book_2.jpeg'),
						(null, '书籍3', 36, 'images/book_3.jpeg'),
						(null, '书籍4', 48, 'images/book_4.jpeg'),
						(null, '书籍5', 16.8, 'images/book_5.jpeg'),
						(null, '书籍6', 17.9, 'images/book_6.jpeg'),
						(null, '书籍7', 39.8, 'images/book_7.jpeg'),
						(null, '书籍8', 19.8, 'images/book_8.jpeg'),
						(null, '书籍9', 29.8, 'images/book_9.jpeg'),
						(null, '书籍10', 59.8, 'images/book_10.jpeg'),
						(null, '书籍11', 9.8, 'images/book_11.jpeg'),
						(null, '书籍12', 23.6, 'images/book_12.jpeg');

