/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 5.7.42-0ubuntu0.18.04.1 : Database - laravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `casts` */

DROP TABLE IF EXISTS `casts`;

CREATE TABLE `casts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `casts_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `casts` */

insert  into `casts`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Chris Pratt','2023-05-22 14:04:57','2023-05-22 14:04:57'),
(2,'Zoe Saldana','2023-05-22 14:04:57','2023-05-22 14:04:57'),
(3,'Dave Bautista','2023-05-22 14:04:57','2023-05-22 14:04:57');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_05_17_155113_create_user_types_table',1),
(6,'2023_05_17_155404_create_user_types_users_table',1),
(7,'2023_05_17_161804_create_subscription_types_table',1),
(8,'2023_05_17_162058_create_user_subscriptions_table',1),
(9,'2023_05_17_163114_create_tags_table',1),
(10,'2023_05_17_163218_create_casts_table',1),
(11,'2023_05_17_163338_create_movies_table',1),
(12,'2023_05_17_163421_create_movie_tags_table',1),
(13,'2023_05_17_163441_create_movie_casts_table',1),
(14,'2023_05_22_043109_create_movie_rents_table',1);

/*Table structure for table `movie_casts` */

DROP TABLE IF EXISTS `movie_casts`;

CREATE TABLE `movie_casts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` bigint(20) unsigned NOT NULL,
  `cast_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `movie_casts` */

insert  into `movie_casts`(`id`,`movie_id`,`cast_id`,`created_at`,`updated_at`) values 
(1,2,1,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(2,2,3,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(3,2,2,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(4,3,1,'2023-05-22 14:05:30','2023-05-22 14:05:30'),
(5,3,3,'2023-05-22 14:05:30','2023-05-22 14:05:30'),
(6,3,2,'2023-05-22 14:05:30','2023-05-22 14:05:30');

/*Table structure for table `movie_rents` */

DROP TABLE IF EXISTS `movie_rents`;

CREATE TABLE `movie_rents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `license_start` date NOT NULL,
  `license_end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `movie_rents` */

insert  into `movie_rents`(`id`,`user_id`,`movie_id`,`license_start`,`license_end`,`created_at`,`updated_at`) values 
(1,14,3,'2023-05-22','2023-06-01','2023-05-22 14:06:22','2023-05-22 14:06:22');

/*Table structure for table `movie_tags` */

DROP TABLE IF EXISTS `movie_tags`;

CREATE TABLE `movie_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` bigint(20) unsigned NOT NULL,
  `tag_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `movie_tags` */

insert  into `movie_tags`(`id`,`movie_id`,`tag_id`,`created_at`,`updated_at`) values 
(1,2,1,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(2,2,2,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(3,2,3,'2023-05-22 14:04:57','2023-05-22 14:04:57'),
(4,3,1,'2023-05-22 14:05:30','2023-05-22 14:05:30'),
(5,3,2,'2023-05-22 14:05:30','2023-05-22 14:05:30'),
(6,3,3,'2023-05-22 14:05:30','2023-05-22 14:05:30');

/*Table structure for table `movies` */

DROP TABLE IF EXISTS `movies`;

CREATE TABLE `movies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subsciption_type_id` bigint(20) unsigned NOT NULL,
  `rent_period` int(11) NOT NULL,
  `rent_price` double NOT NULL,
  `license_start` timestamp NULL DEFAULT NULL,
  `license_end` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `movies` */

insert  into `movies`(`id`,`title`,`release_year`,`poster_link`,`subsciption_type_id`,`rent_period`,`rent_price`,`license_start`,`license_end`,`created_at`,`updated_at`) values 
(1,'Test','Test','Test',2,30,10,NULL,NULL,NULL,NULL),
(2,'Guardians of the Galaxy Vol. 2','2017','https://m.media-amazon.com/images/M/MV5BNjM0NTc0NzItM2FlYS00YzEwLWE0YmUtNTA2ZWIzODc2OTgxXkEyXkFqcGdeQXVyNTgwNzIyNzg@._V1_SX300.jpg',1,10,10,'2023-05-01 00:00:00','2023-05-31 00:00:00','2023-05-22 14:04:57','2023-05-22 14:05:36'),
(3,'Guardians of the Galaxy Vol. 2','2017','https://m.media-amazon.com/images/M/MV5BNjM0NTc0NzItM2FlYS00YzEwLWE0YmUtNTA2ZWIzODc2OTgxXkEyXkFqcGdeQXVyNTgwNzIyNzg@._V1_SX300.jpg',2,10,10,'2023-05-08 00:00:00','2023-05-31 00:00:00','2023-05-22 14:05:30','2023-05-22 14:05:30');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `subscription_types` */

DROP TABLE IF EXISTS `subscription_types`;

CREATE TABLE `subscription_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `subscription_types` */

insert  into `subscription_types`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'basic',NULL,NULL),
(2,'premium',NULL,NULL);

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tags` */

insert  into `tags`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Action','2023-05-22 14:04:57','2023-05-22 14:04:57'),
(2,'Adventure','2023-05-22 14:04:57','2023-05-22 14:04:57'),
(3,'Comedy','2023-05-22 14:04:57','2023-05-22 14:04:57');

/*Table structure for table `user_subscriptions` */

DROP TABLE IF EXISTS `user_subscriptions`;

CREATE TABLE `user_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subsciption_type_id` bigint(20) unsigned NOT NULL,
  `user_types_user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_subscriptions` */

insert  into `user_subscriptions`(`id`,`subsciption_type_id`,`user_types_user_id`,`created_at`,`updated_at`) values 
(1,1,2,NULL,NULL),
(2,2,3,NULL,NULL);

/*Table structure for table `user_types` */

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_types` */

insert  into `user_types`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'admin',NULL,NULL),
(2,'subscriber',NULL,NULL);

/*Table structure for table `user_types_users` */

DROP TABLE IF EXISTS `user_types_users`;

CREATE TABLE `user_types_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `user_type_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_types_users` */

insert  into `user_types_users`(`id`,`user_id`,`user_type_id`,`created_at`,`updated_at`) values 
(1,13,1,NULL,NULL),
(2,14,2,NULL,NULL),
(3,15,2,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(13,'admin','admin@gmail.com',NULL,'$2y$10$qmF7xKXXHisKpDHBTqN2AueaywMuDddUd4rLIYknbg6tqPe1jlQc.',NULL,'2023-05-22 14:00:26','2023-05-22 14:00:26'),
(14,'basic','basic@gmail.com',NULL,'$2y$10$oV6gy.EZywpQ5bVOc74ySu0vf8S.HL3YGzA6Xyh.dUK7Sxr9j.FKW',NULL,'2023-05-22 14:01:38','2023-05-22 14:01:38'),
(15,'premium','premium@gmail.com',NULL,'$2y$10$Y8ycO3OOe3Xn0QH3Rkavlubu2JwaJ0x7ZXTUD3H0uJdC.fSN7Ao6C',NULL,'2023-05-22 14:02:27','2023-05-22 14:02:27');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
