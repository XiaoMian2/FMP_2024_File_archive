drop database if exists `WangYiZhuo`;
create database `WangYiZhuo` charset=utf8;

use `WangYiZhuo`;

drop table if exists `WangYiZhuo_accounts`;
create table `WangYiZhuo_accounts`
(
  `userId` int(10) unsigned primary key auto_increment,
  `user_email` varchar(28) not null,
  `password` varchar(21) not null,
  `is_admin` varchar(8) not null
);

drop table if exists `WangYiZhuo_products`;
create table `WangYiZhuo_products`
(
  `id` int(10) unsigned primary key auto_increment,
  `bookTitle` varchar(51) not null,
  `price` double not null,
  `book_image` varchar(72) not null
);

drop table if exists `WangYiZhuo_tracking`;
create table `WangYiZhuo_tracking`
(
  `trackingId` int unsigned primary key auto_increment,
  `data` varchar(50) not null
);


insert into `WangYiZhuo_accounts` values(null, 'WangYiZhuo@qq.com', 'pass', 'no'),
                        (null, 'library@mp.com', 'admin123', 'yes');

insert into `WangYiZhuo_products` values(null, '书籍1', 10.8, 'images/book_1.jpeg'),
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

