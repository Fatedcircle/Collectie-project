DROP DATABASE IF EXISTS `game_collection`;
CREATE DATABASE IF NOT EXISTS `game_collection`;
USE `game_collection`;
CREATE TABLE IF NOT EXISTS `games` (
    id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titel varchar(255),
    systeem ENUM('playstation', 'nintendo', 'xbox', 'pc') NOT NULL,
    categorie ENUM('platformer', 'shooter', 'rpg') NOT NULL,
    systeemeisen varchar(255),
    beschrijving text,
    boxart longblob,
    user_id INT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
);
CREATE TABLE IF NOT EXISTS `USERS` (
    id int AUTO_INCREMENT PRIMARY KEY,
    username varchar(100),
    password varchar(100)
);