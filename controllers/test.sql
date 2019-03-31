drop database if exists wt_admin
create database  wt_admin default charset set utf8
CREATE DATABASE IF NOT EXISTS wt_admin default charset utf8 COLLATE utf8_general_ci;
use wt_admin;

create table wt_user(
     id int(11) auto_increment,
     login_name varchar(50) comment "登陆名",
     real_name varchar(50) comment "真实姓名",
     password varchar(20) comment "用户密码",
     phone varchar(20) comment "手机号码",
     email varchar(50) comment "电子邮箱",
     create_time int(11) default 0 comment "创建时间",
     update_time int(11) default 0 comment "更新时间",
     primary key (id),
     unique (login_name),
     index (phone)
) engine=innodb auto_increment=10000 charset=utf8;

INSERT INTO wt_user (login_name,real_name,password,phone,email,
create_time,update_time) VALUES('w604111589','wangtao','123456',
'18062789252','604111589@qq.com','1507617867','1507617867');

INSERT INTO wt_user (login_name,real_name,password,phone,email,
create_time,update_time) VALUES('admin','admin','123456',
'12345678901','123456789@qq.com','1507617867','1507617867') 



create table wt_menu(
     id int(11) auto_increment,
     menu_name varchar(50) comment "登陆名",
     menu_path varchar(200) comment "真实姓名",
     menu_desc varchar(200) default null comment "真实姓名",
     menu_level tinyint(1) default 0 comment "菜单级别",
     menu_fid int(11) default 0 comment "菜单的父ID",
     create_time int(11) default 0 comment "创建时间",
     update_time int(11) default 0 comment "更新时间",
     primary key (id),
     unique (menu_name),
     index (menu_path)
) engine=innodb charset=utf8;