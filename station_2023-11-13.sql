# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: station
# Generation Time: 2023-11-13 05:40:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table fuel_stations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fuel_stations`;

CREATE TABLE `fuel_stations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `scenario` varchar(255) NOT NULL,
  `ulp93_tank` int(11) NOT NULL,
  `ulp95_tank` int(11) NOT NULL,
  `diesel_tank` int(11) NOT NULL,
  `ulp93_demand` int(11) NOT NULL,
  `ulp95_demand` int(11) NOT NULL,
  `diesel_demand` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
	(5,'2023_11_08_172044_create_fuel_station_table',2),
	(6,'2023_11_08_172225_create_truck_trailer_table',2),
	(7,'2023_11_08_172322_create_orders_table',2),
	(8,'2023_11_08_182706_create_stations_table',3),
	(9,'2023_11_08_184847_add_stock_to_stations_table',4),
	(10,'2023_11_08_191508_add_user_id_to_orders',5),
	(11,'2023_11_08_203706_add_station_id_to_users_table',6),
	(12,'2023_11_10_130605_add_projected_cost_to_orders_table',7);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `desired_delivery_date` date NOT NULL,
  `amount_ulp93` int(11) NOT NULL,
  `amount_ulp95` int(11) NOT NULL,
  `amount_diesel` int(11) NOT NULL,
  `projected_cost` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`id`, `desired_delivery_date`, `amount_ulp93`, `amount_ulp95`, `amount_diesel`, `projected_cost`, `created_at`, `updated_at`, `user_id`)
VALUES
	(2,'2023-11-11',34,4,5,NULL,'2023-11-08 19:44:27','2023-11-08 19:44:27',NULL),
	(3,'2023-11-11',32,22,11,NULL,'2023-11-08 19:51:32','2023-11-08 19:51:32',NULL),
	(4,'2023-11-11',12,44,45,NULL,'2023-11-08 19:52:45','2023-11-08 19:52:45',1),
	(5,'2023-11-11',234,3,3,NULL,'2023-11-08 19:55:56','2023-11-08 19:55:56',1),
	(6,'2023-11-11',1,2,3,NULL,'2023-11-08 20:44:06','2023-11-08 20:44:06',1),
	(7,'2023-11-18',3,67,4,NULL,'2023-11-08 20:44:41','2023-11-08 20:44:41',1),
	(8,'2023-11-18',23,3234,23,NULL,'2023-11-08 21:02:30','2023-11-08 21:02:30',1),
	(9,'2023-11-16',8,8,8,NULL,'2023-11-09 05:23:28','2023-11-09 05:23:28',1),
	(10,'2023-11-11',1,1,1,NULL,'2023-11-09 05:33:08','2023-11-09 05:33:08',1),
	(11,'2023-11-24',2,2,2,NULL,'2023-11-10 07:48:47','2023-11-10 07:48:47',1),
	(12,'2023-11-15',23,3,3,NULL,'2023-11-10 07:50:05','2023-11-10 07:50:05',1),
	(13,'2023-11-17',34343,3434,4,NULL,'2023-11-10 11:11:40','2023-11-10 11:11:40',1),
	(14,'2023-11-30',6767,78,8,NULL,'2023-11-10 13:03:13','2023-11-10 13:03:13',1),
	(15,'2023-11-15',34,4,5,107.20,'2023-11-10 13:07:32','2023-11-10 13:07:32',1),
	(16,'2023-11-24',23,4,5,78.50,'2023-11-10 13:56:42','2023-11-10 13:56:42',1),
	(17,'2023-11-24',23,4,5,78.50,'2023-11-10 13:58:14','2023-11-10 13:58:14',1),
	(18,'2023-11-24',23,4,5,78.50,'2023-11-10 13:58:42','2023-11-10 13:58:42',1),
	(19,'2023-11-24',23,4,5,78.50,'2023-11-10 14:09:30','2023-11-10 14:09:30',1),
	(20,'2023-11-17',1000,1000,1000,7250.00,'2023-11-10 17:29:23','2023-11-10 17:29:23',1),
	(21,'2023-11-13',1000,1000,1000,7250.00,'2023-11-10 17:44:02','2023-11-10 17:44:02',1),
	(22,'2023-11-13',1000,1000,1000,7250.00,'2023-11-10 18:00:56','2023-11-10 18:00:56',1),
	(23,'2023-11-13',1000,1000,1000,7250.00,'2023-11-10 18:03:52','2023-11-10 18:03:52',1),
	(24,'2023-11-13',1000,1000,1000,7250.00,'2023-11-10 18:05:16','2023-11-10 18:05:16',1),
	(25,'2023-11-17',1000,1000,1000,7250.00,'2023-11-11 12:32:33','2023-11-11 12:32:33',1),
	(26,'2023-11-17',1000,1000,1000,7250.00,'2023-11-11 13:42:37','2023-11-11 13:42:37',1),
	(27,'2023-11-17',1000,1000,1000,7250.00,'2023-11-11 13:42:55','2023-11-11 13:42:55',1);

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table stations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stations`;

