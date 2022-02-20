-- Создание базы данных --
CREATE DATABASE `TaskListApp`;

USE `TaskListApp`;

-- Создание таблицы пользователей --
CREATE TABLE `users` (
	`id` int(11) NOT NULL auto_increment,
	`login` varchar(20) NOT NULL DEFAULT '',
	`password` varchar(32) NOT NULL DEFAULT '',
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- /Создание таблицы пользователей --
CREATE TABLE IF NOT EXISTS `tasks` (
	`id` int(11) NOT NULL auto_increment,
	`user_id` int(11) NOT NULL,
	`description` varchar(256) NOT NULL,
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`status` varchar(256) DEFAULT 'Unready',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`user_id`) REFERENCES users(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

INSERT INTO
	users (`id`, `login`, `password`)
VALUES
	('1', 'wuwpan', 'zloy');