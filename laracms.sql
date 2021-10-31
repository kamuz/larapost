-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `laracms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `laracms`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_01_25_225715_create_posts_table',	1),
(4,	'2019_01_29_232020_add_user_id_to_posts',	2),
(5,	'2019_02_01_093831_add_image_to_posts',	3);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `created_at`, `updated_at`, `title`, `body`, `user_id`, `image`) VALUES
(1,	'2019-01-25 21:05:26',	'2021-10-31 19:58:43',	'First Post',	'This is the post body',	1,	'Desert_1635717523.jpg'),
(2,	'2019-01-25 21:05:48',	'2021-10-31 19:59:17',	'Second Post',	'Another body for second post',	1,	'Tulips_1635717557.jpg'),
(3,	'2019-01-29 16:38:17',	'2021-10-31 19:59:08',	'Third Post',	'Hello, world!',	1,	'Hydrangeas_1635717548.jpg'),
(4,	'2019-01-29 17:25:21',	'2021-10-31 19:51:55',	'Four Post',	'Here is the awesome content',	1,	'Chrysanthemum_1635717115.png'),
(6,	'2019-01-29 21:33:08',	'2021-10-31 19:59:55',	'Fifth Post',	'Cool....',	2,	'Penguins_1635717595.jpg');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Vladimir Kamuz',	'v.kamuz@gmail.com',	NULL,	'$2y$10$IJUEejCBqd5Gi3lyCfW38enuyiNzlujvqAcMNlMOWLsgULNpu4uvW',	'05FqEwaOLbDNYhKDJ9rnVmopytlJA93gz40INBo3fyUerZFSHP8KJy01caBj',	'2019-01-29 20:40:22',	'2019-01-29 20:40:22'),
(2,	'Alex Kamuz',	'a.kamuz@gmail.com',	NULL,	'$2y$10$FWdS4J0yKK2GiixAnIXvDuM1yGNS1F2RzQqlt6yUGIsEeh7jkbfXy',	'ctzwHzJMZi6G130H6heJZM4Q4dM2ZPlXF7SIjoSpSreDrtJQolMESJNJ60bD',	'2019-01-29 20:58:14',	'2019-01-29 21:03:51');

-- 2021-10-31 22:12:29