CREATE TABLE `stations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `ulp93_capacity` int(11) NOT NULL,
  `ulp95_capacity` int(11) NOT NULL,
  `diesel_capacity` int(11) NOT NULL,
  `ulp93_demand` int(11) NOT NULL,
  `ulp95_demand` int(11) NOT NULL,
  `diesel_demand` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ulp93_stock` int(10) unsigned NOT NULL DEFAULT 0,
  `ulp95_stock` int(10) unsigned NOT NULL DEFAULT 0,
  `diesel_stock` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `stations_user_id_foreign` (`user_id`),
  CONSTRAINT `stations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `stations` WRITE;
/*!40000 ALTER TABLE `stations` DISABLE KEYS */;

INSERT INTO `stations` (`id`, `user_id`, `name`, `ulp93_capacity`, `ulp95_capacity`, `diesel_capacity`, `ulp93_demand`, `ulp95_demand`, `diesel_demand`, `created_at`, `updated_at`, `ulp93_stock`, `ulp95_stock`, `diesel_stock`)
VALUES
	(1,1,'Rachael\'s station',300001,600001,300001,5001,54001,9501,NULL,NULL,0,0,0);

/*!40000 ALTER TABLE `stations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table truck_trailers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `truck_trailers`;

CREATE TABLE `truck_trailers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `truck` int(11) NOT NULL,
  `comp1` int(11) NOT NULL,
  `comp2` int(11) NOT NULL,
  `comp3` int(11) NOT NULL,
  `comp4` int(11) NOT NULL,
  `comp5` int(11) NOT NULL,
  `comp6` int(11) NOT NULL,
  `comp7` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `truck_trailers` WRITE;
/*!40000 ALTER TABLE `truck_trailers` DISABLE KEYS */;

INSERT INTO `truck_trailers` (`id`, `truck`, `comp1`, `comp2`, `comp3`, `comp4`, `comp5`, `comp6`, `comp7`, `total`, `created_at`, `updated_at`)
VALUES
	(1,1,5800,5800,5700,6700,6700,6700,6700,44100,NULL,NULL),
	(2,2,6700,6650,10150,6600,6750,0,0,36850,NULL,NULL),
	(3,3,300001,600001,300001,0,0,0,0,1200003,NULL,NULL);

/*!40000 ALTER TABLE `truck_trailers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `station_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_station_id_foreign` (`station_id`),
  CONSTRAINT `users_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `station_id`)
VALUES
	(1,'Rachael','koketso.maphopha@gmail.com',NULL,'$2y$10$KfU/Vs5qbd0BqMX1p5LNWeW0VJPcgTGqWvqeutrYjjJw0BmQo6d8a',NULL,'2023-11-08 15:47:34','2023-11-08 15:47:34',1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
