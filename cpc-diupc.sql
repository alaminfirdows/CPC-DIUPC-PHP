/*
*   Project:    CPC DIU PC
*   Version:    1.0.2
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `user_roles`;
INSERT INTO `user_roles` (`id`, `name`) VALUES (1, 'Admin'), (2, 'User');


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50),
  `email` varchar(255) NOT NULL,
  `role` int(11) unsigned NOT NULL DEFAULT '2',
  `profilePicture` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_users_role` (`role`),
  CONSTRAINT `FK_users_role` FOREIGN KEY (`role`) REFERENCES `user_roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `users`;
INSERT INTO `users` (`username`, `password`, `firstName`, `email`, `role`) VALUES ('abcd', '$2y$10$/9dAHPbF.YglD3QMNSrbseZWrTmJ4GULQ0mNRT35q4cKv0Jgv6p/u', 'Al-Amin', 'alaminfirdows@gmail.com', 1);
	
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(50),
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `subscribers`;
INSERT INTO `subscribers` (`name`, `email`) VALUES ('Subscriber', 'subscriber@gmail.com');


CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `categories`;
INSERT INTO `categories` (`url`, `name`, `status`) VALUES ('uncategorised', 'Uncategorised', 1);



CREATE TABLE IF NOT EXISTS `semesters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `semesters`;
INSERT INTO `semesters` (`name`, `status`) VALUES ('Spring 2019', 1);


CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date` varchar(25),
  `category` int(11) unsigned NOT NULL DEFAULT '1',
  `semester` int(11) unsigned NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL DEFAULT '0',
  `authorId` int(11) unsigned NOT NULL,
  `featuredImage` text DEFAULT NULL,
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_users` (`authorId`),
  KEY `FK_categories` (`category`),
  CONSTRAINT `FK_users` FOREIGN KEY (`authorId`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_categories` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_semesters` FOREIGN KEY (`semester`) REFERENCES `semesters` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `events`;
INSERT INTO `events` (`authorId`, `title`, `body`, `status`, `category`) VALUES (1, 'Test Post', 'This is test post!', 1, 1);


CREATE TABLE IF NOT EXISTS `semester_activities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `date` varchar(25),
  `time` varchar(25),
  `venue` varchar(255),
  `category` int(11) unsigned NOT NULL DEFAULT '1',
  `semester` int(11) unsigned NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL DEFAULT '0',
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_semester_activities_semesters` (`semester`),
  KEY `FK_semester_activities_categories` (`category`),
  CONSTRAINT `FK_semester_activities_categories` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_semester_activities_semesters` FOREIGN KEY (`semester`) REFERENCES `semesters` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `semester_activities`;
INSERT INTO `semester_activities`(`title`, `date`, `time`, `venue`, `category`, `semester`, `status`) VALUES ("Test", "20 Oct 2019", "11:20AM", "AB4 220",1,1,1);