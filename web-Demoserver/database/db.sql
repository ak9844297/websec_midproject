SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE TABLE `mydatabase`.`admin` ( 
`name` VARCHAR(64) NOT NULL ,
`pass` VARCHAR(64) NOT NULL 
)ENGINE = InnoDB  CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE TABLE `mydatabase`.`messages` (
   `id` int(11) NOT NULL auto_increment,
   `username` VARCHAR(64) NOT NULL, 
   `text` VARCHAR(5000) NOT NULL, 
   `time` DATE NOT NULL,
   PRIMARY KEY (id)
 ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci ;


