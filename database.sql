drop database if exists board;
create database board character set utf8 collate utf8_general_ci;
grant all on board.* to 'admin'@'localhost' identified by 'password';
use board;

create table tweets (
    id int auto_increment primary key,
    tweets text,
    uploader text,
    uploader-id text,
    avatar text
);

create table following (
    from text,
    to text
);